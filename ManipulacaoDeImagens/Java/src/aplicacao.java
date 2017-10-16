import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.sql.*;
import javax.swing.ImageIcon;

public class aplicacao {

    public static void main(String[] args) throws ClassNotFoundException, SQLException, FileNotFoundException, IOException {
        String driverName = "com.mysql.jdbc.Driver";
        Class.forName(driverName);
        
        Connection connection = null;
        
        connection = DriverManager.getConnection("jdbc:mysql://localhost:3307/testeimagem", "root", "usbw");
        if (connection != null) {
            System.out.println("conectado com sucesso");
        } else {
            System.out.println("não conectado");
        }
        
        //
        // Inserindo a imagem no BD
        //
        Statement st = connection.createStatement();
        File imgfile = new File(""); 
        // caminho da imagem entre as aspas

        FileInputStream fin = new FileInputStream(imgfile);

        PreparedStatement pre = connection.prepareStatement("insert into imagens (imagemUm) values (?)");
        
        pre.setBinaryStream(1,(InputStream)fin,(int)imgfile.length());
        pre.executeUpdate();
        System.out.println("Successfully inserted the file into the database!");

        pre.close();
        
        //
        // Selecionando a imagem do BD
        //
        Statement stmt = connection.createStatement();
        ResultSet rs = stmt.executeQuery("select imagemUm from imagens where id=7");
            rs.first();
            rs = stmt.getResultSet();
            Blob blob = rs.getBlob("imagemUm");
            int blobLength = (int) blob.length();  
            byte[] blobAsBytes = blob.getBytes(1, blobLength);
            ImageIcon imagemExibida = new ImageIcon(blobAsBytes);

    }
}