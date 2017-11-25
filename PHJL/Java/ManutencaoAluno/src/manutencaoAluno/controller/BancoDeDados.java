package manutencaoAluno.controller;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.math.BigInteger;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.sql.*;
import java.util.Calendar;
import java.util.GregorianCalendar;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.scene.control.ComboBox;

public class BancoDeDados {

    private final String nomeDoDriver = "com.mysql.jdbc.Driver";

    private final String servidor = "localhost";
    private final String nomeBancoDeDados = "educatio";
    private final String url = "jdbc:mysql://" + servidor + ":3306/" + nomeBancoDeDados + "?useSSL=false";
    private final String usuario = "root";
    private final String senha = "";

    private Connection conexao = null;
    private ObservableList<String> nomeTurmas;
    private ObservableList<String> nomeCampus;
    private ObservableList<String> nomeDepartamento;

    public BancoDeDados() {
        try {
            Class.forName(nomeDoDriver);
            conexao = DriverManager.getConnection(url, usuario, senha);
        } catch (ClassNotFoundException | SQLException e) {
            System.out.println("Erro na Conexão com o Driver");
        }
    }

    public void enviaDados(String CPF, String NOME, String SEXO, String DATA, String LOGRADOURO, String NUMERO,
            String COMPLEMENTO, String BAIRRO, String CIDADE, String CEP, String UF, String EMAIL, String IMAGEM, int IDTURMA) {

        try {
            String sql = "INSERT INTO alunos "
                    + "("
                    + " idCPF,"
                    + " idTurma,"
                    + " nome,"
                    + " sexo,"
                    + " nascimento,"
                    + " logradouro,"
                    + " numeroLogradouro,"
                    + " complemento,"
                    + " bairro,"
                    + " cidade,"
                    + " CEP,"
                    + " UF,"
                    + " email,"
                    + " foto,"
                    + " senha,"
                    + " ativo"
                    + ") "
                    + "VALUES"
                    + "("
                    + " ?," //01 - idCPF
                    + " ?," //02 - idTurma
                    + " ?," //03 - nome
                    + " ?," //04 - sexo
                    + " ?," //05 - nascimento
                    + " ?," //06 - logadouro
                    + " ?," //07 - numerologadouro
                    + " ?," //08 - complemento
                    + " ?," //09 - bairro
                    + " ?," //10 - cidade
                    + " ?," //11 - CEP
                    + " ?," //12 - UF
                    + " ?," //13 - email
                    + " ?," //14 - foto
                    + " ?," //15 - senha
                    + " ?" //16 - ativo
                    + ")";
            PreparedStatement ps = conexao.prepareStatement(sql);

            ps.setString(1, CPF);
            ps.setInt(2, IDTURMA);
            ps.setString(3, NOME);
            ps.setString(4, SEXO);
            ps.setString(5, DATA);
            ps.setString(6, LOGRADOURO);
            ps.setString(7, NUMERO);
            ps.setString(8, COMPLEMENTO);
            ps.setString(9, BAIRRO);
            ps.setString(10, CIDADE);
            ps.setString(11, CEP);
            ps.setString(12, UF);
            ps.setString(13, EMAIL);

            try {
                File imgfile = new File(IMAGEM);
                FileInputStream fin = new FileInputStream(imgfile);
                ps.setBinaryStream(14, (InputStream) fin, (int) imgfile.length());
            } catch (FileNotFoundException ex) {
                Logger.getLogger(BancoDeDados.class.getName()).log(Level.SEVERE, null, ex);
            }

            ps.setString(15, criaSenhaMD5());
            ps.setString(16, "N");

            ps.execute();

        } catch (SQLException e) {
            System.out.println(e.getErrorCode());
            System.out.println(e.getMessage());
            System.out.println(e.getSQLState());
            e.getStackTrace();

        }
    }

    public String criaSenhaMD5() {
        String s = "";
        MessageDigest m;
        try {
            m = MessageDigest.getInstance("MD5");
            m.update(s.getBytes(), 0, s.length());
            s = new BigInteger(1, m.digest()).toString(16);
        } catch (NoSuchAlgorithmException ex) {
            ex.printStackTrace();
        }
        return s;
    }

