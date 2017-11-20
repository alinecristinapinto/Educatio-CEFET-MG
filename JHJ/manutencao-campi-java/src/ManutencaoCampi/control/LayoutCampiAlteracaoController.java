package ManutencaoCampi.control;

import ManutencaoCampi.ManutencaoCampi;
import java.net.URL;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.CheckBox;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.Label;
import javafx.stage.Stage;

public class LayoutCampiAlteracaoController implements Initializable {
    private Stage dialogStage;
    private boolean okClicked;
    @FXML
    private CheckBox checkBoxNome;
    @FXML
    private CheckBox checkBoxCidade;
    @FXML
    private CheckBox checkBoxUf;
    ManutencaoCampi aplicacao;
    @FXML
    private ChoiceBox caixaSelecao;
    private Connection conn;
    private ObservableList<String> nomesCampi;
    private ResultSet result;
    @FXML
    private Label labelErro;
    @FXML
    private Label labelErroCheckBox;
    
    public LayoutCampiAlteracaoController() throws SQLException{
        conn = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
        nomesCampi = FXCollections.observableArrayList();
        String sql_fetch = "SELECT nome FROM campi WHERE ativo='S'";
        Statement fetch = conn.createStatement();
        result = fetch.executeQuery(sql_fetch);
        while(result.next()){
            nomesCampi.add(result.getString("nome"));
        }
        result.close();
    }
    
    public void setAplicacao(ManutencaoCampi aplicacao){
        this.aplicacao=aplicacao;
    }
    
    public boolean isOkClicked(){
        return okClicked;
    }
    
    @FXML
    public void proxJanela() throws SQLException{
        boolean[] dadosSelecao={checkBoxNome.isSelected(), checkBoxCidade.isSelected(), checkBoxUf.isSelected()};
        boolean okClicked;
        if(!(checkBoxNome.isSelected()==false&&checkBoxCidade.isSelected()==false&&checkBoxUf.isSelected()==false)&&(caixaSelecao.getValue()!=null)){
            okClicked=aplicacao.invocaLayoutAlteracao2(dadosSelecao, caixaSelecao.getValue().toString());
        }
        if(caixaSelecao.getValue()==null){
            Alert alertaErro = new Alert(javafx.scene.control.Alert.AlertType.ERROR);
            alertaErro.setTitle("Erro");
            alertaErro.setHeaderText("Selecione o campus!");
            alertaErro.showAndWait();        }
        else{
            labelErro.setText("");
        }
        if(checkBoxNome.isSelected()==false&&checkBoxCidade.isSelected()==false&&checkBoxUf.isSelected()==false&&caixaSelecao.getValue()!=null){
            Alert alertaErro = new Alert(javafx.scene.control.Alert.AlertType.ERROR);
            alertaErro.setTitle("Erro");
            alertaErro.setHeaderText("Selecione os dados!");
            alertaErro.showAndWait();
        }
        else{
            labelErroCheckBox.setText("");
        }
    }
    
    public void initialize(URL url, ResourceBundle rb) {
        caixaSelecao.setItems(nomesCampi);
        
    }
    
    @FXML
    public void cancela(){
        aplicacao.invocaLayoutBase();
    }
}
