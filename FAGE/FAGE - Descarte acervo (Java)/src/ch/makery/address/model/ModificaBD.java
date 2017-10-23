package ch.makery.address.model;

import ch.makery.address.model.ConnectionFactory;
import java.sql.Connection;
import java.util.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class ModificaBD {
    
    private void deletaExemplar(int idAcervo, String tipo) throws SQLException, ClassNotFoundException{
        Connection conexao = new ConnectionFactory().getConnection();
        String sql = null;
        PreparedStatement stmt = conexao.prepareStatement(sql);
        ResultSet rs = stmt.executeQuery();
        if(tipo=="periodicos"){//Se for um periodico exclui partes tambem
            sql="SELECT * FROM periodicos WHERE idAcervo = " + idAcervo;
            rs = stmt.executeQuery(sql);
            sql = "UPDATE 'partes' SET 'ativo' = 'N' WHERE idPeriodico = "+rs.getInt("id");
            stmt.executeQuery(sql);
            if(stmt.execute(sql)/*Executa comando*/){
                //Mensagem de exito-------------
            }else{
                //Mensagem de erro-------------
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
        Connection conexao = new ConnectionFactory().getConnection();
        deletaExemplar(idAcervo,tipo);
        String sql = "UPDATE 'acervo' SET 'ativo' = 'N' WHERE id = " + idAcervo;//Comando
        PreparedStatement stmt = conexao.prepareStatement(sql);
        if(stmt.execute()/*Executa comando*/){
            //Mensagem de exito----------
        }else{
            //Mensagem de erro-----------
        }
        stmt.close();//Fecha statement
        conexao.close();
    }
    
    public void guardaDescarte(String idAcervo, Date data, String motivo, String idFuncionario) throws SQLException, ClassNotFoundException{
        Connection conexao = new ConnectionFactory().getConnection();
        String sql = "INSERT INTO descartes " + "(idAcervo, dataDescarte, motivos, operador)" + " values (?,?,?,?)";//Comando
        PreparedStatement stmt = conexao.prepareStatement(sql);
        stmt.setString(1, idAcervo);
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
    
    public String[] retornaAcervos(String nomeAcervo) throws SQLException, ClassNotFoundException{
        int i = 0;
        Connection conexao = new ConnectionFactory().getConnection();
        String sql = "SELECT * FROM acervo WHERE nome = '" + nomeAcervo + "' ORDER BY id";
        PreparedStatement stmt = conexao.prepareStatement(sql);
        ResultSet rs = stmt.executeQuery();
        String[] dados = new String [rs.getFetchSize()];
        while(rs.next()){
          dados[i] = "Nome: " + rs.getString("nome") + " Local: " +rs.getString("local") + " Ano: " + rs.getString("ano") + " Editora: " + rs.getString("editora");
          i++;
        }
        return dados;
    }
    
    /*public int retornaId(String nome) throws SQLException, ClassNotFoundException{
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
        Connection conexao = new ConnectionFactory().getConnection();
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
        Connection conexao = new ConnectionFactory().getConnection();
        String sql = "SELECT * FROM acervo WHERE id = '" + idAcervo + "'";
        PreparedStatement stmt = conexao.prepareStatement(sql);
        ResultSet rs = stmt.executeQuery();
        if(rs.getString("ativo")=="S"){
            return true;
        }else{
            return false;
        }
    }
}
