package blt.java.emprestimo.view;

import blt.java.emprestimo.model.Emprestimo;
import java.time.format.DateTimeFormatter;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.DatePicker;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

/**
 *
 * @author Torres
 */
public class EmprestimoPesquisarControlador {
    
    @FXML
    private TextField idAcervoCampoTexto;
    @FXML
    private DatePicker dataDevolucaoCampoTexto;
    
    private Stage dialogStage;
    private boolean okClicked = false;
    private Emprestimo emprestimo;

    @FXML
    private void initialize() {
    }

   
    public void setDialogStage(Stage dialogStage) {
        this.dialogStage = dialogStage;
    }
    
    public void setDisciplina(Emprestimo emprestimo) {
        this.emprestimo = emprestimo;

    }
    
    public boolean isOkClicked() {
        return okClicked;
    }

    /**
     * Chamado quando o usuário clica OK.
     */
    @FXML
    private void botaoOk() {
        if(isInputValid()){
            emprestimo.setIdAcervo(Integer.parseInt(idAcervoCampoTexto.getText()));
            emprestimo.setDataDevolucao(dataDevolucaoCampoTexto.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy"))); 

            okClicked = true;
            dialogStage.close();
        }
    }

    /**
     * Chamado quando o usuário clica Cancel.
     */
    @FXML
    private void botaoCancelar() {
        dialogStage.close();
    }
    
    private boolean isInputValid() {
        String errorMessage = "";


        if (idAcervoCampoTexto.getText() == null || idAcervoCampoTexto.getText().length() == 0 ) {
            errorMessage += "Id do acervo inválido!\n";
        } else {
            // tenta converter o id do acervo em um int.
            try {
                Integer.parseInt(idAcervoCampoTexto.getText());
            } catch (NumberFormatException e) {
                errorMessage += "Id do acervo inválido (deve ser um inteiro)!\n";
            }
        }
        
        if (dataDevolucaoCampoTexto.getValue() == null) {
            errorMessage += "Data de devolução inválida!\n";
        } 

        if (errorMessage.length() == 0) {
            return true;
        } else {
            // Mostra a mensagem de erro.
            Alert alert = new Alert(Alert.AlertType.ERROR);
                      alert.setTitle("Campos Inválidos");
                      alert.setHeaderText("Por favor, corrija os campos inválidos");
                      alert.setContentText(errorMessage);
                alert.showAndWait();

            return false;
        }
    }
}
