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
import java.util.ResourceBundle;
import javafx.beans.value.ChangeListener;
import javafx.beans.value.ObservableValue;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

/**
 * FXML Controller class
 *
 * @author leonardocaetanogomide
 */
public class LayoutAlterarController implements Initializable {

    ManutencaoDepartamento manDep = new ManutencaoDepartamento();
    ManutencaoDepto manutencaoDepto;
    ObservableList<String> nomesDepto = FXCollections.observableArrayList();
    ObservableList<String> nomesCampi = FXCollections.observableArrayList();
    int campiB;

    public void setManutencaoDepto(ManutencaoDepto manutencaoDepto) {
        this.manutencaoDepto = manutencaoDepto;
    }

    public void setCampiB(int campiB) {
        this.campiB = campiB;
    }

    public void setData() throws SQLException {
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        sql = "SELECT nome FROM deptos WHERE ativo='S' AND idCampi = '" + campiB + "'";
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        while (result.next()) {
            nomesDepto.add(result.getString("nome"));
        }
        sql = "SELECT nome FROM campi WHERE ativo='S'";
        fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        while (result.next()) {
            nomesCampi.add(result.getString("nome"));
        }
        initialize();
    }

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        deptos.setItems(nomesDepto);
        campus.setItems(nomesCampi);
        deptos.valueProperty().addListener(new ChangeListener<Object>() {
            @Override
            public void changed(ObservableValue<? extends Object> observable, Object oldValue, Object newValue) {
                String sql = null;
                Conexão conn = new Conexão();
                Connection connection = conn.getConnection();
                if (connection != null) {
                } else {
                    System.out.println("deu ruim :(");
                }
                sql = "SELECT * FROM deptos WHERE nome = '" + deptos.getValue() + "'";
                try{
                Statement fetch = connection.createStatement();
                ResultSet result;
                result = fetch.executeQuery(sql);
                result.next();
                nome.setText(result.getString("nome"));
                sql = "SELECT nome FROM campi WHERE id = '" + campiB + "'";
                fetch = connection.createStatement();
                result = fetch.executeQuery(sql);
                result.next();
                campus.setValue(result.getString("nome")); //To change body of generated methods, choose Tools | Templates.
                }
                catch(SQLException e){
                    
                }
            }
        });
    }

    public void initialize() {
        deptos.setItems(nomesDepto);
        campus.setItems(nomesCampi);
        
    }

    @FXML
    private TextField nome;
    @FXML
    private ChoiceBox campus;
    @FXML
    private ChoiceBox deptos;
    @FXML
    private Label info;

    Stage thisStage;

    public void setThisStage(Stage thisStage) {
        this.thisStage = thisStage;
    }

    @FXML
    private boolean handleExistenciaDepto() {
        if (deptos.getValue() == null) {
            deptos.setStyle("-fx-background-color: #d13419");
            info.setText("Extre com um departamento");
            return false;
        } else {
            deptos.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }
    }

    @FXML
    private void handleNomeSelecionado() throws SQLException {
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        sql = "SELECT * FROM deptos WHERE nome = '" + deptos.getValue() + "'";
        Statement fetch = connection.createStatement();
        ResultSet result;
        result = fetch.executeQuery(sql);
        result.next();
        nome.setText(result.getString("nome"));
        sql = "SELECT nome FROM campi WHERE id = '" + campiB + "'";
        fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        result.next();
        campus.setValue(result.getString("nome"));
    }

    @FXML
    private boolean handleNomeRepetido() throws SQLException {
        boolean a = true;
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        sql = "SELECT id FROM campi WHERE nome = '" + campus.getValue() + "'";
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        result.next();
        sql = "SELECT nome FROM deptos WHERE idCampi = '"+result.getString("id")+"'";
        fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        while (result.next()) {
            if (nome.getText().equals(result.getString("nome"))) {
                a = false;
            }
        }
        if (a) {
            nome.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        } else {
            nome.setStyle("-fx-background-color: #d13419");
            info.setText("Já existe um departamento com esse nome no campus");
            return false;
        }
    }

    @FXML
    private boolean handleExistenciaInfo() {
        if ((nome.getText().isEmpty()) || (campus.getValue() == null)) {
            nome.setStyle("-fx-background-color: #d13419");
            campus.setStyle("-fx-background-color: #d13419");
            info.setText("Entre com as informações");
            return false;
        } else {
            deptos.setStyle("-fx-background-color: #6989FF");
            campus.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }
    }

    @FXML
    private void handleAlterarAction(ActionEvent event) throws SQLException {
        if (handleExistenciaDepto()) {
            if (handleExistenciaInfo()) {
                if (handleNomeRepetido()) {
                    String sql = null;
                    Conexão conn = new Conexão();
                    Connection connection = conn.getConnection();
                    if (connection != null) {
                    } else {
                        System.out.println("deu ruim :(");
                    }
                    ResultSet result;
                    if (campus.getValue() != null) {
                        sql = "SELECT id FROM campi WHERE nome = '" + campus.getValue().toString()+"'";
                        Statement fetch = connection.createStatement();
                        result = fetch.executeQuery(sql);
                        while (result.next()) {
                            manDep.AlterarDepartamento(nome.getText(), result.getString("id"), deptos.getValue().toString(), campiB);
                        }
                    }
                    manutencaoDepto.invocaLayoutBase();
                }
            }
        }
    }

    @FXML
    private void handleCancelarAction(ActionEvent event) throws SQLException {
        manutencaoDepto.invocaLayoutBase();
    }

}
