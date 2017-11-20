/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package obrasdoacervo.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.TextField;
import obrasdoacervo.model.Autores;
import obrasdoacervo.model.Livros;
import obrasdoacervo.model.ObrasDoAcervo;
import static obrasdoacervo.model.ObrasDoAcervo.insereAutores;
import static obrasdoacervo.model.ObrasDoAcervo.insereLivro;

/**
 *
 * @author Aluno
 */
public class CriaAutorController implements Initializable{
    private ObrasDoAcervo main;
    private com.mysql.jdbc.Connection link;
    
    @FXML
    private TextField autorNome;
    @FXML
    private TextField autorSobrenome;
    @FXML
    private TextField autorOrdem;
    @FXML
    private TextField autorQualificacao;
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // TODO
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        } catch (SQLException ex) {
            Logger.getLogger(CriaParteController.class.getName()).log(Level.SEVERE, null, ex);
        }
        if(link == null)
            System.out.println("Erro!");
        else
            System.out.println("Conexao feita com sucesso!");
            
    } 
    
        public void setMain(ObrasDoAcervo main) {
        this.main = main;
    }
        
        @FXML
    public void criaAutor() throws IOException, SQLException{
        if   (autorNome.getText().equals("") || autorSobrenome.getText().equals("") || autorOrdem.getText().equals("") || autorQualificacao.getText().equals("")){
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            System.out.println("Alert");
            
            alert.showAndWait();
        }else{

        

        Autores autor = new Autores(autorNome.getText(), autorSobrenome.getText(), autorOrdem.getText(), autorQualificacao.getText());
        insereAutores(link, autor);
        main.abreCriaAutorSecundario();
        }
     }
        
        @FXML
        public void voltar() throws IOException{
            main.abreMenuSwitchObras();
        }

}
