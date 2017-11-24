/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package LJL.transferenciaalunos;

import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.collections.transformation.FilteredList;
import javafx.collections.transformation.SortedList;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;

/**
 * FXML Controller class
 *
 * @author Aluno
 */
public class LayoutTransferAlunoController implements Initializable {

    private TransferenciaAlunos transferenciaAlunos;
    FilteredList<Aluno> filtraDados;
    @FXML
    private TableColumn<Aluno, String> alunoCPF;
    @FXML
    private TableColumn<Aluno, String> alunoNome;
    private int idTurma;
    
    
    public void setTransferenciaAlunos(TransferenciaAlunos transferenciaAlunos) {
        this.transferenciaAlunos = transferenciaAlunos;
    }

    public LayoutTransferAlunoController() throws SQLException {
        try {
            String sql = null;
            Conexão conn = new Conexão();
            Connection connection = conn.getConnection();
            if (connection != null) {
            } else {
                System.out.println("deu ruim :(");
            }
            ResultSet result;
            dadosAluno = FXCollections.observableArrayList();
            sql = "SELECT * FROM alunos WHERE ativo='S'";
            Statement fetch = connection.createStatement();
            result = fetch.executeQuery(sql);
            while (result.next()) {
                dadosAluno.add(new Aluno(result.getString("nome"), result.getString("CPF")));
            }
            alunoNome.setCellValueFactory(cellData -> cellData.getValue().getNome());
            alunoCPF.setCellValueFactory(cellData -> cellData.getValue().getCPF());
            alunos.setItems(dadosAluno);

            filtraDados = new FilteredList<>(dadosAluno, p -> true);

            pesq.textProperty().addListener((observable, oldValue, newValue) -> {
                filtraDados.setPredicate(Aluno -> {
                    // If filter text is empty, display all persons.
                    if (newValue == null || newValue.isEmpty()) {
                        return true;
                    }

                    // Compare first name and last name of every person with filter text.
                    String lowerCaseFilter = newValue.toLowerCase();

                    if (Aluno.getNome().toString().toLowerCase().contains(lowerCaseFilter)) {
                        return true; // Filter matches first name.
                    }
                    return false; // Does not match.
                });
            });
            SortedList<Aluno> sorteiaDados = new SortedList<>(filtraDados);
            sorteiaDados.comparatorProperty().bind(alunos.comparatorProperty());
            alunos.setItems(sorteiaDados);
        } catch (SQLException ex) {

        }
    }

    @FXML
    public void handlePesq() throws SQLException {
        filtraDados = new FilteredList<>(dadosAluno, p -> true);

        pesq.textProperty().addListener((observable, oldValue, newValue) -> {
            filtraDados.setPredicate(aluno -> {
                // If filter text is empty, display all persons.
                if (newValue == null || newValue.isEmpty()) {
                    return true;
                }

                // Compare first name and last name of every person with filter text.
                String lowerCaseFilter = newValue.toLowerCase();

                if (aluno.getCPF().toString().toLowerCase().contains(lowerCaseFilter)) {
                    return true; // Filter matches first name.
                } else if (aluno.getNome().toString().toLowerCase().contains(lowerCaseFilter)) {
                    return true; // Filter matches last name.
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
    private boolean handleExistenciaAluno() {
        if (alunos.getSelectionModel().getSelectedItem() == null) {
            alunos.setStyle("-fx-background-color: #d13419");
            info.setText("Selecione um aluno");
            return false;
        } else {
            alunos.setStyle("-fx-background-color: #6989FF");
            info.setText("");
            return true;
        }
    }

    public void handleTransferirAction() throws SQLException {
        if (handleExistenciaAluno()) {
            try {
                String sql = null;
                Conexão conn = new Conexão();
                Connection connection = conn.getConnection();
                if (connection != null) {
                } else {
                    System.out.println("deu ruim :(");
                }
                sql = "UPDATE `alunos`"
                        + " SET `ativo` = 'N'"
                        + " WHERE `alunos`.`idCPF` = '" + alunos.getSelectionModel().getSelectedItem().getCPF().getValue() + "'";
                PreparedStatement stmt = connection.prepareStatement(sql);
                stmt.execute();
                stmt.close();
            } catch (SQLException e) {
                throw new RuntimeException(e);
            }
            //chama o histórico
            transferenciaAlunos.invocaLayoutBase();
        }
    }

    public void handleCancelarAction() {
        transferenciaAlunos.invocaLayoutBase();
    }

    ObservableList<Aluno> dadosAluno;
    @FXML
    private TableView<Aluno> alunos;
    @FXML
    private Label info;
    @FXML
    private TextField pesq;

    @Override
    public void initialize(URL url, ResourceBundle rb) {

    }
    
    
    public void LayoutTransferirAlunoPrep() {
        try {
            String sql = null;
            Conexão conn = new Conexão();
            Connection connection = conn.getConnection();
            if (connection != null) {
            } else {
                System.out.println("deu ruim :(");
            }
            ResultSet result;
            dadosAluno = FXCollections.observableArrayList();
            sql = "SELECT * FROM alunos WHERE ativo='S' AND idTurma = "+idTurma;
            Statement fetch = connection.createStatement();
            result = fetch.executeQuery(sql);
            while (result.next()) {
                dadosAluno.add(new Aluno(result.getString("nome"), result.getString("idCPF")));
            }
            alunoNome.setCellValueFactory(cellData -> cellData.getValue().getNome());
            alunoCPF.setCellValueFactory(cellData -> cellData.getValue().getCPF());
            alunos.setItems(dadosAluno);

        } catch (SQLException ex) {

        }

    }

    /**
     * @param idTurma the idTurma to set
     */
    public void setIdTurma(int idTurma) {
        this.idTurma = idTurma;
    }

}
