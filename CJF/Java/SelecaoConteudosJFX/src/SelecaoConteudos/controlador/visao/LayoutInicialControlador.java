/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package SelecaoConteudos.controlador.visao;

import BD.CriaConexao;
import BD.SelecaoConteudosBD;
import javafx.fxml.FXML;
import SelecaoConteudos.controlador.SelecaoConteudosMain;
import SelecaoConteudos.controlador.modelo.DadosConteudos;
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
public class LayoutInicialControlador {
    private SelecaoConteudosMain selecaoConteudosMain;
    private DadosConteudos dadosConteudos;
    private boolean BotaoChamaRelatorio = false;
    private Connection conexao=null;
    private ResultSet result;
    private ObservableList<String> anosEtapa;
    private ObservableList<String> disciplinas;
    private SelecaoConteudosBD manutencao;
    @FXML
    private ChoiceBox caixaSelecaoDisciplinas;
    @FXML
    private ChoiceBox caixaSelecaoEtapas;
    
    public LayoutInicialControlador() throws SQLException{
        this.conexao = new CriaConexao().getConexao();
        disciplinas = FXCollections.observableArrayList();
        String sql_fetch = "SELECT nome FROM disciplinas";
        Statement fetch = conexao.createStatement();
        result = fetch.executeQuery(sql_fetch);
        while(result.next()){
            disciplinas.add(result.getString("nome"));
        }
        result.close();
        //erro de conexão com o BD
    }
    
    @FXML
    private void initialize() {
        dadosConteudos = new DadosConteudos();
        caixaSelecaoDisciplinas.setItems(disciplinas);
    }
    
    public void setDadosConteudos(DadosConteudos dadosConteudos ) {
        this.dadosConteudos = dadosConteudos;

    }
    
    public void setManutencao(SelecaoConteudosBD manutencao){
        this.manutencao = manutencao;
    }
    
    public void setSelecaoConteudosMain(SelecaoConteudosMain selecaoConteudosMain) {
        this.selecaoConteudosMain = selecaoConteudosMain;
    }
    
    @FXML
    private void ChamaTelaRelatorio() {
        selecaoConteudosMain.showTelaRelatorio();
            //caixaSelecao.getValue()
            BotaoChamaRelatorio = true;
        }
    
    public boolean isBotaoChamaRelatorio() {
        return BotaoChamaRelatorio;
    }
}
