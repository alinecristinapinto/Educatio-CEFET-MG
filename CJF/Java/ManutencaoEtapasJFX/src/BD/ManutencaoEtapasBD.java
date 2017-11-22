/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package BD;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import ManutencaoEtapas.controlador.visao.AdicionarTelaControlador;
import javafx.scene.control.Alert;
/**
 *
 * @author Carlos
 */
public class ManutencaoEtapasBD {
  
  private Connection conexao;
  private String[] dadosEtapas;
  private String sql;
  private PreparedStatement stmt;
  private ResultSet ResultadoSQL;
  private Statement executaComando;
  //private AdicionarTelaControlador adicionar;
  
  public ManutencaoEtapasBD(){
      dadosEtapas = new String[2];
  }
  
  public void criaEtapa(String idOrdem, String valor) throws java.sql.SQLException {
    conexao = DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio?useSSL=true","root","");
    dadosEtapas[0] = idOrdem;
    dadosEtapas[1] = valor;
    sql = "INSERT INTO etapas (idOrdem, valor, ativo) VALUES (?,?,?)";
    stmt = conexao.prepareStatement(sql);
    stmt.setString(1, dadosEtapas[0]);
    stmt.setString(2, dadosEtapas[1]);
    stmt.setString(3, "S");
    executaComando = conexao.prepareStatement(sql);
    /*ResultadoSQL = executaComando.executeQuery("SELECT idOrdem FROM etapas WHERE idOrdem='"+adicionar.idOrdemField.getText()+"' AND ativo='S'");
    while(ResultadoSQL.next()){
                Alert alert = new Alert(Alert.AlertType.ERROR);
                      alert.setTitle("Campos Inválidos");
                      alert.setHeaderText("Por favor, corrija os campos inválidos");
                      alert.setContentText("Esse número de etapa já");
                      alert.showAndWait();
                ResultadoSQL=executaComando.executeQuery("SELECT idOrdem FROM etapas WHERE idOrdem='"+adicionar.idOrdemField.getText()+"'");
            }*/
    stmt.execute();
    conexao.close();
  }
  
  
}
