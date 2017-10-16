package ch.makery.address.jdbc;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;

import ch.makery.address.model.Disciplina;

public class DisciplinaDao {
	 // a conexão com o banco de dados
	  private Connection connection;

	  public DisciplinaDao() {
	    this.connection = new ConnectionFactory().getConnection();
	  }

	  public void adiciona(Disciplina disciplina) {
		    String sql = "insert into disciplinas " +
                    "(idTurma,nome, cargaHorariaMin, ativo)" +
                    " values (?,?,?,?)";

		    try {
		        // prepared statement para inserção
		        PreparedStatement stmt = connection.prepareStatement(sql);

		        // seta os valores

		        stmt.setInt(1,disciplina.getIdTurma());
		        stmt.setString(2,disciplina.getNome());
		        stmt.setInt(3,disciplina.getCargaHorariaMin());
		        stmt.setString(4, "s");

		        // executa
		        stmt.execute();
		        stmt.close();
		    } catch (SQLException e) {
		        throw new RuntimeException(e);
		    }
		}
}
