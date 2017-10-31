package blt.java.disciplina.view;

import blt.java.disciplina.model.Disciplina;
import javafx.fxml.FXML;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

/**
 *
 * @author Torres
 */
public class DisciplinaPesquisarControlador {
    
    @FXML
    private TextField disciplinaCampoTexto;
   
    private Stage dialogStage;
    private boolean okClicked = false;
    private Disciplina disciplina;

    @FXML
    private void initialize() {
    }

   
    public void setDialogStage(Stage dialogStage) {
        this.dialogStage = dialogStage;
    }
    
    public void setDisciplina(Disciplina disciplina) {
        this.disciplina = disciplina;

    }
    
    public boolean isOkClicked() {
        return okClicked;
    }

    /**
     * Chamado quando o usu�rio clica OK.
     */
    @FXML
    private void botaoOk() {
        
            disciplina.setNome(disciplinaCampoTexto.getText());


            okClicked = true;
            dialogStage.close();
        
    }

    /**
     * Chamado quando o usu�rio clica Cancel.
     */
    @FXML
    private void botaoCancelar() {
        dialogStage.close();
    }
}