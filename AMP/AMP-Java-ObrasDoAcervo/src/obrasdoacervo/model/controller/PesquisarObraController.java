/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package obrasdoacervo.model.controller;

import java.io.IOException;
import java.net.URL;
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
    private ObservableList<AcervoTabela> listaAtiv = FXCollections.observableArrayList();
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
        public void pesquisarObras() throws IOException, SQLException {
            tabela.setEditable(true);
        
        campus.setCellValueFactory(cellData -> cellData.getValue().getCampus());
        nome.setCellValueFactory(cellData -> cellData.getValue().getNome());
        local.setCellValueFactory(cellData -> cellData.getValue().getLocal());
        tipo.setCellValueFactory(cellData -> cellData.getValue().getTipo());
        ano.setCellValueFactory(cellData -> cellData.getValue().getAno());
        editora.setCellValueFactory(cellData -> cellData.getValue().getEditora());
        paginas.setCellValueFactory(cellData -> cellData.getValue().getPaginas());
        //data.setCellValueFactory(cellData -> cellData.getValue().getData());
        //.setCellValueFactory(cellData -> cellData.getValue().getValor().asObject());
        
        listaAtiv = main.montaListaAcervo(link, pesquisa.getText());
        
        tabela.setItems(listaAtiv);
        }
        
        @FXML
        public void pesquisar() throws IOException, SQLException {
            String campusTabela = tabela.getSelectionModel().getSelectedItem().getCampus().get();
            String nomeTabela = tabela.getSelectionModel().getSelectedItem().getNome().get();
            String localTabela = tabela.getSelectionModel().getSelectedItem().getLocal().get();
            String tipoTabela = tabela.getSelectionModel().getSelectedItem().getTipo().get();
            String anoTabela = tabela.getSelectionModel().getSelectedItem().getAno().get();
            String editoraTabela = tabela.getSelectionModel().getSelectedItem().getEditora().get();
            String paginasTabela = tabela.getSelectionModel().getSelectedItem().getPaginas().get();
            
            Statement stmt = null;
            stmt = link.createStatement();
            String sql = "SELECT * FROM acervo WHERE nome='"+nomeTabela+"' AND ativo='S'";
            ResultSet rs; 
            rs = stmt.executeQuery(sql);
            rs.next();
            int id = rs.getInt("id");
            
            if(tipoTabela.equals("livros")){
                main.abreEditaLivro(link, nomeTabela, tipoTabela, localTabela, anoTabela, editoraTabela, paginasTabela, id);
            }else if(tipoTabela.equals("periodicos")){
                main.abreEditaPeriodicos(link, nomeTabela, tipoTabela, localTabela, anoTabela, editoraTabela, paginasTabela, id);
            }else if(tipoTabela.equals("midias")){
                main.abreEditaMidia(link, nomeTabela, tipoTabela, localTabela, anoTabela, editoraTabela, paginasTabela, id);
            }else if(tipoTabela.equals("academicos")){
                main.abreEditaAcademico(link, nomeTabela, tipoTabela, localTabela, anoTabela, editoraTabela, paginasTabela, id);
            }
            
        }
        
}
