package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.ChoiceBox;

/**
 *
 * @author Felipe
 */
public class MostraDisciplinasController {
    private ManutencaoDiarios manutencaoDiarios;
    private Atividade atividade = new Atividade();
    private String disciplina = new String();
    private String turma = new String();
    
    @FXML
    private ChoiceBox disciplinas;
    
    @FXML
    private ChoiceBox turmas;
    
    @FXML
    private ChoiceBox nomes;
    
    @FXML
    private void initialize() throws SQLException{
        disciplinas.setItems(atividade.pegaDisciplinas());
        turmas.setVisible(false);
        nomes.setVisible(false);
        
        disciplinas.getSelectionModel().selectedItemProperty().addListener(
            (observable, oldValue, newValue) -> {
            try {
                confirma(newValue.toString());
            } catch (SQLException ex) {
                Logger.getLogger(MostraDisciplinasController.class.getName()).log(Level.SEVERE, null, ex);
            }
        });
        
        turmas.getSelectionModel().selectedItemProperty().addListener(
            (observable, oldValue, newValue) -> {
            try {
                colocaNomes(newValue.toString());
            } catch (SQLException ex) {
                Logger.getLogger(MostraDisciplinasController.class.getName()).log(Level.SEVERE, null, ex);
            }
        });
    }

    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }
    
    public void confirma(String valor) throws SQLException{
        disciplina = valor;
        
        if(disciplina == null){
            Alert alerta = new Alert(Alert.AlertType.INFORMATION);
            alerta.setTitle("Campos vazios");
            alerta.setHeaderText(null);
            alerta.setContentText("Preencha todos os campos para continuar!");
            
            alerta.showAndWait();
        }else{
            turmas.setItems(atividade.pegaTurmas(disciplina));
            turmas.setVisible(true);
            
        }
    }
    
    public void colocaNomes(String valor) throws SQLException{
        turma = valor;
        
        if(turma == null){
            Alert alerta = new Alert(Alert.AlertType.INFORMATION);
            alerta.setTitle("Campos vazios");
            alerta.setHeaderText(null);
            alerta.setContentText("Preencha todos os campos para continuar!");
            
            alerta.showAndWait();
        }else{
            nomes.setItems(atividade.pegaNomes(disciplina, turma));
            nomes.setVisible(true);
        }
    }
    
    public void alterar(){
        
    }
    
    public void deletar(){
        
    }
    
    public void cancela(){
        System.exit(0);
    }
}
