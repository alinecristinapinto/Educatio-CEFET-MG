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
    private ObservableList conteudos = FXCollections.observableArrayList();
    
    private String nome;
    private String data;
    private double valor;
    private int idProfDisciplina;
    private String nomeConteudo;
    private String dataConteudo;
    private int etapaConteudo;
    private int[] idMatriculas;
    private int contadorMatriculas;
    
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

    public String getNomeConteudo() {
        return nomeConteudo;
    }

    public void setNomeConteudo(String nomeConteudo) {
        this.nomeConteudo = nomeConteudo;
    }

    public String getDataConteudo() {
        return dataConteudo;
    }

    public void setDataConteudo(String dataConteudo) {
        this.dataConteudo = dataConteudo;
    }

    public int getEtapaConteudo() {
        return etapaConteudo;
    }

    public void setEtapaConteudo(int etapaConteudo) {
        this.etapaConteudo = etapaConteudo;
    }
    
    
    
    
    public void insereAtividade(String nomeDisciplina, String nomeAtividade, String dataAtividade, double valorAtividade, String nomeTurma, String conteudo) throws ClassNotFoundException, SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        idProfDisciplina = pegaIdProfDisciplina(pegaIdDisciplina(nomeDisciplina), pegaIdTurma(nomeTurma));
        
        String sql = "INSERT INTO atividades (idProfDisciplina, nome, data, valor, ativo) VALUES (?, ?, ?, ?, ?)";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);

        declaracao.setInt(1, idProfDisciplina);
        declaracao.setString(2, nomeAtividade);
        declaracao.setString(3, dataAtividade);
        declaracao.setDouble(4, valorAtividade);
        declaracao.setString(5, "S");
        
        declaracao.execute();
        
        insereDiario(nomeDisciplina, nomeAtividade, dataAtividade, valorAtividade, nomeTurma, conteudo);
        
        declaracao.close();
        conexao.close();
    }
    
    private void insereDiario(String nomeDisciplina, String nomeAtividade, String dataAtividade, double valorAtividade, String nomeTurma, String conteudo) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        nome = nomeAtividade;
        data = dataAtividade;
        valor = valorAtividade;
        pegaIdMatricula(nomeDisciplina);
        
        for(int i=0; i<contadorMatriculas-1; i++){
            String sql = "INSERT INTO diarios (idConteudo, idMatricula, idAtividade, ativo, faltas, nota, ano) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
            PreparedStatement declaracao = conexao.prepareStatement(sql);

            declaracao.setInt(1, pegaIdConteudo(conteudo));
            declaracao.setInt(2, idMatriculas[i]);
            declaracao.setInt(3, pegaIdAtividade());
            declaracao.setString(4, "S");
            declaracao.setInt(5, 0);
            declaracao.setInt(6, 0);
            declaracao.setInt(7, 0);
            
            declaracao.execute();
        }
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
        
        idProfDisciplina = pegaIdProfDisciplina(pegaIdDisciplina(disciplina), pegaIdTurma(turma));
        
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
        idProfDisciplina = rs.getInt("id");
        
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
    
    public ObservableList<AtividadeTabela> montaLista(String disciplina, String turma, String conteudo) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        lista = FXCollections.observableArrayList();
        int idProfDisc = pegaIdProfDisciplina(pegaIdDisciplina(disciplina), pegaIdTurma(turma));
        
        String sql = "SELECT id FROM conteudos WHERE conteudo = (?) AND ativo = 'S'";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, conteudo);
        
        ResultSet rs = declaracao.executeQuery();
        while(rs.next()){
            sql = "SELECT idAtividade FROM diarios WHERE idConteudo = (?) AND ativo = 'S'";
            
            declaracao = conexao.prepareStatement(sql);
            declaracao.setInt(1, rs.getInt("id"));
            
            ResultSet rs1 = declaracao.executeQuery();
            while(rs1.next()){
                sql = "SELECT * FROM atividades WHERE idProfDisciplina = (?) AND ativo = 'S' AND id = (?)";
                
                declaracao = conexao.prepareStatement(sql);
                declaracao.setInt(1, idProfDisc);
                declaracao.setInt(2, rs1.getInt("idAtividade"));
                
                ResultSet rs2 = declaracao.executeQuery();
                while(rs2.next()){
                    lista.add(new AtividadeTabela(rs2.getString("nome"), rs2.getString("data"), rs2.getDouble("valor")));
                }
            }    
        }
        
        return lista;
    }
    
    public ObservableList pegaConteudos(String disciplina) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        int idDisc = pegaIdDisciplina(disciplina);
        
        String sql = "SELECT conteudo FROM conteudos WHERE idDisciplina = (?) AND ativo = 'S'";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, idDisc);
        
        ResultSet rs = declaracao.executeQuery();
        while(rs.next()){
            conteudos.add(rs.getString("conteudo"));
        }
        
        return conteudos;
    }
    
    public int pegaIdConteudo(String conteudo) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "SELECT id FROM conteudos WHERE conteudo = (?) AND ativo = 'S'";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, conteudo);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        
        return rs.getInt("id");
    }
    
    public void insereConteudo(int etapa, String disciplina, String conteudo, String data) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "INSERT INTO conteudos (idEtapa, idDisciplina, conteudo, datas, ativo) VALUES (?, ?, ?, ?, ?)";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);

        declaracao.setInt(1, etapa);
        declaracao.setInt(2, pegaIdDisciplina(disciplina));
        declaracao.setString(3, conteudo);
        declaracao.setString(4, data);
        declaracao.setString(5, "S");

        declaracao.execute();
        declaracao.close();
        
        conexao.close();
    }
    
    public int pegaEtapa(String conteudo, String disciplina) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "SELECT * FROM conteudos WHERE conteudo = (?) AND idDisciplina = (?) AND ativo = 'S'";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, conteudo);
        declaracao.setInt(2, pegaIdDisciplina(disciplina));
        
        ResultSet rs = declaracao.executeQuery();
        
        rs.next();
        return rs.getInt("idEtapa");
    }
    
    public String pegaData(String conteudo, String disciplina) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "SELECT * FROM conteudos WHERE conteudo = (?) AND idDisciplina = (?) AND ativo = 'S'";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, conteudo);
        declaracao.setInt(2, pegaIdDisciplina(disciplina));
        
        ResultSet rs = declaracao.executeQuery();
        
        rs.next();
        return rs.getString("datas");
    }
    
    public void alteraConteudo(String conteudo, String disciplina, String conteudoNovo, int etapaNova, String dataNova) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "UPDATE conteudos SET conteudo = (?), idEtapa = (?), datas = (?) WHERE conteudo = (?) AND idDisciplina = (?) AND ativo = \"S\"";
       
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        
        declaracao.setString(1, conteudoNovo);
        declaracao.setInt(2, etapaNova);
        declaracao.setString(3, dataNova);
        declaracao.setString(4, conteudo);
        declaracao.setDouble(5, pegaIdDisciplina(disciplina));
        
        declaracao.execute();
        declaracao.close();
        
        conexao.close();
    }
    
    public void removeConteudo(String disciplina, String turma, String conteudo) throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "UPDATE conteudos SET ativo = 'N' WHERE conteudo = (?) AND idDisciplina = (?) AND ativo = 'S'";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);

        declaracao.setString(1, conteudo);
        declaracao.setInt(2, pegaIdDisciplina(disciplina));
        
        declaracao.execute();
        declaracao.close();
        
        conexao.close();
    }
    
    public void pegaIdMatricula(String disciplina) throws SQLException{
        idMatriculas = new int[1000];
        int i = 0;
        
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "SELECT id FROM matriculas WHERE idDisciplina = (?) AND ativo = 'S'";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setInt(1, pegaIdDisciplina(disciplina));
        
        ResultSet rs = declaracao.executeQuery();
        while(rs.next()){
            idMatriculas[i] = rs.getInt("id");
            contadorMatriculas++;
        }
    }
    
    public int pegaIdAtividade() throws SQLException{
        Connection conexao = new ConnectionFactory().getConexao();
        
        String sql = "SELECT id FROM atividades WHERE nome = (?) AND data = (?) AND valor =(?) AND idProfDisciplina = (?)";
        
        PreparedStatement declaracao = conexao.prepareStatement(sql);
        declaracao.setString(1, nome);
        declaracao.setString(2, data);
        declaracao.setDouble(3, valor);
        declaracao.setInt(4, idProfDisciplina);
        
        ResultSet rs = declaracao.executeQuery();
        rs.next();
        
        return rs.getInt("id");
    }
}