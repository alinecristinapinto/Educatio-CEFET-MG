import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class TesteConfereIntegridade 
{
    public static void main(String[] args) throws ClassNotFoundException, SQLException 
    {
        ConferidoresDeIntegridade v = new ConferidoresDeIntegridade();
        v.confereIntegridade();
        
        //System.err.println("Erros de integridade: Direção->De cima para baixo\n");
        System.out.println(v.retornaErros()+"\n\n");
        //System.err.println("Erros de integridade: Direção->De baixo para cima\n");
        System.out.println(v.retornaErrosReverso());
    }
    
}
