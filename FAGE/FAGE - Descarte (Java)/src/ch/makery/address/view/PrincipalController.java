package ch.makery.address.view;

import ch.makery.address.MainApp;
import ch.makery.address.model.Acervo;
import java.sql.SQLException;
import java.time.format.DateTimeFormatter;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.DatePicker;
import javafx.scene.control.TextField;
import javafx.scene.control.RadioButton;
import javafx.scene.control.TextArea;
import javafx.scene.control.ToggleGroup;
public class PrincipalController {
    @FXML
    private TextField txtIdFuncionario;
    @FXML
    private TextField txtNomeAcervo;
    @FXML
    private TextArea txtMotivo;
    @FXML
    private ToggleGroup tipoDoAcervo;
    @FXML
    private RadioButton midias;
    @FXML
    private RadioButton livros;
    @FXML
    private RadioButton periodicos;
    @FXML
    private RadioButton academicos;
    @FXML
    private DatePicker data;

    private MainApp mainApp;
    private Acervo acervoRecebe;
    private String tipo;
    
    public TextField getTxtIdFuncionario() {
        return txtIdFuncionario;
    }

    public void setTxtIdFuncionario(TextField txtIdFuncionario) {
        this.txtIdFuncionario = txtIdFuncionario;
    }

    public TextField getTxtNomeAcervo() {
        return txtNomeAcervo;
    }

    public void setTxtNomeAcervo(TextField txtNomeAcervo) {
        this.txtNomeAcervo = txtNomeAcervo;
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
        acervoRecebe.setTudo(10,txtNomeAcervo.getText(), null, null, null, tipo, txtMotivo.getText(), txtIdFuncionario.getText(), data.getValue().format(DateTimeFormatter.ofPattern("dd-MM-yyyy")));
        System.out.println(acervoRecebe);
    }
    
    
    @FXML
    private void recebeDados(){
        if(tipoDoAcervo.getSelectedToggle().equals(livros)){
            tipo = "livros";
        }if(tipoDoAcervo.getSelectedToggle().equals(academicos)){
            tipo = "academicos";
        }if(tipoDoAcervo.getSelectedToggle().equals(midias)){
            tipo = "midias";
        }if(tipoDoAcervo.getSelectedToggle().equals(periodicos)){
            tipo = "periodicos";
        }
        setAcervoRecebe();
        mainApp.invocaListaAcervos(acervoRecebe);
    }
    
    @FXML
    private boolean isInputValid() {
        String errorMessage = "";
        if(txtIdFuncionario == null||txtNomeAcervo == null||txtMotivo == null){
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
