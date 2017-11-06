package educatio.app.view.Alunos.controlador;

import educatio.app.view.Alunos.controlador.modelo.Aluno;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.sql.*;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.scene.control.ComboBox;
import javafx.scene.control.TableView;

public class BancoDeDados {
    
    private final String nomeDoDriver = "com.mysql.jdbc.Driver";
    
    private final String servidor = "localhost";
    private final String nomeBancoDeDados = "educatio";
    private final String url = "jdbc:mysql://" + servidor + ":3307/" + nomeBancoDeDados + "?useSSL=false";
    private final String usuario = "root";
    private final String senha = "usbw";
    
    private Connection conexao = null;
    private ObservableList<String> nomeTurmas;

    
    public BancoDeDados() {
        try {
            Class.forName(nomeDoDriver);
            conexao = DriverManager.getConnection(url, usuario, senha);
        } catch (ClassNotFoundException | SQLException e) {
            System.out.println("Erro na Conexão com o Driver");
        }
    }
    
    public void enviaDados(String CPF, String NOME, String SEXO, String DATA, String LOGRADOURO, String NUMERO,
            String COMPLEMENTO, String BAIRRO, String CIDADE, String CEP, String UF, String EMAIL, String IMAGEM, int IDTURMA) {
        
        try {
            String sql = "INSERT INTO alunos "
                    + "("
                    + " idCPF,"
                    + " idTurma,"
                    + " nome,"
                    + " sexo,"
                    + " nascimento,"
                    + " logradouro,"
                    + " numeroLogradouro,"
                    + " complemento,"
                    + " bairro,"
                    + " cidade,"
                    + " CEP,"
                    + " UF,"
                    + " email,"
                    + " foto,"
                    + " senha,"
                    + " ativo"
                    + ") "
                    + "VALUES"
                    + "("
                    + " ?," //01 - idCPF
                    + " ?," //02 - idTurma
                    + " ?," //03 - nome
                    + " ?," //04 - sexo
                    + " ?," //05 - nascimento
                    + " ?," //06 - logadouro
                    + " ?," //07 - numerologadouro
                    + " ?," //08 - complemento
                    + " ?," //09 - bairro
                    + " ?," //10 - cidade
                    + " ?," //11 - CEP
                    + " ?," //12 - UF
                    + " ?," //13 - email
                    + " ?," //14 - foto
                    + " ?," //15 - senha
                    + " ?" //16 - ativo
                    + ")";
            PreparedStatement ps = conexao.prepareStatement(sql);
            
            ps.setString(1, CPF);
            ps.setInt(2, IDTURMA);
            ps.setString(3, NOME);
            ps.setString(4, SEXO);
            ps.setString(5, DATA);
            ps.setString(6, LOGRADOURO);
            ps.setString(7, NUMERO);
            ps.setString(8, COMPLEMENTO);
            ps.setString(9, BAIRRO);
            ps.setString(10, CIDADE);
            ps.setString(11, CEP);
            ps.setString(12, UF);
            ps.setString(13, EMAIL);
            
            try {
                File imgfile = new File(IMAGEM);
                FileInputStream fin = new FileInputStream(imgfile);
                ps.setBinaryStream(14, (InputStream) fin, (int) imgfile.length());
            } catch (FileNotFoundException ex) {
                Logger.getLogger(BancoDeDados.class.getName()).log(Level.SEVERE, null, ex);
            }
            
            ps.setString(15, "");
            ps.setString(16, "N");
            
            ps.execute();
            
        } catch (SQLException e) {
            System.out.println(e.getErrorCode());
            System.out.println(e.getMessage());
            System.out.println(e.getSQLState());
        }
    }
    /*
    public ComboBox ObtemTurmas(ComboBox turma) {
        try {
            nomeTurmas = FXCollections.observableArrayList();
            Statement stmt = conexao.createStatement();
            String sql = "SELECT * FROM turmas";
            ResultSet resultado = stmt.executeQuery(sql);
            
            while (resultado.next()) {
                nomeTurmas.add(resultado.getString(3));
            }
            resultado.close();
        } catch (SQLException erro) {
            System.out.println(" Erro ao consultar : " + erro);
        }
        turma.setItems(nomeTurmas);
        return turma;
    }
   */ 
    public int ObtemIdTurma(String turma) {
        Statement stmt;
        try {
            stmt = conexao.createStatement();
            String sql = "SELECT * FROM turmas";
            ResultSet resultado = stmt.executeQuery(sql);
            while (resultado.next()) {
                if (turma.equals(resultado.getString(3))) {
                    return resultado.getInt(1);
                }
            }
        } catch (SQLException ex) {
            Logger.getLogger(BancoDeDados.class.getName()).log(Level.SEVERE, null, ex);
        }
        return -1;
    }
    
}
