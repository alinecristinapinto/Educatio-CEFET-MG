/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaoDeProfessores.model.controller;

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
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
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
    private Connection link = null;
    private static ManutencaoDeProfessores main;
    
    @FXML
    private TextField nome;
    @FXML
    private TextField IDSiape;
    
    //@FXML
    //private TextField idCampi;
    //Select para encontrar o departamento

    
    @FXML
    private ChoiceBox titulacao;
    //Select P,G,M,D
    
    @FXML
    private ChoiceBox departamento;

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
        
        ObservableList nomes = FXCollections.observableArrayList();
        nomes.add("P");
        nomes.add("M");
        nomes.add("G");
        nomes.add("D");
        
        titulacao.setItems(nomes);        
       
        
    }
    
    
    @FXML
    public void criaProfessor() throws IOException{
        String sql = "INSERT INTO funcionario (idSiape, idDepto, nome, titulacao, hierarquia, senha, foto, ativo) values ('"+IDSiape.getText()+"', 1, '"+nome.getText()+"', '"+nome.getText()+"', 'professor', 0, 0 , 'S')";
        Statement stmt = null;
    
        try{
        stmt = link.createStatement();
        // rs = stmt.executeQuery(sql);
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }    
   
        
        ResultSet result;
        String sql_fetch = "SELECT id FROM campi WHERE ativo='S'";
        try{
        Statement fetch = link.createStatement();
        result = fetch.executeQuery(sql_fetch);
        result.next();
        int id = result.getInt("id");
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());  
        }
    
        main.abreInterfacePrincipal();
    }
    
    
    @FXML
    public void voltar() throws IOException{
        main.abreInterfacePrincipal();
    }
    

    public void setMain(ManutencaoDeProfessores main, Connection connection) {
        this.main = main;
        this.link =connection;
        
        ObservableList deps = FXCollections.observableArrayList();
        try {
            deps = main.pesquisaDepto(link);
        } catch (SQLException ex) {
            Logger.getLogger(CriaProfessorController.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        departamento.setItems(deps);
    }

   
}
