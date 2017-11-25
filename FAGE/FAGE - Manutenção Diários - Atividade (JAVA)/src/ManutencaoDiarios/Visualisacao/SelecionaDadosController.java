package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import ManutencaoDiarios.Modelo.Disciplina;
import ManutencaoDiarios.Modelo.Turma;
import java.io.IOException;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.Label;
import testeclassealert.AlertaPadrao;

/**
 *
 * @author Felipe
 */
public class SelecionaDadosController {
    private ManutencaoDiarios manutencaoDiarios;
    private Atividade atividade = new Atividade();
    private Disciplina disciplina = new Disciplina();
    private Turma turma = new Turma();
    private String nomeDisciplina = new String();
    
    @FXML
    private ChoiceBox disciplinas;
    
    @FXML
    private ChoiceBox turmas;
    
    @FXML
    private Label labelTurma;
    
    @FXML
    private void initialize() throws SQLException{
        disciplinas.setItems(atividade.pegaDisciplinas());
        turmas.setVisible(false);
        labelTurma.setVisible(false);
        
        disciplinas.getSelectionModel().selectedItemProperty().addListener(
            (observable, oldValue, newValue) -> {
            try {
                continuar(newValue.toString());
            } catch (SQLException | IOException ex) {
                Logger.getLogger(SelecionaDadosController.class.getName()).log(Level.SEVERE, null, ex);
            }
        });
    }
    
    //    private ManutencaoDiariosIntegracao manutencaoDiariosIntegracao;
//    public ManutencaoDiariosIntegracao getManutencaoDiariosIntegracao(){
//        return manutencaoDiariosIntegracao;
//    }
    

    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }
    
    public void continuar(String valor) throws SQLException, IOException{
        nomeDisciplina = valor;
        
        if(nomeDisciplina == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
            
        }else{
            turmas.setItems(atividade.pegaTurmas(nomeDisciplina));
            turmas.setVisible(true);
            labelTurma.setVisible(true);
        }
    }
    
    public void confirmar() throws SQLException{
        disciplina.setNome(nomeDisciplina);
        turma.setNome(turmas.getSelectionModel().getSelectedItem().toString());
        manutencaoDiarios.chamaEscolhe(disciplina, turma);
    }
    
    public void sair(){
        System.exit(0);
    }
}
