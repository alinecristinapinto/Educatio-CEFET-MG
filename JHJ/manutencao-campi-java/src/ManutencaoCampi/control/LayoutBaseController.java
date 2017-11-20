package ManutencaoCampi.control;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import ManutencaoCampi.ManutencaoCampi;
import ManutencaoCampi.model.ManutencaoCampiBD;
import java.net.URL;
import java.sql.SQLException;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;

public class LayoutBaseController implements Initializable {
    private ManutencaoCampi aplicacao;
    private ManutencaoCampiBD manutencao;
    @FXML
    private Button botaoPesquisa;
    @FXML
    private TextField campoTexto;
    private Image iconeBotaoPesquisa;
    private boolean aux;
    
    
    public LayoutBaseController(){
    }
    
    public void setAplicacao(ManutencaoCampi aplicacao){
        this.aplicacao=aplicacao;
    }
    
    @FXML
    private void handleCriaCampi(ActionEvent event) {
        boolean okClicked = aplicacao.invocaLayoutCriacao();
    }
    
    @FXML
    private void handleDeletaCampi(ActionEvent event) {
        boolean okClicked = aplicacao.invocaLayoutDelete();
    }
    
    @FXML
    private void handleEditaCampi(ActionEvent event) {
        boolean okCLicked = aplicacao.invocaLayoutAlteracao();
    }
    
    @FXML
    public void initialize(URL url, ResourceBundle rb) {
        aux = false;
        manutencao=new ManutencaoCampiBD();
        iconeBotaoPesquisa = new Image(getClass().getResourceAsStream("lupa.png"));
        botaoPesquisa.setGraphic(new ImageView(iconeBotaoPesquisa));
    }    
    
    @FXML
    public void cliqueCampoTexto(){
        if(aux==false){
            campoTexto.clear();
            campoTexto.setStyle("-fx-text-fill: white;");
            aux = true;
        }
    }
    
    @FXML
    public void pesquisaCampus() throws SQLException{
        String[] dadosCampus = new String[3];
        Alert alert = new Alert(javafx.scene.control.Alert.AlertType.INFORMATION);
        if(!campoTexto.getText().isEmpty()&&aux==true){
            dadosCampus = manutencao.pesquisaCampus(campoTexto.getText());
            if (dadosCampus!=null) {
                aplicacao.invocaLayoutBusca(dadosCampus[0], dadosCampus[1], dadosCampus[2]);
            }
            else{
                alert.setGraphic(new ImageView(iconeBotaoPesquisa));
                alert.setTitle("Busca por campus");
                alert.setHeaderText("Campus não encontrado: ");
                alert.setContentText("Nome: "+campoTexto.getText());
                alert.showAndWait();
            }
        }
        else{
            Alert alertaErro = new Alert(javafx.scene.control.Alert.AlertType.ERROR);
            alertaErro.setTitle("Erro");
            alertaErro.setHeaderText("Digite o nome do campus!");
            alertaErro.showAndWait();
        }
    }
}
