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
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.TextField;
import obrasdoacervo.model.ObrasDoAcervo;
import obrasdoacervo.model.Periodicos;

/**
 *
 * @author Aluno
 */
public class CriaPeriodicoController implements Initializable{
    private ObrasDoAcervo main;
    private com.mysql.jdbc.Connection link;
    
    @FXML
    private TextField nome;
    @FXML
    private TextField editora;
    
    @FXML
    private ChoiceBox campus;
    
    @FXML
    private TextField local;

    @FXML
    private TextField ano;
    @FXML
    private TextField paginas;
    @FXML
    private TextField periodicidade;
    @FXML
    private TextField mes;
    @FXML
    private TextField volume;
    @FXML
    private TextField subtipo;
    @FXML
    private TextField ISSN;
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // TODO
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        } catch (SQLException ex) {
            Logger.getLogger(CriaPeriodicoController.class.getName()).log(Level.SEVERE, null, ex);
        }
        if(link == null)
            System.out.println("Erro!");
        else
            System.out.println("Conexao feita com sucesso!");
            
    }
    
        public void setMain(ObrasDoAcervo main) {
        this.main = main;
        
        ObservableList lista = null;
        try {
            lista = main.pesquisaCampi(link);
        } catch (SQLException ex) {
            Logger.getLogger(CriaLivroController.class.getName()).log(Level.SEVERE, null, ex);
        }
        
            campus.setItems(lista);
    }
        
        @FXML
        public void voltar() throws IOException{
            main.abreMenuSwitchObras();
        }
        
        @FXML
        public void criaPeriodico() throws IOException, SQLException{
            int i = 0;
           if (ISSN.getText().equals("") || subtipo.getText().equals("") || volume.getText().equals("") || campus.getValue().equals("") || nome.getText().equals("") || local.getText().equals("") || ano.getText().equals("") || editora.getText().equals("") || paginas.getText().equals("")){
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            System.out.println("Alert");
            i = 1;
            alert.setContentText("Não foi possível criar a obra, existem campos vazios");
            alert.showAndWait();
        }else if(i==0){
            int idCampi = main.pegaIdCampi(link, (String) campus.getValue());   
               
            Periodicos periodico = new Periodicos(periodicidade.getText(), mes.getText(), volume.getText(), subtipo.getText(), ISSN.getText(), idCampi, nome.getText(), "periodicos", local.getText(), ano.getText(), editora.getText(), paginas.getText());
            main.inserePeriodicos(link, periodico);
            main.abreCriaParte();
           }
        }
}