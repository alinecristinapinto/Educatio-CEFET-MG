package ch.makery.jdbc;

import java.sql.Connection;
import java.util.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class BancoDeDados {
    private static Connection conexao;

    public BancoDeDados(Connection conexao) {
        this.conexao = conexao;
    }
    
    
    private void deletaExemplar(int idAcervo, String tipo) throws SQLException, ClassNotFoundException{
        String sql = null;
        PreparedStatement stmt = conexao.prepareStatement(sql);
        ResultSet rs = stmt.executeQuery();
        if(tipo=="periodicos"){//Se for um periodico exclui partes tambem
            sql="SELECT * FROM periodicos WHERE idAcervo = " + idAcervo;
            rs = stmt.executeQuery(sql);
            sql = "UPDATE 'partes' SET 'ativo' = 'N' WHERE idPeriodico = "+rs.getInt("id");
            stmt.executeQuery(sql);
            if(!stmt.execute(sql)/*Executa comando*/){
                //Mensagem de exito-------------
            }
        }
        sql = "UPDATE " + tipo + " SET 'ativo' = 'N' WHERE idAcervo = " + idAcervo;//Comando
        if(stmt.execute(sql)/*Executa comando*/){
            //Mensagem de exito-------------
        }else{
            //Mensagem de erro-------------
        }
        stmt.close();//Fecha statement
        conexao.close();
    }
    
    public void deletaAcervo(int idAcervo, String tipo) throws SQLException, ClassNotFoundException{
        deletaExemplar(idAcervo,tipo);
        String sql = "UPDATE 'acervo' SET 'ativo' = 'N' WHERE id = " + idAcervo;//Comando
        PreparedStatement stmt = conexao.prepareStatement(sql);
        if(!stmt.execute()/*Executa comando*/){
            //Mensagem de exito----------
        }
        stmt.close();//Fecha statement
        conexao.close();
    }
    
    public void guardaDescarte(Integer idAcervo, Date data, String motivo, String idFuncionario) throws SQLException, ClassNotFoundException{
        String sql = "INSERT INTO descartes " + "(idAcervo, dataDescarte, motivos, operador)" + " values (?,?,?,?)";//Comando
        PreparedStatement stmt = conexao.prepareStatement(sql);
        stmt.setInt(1, idAcervo);
        stmt.setString(2, data.toString());
        stmt.setString(3, motivo);
        stmt.setString(4, idFuncionario);
        if(stmt.execute()/*Executa comando*/){
            //Mensagem de exito-------------
        }else{
            //Mensagem de erro-------------
        }
        stmt.close();//Fecha statement
        conexao.close();
    }
    
    /*public String[][] retornaAcervos(String nomeAcervo) throws SQLException, ClassNotFoundException{
        int i = 0;
        String sql = "SELECT * FROM acervo WHERE nome = '" + nomeAcervo + "' ORDER BY id";
        PreparedStatement stmt = conexao.prepareStatement(sql);
        ResultSet rs = stmt.executeQuery();
        String[][] dados = new String [rs.getFetchSize()][5];
        while(rs.next()){
          for(int j=0;j<5;j++){
             if(j==0){
               dados[i][j] = Integer.toString(rs.getInt("id"));
             }if(j==1){
               dados[i][j] =  rs.getString("nome");
             }if(j==2){
               dados[i][j] =  rs.getString("local");  
             }if(j==3){
               dados[i][j] =  rs.getString("ano");  
             }if(j==4){
               dados[i][j] =  rs.getString("editora");  
             }
          }
          i++;
        }
        return dados;
    }
    
    public int retornaId(String nome) throws SQLException, ClassNotFoundException{
        Connection conexao = new ConnectionFactory().getConnection();
        String sql = "SELECT * FROM acervo WHERE nome = '" + nome + "'";
        PreparedStatement stmt = conexao.prepareStatement(sql);
        ResultSet rs = stmt.executeQuery();
        int id = rs.getInt("id");
        stmt.close();
        conexao.close();
        return id;
    }*/
    
    public boolean existeAcervo(int idAcervo) throws SQLException, ClassNotFoundException{
        String sql = "SELECT * FROM acervo WHERE id = '" + idAcervo + "'";
        PreparedStatement stmt = conexao.prepareStatement(sql);
        if(stmt.execute()){
            stmt.close();
            conexao.close();
            return true;
        }else{
            stmt.close();
            conexao.close();
            return false;
        }
    }
    
    public boolean acervoAtivo(int idAcervo) throws SQLException, ClassNotFoundException{
        String sql = "SELECT * FROM acervo WHERE id = '" + idAcervo + "'";
        PreparedStatement stmt = conexao.prepareStatement(sql);
        ResultSet rs = stmt.executeQuery();
        return rs.getString("ativo")=="S";
    }
}
