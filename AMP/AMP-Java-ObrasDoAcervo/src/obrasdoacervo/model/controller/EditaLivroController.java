/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package obrasdoacervo.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.TextField;
import obrasdoacervo.model.ObrasDoAcervo;
import static obrasdoacervo.model.ObrasDoAcervo.remove;

/**
 *
 * @author Aluno
 */
public class EditaLivroController implements Initializable{
    private ObrasDoAcervo main;
    private com.mysql.jdbc.Connection link;
    
    Connection connection;
    String nomeP;
    String editoraP;
    String localP;
    String paginasP;
    String anoP;
    String tipoP;
    
    @FXML
    private TextField nome;
    @FXML
    private TextField edicao;
    
    @FXML
    private ChoiceBox campus;
    
    @FXML
    private TextField local;
    @FXML
    private TextField editora;
    @FXML
    private TextField ano;
    @FXML
    private TextField paginas;
    @FXML
    private TextField ISBN;
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // TODO
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        } catch (SQLException ex) {
            Logger.getLogger(EditaLivroController.class.getName()).log(Level.SEVERE, null, ex);
        }
        if(link == null)
            System.out.println("Erro!");
        else
            System.out.println("Conexao feita com sucesso!");
            
    } 
    
        @FXML
        public void excluir() throws IOException, SQLException{
            Statement stmt = null;
            stmt = connection.createStatement();
            String sql = "SELECT * FROM acervo WHERE nome='"+nomeP+"' AND ativo='S'";
            ResultSet rs; 
            rs = stmt.executeQuery(sql);
            rs.next();
            int i = rs.getInt("id");
            remove(link, i, "livros");
            
            main.abrePesquisarObra();
        }
        
        @FXML
        public void editar() throws IOException{
            System.exit(0);
        }
    
    
        public void setMain(ObrasDoAcervo main, Connection connection, String nomeP, String tipoP, String localP, String anoP, String editoraP, String paginasP) {
        this.connection = connection;
        this.main = main;
        this.nomeP=nomeP;
        this.tipoP=tipoP;
        this.anoP=anoP;
        this.editoraP=editoraP;
        this.paginasP=paginasP;
            
        nome.setText(nomeP);
        local.setText(localP);
        ano.setText(anoP);
        editora.setText(editoraP);
        paginas.setText(paginasP);

    }
}
