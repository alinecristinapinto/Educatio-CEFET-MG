package ManutencaoCampi.control;

import ManutencaoCampi.ManutencaoCampi;
import ManutencaoCampi.model.ManutencaoCampiBD;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Optional;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.Label;
import javafx.stage.Stage;

public class LayoutCampiDeleteController
{
    private String[] dadosCampusDeletado;
    private ManutencaoCampiBD manutencao;
    Connection conn;
    ObservableList<String> nomesCampi;
    @FXML
    private ChoiceBox caixaSelecao;
    private Stage dialogStage;
    private boolean okClicked = false;
    ResultSet result;
    private ManutencaoCampi aplicacao;
    @FXML
    private Label labelErro;
    
    public LayoutCampiDeleteController() throws SQLException{
        conn = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
        nomesCampi = FXCollections.observableArrayList();
        String sql_fetch = "SELECT nome FROM campi WHERE ativo='S'";
        Statement fetch = conn.createStatement();
        result = fetch.executeQuery(sql_fetch);
        while(result.next()){
            nomesCampi.add(result.getString("nome"));
        }
    }
    @FXML
    private void initialize(){
        caixaSelecao.setItems(nomesCampi);
    }

    public void setAplicacao(ManutencaoCampi aplicacao) {
        this.aplicacao = aplicacao;
    }

    @FXML
    private void cancela() {
        aplicacao.invocaLayoutBase();
    }

    @FXML
    private void handleDeleteCampi() throws SQLException {
        String[] nomesDeptosAux;
        String nomesDeptos = new String();
        if(caixaSelecao.getValue()!=null){
            if((nomesDeptosAux = manutencao.campiEstaVazio(caixaSelecao.getValue().toString()))!=null){
                for(int i=0; i<nomesDeptosAux.length; i++){
                    nomesDeptos += "\n"+nomesDeptosAux[i];
                }
                Alert confirmacao = new Alert(Alert.AlertType.CONFIRMATION);
                confirmacao.setTitle("Confirmar exclusão");
                confirmacao.setHeaderText("O campus possui os seguintes departamentos vinculados a ele: \n"+nomesDeptos+"\n");
                confirmacao.setContentText("Deseja excluí-lo mesmo assim?");
                
                Optional<ButtonType> result = confirmacao.showAndWait();
                if (result.get() == ButtonType.OK){
                    dadosCampusDeletado=manutencao.deletaCampus(caixaSelecao.getValue().toString());
                    Alert alert = new Alert(javafx.scene.control.Alert.AlertType.INFORMATION);
                    alert.setTitle("Exclusão Campus");
                    alert.setHeaderText("Campus deletado com sucesso!\n\nDados do campus deletado:");
                    alert.setContentText("Nome: "+dadosCampusDeletado[0]+"\nCidade: "+dadosCampusDeletado[1]+"\nUF: "+dadosCampusDeletado[2]);
                    alert.showAndWait();
                    okClicked = true;
                    aplicacao.invocaLayoutBase();
                } 
                else {
                    confirmacao.close();
                }
            }
            else{
                Alert confirmacao = new Alert(Alert.AlertType.CONFIRMATION);
                confirmacao.setTitle("Confirmar exclusão");
                confirmacao.setHeaderText("Deseja realmente excluir o campus selecionado?");
                
                Optional<ButtonType> result = confirmacao.showAndWait();
                if (result.get() == ButtonType.OK){
                    dadosCampusDeletado=manutencao.deletaCampus(caixaSelecao.getValue().toString());
                    Alert alert = new Alert(javafx.scene.control.Alert.AlertType.INFORMATION);
                    alert.setTitle("Exclusão Campus");
                    alert.setHeaderText("Campus deletado com sucesso!\n\nDados do campus deletado:");
                    alert.setContentText("Nome: "+dadosCampusDeletado[0]+"\nCidade: "+dadosCampusDeletado[1]+"\nUF: "+dadosCampusDeletado[2]);
                    alert.showAndWait();
                    okClicked = true;
                    aplicacao.invocaLayoutBase();
                } 
                else {
                    confirmacao.close();
                }
                
            }
        }
        else{
            Alert alertaErro = new Alert(javafx.scene.control.Alert.AlertType.ERROR);
            alertaErro.setTitle("Erro");
            alertaErro.setHeaderText("Selecione o campus!");
            alertaErro.showAndWait();
        }
    }

    public void setManutencao(ManutencaoCampiBD manutencao){
        this.manutencao = manutencao;
    }

    public boolean isOkClicked(){
        return okClicked;
    }
}
