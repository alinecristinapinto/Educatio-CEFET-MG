package ManutencaoDiarios.Modelo;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 *
 * @author Felipe
 */
public class ConnectionFactory {
    public Connection getConexao(){
        try{
            return DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
        }catch(SQLException e){
            throw new RuntimeException(e); 
        }
    }
}
