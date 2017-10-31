package blt.java.emprestimo.jdbc;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import blt.java.emprestimo.model.Emprestimo;

public class EmprestimoDao {
	 // a conexão com o banco de dados
	  private final Connection conexao;

	  public EmprestimoDao() {
	    this.conexao = new CriaConexao().getConexao();
	  }

	  public void adiciona(Emprestimo emprestimo){
		    String sql = "insert into emprestimos " +
                    "(idAluno, idAcervo, dataEmprestimo, dataPrevisaoDevolucao, dataDevolucao, multa, ativo)" +
                    " values (?,?,?,?,?,?,?)";

		    try {
		        // prepared statement para inserção
		        PreparedStatement stmt = conexao.prepareStatement(sql);

		        // seta os valores
		        stmt.setString(1, emprestimo.getIdAluno());
		        stmt.setInt(2, emprestimo.getIdAcervo());
		        stmt.setString(3, emprestimo.getDataEmprestimo());
                        stmt.setString(4, emprestimo.getDataPrevisaoDevolucao());
                        stmt.setString(5, emprestimo.getDataDevolucao());
                        stmt.setLong(6, emprestimo.getMulta());
		        stmt.setString(7, "S");

		        // executa
		        stmt.execute();
		        stmt.close();
		    } catch (SQLException e) {
		        throw new RuntimeException(e);
		    }
		}

	  public List<Emprestimo> getLista() {
		     try {
		         List<Emprestimo> emprestimos = new ArrayList<Emprestimo>();
		         PreparedStatement stmt = this.conexao.
		                 prepareStatement("select * from emprestimos");
		         ResultSet rs = stmt.executeQuery();

		         while (rs.next()) {
		             // criando o objeto Emprestimo
		             Emprestimo emprestimo = new Emprestimo();
                             
		             emprestimo.setIdAluno(rs.getString("idAluno"));
		             emprestimo.setIdAcervo(rs.getInt("idAcervo"));
		             emprestimo.setDataEmprestimo(rs.getString("dataEmprestimo"));
                             emprestimo.setDataPrevisaoDevolucao(rs.getString("dataPrevisaoDevolucao"));
                             emprestimo.setDataDevolucao(rs.getString("dataDevolucao"));
                             emprestimo.setMulta(rs.getLong("multa"));
		             if(rs.getString("ativo").equals( "S")){
		             // adicionando o objeto à lista somente se estiver ativo
		             emprestimos.add(emprestimo);
		             }
		         }
		         rs.close();
		         stmt.close();
		         return emprestimos;
		     } catch (SQLException e) {
		         throw new RuntimeException(e);
		     }
		 }

	  public void remove(Emprestimo emprestimo) {
		     try {
		         PreparedStatement stmt = conexao
		                 .prepareStatement("update emprestimos set ativo=? where idAluno=?");
		         stmt.setString(1, "N");
		         stmt.setString(2, emprestimo.getIdAluno());
		         stmt.execute();
		         stmt.close();
		     } catch (SQLException e) {
		         throw new RuntimeException(e);
		     }
		 }
}
