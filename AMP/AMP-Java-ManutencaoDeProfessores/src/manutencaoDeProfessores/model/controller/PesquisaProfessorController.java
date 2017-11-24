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
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import manutencaoDeProfessores.model.ManutencaoDeProfessores;
import manutencaoDeProfessores.model.ProfTabela;

/**
 *
 * @author Aluno
 */
public class PesquisaProfessorController implements Initializable {
    private com.mysql.jdbc.Connection link = null;
    private static ManutencaoDeProfessores main;
    private String disc;
            
    @FXML
    private TextField pesquisa;
    @FXML
    private ChoiceBox depto;
    @FXML
    private ChoiceBox campus;
    private ObservableList<ProfTabela> listaAtiv = FXCollections.observableArrayList();
    @FXML
    private TableView<ProfTabela> tabela;
    //@FXML
    //private TableColumn<ProfTabela, String> sobrenome;
    @FXML
    private TableColumn<ProfTabela, String> nome;
    @FXML
    private TableColumn<ProfTabela, String> IDSiape;
    @FXML
    private TableColumn<ProfTabela, String> titulacao;
    
    
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
   
        
        depto.setVisible(false);
        
        campus.getSelectionModel().selectedItemProperty().addListener(
            (observable, oldValue, newValue) -> {
            try {
                continuar(newValue.toString());
            } catch (SQLException | IOException ex) {
                Logger.getLogger(PesquisaProfessorController.class.getName()).log(Level.SEVERE, null, ex);
            }
        });
        
        
    }
    
    public void continuar(String valor) throws SQLException, IOException{
        disc = valor;
        int value;
        
        if(disc == null){
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            alert.setContentText("Existem campos vazios, não é possível pesquisar");
            alert.showAndWait(); 
        }else{
            value = main.pegaIdCampi(link, (String) campus.getValue());
            depto.setItems(main.pesquisaDepto(link, value));
            depto.setVisible(true);
        }
    }
    public void setMain(ManutencaoDeProfessores main) {
        this.main = main;
        
        
        /*ObservableList lista = null;
        try {
            lista = main.pesquisaDepto(link);
        } catch (SQLException ex) {
            Logger.getLogger(PesquisaProfessorController.class.getName()).log(Level.SEVERE, null, ex);
        }
        
            depto.setItems(lista);*/
            
        ObservableList lista2= null;
        try {
            lista2 = main.pesquisaCampi(link);
        } catch (SQLException ex) {
            Logger.getLogger(PesquisaProfessorController.class.getName()).log(Level.SEVERE, null, ex);
        }
        
            campus.setItems(lista2);
    
    }
    
    @FXML
    public void editaProf() throws IOException{
        String nomeTabela = tabela.getSelectionModel().getSelectedItem().getNome().get();
        String IDSiapeTabela = tabela.getSelectionModel().getSelectedItem().getIDSiape().get();
        String titulacaoTabela = tabela.getSelectionModel().getSelectedItem().getTitulacao().get();
        //String qualificacaoTabela = tabela.getSelectionModel().getSelectedItem().getQualificacao().get();
    
            
           main.abreEditaProfessor(nomeTabela, IDSiapeTabela, titulacaoTabela);
        
           
           
    }
    
    @FXML
    public void voltar() throws IOException{
        main.abreInterfacePrincipal();
    }
   
    @FXML
    public void pesquisar() throws SQLException{
        tabela.setEditable(true);
        
//        campus.setCellValueFactory(cellData -> cellData.getValue().getCampus());
        nome.setCellValueFactory(cellData -> cellData.getValue().getNome());
        //sobrenome.setCellValueFactory(cellData -> cellData.getValue().getSobrenome());
        IDSiape.setCellValueFactory(cellData -> cellData.getValue().getIDSiape());
        titulacao.setCellValueFactory(cellData -> cellData.getValue().getTitulacao());
        //editora.setCellValueFactory(cellData -> cellData.getValue().getEditora());
        //paginas.setCellValueFactory(cellData -> cellData.getValue().getPaginas());
        //data.setCellValueFactory(cellData -> cellData.getValue().getData());
        //.setCellValueFactory(cellData -> cellData.getValue().getValor().asObject());
        
        listaAtiv = main.montaListaProfessores(link, pesquisa.getText());
        System.out.println("Monta tabela");
        tabela.setItems(listaAtiv);
        
    }
    
    
    
    
}
