package blt.java.emprestimo.view;

import blt.java.emprestimo.model.Emprestimo;
import javafx.fxml.FXML;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import blt.java.emprestimo.util.DataUtil;
import java.text.ParseException;
import java.time.format.DateTimeFormatter;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.DatePicker;



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
    @FXML
    private DatePicker dataEmprestimoCampoTexto;
    @FXML
    private DatePicker dataPrevisaoDevolucaoCampoTexto;
    @FXML
    private DatePicker dataDevolucaoCampoTexto;
  

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
            emprestimo.setDataEmprestimo(dataEmprestimoCampoTexto.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy")));
            emprestimo.setDataPrevisaoDevolucao(dataPrevisaoDevolucaoCampoTexto.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy")));
            emprestimo.setDataDevolucao(dataDevolucaoCampoTexto.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy")));  
            emprestimo.setMulta(DataUtil.calculaDiferencaDias(dataDevolucaoCampoTexto.getValue(), dataPrevisaoDevolucaoCampoTexto.getValue()));
            
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

    /**
     * Valida a entrada do usuário nos campos de texto.
     *
     * @return true se a entrada é válida
     */
    private boolean isInputValid() {
        String errorMessage = "";


        if (idAcervoCampoTexto.getText() == null || idAcervoCampoTexto.getText().length() == 0 || Integer.parseInt(idAcervoCampoTexto.getText())==0) {
            errorMessage += "Id do acervo inválido!\n";
        } else {
            // tenta converter o id do acervo em um int.
            try {
                Integer.parseInt(idAcervoCampoTexto.getText());
            } catch (NumberFormatException e) {
                errorMessage += "Id do acervo inválido (deve ser um inteiro)!\n";
            }
        }

        if (idAlunoCampoTexto.getText() == null || idAlunoCampoTexto.getText().length() == 0) {
            errorMessage += "Id do aluno inválido!\n";
        }
        
        if (dataEmprestimoCampoTexto.getValue() == null) {
            errorMessage += "Data do empréstimo inválido!\n";
        }
         
        if (dataPrevisaoDevolucaoCampoTexto.getValue() == null) {
            errorMessage += "Data de previsão de devolução inválida!\n";
        }
        
        if (dataDevolucaoCampoTexto.getValue() == null) {
            errorMessage += "Data de devolução inválida!\n";
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
