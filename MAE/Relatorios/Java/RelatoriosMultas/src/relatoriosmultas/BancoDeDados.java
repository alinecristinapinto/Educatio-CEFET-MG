
package relatoriosmultas;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class BancoDeDados {
    private com.mysql.jdbc.Connection link = null;
    
    public BancoDeDados() throws SQLException{
        try{
            Class.forName("com.mysql.jdbc.Driver");
        }
        catch(ClassNotFoundException e){
            System.err.println("Driver não encontrado.");
        }
        System.err.println("Driver encontrado com sucesso!");
        link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
        if (link != null){
            System.err.println("Conexão realizada com sucesso!");
        }else{
            System.err.println("Não foi possível realizar a conexão.");
        }
    }
    
    public ResultSet selecionarRegistros(String tabela, String pesquisa, String pesquisado) throws SQLException{
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "` WHERE " + pesquisa + " = \'" + pesquisado + "\'";
        ResultSet resultado = comando.executeQuery(query); 
        return resultado;
    }  
   
    
}
