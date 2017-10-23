/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatorioobrasdescartadas;

import com.mysql.jdbc.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

/**
 *
 * @author Aluno
 */
public class BancoDeDados {
    private Connection link = null;
    
    public BancoDeDados() throws SQLException{
        try{
            Class.forName("com.mysql.jdbc.Driver");
        }
        catch(ClassNotFoundException e){
            System.err.println("Driver não encontrado.");
        }
        System.err.println("Driver encontrado com sucesso!");
        link = (Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
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
        resultado.next(); 
        return resultado;
    }    
    
}
