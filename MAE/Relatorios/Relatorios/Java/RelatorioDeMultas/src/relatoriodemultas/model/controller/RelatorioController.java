/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatoriodemultas.model.controller;

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
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import relatoriodemultas.model.Multa;
import relatoriodemultas.model.RelatorioDeMultas;

/**
 * FXML Controller class
 *
 * @author mathe
 */
public class RelatorioController implements Initializable {

    private RelatorioDeMultas main;
    private com.mysql.jdbc.Connection link;
    private String aluno;
    ObservableList<Multa> a = FXCollections.observableArrayList();
    @FXML
    private TableColumn<Multa, String> alunos;
    @FXML
    private TableColumn<Multa, String> multas;
    @FXML
    private TableView<Multa> listaMulta;

    /**
     * Initializes the controller class.
     *
     * @param url
     * @param rb
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
        try {
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
        } catch (SQLException ex) {
            Logger.getLogger(TelaInicialController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    public void mostrarRelatorio() throws SQLException {
        // Seleciono tudo da tabela acervo que tenha o mesmo nome do livro que o usuario passou.
        ResultSet resultadoAluno = selecionarRegistros("alunos", "nome", aluno);

        // Seleciono tudo da tabela descartes que tenha o mesmo idAcervo do livro que o usuario passou.
        ResultSet resultadoEmprestimos = selecionarRegistros("emprestimos", "idAluno", resultadoAluno.getString("idCPF"));

        do {
            a.add(new Multa(aluno, resultadoEmprestimos.getString("multa")));
        } while (resultadoEmprestimos.next());

        alunos.setCellValueFactory(cellData -> cellData.getValue().getNomeAluno());
        multas.setCellValueFactory(cellData -> cellData.getValue().getMulta());
        listaMulta.setItems(a);

    }

    public void setMain(RelatorioDeMultas main) {
        this.main = main;
    }

    public ResultSet selecionarRegistros(String tabela, String pesquisa, String pesquisado) throws SQLException {
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "` WHERE " + pesquisa + " = \'" + pesquisado + "\'";
        ResultSet resultado = comando.executeQuery(query);
        resultado.next();
        return resultado;
    }

    public void setAluno(String aluno) {
        this.aluno = aluno;
    }

    @FXML
    public void sairApp() {
        System.exit(0);
    }

    @FXML
    public void alterarTelaInicial() throws IOException {
        main.abreTelaInicial();
    }

}
