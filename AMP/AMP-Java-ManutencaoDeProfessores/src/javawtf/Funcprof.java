package javawtf;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;

public class Funcprof {
    
    private Professor p1;   
    private Connection conexao;
 
    public Funcprof(Professor p1){
        this.p1 = new Professor();
        this.p1 = p1;
       
    }
    
    public Funcprof(){
        
    }
   
    
    public void abrebd () throws SQLException{
        String url= "jdbc:mysql://localhost:3307/educatio";
            try{
                Class.forName("com.mysql.jdbc.Driver");
                conexao = DriverManager.getConnection(url,"root","usbw");
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
     
    public void addprofessor(){
        p1.ativo = "s";
        String sql = "INSERT INTO funcionario ( idSiape, idDepto, nome, titulacao, hierarquia, senha, foto, ativo) values ( ?, ?, ?, ?, ?, ?, ?, ?)";
        PreparedStatement pstmt;
        try {
            pstmt = conexao.prepareStatement(sql);
            pstmt.setInt(1, p1.siape);
            pstmt.setInt(2, p1.depto);  
            pstmt.setString(3, p1.nome);
            pstmt.setString(4, p1.titulacao);
            pstmt.setString(5, p1.hierarquia);
            pstmt.setString(6, p1.senha);
            pstmt.setString(7, "aaaa");
            pstmt.setString(8, p1.ativo);
            pstmt.execute();           
        }
        
        catch (SQLException ex){
            System.out.println("erro na insercao de dados" + ex);
        }       
    }
       
    public void deleteprofessor(){
        p1.ativo = "n";        
        String sql = " UPDATE funcionario SET idDepto = ?, nome = ?, titulacao = ?, hierarquia = ?, senha = ?, foto = ?, ativo = ? WHERE idSiape = ?";
        PreparedStatement pstmt;
        try {
            pstmt = conexao.prepareStatement(sql);           
            pstmt.setInt(1, p1.depto);  
            pstmt.setString(2, p1.nome);
            pstmt.setString(3, p1.titulacao);
            pstmt.setString(4, p1.hierarquia);
            pstmt.setString(5, p1.senha);
            pstmt.setString(6, "aaaa");            
            pstmt.setString(7, p1.ativo);  
            pstmt.setInt(8, 999999999);
            pstmt.executeUpdate();
        }
        catch (SQLException ex ){
            System.out.println("erro na alteracao de dados" + ex);
        }
    } 
    
    public Professor returnprofessor(){
        return p1;   // retorna o professor que está sendo usado atualmente     
    }
               
    
    public void searchprofessor(){
        
    }


    public void setP1(Professor p1) {
        this.p1 = p1;
    }
}
