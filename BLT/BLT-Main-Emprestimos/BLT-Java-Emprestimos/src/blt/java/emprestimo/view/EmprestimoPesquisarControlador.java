package blt.java.emprestimo.view;

import blt.java.emprestimo.model.Emprestimo;
import javafx.fxml.FXML;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

/**
 *
 * @author Torres
 */
public class EmprestimoPesquisarControlador {
    
    @FXML
    private TextField emprestimoCampoTexto;
   
    private Stage dialogStage;
    private boolean okClicked = false;
    private Emprestimo emprestimo;

    @FXML
    private void initialize() {
    }

   
    public void setDialogStage(Stage dialogStage) {
        this.dialogStage = dialogStage;
    }
    
    public void setDisciplina(Emprestimo disciplina) {
        this.emprestimo = disciplina;

    }
    
    public boolean isOkClicked() {
        return okClicked;
    }

    /**
     * Chamado quando o usuário clica OK.
     */
    @FXML
    private void botaoOk() {
        
            emprestimo.setIdAluno(emprestimoCampoTexto.getText());


            okClicked = true;
            dialogStage.close();
        
    }

    /**
     * Chamado quando o usuário clica Cancel.
     */
    @FXML
    private void botaoCancelar() {
        dialogStage.close();
    }
}