/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutençãodeturmas;

import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

/**
 *
 * @author mathe
 */
public class BancoDeDados<E> {
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
   
    public void criaTurma(int id, int idCurso, String nome) throws SQLException{
        Statement comando = link.createStatement();
        String query = "INSERT INTO `turmas` (`id`, `idCurso`, `nome`, `ativo`) VALUES ('" + id + "', '" + idCurso + "', '" + nome + "', 'S');";
        comando.executeUpdate(query);
    }
    
    public void apagaTurma(int id) throws SQLException{
        Statement comando = link.createStatement();
        String query = "UPDATE `turmas` SET `ativo` = 'N' WHERE `turmas`.`id` = " + id;
        comando.executeUpdate(query);
    }
    
    public void alteraTurma(String item, E valorItemNovo, E valorItemAntigo) throws SQLException{
        Statement comando = link.createStatement();
        String query = "UPDATE `turmas` SET `" + item + "` = '" + valorItemNovo + "' WHERE `" + item + "` = " + valorItemAntigo;
        comando.executeUpdate(query);
    }
}
