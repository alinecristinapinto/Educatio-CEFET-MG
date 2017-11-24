package manutencaoDiario.controller;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

public class BancoDeDados {

    private final String nomeDoDriver = "com.mysql.jdbc.Driver";

    private final String servidor = "localhost";
    private final String nomeBancoDeDados = "educatio";
    private final String url = "jdbc:mysql://" + servidor + ":3306/" + nomeBancoDeDados + "?useSSL=false";
    private final String usuario = "root";
    private final String senha = "";

    private Connection conexao = null;

    PreparedStatement stmt;
    List nomeDisciplinas = new ArrayList();
    List nomeProfessores = new ArrayList();
    List idDisciplinas = new ArrayList();
    List idMatriculas = new ArrayList();

    public BancoDeDados() {
        try {
            Class.forName(nomeDoDriver);
            conexao = DriverManager.getConnection(url, usuario, senha);
        } catch (ClassNotFoundException | SQLException e) {
            System.out.println("Erro na Conexão com o Driver");
        }
    }

    public List pegaNomeDisciplinas(String valorCPF) {

        try {
            String sql = "SELECT * FROM matriculas WHERE idAluno=? AND ativo=? ";
            stmt = conexao.prepareStatement(sql);
            stmt.setString(1, valorCPF);
            stmt.setString(2, "S");
            ResultSet resultado = stmt.executeQuery();
            int i = 0;
            while (resultado.next()) {
                sql = "SELECT * FROM disciplinas WHERE id=? AND ativo=?";               
                stmt = conexao.prepareStatement(sql);
                stmt.setInt(1, resultado.getInt(3));
                stmt.setString(2, "S");
                ResultSet resultadoDois = stmt.executeQuery();

                while (resultadoDois.next()) {
                    nomeDisciplinas.add(resultadoDois.getString(3));
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
            e.getErrorCode();
        }
        return nomeDisciplinas;
    }

    public List pegaIdDisciplinas(String valorCPF) {

        try {
            String sql = "SELECT * FROM matriculas WHERE idAluno LIKE " + valorCPF;
            stmt = conexao.prepareStatement(sql);
            ResultSet resultado = stmt.executeQuery();
            while (resultado.next()) {
                idDisciplinas.add(resultado.getInt("idDisciplina"));
            }
        } catch (SQLException e) {
            e.printStackTrace();
            e.getErrorCode();
        }
        return idDisciplinas;
    }

    public List pegaIdMatricula(String valorCPF, List disciplina) {

        try {
            for (int y = 0; y < disciplina.size(); y++) {
                String sql = "SELECT * FROM matriculas WHERE idAluno=? AND idDisciplina=?";
                stmt = conexao.prepareStatement(sql);
                stmt.setString(1, valorCPF);
                stmt.setInt(2, Integer.parseInt(disciplina.get(y).toString()));
                ResultSet resultado = stmt.executeQuery();
                while (resultado.next()) {
                    idMatriculas.add(resultado.getString("id"));
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
            e.getErrorCode();
        }
        return idMatriculas;
    }

    public List pegaNomeProfessores(String valorCPF) {

        try {
            String sql = "SELECT * FROM matriculas WHERE idAluno LIKE " + valorCPF;
            stmt = conexao.prepareStatement(sql);
            ResultSet resultado = stmt.executeQuery();

            while (resultado.next()) {
                sql = "SELECT * FROM profdisciplinas WHERE idDisciplina LIKE " + resultado.getInt(3);
                stmt = conexao.prepareStatement(sql);
                ResultSet resultadoDois = stmt.executeQuery();

                while (resultadoDois.next()) {
                    sql = "SELECT * FROM funcionario WHERE idSIAPE LIKE " + resultadoDois.getString(2);
                    stmt = conexao.prepareStatement(sql);
                    ResultSet resultadoTres = stmt.executeQuery();

                    while (resultadoTres.next()) {
                        nomeProfessores.add(resultadoTres.getString(3));
                    }
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return nomeProfessores;
    }

    public List pegaIdConteudo(String valorCPF) {
        List Itens = new ArrayList();
        try {
            String sql = "SELECT * FROM matriculas WHERE idAluno LIKE " + valorCPF;
            stmt = conexao.prepareStatement(sql);
            ResultSet resultado = stmt.executeQuery();
            resultado.last();
            int quantidadeDisciplinas = resultado.getRow();
            resultado.beforeFirst();

            for (int i = 0; i < quantidadeDisciplinas; i++) {
                resultado.next();
                sql = "SELECT * FROM conteudos WHERE idDisciplina LIKE " + resultado.getInt("idDisciplina");
                stmt = conexao.prepareStatement(sql);
                ResultSet resultadoDisciplinas = stmt.executeQuery();

                List nomeConteudos = new ArrayList();

                while (resultadoDisciplinas.next()) {

                    nomeConteudos.add(resultadoDisciplinas.getString("id"));
                }
                Itens.add(nomeConteudos);
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }

        return Itens;
    }

    public String pegaNomeConteudo(int idConteudo) throws SQLException {
        ResultSet resultado = null;
        try {
            String sql = "SELECT * FROM conteudos WHERE id LIKE " + idConteudo;
            stmt = conexao.prepareStatement(sql);
            resultado = stmt.executeQuery();
        } catch (SQLException e) {
            System.out.println("oi");
        }
        if (resultado.next()) {
            return resultado.getString("conteudo");
        } else {
            return null;
        }
    }

    public List pegaAtividade(String valorCPF, List matriculas) {
        List Itens = new ArrayList();
        try {
            for (int y = 0; y < matriculas.size(); y++) {
                String sql = "SELECT * FROM diarios WHERE idMatricula=?";
                stmt = conexao.prepareStatement(sql);
                stmt.setInt(1, Integer.parseInt(matriculas.get(y).toString()));
                ResultSet resultado = stmt.executeQuery();
                List atividades = new ArrayList();

                while (resultado.next()) {
                    sql = "SELECT * FROM atividades WHERE id LIKE " + resultado.getInt("idAtividade");
                    stmt = conexao.prepareStatement(sql);
                    ResultSet resultadoDois = stmt.executeQuery();
                    while (resultadoDois.next()) {
                        List dadosAtividade = new ArrayList();
                        dadosAtividade.add(pegaNomeConteudo(resultado.getInt("idConteudo")));
                        dadosAtividade.add(resultadoDois.getString("nome"));
                        dadosAtividade.add(resultadoDois.getString("data"));
                        dadosAtividade.add(resultado.getBigDecimal("nota"));
                        atividades.add(dadosAtividade);
                    }
                }
                Itens.add(atividades);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return Itens;
    }

    public List pegaFrequencia(String valorCPF, List matriculas) {
        List Itens = new ArrayList();
        try {
            for (int y = 0; y < matriculas.size(); y++) {
                String sql = "SELECT * FROM diarios WHERE idMatricula=?";
                stmt = conexao.prepareStatement(sql);
                stmt.setInt(1, Integer.parseInt(matriculas.get(y).toString()));
                ResultSet resultado = stmt.executeQuery();
                List frequencia = new ArrayList();

                while (resultado.next()) {
                    sql = "SELECT * FROM atividades WHERE id LIKE " + resultado.getInt("idAtividade");
                    stmt = conexao.prepareStatement(sql);
                    ResultSet resultadoDois = stmt.executeQuery();
                    while (resultadoDois.next()) {
                        List dadosFrequencia = new ArrayList();

                        dadosFrequencia.add(resultadoDois.getString("data"));
                        dadosFrequencia.add(resultado.getString("faltas"));
                        frequencia.add(dadosFrequencia);
                    }
                }
                Itens.add(frequencia);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return Itens;
    }
}
