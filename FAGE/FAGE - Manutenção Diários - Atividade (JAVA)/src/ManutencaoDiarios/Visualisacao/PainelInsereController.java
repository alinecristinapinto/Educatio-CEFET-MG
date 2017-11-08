package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import java.sql.SQLException;
import java.time.format.DateTimeFormatter;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.DatePicker;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;


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
        
        disciplinas.getSelectionModel().selectedItemProperty().addListener(
            (observable, oldValue, newValue) -> {
            try {
                confirma(newValue.toString());
            } catch (SQLException ex) {
                Logger.getLogger(PainelInsereController.class.getName()).log(Level.SEVERE, null, ex);
            }
        });
        
        turmas.getSelectionModel().selectedItemProperty().addListener(
            (observable, oldValue, newValue) -> {
            try {
                mostrarCamposInserir(newValue.toString());
            } catch (SQLException ex) {
                Logger.getLogger(PainelInsereController.class.getName()).log(Level.SEVERE, null, ex);
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
            labelTurma.setVisible(true);
        }
    }
    
    public void mostrarCamposInserir(String valor) throws SQLException{
        turma = valor;
        
        if(turma == null){
            Alert alerta = new Alert(Alert.AlertType.INFORMATION);
            alerta.setTitle("Campos vazios");
            alerta.setHeaderText(null);
            alerta.setContentText("Preencha todos os campos para continuar!");
            
            alerta.showAndWait();
        }else{
            labelNome.setVisible(true);
            labelValor.setVisible(true);
            labelData.setVisible(true);
            valorAtividade.setVisible(true);
            nomeAtividade.setVisible(true);
            dataAtividade.setVisible(true);
        }
    }
    
    public void insereBd() throws ClassNotFoundException, SQLException{
        if(valorAtividade.getText().equals("") || nomeAtividade.getText().equals("") || dataAtividade.getValue() == null){
            Alert alerta = new Alert(AlertType.INFORMATION);
            alerta.setTitle("Campos vazios");
            alerta.setHeaderText(null);
            alerta.setContentText("Preencha todos os campos para seguir!");

            alerta.showAndWait();
        }else{
            atividade.insereAtividade((String) disciplinas.getValue(), nomeAtividade.getText(), 
            dataAtividade.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy")), 
            Double.parseDouble(valorAtividade.getText()), 1, (String) turmas.getValue());
        
            Alert alerta = new Alert(AlertType.INFORMATION);
            alerta.setTitle("Inserção no Banco de Dados");
            alerta.setHeaderText(null);
            alerta.setContentText("Inserção no Banco de Dados realizada com sucesso!");

            alerta.showAndWait();
            
            System.exit(0);
        }
    }
    
    public void cancela(){
        System.exit(0);
    }
}
