
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class VerificacaoIntegridade 
{
    public static void main(String[] args) throws ClassNotFoundException, SQLException 
    {
        VerificadorDeIntegridade v = new VerificadorDeIntegridade();
        v.confereIntegridade();
        System.out.println(v.retornaErros());
    }
    
}
