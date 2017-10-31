package blt.java.disciplina.view;

import blt.java.disciplina.model.Disciplina;
import javafx.fxml.FXML;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;


/**
 * Dialog para editar detalhes de uma disciplina.
 *
 * @author Torres
 */
public class DisciplinaCaixaEditarControlador {

    @FXML
    private TextField idTurmaCampoTexto;
    @FXML
    private TextField nomeCampoTexto;
    @FXML
    private TextField cargaHorariaMinCampoTexto;

    private Stage dialogStage;
    private Disciplina disciplina;
    private boolean okClicked = false;

    
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
     * Define a disciplina a ser editada no dialog.
     *
     * @param disciplina
     */
    public void setDisciplina(Disciplina disciplina) {
        this.disciplina = disciplina;

        idTurmaCampoTexto.setText(Integer.toString(disciplina.getIdTurma()));
        nomeCampoTexto.setText(disciplina.getNome());
        cargaHorariaMinCampoTexto.setText(Integer.toString(disciplina.getCargaHorariaMin()));

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
    private void botaoOk() {
        if (isInputValid()) {

            disciplina.setIdTurma(Integer.parseInt(idTurmaCampoTexto.getText()));
            disciplina.setCargaHorariaMin(Integer.parseInt(cargaHorariaMinCampoTexto.getText()));
            disciplina.setNome(nomeCampoTexto.getText());


            okClicked = true;
            dialogStage.close();
        }
    }

    /**
     * Chamado quando o usuário clica Cancelar.
     */
    @FXML
    private void botaoCancelar() {
        dialogStage.close();
    }

    /**
     * Valida a entrada do usuário nos campos de texto.
     *
     * @return true se a entrada é válida
     */
    private boolean isInputValid() {
        String errorMessage = "";


        if (idTurmaCampoTexto.getText() == null || idTurmaCampoTexto.getText().length() == 0 || Integer.parseInt(idTurmaCampoTexto.getText())==0) {
            errorMessage += "Id da turma inválido!\n";
        } else {
            try {
                Integer.parseInt(idTurmaCampoTexto.getText());
            } catch (NumberFormatException e) {
                errorMessage += "Id da turma inválido (deve ser um inteiro)!\n";
            }
        }

        if (nomeCampoTexto.getText() == null || nomeCampoTexto.getText().length() == 0) {
            errorMessage += "Nome inválido!\n";
        }


        if (cargaHorariaMinCampoTexto.getText() == null || cargaHorariaMinCampoTexto.getText().length() == 0 ||  Integer.parseInt(cargaHorariaMinCampoTexto.getText())==0) {
            errorMessage += "Carga Horaria Mínima inválida!\n";
        } else {
            // tenta converter a carga horároa mínima em um int.
            try {
                Integer.parseInt(cargaHorariaMinCampoTexto.getText());
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