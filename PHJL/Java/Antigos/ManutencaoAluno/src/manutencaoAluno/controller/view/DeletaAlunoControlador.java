package manutencaoAluno.controller.view;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Optional;
import javafx.beans.property.StringProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.collections.transformation.SortedList;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import manutencaoAluno.controller.BancoDeDados;
import manutencaoAluno.controller.model.Aluno;

/**
 *
 * @author Pedro H
 */
public class DeletaAlunoControlador {

    private BancoDeDados acessoBancoDeDados = new BancoDeDados();
    private ObservableList<Aluno> dadosAluno = FXCollections.observableArrayList();
    private Connection conexao = null;

    @FXML
    private TableView<Aluno> AlunoTabela;
    @FXML
    private TableColumn<Aluno, String> colunaNome;
    @FXML
    private TableColumn<Aluno, String> colunaCPF;

    @FXML
    private TextField pesquisaNome;
    @FXML
    private TextField pesquisaCPF;
    @FXML
    private Button botaoDeleta;

    public DeletaAlunoControlador() {
    }

    @FXML
    private void initialize() throws SQLException {
        conexao = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
        Statement stmt;
        try {
            stmt = conexao.createStatement();
            String sql = "SELECT * FROM alunos WHERE ativo LIKE 'S'";
            ResultSet resultado = stmt.executeQuery(sql);
            while (resultado.next()) {
                dadosAluno.add(new Aluno(resultado.getString(3), resultado.getString(4), resultado.getString(5), resultado.getString(1), resultado.getString(6), resultado.getString(7), resultado.getString(8), resultado.getString(9), resultado.getString(10), resultado.getString(11), resultado.getString(12), resultado.getString(13), resultado.getInt(2)));
            }
            colunaNome.setCellValueFactory(cellData -> cellData.getValue().getNome());
            colunaCPF.setCellValueFactory(cellData -> cellData.getValue().getCPF());
            AlunoTabela.setItems(dadosAluno);
            
            FilteredList<Aluno> filtraDados = new FilteredList<>(dadosAluno, p -> true);

            pesquisaNome.textProperty().addListener((observador, valorVelho, valorNovo) -> {
                filtraDados.setPredicate(Aluno -> {

                    if (valorNovo == null || valorNovo.isEmpty()) {
                        return true;
                    }

                    String lowerCaseFilter = valorNovo.toLowerCase();

                    if (Aluno.getNome().toString().toLowerCase().contains(lowerCaseFilter)) {
                        return true;
                    }
                    return false;
                });
            });

            pesquisaCPF.textProperty().addListener((observador, valorVelho, valorNovo) -> {
                filtraDados.setPredicate(Aluno -> {

                    if (valorNovo == null || valorNovo.isEmpty()) {
                        return true;
                    }

                    String lowerCaseFilter = valorNovo.toLowerCase();

                    if (Aluno.getCPF().toString().toLowerCase().contains(lowerCaseFilter)) {
                        return true;
                    }
                    return false;
                });
            });

            SortedList<Aluno> sorteiaDados = new SortedList<>(filtraDados);
            sorteiaDados.comparatorProperty().bind(AlunoTabela.comparatorProperty());
            AlunoTabela.setItems(sorteiaDados);

        } catch (SQLException ex) {

        }
    }

    @FXML
    private void deletaAluno() throws SQLException {
        AlunoTabela.setEditable(true);
        Aluno usuarioProperty = AlunoTabela.getSelectionModel().getSelectedItem();
        StringProperty cpf = usuarioProperty.getCPF();
        String valorCPF = cpf.toString().split("[:][ ]")[1].substring(0, (cpf.toString().split("[:][ ]")[1].length() - 1));

        Alert confirmacao = new Alert(Alert.AlertType.CONFIRMATION);

        confirmacao.setTitle("");
        confirmacao.setHeaderText("Confirmação de Exclusão de Aluno");
        confirmacao.setContentText("Você realmente deseja deletar este aluno?");

        Optional<ButtonType> result = confirmacao.showAndWait();

        if (result.get() == ButtonType.OK) {
            //Código se o usuário clicou em OK
            conexao = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
            Statement stmt;
            try {
                stmt = conexao.createStatement();
                String sql = "UPDATE alunos SET ativo='N' WHERE idCPF LIKE " + valorCPF;
                int resultado = stmt.executeUpdate(sql);
            } catch (SQLException ex) {
                ex.printStackTrace();
            }
            /*
                Aluno selectedItem = AlunoTabela.getSelectionModel().getSelectedItem();
                dadosAluno.remove(selectedItem.getCPF());
            */
        } else {
            //Código se o usuário clicou em Cancel
        }
 
    }

}
