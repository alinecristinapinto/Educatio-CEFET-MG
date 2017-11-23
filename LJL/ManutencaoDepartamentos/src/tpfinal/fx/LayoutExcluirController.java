/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tpfinal.fx;

import java.net.URL;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Optional;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.DialogPane;
import javafx.scene.control.Label;
import javafx.stage.Stage;

/**
 * FXML Controller class
 *
 * @author leonardocaetanogomide
 */
public class LayoutExcluirController implements Initializable {


    ManutencaoDepartamento manDep = new ManutencaoDepartamento();
    ManutencaoDepto manutencaoDepto;
    ObservableList<String> nomesDepto;
    int campiB;
    
    public void setManutencaoDepto(ManutencaoDepto manutencaoDepto){
        this.manutencaoDepto=manutencaoDepto;
    }
    
    public void setCampiB(int campiB){
        this.campiB = campiB;
    }
    
    public LayoutExcluirController() throws SQLException{
        
    }
    
    public void setData() throws SQLException{
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if(connection!=null){   
        }else{
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        nomesDepto = FXCollections.observableArrayList();
        sql = "SELECT nome FROM deptos WHERE ativo='S' AND idCampi = '"+campiB+"'";
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        while(result.next()){
            nomesDepto.add(result.getString("nome"));
        }
        initialize();
    }
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        
    }
    
    public void initialize() {
        deptos.setItems(nomesDepto);
    }
    
    @FXML
    private ChoiceBox deptos;
    @FXML
    private Label info;
    
    Stage thisStage;
    
    public void setThisStage(Stage thisStage){
        this.thisStage = thisStage;
    }
    
    @FXML
    private boolean handleExistenciaDepto(){
        if(deptos.getValue()==null){
            deptos.setStyle("-fx-background-color: #d13419");
            info.setText("Extre com um Departamento");
            return false;
        }
        else{
            deptos.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }
    }
    
        
    @FXML
    private void handleExcluirAction(ActionEvent event) throws SQLException {
        if (handleExistenciaDepto()){
                manDep.ExcluirDepartamento(deptos.getValue().toString(), campiB);
                manutencaoDepto.invocaLayoutBase();
        }
    }
    
    @FXML
    private void handleCancelarAction() throws SQLException {
        manutencaoDepto.invocaLayoutBase();
    }
    
}
