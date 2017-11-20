/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaodecurso.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.ListView;
import javafx.scene.control.TextField;
import manutencaodecurso.model.ManutencaoDeCurso;

/**
 * FXML Controller class
 *
 * @author mathe
 */
public class ApagarCursoController implements Initializable {

    private com.mysql.jdbc.Connection link = null;
    private static ManutencaoDeCurso main;

    @FXML
    private TextField idTurma;
    @FXML
    private ChoiceBox campi;
    @FXML
    private ChoiceBox depto;
    @FXML
    private ListView curso;;

    private ObservableList listaCampi = FXCollections.observableArrayList();
    private ObservableList listaDepto = FXCollections.observableArrayList();
    private ObservableList listaCurso = FXCollections.observableArrayList();


    /**
     * Initializes the controller class.
     *
     * @param url
     * @param rb
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // TODO
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
        } catch (SQLException ex) {
            Logger.getLogger(AlterarCursoController.class.getName()).log(Level.SEVERE, null, ex);
        }
        if (link == null) {
            System.out.println("Erro!");
        } else {
            System.out.println("Conexao feita com sucesso!");
        }
        try {
            ResultSet resultado = selecionarRegistros("campi");
            while (resultado.next()) {
                if(resultado.getString("ativo").equals("S"))
                    listaCampi.add(resultado.getString("nome"));
            }   
        } catch (SQLException ex) {
            Logger.getLogger(AlterarCursoController.class.getName()).log(Level.SEVERE, null, ex);
        }

        campi.setItems(listaCampi);

        campi.getSelectionModel().selectedItemProperty().addListener(
                (observable, oldValue, newValue) -> {
                    try {
                        atualizaListaDepto(newValue.toString());
                    } catch (SQLException ex) {
                        Logger.getLogger(AlterarCursoController.class.getName()).log(Level.SEVERE, null, ex);
                    }
                });

        depto.getSelectionModel().selectedItemProperty().addListener(
                (observable, oldValue, newValue) -> {
                    try {
                        atualizaListaCurso(newValue.toString());
                    } catch (SQLException ex) {
                        Logger.getLogger(AlterarCursoController.class.getName()).log(Level.SEVERE, null, ex);
                    }
                });

    }

    @FXML
    public void apagaCurso() throws SQLException, IOException {
        String nomeFormatado = curso.getSelectionModel().getSelectedItems().toString().replace("[", "");
        nomeFormatado = nomeFormatado.replace("]", "");
        Statement comando = link.createStatement();
        ResultSet resultado = selecionarRegistros("cursos", "nome", nomeFormatado);
        resultado.next();
        String query = "UPDATE `cursos` SET `ativo` = 'N' WHERE `cursos`.`id` = " + resultado.getString("id");
        comando.executeUpdate(query);
        alteraTelaInicial();
    }

    @FXML
    public void alteraTelaInicial() throws IOException {
        main.abreTelaInicial();
    }

    public void setMain(ManutencaoDeCurso main) {
        this.main = main;
    }

    public ResultSet selecionarRegistros(String tabela, String pesquisa, String pesquisado) throws SQLException {
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "` WHERE " + pesquisa + " = \'" + pesquisado + "\'";
        ResultSet resultado = comando.executeQuery(query);
        return resultado;
    }

    public ResultSet selecionarRegistros(String tabela) throws SQLException {
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "`";
        ResultSet resultado = comando.executeQuery(query);
        return resultado;
    }

    @FXML
    public void atualizaListaDepto(String valor) throws SQLException {
        listaDepto.clear();
        listaCurso.clear();
        
        ResultSet resultado = selecionarRegistros("campi", "nome", valor);
        resultado.next();
        if(resultado.getString("ativo").equals("S")){
            ResultSet resultado2 = selecionarRegistros("deptos", "idCampi", resultado.getString("id"));

            while (resultado2.next()) {
                if(resultado2.getString("ativo").equals("S"))
                    listaDepto.add(resultado2.getString("nome"));
            }
        }
        depto.setItems(listaDepto);
    }

    @FXML
    public void atualizaListaCurso(String valor) throws SQLException {
        listaCurso.clear();
        
        ResultSet resultado = selecionarRegistros("deptos", "nome", valor);
        resultado.next();
        if(resultado.getString("ativo").equals("S")){
            ResultSet resultado2 = selecionarRegistros("cursos", "idDepto", resultado.getString("id"));

            while (resultado2.next()) {
                if(resultado2.getString("ativo").equals("S"))
                    listaCurso.add(resultado2.getString("nome"));
            }
        }
        curso.setItems(listaCurso);
    }
  
    
}
