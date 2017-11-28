/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package SelecaoConteudos.controlador.visao;

import javafx.fxml.FXML;
import SelecaoConteudos.controlador.SelecaoConteudosMain;
import SelecaoConteudos.controlador.modelo.DadosConteudos;

/**
 *
 * @author Aluno
 */
public class TelaRelatorioControlador {
     
    private SelecaoConteudosMain selecaoConteudosMain;
    private boolean botaoVoltar = false;
    
    public TelaRelatorioControlador(){
        
    }
    @FXML
    private void initialize() {

    }
    
    public boolean isBotaoVoltar() {
        return botaoVoltar;
    }
    
    @FXML
    private void BotaoVoltarClicado() {
        selecaoConteudosMain.showLayoutInicial();
        
        botaoVoltar = true;
    }
    
    public void setSelecaoConteudosMain(SelecaoConteudosMain selecaoConteudosMain) {
        this.selecaoConteudosMain = selecaoConteudosMain;
    
    }   
}
