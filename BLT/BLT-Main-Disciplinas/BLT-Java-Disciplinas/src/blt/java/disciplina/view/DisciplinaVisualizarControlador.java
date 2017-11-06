package blt.java.disciplina.view;

import blt.java.disciplina.ManutencaoDisciplinas;
import blt.java.disciplina.jdbc.DisciplinaDao;
import blt.java.disciplina.model.Disciplina;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.stage.Stage;

/**
 * 
 * @author Torres
 */

public class DisciplinaVisualizarControlador {
    @FXML
    private TableView<Disciplina> disciplinaTabela;
    @FXML
    private TableColumn<Disciplina, String> nomeColuna;
    @FXML
    private TableColumn<Disciplina, Integer> idTurmaColuna;
    @FXML
    private TableColumn<Disciplina, Integer> cargaHorariaMinColuna;

    ManutencaoDisciplinas mainApp;
    private Stage dialogStage;
    DisciplinaDao bd = new DisciplinaDao();
   
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
        // Inicializa a tablea de disciplina com três colunas.
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

}
