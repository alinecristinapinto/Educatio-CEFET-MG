package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;

/**
 *
 * @author Felipe
 */
public class PainelAltera2Controller {
    private ManutencaoDiarios manutencaoDiarios;
    private Atividade atividade = new Atividade();
    
    @FXML
    private TextField nome;
    @FXML
    private TextField data;
    @FXML
    private TextField valor;
    @FXML
    private Label labelVazio;

    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }
    
    public void confirma(){
        
    }
}
