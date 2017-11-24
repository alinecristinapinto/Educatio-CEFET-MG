/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaodecurso.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
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
import javafx.scene.control.Label;
import javafx.scene.control.ListView;
import javafx.scene.control.TextField;
import manutencaodecurso.model.ManutencaoDeCurso;

/**
 * FXML Controller class
 *
 * @author mathe
 */
public class CriarCursoController implements Initializable {

    private com.mysql.jdbc.Connection link = null;
    private static ManutencaoDeCurso main;
    @FXML
    private TextField idDepto;
    @FXML
    private TextField nome;
    @FXML
    private TextField horasTotais;
    @FXML
    private ChoiceBox campi;
    @FXML
    private ChoiceBox depto;

    private ObservableList listaCampi = FXCollections.observableArrayList();
    private ObservableList listaDepto = FXCollections.observableArrayList();
    private ObservableList listaCurso = FXCollections.observableArrayList();
    
    @FXML
    private Label labelModalidade;
    @FXML
    private Label labelHorasTotais;
    @FXML
    private Label labelNome;
    @FXML
    private ChoiceBox modalidade;


    private ObservableList listaModalidade = FXCollections.observableArrayList();

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {

        try {
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
        } catch (SQLException ex) {
            Logger.getLogger(TelaInicialController.class.getName()).log(Level.SEVERE, null, ex);
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

        listaModalidade.add("Técnico Integrado");
        listaModalidade.add("Graduação");

        modalidade.setItems(listaModalidade);
        campi.setItems(listaCampi);
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
                    setVisivel();
                });
    }

    @FXML
    public void criarCurso() throws SQLException, IOException {
        String query = "INSERT INTO `cursos` (`idDepto`, `nome`, `horasTotal`, `modalidade`, `ativo`) VALUES (?, ?, ?, ?, 'S');";
        PreparedStatement comando = link.prepareStatement(query);
        String nomeFormatado = depto.getSelectionModel().getSelectedItem().toString().replace("[", "");
        nomeFormatado = nomeFormatado.replace("]", "");
        ResultSet resultado = selecionarRegistros("deptos", "nome", nomeFormatado);
        resultado.first();
        comando.setString(1, resultado.getString("id"));
        comando.setString(2, nome.getText());
        comando.setString(3, horasTotais.getText());
        comando.setString(4, modalidade.getSelectionModel().getSelectedItem().toString());
        comando.execute();
        System.out.println("Criou um curso.");
        alteraTelaInicial();
    }

    @FXML
    public void alteraTelaInicial() throws IOException {
        main.abreTelaInicial();
    }

    public void setMain(ManutencaoDeCurso main) {
        this.main = main;
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
    
    public void setVisivel() {
        labelNome.setVisible(true);
        labelHorasTotais.setVisible(true);
        labelModalidade.setVisible(true);
        nome.setVisible(true);
        horasTotais.setVisible(true);
        modalidade.setVisible(true);
    }
}
