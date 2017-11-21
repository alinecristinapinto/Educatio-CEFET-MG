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
public class VerificaCursoController implements Initializable {

    @FXML
    private ChoiceBox curso;
    @FXML
    private Label info;
    private ManutencaoDepto manutencaoDepto;
    ObservableList<String> nomesCurso;
    private int idDepto;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        
    }

    public void setManutencaoDepto(ManutencaoDepto manutencaoDepto) {
        this.manutencaoDepto = manutencaoDepto;
    }

    public void setIdDepto(int idDepto) {
        this.idDepto = idDepto;
    }

    private boolean turmaSub(int idCampus) throws SQLException {
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        sql = "SELECT * FROM deptos WHERE ativo='S' AND idCampi = " + idCampus;
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);

        if (!result.next()) {
            curso.setStyle("-fx-background-color: #d13419");
            info.setText("Não existem turmas nesse campus");
            return false;
        } else {
            curso.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }
        
    }

    public void VerificaCursoPrep() throws SQLException {

        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        nomesCurso = FXCollections.observableArrayList();
        sql = "SELECT nome FROM cursos WHERE ativo='S' AND idDepto = " + idDepto;
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        while (result.next()) {
            nomesCurso.add(result.getString("nome"));
        }
        curso.setItems(nomesCurso);
    }

    private boolean handleExistenciaCurso() {
        if (curso.getValue() == null) {
            curso.setStyle("-fx-background-color: #d13419");
            info.setText("Extre com um curso");
            return false;
        } else {
            curso.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }
    }

    private boolean TurmaSub(int idCurso) throws SQLException {
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        sql = "SELECT * FROM turmas WHERE ativo='S' AND idCurso = " + idCurso;
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);

        if (!result.next()) {
            curso.setStyle("-fx-background-color: #d13419");
            info.setText("Não existem turmas nesse curso");
            return false;
        } else {
            curso.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }

    }
    
    @FXML
    private void handleSeguirAction(ActionEvent event) throws SQLException {
        int idCurso = 0;
        if (handleExistenciaCurso()) {

            String sql = null;
            Conexão conn = new Conexão();
            Connection connection = conn.getConnection();
            if (connection != null) {
            } else {
                System.out.println("deu ruim :(");
            }
            ResultSet result;
            sql = "SELECT id FROM cursos WHERE ativo='S' AND nome = '" + curso.getValue() + "'";
            Statement fetch = connection.createStatement();
            result = fetch.executeQuery(sql);
            while (result.next()) {
                idCurso = result.getInt("id");
            }
            if (turmaSub(idCurso)) {
                manutencaoDepto.invocaVerificaTurma(idCurso);
            }
        }

    }

    @FXML
    private void handleCancelarAction(ActionEvent event) {
        manutencaoDepto.invocaLayoutBase();
    }

}
