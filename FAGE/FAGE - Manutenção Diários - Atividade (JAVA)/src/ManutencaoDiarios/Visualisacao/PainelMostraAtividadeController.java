package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;

/**
 *
 * @author Felipe
 */
public class PainelMostraAtividadeController {
    private ManutencaoDiarios manutencaoDiarios;
    private Atividade atividade = new Atividade();
    
    //@FXML
    //private TextField
    
    private void initialize(){
        
    }
    
    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }
    
    
}
