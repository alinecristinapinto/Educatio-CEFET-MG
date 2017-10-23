import java.net.URL;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

public class LayoutCampiAlteracao2Controller implements Initializable {
    @FXML
    private TextField nomeField;
    @FXML
    private TextField cidadeField;
    @FXML
    private TextField ufField;
    private Stage dialogStage;
    private boolean okClicked = false;
    private boolean[] dadosSelecao;
    private String nomeCampus;
    private ManutencaoCampiBD manutencao;
    private String[] dadosAntigosCampus;
    private String[] dadosCampusAlterado;
    
    public LayoutCampiAlteracao2Controller(){
        dadosSelecao=new boolean[3];
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
        ufField.setEditable(dadosSelecao[2]);
    }
    
    @FXML
    public void initialize(URL url, ResourceBundle rb){
    }
    
    public void setDialogStage(Stage dialogStage){
        this.dialogStage=dialogStage;
    }
    
    public boolean isOkClicked(){
        return okClicked;
    }
    
    public void cancela(){
        dialogStage.close();
    }
    
    @FXML
    public void alteraCampus() throws SQLException{
        dadosCampusAlterado = manutencao.alteraCampus(nomeCampus, nomeField.getText(), cidadeField.getText(), ufField.getText(), dadosSelecao);
        Alert alert = new Alert(javafx.scene.control.Alert.AlertType.INFORMATION);
        alert.setTitle("Alteração Campus");
        alert.setHeaderText("Campus alterado com sucesso!\n\nNovos dados do campus: ");
        alert.setContentText("Nome: "+dadosCampusAlterado[0]+"\nCidade: "+dadosCampusAlterado[1]+"\nUF: "+dadosCampusAlterado[2]);
        alert.showAndWait();
        dialogStage.close();
        okClicked=true;
    }
    
    @FXML
    public void sobreNomeField(){
        if(dadosSelecao[0]==true)
            nomeField.clear();
    }
    
    @FXML
    public void sobreCidadeField(){
        if(dadosSelecao[1]==true)
            cidadeField.clear();
    }
    
    @FXML
    public void sobreUfField(){
        if(dadosSelecao[2]==true)
            ufField.clear();
    }
}