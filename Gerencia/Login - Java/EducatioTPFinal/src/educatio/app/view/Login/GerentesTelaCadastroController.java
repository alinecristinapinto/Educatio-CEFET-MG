/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package educatio.app.view.Login;

import educatio.app.mainApp;
import educatio.app.model.Login.Aluno;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.Menu;


public class GerentesTelaCadastroController {
   
    @FXML
    private ChoiceBox caixaSelecaoCargo;
    
    private ObservableList<String> listaOpcoes = FXCollections.observableArrayList("Aluno","Professor","Coordenador","Bibliotecário");



    private mainApp mainApp;
   
    @FXML
    private void initialize() {
      caixaSelecaoCargo.setValue("Aluno");  
      caixaSelecaoCargo.setItems(listaOpcoes);   
    }
    
    public void setMainApp(mainApp mainApp) {
        this.mainApp = mainApp;
    }
    
    public void acaoAvancar(){
       String opcaoSelecionada = (String) caixaSelecaoCargo.getValue();
        System.out.println(opcaoSelecionada);
    }
    public void voltaLogin(){
        mainApp.mostraLogin();
    }
}