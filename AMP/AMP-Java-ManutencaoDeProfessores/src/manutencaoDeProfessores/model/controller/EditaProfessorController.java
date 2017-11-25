package manutencaoDeProfessores.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.TextField;
import manutencaoDeProfessores.model.ManutencaoDeProfessores;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Aluno
 */
public class EditaProfessorController implements Initializable{
    private com.mysql.jdbc.Connection link = null;
    private static ManutencaoDeProfessores main;

    @FXML
    private TextField nome;
    @FXML
    private TextField IDSiape;

    @FXML
    private ChoiceBox titula;
    //Select P,G,M,D
    
    @FXML
    private TextField senha;
    private String IDSiapeP;
    private String nomeP;
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
      try {
            // TODO
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        } catch (SQLException ex) {
            Logger.getLogger(EditaProfessorController.class.getName()).log(Level.SEVERE, null, ex);
        }
        if(link == null)
        System.out.println("Erro!");
        else
            System.out.println("Conexao feita com sucesso!");  
    }
    

    public void setMain(ManutencaoDeProfessores main, String nomeX, String IDSiapeX, String titulacao) {
        this.main = main;
        this.nomeP = nomeX;
        this.IDSiapeP = IDSiapeX;
        
        ObservableList nomes = FXCollections.observableArrayList();
        nomes.add("P");
        nomes.add("M");
        nomes.add("G");
        nomes.add("D");
        
        titula.setItems(nomes);
        
        nome.setText(nomeP);
        IDSiape.setText(IDSiapeP);
        
    }

   @FXML
    private void edita() throws SQLException, IOException{
       int i = 0;
        if   (nome.getText().equals("") || IDSiape.getText().equals("") || titula.getValue() == null){
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            System.out.println("Alert");
            i = 1;
            alert.setContentText("Não foi possível editar o autor, existem campos vazios");
            alert.showAndWait();
        }else if(i==0){
   
    String sql = "UPDATE funcionario SET nome='"+(String) nome.getText()+"', IDSiape='"+(String) IDSiape.getText()+"', titulacao='"+(String) titula.getValue()+"' WHERE ativo='S' AND idSIAPE="+main.pegaIdProf(link, (String) nome.getText());
        Statement stmt = null;
        
        try{
        stmt = link.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }  
        main.abrePesquisaProfessor();
        }
    }
    
    @FXML
    private void excluir() throws IOException{
        String sql = "UPDATE funcionario SET ativo='N' WHERE nome='"+nome.getText()+"'";
        Statement stmt = null;
        
        try{
        stmt = link.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }        
        
        main.abrePesquisaProfessor();
        }
    
        
    }   
    
