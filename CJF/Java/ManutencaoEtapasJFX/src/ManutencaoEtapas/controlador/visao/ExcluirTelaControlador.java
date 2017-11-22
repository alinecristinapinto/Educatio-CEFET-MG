/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ManutencaoEtapas.controlador.visao;

import BD.CriaConexao;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import ManutencaoEtapas.controlador.ManutencaoEtapasMain;
import ManutencaoEtapas.controlador.modelo.DadosEtapas;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.scene.control.ChoiceBox;

/**
 *
 * @author Aluno
 */
public class ExcluirTelaControlador {
    private ManutencaoEtapasMain manutencaoEtapasMain;
    private DadosEtapas dadosEtapas;
    private boolean botaoVoltar = false;
    Connection conexao=null;
    private ResultSet result;
    private ObservableList<String> nomesEtapa;
    private boolean botaoExcluirEtapa = false;
    
    @FXML
    private ChoiceBox caixaSelecao;
    
    public ExcluirTelaControlador() throws SQLException{
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
    }
    
    public void setManutencaoEtapasMain(ManutencaoEtapasMain manutencaoEtapasMain) {
        this.manutencaoEtapasMain = manutencaoEtapasMain;
    }
    
    public void setDadosEtapas(DadosEtapas dadosEtapas) {
        this.dadosEtapas = dadosEtapas;
    }
    
    public boolean isBotaoVoltar() {
        return botaoVoltar;
    }
    public boolean isBotaoExcluirEtapa() {
        return botaoExcluirEtapa;
    }
    
    @FXML
    private void BotaoVoltarClicado() {
        manutencaoEtapasMain.showLayoutMenu();
        
        botaoVoltar = true;
    }
    
    @FXML
    private void BotaoExcluirEtapaClicado() {
        
        
        botaoExcluirEtapa = true;
    }
}
