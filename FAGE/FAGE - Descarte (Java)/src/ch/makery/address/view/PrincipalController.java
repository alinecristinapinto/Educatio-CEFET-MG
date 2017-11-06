package ch.makery.address.view;

import ch.makery.address.MainApp;
import ch.makery.address.model.Acervo;
import java.time.format.DateTimeFormatter;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.DatePicker;
import javafx.scene.control.TextField;
import javafx.scene.control.TextArea;

public class PrincipalController {
    @FXML
    private TextField txtIdFuncionario;
    @FXML
    private TextArea txtMotivo;
    @FXML
    private DatePicker data;

    private MainApp mainApp;
    private Acervo acervoRecebe;
    
    public TextField getTxtIdFuncionario() {
        return txtIdFuncionario;
    }

    public void setTxtIdFuncionario(TextField txtIdFuncionario) {
        this.txtIdFuncionario = txtIdFuncionario;
    }

    public TextArea getTxtMotivo() {
        return txtMotivo;
    }

    public void setTxtMotivo(TextArea txtMotivo) {
        this.txtMotivo = txtMotivo;
    }

    public void setMainApp(MainApp mainApp) {
        this.mainApp = mainApp;
    }
    
    private void setAcervoRecebe(){
        acervoRecebe = new Acervo();
        acervoRecebe.setTudo(0,null, null, null, null, null, txtMotivo.getText(), txtIdFuncionario.getText(), data.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy")));
    }
    
    
    @FXML
    private void recebeDados(){
        setAcervoRecebe();
        mainApp.invocaListaAcervos(acervoRecebe);
    }
    
    @FXML
    private boolean isInputValid() {
        String errorMessage = "";
        if(txtIdFuncionario == null||txtMotivo == null){
            errorMessage += "Campo em branco!\n";
        }else{
           try{
               Integer.parseInt(txtIdFuncionario.getText());
           }catch(NumberFormatException e){
               errorMessage += "Matricula e um inteiro!\n";
           }
           
        }

        if (errorMessage.length() == 0) {
            return true;
        } else {
            // Mostra a mensagem de erro.
            Alert alert = new Alert(Alert.AlertType.ERROR);
                      alert.setTitle("Campos invalidos");
                      alert.setHeaderText("Por favor, corrija os campos invalidos");
                      alert.setContentText(errorMessage);
                alert.showAndWait();

            return false;
        }
    }
}
