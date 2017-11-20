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
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import obrasdoacervo.model.AcervoTabela;
import obrasdoacervo.model.Obras;
import obrasdoacervo.model.ObrasDoAcervo;

/**
 *
 * @author Aluno
 */
public class PesquisarObraController implements Initializable {
    private ObrasDoAcervo main;
    private com.mysql.jdbc.Connection link;

    @FXML
    private TextField pesquisa;
    @FXML
    private TableView<AcervoTabela> tabela;
    @FXML
    private TableColumn<AcervoTabela, String> campus;
    @FXML
    private TableColumn<AcervoTabela, String> nome;
    @FXML
    private TableColumn<AcervoTabela, String> tipo;
    @FXML
    private TableColumn<AcervoTabela, String> local;
    @FXML
    private TableColumn<AcervoTabela, String> ano;
    @FXML
    private TableColumn<AcervoTabela, String> editora;
    @FXML
    private TableColumn<AcervoTabela, String> paginas;
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // TODO
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        } catch (SQLException ex) {
            Logger.getLogger(EditaPeriodicosController.class.getName()).log(Level.SEVERE, null, ex);
        }
        if(link == null)
            System.out.println("Erro!");
        else
            System.out.println("Conexao feita com sucesso!");
            
    }
        @FXML
        public void setMain(ObrasDoAcervo main) {
        this.main = main;
        }

        @FXML
        public void voltar() throws IOException {
            main.abreInterfacePrincipal();
        }
        
        @FXML
        public void pesquisarObras() throws IOException {    
        }
        
        
}
