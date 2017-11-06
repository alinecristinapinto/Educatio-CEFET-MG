package educatio.app.view.Alunos.controlador.visao;

import educatio.app.view.Alunos.controlador.BancoDeDados;
import educatio.app.view.Alunos.controlador.modelo.Aluno;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.collections.transformation.SortedList;
import javafx.fxml.FXML;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;

/**
 *
 * @author Pedro H
 */
public class PesquisaAlunoControlador {

    private BancoDeDados bd = new BancoDeDados();
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

    public PesquisaAlunoControlador() {
    }

    @FXML
    private void initialize() throws SQLException {
        conexao = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
        Statement stmt;
        try {
            stmt = conexao.createStatement();
            String sql = "SELECT * FROM alunos";
            ResultSet resultado = stmt.executeQuery(sql);
            while (resultado.next()) {
                dadosAluno.add(new Aluno(resultado.getString(3), resultado.getString(4), resultado.getString(5), resultado.getString(1), resultado.getString(6), resultado.getString(7), resultado.getString(8), resultado.getString(9), resultado.getString(10), resultado.getString(11), resultado.getString(12), resultado.getString(13), resultado.getInt(2)));
            }
            colunaNome.setCellValueFactory(cellData -> cellData.getValue().getNome());
            colunaCPF.setCellValueFactory(cellData -> cellData.getValue().getCPF());
            AlunoTabela.setItems(dadosAluno);
            
            FilteredList<Aluno> filtraDados = new FilteredList<>(dadosAluno, p -> true);
            
            pesquisaNome.textProperty().addListener((observable, oldValue, newValue) -> {
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
           sorteiaDados.comparatorProperty().bind(AlunoTabela.comparatorProperty());
           AlunoTabela.setItems(sorteiaDados);
            
        } catch (SQLException ex) {
            
        }
    }

}
