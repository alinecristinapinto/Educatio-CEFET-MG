/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatoriodeatraso.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import relatoriodeatraso.model.Atrasos;
import relatoriodeatraso.model.RelatorioDeAtraso;
import javafx.print.PageLayout;
import javafx.print.PageOrientation;
import javafx.print.Paper;
import javafx.print.Printer;
import javafx.print.PrinterAttributes;
import javafx.print.PrinterJob;
import javafx.scene.layout.AnchorPane;
import javafx.scene.transform.Scale;

/**
 * FXML Controller class
 *
 * @author Aluno
 */
public class RelatorioController implements Initializable {

    private RelatorioDeAtraso main;
    private com.mysql.jdbc.Connection link;
    private String aluno;
    ObservableList<Atrasos> a = FXCollections.observableArrayList();
    @FXML
    private TableColumn<Atrasos, String> alunos;
    @FXML
    private TableColumn<Atrasos, String> dataPrevDevolucao;
    @FXML
    private TableColumn<Atrasos, String> dataDevolucao;
    @FXML
    private TableColumn<Atrasos, String> diasDeAtraso;
    @FXML
    private TableView<Atrasos> listaAtrasos;
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

    public void setMain(RelatorioDeAtraso main) {
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

    public void mostrarRelatorio() throws SQLException, ParseException {
        ResultSet resultadoAluno = selecionarRegistros("alunos", "nome", aluno);

        ResultSet resultado = selecionarRegistros("emprestimos", "idAluno", resultadoAluno.getString("idCPF"));
        do {
            String previsaoDevolucao = resultado.getString("dataPrevisaoDevolucao");
            String[] previsaoDevolucaoSeparado = previsaoDevolucao.split("/");

            String devolucao = resultado.getString("dataDevolucao");
            String[] devolucaoSeparado = devolucao.split("/");

            boolean atraso = false;
            for (int i = 2; i >= 0; i--) {
                if (previsaoDevolucaoSeparado[i].compareTo(devolucaoSeparado[i]) == -1) {
                    atraso = true;
                    break;
                }
            }

            //concatenando as datas no formato dd-MM-yyyy
            String stringPrevisaoDevolucao = previsaoDevolucaoSeparado[2] + "-";
            stringPrevisaoDevolucao += previsaoDevolucaoSeparado[1] + "-";
            stringPrevisaoDevolucao += previsaoDevolucaoSeparado[0];

            String stringDevolucao = devolucaoSeparado[2] + "-";
            stringDevolucao += devolucaoSeparado[1] + "-";
            stringDevolucao += devolucaoSeparado[0];

            if (atraso) {

                //convertendo string p date
                SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd");
                java.sql.Date datePrevisaoDevolucao = new java.sql.Date(format.parse(stringPrevisaoDevolucao).getTime());
                java.sql.Date dateDevolucao = new java.sql.Date(format.parse(stringDevolucao).getTime());

                float diferencaDias = (dateDevolucao.getTime() - datePrevisaoDevolucao.getTime()) / (1000 * 60 * 60 * 24);

                a.add(new Atrasos(aluno, stringPrevisaoDevolucao, stringDevolucao, String.format("%.0f", diferencaDias) ));

            }
        } while (resultado.next());
        alunos.setCellValueFactory(cellData -> cellData.getValue().getNomeAluno());
        dataPrevDevolucao.setCellValueFactory(cellData -> cellData.getValue().getDataPrevisaoDevolucao());
        dataDevolucao.setCellValueFactory(cellData -> cellData.getValue().getDataDevolucao());
        diasDeAtraso.setCellValueFactory(cellData -> cellData.getValue().getTempoAtraso());
        listaAtrasos.setItems(a);
    }
    
    @FXML
    public void imprimePDF() {
        Printer printer = Printer.getDefaultPrinter();
        PageLayout pageLayout = printer.createPageLayout(Paper.A4, PageOrientation.PORTRAIT, Printer.MarginType.HARDWARE_MINIMUM);
        PrinterAttributes attr = printer.getPrinterAttributes();
        PrinterJob job = PrinterJob.createPrinterJob();
        double scaleX = (pageLayout.getPrintableWidth() / relatorio.getBoundsInParent().getWidth())-0.15;
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
