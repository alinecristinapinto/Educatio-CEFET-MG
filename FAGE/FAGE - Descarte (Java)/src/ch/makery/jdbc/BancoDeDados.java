package ch.makery.jdbc;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

public class BancoDeDados {
    private static Connection conexao;

    public BancoDeDados() {
        try {
            conexao = ConectaComBD.getConnection();
        } catch (SQLException | ClassNotFoundException ex) {
            Logger.getLogger(BancoDeDados.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    
    private void deletaExemplar(int idAcervo) throws SQLException, ClassNotFoundException{
        int i=0;
        String sql = "SELECT * FROM acervo WHERE id = '"+idAcervo+"'";
        PreparedStatement stmt = conexao.prepareStatement(sql);
        ResultSet rs = stmt.executeQuery();
        if(!rs.next()){
            System.out.println("Erro! Acervo sem nenhum exemplar");
            rs.close();
            return;
        }else{
            String tipo = rs.getString("tipo");
            
            switch (tipo) {
                case "Periódico":
                    tipo = "periodicos";
                break;
                case "Livro":
                    tipo = "livros";
                break;
                case "Acadêmico":
                    tipo = "academicos";
                break;
                case "Mídia":
                    tipo = "midias";
                break;
                default:
                    
                break;
            }
            
            if(tipo.equals("periodicos")){//Se for um periodico exclui partes tambem
                sql="SELECT * FROM periodicos WHERE idAcervo = " + idAcervo;
                rs = stmt.executeQuery(sql);
                if(!rs.next()){
                    System.out.println("Erro! Periodico sem nenhuma parte");
                    rs.close();
                    return;
                }else{
                    int idPeriodico = rs.getInt("id");
                    rs.close();
                    sql = "UPDATE partes SET ativo = 'N' WHERE idPeriodico = " + idPeriodico;
                    stmt.executeUpdate(sql);   
                }  
            }
            sql = "UPDATE " + tipo + " SET ativo = 'N' WHERE idAcervo = " + idAcervo; //Comando
            stmt.executeUpdate(sql);
        }
        stmt.close();
    }
    
    public void deletaAcervo(int idAcervo) throws SQLException, ClassNotFoundException{
        deletaExemplar(idAcervo);
        String sql = "UPDATE acervo SET ativo = 'N' WHERE id = " + idAcervo;//Comando
        PreparedStatement stmt = conexao.prepareStatement(sql);
        stmt.execute();
        stmt.close();//Fecha statement
    }
    
    public void guardaDescarte(Integer idAcervo, String data, String motivo, String idFuncionario) throws SQLException, ClassNotFoundException{
        String sql = "INSERT INTO descartes(idAcervo, idFuncionario, dataDescarte, motivos, ativo) values (?,?,?,?,?)";//Comando
        PreparedStatement stmt = conexao.prepareStatement(sql);
        stmt.setInt(1, idAcervo);
        stmt.setString(2, idFuncionario);
        stmt.setString(3, data);
        stmt.setString(4, motivo);
        stmt.setString(5, "S");
        stmt.execute();
        stmt.close();//Fecha statement
    }
    
}
