package ch.makery.address.view;

import ch.makery.address.MainApp;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.TextField;
import javafx.scene.control.RadioButton;
import ch.makery.address.model.Descarte;

public class PrincipalController {
    private String tipo;
    @FXML
    private TextField txtMatricula;
    @FXML
    private TextField txtNomeAcervo;
    @FXML
    private TextField txtMotivo;
    @FXML
    private RadioButton midias;
    @FXML
    private RadioButton livros;
    @FXML
    private RadioButton periodicos;
    @FXML
    private RadioButton academicos;

    private MainApp mainApp;
    private int idAcervo;

    public int getIdAcervo() {
        return idAcervo;
    }

    public void setIdAcervo(int idAcervo) {
        this.idAcervo = idAcervo;
    }
    
    public TextField getTxtMatricula() {
        return txtMatricula;
    }

    public void setTxtMatricula(TextField txtMatricula) {
        this.txtMatricula = txtMatricula;
    }

    public TextField getTxtNomeAcervo() {
        return txtNomeAcervo;
    }

    public void setTxtNomeAcervo(TextField txtNomeAcervo) {
        this.txtNomeAcervo = txtNomeAcervo;
    }

    public TextField getTxtMotivo() {
        return txtMotivo;
    }

    public void setTxtMotivo(TextField txtMotivo) {
        this.txtMotivo = txtMotivo;
    }

    public void setMainApp(MainApp mainApp) {
        this.mainApp = mainApp;
    }
    
    
    
    @FXML
    private void recebeDados(){
        if(this.isInputValid()){
            mainApp.invocaListaAcervos();
            /*try {
                    if(midias.isSelected()){
                        String tipo = "midias";
                    }if(academicos.isSelected()){
                        String tipo = "academicos";
                    }if(livros.isSelected()){
                        String tipo = "livros";
                    }if(periodicos.isSelected()){
                        String tipo = "periodicos";
                }
                Descarte descarte = new Descarte();
                descarte.setIdAcervo(idAcervo);
                descarte.descarta(txtNomeAcervo.getText(), tipo);     
            }catch (SQLException | ClassNotFoundException ex) {
                Logger.getLogger(PrincipalController.class.getName()).log(Level.SEVERE, null, ex);
            }*/
           
        }
    }
    @FXML
    private boolean isInputValid() {
        String errorMessage = "";
        if(txtMatricula == null||txtNomeAcervo == null||txtMotivo == null){
            errorMessage += "Campo em branco!\n";
        }else{
           try{
               Integer.parseInt(txtMatricula.getText());
           }catch(NumberFormatException e){
               errorMessage += "Matricula nao pode conter texto!\n";
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
