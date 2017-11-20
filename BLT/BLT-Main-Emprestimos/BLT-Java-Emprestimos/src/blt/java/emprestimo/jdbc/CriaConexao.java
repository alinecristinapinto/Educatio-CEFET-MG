package blt.java.emprestimo.jdbc;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;


public class CriaConexao {
	public Connection getConexao() {
	     try {
	         return DriverManager.getConnection(
	 "jdbc:mysql://localhost:3306/educatio", "root", "");
	     } catch (SQLException e) {
	         throw new RuntimeException(e);
	     }
	 }
}
