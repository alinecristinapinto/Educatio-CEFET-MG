/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ManutencaoEtapas.controlador.visao;

import BD.CriaConexao;
import javafx.fxml.FXML;
import ManutencaoEtapas.controlador.ManutencaoEtapasMain;
import ManutencaoEtapas.controlador.modelo.DadosEtapas;
import BD.ManutencaoEtapasBD;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.TextField;
import javafx.scene.layout.GridPane;

/**
 *
 * @author Aluno
 */
public class AlterarTelaControlador{
    private ManutencaoEtapasMain manutencaoEtapasMain;
    private ManutencaoEtapasBD manutencao;
    private DadosEtapas dadosEtapas;
    private boolean botaoVoltar = false;
    private boolean botaoConfirmaEtapa = false;
    private boolean botaoAlterarEtapa = false;
    Connection conexao=null;
    private ResultSet result;
    private String etapaSelecionada;
    private ObservableList<String> nomesEtapa;
    @FXML
    private ChoiceBox caixaSelecao;
    @FXML
    private TextField idOrdemField;
    @FXML
    private TextField valorField;
    @FXML
    private GridPane painelAlterar;
    @FXML
    private Button botaoALterarFXML;
        
    public AlterarTelaControlador() throws SQLException{
        this.conexao = new CriaConexao().getConexao();
        nomesEtapa = FXCollections.observableArrayList();
        String sql_fetch = "SELECT idOrdem FROM etapas WHERE ativo='S'";
        Statement fetch = conexao.createStatement();
        result = fetch.executeQuery(sql_fetch);
        while(result.next()){
            nomesEtapa.add(result.getString("idOrdem"));
        }
        result.close();
    }
    
    @FXML
    private void initialize() {
        dadosEtapas = new DadosEtapas();
        caixaSelecao.setItems(nomesEtapa);
        painelAlterar.setVisible(false);
        botaoALterarFXML.setVisible(false);     
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
    
    public boolean isBotaoVoltar() {
        return botaoVoltar;
    }
    
    public boolean isBotaoAlterarEtapa() {
        return botaoAlterarEtapa;
    }
    
    public boolean isBotaoConfirmaEtapa(){
        return botaoConfirmaEtapa;
    }
    
    public void setEtapaSelecionada(String etapaSelecionada){
        this.etapaSelecionada = etapaSelecionada;
    }
    public String getEtapaSelecionda(){
        return etapaSelecionada;
    }
    
    @FXML
    private void BotaoConfirmaEtapaClicado(){
        painelAlterar.setVisible(true);
        botaoALterarFXML.setVisible(true);
        setEtapaSelecionada((String) caixaSelecao.getValue());
        botaoConfirmaEtapa = true;
    }
    
    @FXML
    private void BotaoAlterarEtapaClicado() throws SQLException {
        if (ValidaCampo()) {           
            dadosEtapas.setIdOrdem(idOrdemField.getText());
            dadosEtapas.setValor(valorField.getText());
            
            manutencao.alteraEtapa(idOrdemField.getText(), valorField.getText());
            
            botaoAlterarEtapa = true;
            
            String mensagem = "Número atual da etapa: "+dadosEtapas.getIdOrdem()+"\nValor atual da etapa: "+dadosEtapas.getValor();
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
                      alert.setTitle("Alterar etapa");
                      alert.setHeaderText("Etapa alterada com sucesso.");
                      alert.setContentText(mensagem);
                      alert.showAndWait();
                      BotaoVoltarClicado();
        }
    }
    
    @FXML
    private void BotaoVoltarClicado() {
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
            Alert alert = new Alert(Alert.AlertType.ERROR);
                      alert.setTitle("Campos Inválidos");
                      alert.setHeaderText("Por favor, corrija os campos inválidos");
                      alert.setContentText(mensagemErro);
                      alert.showAndWait();

            return false;
        }
    }
}