    public void atualizaDados(String CPF, String NOME, String SEXO, String DATA, String LOGRADOURO, String NUMERO,
            String COMPLEMENTO, String BAIRRO, String CIDADE, String CEP, String UF, String EMAIL, int IDTURMA,
            String valorCPF, int valorIDTurma, String IMAGEM) {

        PreparedStatement ps;
        String sql;
        try {

            sql = "UPDATE alunos SET nome=? WHERE idCPF =? ";
            ps = conexao.prepareStatement(sql);
            ps.setString(1, NOME);
            ps.setString(2, valorCPF);
            ps.executeUpdate();

            if (!valorCPF.equals(CPF)) {
                sql = "UPDATE alunos SET idCPF=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, CPF);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "UPDATE matriculas SET idAluno=? WHERE idAluno =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, CPF);
                ps.setString(2, valorCPF);
                ps.executeUpdate();
            }

            sql = "UPDATE alunos SET sexo=? WHERE idCPF =? ";
            ps = conexao.prepareStatement(sql);
            ps.setString(1, SEXO);
            ps.setString(2, valorCPF);
            ps.executeUpdate();

            sql = "UPDATE alunos SET nascimento=? WHERE idCPF =? ";
            ps = conexao.prepareStatement(sql);
            ps.setString(1, DATA);
            ps.setString(2, valorCPF);
            ps.executeUpdate();

            if (valorIDTurma != IDTURMA) {
                sql = "UPDATE alunos SET idTurma=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setInt(1, IDTURMA);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "DELETE FROM matriculas WHERE idAluno =?";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, valorCPF);
                ps.executeUpdate();

                InsereMatricula(IDTURMA, CPF);
            }

            sql = "UPDATE alunos SET logradouro=? WHERE idCPF =? ";
            ps = conexao.prepareStatement(sql);
            ps.setString(1, LOGRADOURO);
            ps.setString(2, valorCPF);
            ps.executeUpdate();

            sql = "UPDATE alunos SET numeroLogradouro=? WHERE idCPF =? ";
            ps = conexao.prepareStatement(sql);
            ps.setString(1, NUMERO);
            ps.setString(2, valorCPF);
            ps.executeUpdate();

            sql = "UPDATE alunos SET complemento=? WHERE idCPF =? ";
            ps = conexao.prepareStatement(sql);
            ps.setString(1, COMPLEMENTO);
            ps.setString(2, valorCPF);
            ps.executeUpdate();

            sql = "UPDATE alunos SET bairro=? WHERE idCPF =? ";
            ps = conexao.prepareStatement(sql);
            ps.setString(1, BAIRRO);
            ps.setString(2, valorCPF);
            ps.executeUpdate();

            sql = "UPDATE alunos SET cidade=? WHERE idCPF =? ";
            ps = conexao.prepareStatement(sql);
            ps.setString(1, CIDADE);
            ps.setString(2, valorCPF);
            ps.executeUpdate();

            sql = "UPDATE alunos SET CEP=? WHERE idCPF =? ";
            ps = conexao.prepareStatement(sql);
            ps.setString(1, CEP);
            ps.setString(2, valorCPF);
            ps.executeUpdate();

            sql = "UPDATE alunos SET UF=? WHERE idCPF =? ";
            ps = conexao.prepareStatement(sql);
            ps.setString(1, UF);
            ps.setString(2, valorCPF);
            ps.executeUpdate();

            sql = "UPDATE alunos SET email=? WHERE idCPF =? ";
            ps = conexao.prepareStatement(sql);
            ps.setString(1, EMAIL);
            ps.setString(2, valorCPF);
            ps.executeUpdate();

            if (IMAGEM != null) {
                try {
                    sql = "UPDATE alunos SET foto=? WHERE idCPF =?";
                    ps = conexao.prepareStatement(sql);
                    File imgfile = new File(IMAGEM);
                    FileInputStream fin = new FileInputStream(imgfile);
                    ps.setBinaryStream(1, (InputStream) fin, (int) imgfile.length());
                    ps.setString(1, valorCPF);
                } catch (FileNotFoundException ex) {
                    Logger.getLogger(BancoDeDados.class.getName()).log(Level.SEVERE, null, ex);
                }
            } else {
                //System.out.println("erro na imagem");
            }
        } catch (SQLException erro) {
            System.out.println(erro.getErrorCode());
            System.out.println(erro.getMessage());
            System.out.println(erro.getSQLState());
            erro.getStackTrace();
        }
    }

    public ComboBox ObtemTurmas(ComboBox turma) {
        try {
            nomeTurmas = FXCollections.observableArrayList();
            Statement stmt = conexao.createStatement();
            String sql = "SELECT * FROM turmas";
            try (ResultSet resultado = stmt.executeQuery(sql)) {
                while (resultado.next()) {
                    nomeTurmas.add(resultado.getString("nome"));
                }
            }
        } catch (SQLException erro) {
            System.out.println(erro.getErrorCode());
            System.out.println(erro.getMessage());
            System.out.println(erro.getSQLState());
            erro.getStackTrace();

        }
        turma.setItems(nomeTurmas);
        System.out.println(turma);
        return turma;
    }

    public ComboBox ObtemCampus(ComboBox campus) {
        try {
            nomeCampus = FXCollections.observableArrayList();
            Statement stmt = conexao.createStatement();
            String sql = "SELECT * FROM campi";
            try (ResultSet resultado = stmt.executeQuery(sql)) {
                while (resultado.next()) {
                    nomeCampus.add(resultado.getString("nome"));
                }
            }
        } catch (SQLException erro) {
            System.out.println(erro.getErrorCode());
            System.out.println(erro.getMessage());
            System.out.println(erro.getSQLState());
            erro.getStackTrace();

        }
        campus.setItems(nomeCampus);
        System.out.println(campus);
        return campus;
    }
    public ComboBox ObtemDepartamento(ComboBox departamento, int g) {
        try {
            nomeDepartamento = FXCollections.observableArrayList();
            Statement stmt = conexao.createStatement();
            String sql = "SELECT * FROM deptos WHERE idCampi LIKE" + g;
            try (ResultSet resultado = stmt.executeQuery(sql)) {
                while (resultado.next()) {
                    nomeDepartamento.add(resultado.getString("nome"));
                }
            }
        } catch (SQLException erro) {
            System.out.println(erro.getErrorCode());
            System.out.println(erro.getMessage());
            System.out.println(erro.getSQLState());
            erro.getStackTrace();

        }
        departamento.setItems(nomeDepartamento);
      //  System.out.println(campus);
        return departamento;
    }

    public void deletaDados(String valorCPF) {
        Statement stmt;
        try {
            stmt = conexao.createStatement();
            String sql = "UPDATE alunos SET ativo='N' WHERE idCPF LIKE " + valorCPF;
            int resultado = stmt.executeUpdate(sql);
        } catch (SQLException erro) {
            System.out.println(erro.getErrorCode());
            System.out.println(erro.getMessage());
            System.out.println(erro.getSQLState());
            erro.getStackTrace();

        }
    }

    public int ObtemIdTurma(String turma) {
        Statement stmt;
        try {
            stmt = conexao.createStatement();
            String sql = "SELECT * FROM turmas";
            ResultSet resultado = stmt.executeQuery(sql);
            while (resultado.next()) {
                if (turma.equals(resultado.getString("nome"))) {
                    return resultado.getInt(1);
                }
            }
        } catch (SQLException erro) {
            System.out.println(erro.getErrorCode());
            System.out.println(erro.getMessage());
            System.out.println(erro.getSQLState());
            erro.getStackTrace();

        }
        return -1;
    }
    public int ObtemIdCampus(String campus) {
        Statement stmt;
        try {
            stmt = conexao.createStatement();
            String sql = "SELECT * FROM campi";
            ResultSet resultado = stmt.executeQuery(sql);
            while (resultado.next()) {
                if (campus.equals(resultado.getString("nome"))) {
                    return resultado.getInt(1);
                }
            }
        } catch (SQLException erro) {
            System.out.println(erro.getErrorCode());
            System.out.println(erro.getMessage());
            System.out.println(erro.getSQLState());
            erro.getStackTrace();

        }
        return -1;
    }

    public String ObtemNomeTurma(int idTurma) {
        Statement stmt;
        try {
            stmt = conexao.createStatement();
            String sql = "SELECT * FROM turmas WHERE id LIKE " + idTurma;
            ResultSet resultado = stmt.executeQuery(sql);
            while (resultado.next()) {
                return resultado.getString("nome");
            }
        } catch (SQLException erro) {
            System.out.println(erro.getErrorCode());
            System.out.println(erro.getMessage());
            System.out.println(erro.getSQLState());
            erro.getStackTrace();

        }
        return null;
    }

    public void InsereMatricula(int Turma, String CPF) throws SQLException {

        String sql = "SELECT * FROM disciplinas WHERE idTurma = " + Turma;
        PreparedStatement stmt = conexao.prepareStatement(sql);
        ResultSet resultado = stmt.executeQuery();
        Calendar cal = GregorianCalendar.getInstance();
        while (resultado.next()) {
            sql = "INSERT INTO matriculas (idAluno, idDisciplina, ano, ativo) VALUES (?,?,?,?)";
            PreparedStatement ps = conexao.prepareStatement(sql);
            ps.setString(1, CPF);
            ps.setInt(2, resultado.getInt("id"));
            ps.setString(3, "" + cal.get(Calendar.YEAR));
            ps.setString(4, "S");
            ps.execute();
        }
    }

    public void DeletaMatricula(String CPF) {
        PreparedStatement ps;
        String sql;

        try {
            sql = "UPDATE matriculas SET ativo=? WHERE idAluno =? ";
            ps = conexao.prepareStatement(sql);
            ps.setString(1, "N");
            ps.setString(2, CPF);
            ps.executeUpdate();
        } catch (SQLException erro) {
            System.out.println(erro.getErrorCode());
            System.out.println(erro.getMessage());
            System.out.println(erro.getSQLState());
            erro.getStackTrace();

        }
    }

}
