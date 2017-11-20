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

public class LayoutCampiAlteracao2Controller implements Initializable {
    @FXML
    private TextField nomeField;
    @FXML
    private TextField cidadeField;
    @FXML
    private ChoiceBox caixaSelecaoUf;
    @FXML
    private Label labelErro;
    @FXML
    private TextField ufField;
    private Stage dialogStage;
    private boolean okClicked = false;
    private boolean[] dadosSelecao;
    private String nomeCampus;
    private ManutencaoCampiBD manutencao;
    private String[] dadosAntigosCampus;
    private String[] dadosCampusAlterado;
    private ManutencaoCampi aplicacao;
    private boolean[] testeEntradaDados;
    private ObservableList<String> listaUf;
    
    public LayoutCampiAlteracao2Controller(){
        dadosSelecao = new boolean[3];
        testeEntradaDados = new boolean[2];
        testeEntradaDados[0]=false;
        testeEntradaDados[1]=false;
    }
    
    public void setManutencao(ManutencaoCampiBD manutencao) throws SQLException{
        this.manutencao=manutencao;
        dadosAntigosCampus = manutencao.pesquisaCampus(nomeCampus);
        nomeField.setText(dadosAntigosCampus[0]);
        cidadeField.setText(dadosAntigosCampus[1]);
        ufField.setText(dadosAntigosCampus[2]);
    }
    
    public void setDadosSelecao(boolean[] dadosSelecao, String nomeCampus) throws SQLException{
        this.dadosSelecao = dadosSelecao;
        this.nomeCampus=nomeCampus;
        
        nomeField.setEditable(dadosSelecao[0]);
        cidadeField.setEditable(dadosSelecao[1]);
        ufField.setEditable(false);
        caixaSelecaoUf.setVisible(dadosSelecao[2]);
        ufField.setVisible(!dadosSelecao[2]);
    }
    
    @FXML
    public void initialize(URL url, ResourceBundle rb){
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
    
    public void cancela(){
        aplicacao.invocaLayoutBase();
    }
    
    @FXML
    public void alteraCampus() throws SQLException{
        if(!nomeField.getText().isEmpty()&&!cidadeField.getText().isEmpty()&&((caixaSelecaoUf.getValue()!=null&&dadosSelecao[2]==true)||(dadosSelecao[2]==false))){
            if((testeEntradaDados[0]==dadosSelecao[0])&&(testeEntradaDados[1]==dadosSelecao[1])&&((dadosSelecao[2]==true&&caixaSelecaoUf.getValue()!=null)||(dadosSelecao[2]==false))){
                    if(dadosSelecao[2]==true){
                        dadosCampusAlterado = manutencao.alteraCampus(nomeCampus, nomeField.getText(), cidadeField.getText(), caixaSelecaoUf.getValue().toString(), dadosSelecao);
                    }
                    else{
                        dadosCampusAlterado = manutencao.alteraCampus(nomeCampus, nomeField.getText(), cidadeField.getText(), dadosAntigosCampus[2], dadosSelecao);
                    }
                    Alert alert = new Alert(javafx.scene.control.Alert.AlertType.INFORMATION);
                    alert.setTitle("Alteração Campus");
                    alert.setHeaderText("Campus alterado com sucesso!\n\nNovos dados do campus: ");
                    alert.setContentText("Nome: "+dadosCampusAlterado[0]+"\nCidade: "+dadosCampusAlterado[1]+"\nUF: "+dadosCampusAlterado[2]);
                    alert.showAndWait();
                    okClicked=true;
                    aplicacao.invocaLayoutBase();
                    testeEntradaDados[0]=false;
                    testeEntradaDados[1]=false;
            }
            else{
                Alert alertaErro = new Alert(javafx.scene.control.Alert.AlertType.ERROR);
                alertaErro.setTitle("Erro");
                alertaErro.setHeaderText("Entre com os dados!");
                alertaErro.showAndWait();
            }
        }
        else{
            Alert alertaErro = new Alert(javafx.scene.control.Alert.AlertType.ERROR);
            alertaErro.setTitle("Erro");
            alertaErro.setHeaderText("Entre com os dados!");
            alertaErro.showAndWait();
        }
    }
    
    @FXML
    public void sobreNomeField(){
        if(dadosSelecao[0]==true&&nomeField.getText().equals(dadosAntigosCampus[0])&&testeEntradaDados[0]!=dadosSelecao[0]){
            nomeField.clear();
        }
        testeEntradaDados[0]=dadosSelecao[0];
    }
    
    @FXML
    public void sobreCidadeField(){
        if(dadosSelecao[1]==true&&cidadeField.getText().equals(dadosAntigosCampus[1])&&testeEntradaDados[1]!=dadosSelecao[1]){
            cidadeField.clear();
        }
        testeEntradaDados[1]=dadosSelecao[1];
    }
}