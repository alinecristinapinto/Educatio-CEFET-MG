package ch.makery.address.model;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class ConnectionFactory {

    private static String url = "jdbc:mysql://localhost/educatio" ;
    private static String usuario = "root";
    private static String senha = "";
    private static String driver = "com.mysql.jdbc.Driver";
    
    public static Connection getConnection() throws SQLException, ClassNotFoundException {
        try{
         Class.forName(driver);
        }catch(ClassNotFoundException e){
            throw new RuntimeException(e);
        }
        try {
            return DriverManager.getConnection(url, usuario, senha);
        } catch (SQLException e) {
            throw new RuntimeException(e);
        }
    }
}