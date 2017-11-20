package ManutencaoDiarios.Modelo;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;

/**
 *
 * @author Felipe
 */
public class Atividade {
    
    private ObservableList turmas = FXCollections.observableArrayList();
    private ObservableList disciplinas = FXCollections.observableArrayList();
    private ObservableList nomes = FXCollections.observableArrayList();
    private ObservableList datas = FXCollections.observableArrayList();
    private ObservableList valores = FXCollections.observableArrayList();
    
    private String nome;
    private String data;
    private double valor;
    private int idProfDisciplina;
    
    private ObservableList<AtividadeTabela> lista;
    
    
    public Atividade(){
        
    }

    public int getIdProfDisciplina() {
        return idProfDisciplina;
    }

    public void setIdProfDisciplina(int idProfDisciplina) {
        this.idProfDisciplina = idProfDisciplina;
    }
    
    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getData() {
        return data;
    }

    public void setData(String data) {
        this.data = data;
    }

    public double getValor() {
        return valor;
    }

    public void setValor(double valor) {
        this.valor = valor;
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
        
        conexao.close();
    }
    
    public void alteraAtividade(String nomeNovoAtividade, String dataNovaAtividade, double valorNovoAtividade, int idProfDisciplina, String nomeAtiv, String dataAtiv, double valorAtiv) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "UPDATE atividades SET nome = (?), valor = (?), data = (?) WHERE nome = (?) AND valor = (?) AND data = (?) AND idProfDisciplina = (?) AND ativo = \"S\"";
       
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        
        declaracao.setString(1, nomeNovoAtividade);
        declaracao.setDouble(2, valorNovoAtividade);
        declaracao.setString(3, dataNovaAtividade);
        declaracao.setString(4, nomeAtiv);
        declaracao.setDouble(5, valorAtiv);
        declaracao.setString(6, dataAtiv);
        declaracao.setInt(7, idProfDisciplina);
        
        declaracao.execute();
        declaracao.close();
        
        conexao.close();
        
    }
    
    public void removeAtividade(String disciplina, String turma, String nomeAtividade, String dataAtividade, double valorAtividade) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idProfDisciplina = pegaIdProfDisciplina(pegaIdDisciplina(disciplina), pegaIdTurma(turma));
        
        String sql = "UPDATE atividades SET ativo = (?) WHERE nome = (?) AND data = (?) AND valor = (?) AND idProfDisciplina = (?) AND ativo = \"S\"";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);

        declaracao.setString(1, "N");
        declaracao.setString(2, nomeAtividade);
        declaracao.setString(3, dataAtividade);
        declaracao.setDouble(4, valorAtividade);
        declaracao.setInt(5, idProfDisciplina);

        declaracao.execute();
        declaracao.close();
        
        conexao.close();
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
        
        int idprofessor = 849470835;
        
        String sql = "SELECT id FROM profdisciplinas WHERE idProfessor = (?) AND idDisciplina = (?) AND idTurma = (?) AND ativo = \"S\"";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, idprofessor);
        declaracao.setInt(2, idDisciplina);
        declaracao.setInt(3, idTurma);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        int idProfDisciplina = rs.getInt("id");
        
        setIdProfDisciplina(idProfDisciplina);
        
        return idProfDisciplina;
    }
    
    public ObservableList pegaDisciplinas() throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idDisc;
        int idProfessor = 849470835;
        
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
    
    public ObservableList<AtividadeTabela> montaLista(String disciplina, String turma) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        lista = FXCollections.observableArrayList();
        int idProfDisc = pegaIdProfDisciplina(pegaIdDisciplina(disciplina), pegaIdTurma(turma));

        String sql = "SELECT * FROM atividades WHERE idProfDisciplina = (?) AND ativo = 'S'";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, idProfDisc);
        
        ResultSet rs = declaracao.executeQuery();
        while(rs.next()){
            lista.add(new AtividadeTabela(rs.getString("nome"), rs.getString("data"), rs.getDouble("valor")));
        }
        
        return lista;
    }
}