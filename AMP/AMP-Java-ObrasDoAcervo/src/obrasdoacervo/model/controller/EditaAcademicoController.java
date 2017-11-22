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
import javafx.scene.control.Alert;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.TextField;
import obrasdoacervo.model.ObrasDoAcervo;
import static obrasdoacervo.model.ObrasDoAcervo.remove;

/**
 *
 * @author Aluno
 */
public class EditaAcademicoController implements Initializable{
    private ObrasDoAcervo main;
    private com.mysql.jdbc.Connection link;
    
    @FXML
    private TextField nome;
    @FXML
    private TextField programa;
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
    private String paginasP;
    private String editoraP;
    private String anoP;
    private String tipoP;
    private String nomeP;
    private String localP;
    private Connection connection;
    @FXML

    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // TODO
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        } catch (SQLException ex) {
            Logger.getLogger(EditaAcademicoController.class.getName()).log(Level.SEVERE, null, ex);
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
            remove(link, i, "academicos");
            
            main.abrePesquisarObra();
        }
        
        @FXML
        public void editar() throws IOException{
            int i = 0;
        if   (nome.getText().equals("") || local.getText().equals("") || ano.getText().equals("") || editora.getText().equals("") || paginas.getText().equals("")){
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            System.out.println("Alert");
            i = 1;
            alert.setContentText("Não foi possível editar o autor, existem campos vazios");
            alert.showAndWait();
        }else if(i==0){


            
        main.alteraAcervo(link, nomeP, tipoP, localP, anoP, editoraP, paginasP, "acervo", "nome", nome.getText());
        //main.alteraAcervo(link, nomeP, tipoP, localP, anoP, editoraP, paginasP, "acervo", "tipo", autorSobrenome.getText());
        main.alteraAcervo(link, nomeP, tipoP, localP, anoP, editoraP, paginasP, "acervo", "ano", ano.getText());
        main.alteraAcervo(link, nomeP, tipoP, localP, anoP, editoraP, paginasP, "acervo", "local", local.getText());
        main.alteraAcervo(link, nomeP, tipoP, localP, anoP, editoraP, paginasP, "acervo", "editora", editora.getText());
        main.alteraAcervo(link, nomeP, tipoP, localP, anoP, editoraP, paginasP, "acervo", "paginas", paginas.getText());

        
        main.abrePesquisarObra();
        }
        }
    
        public void setMain(ObrasDoAcervo main, Connection connection, String nomeP, String tipoP, String localP, String anoP, String editoraP, String paginasP) {
        this.connection = connection;
        this.main = main;
        this.nomeP=nomeP;
        this.tipoP=tipoP;
        this.anoP=anoP;
        this.localP=localP;
        this.editoraP=editoraP;
        this.paginasP=paginasP;
            
        nome.setText(nomeP);
        local.setText(localP);
        ano.setText(anoP);
        editora.setText(editoraP);
        paginas.setText(paginasP);
}
}