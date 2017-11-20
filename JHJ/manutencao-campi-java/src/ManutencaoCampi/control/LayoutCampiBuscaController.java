/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ManutencaoCampi.control;

import ManutencaoCampi.ManutencaoCampi;
import java.net.URL;
import java.util.ResourceBundle;
import javafx.fxml.Initializable;
import javafx.scene.control.Label;
import javafx.fxml.FXML;
import javafx.scene.control.Button;

/**
 * FXML Controller class
 *
 * @author Aluno
 */
public class LayoutCampiBuscaController implements Initializable {
    @FXML
    Label labelNome;
    @FXML
    Label labelCidade;
    @FXML
    Label labelUf;
    @FXML
    Button botaoOk;
    
    boolean okClicado;
    ManutencaoCampi aplicacao;
    
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        okClicado = false;
    }    
    
    @FXML
    public void setDados(String nome, String cidade, String uf){
        labelNome.setText("Nome: "+nome);
        labelCidade.setText("Cidade: "+cidade);
        labelUf.setText("UF: "+uf);
    }
    
    public void setAplicacao(ManutencaoCampi aplicacao){
        this.aplicacao = aplicacao;
    }
    
    public boolean okEstaClicado(){
        return okClicado;
    }
    
    public void okClicado(){
        okClicado = true;
        aplicacao.invocaLayoutBase();
    }
}
