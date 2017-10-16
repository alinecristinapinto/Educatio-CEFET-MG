/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package educatio.app.view.Professores;

import educatio.app.mainApp;
import educatio.app.model.Login.Aluno;
import educatio.app.model.Login.Professor;
import javafx.fxml.FXML;
import javafx.scene.control.Menu;


public class GerentesTelaInicialProfessoresController {
    
    @FXML
    private Menu menuProf;
    
    private mainApp mainApp;
    private Professor profAtual;
    
    private void initialize() {
    
    }
    
    public void setMainApp(mainApp mainApp) {
        this.mainApp = mainApp;
    }
    
    public void mudaUsuario(){
        profAtual = (Professor) mainApp.getUsuarioAtual();
        String [] primeiroNome = profAtual.getNome().split(" ");
        menuProf.setText(primeiroNome[0]);
    }
    
    public void saiAplicacao(){
        mainApp.mostraLogin();
    }
}
