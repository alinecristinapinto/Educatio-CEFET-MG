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
import manutencaoDeProfessores.model.ManutencaoDeProfessores;

/**
 *
 * @author Aluno
 */
public class InterfacePrincipalController implements Initializable {
    private com.mysql.jdbc.Connection link = null;
    private static ManutencaoDeProfessores main;

    @Override
    public void initialize(URL url, ResourceBundle rb) {
            
    }
    
    
    
    @FXML
    public void pesquisaObras() throws IOException{
        main.abreInterfacePrincipal();
     }
    
    @FXML
    public void CriaProfessor() throws IOException{
    }
    
    @FXML
    public void sair() throws IOException{
        System.exit(0);
    }

    public void setMain(ManutencaoDeProfessores main) {
        this.main = main;
    }

   
}
