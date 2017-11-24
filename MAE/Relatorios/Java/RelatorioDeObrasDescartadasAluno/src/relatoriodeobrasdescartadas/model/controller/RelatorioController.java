/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatoriodeobrasdescartadas.model.controller;

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
import relatoriodeobrasdescartadas.model.ObrasDescartadas;
import relatoriodeobrasdescartadas.model.RelatorioDeObrasDescartadas;

/**
 * FXML Controller class
 *
 * @author mathe
 */
public class RelatorioController implements Initializable {

    private RelatorioDeObrasDescartadas main;
    private com.mysql.jdbc.Connection link;
    private String acervo;
    ObservableList<ObrasDescartadas> lista = FXCollections.observableArrayList();
    @FXML
    private TableColumn<ObrasDescartadas, String> acervos;
    @FXML
    private TableColumn<ObrasDescartadas, String> funcionario;
    @FXML
    private TableColumn<ObrasDescartadas, String> data;
    @FXML
    private TableColumn<ObrasDescartadas, String> motivos;
    @FXML
    private TableView<ObrasDescartadas> listaAcervos;
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
        // Seleciono tudo da tabela acervo que tenha o mesmo nome do livro que o usuario passou.
        ResultSet resultadoAcervo = selecionarRegistros("acervo", "nome", acervo);

        // Seleciono tudo da tabela descartes que tenha o mesmo idAcervo do livro que o usuario passou.
        ResultSet resultadoDescartes = selecionarRegistros("descartes", "idAcervo", resultadoAcervo.getString("id"));

        do {
            ResultSet resultadoFuncionario = selecionarRegistros("funcionario", "idSIAPE", resultadoDescartes.getString("idFuncionario"));
            lista.add(new ObrasDescartadas(acervo, resultadoFuncionario.getString("nome"),
                    resultadoDescartes.getString("dataDescarte"), resultadoDescartes.getString("motivos")));
        } while (resultadoDescartes.next());

        acervos.setCellValueFactory(cellData -> cellData.getValue().getNome());
        funcionario.setCellValueFactory(cellData -> cellData.getValue().getFuncionario());
        data.setCellValueFactory(cellData -> cellData.getValue().getData());
        motivos.setCellValueFactory(cellData -> cellData.getValue().getMotivo());
        listaAcervos.setItems(lista);

    }

    public void setMain(RelatorioDeObrasDescartadas main) {
        this.main = main;
    }

    public ResultSet selecionarRegistros(String tabela, String pesquisa, String pesquisado) throws SQLException {
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "` WHERE " + pesquisa + " = \'" + pesquisado + "\'";
        ResultSet resultado = comando.executeQuery(query);
        resultado.next();
        return resultado;
    }

    public void setAcervo(String acervo) {
        this.acervo = acervo;
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
