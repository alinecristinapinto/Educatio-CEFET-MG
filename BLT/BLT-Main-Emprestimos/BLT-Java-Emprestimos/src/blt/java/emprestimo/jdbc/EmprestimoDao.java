package blt.java.emprestimo.jdbc;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import blt.java.emprestimo.model.Emprestimo;
import blt.java.emprestimo.model.Reserva;
import blt.java.emprestimo.util.DataUtil;
import java.text.ParseException;

public class EmprestimoDao {
	 // a conexão com o banco de dados
	  private final Connection conexao;

	  public EmprestimoDao() {
	    this.conexao = new CriaConexao().getConexao();
	  }

	  public void adicionaEmprestimo(Emprestimo emprestimo){
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
                        stmt.setString(5, "");
                        stmt.setString(6, "");
		        stmt.setString(7, "S");

		        // executa
		        stmt.execute();
		        stmt.close();
		    } catch (SQLException e) {
		        throw new RuntimeException(e);
		    }
		}
          
          public void adicionaReserva(Reserva reserva){
		    String sql = "insert into reservas " +
                    "(idAluno, idAcervo, dataReserva, tempoEspera, emprestou, ativo)" +
                    " values (?,?,?,?,?,?)";

		    try {
		        // prepared statement para inserção
		        PreparedStatement stmt = conexao.prepareStatement(sql);

		        // seta os valores
		        stmt.setString(1, reserva.getIdAluno());
		        stmt.setInt(2, reserva.getIdAcervo());
		        stmt.setString(3, reserva.getDataReserva());
                        stmt.setLong(4, reserva.getTempoEspera());
                        stmt.setString(5, "N");
		        stmt.setString(6, "S");

		        // executa
		        stmt.execute();
		        stmt.close();
		    } catch (SQLException e) {
		        throw new RuntimeException(e);
		    }
		}
          
          public boolean existeEmprestimo(Emprestimo emprestimo){
            try {
		         PreparedStatement stmt = this.conexao.
		                 prepareStatement("select * from emprestimos");
		         ResultSet rs = stmt.executeQuery();
                         boolean existe = false;
                         
		         while (rs.next()) {
                             if(emprestimo.getIdAcervo() == rs.getInt("idAcervo") && rs.getString("ativo").equals("S")){
                   
                                 emprestimo.setDataPrevisaoDevolucao(rs.getString("dataPrevisaoDevolucao"));
                                 existe = true;
                             }      
		         }
		         rs.close();
		         stmt.close();
		         return existe;
		     } catch (SQLException e) {
		         throw new RuntimeException(e);
		     }
           
          }
          
          public void atualizaReservas(long diasAtrasados, int idAcervo) throws ParseException{
              try {      
                                              
                    PreparedStatement stmt = conexao
	                 .prepareStatement("select * from reservas");
                    ResultSet rs = stmt.executeQuery();
                    String data, idAluno;
                 
                    while (rs.next()) {
                        if(idAcervo == rs.getInt("idAcervo") && rs.getString("ativo").equals("S")){

                            data = rs.getString("dataReserva");
                            idAluno = rs.getString("idAluno");
                            

                            atualizaReservasDados(DataUtil.adicionaXDias(data, (int) diasAtrasados), idAcervo, idAluno);
                        }      
                    }
                    stmt.close();
                    rs.close();
		     } catch (SQLException e) {
		         throw new RuntimeException(e);
		     }
          }
          
          private void atualizaReservasDados(String dataNova, int idAcervo, String idAluno){
               try {
		         PreparedStatement stmt = conexao
		                 .prepareStatement("update reservas set dataReserva=? where idAcervo=? AND idAluno=?");
		         stmt.setString(1, dataNova);
                         stmt.setInt(2, idAcervo);
                         stmt.setString(3, idAluno);
		         stmt.execute();
		         stmt.close();
		     } catch (SQLException e) {
		         throw new RuntimeException(e);
		     }
          }
          
          public void emprestaReserva(Reserva reserva){
              try {
		         PreparedStatement stmt = conexao
		                 .prepareStatement("update reservas set ativo=?, emprestou=? where idAcervo=? AND dataReserva=?");
		         stmt.setString(1, "N");
                         stmt.setString(2, "S");
                         stmt.setInt(3, reserva.getIdAcervo());
                         stmt.setString(4, reserva.getDataReserva());
		         stmt.execute();
		         stmt.close();
		     } catch (SQLException e) {
		         throw new RuntimeException(e);
		     }
          }
          
	  public boolean existeReservaAdicionar(Reserva reserva){
            try {
                PreparedStatement stmt = this.conexao.
                        prepareStatement("select * from reservas");
                ResultSet rs = stmt.executeQuery();
                boolean existe = false;

                while (rs.next()) {
                    if(reserva.getIdAcervo() == rs.getInt("idAcervo") && rs.getString("ativo").equals("S")){

                        reserva.setDataReserva(rs.getString("dataReserva"));
                        existe = true;
                    }      
                }
                rs.close();
                stmt.close();
                return existe;
            } catch (SQLException e) {
                throw new RuntimeException(e);
            }

          }
          
          public boolean existeReservaRemover(Reserva reserva){
            try {
                PreparedStatement stmt = this.conexao.
                        prepareStatement("select * from reservas");
                ResultSet rs = stmt.executeQuery();
                boolean existe = false;

                while (rs.next()) {
                    if(reserva.getIdAcervo() == rs.getInt("idAcervo") && rs.getString("ativo").equals("S")){

                        reserva.setDataReserva(rs.getString("dataReserva"));
                        reserva.setIdAluno(rs.getString("idAluno"));
                        existe = true;
                        break;
                    }      
                }
                rs.close();
                stmt.close();
                return existe;
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
		                 .prepareStatement("update emprestimos set ativo=?, dataDevolucao=?, multa=? where idAcervo=? AND idAluno=?");
		         stmt.setString(1, "N");
                         stmt.setString(2, emprestimo.getDataDevolucao());
                         stmt.setLong(3, emprestimo.getMulta());
		         stmt.setInt(4, emprestimo.getIdAcervo());
                         stmt.setString(5, emprestimo.getIdAluno());
		         stmt.execute();
		         stmt.close();
		     } catch (SQLException e) {
		         throw new RuntimeException(e);
		     }
		 }
          
}
