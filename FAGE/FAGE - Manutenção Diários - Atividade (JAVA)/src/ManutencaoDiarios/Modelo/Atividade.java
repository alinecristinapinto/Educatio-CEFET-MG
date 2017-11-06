package ManutencaoDiarios.Modelo;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javax.swing.JOptionPane;

/**
 *
 * @author Felipe
 */
public class Atividade {
    
    private ObservableList turmas = FXCollections.observableArrayList();
    private ObservableList disciplinas = FXCollections.observableArrayList();
    private ObservableList nomes = FXCollections.observableArrayList();
    
    public Atividade(){
        
    }
    
    public void insereAtividade(String nomeDisciplina, String nomeAtividade, String dataAtividade, double valorAtividade, int idProfessor, String nomeTurma) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idProfDisciplina = pegaIdProfDisciplina(pegaIdDisciplina(nomeDisciplina), pegaIdTurma(nomeTurma));
        
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
        
        int idProfDisciplina = pegaIdProfDisciplina(pegaIdDisciplina(nomeDisciplina), pegaIdTurma(nomeTurma));
        
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
        
        int idProfDisciplina = pegaIdProfDisciplina(pegaIdDisciplina(nomeDisciplina), pegaIdTurma(nomeTurma));
        
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
        
        int idProfDisciplina = pegaIdProfDisciplina(pegaIdDisciplina(nomeDisciplina), pegaIdTurma(nomeTurma));
        
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
        
        int idProfDisciplina = pegaIdProfDisciplina(pegaIdDisciplina(nomeDisciplina), pegaIdTurma(nomeTurma));
        
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
        
        int idProfDisciplina = pegaIdProfDisciplina(idDisciplina, idTurma);
        
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
    
    public int pegaIdTurma(String nomeTurma) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "SELECT id FROM turmas WHERE nome = (?) AND ativo = \"S\""; 
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeTurma);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        int idTurma = rs.getInt("id");
        
        return idTurma;
    }
    
    public int pegaIdDisciplina(String nomeDisciplina) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "SELECT id FROM disciplinas WHERE nome = (?) AND ativo = \"S\"";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeDisciplina);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        int idDisciplina = rs.getInt("id");
        
        return idDisciplina;
    }
    
    private int pegaIdProfDisciplina(int idDisciplina, int idTurma) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idprofessor = 8026034;
        
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
    
    public ObservableList pegaDisciplinas() throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idDisc;
        int idProfessor = 8026034;
        
        String sql = "SELECT idDisciplina FROM profdisciplinas WHERE idProfessor = (?) AND ativo = 'S'";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, idProfessor);
        
        ResultSet rs = declaracao.executeQuery();
        while(rs.next()){
            idDisc = rs.getInt("idDisciplina");
            sql = "SELECT nome FROM disciplinas WHERE id = (?) AND ativo = 'S'";
            
            declaracao = conexao.prepareStatement(sql);
            declaracao.setInt(1, idDisc);
            
            ResultSet result = declaracao.executeQuery();
            while(result.next()){
                disciplinas.add(result.getString("nome"));
            }
        }
        
        return disciplinas;
    }
    
    public ObservableList pegaTurmas(String disciplina) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idTurma;
        
        String sql = "SELECT idTurma FROM disciplinas WHERE nome = (?) AND ativo = 'S'";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, disciplina);
        
        ResultSet rs = declaracao.executeQuery();
        while(rs.next()){
            idTurma = rs.getInt("idTurma");
            sql = "SELECT nome FROM turmas WHERE id = (?) AND ativo = 'S'";
            
            declaracao = conexao.prepareStatement(sql);
            declaracao.setInt(1, idTurma);
            
            ResultSet result = declaracao.executeQuery();
            while(result.next()){
                turmas.add(result.getString("nome"));
            }
        }
        
        return turmas;
    }
    
    public ObservableList pegaNomes(String disciplina, String turma) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idProfDisc = pegaIdProfDisciplina(pegaIdDisciplina(disciplina), pegaIdTurma(turma));
        
        String sql = "SELECT nome FROM atividades WHERE idProfDisciplina = (?) AND ativo = 'S'";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, idProfDisc);
        
        ResultSet rs = declaracao.executeQuery();
        while(rs.next()){
            nomes.add(rs.getString("nome"));
        }
        
        return nomes;
    }
    
    
}