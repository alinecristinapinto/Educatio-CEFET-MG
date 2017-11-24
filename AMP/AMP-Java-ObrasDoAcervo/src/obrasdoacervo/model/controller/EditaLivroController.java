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
public class EditaLivroController implements Initializable{
    private ObrasDoAcervo main;
    private java.sql.Connection link;
    
    Connection connection;
    String nomeP;
    String editoraP;
    String localP;
    String paginasP;
    String anoP;
    String tipoP;
    String ISBNP;
    String edicaoP;
    int id;
    
    @FXML
    private TextField nome;
    @FXML
    private TextField edicao;
    
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
    @FXML
    private TextField ISBN;
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
        public void excluir() throws IOException, SQLException{
            Statement stmt = null;
            stmt = connection.createStatement();
            String sql = "SELECT * FROM acervo WHERE nome='"+nomeP+"' AND ativo='S'";
            ResultSet rs; 
            rs = stmt.executeQuery(sql);
            rs.next();
            int i = rs.getInt("id");
            remove(link, i, "livros");
            
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
        main.alteraAcervo(link, nomeP, tipoP, localP, anoP, editoraP, paginasP, "acervo", "ano", ano.getText());
        main.alteraAcervo(link, nomeP, tipoP, localP, anoP, editoraP, paginasP, "acervo", "local", local.getText());
        main.alteraAcervo(link, nomeP, tipoP, localP, anoP, editoraP, paginasP, "acervo", "editora", editora.getText());
        main.alteraAcervo(link, nomeP, tipoP, localP, anoP, editoraP, paginasP, "acervo", "paginas", paginas.getText());
        main.alteraLivro(link, edicao.getText(), ISBN.getText(), id);
        
        main.abrePesquisarObra();
        }
        }
    
    
        public void setMain(ObrasDoAcervo main, Connection connection, String nomeP, String tipoP, String localP, String anoP, String editoraP, String paginasP, int id) throws SQLException {
        this.connection = connection;
        this.main = main;
        this.nomeP=nomeP;
        this.tipoP=tipoP;
        this.anoP=anoP;
        this.editoraP=editoraP;
        this.paginasP=paginasP;
        this.id=id;
        
        Statement stmt = null;
        stmt = connection.createStatement();
        String sql = "SELECT * FROM livros WHERE idAcervo='"+id+"' AND ativo='S'";
        ResultSet rs; 
        rs = stmt.executeQuery(sql);
        rs.next();
            
        nome.setText(nomeP);
        local.setText(localP);
        ano.setText(anoP);
        editora.setText(editoraP);
        paginas.setText(paginasP);
        ISBN.setText(rs.getString("ISBN"));
        edicao.setText(rs.getString("edicao"));
        
        ObservableList lista = null;
        try {
            lista = main.pesquisaCampi(link);
        } catch (SQLException ex) {
            Logger.getLogger(CriaLivroController.class.getName()).log(Level.SEVERE, null, ex);
        }
        
            campus.setItems(lista);

    }
}
