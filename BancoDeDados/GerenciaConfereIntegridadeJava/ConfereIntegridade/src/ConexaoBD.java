import java.io.InputStream;
import java.sql.*;
import javax.swing.ImageIcon;


public class ConexaoBD {
    
    public Connection conexao;
    
    public void conexaoServidor (String porta, String bancoDeDados, String usuario, String senha) throws ClassNotFoundException, SQLException 
    {
        String driverName = "com.mysql.jdbc.Driver";
        Class.forName(driverName);
        
        conexao = DriverManager.getConnection("jdbc:mysql://localhost:" + porta + "/"+bancoDeDados, usuario, senha);

        if (conexao != null) 
        {
            System.out.println("Conectado com sucesso");
        } 
        else 
        {
            System.out.println("Não conectado");
        }
    }
    
    /*
    public void insercaoElementoBD (String tabela, Object [] elementos) throws SQLException {
        Statement st = conexao.createStatement();
        
        String e = "(";
        
        for (int i = 0; i < elementos.length; i++) {
            e += "?";
            if (i + 1 <= elementos.length) e += ",";
        }
        e += ")";
        
        PreparedStatement pre = conexao.prepareStatement("INSERT INTO "+tabela+" VALUES "+e);
        for (int i = 1; i <= elementos.length; i++) {
            pre.setObject(i, elementos[i]);
            pre.executeUpdate();
        }
        pre.close();
        
    }
    */
    
    //public ResultSet selecionaElementoBD () {}
    
    //public void atualizaElementoBD () {}
    
    //public void insereImagemBD () {}
    
    //public ImageIcon selecionaImagemBD () {}
    
}
