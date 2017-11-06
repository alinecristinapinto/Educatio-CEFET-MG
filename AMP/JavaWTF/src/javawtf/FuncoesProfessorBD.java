package javawtf;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import javax.swing.JOptionPane;

public class FuncoesProfessorBD {
    
    private Professor prof;   
    private Connection conexao;
 
    public FuncoesProfessorBD(Professor prof){
        this.prof = new Professor();
        this.prof = prof;
       
    }
    
    public FuncoesProfessorBD(){
        
    }   
    
    public void abrebd () throws SQLException{
        String url= "jdbc:mysql://localhost:3306/educatio";
            try{
                Class.forName("com.mysql.jdbc.Driver");
                conexao = DriverManager.getConnection(url,"root","");
                System.out.println("conexao realizada com sucesso");       
            }
            
            catch  (ClassNotFoundException erro) {
                 System.out.println("driver mysql nao encontrado");
            }
            catch (SQLException erro) {
                System.out.println("problemas na conexao com banco de dados");
            }        
    }
    
    public void fechabd() throws SQLException{
          conexao.close();
    }
     
    public void adicionaProfessor(){
        prof.ativo = "S";
        String sql = "INSERT INTO funcionario ( idSiape, idDepto, nome, titulacao, hierarquia, senha, foto, ativo) values ( ?, ?, ?, ?, ?, ?, ?, ?)";
        PreparedStatement pstmt;
        try {
            pstmt = conexao.prepareStatement(sql);
            pstmt.setInt(1, prof.siape);
            pstmt.setInt(2, prof.depto);  
            pstmt.setString(3, prof.nome);
            pstmt.setString(4, prof.titulacao);
            pstmt.setString(5, prof.hierarquia);
            pstmt.setString(6, prof.senha);
            pstmt.setString(7, "aaaa");
            pstmt.setString(8, prof.ativo);
            pstmt.execute();           
        }
        
        catch (SQLException ex){
            System.out.println("erro na insercao de dados" + ex);
        }       
    }
       
    public void deletaProfessor(String determinante, String determinado){            
        String sql = " UPDATE funcionario SET ativo = ? WHERE " + determinante + " = ?";
        PreparedStatement pstmt;
        try {
            pstmt = conexao.prepareStatement(sql);                             
            pstmt.setString(1, "N");  
            pstmt.setString(2, determinado);
            pstmt.executeUpdate();
        }
        catch (SQLException ex ){
            System.out.println("erro na alteracao de dados" + ex);
        }
    } 
    
    public Professor retornaProfessor(){
        return prof;   // retorna o professor que está sendo usado atualmente     
    }               
    

    public void setP1(Professor prof) {
        this.prof = prof;
    }
    
    public void pesquisaProfessor(String determinante, String determinado) throws SQLException{
        ResultSet result;
        String sql_fetch = "SELECT * FROM funcionario WHERE "+ determinante + "='" + determinado + "'";
        Statement fetch = conexao.createStatement();
        result = fetch.executeQuery(sql_fetch);        
        while(result.next()){
            prof.titulacao = result.getString("titulacao"); 
            prof.siape = Integer.parseInt(result.getString("idSIAPE"));
            prof.depto = Integer.parseInt(result.getString("idDepto"));
            prof.nome = result.getString("nome");
            prof.ativo = result.getString("ativo");
            prof.hierarquia = result.getString("hierarquia");
            prof.senha = result.getString("senha");      
           
            prof.tostring();
        }
    }    
    
    public void alteraProfessor(String determinante, String determinado, String campo, String valor ) throws SQLException{
        String sql = "UPDATE funcionario  SET " + campo + "='" + valor + "' WHERE "+ determinante + "='" + determinado + "'";
        Statement pstmt = null;        
        try {
            pstmt = conexao.createStatement();
            pstmt.execute(sql);
        }
        catch(SQLException ex){
             System.out.println("erro na alteracao de dados" + ex);
        }
    }
     
       
}
