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
    private TextField idTurmaField;
    @FXML
    private TextField nomeField;
    @FXML
    private TextField cargaHorariaMinField;

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

        idTurmaField.setText(Integer.toString(disciplina.getIdTurma()));
        nomeField.setText(disciplina.getNome());
        cargaHorariaMinField.setText(Integer.toString(disciplina.getCargaHorariaMin()));

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

            disciplina.setIdTurma(Integer.parseInt(idTurmaField.getText()));
            disciplina.setCargaHorariaMin(Integer.parseInt(cargaHorariaMinField.getText()));
            disciplina.setNome(nomeField.getText());


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


        if (idTurmaField.getText() == null || idTurmaField.getText().length() == 0) {
            errorMessage += "Id da turma inválido!\n";
        } else {
            // tenta converter o código postal em um int.
            try {
                Integer.parseInt(idTurmaField.getText());
            } catch (NumberFormatException e) {
                errorMessage += "Id da turma inválido (deve ser um inteiro)!\n";
            }
        }

        if (nomeField.getText() == null || nomeField.getText().length() == 0) {
            errorMessage += "Nome inválido!\n";
        }


        if (cargaHorariaMinField.getText() == null || cargaHorariaMinField.getText().length() == 0) {
            errorMessage += "Carga Horaria Mínima inválida!\n";
        } else {
            // tenta converter o código postal em um int.
            try {
                Integer.parseInt(cargaHorariaMinField.getText());
            } catch (NumberFormatException e) {
                errorMessage += "Carga Horaria Mínima inválida (deve ser um inteiro)!\n";
            }
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