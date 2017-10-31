package blt.java.emprestimo.view;

import blt.java.emprestimo.jdbc.EmprestimoDao;
import blt.java.emprestimo.model.Emprestimo;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.stage.Stage;


public class EmprestimoVisualizarControlador {
    @FXML
    private TableView<Emprestimo> emprestimoTabela;
    @FXML
    private TableColumn<Emprestimo, String> idAlunoColuna;
    @FXML
    private TableColumn<Emprestimo, Integer> idAcervoColuna;
    @FXML
    private TableColumn<Emprestimo, String> dataEmprestimoColuna;
    @FXML
    private TableColumn<Emprestimo, String> dataPrevisaoDevolucaoColuna;
    @FXML
    private TableColumn<Emprestimo, String> dataDevolucaoColuna;
    @FXML
    private TableColumn<Emprestimo, Integer> multaColuna;

    private Stage dialogStage;
    EmprestimoDao bd = new EmprestimoDao();
    
    
    public EmprestimoVisualizarControlador() {
    }

    public void setDialogStage(Stage dialogStage) {
        this.dialogStage = dialogStage;
    }

    /**
     * Inicializa a classe controlador. Este método é chamado automaticamente
     *  após o arquivo fxml ter sido carregado.
     */
    @FXML
    private void initialize() {
        // Inicializa a tablea de pessoa com seis colunas.
    	idAlunoColuna.setCellValueFactory(new PropertyValueFactory<Emprestimo, String>("idAluno"));
        idAcervoColuna.setCellValueFactory(new PropertyValueFactory<Emprestimo, Integer>("idAcervo"));
        dataEmprestimoColuna.setCellValueFactory(new PropertyValueFactory<Emprestimo, String>("dataEmprestimo"));
        dataPrevisaoDevolucaoColuna.setCellValueFactory(new PropertyValueFactory<Emprestimo, String>("dataPrevisaoDevolucao"));
        dataDevolucaoColuna.setCellValueFactory(new PropertyValueFactory<Emprestimo, String>("dataDevolucao"));
        multaColuna.setCellValueFactory(new PropertyValueFactory<Emprestimo, Integer>("multa"));
        
        ObservableList<Emprestimo> emprestimos = FXCollections.observableArrayList(bd.getLista());
        emprestimoTabela.setItems(emprestimos);
    }

    @FXML
    private void botaoOk() {
        dialogStage.close();
    }

}
