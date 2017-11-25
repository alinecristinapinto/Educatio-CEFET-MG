/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ManutencaoEtapas.controlador.visao;

import BD.ManutencaoEtapasBD;
import ManutencaoEtapas.controlador.modelo.DadosEtapas;
import ManutencaoEtapas.controlador.ManutencaoEtapasMain;
import java.sql.ResultSet;
import java.sql.SQLException;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.TextField;

/**
 *
 * @author Aluno
 */
public class AdicionarTelaControlador {
    private ManutencaoEtapasMain manutencaoEtapasMain;
    private DadosEtapas dadosEtapas;
    private ManutencaoEtapasBD manutencao;
    private boolean botaoAdicionarEtapa = false;
    private boolean botaoVoltar = false;
    @FXML
    public TextField idOrdemField;
    @FXML
    private TextField valorField;
    
    public AdicionarTelaControlador(){
        
    }
    
    @FXML
    private void initialize() {
        
    }

    public void setManutencaoEtapasMain(ManutencaoEtapasMain manutencaoEtapasMain) {
        this.manutencaoEtapasMain = manutencaoEtapasMain;
    }
    
    public void setDadosEtapas(DadosEtapas dadosEtapas) {
        this.dadosEtapas = dadosEtapas;

        idOrdemField.setText(dadosEtapas.getIdOrdem());
        valorField.setText(dadosEtapas.getValor());
    }
    
    public void setManutencao(ManutencaoEtapasBD manutencao){
        this.manutencao = manutencao;
    }
    
    public boolean isBotaoAdicionarEtapa() {
        return botaoAdicionarEtapa;
    }
    
    public boolean isBotaoVoltar() {
        return botaoVoltar;
    }
    
    @FXML
    private void BotaoAdicionarEtapaClicado() throws SQLException {
        String mensagem = "Voltando ao menu de manutenção de etapas";
        
        if (ValidaCampo()) {           
            dadosEtapas.setIdOrdem(idOrdemField.getText());
            dadosEtapas.setValor(valorField.getText());
            
            manutencao.criaEtapa(idOrdemField.getText(), valorField.getText());
            
            botaoAdicionarEtapa = true;
            
            
            Alert alert = new Alert(AlertType.INFORMATION);
                      alert.setTitle("Adicionar etapa");
                      alert.setHeaderText("Etapa adicionada com sucesso.");
                      alert.setContentText(mensagem);
                      alert.showAndWait();
                      BotaoVoltarClicado();
        }
    }
    
    @FXML
    public void BotaoVoltarClicado() {
        manutencaoEtapasMain.showLayoutMenu();
        dadosEtapas.setIdOrdem(null);
        dadosEtapas.setValor(null);
        botaoVoltar = true;
    }
    
    private boolean ValidaCampo() {
        String mensagemErro = "";

        if (idOrdemField.getText() == null || idOrdemField.getText().length() == 0) {
            mensagemErro += "Número de etapa inválido!\n"; 
        }else {
            // tenta converter o código postal em um int.
            try {
                Integer.parseInt(idOrdemField.getText());
            } catch (NumberFormatException e) {
                mensagemErro += "Número de etapa inválido (deve ser um número inteiro)!\n"; 
            }
        }
        if (valorField.getText() == null || valorField.getText().length() == 0) {
            mensagemErro += "Valor da etapa inválido!\n"; 
        }else {
            // tenta converter o código postal em um int.
            try {
                Integer.parseInt(valorField.getText());
            } catch (NumberFormatException e) {
                mensagemErro += "Valor inválido (deve ser um número inteiro)!\n"; 
            }
        }

        if (mensagemErro.length() == 0) {
            return true;
        } else {
            // Mostra a mensagem de erro.
            Alert alert = new Alert(AlertType.ERROR);
                      alert.setTitle("Campos Inválidos");
                      alert.setHeaderText("Por favor, corrija os campos inválidos");
                      alert.setContentText(mensagemErro);
                      alert.showAndWait();

            return false;
        }
    }
}
