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
import javafx.scene.control.CheckBox;
import javafx.scene.control.ChoiceBox;
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
    ManutencaoCampi manutencaoCampi;
    @FXML
    private ChoiceBox caixaSelecao;
    private Connection conn;
    private ObservableList<String> nomesCampi;
    private ResultSet result;
    
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
    
    public void setManutencaoCampi(ManutencaoCampi manutencaoCampi){
        this.manutencaoCampi=manutencaoCampi;
    }

    public void setDialogStage(Stage dialogStage) {
        this.dialogStage = dialogStage;
    }
    
    public boolean isOkClicked(){
        return okClicked;
    }
    
    @FXML
    public void proxJanela(){
        boolean[] dadosSelecao={checkBoxNome.isSelected(), checkBoxCidade.isSelected(), checkBoxUf.isSelected()};
        boolean okClicked;
        if(!(checkBoxNome.isSelected()==false&&checkBoxCidade.isSelected()==false&&checkBoxUf.isSelected()==false)){
            okClicked=manutencaoCampi.invocaLayoutAlteracao2(dadosSelecao, caixaSelecao.getValue().toString());
            dialogStage.close();
        }
    }
    
    public void initialize(URL url, ResourceBundle rb) {
        caixaSelecao.setItems(nomesCampi);
    }
}
