package blt.java.emprestimo.view;

import blt.java.emprestimo.model.Emprestimo;
import javafx.fxml.FXML;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;



/**
 * Dialog para editar detalhes de um empréstimo.
 *
 * @author Torres
 */
public class EmprestimoCaixaEditarControlador {

    @FXML
    private TextField idAlunoCampoTexto;
    @FXML
    private TextField idAcervoCampoTexto;
  

    private Stage dialogStage;
    private Emprestimo emprestimo;
    private boolean okClicked = false;

    /**
     * Inicializa a classe controlador. Este método é chamado automaticamente
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
     * Define o empréstimo a ser editado no dialog.
     *
     * @param emprestimo
     */
    public void setEmprestimo(Emprestimo emprestimo) {
        this.emprestimo = emprestimo;
    }

    /**
     * Retorna true se o usuário clicar OK, caso contrário false.
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
    private void botaoOk() throws ParseException {
        if (isInputValid()) {

            emprestimo.setIdAluno(idAlunoCampoTexto.getText());
            emprestimo.setIdAcervo(Integer.parseInt(idAcervoCampoTexto.getText()));
            Date d = new Date();
            emprestimo.setDataEmprestimo(new SimpleDateFormat("dd/MM/yyyy").format(d));
            long timeNovaData = d.getTime() + (1000*60*60*24*7);
            emprestimo.setDataPrevisaoDevolucao(new SimpleDateFormat("dd/MM/yyyy").format(new Date(timeNovaData))); 
            
            
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


        if (idAcervoCampoTexto.getText() == null || idAcervoCampoTexto.getText().length() == 0 || idAcervoCampoTexto.getText().equals("0")) {
            errorMessage += "Id do acervo inválido!\n";
        } else {
            // tenta converter o id do acervo em um int.
            try {
                Integer.parseInt(idAcervoCampoTexto.getText());
            } catch (NumberFormatException e) {
                errorMessage += "Id do acervo inválido (deve ser um inteiro)!\n";
            }
        }

        if (idAlunoCampoTexto.getText() == null || idAlunoCampoTexto.getText().length() != 11 || idAlunoCampoTexto.getText().equals("0")) {
            errorMessage += "Id do aluno inválido!\n";
        } else {
            // tenta converter o id do acervo em um int.
            try {
                Float.parseFloat(idAlunoCampoTexto.getText());
            } catch (NumberFormatException e) {
                errorMessage += "Id do aluno inválido (deve ser em formato cpf)!\n";
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
