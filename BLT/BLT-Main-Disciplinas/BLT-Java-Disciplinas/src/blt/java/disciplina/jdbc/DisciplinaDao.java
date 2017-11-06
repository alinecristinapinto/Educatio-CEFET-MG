package blt.java.disciplina.jdbc;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import blt.java.disciplina.model.Disciplina;

public class DisciplinaDao {
	 // a conexão com o banco de dados
	  private Connection conexao;

	  public DisciplinaDao() {
	    this.conexao = new CriaConexao().getConexao();
	  }

	  public void adiciona(Disciplina disciplina){
		    String sql = "insert into disciplinas " +
                    "(idTurma,nome, cargaHorariaMin, ativo)" +
                    " values (?,?,?,?)";

		    try {
		        // prepared statement para inserção
		        PreparedStatement stmt = conexao.prepareStatement(sql);

		        // seta os valores
		        stmt.setInt(1,disciplina.getIdTurma());
		        stmt.setString(2,disciplina.getNome());
		        stmt.setInt(3,disciplina.getCargaHorariaMin());
		        stmt.setString(4, "S");

		        // executa
		        stmt.execute();
		        stmt.close();
		    } catch (SQLException e) {
		        throw new RuntimeException(e);
		    }
		}

	  public void altera(Disciplina disciplina, String nome) {
		     String sql = "update disciplinas set idTurma=?, cargaHorariaMin=?, nome=? where nome=?";
		     try {
		         PreparedStatement stmt = conexao.prepareStatement(sql);
		         stmt.setInt(1, disciplina.getIdTurma());
		         stmt.setInt(2, disciplina.getCargaHorariaMin());
		         stmt.setString(3, disciplina.getNome());
		         stmt.setString(4, nome);
		         stmt.execute();
		         stmt.close();
		     } catch (SQLException e) {
		         throw new RuntimeException(e);
		     }
		 }

	  public List<Disciplina> getLista() {
		     try {
		         List<Disciplina> disciplinas = new ArrayList<Disciplina>();
		         PreparedStatement stmt = this.conexao.
		                 prepareStatement("select * from disciplinas");
		         ResultSet rs = stmt.executeQuery();

		         while (rs.next()) {
		             // criando o objeto Contato
		             Disciplina disciplina = new Disciplina();
		             disciplina.setIdTurma(rs.getInt("idTurma"));
		             disciplina.setCargaHorariaMin(rs.getInt("cargaHorariaMin"));
		             disciplina.setNome(rs.getString("nome"));
		             if(rs.getString("ativo").equals( "S")){
		             // adicionando o objeto à lista somente se estiver ativo
		             disciplinas.add(disciplina);
		             }
		         }
		         rs.close();
		         stmt.close();
		         return disciplinas;
		     } catch (SQLException e) {
		         throw new RuntimeException(e);
		     }
		 }

	  public void remove(Disciplina disciplina) {
		     try {
		         PreparedStatement stmt = conexao
		                 .prepareStatement("update disciplinas set ativo=? where nome=?");
		         stmt.setString(1, "N");
		         stmt.setString(2, disciplina.getNome());
		         stmt.execute();
		         stmt.close();
		     } catch (SQLException e) {
		         throw new RuntimeException(e);
		     }
		 }
}
