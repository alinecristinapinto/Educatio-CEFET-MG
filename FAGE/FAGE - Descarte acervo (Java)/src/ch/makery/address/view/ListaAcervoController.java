package ch.makery.address.view;

import ch.makery.address.MainApp;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.ListView;
import javafx.scene.control.TextField;

public class ListaAcervoController {
    @FXML
    private ListView listaDeAcervos;
    @FXML
    private TextField idAcervo;
    
    private MainApp mainApp;
    private PrincipalController pc;
    @FXML
    private Alert alert;
    
    @FXML
    private void selecionaId(){
       pc = new PrincipalController();
       if(idAcervo.getText()!=null){
          pc.setIdAcervo(Integer.parseInt(idAcervo.getText()));
          mainApp.initRootLayout();
       }else{
          alert = new Alert(javafx.scene.control.Alert.AlertType.INFORMATION);
          alert.setTitle("Campo em Branco");
          alert.setHeaderText("Campo Id em branco");
          alert.showAndWait();
       }  
     }

    public void setMainApp(MainApp mainApp) {
        this.mainApp = mainApp;
    }

    public ListView getListaDeAcervos() {
        return listaDeAcervos;
    }

    public void setListaDeAcervos(ListView listaDeAcervos) {
        this.listaDeAcervos = listaDeAcervos;
    }

    public TextField getIdAcervo() {
        return idAcervo;
    }

    public void setIdAcervo(TextField idAcervo) {
        this.idAcervo = idAcervo;
    }
    
    
}
