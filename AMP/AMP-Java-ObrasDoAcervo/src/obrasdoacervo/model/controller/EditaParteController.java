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
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.TextField;
import obrasdoacervo.model.ObrasDoAcervo;
import static obrasdoacervo.model.ObrasDoAcervo.remove;

/**
 *
 * @author Aluno
 */
public class EditaParteController implements Initializable{
    private ObrasDoAcervo main;
    private java.sql.Connection link;
    
    Connection connection;
    String tituloP;
    String paginicialP;
    String pagfinalP;
    String palavraschaveP;
    
    int id;
    
    @FXML
    private TextField titulo;
    @FXML
    private TextField paginicial;
    
    @FXML
    private TextField pagfinal;
    @FXML
    private TextField palavraschave;
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
        public void editar() throws IOException{
            int i = 0;
        if   (paginicial.getText().equals("") || pagfinal.getText().equals("") || palavraschave.getText().equals("") || titulo.getText().equals("")){
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            System.out.println("Alert");
            i = 1;
            alert.setContentText("Não foi possível editar o autor, existem campos vazios");
            alert.showAndWait();
        }else if(i==0){

            System.out.println("Chega no altera");
        main.alteraPartes(link, titulo.getText(), paginicial.getText(),pagfinal.getText(), palavraschave.getText(), id);
        
        
        main.abrePesquisarObra();
        }
        }
    
    
        public void setMain(ObrasDoAcervo main, Connection connection, int id) throws SQLException {
        this.connection = connection;
        this.main = main;
        this.id=id;
        
        Statement stmt = null;
        stmt = connection.createStatement();
        String sql = "SELECT * FROM partes WHERE id='"+id+"' AND ativo='S'";
        ResultSet rs; 
        rs = stmt.executeQuery(sql);
        rs.next();
            
        titulo.setText(rs.getString("titulo"));
        paginicial.setText(rs.getString("pagInicio"));
        pagfinal.setText(rs.getString("pagFinal"));
        palavraschave.setText(rs.getString("palavrasChave"));
}
}
