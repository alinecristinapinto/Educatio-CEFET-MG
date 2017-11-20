package ManutencaoCampi.model;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javax.swing.JOptionPane;

public class ManutencaoCampiBD{
  private Connection conn;
  private String[] dadosCampus;
  private String sql;
  private PreparedStatement stmt;
  
  public ManutencaoCampiBD()
  {
    dadosCampus = new String[3];
  }
  
  public void criaCampus(String nome, String cidade, String uf) throws java.sql.SQLException {
    conn = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
    dadosCampus[0] = nome;
    dadosCampus[1] = cidade;
    dadosCampus[2] = uf;
    sql = "INSERT INTO campi (nome, cidade, uf, ativo) values(?, ?, ?, ?)";
    stmt = conn.prepareStatement(sql);
    stmt.setString(1, dadosCampus[0]);
    stmt.setString(2, dadosCampus[1]);
    stmt.setString(3, dadosCampus[2]);
    stmt.setString(4, "S");
    stmt.execute();
    conn.close();
  }
  
  public String[] alteraCampus(String nomeAntigo, String nome, String cidade, String uf, boolean[] dadosSelecao) throws java.sql.SQLException {
    conn = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
    
    dadosCampus[0] = nome;
    dadosCampus[1] = cidade;
    dadosCampus[2] = uf;
    
    sql = "SELECT * FROM campi WHERE nome='"+nomeAntigo+"'";
    Statement fetch = conn.createStatement();
    ResultSet result = fetch.executeQuery(sql);
    result.next();
    int id=Integer.parseInt(result.getString("id"));
    
    sql = "UPDATE campi SET nome=?, cidade=?, uf=? WHERE nome='"+nomeAntigo+"'";
    stmt = conn.prepareStatement(sql);
            
    if (dadosSelecao[0] == true && dadosSelecao[1] == false && dadosSelecao[2] == false) 
    {
      stmt.setString(1, dadosCampus[0]);
      stmt.setString(2, result.getString("cidade"));
      stmt.setString(3, result.getString("uf"));
    }
    
    if (dadosSelecao[0] == true && dadosSelecao[1] == false && dadosSelecao[2] == true) 
    {
      stmt.setString(1, dadosCampus[0]);
      stmt.setString(2, result.getString("cidade"));
      stmt.setString(3, dadosCampus[2]);
    }
    
    else if (dadosSelecao[0] == true && dadosSelecao[1] == true && dadosSelecao[2] == false) 
    {
      stmt.setString(1, dadosCampus[0]);
      stmt.setString(2, dadosCampus[1]);
      stmt.setString(3, result.getString("uf"));
    }
    
    else if (dadosSelecao[0] == true && dadosSelecao[1] == true && dadosSelecao[2] == true) 
    {
      stmt.setString(1, dadosCampus[0]);
      stmt.setString(2, dadosCampus[1]);
      stmt.setString(3, dadosCampus[2]);
    }
    
    else if (dadosSelecao[0] == false && dadosSelecao[1] == false && dadosSelecao[2] == true) 
    {
      stmt.setString(1, result.getString("nome"));
      stmt.setString(2, result.getString("cidade"));
      stmt.setString(3, dadosCampus[2]);
    }
    
    else if (dadosSelecao[0] == false && dadosSelecao[1] == true && dadosSelecao[2] == true) 
    {
      stmt.setString(1, result.getString("nome"));
      stmt.setString(2, dadosCampus[1]);
      stmt.setString(3, dadosCampus[2]);
    }
    
    else if (dadosSelecao[0] == false && dadosSelecao[1] == true && dadosSelecao[2] == false) 
    {
      stmt.setString(1, result.getString("nome"));
      stmt.setString(2, dadosCampus[1]);
      stmt.setString(3, result.getString("uf"));
    }
    
    stmt.execute();
    result.close();
    
    sql = "SELECT * FROM campi WHERE id='"+id+"'";
    fetch = conn.createStatement();
    result = fetch.executeQuery(sql);
    result.next();
    
    String[] dadosCampusAlterado={result.getString("nome"), result.getString("cidade"), result.getString("uf")};
    result.close();
    conn.close();
    return dadosCampusAlterado;
  }
  
  public String[] deletaCampus(String nome) throws SQLException{
    conn = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
    String[] dadosCampusDeletado = new String[3];
    
    sql = "UPDATE campi SET ativo='N' where nome='"+nome+"'";
    stmt = conn.prepareStatement(sql);
    stmt.execute();
    
    sql = "SELECT * FROM campi WHERE nome='"+nome+"'";
    Statement fetch = conn.createStatement();
    ResultSet result = fetch.executeQuery(sql);
    result.next();
    
    dadosCampusDeletado[0]=result.getString("nome");
    dadosCampusDeletado[1]=result.getString("cidade");
    dadosCampusDeletado[2]=result.getString("uf");
    
    result.close();
    conn.close();
    return dadosCampusDeletado;
  }
  
  public String[] pesquisaCampus(String nome) throws SQLException{
        ResultSet result;
        conn = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");

        String sql_fetch = "SELECT * FROM campi WHERE nome='"+nome+"' AND ativo='S'";
        Statement fetch = conn.createStatement();
        result = fetch.executeQuery(sql_fetch);
        
        if(result.next()!=false){
            dadosCampus[0]=result.getString("nome");
            dadosCampus[1]=result.getString("cidade");
            dadosCampus[2]=result.getString("uf");
            conn.close();
            result.close();
            return dadosCampus;
        }
        else{
            conn.close();
            result.close();
            return null;
        }
  }
  
  public String[] campiEstaVazio(String nome) throws SQLException{
      ResultSet result;
        conn = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
        String sql_fetch = "SELECT id FROM campi WHERE nome='"+nome+"'";
        Statement fetch = conn.createStatement();
        
        result = fetch.executeQuery(sql_fetch);
        result.next();
        int idCampi=Integer.parseInt(result.getString("id"));
        
        result.close();
        
        sql_fetch = "SELECT * FROM deptos WHERE idCampi='"+idCampi+"'AND ativo='S'";
        result=fetch.executeQuery(sql_fetch);
        
        String[] nomesDeptos;
        int numDeptos = 0;
        int aux=0;
        
        while(result.next()){
            numDeptos++;
        }
        if(numDeptos==0){
            conn.close();
            return null;
        }
        else{
            result.first();
            nomesDeptos = new String[numDeptos];
            do{
                nomesDeptos[aux] = result.getString("nome");
                aux++;
            }
            while(result.next());
        }
        conn.close();
        return nomesDeptos;
  }
}

