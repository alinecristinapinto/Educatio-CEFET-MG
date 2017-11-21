/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tpfinal.fx;

import java.io.IOException;
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
public class VerificaCampiController implements Initializable {

    private ManutencaoDepto manutencaoDepto;
    ManutencaoDepartamento manDep = new ManutencaoDepartamento();
    ObservableList<String> nomesCampi;
    int sw;
    @FXML
    private ChoiceBox campus;
    @FXML
    private Label info;

    @Override
    public void initialize(URL url, ResourceBundle rb) {

    }

    public void setManutencaoDepto(ManutencaoDepto manutencaoDepto) {
        this.manutencaoDepto = manutencaoDepto;
    }

    public void VerificaCampiPrep() throws SQLException {

        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        nomesCampi = FXCollections.observableArrayList();
        sql = "SELECT nome FROM campi WHERE ativo='S'";
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        while (result.next()) {
            nomesCampi.add(result.getString("nome"));
        }
        campus.setItems(nomesCampi);
    }

    public void setSw(int sw) {
        this.sw = sw;
    }

    private boolean handleExistenciaCampi() {
        if (campus.getValue() == null) {
            campus.setStyle("-fx-background-color: #d13419");
            info.setText("Extre com um campi");
            return false;
        } else {
            campus.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }
    }

    private boolean deptoSub(int idCampus) throws SQLException {
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
            campus.setStyle("-fx-background-color: #d13419");
            info.setText("Não existem departamentos nesse campus");
            return false;
        } else {
            campus.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }

    }

    @FXML
    private void handleSeguirAction(ActionEvent event) throws SQLException, IOException {
        int idCampus = 0;
        if (handleExistenciaCampi()) {

            String sql = null;
            Conexão conn = new Conexão();
            Connection connection = conn.getConnection();
            if (connection != null) {
            } else {
                System.out.println("deu ruim :(");
            }
            ResultSet result;
            sql = "SELECT id FROM campi WHERE ativo='S' AND nome = '" + campus.getValue() + "'";
            Statement fetch = connection.createStatement();
            result = fetch.executeQuery(sql);
            while (result.next()) {
                idCampus = result.getInt("id");
            }
            if (deptoSub(idCampus)) {
                if (sw == 1) {
                    manutencaoDepto.invocaLayoutAlterar(idCampus);
                }
                if (sw == 2) {
                    manutencaoDepto.invocaLayoutExcluir(idCampus);
                }
                if (sw == 3) {
                    manutencaoDepto.invocaVerificaDepto(idCampus);
                }
            }
        }
    }

    @FXML
    private void handleCancelarAction(ActionEvent event) throws SQLException {
        manutencaoDepto.invocaLayoutBase();
    }

}
