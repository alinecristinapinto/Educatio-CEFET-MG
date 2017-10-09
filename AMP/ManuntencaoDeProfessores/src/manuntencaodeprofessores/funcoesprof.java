package manuntencaodeprofessores;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;

public class funcoesprof  {
    
    private professor p1;    
 
    public funcoesprof(professor p1){
        this.p1 = new professor();
        this.p1 = p1;
        //instancia o professor que vai ser usado nas outras funcoes
    }
    
    public void abrebd(){
        String url= "jdbc:odbc:Banco_LP";
            try{
                Class.forName("sun.jdbc.odbc.JdbcObdcDriver");
                Connection conexao = DriverManager.getConnection(url,"root","");
                System.out.println("conexao realizada com sucesso");       
            }
            
            catch  (ClassNotFoundException erro) {
                 System.out.println("driver mysql nao encontrado");
            }
            catch (SQLException erro) {
                System.out.println("problemas na conexao com banco de dados");
            }        
    }
    
    public void fechabd(){
          // conexao.close();
    }
     
    public void addprofessor(){
        p1.ativo = "s";
        String sql = "INSERT INTO bd ( siape, depto, nome, titulacao, ativo) values ( ?, ?, ?, ?, ?)";
        PreparedStatement pstmt;
        try {
            pstmt = null; //conexao.prepareStatement(sql);
            pstmt.setInt(1, p1.siape);
            pstmt.setInt(2, p1.depto);  
            pstmt.setString(3, p1.nome);
            pstmt.setString(4, p1.titulacao);
            pstmt.setString(5, p1.ativo);
        }
        
        catch (SQLException ex){
            System.out.println("erro na insercao de dados");
        }       
    }
       
    public void deleteprofessor(){
        p1.ativo = "n";
        String sql = " UPDATE bd SET "
                   + "siape = ?"
                   + "depto"
                   + "nome = ?"
                   + "titulacao = ?"
                   + "ativo = ?";
        PreparedStatement pstmt;
        try {
            pstmt = null; //conexao.prepareStatement(sql)
            pstmt.setInt(1, p1.siape);
            pstmt.setInt(2, p1.depto);  
            pstmt.setString(3, p1.nome);
            pstmt.setString(4, p1.titulacao);
            pstmt.setString(5, p1.ativo);
        }
        catch (SQLException ex ){
            System.out.println("erro na insercao de dados");
        }
    } 
    
    public professor returnprofessor(){
        return p1;   // retorna o professor que está sendo usado atualmente     
    }
        
    public void alteraprofessor(){
        
    }            
    
    public void searchprofessor(){
        // usando stanceof para descobrir qual variavel que é e depois procurar pelas informacoes no BD
    }
    
    
    
}
