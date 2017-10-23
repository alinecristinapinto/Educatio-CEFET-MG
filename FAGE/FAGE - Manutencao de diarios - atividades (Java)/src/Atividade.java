
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
    private static int idAtividade;
    
    public Atividade(){
        
    }
    
    public void insereAtividade(String nomeDisciplina, String nomeAtividade, String dataAtividade, double valorAtividade, int idProfessor, String nomeTurma) throws ClassNotFoundException, SQLException{
        idAtividade += 1;
        
        Connection conexao = new ConnectionFactory().getConexao();
        /*
            Pega o ID da turma.
        */
        String sql = "SELECT id FROM turmas WHERE nome = (?)"; 
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeTurma);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        int idTurma = rs.getInt("id");
        
        /*
            Pega o ID da disciplina
        */
        sql = "SELECT id FROM disciplinas WHERE nome = (?)";
        
        declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeDisciplina);
        
        rs = declaracao.executeQuery();
        rs.next();
        int idDisciplina = rs.getInt("id");
        
        /*
            Pega o id de profDisciplina 
        */
        sql = "SELECT id FROM profdisciplinas WHERE idProfessor = (?) AND idDisciplina = (?) AND idTurma = (?)";
        
        declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, idProfessor);
        declaracao.setInt(2, idDisciplina);
        declaracao.setInt(3, idTurma);
        
        rs = declaracao.executeQuery();
        rs.next();
        int idProfDisciplina = rs.getInt("id");
        
        /*
            Insere os dados na tabela
        */
        sql = "INSERT INTO atividades (id, idProfDisciplina, nome, data, valor, ativo) VALUES (?, ?, ?, ?, ?, ?)";
        
        declaracao = conexao.prepareStatement(sql);

        declaracao.setInt(1, idAtividade);
        declaracao.setInt(2, idProfDisciplina);
        declaracao.setString(3, nomeAtividade);
        declaracao.setString(4, dataAtividade);
        declaracao.setDouble(5, valorAtividade);
        declaracao.setString(6, "S");

        declaracao.execute();
        declaracao.close();

        JOptionPane.showMessageDialog(null, "Gravado no banco de dados com sucesso!");
        
        
        conexao.close();
    }
    
    public void alteraNomeAtividade(String nomeNovoAtividade, String nomeAtividade, String nomeDisciplina, int idProfessor, String nomeTurma) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        /*
            Pega o ID da turma.
        */
        String sql = "SELECT id FROM turmas WHERE nome = (?)"; 
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeTurma);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        int idTurma = rs.getInt("id");
        
        /*
            Pega o ID da disciplina
        */
        sql = "SELECT id FROM disciplinas WHERE nome = (?)";
        
        declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeDisciplina);
        
        rs = declaracao.executeQuery();
        rs.next();
        int idDisciplina = rs.getInt("id");
        
        /*
            Pega o id de profDisciplina 
        */
        sql = "SELECT id FROM profdisciplinas WHERE idProfessor = (?) AND idDisciplina = (?) AND idTurma = (?)";
        
        declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, idProfessor);
        declaracao.setInt(2, idDisciplina);
        declaracao.setInt(3, idTurma);
        
        rs = declaracao.executeQuery();
        rs.next();
        int idProfDisciplina = rs.getInt("id");
        
        
        sql = "UPDATE atividades SET nome = (?) WHERE nome = (?) AND idProfDisciplina = (?)";
       
        declaracao = conexao.prepareStatement(sql);
        
        declaracao.setString(1, nomeNovoAtividade);
        declaracao.setString(2, nomeAtividade);
        declaracao.setInt(3, idProfDisciplina);
        
        declaracao.execute();
        declaracao.close();
        
        JOptionPane.showMessageDialog(null, "Nome alterado no banco de dados com sucesso!");
        
        
        conexao.close();
        
    }
    
    public void alteraValorAtividade(double valorAtividade, String nomeAtividade, String nomeDisciplina, int idProfessor, String nomeTurma) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        /*
            Pega o ID da turma.
        */
        String sql = "SELECT id FROM turmas WHERE nome = (?)"; 
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeTurma);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        int idTurma = rs.getInt("id");
        
        /*
            Pega o ID da disciplina
        */
        sql = "SELECT id FROM disciplinas WHERE nome = (?)";
        
        declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeDisciplina);
        
        rs = declaracao.executeQuery();
        rs.next();
        int idDisciplina = rs.getInt("id");
        
        /*
            Pega o id de profDisciplina 
        */
        sql = "SELECT id FROM profdisciplinas WHERE idProfessor = (?) AND idDisciplina = (?) AND idTurma = (?)";
        
        declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, idProfessor);
        declaracao.setInt(2, idDisciplina);
        declaracao.setInt(3, idTurma);
        
        rs = declaracao.executeQuery();
        rs.next();
        int idProfDisciplina = rs.getInt("id");
        
        
        sql = "UPDATE atividades SET valor = (?) WHERE nome = (?) AND idProfDisciplina = (?)";
        
        declaracao = conexao.prepareStatement(sql);
        
        declaracao.setDouble(1, valorAtividade);
        declaracao.setString(2, nomeAtividade);
        declaracao.setInt(3, idProfDisciplina);
        
        declaracao.execute();
        declaracao.close();

        JOptionPane.showMessageDialog(null, "Valor alterado no banco de dados com sucesso!");
     
        
        conexao.close();
    }
    
    public void alteraDataAtividade(String dataAtividade, String nomeAtividade, String nomeDisciplina, int idProfessor, String nomeTurma) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        /*
            Pega o ID da turma.
        */
        String sql = "SELECT id FROM turmas WHERE nome = (?)"; 
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeTurma);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        int idTurma = rs.getInt("id");
        
        /*
            Pega o ID da disciplina
        */
        sql = "SELECT id FROM disciplinas WHERE nome = (?)";
        
        declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeDisciplina);
        
        rs = declaracao.executeQuery();
        rs.next();
        int idDisciplina = rs.getInt("id");
        
        /*
            Pega o id de profDisciplina 
        */
        sql = "SELECT id FROM profdisciplinas WHERE idProfessor = (?) AND idDisciplina = (?) AND idTurma = (?)";
        
        declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, idProfessor);
        declaracao.setInt(2, idDisciplina);
        declaracao.setInt(3, idTurma);
        
        rs = declaracao.executeQuery();
        rs.next();
        int idProfDisciplina = rs.getInt("id");
        
        
        sql = "UPDATE atividades SET data = (?) WHERE nome = (?) AND idProfDisciplina = (?)";
        
        declaracao = conexao.prepareStatement(sql);

        declaracao.setString(1, dataAtividade);
        declaracao.setString(2, nomeAtividade);
        declaracao.setInt(3, idProfDisciplina);

        declaracao.execute();
        declaracao.close();

        JOptionPane.showMessageDialog(null, "Data alterada no banco de dados com sucesso!");
        
        
        conexao.close();
    }
    
    public void removeAtividade(String nomeAtividade, String nomeDisciplina, int idProfessor, String nomeTurma) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        /*
            Pega o ID da turma.
        */
        String sql = "SELECT id FROM turmas WHERE nome = (?)"; 
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeTurma);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        int idTurma = rs.getInt("id");
        
        /*
            Pega o ID da disciplina
        */
        sql = "SELECT id FROM disciplinas WHERE nome = (?)";
        
        declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nomeDisciplina);
        
        rs = declaracao.executeQuery();
        rs.next();
        int idDisciplina = rs.getInt("id");
        
        /*
            Pega o id de profDisciplina 
        */
        sql = "SELECT id FROM profdisciplinas WHERE idProfessor = (?) AND idDisciplina = (?) AND idTurma = (?)";
        
        declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, idProfessor);
        declaracao.setInt(2, idDisciplina);
        declaracao.setInt(3, idTurma);
        
        rs = declaracao.executeQuery();
        rs.next();
        int idProfDisciplina = rs.getInt("id");
        
        
        sql = "UPDATE atividades SET ativo = (?) WHERE nome = (?) AND idProfDisciplina = (?)";
        
        declaracao = conexao.prepareStatement(sql);

        declaracao.setString(1, "N");
        declaracao.setString(2, nomeAtividade);
        declaracao.setInt(3, idProfDisciplina);

        declaracao.execute();
        declaracao.close();

        JOptionPane.showMessageDialog(null, "Apagado do banco de dados com sucesso!");
        
        
        conexao.close();
    }

    /*public String imprime(int idAtividade, int idDisciplina) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "SELECT * FROM atividades WHERE id = (?) AND idDisciplina = (?)";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        
        declaracao.setInt(1, idAtividade);
        declaracao.setInt(2, idDisciplina);
        
        ResultSet rs = declaracao.executeQuery();
        
        rs.next();
        nomeAtividade = rs.getString("nome");
        dataAtividade = rs.getString("data");
        valorAtividade = rs.getDouble("valor");
        
        declaracao.close();
        conexao.close();
        
        return "ID da atividade = " + idAtividade + "\nID da disciplina = " + idDisciplina + "\nNome da atividade = " 
                + nomeAtividade + "\nData da atividade = " + dataAtividade + "\nValor da atividade = " + valorAtividade;
    }*/   
}