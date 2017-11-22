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
    
    @FXML
    private Label nomeAlunoLabel;
    @FXML
    private Label cpfLabel;
    @FXML
    private Label cursoLabel;
    @FXML
    private Label turmaLabel;
    @FXML
    private Label anoLabel;
    @FXML
    private Label campusLabel; 
    
    private SelecaoNotasMain selecaoNotasMain;
    
    public TelaRelatorioControlador(){
        
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
