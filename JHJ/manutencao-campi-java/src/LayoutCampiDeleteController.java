import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.ChoiceBox;
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

    public void setDialogStage(Stage dialogStage) { this.dialogStage = dialogStage; }

    @FXML
    private void handleCancel() { dialogStage.close(); }

    @FXML
    private void handleDeleteCampi() throws SQLException {
        dadosCampusDeletado=manutencao.deletaCampus(caixaSelecao.getValue().toString());
        Alert alert = new Alert(javafx.scene.control.Alert.AlertType.INFORMATION);
        alert.setTitle("Exclusão Campus");
        alert.setHeaderText("Campus deletado com sucesso!\n\nDados do campus deletado:");
        alert.setContentText("Nome: "+dadosCampusDeletado[0]+"\nCidade: "+dadosCampusDeletado[1]+"\nUF: "+dadosCampusDeletado[2]);
        alert.showAndWait();
        dialogStage.close();
        okClicked = true;
    }

    public void setManutencao(ManutencaoCampiBD manutencao){
        this.manutencao = manutencao;
    }

    public boolean isOkClicked(){
        return okClicked;
    }
}
