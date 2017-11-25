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
import obrasdoacervo.model.Livros;
import obrasdoacervo.model.ObrasDoAcervo;
import static obrasdoacervo.model.ObrasDoAcervo.inserePartes;
import obrasdoacervo.model.Partes;

/**
 *
 * @author Aluno
 */
public class CriaParteController implements Initializable{
    private ObrasDoAcervo main;
    private com.mysql.jdbc.Connection link;
    
    @FXML
    private TextField titulo;
    @FXML
    private TextField palavrasChave;
    @FXML
    private TextField pagInicio;
    @FXML
    private TextField pagFinal;
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
        public void voltar() throws IOException{
            main.abreMenuSwitchObras();
        }
        
        @FXML
        public void criaParte() throws IOException{
            int i = 0;
            if (titulo.getText().equals("") || pagInicio.getText().equals("") || pagFinal.getText().equals("") || palavrasChave.getText().equals("")){
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            System.out.println("Alert");
            i = 1;
            alert.setContentText("Existem campos vazios, não foi possível criar a obra");
            alert.showAndWait();
        }else if(i==0){

        
        Partes parte = new Partes(titulo.getText(), pagInicio.getText(), pagFinal.getText(), palavrasChave.getText());
        main.inserePartes(link, parte);
        main.abreCriaParteSecundario();
        }
        }
        
        @FXML
        public void criaParteFinal() throws IOException{
            if (titulo.getText().equals("") || pagInicio.getText().equals("") || pagFinal.getText().equals("") || palavrasChave.getText().equals("")){
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            System.out.println("Alert");
            
            alert.showAndWait();
        }else{
                
        
        Partes parte = new Partes(titulo.getText(), pagInicio.getText(), pagFinal.getText(), palavrasChave.getText());
        main.inserePartes(link, parte);
        main.abreCriaAutor();
        }

        }
}