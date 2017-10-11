package ch.makery.address.view;

import javafx.fxml.FXML;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;

import ch.makery.address.model.Disciplina;


/**
 * Dialog para editar detalhes de uma pessoa.
 *
 * @author Marco Jakob
 */
public class DisciplinaEditDialogController {

    @FXML
    private TextField nomeField;
    @FXML
    private TextField professorField;
    @FXML
    private TextField campusField;
    @FXML
    private TextField numeroAlunosField;
    @FXML
    private TextField cursoField;


    private Stage dialogStage;
    private Disciplina disciplina;
    private boolean okClicked = false;

    /**
     * Inicializa a classe controlle. Este método é chamado automaticamente
     * após o arquivo fxml ter sido carregado.
     */
    @FXML
    private void initialize() {
    }

    /**
     * Define o palco deste dialog.
     *
     * @param dialogStage
     */
    public void setDialogStage(Stage dialogStage) {
        this.dialogStage = dialogStage;
    }

    /**
     * Define a pessoa a ser editada no dialog.
     *
     * @param person
     */
    public void setDisciplina(Disciplina disciplina) {
        this.disciplina = disciplina;

        nomeField.setText(disciplina.getNome());
        professorField.setText(disciplina.getProfessor());
        campusField.setText(disciplina.getCampus());
        numeroAlunosField.setText(Integer.toString(disciplina.getNumeroAlunos()));
        cursoField.setText(disciplina.getCurso());
    }

    /**
     * Retorna true se o usuário clicar OK,caso contrário false.
     *
     * @return
     */
    public boolean isOkClicked() {
        return okClicked;
    }

    /**
     * Chamado quando o usuário clica OK.
     */
    @FXML
    private void handleOk() {
        if (isInputValid()) {
            disciplina.setNome(nomeField.getText());
            disciplina.setProfessor(professorField.getText());
            disciplina.setCampus(campusField.getText());
            disciplina.setNumeroAlunos(Integer.parseInt(numeroAlunosField.getText()));
            disciplina.setCurso(cursoField.getText());

            okClicked = true;
            dialogStage.close();
        }
    }

    /**
     * Chamado quando o usuário clica Cancel.
     */
    @FXML
    private void handleCancel() {
        dialogStage.close();
    }

    /**
     * Valida a entrada do usuário nos campos de texto.
     *
     * @return true se a entrada é válida
     */
    private boolean isInputValid() {
        String errorMessage = "";

        if (nomeField.getText() == null || nomeField.getText().length() == 0) {
            errorMessage += "Nome inválido!\n";
        }
        if (professorField.getText() == null || professorField.getText().length() == 0) {
            errorMessage += "Professor inválido!\n";
        }
        if (campusField.getText() == null || campusField.getText().length() == 0) {
            errorMessage += "Campus inválido!\n";
        }

        if (numeroAlunosField.getText() == null || numeroAlunosField.getText().length() == 0) {
            errorMessage += "Número de alunos inválido!\n";
        } else {
            // tenta converter o código postal em um int.
            try {
                Integer.parseInt(numeroAlunosField.getText());
            } catch (NumberFormatException e) {
                errorMessage += "Número de alunos inválido (deve ser um inteiro)!\n";
            }
        }

        if (cursoField.getText() == null || cursoField.getText().length() == 0) {
            errorMessage += "Curso inválido!\n";
        }



        if (errorMessage.length() == 0) {
            return true;
        } else {
            // Mostra a mensagem de erro.
            Alert alert = new Alert(AlertType.ERROR);
                      alert.setTitle("Campos Inválidos");
                      alert.setHeaderText("Por favor, corrija os campos inválidos");
                      alert.setContentText(errorMessage);
                alert.showAndWait();

            return false;
        }
    }
}