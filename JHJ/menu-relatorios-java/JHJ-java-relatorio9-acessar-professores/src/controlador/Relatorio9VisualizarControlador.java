/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controlador;

import java.net.URL;
import java.util.ResourceBundle;


import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.print.PageLayout;
import javafx.print.Paper;
import javafx.print.Printer;
import javafx.print.PrinterAttributes;
import javafx.print.PrinterJob;
import javafx.scene.control.Button;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.stage.Stage;
import model.Relatorio9Professor;
import view.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.AnchorPane;
import javafx.scene.transform.Scale;
import javafx.print.PageLayout;
import javafx.print.PageOrientation;
import javafx.print.Paper;
import javafx.print.PrinterAttributes;
import javafx.print.PrinterJob;
import javafx.stage.Stage;


/**
 * FXML Controller class
 *
 * @author Aluno
 */
public class Relatorio9VisualizarControlador implements Initializable {

    private Relatorio9 relatorio9;
    private boolean okClic = false;
    private Stage palcoDialogo;

    @FXML
    private TableView<Relatorio9Professor> ProfessorTabela;
    @FXML
    private TableColumn<Relatorio9Professor, String> nomeColuna;
    @FXML
    private TableColumn<Relatorio9Professor, String> nomeDisciplinaColuna;
    @FXML
    private TableColumn<Relatorio9Professor, Integer> cargaHorariaMinColuna;
    @FXML
    private AnchorPane painelPDF;
    @FXML
    private Button botaoImpressao;
    private ObservableList<Relatorio9Professor> professores = FXCollections.observableArrayList();
    private Relatorio9Professor profTeste= new Relatorio9Professor();

    public void setLista(ObservableList<Relatorio9Professor> professores){
        this.professores = professores ;
        nomeColuna.setCellValueFactory(new PropertyValueFactory<Relatorio9Professor, String>("nomeProfessor"));
        nomeDisciplinaColuna.setCellValueFactory(new PropertyValueFactory<Relatorio9Professor, String>("nomeDisciplina"));
        cargaHorariaMinColuna.setCellValueFactory(new PropertyValueFactory<Relatorio9Professor, Integer>("cargaHorariaMin"));

        ProfessorTabela.setItems(professores);
    }


    public void setRelatorio9(Relatorio9 relatorio9){
        this.relatorio9=relatorio9;
    }
    public void initialize(URL url, ResourceBundle rb) {

    }
    @FXML
    public void botaoVoltar(){
        relatorio9.invocaBase();
    }


    public boolean seOkClic(){
        return okClic;
    }

    public void imprimeRelatorio() {
        Printer printer = Printer.getDefaultPrinter();
        PageLayout pageLayout = printer.createPageLayout(Paper.A4, PageOrientation.PORTRAIT, Printer.MarginType.HARDWARE_MINIMUM);
        PrinterAttributes attr = printer.getPrinterAttributes();
        PrinterJob job = PrinterJob.createPrinterJob();
        double scaleX = (pageLayout.getPrintableWidth() / painelPDF.getBoundsInParent().getWidth())-0.15;
        double scaleY = 1;
        Scale scale = new Scale(scaleX, scaleY);
        painelPDF.getTransforms().add(scale);

        if (job != null && job.showPrintDialog(painelPDF.getScene().getWindow())) {
            boolean success = job.printPage(pageLayout, painelPDF);
            if (success) {
                job.endJob();
            }
        }
        painelPDF.getTransforms().remove(scale);
    }

}