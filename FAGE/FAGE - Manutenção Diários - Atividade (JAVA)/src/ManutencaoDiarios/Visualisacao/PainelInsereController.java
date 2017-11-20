package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import java.io.IOException;
import java.sql.SQLException;
import java.time.format.DateTimeFormatter;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.DatePicker;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import testeclassealert.AlertaPadrao;


/**
 *
 * @author Felipe
 */
public class PainelInsereController {
    private ManutencaoDiarios manutencaoDiarios;
    private Atividade atividade = new Atividade();
    private String disciplina = new String();
    private String turma = new String();
    
    @FXML
    private ChoiceBox disciplinas;
    @FXML
    private ChoiceBox turmas;
    @FXML
    private TextField nomeAtividade;
    @FXML
    private TextField valorAtividade;
    @FXML
    private DatePicker dataAtividade;
    @FXML
    private Label labelTurma;
    @FXML
    private Label labelNome;
    @FXML
    private Label labelValor;
    @FXML
    private Label labelData;
    
    @FXML
    private void initialize() throws SQLException{
        disciplinas.setItems(atividade.pegaDisciplinas());
        
        turmas.setVisible(false);
        nomeAtividade.setVisible(false);
        valorAtividade.setVisible(false);
        dataAtividade.setVisible(false);
        labelTurma.setVisible(false);
        labelNome.setVisible(false);
        labelValor.setVisible(false);
        labelData.setVisible(false);
        
        dataAtividade.setEditable(false);
        
        disciplinas.getSelectionModel().selectedItemProperty().addListener(
            (observable, oldValue, newValue) -> {
            try {
                try {
                    confirma(newValue.toString());
                } catch (IOException ex) {
                    Logger.getLogger(PainelInsereController.class.getName()).log(Level.SEVERE, null, ex);
                }
            } catch (SQLException ex) {
                Logger.getLogger(PainelInsereController.class.getName()).log(Level.SEVERE, null, ex);
            }
        });
        
        turmas.getSelectionModel().selectedItemProperty().addListener(
            (observable, oldValue, newValue) -> {
            try {
                try {
                    mostrarCamposInserir(newValue.toString());
                } catch (IOException ex) {
                    Logger.getLogger(PainelInsereController.class.getName()).log(Level.SEVERE, null, ex);
                }
            } catch (SQLException ex) {
                Logger.getLogger(PainelInsereController.class.getName()).log(Level.SEVERE, null, ex);
            }
        });
    }

    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }
    
    public void confirma(String valor) throws SQLException, IOException{
        disciplina = valor;
        
        if(disciplina == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
            
        }else{
            turmas.setItems(atividade.pegaTurmas(disciplina));
            turmas.setVisible(true);
            labelTurma.setVisible(true);
        }
    }
    
    public void mostrarCamposInserir(String valor) throws SQLException, IOException{
        turma = valor;
        
        if(turma == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
            
        }else{
            labelNome.setVisible(true);
            labelValor.setVisible(true);
            labelData.setVisible(true);
            valorAtividade.setVisible(true);
            nomeAtividade.setVisible(true);
            dataAtividade.setVisible(true);
        }
    }
    
    public void insereBd() throws ClassNotFoundException, SQLException, IOException{
        if(valorAtividade.getText().equals("") || nomeAtividade.getText().equals("") || dataAtividade.getValue() == null){
           AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
            
        }else if(!valorAtividade.getText().matches("^([0-9]{1,2}){1}(.[0-9]{1,2})?$")){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos preenchidos incorretamente", "Erro!", "Preencha corretamente todos os campos para continuar.");
            
        }else{
            atividade.insereAtividade((String) disciplinas.getValue(), nomeAtividade.getText(), 
            dataAtividade.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy")), 
            Double.parseDouble(valorAtividade.getText()), 1, (String) turmas.getValue());
        
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertConfirmacao(manutencaoDiarios.getPalcoPrincipal(), "Inserção", "Sucesso!", "Inserção realizada com sucesso no banco de dados.");
            
            System.exit(0);
        }
    }
    
    public void cancela(){
        System.exit(0);
    }
}
