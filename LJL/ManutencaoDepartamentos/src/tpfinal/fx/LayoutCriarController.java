package tpfinal.fx;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
import javafx.scene.control.TextField;
import javafx.stage.Stage;

/**
 * FXML Controller class
 *
 * @author Aluno
 */
public class LayoutCriarController implements Initializable {

    private ManutencaoDepto manutencaoDepto;
    ManutencaoDepartamento manDep = new ManutencaoDepartamento();
    ObservableList<String> nomesCampi;

    public void setManutencaoDepto(ManutencaoDepto manutencaoDepto) {
        this.manutencaoDepto = manutencaoDepto;
    }

    public LayoutCriarController() throws SQLException {
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
    }

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        campus.setItems(nomesCampi);
    }

    @FXML
    private ChoiceBox campus;
    @FXML
    private Label info;
    @FXML
    private TextField nome;
    Stage thisStage;

    public void setThisStage(Stage thisStage) {
        this.thisStage = thisStage;
    }

    @FXML
    private boolean handleExistenciaNome() throws SQLException {

        if (nome.getText().isEmpty()) {
            nome.setStyle("-fx-background-color: #d13419");
            info.setText("Extre com um nome");
            return false;
        } else {
            nome.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }
    }

    @FXML
    private boolean handleNomeRepetido() throws SQLException {
        String sql = null;
        boolean a = true;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        sql = "SELECT id FROM campi WHERE nome = '" + campus.getValue() + "'";
        ResultSet result;
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        result.next();
        sql = "SELECT nome FROM deptos WHERE idCampi = '" + result.getString("id") + "'";
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
    private boolean handleExistenciaCampi() {
        if (campus.getValue() == null) {
            campus.setStyle("-fx-background-color: #d13419");
            info.setText("Extre com um campus");
            return false;
        } else {
            campus.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }
    }

    @FXML
    private void handleCriarAction() throws SQLException, IOException {
        if (handleExistenciaNome()) {
            if (handleExistenciaCampi()) {
                if (handleNomeRepetido()) {
                    String sql = null;
                    Conexão conn = new Conexão();
                    Connection connection = conn.getConnection();
                    if (connection != null) {
                    } else {
                        System.out.println("deu ruim :(");
                    }
                    ResultSet result;
                    sql = "SELECT id FROM `campi` WHERE nome = '" + (campus.getValue()).toString() + "'";
                    Statement fetch = connection.createStatement();
                    result = fetch.executeQuery(sql);
                    result.next();
                    manDep.CriarDepartamento(Integer.parseInt(result.getString("id")), nome.getText());
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
