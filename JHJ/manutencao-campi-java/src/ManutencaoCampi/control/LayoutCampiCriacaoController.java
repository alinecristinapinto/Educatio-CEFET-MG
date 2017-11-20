package ManutencaoCampi.control;

import ManutencaoCampi.ManutencaoCampi;
import ManutencaoCampi.model.ManutencaoCampiBD;
import java.net.URL;
import java.sql.SQLException;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.stage.Stage;


public class LayoutCampiCriacaoController implements Initializable {
    private ManutencaoCampiBD manutencao;
    @FXML
    private Label labelErro;
    @FXML
    private TextField nomeField;
    @FXML
    private TextField cidadeField;
    @FXML
    private ChoiceBox caixaSelecaoUf;
    private Stage dialogStage;
    private boolean okClicked;
    private ManutencaoCampi aplicacao;
    private ObservableList<String> listaUf;
    
    @FXML
    public void initialize(URL url, ResourceBundle rb) {
        listaUf = FXCollections.observableArrayList();
        listaUf.addAll("AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MG", "MS", "MT", "PA", "PB", "PE", "PI", "PR", "RJ", "RN", "RO", "RR", "RS", "SC", "SE", "SP", "TO");
        caixaSelecaoUf.setItems(listaUf);
    }
    
    public void setAplicacao(ManutencaoCampi aplicacao){
        this.aplicacao = aplicacao;
    }
    
    public boolean isOkClicked(){
        return okClicked;
    }
    
    @FXML
    public void criaCampus() throws SQLException{
        if(!(nomeField.getText().isEmpty()||cidadeField.getText().isEmpty()||caixaSelecaoUf.getValue()==null)){
            manutencao.criaCampus(nomeField.getText(), cidadeField.getText(), caixaSelecaoUf.getValue().toString());
            okClicked=true;
            aplicacao.invocaLayoutBase();
        }
        else{
            Alert alertaErro = new Alert(javafx.scene.control.Alert.AlertType.ERROR);
            alertaErro.setTitle("Erro");
            alertaErro.setHeaderText("Preencha todos os campos!");
            alertaErro.showAndWait();
        }
    }
    
    @FXML
    private void cancela() { 
        aplicacao.invocaLayoutBase();
    }

    
    public void setManutencao(ManutencaoCampiBD manutencao){
        this.manutencao = manutencao;
    }
}
