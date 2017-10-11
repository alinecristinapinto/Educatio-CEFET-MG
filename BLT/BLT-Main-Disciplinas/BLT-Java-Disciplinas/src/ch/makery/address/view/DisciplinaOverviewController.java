package ch.makery.address.view;

import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import ch.makery.address.MainApp;
import ch.makery.address.model.Disciplina;

public class DisciplinaOverviewController {
	 	@FXML
	    private TableView<Disciplina> disciplinaTabela;
	    @FXML
	    private TableColumn<Disciplina, String> nomeColuna;
	    @FXML
	    private TableColumn<Disciplina, String> professorColuna;

	    @FXML
	    private Label nomeLabel;
	    @FXML
	    private Label professorLabel;
	    @FXML
	    private Label campusLabel;
	    @FXML
	    private Label numeroAlunosLabel;
	    @FXML
	    private Label cursoLabel;

	 // Reference to the main application.
    private MainApp mainApp;

    /**
     * O construtor.
     * O construtor é chamado antes do método inicialize().
     */
    public DisciplinaOverviewController() {
    }

    /**
     * Chamado quando o usuário clica no botão novo. Abre uma janela para editar
     * detalhes da nova pessoa.
     */
    @FXML
    private void handleNewDisciplina() {
        Disciplina tempDisciplina = new Disciplina();
        boolean okClicked = mainApp.showDisciplinaEditDialog(tempDisciplina);
        if (okClicked) {
            mainApp.getDisciplinaData().add(tempDisciplina);
        }
    }

    /**
     * Chamado quando o usuário clica no botão edit. Abre a janela para editar
     * detalhes da pessoa selecionada.
     */
    @FXML
    private void handleEditDisciplina() {
        Disciplina selectedDisciplina = disciplinaTabela.getSelectionModel().getSelectedItem();
        if (selectedDisciplina != null) {
            boolean okClicked = mainApp.showDisciplinaEditDialog(selectedDisciplina);
            if (okClicked) {
                showDisciplinaDetails(selectedDisciplina);
            }

        } else {
            // Nada seleciondo.
            Alert alert = new Alert(AlertType.WARNING);
                alert.setTitle("Nenhuma seleção");
                alert.setHeaderText("Nenhuma Pessoa Selecionada");
                alert.setContentText("Por favor, selecione uma pessoa na tabela.");
                alert.showAndWait();
        }
    }

    @FXML
    private void handleDeleteDisciplina() {
        int selectedIndex = disciplinaTabela.getSelectionModel().getSelectedIndex();
        if (selectedIndex >= 0) {
            disciplinaTabela.getItems().remove(selectedIndex);
        } else {
            // Nada selecionado.

        Alert alert = new Alert(AlertType.WARNING);
                alert.setTitle("Nenhuma seleção");
                alert.setHeaderText("Nenhuma Disciplina Selecionada");
                alert.setContentText("Por favor, selecione uma disciplina na tabela.");

                alert.showAndWait();
        }
    }

    private void showDisciplinaDetails(Disciplina disciplina) {
        if (disciplina != null) {
            // Preenche as labels com informações do objeto person.
            nomeLabel.setText(disciplina.getNome());
            professorLabel.setText(disciplina.getProfessor());
            campusLabel.setText(disciplina.getCampus());
            numeroAlunosLabel.setText(Integer.toString(disciplina.getNumeroAlunos()));
            cursoLabel.setText(disciplina.getCurso());

            // TODO: Nós precisamos de uma maneira de converter o aniversário em um String!
            // birthdayLabel.setText(...);
        } else {
            // Person é null, remove todo o texto.
            nomeLabel.setText("");
            professorLabel.setText("");
            campusLabel.setText("");
            numeroAlunosLabel.setText("");
            cursoLabel.setText("");
        }
    }

    @FXML
    private void initialize() {
        // Inicializa a tabela de pessoas com duas colunas.
        nomeColuna.setCellValueFactory(
                cellData -> cellData.getValue().nomeProperty());
        professorColuna.setCellValueFactory(
                cellData -> cellData.getValue().professorProperty());

        // Limpa os detalhes da pessoa.
        showDisciplinaDetails(null);

        // Detecta mudanças de seleção e mostra os detalhes da pessoa quando houver mudança.
        disciplinaTabela.getSelectionModel().selectedItemProperty().addListener(
                (observable, oldValue, newValue) -> showDisciplinaDetails(newValue));
    }

    /**
     * É chamado pela aplicação principal para dar uma referência de volta a si mesmo.
     *
     * @param mainApp
     */
    public void setMainApp(MainApp mainApp) {
        this.mainApp = mainApp;

     // Adiciona os dados da observable list na tabela
        disciplinaTabela.setItems(mainApp.getDisciplinaData());
    }
}

