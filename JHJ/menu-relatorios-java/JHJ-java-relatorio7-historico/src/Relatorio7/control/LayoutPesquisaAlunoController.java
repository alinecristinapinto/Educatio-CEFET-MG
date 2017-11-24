/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Relatorio7.control;

import Relatorio7.Relatorio7;
import Relatorio7.model.Aluno;
import java.net.URL;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.ParseException;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.ListView;
import javafx.scene.control.TextArea;
import java.util.regex.*;
import javafx.beans.property.StringProperty;
import javafx.collections.transformation.FilteredList;
import javafx.collections.transformation.SortedList;
import javafx.geometry.Insets;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;

/**
 * FXML Controller class
 *
 * @author Aluno
 */
public class LayoutPesquisaAlunoController implements Initializable{
    @FXML
    private TableColumn<Aluno, String> alunoCPF;
    @FXML
    private TableColumn<Aluno, String> alunoNome;
    @FXML
    private AnchorPane telaPrincipal;
    @FXML
    private TableView<Aluno> alunos;
    @FXML
    private Label info;
    @FXML
    private TextField pesq;
    
    ObservableList<Aluno> dadosAluno;
    private Relatorio7 relatorio7;
    FilteredList<Aluno> filtraDados;
    
    public void setRelatorio7(Relatorio7 relatorio7){
        this.relatorio7=relatorio7;
    }
    
    @FXML
    public void handlePesq() throws SQLException{
        if(pesq.getText().isEmpty()){
            alunos.setItems(null);
            return;
        }
        filtraDados = new FilteredList<Aluno>(dadosAluno, p -> true);    
            pesq.textProperty().addListener((observable, oldValue, newValue) -> {
            filtraDados.setPredicate(aluno -> {
                // If filter text is empty, display all persons.
                if (newValue == null || newValue.isEmpty()) {
                    return false;
                }
                
                String lowerCaseFilter = newValue.toLowerCase();

                if (aluno.getCPF().toString().toLowerCase().contains(lowerCaseFilter)) {
                    return true;
                } else if (aluno.getNome().toString().toLowerCase().contains(lowerCaseFilter)) {
                    return true;
                }
                return false; // Does not match.
            });
        });

        // 3. Wrap the FilteredList in a SortedList. 
        SortedList<Aluno> sortedData = new SortedList<>(filtraDados);

        // 4. Bind the SortedList comparator to the TableView comparator.
        sortedData.comparatorProperty().bind(alunos.comparatorProperty());

        // 5. Add sorted (and filtered) data to the table.
        alunos.setItems(sortedData);
    }
    
    @FXML
    private boolean handleExistenciaAluno(){
        if(alunos.getSelectionModel().getSelectedItem()==null){
            alunos.setStyle("-fx-background-color: #d13419");
            info.setText("Selecione um aluno");
            return false;
        }
        else{
            alunos.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }
    }
    
    public void invocaHistorico() throws SQLException, ParseException{
        if(handleExistenciaAluno()){
            relatorio7.invocaLayoutRelatorio7(alunos.getSelectionModel().getSelectedItem().getCPF().getValue());
        }
    }
    

    
    
    
    @Override
    public void initialize(URL url, ResourceBundle rb){
        try{
        String sql = null;
        Connection conn = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
        if(conn!=null){   
        }else{
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        dadosAluno = FXCollections.observableArrayList();
        sql = "SELECT * FROM alunos WHERE ativo='S'";
        Statement fetch = conn.createStatement();
        result = fetch.executeQuery(sql);
        while(result.next()){
            dadosAluno.add(new Aluno(result.getString("nome"), result.getString("idCPF")));
        }
        alunoNome.setCellValueFactory(cellData -> cellData.getValue().getNome());
        alunoCPF.setCellValueFactory(cellData -> cellData.getValue().getCPF());
        //alunos.setItems(dadosAluno);
        
        alunos.setColumnResizePolicy(TableView.CONSTRAINED_RESIZE_POLICY);
        alunos.getColumns().get(1).maxWidthProperty().bind(alunos.widthProperty().multiply(0.7));
        alunos.getColumns().get(0).maxWidthProperty().bind(alunos.widthProperty().multiply(0.265));
        
        alunos.getColumns().get(1).minWidthProperty().bind(alunos.widthProperty().multiply(0.7));
        alunos.getColumns().get(0).minWidthProperty().bind(alunos.widthProperty().multiply(0.265));
        
        }
        catch (SQLException ex){
        }
    }
    
    public void centraliza(BorderPane telaBase){
        telaPrincipal.setPadding(new Insets((telaBase.getHeight()-telaPrincipal.getHeight())/2, (telaBase.getWidth()-telaPrincipal.getWidth())/2, (telaBase.getHeight()-telaPrincipal.getHeight())/2, (telaBase.getWidth()-telaPrincipal.getWidth())/2));//cima, direita, baixo, esquerda
    }
}
