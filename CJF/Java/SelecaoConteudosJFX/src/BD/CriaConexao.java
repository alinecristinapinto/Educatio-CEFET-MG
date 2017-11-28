/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package BD;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 *
 * @author Carlos
 */
public class CriaConexao {
    public Connection getConexao() throws SQLException{
        try{
            return DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio?useSSL=true","root","");
        }catch (SQLException e){
            throw new RuntimeException(e);
        }
    }
}
