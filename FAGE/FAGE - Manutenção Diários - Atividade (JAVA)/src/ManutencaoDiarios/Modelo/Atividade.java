package ManutencaoDiarios.Modelo;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.swing.JOptionPane;

/**
 *
 * @author Felipe
 */
public class Atividade {
    
    public Atividade(){
        
    }
    
    public void insereAtividade(String nomeDisciplina, String nomeAtividade, String dataAtividade, double valorAtividade, int idProfessor, String nomeTurma) throws ClassNotFoundException, SQLException{
        
        
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idTurma = pegaIdTurma(nomeTurma);
        int idDisciplina = pegaIdDisciplina(nomeDisciplina);
        int idProfDisciplina = pegaIdProfDisciplina(idProfessor, idDisciplina, idTurma);
        
        /*
            Insere os dados na tabela
        */
        String sql = "INSERT INTO atividades (idProfDisciplina, nome, data, valor, ativo) VALUES (?, ?, ?, ?, ?)";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);

        declaracao.setInt(1, idProfDisciplina);
        declaracao.setString(2, nomeAtividade);
        declaracao.setString(3, dataAtividade);
        declaracao.setDouble(4, valorAtividade);
        declaracao.setString(5, "S");

        declaracao.execute();
        declaracao.close();

        JOptionPane.showMessageDialog(null, "Gravado no banco de dados com sucesso!");
        
        
        conexao.close();
    }
    
    public void alteraNomeAtividade(String nomeNovoAtividade, String nomeDisciplina, int idProfessor, String nomeTurma) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idTurma = pegaIdTurma(nomeTurma);
        int idDisciplina = pegaIdDisciplina(nomeDisciplina);
        int idProfDisciplina = pegaIdProfDisciplina(idProfessor, idDisciplina, idTurma);
        
        String nomeAtividade = JOptionPane.showInputDialog("Digite o nome referente a atividade que deseja alterar\n" + 
                imprimeAtividades(idProfDisciplina));
        
        String sql = "UPDATE atividades SET nome = (?) WHERE nome = (?) AND idProfDisciplina = (?) AND ativo = \"S\"";
       
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        
        declaracao.setString(1, nomeNovoAtividade);
        declaracao.setString(2, nomeAtividade);
        declaracao.setInt(3, idProfDisciplina);
        
        declaracao.execute();
        declaracao.close();
        
        JOptionPane.showMessageDialog(null, "Nome alterado no banco de dados com sucesso!");
        
        
        conexao.close();
        
    }
    
    public void alteraValorAtividade(double valorAtividade, String nomeDisciplina, int idProfessor, String nomeTurma) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idTurma = pegaIdTurma(nomeTurma);
        int idDisciplina = pegaIdDisciplina(nomeDisciplina);
        int idProfDisciplina = pegaIdProfDisciplina(idProfessor, idDisciplina, idTurma);
        
        String nomeAtividade = JOptionPane.showInputDialog("Digite o nome referente a atividade que deseja alterar\n" + 
                imprimeAtividades(idProfDisciplina));
        
        String sql = "UPDATE atividades SET valor = (?) WHERE nome = (?) AND idProfDisciplina = (?) AND ativo = \"S\"";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        
        declaracao.setDouble(1, valorAtividade);
        declaracao.setString(2, nomeAtividade);
        declaracao.setInt(3, idProfDisciplina);
        
        declaracao.execute();
        declaracao.close();

        JOptionPane.showMessageDialog(null, "Valor alterado no banco de dados com sucesso!");
     
        
        conexao.close();
    }
    
    public void alteraDataAtividade(String dataAtividade, String nomeDisciplina, int idProfessor, String nomeTurma) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idTurma = pegaIdTurma(nomeTurma);
        int idDisciplina = pegaIdDisciplina(nomeDisciplina);
        int idProfDisciplina = pegaIdProfDisciplina(idProfessor, idDisciplina, idTurma);
        
        String nomeAtividade = JOptionPane.showInputDialog("Digite o nome referente a atividade que deseja alterar\n" + 
                imprimeAtividades(idProfDisciplina));
        
        String sql = "UPDATE atividades SET data = (?) WHERE nome = (?) AND idProfDisciplina = (?) AND ativo = \"S\"";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);

        declaracao.setString(1, dataAtividade);
        declaracao.setString(2, nomeAtividade);
        declaracao.setInt(3, idProfDisciplina);

        declaracao.execute();
        declaracao.close();

        JOptionPane.showMessageDialog(null, "Data alterada no banco de dados com sucesso!");
        
        
        conexao.close();
    }
    
    public void removeAtividade(String nomeDisciplina, int idProfessor, String nomeTurma) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idTurma = pegaIdTurma(nomeTurma);
        int idDisciplina = pegaIdDisciplina(nomeDisciplina);
        int idProfDisciplina = pegaIdProfDisciplina(idProfessor, idDisciplina, idTurma);
        
        String nomeAtividade = JOptionPane.showInputDialog("Digite o nome referente a atividade que deseja remover\n" + 
                imprimeAtividades(idProfDisciplina));
        
        String sql = "UPDATE atividades SET ativo = (?) WHERE nome = (?) AND idProfDisciplina = (?) AND ativo = \"S\"";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);

        declaracao.setString(1, "N");
        declaracao.setString(2, nomeAtividade);
        declaracao.setInt(3, idProfDisciplina);

        declaracao.execute();
        declaracao.close();

        JOptionPane.showMessageDialog(null, "Apagado do banco de dados com sucesso!");
        
        
        conexao.close();
    }

    private String imprimeAtividades(int idProfDisciplina) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        String dadosAtividade = new String();
        
        String sql = "SELECT * FROM atividades WHERE idProfDisciplina = (?) AND ativo = \"S\"";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, idProfDisciplina);
        
        ResultSet rs = declaracao.executeQuery();
        
        while(rs.next()){
            dadosAtividade += "Nome: " + rs.getString("nome") + " // Data: " + 
                    rs.getString("data") + " // Valor: " + rs.getDouble("valor") + "\n";
        }
        
        return dadosAtividade;
    }
    
    public void imprimeAtividadeAluno(String nomeProfessor, String nomeDisciplina, String nomeTurma) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        String dadosAtividade = new String();
        
        /*
            Pega o ID do professor
        */
        
        String sql = "SELECT idSIAPE FROM funcionario WHERE nome = (?) AND hierarquia = \"Professor\" AND ativo = \"S\"";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeProfessor);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        
        int idProfessor = rs.getInt("idSIAPE");
        int idDisciplina = pegaIdDisciplina(nomeDisciplina);
        int idTurma = pegaIdTurma(nomeTurma);
        
        int idProfDisciplina = pegaIdProfDisciplina(idProfessor, idDisciplina, idTurma);
        
        sql = "SELECT * FROM atividades WHERE idProfDisciplina = (?) AND ativo = \"S\"";
        
        declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, idProfDisciplina);
        
        rs = declaracao.executeQuery();
        
        while(rs.next()){
            dadosAtividade += "Nome: " + rs.getString("nome") + " // Data: " + 
                    rs.getString("data") + " // Valor: " + rs.getDouble("valor") + "\n";
        }
        
        JOptionPane.showMessageDialog(null, dadosAtividade);
    }
    
    private int pegaIdTurma(String nomeTurma) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "SELECT id FROM turmas WHERE nome = (?) AND ativo = \"S\""; 
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeTurma);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        int idTurma = rs.getInt("id");
        
        return idTurma;
    }
    
    private int pegaIdDisciplina(String nomeDisciplina) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "SELECT id FROM disciplinas WHERE nome = (?) AND ativo = \"S\"";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeDisciplina);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        int idDisciplina = rs.getInt("id");
        
        return idDisciplina;
    }
    
    private int pegaIdProfDisciplina(int idProf, int idDisciplina, int idTurma) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idprofessor = 1;
        
        String sql = "SELECT id FROM profdisciplinas WHERE idProfessor = (?) AND idDisciplina = (?) AND idTurma = (?) AND ativo = \"S\"";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, idprofessor);
        declaracao.setInt(2, idDisciplina);
        declaracao.setInt(3, idTurma);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        int idProfDisciplina = rs.getInt("id");
        
        return idProfDisciplina;
    }
}