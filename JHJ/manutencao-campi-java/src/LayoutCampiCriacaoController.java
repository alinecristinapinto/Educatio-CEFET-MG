import java.net.URL;
import java.sql.SQLException;
import java.util.ResourceBundle;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.TextField;
import javafx.stage.Stage;


public class LayoutCampiCriacaoController implements Initializable {
    private ManutencaoCampiBD manutencao;
    @FXML
    private TextField nomeField;
    @FXML
    private TextField cidadeField;
    @FXML
    private TextField ufField;
    private Stage dialogStage;
    private boolean okClicked;
    
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }
    
    public void setDialogStage(Stage dialogStage){
        this.dialogStage = dialogStage;
    }
    
    public boolean isOkClicked(){
        return okClicked;
    }
    
    @FXML
    public void criaCampus() throws SQLException{
        manutencao.criaCampus(nomeField.getText(), cidadeField.getText(), ufField.getText());
        okClicked=true;
        dialogStage.close();
    }
    
    @FXML
    private void cancela() { 
        dialogStage.close(); 
    }

    
    public void setManutencao(ManutencaoCampiBD manutencao){
        this.manutencao = manutencao;
    }
}
