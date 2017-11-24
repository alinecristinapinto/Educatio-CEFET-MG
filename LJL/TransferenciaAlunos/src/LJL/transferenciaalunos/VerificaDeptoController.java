/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package LJL.transferenciaalunos;

import java.net.URL;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.Label;

/**
 * FXML Controller class
 *
 * @author Aluno
 */
public class VerificaDeptoController implements Initializable {

    @FXML
    private ChoiceBox depto;
    @FXML
    private Label info;
    private TransferenciaAlunos transferenciaAlunos;
    ObservableList<String> nomesDepto;
    private int idCampi;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        
    }

    public void setTransferenciaAlunos(TransferenciaAlunos transferenciaAlunos) {
        this.transferenciaAlunos = transferenciaAlunos;
    }

    public void setIdCampi(int idCampi) {
        this.idCampi = idCampi;
    }

    public void VerificaDeptoPrep() throws SQLException {

        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        nomesDepto = FXCollections.observableArrayList();
        sql = "SELECT nome FROM deptos WHERE ativo='S' AND idCampi = '" + idCampi+"'";
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        while (result.next()) {
            nomesDepto.add(result.getString("nome"));
        }
        depto.setItems(nomesDepto);
    }

    private boolean handleExistenciaDepto() {
        if (depto.getValue() == null) {
            depto.setStyle("-fx-background-color: #d13419");
            info.setText("Extre com um depto");
            return false;
        } else {
            depto.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }
    }
    
    private boolean cursoSub(int idDepto) throws SQLException {
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        sql = "SELECT * FROM cursos WHERE ativo='S' AND idDepto = " + idDepto;
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);

        if (!result.next()) {
            depto.setStyle("-fx-background-color: #d13419");
            info.setText("Não existem cursos nesse departamento");
            return false;
        } else {
            depto.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }

    }

    @FXML
    private void handleSeguirAction(ActionEvent event) throws SQLException {
        int idDepto = 0;
        if (handleExistenciaDepto()) {

            String sql = null;
            Conexão conn = new Conexão();
            Connection connection = conn.getConnection();
            if (connection != null) {
            } else {
                System.out.println("deu ruim :(");
            }
            ResultSet result;
            sql = "SELECT id FROM deptos WHERE ativo='S' AND nome = '" + depto.getValue() + "'";
            Statement fetch = connection.createStatement();
            result = fetch.executeQuery(sql);
            while (result.next()) {
                idDepto = result.getInt("id");
            }
            if (cursoSub(idDepto)) {
                transferenciaAlunos.invocaVerificaCurso(idDepto);
            }
        }

    }

    @FXML
    private void handleCancelarAction(ActionEvent event) {
        transferenciaAlunos.invocaLayoutBase();
    }

}
