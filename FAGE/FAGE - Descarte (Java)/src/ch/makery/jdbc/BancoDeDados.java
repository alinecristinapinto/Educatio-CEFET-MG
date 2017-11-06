package ch.makery.jdbc;

import java.sql.Connection;
import java.util.Date;
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
        String sql = "SELECT tipo FROM acervo WHERE id = '?'";
        PreparedStatement stmt = conexao.prepareStatement(sql);
        stmt.setInt(1, idAcervo);
        ResultSet rs = stmt.executeQuery();
        String tipo = rs.getString(0);
        if("periodicos".equals(tipo)){//Se for um periodico exclui partes tambem
            sql="SELECT * FROM periodicos WHERE idAcervo = " + idAcervo;
            rs = stmt.executeQuery(sql);
            sql = "UPDATE 'partes' SET 'ativo' = 'N' WHERE idPeriodico = " + rs.getInt("id");
            stmt.executeQuery(sql);
        }
        sql = "UPDATE " + tipo + " SET 'ativo' = 'N' WHERE idAcervo = '?'"; //Comando
        stmt.setInt(1, idAcervo);
        stmt.executeQuery(sql);
        stmt.close();
    }
    
    public void deletaAcervo(int idAcervo) throws SQLException, ClassNotFoundException{
        deletaExemplar(idAcervo);
        String sql = "UPDATE acervo SET ativo = 'N' WHERE id = '?' ";//Comando
        PreparedStatement stmt = conexao.prepareStatement(sql);
        stmt.setInt(1, idAcervo);
        stmt.execute();
        stmt.close();//Fecha statement
    }
    
    public void guardaDescarte(Integer idAcervo, String data, String motivo, String idFuncionario) throws SQLException, ClassNotFoundException{
        String sql = "INSERT INTO descartes " + "(idAcervo, dataDescarte, motivos, operador)" + " values (?,?,?,?)";//Comando
        PreparedStatement stmt = conexao.prepareStatement(sql);
        stmt.setInt(1, idAcervo);
        stmt.setString(2, data);
        stmt.setString(3, motivo);
        stmt.setString(4, idFuncionario);
        stmt.execute();
        stmt.close();//Fecha statement
    }
    
}
