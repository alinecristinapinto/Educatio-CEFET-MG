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
import ManutencaoEtapas.controlador.visao.AlterarTelaControlador;
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
  private ResultSet alteraValor;
  private Statement executaComando;
  private AlterarTelaControlador altera;
  
  public ManutencaoEtapasBD(){
      dadosEtapas = new String[2];
  }
  
  public void criaEtapa(String idOrdem, String valor) throws java.sql.SQLException {
    conexao = DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio?useSSL=true","root","");
    sql = "INSERT INTO etapas (idOrdem, valor, ativo) VALUES (?,?,?)";
    executaComando = conexao.prepareStatement(sql);
    //Verifica se a etapa já existe no BD
    ResultadoSQL = executaComando.executeQuery("SELECT idOrdem FROM etapas WHERE idOrdem='"+idOrdem+"' AND ativo='S'");
    if(ResultadoSQL.next()){
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle("Campos Inválidos");
        alert.setHeaderText("Por favor, corrija os campos inválidos");
        alert.setContentText("Esse número de etapa já existe!");
        alert.show();
      }
    ResultadoSQL=executaComando.executeQuery("SELECT idOrdem FROM etapas WHERE idOrdem='"+idOrdem+"' AND ativo='N'");
    if(ResultadoSQL.next()){
        alteraValor = executaComando.executeQuery("UPDATE etapas SET valor='"+valor+"'WHERE idOrdem='"+idOrdem+"'");
    }
    dadosEtapas[0] = idOrdem;
    dadosEtapas[1] = valor;
    stmt = conexao.prepareStatement(sql);
    stmt.setString(1, dadosEtapas[0]);
    stmt.setString(2, dadosEtapas[1]);
    stmt.setString(3, "S");
    stmt.execute();
    conexao.close();
  }
  
  public void alteraEtapa(String idOrdem, String valor) throws java.sql.SQLException {
    conexao = DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio?useSSL=true","root","");
    sql = "INSERT INTO etapas (idOrdem, valor, ativo) VALUES (?,?,?)";
    executaComando = conexao.prepareStatement(sql);
    //Verifica se a etapa já existe no BD
    ResultadoSQL = executaComando.executeQuery("SELECT idOrdem FROM etapas WHERE idOrdem='"+altera.getEtapaSelecionda()+"' AND ativo='S'");
    dadosEtapas[0] = idOrdem;
    dadosEtapas[1] = valor;
    stmt = conexao.prepareStatement(sql);
    stmt.setString(1, dadosEtapas[0]);
    stmt.setString(2, dadosEtapas[1]);
    stmt.setString(3, "S");
    stmt.execute();
    conexao.close();
  }
  
  
  
  
}
