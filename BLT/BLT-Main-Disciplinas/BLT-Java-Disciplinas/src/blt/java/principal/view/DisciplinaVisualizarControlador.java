package blt.java.principal.view;

import blt.java.principal.MainApp;
import blt.java.principal.jdbc.DisciplinaDao;
import blt.java.principal.model.Disciplina;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.stage.Stage;


public class DisciplinaVisualizarControlador {
    @FXML
    private TableView<Disciplina> disciplinaTabela;
    @FXML
    private TableColumn<Disciplina, String> nomeColuna;
    @FXML
    private TableColumn<Disciplina, Integer> idTurmaColuna;
    @FXML
    private TableColumn<Disciplina, Integer> cargaHorariaMinColuna;

    MainApp mainApp;
    private Stage dialogStage;
    DisciplinaDao bd = new DisciplinaDao();
    /**
     * O construtor.
     * O construtor é chamado antes do método inicialize().
     */
    public DisciplinaVisualizarControlador() {
    }

    public void setDialogStage(Stage dialogStage) {
        this.dialogStage = dialogStage;
    }


    /**
     * Inicializa a classe controller. Este método é chamado automaticamente
     *  após o arquivo fxml ter sido carregado.
     */
    @FXML
    private void initialize() {
        // Inicializa a tablea de pessoa com duas colunas.
    	nomeColuna.setCellValueFactory(new PropertyValueFactory<Disciplina, String>("nome"));
        idTurmaColuna.setCellValueFactory(new PropertyValueFactory<Disciplina, Integer>("idTurma"));
        cargaHorariaMinColuna.setCellValueFactory(new PropertyValueFactory<Disciplina, Integer>("cargaHorariaMin"));

        ObservableList<Disciplina> disciplinas = FXCollections.observableArrayList(bd.getLista());
        disciplinaTabela.setItems(disciplinas);
    }

    @FXML
    private void botaoOk() {
        dialogStage.close();
    }
    /**
     * É chamado pela aplicação principal para dar uma referência de volta a si mesmo.
     *
     * @param mainApp
     */

}
