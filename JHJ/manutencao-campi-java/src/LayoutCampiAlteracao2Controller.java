import java.net.URL;
import java.sql.SQLException;
import java.util.ResourceBundle;
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
    private String[] dadosCampusAlterado;
    
    public void setManutencao(ManutencaoCampiBD manutencao){
        this.manutencao=manutencao;
    }
    
    public void setDadosSelecao(boolean[] dadosSelecao, String nomeCampus){
        this.dadosSelecao = dadosSelecao;
        this.nomeCampus=nomeCampus;
    }
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
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
}
