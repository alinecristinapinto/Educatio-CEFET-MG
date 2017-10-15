/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package educatio.app.view.Alunos;

import educatio.app.mainApp;
import educatio.app.model.Login.Aluno;
import javafx.fxml.FXML;
import javafx.scene.control.Menu;


public class GerentesTelaInicialAlunoController {
    
    @FXML
    private Menu menuAluno;
    
    private Aluno alunoAtual;

    public void setAlunoAtual(Aluno alunoAtual) {
        this.alunoAtual = alunoAtual;
    }
    private mainApp mainApp;
   
    @FXML
    private void initialize() {
        
    }
    
    public void setMainApp(mainApp mainApp) {
        this.mainApp = mainApp;
    }
    
    public void mudaUsuario(){
        alunoAtual = (Aluno) mainApp.getUsuarioAtual();
        String [] primeiroNome = alunoAtual.getNome().split(" ");
        menuAluno.setText(primeiroNome[0]);
    }
    public void saiAplicacao(){
        mainApp.mostraLogin();
    }
}
