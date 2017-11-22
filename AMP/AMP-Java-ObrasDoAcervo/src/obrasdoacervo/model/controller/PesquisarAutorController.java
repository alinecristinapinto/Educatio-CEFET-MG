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
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import obrasdoacervo.model.AcervoTabela;
import obrasdoacervo.model.AutoresTabela;
import obrasdoacervo.model.ObrasDoAcervo;


/**
 *
 * @author Aluno
 */
public class PesquisarAutorController implements Initializable {
    private ObrasDoAcervo main;
    private com.mysql.jdbc.Connection link;
    private ObservableList<AutoresTabela> listaAtiv = FXCollections.observableArrayList();

    @FXML
    private TextField pesquisa;
    @FXML
    private TableView<AutoresTabela> tabela;
    @FXML
    private TableColumn<AutoresTabela, String> sobrenome;
    @FXML
    private TableColumn<AutoresTabela, String> nome;
    @FXML
    private TableColumn<AutoresTabela, String> ordem;
    @FXML
    private TableColumn<AutoresTabela, String> qualificacao;
    
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
    
    
        public void setMain(ObrasDoAcervo main) {
        this.main = main;
    }
        
        @FXML
        public void voltar() throws IOException {
            main.abreInterfacePrincipal();
    }
        
        @FXML
        public void pesquisar() throws IOException{
            String nomeTabela = tabela.getSelectionModel().getSelectedItem().getNome().get();
            String sobrenomeTabela = tabela.getSelectionModel().getSelectedItem().getSobrenome().get();
            String ordemTabela = tabela.getSelectionModel().getSelectedItem().getOrdem().get();
            String qualificacaoTabela = tabela.getSelectionModel().getSelectedItem().getQualificacao().get();
    
            
           main.abreEditaAutor(nomeTabela, sobrenomeTabela, ordemTabela, qualificacaoTabela);
           //EditaAutorController.preenche(nomeTabela, sobrenomeTabela, ordemTabela, qualificacaoTabela);
            
        }

        @FXML
        public void pesquisarAutores() throws IOException, SQLException {
            
        tabela.setEditable(true);
        
//        campus.setCellValueFactory(cellData -> cellData.getValue().getCampus());
        nome.setCellValueFactory(cellData -> cellData.getValue().getNome());
        sobrenome.setCellValueFactory(cellData -> cellData.getValue().getSobrenome());
        ordem.setCellValueFactory(cellData -> cellData.getValue().getOrdem());
        qualificacao.setCellValueFactory(cellData -> cellData.getValue().getQualificacao());
        //editora.setCellValueFactory(cellData -> cellData.getValue().getEditora());
        //paginas.setCellValueFactory(cellData -> cellData.getValue().getPaginas());
        //data.setCellValueFactory(cellData -> cellData.getValue().getData());
        //.setCellValueFactory(cellData -> cellData.getValue().getValor().asObject());
        
        listaAtiv = main.montaListaAutores(link, pesquisa.getText());
        
        tabela.setItems(listaAtiv);
        }
        
    
}
