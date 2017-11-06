package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import java.sql.SQLException;
import java.time.format.DateTimeFormatter;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.DatePicker;
import javafx.scene.control.TextField;

/**
 *
 * @author Felipe
 */
public class PainelInsereController {
    private ManutencaoDiarios manutencaoDiarios;
    private Atividade atividade = new Atividade();
    
    @FXML
    private TextField nomeDisciplina;
    @FXML
    private TextField nomeTurma;
    @FXML
    private TextField nomeAtividade;
    @FXML
    private TextField valorAtividade;
    @FXML
    private DatePicker dataAtividade;
    
    private void initialize(){
        
    }

    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }
    
    public void confirma() throws ClassNotFoundException, SQLException{
        if(nomeDisciplina.getText() == null || nomeAtividade.getText() == null || nomeTurma.getText() == null || valorAtividade.getText() == null || dataAtividade.getValue() == null){
            Alert alerta = new Alert(AlertType.INFORMATION);
            alerta.setTitle("Campos vazios");
            alerta.setHeaderText(null);
            alerta.setContentText("Preencha todos os campos para seguir!");

            alerta.showAndWait();
        }else{
            atividade.insereAtividade(nomeDisciplina.getText(), nomeAtividade.getText(), 
            dataAtividade.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy")), 
            Double.parseDouble(valorAtividade.getText()), 1, nomeTurma.getText());
        
            Alert alerta = new Alert(AlertType.INFORMATION);
            alerta.setTitle("Inserção no Banco de Dados");
            alerta.setHeaderText(null);
            alerta.setContentText("Inserção no Banco de Dados realizada com sucesso!");

            alerta.showAndWait();
        }
    }
    
    public void cancela(){
        System.exit(0);
    }
}
