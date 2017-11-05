package ch.makery.jdbc;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class ConectaComBD {

    private static final String URL = "jdbc:mysql://localhost/educatio" ;
    private static final String USUARIO = "root";
    private static final String SENHA = "";
    private static final String DRIVER = "com.mysql.jdbc.Driver";
    
    public static Connection getConnection() throws SQLException, ClassNotFoundException {
        try{
         Class.forName(DRIVER);
        }catch(ClassNotFoundException e){
            throw new RuntimeException(e);
        }
        try {
            return DriverManager.getConnection(URL, USUARIO, SENHA);
        } catch (SQLException e) {
            throw new RuntimeException(e);
        }
    }
}