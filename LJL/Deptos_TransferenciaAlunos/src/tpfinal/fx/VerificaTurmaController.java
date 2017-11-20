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
public class VerificaTurmaController implements Initializable {

    @FXML
    private ChoiceBox turma;
    @FXML
    private Label info;
    private ManutencaoDepto manutencaoDepto;
    ObservableList<String> nomesTurma;
    private int idCurso;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        
    }

    public void setManutencaoDepto(ManutencaoDepto manutencaoDepto) {
        this.manutencaoDepto = manutencaoDepto;
    }

    public void setIdCurso(int idCurso) {
        this.idCurso = idCurso;
    }

    public void VerificaTurmaPrep() throws SQLException {

        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        nomesTurma = FXCollections.observableArrayList();
        sql = "SELECT nome FROM turmas WHERE ativo='S' AND idCurso = '" + idCurso+"'";
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        while (result.next()) {
            nomesTurma.add(result.getString("nome"));
        }
        turma.setItems(nomesTurma);
    }

    private boolean handleExistenciaTurma() {
        if (turma.getValue() == null) {
            turma.setStyle("-fx-background-color: #d13419");
            info.setText("Extre com um turma");
            return false;
        } else {
            turma.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }
    }

    private boolean alunoSub(int idTurma) throws SQLException {
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        sql = "SELECT * FROM alunos WHERE ativo='S' AND idTurma = " + idTurma;
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);

        if (!result.next()) {
            turma.setStyle("-fx-background-color: #d13419");
            info.setText("Não existem alunos nessa turma");
            return false;
        } else {
            turma.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }

    }
    
    @FXML
    private void handleSeguirAction(ActionEvent event) throws SQLException {
        int idTurma = 0;
        if (handleExistenciaTurma()) {

            String sql = null;
            Conexão conn = new Conexão();
            Connection connection = conn.getConnection();
            if (connection != null) {
            } else {
                System.out.println("deu ruim :(");
            }
            ResultSet result;
            sql = "SELECT id FROM turmas WHERE ativo='S' AND nome = '" + turma.getValue() + "'";
            Statement fetch = connection.createStatement();
            result = fetch.executeQuery(sql);
            while (result.next()) {
                idTurma = result.getInt("id");
            }
            if (alunoSub(idTurma)){
                manutencaoDepto.invocaLayoutTransferirAluno(idTurma);
            }
        }

    }

    @FXML
    private void handleCancelarAction(ActionEvent event) {
        manutencaoDepto.invocaLayoutBase();
    }

}

