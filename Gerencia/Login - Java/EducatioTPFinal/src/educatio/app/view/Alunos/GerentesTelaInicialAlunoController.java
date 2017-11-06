/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package educatio.app.view.Alunos;

import educatio.app.mainApp;
import educatio.app.model.Login.Aluno;
import educatio.app.view.Alunos.controlador.*;
import javafx.fxml.FXML;
import javafx.scene.control.Menu;


public class GerentesTelaInicialAlunoController {
    
    @FXML
    private Menu menuAluno;
    
    private Aluno alunoAtual;

   
    private mainApp mainApp;
    
    private ManuntencaoAluno manuntencaoAluno = new ManuntencaoAluno();
   
    @FXML
    private void initialize() {
       
    }

     public void setAlunoAtual(Aluno alunoAtual) {
        this.alunoAtual = alunoAtual;
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
    
    public void voltaPagSelecao()
    {
        mainApp.mostraPagSelecao(alunoAtual);
    }
    
    public void mostraFormulario()
    {
        manuntencaoAluno.setMainApp(mainApp);
        manuntencaoAluno.mostraFormulario();
    }
}
