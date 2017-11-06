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
import obrasdoacervo.model.ObrasDoAcervo;

/**
 *
 * @author Aluno
 */
public class InterfacePrincipalController implements Initializable{
    
    
    private com.mysql.jdbc.Connection link = null;
    private static ObrasDoAcervo main;

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        
        try {
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        } catch (SQLException ex) {
            Logger.getLogger(InterfacePrincipalController.class.getName()).log(Level.SEVERE, null, ex);
        }
        if(link == null)
            System.out.println("Erro!");
        else
            System.out.println("Conexao feita com sucesso!");
        
    }
    
    
    
    @FXML
    public void pesquisaObras() throws IOException{
        main.abreInterfacePrincipal();
     }
    
    @FXML
    public void abreMenuSwitchObras() throws IOException{
        main.abreMenuSwitchObras();
    }
    
    @FXML
    public void sair() throws IOException{
        System.exit(0);
    }

    public void setMain(ObrasDoAcervo main) {
        this.main = main;
    }

   
}