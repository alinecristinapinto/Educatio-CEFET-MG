/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package SelecaoNotas.controlador.visao;

import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import SelecaoNotas.controlador.SelecaoNotasMain;
import SelecaoNotas.controlador.modelo.DadosNotas;

/**
 *
 * @author Aluno
 */
public class TelaRelatorioControlador {
    
    private boolean botaoVoltar = false;
    @FXML
    private TableView<DadosNotas> dadosNotasTabela;
    @FXML
    private TableColumn<DadosNotas, String> nomeDisciplinaColumn;
    @FXML
    private TableColumn<DadosNotas, String> notaEtapaColumn;
    
 /**Fazer uma repetição para pegar a nota de cada etapa
  * @FXML
  * private TableColumn<DadosNotas, String> notaEtapa;
  * @FXML
  * private TableColumn<DadosNotas, String> notaEtapa;
  * @FXML
  * private TableColumn<DadosNotas, String> notaEtapa;
  */
    
    private SelecaoNotasMain selecaoNotasMain;
    
    public TelaRelatorioControlador(){
        
    }
    
    public boolean isBotaoVoltar() {
        return botaoVoltar;
    }
    
    @FXML
    private void BotaoVoltarClicado() {
        selecaoNotasMain.showLayoutInicial();
        
        botaoVoltar = true;
    }
    
    @FXML
    private void initialize() {
     
        nomeDisciplinaColumn.setCellValueFactory(cellData -> cellData.getValue().nomeDisciplinaProperty());
        
        notaEtapaColumn.setCellValueFactory(cellData -> cellData.getValue().notaEtapaProperty());
    }
    
    public void setSelecaoNotasMain(SelecaoNotasMain selecaoNotasMain) {
        this.selecaoNotasMain = selecaoNotasMain;
    
        //dadosNotasTabela.setItems(selecaoNotasMain.getDadosNotas());
    }   
}
