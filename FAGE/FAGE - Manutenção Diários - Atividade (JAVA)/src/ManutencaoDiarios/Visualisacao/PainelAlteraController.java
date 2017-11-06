package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.TextField;

/**
 *
 * @author Felipe
 */
public class PainelAlteraController {
    private ManutencaoDiarios manutencaoDiarios;

    @FXML
    private TextField nomeTurma;
    @FXML
    private TextField nomeDisciplina;
    
    
    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }
    
    public void confirma(){
        if(nomeTurma.getText() == null || nomeDisciplina.getText() == null){
            Alert alerta = new Alert(Alert.AlertType.INFORMATION);
            alerta.setTitle("Campos vazios");
            alerta.setHeaderText(null);
            alerta.setContentText("Preencha todos os campos para seguir!");

            alerta.showAndWait();
        }else{
            
        }
    }
    
    public void cancela(){
        System.exit(0);
    }
    
}
