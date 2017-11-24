/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ManutencaoEtapas.controlador.visao;

import BD.CriaConexao;
import BD.ManutencaoEtapasBD;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import ManutencaoEtapas.controlador.ManutencaoEtapasMain;
import ManutencaoEtapas.controlador.modelo.DadosEtapas;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.scene.control.Alert;
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
    private String sql;
    private PreparedStatement stmt;
    private ResultSet ResultadoSQL;
    private Statement executaComando;
    
    @FXML
    private ChoiceBox caixaSelecao;
    private ManutencaoEtapasBD manutencao;
    
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
    
    public String excluiEtapa(String idOrdem) throws java.sql.SQLException {
      String etapaDeletada = null;
      conexao = DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio?useSSL=true","root","");
      sql = "UPDATE etapas SET ativo='N' WHERE idOrdem='"+idOrdem+"'";
      stmt = conexao.prepareStatement(sql);
      stmt.execute();
      conexao.close();
      return etapaDeletada;
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
    public void setManutencao(ManutencaoEtapasBD manutencao){
        this.manutencao = manutencao;
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
    private void BotaoExcluirEtapaClicado() throws SQLException {
        excluiEtapa((String) caixaSelecao.getValue());
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
                      alert.setTitle("Excluir etapa");
                      alert.setHeaderText("Etapa excluida com sucesso.");
                      alert.setContentText("");
                      alert.showAndWait();
                      botaoExcluirEtapa = true;
                      BotaoVoltarClicado();
    }    

}
