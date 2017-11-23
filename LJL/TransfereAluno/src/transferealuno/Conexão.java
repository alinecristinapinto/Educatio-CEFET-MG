package transferealuno;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;


public class Conexão {
    
    public Connection getConnection() {
	try {
	    return DriverManager.getConnection(
            "jdbc:mysql://localhost:3307/educatio", "root", "");
	} catch (SQLException e) {
	    throw new RuntimeException(e);
	}
    }
    
}

