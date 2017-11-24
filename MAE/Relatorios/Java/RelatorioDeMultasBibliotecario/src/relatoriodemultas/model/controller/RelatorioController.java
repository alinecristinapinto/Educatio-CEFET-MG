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
import javafx.print.PageLayout;
import javafx.print.PageOrientation;
import javafx.print.Paper;
import javafx.print.Printer;
import javafx.print.PrinterAttributes;
import javafx.print.PrinterJob;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.layout.AnchorPane;
import javafx.scene.transform.Scale;
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
    ObservableList<Multa> lista = FXCollections.observableArrayList();
    @FXML
    private TableColumn<Multa, String> alunos;
    @FXML
    private TableColumn<Multa, String> multas;
    @FXML
    private TableView<Multa> listaMulta;
    @FXML
    private AnchorPane relatorio;

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
        ResultSet resultadoEmprestimos;
        ResultSet resultadoAluno;
        
        if (!aluno.equals("todos")) {

            resultadoAluno = selecionarRegistros("alunos", "nome", aluno);
            resultadoEmprestimos = selecionarRegistros("emprestimos", "idAluno", resultadoAluno.getString("idCPF"));
        } else {
            resultadoEmprestimos = selecionarRegistros("emprestimos");
        }

        do {
            resultadoAluno = selecionarRegistros("alunos", "idCPF", resultadoEmprestimos.getString("idAluno"));
            lista.add(new Multa(resultadoAluno.getString("nome"), resultadoEmprestimos.getString("multa")));
        } while (resultadoEmprestimos.next());

        alunos.setCellValueFactory(cellData -> cellData.getValue().getNomeAluno());
        multas.setCellValueFactory(cellData -> cellData.getValue().getMulta());
        listaMulta.setItems(lista);

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

    public ResultSet selecionarRegistros(String tabela) throws SQLException {
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "`";
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

    @FXML
    public void imprimePDF() {
        Printer printer = Printer.getDefaultPrinter();
        PageLayout pageLayout = printer.createPageLayout(Paper.A4, PageOrientation.PORTRAIT, Printer.MarginType.HARDWARE_MINIMUM);
        PrinterAttributes attr = printer.getPrinterAttributes();
        PrinterJob job = PrinterJob.createPrinterJob();
        double scaleX = (pageLayout.getPrintableWidth() / relatorio.getBoundsInParent().getWidth()) - 0.15;
        double scaleY = 1;

        Scale scale = new Scale(scaleX, scaleY);
        relatorio.getTransforms().add(scale);

        if (job != null && job.showPrintDialog(relatorio.getScene().getWindow())) {
            boolean success = job.printPage(pageLayout, relatorio);
            if (success) {
                job.endJob();
            }
        }
        relatorio.getTransforms().remove(scale);
    }

}
