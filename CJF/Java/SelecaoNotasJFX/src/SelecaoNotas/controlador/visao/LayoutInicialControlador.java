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
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.TextField;


/**
 *
 * @author Aluno
 */
public class LayoutInicialControlador {
    private SelecaoNotasMain selecaoNotasMain;
    private DadosNotas dadosNotas;
    private boolean okSelecionado = false;
    
    @FXML
    private TextField nomeAlunoField;
    
    @FXML
    private void initialize() {
        dadosNotas = new DadosNotas();
    }
    
    public void setDadosNotas(DadosNotas dadosNotas ) {
        this.dadosNotas = dadosNotas;

        nomeAlunoField.setText(dadosNotas.getNomeAluno());

    }
    
    public boolean isBotaoAdicionar() {
        return okSelecionado;
    }
    
    @FXML
    private void ChamaTelaRelatorio() {
        selecaoNotasMain.showTelaRelatorio();
            
            okSelecionado = true;
        }
    
    public boolean isOkSelecionado() {
        return okSelecionado;
    }
    
    private void BotaoOkClicado() {
        if (campoInvalido()) {
            dadosNotas.setNomeALuno(nomeAlunoField.getText());

            okSelecionado = true;
        }
    }
    
    private boolean campoInvalido() {
        String errorMessage = "";
        
        if (nomeAlunoField.getText() == null || nomeAlunoField.getText().length() == 0) {
            errorMessage += "Nome inválido!\n"; 
        }

        if (errorMessage.length() == 0) {
            return true;
        } else {
            // Mostra a mensagem de erro.
            Alert alert = new Alert(AlertType.ERROR);
                      alert.setTitle("Campo Inválido");
                      alert.setHeaderText("Por favor, digite um nome válido.");
                      alert.setContentText(errorMessage);
                alert.showAndWait();

            return false;
        }
    }
}
