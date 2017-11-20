/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaoDeProfessores.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.TextField;
import manutencaoDeProfessores.model.ManutencaoDeProfessores;

/**
 *
 * @author Aluno
 */
public class CriaProfessorController implements Initializable {
    private com.mysql.jdbc.Connection link = null;
    private static ManutencaoDeProfessores main;
    
    
    @FXML
    private TextField nome;
    @FXML
    private TextField idSiape;
    
    //@FXML
    //private TextField idCampi;
    //Select para encontrar o departamento
    
    @FXML
    private TextField idDepartamento;
    //Select
    
    @FXML
    private ChoiceBox titulacao;
    //Select P,G,M,D

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // TODO
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        } catch (SQLException ex) {
            Logger.getLogger(CriaProfessorController.class.getName()).log(Level.SEVERE, null, ex);
        }
        if(link == null)
        System.out.println("Erro!");
        else
            System.out.println("Conexao feita com sucesso!");   
    }
    
    
    @FXML
    public void criaProfessor() throws IOException{
    }
    
    @FXML
    public void voltar() throws IOException{
        main.abreInterfacePrincipal();
    }
    

    public void setMain(ManutencaoDeProfessores main) {
        this.main = main;
    }

   
}
