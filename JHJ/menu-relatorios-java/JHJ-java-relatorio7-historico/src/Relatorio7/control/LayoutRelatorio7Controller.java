/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Relatorio7.control;

import Relatorio7.Relatorio7;
import Relatorio7.model.NotasHistorico;
import Relatorio7.model.Relatorio7BD;
import java.net.URL;
import java.sql.SQLException;
import java.text.ParseException;
import java.util.ArrayList;
import java.util.List;
import java.util.ResourceBundle;
import javafx.beans.binding.Bindings;
import javafx.collections.FXCollections;
import javafx.collections.ListChangeListener;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.print.PageLayout;
import javafx.print.PageOrientation;
import javafx.print.Paper;
import javafx.print.Printer;
import javafx.print.PrinterAttributes;
import javafx.print.PrinterJob;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.GridPane;
import javafx.scene.transform.Scale;
import javafx.stage.Stage;
import javax.swing.text.MaskFormatter;

/**
 * FXML Controller class
 *
 * @author gabri_000
 */
public class LayoutRelatorio7Controller implements Initializable {

    @FXML
    private Label labelNome;
    @FXML
    private Label labelSexo;
    @FXML
    private Label labelNascimento;
    @FXML
    private Label labelCpf;
    @FXML
    private Label labelCurso;
    @FXML
    private AnchorPane painelPDF;
    @FXML
    private Button botaoImpressao;
    @FXML
    private GridPane gridDados;

    private Relatorio7 relatorio7;
    private String cpf;
    private String[] dadosAluno;
    private TableView<NotasHistorico> tabelaNotas;
    private List<ObservableList<NotasHistorico>> listaNotas;
    private List<TableView<NotasHistorico>> listaTabelas;
    private ObservableList<NotasHistorico> notasHistorico;
    private Relatorio7BD relatorio7BD = new Relatorio7BD();
    private String dadosHistorico[][];
    private String series[];

    public void initialize(URL url, ResourceBundle rb) {
        relatorio7BD = new Relatorio7BD();
    }

    public void setLabels() throws SQLException, ParseException {
        MaskFormatter format_textField4 = new MaskFormatter("###.###.###-##");
        char[] cpfVetor = cpf.toCharArray();
        String cpfFormatado=String.format("%s%s%s.%s%s%s.%s%s%s-%s%s", cpfVetor[0], cpfVetor[1], cpfVetor[2], cpfVetor[3], cpfVetor[4], cpfVetor[5], cpfVetor[6], cpfVetor[7], cpfVetor[8], cpfVetor[9], cpfVetor[10]);
        
        dadosAluno=new String[3];
        dadosAluno=relatorio7BD.getDadosAluno(cpf);
        labelNome.setText("Nome: "+dadosAluno[0]);
        labelSexo.setText("Sexo: "+dadosAluno[1]);
        labelNascimento.setText("Nasc.: "+dadosAluno[2]);
        labelCpf.setText("CPF: " + cpfFormatado);
        labelCurso.setText("Curso: "+relatorio7BD.getCurso(cpf));
    }

    public void setCpf(String cpf) {
        this.cpf = cpf;
    }

    public int setNotasHistorico() throws SQLException {
        if ((dadosHistorico = relatorio7BD.getNotasAluno(cpf)) != null) {
            listaNotas = new ArrayList<ObservableList<NotasHistorico>>();
            notasHistorico = FXCollections.observableArrayList();
            String ano = dadosHistorico[0][2];
            int contaAnos = 1;
            for (int i = 0; i < dadosHistorico.length; i++) {
                if(!dadosHistorico[i][2].equals(ano)){
                    contaAnos++;
                }
                ano=dadosHistorico[i][2];
            }
            int[] divideTabelas = new int[contaAnos];
            int indiceAux=0;
            ano=dadosHistorico[0][2];
            for (int i = 0; i < dadosHistorico.length; i++) {
                if(!dadosHistorico[i][2].equals(ano)){
                    divideTabelas[indiceAux]=i-1;
                    indiceAux++;
                }
                if(i==dadosHistorico.length-1){
                    divideTabelas[indiceAux]=i;
                }
                ano=dadosHistorico[i][2];
            }
            indiceAux=0;
            for (int i = 0; i <= divideTabelas[divideTabelas.length-1]; i++) {
                notasHistorico.add(new NotasHistorico(dadosHistorico[i][0], dadosHistorico[i][1], dadosHistorico[i][2], dadosHistorico[i][3], dadosHistorico[i][4]));
                if(i==divideTabelas[indiceAux]){
                    listaNotas.add(FXCollections.observableArrayList(notasHistorico));
                    notasHistorico.clear();
                    indiceAux++;
                }
            }
            listaTabelas = new ArrayList<TableView<NotasHistorico>>();
            for (int i=0; i < contaAnos; i++){
                listaTabelas.add(new TableView<NotasHistorico>());
                setTabelaNotas(i, dadosHistorico[divideTabelas[i]][5], relatorio7BD.getCurso(cpf));
            }
            return 0;
        }
        return 1;
    }

    @FXML
    public void setTabelaNotas(int indiceTabela, String serie, String curso) {
        listaTabelas.get(indiceTabela).setEditable(true);
        listaTabelas.get(indiceTabela).setSelectionModel(null);

        TableColumn titulo = new TableColumn(serie+"ª SÉRIE - "+curso.toUpperCase());
        
        TableColumn disciplina = new TableColumn("Disciplina");
        disciplina.setCellValueFactory(new PropertyValueFactory<NotasHistorico, String>("disciplina"));
        disciplina.setSortable(false);

        TableColumn nota = new TableColumn("Nota");
        nota.setCellValueFactory(new PropertyValueFactory<NotasHistorico, String>("nota"));
        nota.setSortable(false);
        nota.setStyle("-fx-alignment: CENTER");


        TableColumn ano = new TableColumn("Ano");
        ano.setCellValueFactory(new PropertyValueFactory<NotasHistorico, String>("ano"));
        ano.setSortable(false);
        ano.setStyle("-fx-alignment: CENTER");

        TableColumn cargaHoraria = new TableColumn("C.H.");
        cargaHoraria.setCellValueFactory(new PropertyValueFactory<NotasHistorico, String>("cargaHoraria"));
        cargaHoraria.setSortable(false);
        cargaHoraria.setStyle("-fx-alignment: CENTER");

        TableColumn frequencia = new TableColumn("Freq.%");
        frequencia.setCellValueFactory(new PropertyValueFactory<NotasHistorico, String>("frequencia"));
        frequencia.setSortable(false);
        frequencia.setStyle("-fx-alignment: CENTER");

        titulo.getColumns().addAll(ano, disciplina, nota, cargaHoraria, frequencia);
        
        disciplina.maxWidthProperty().bind(listaTabelas.get(indiceTabela).widthProperty().multiply(0.595));
        nota.maxWidthProperty().bind(listaTabelas.get(indiceTabela).widthProperty().multiply(0.1));
        ano.maxWidthProperty().bind(listaTabelas.get(indiceTabela).widthProperty().multiply(0.1));
        cargaHoraria.maxWidthProperty().bind(listaTabelas.get(indiceTabela).widthProperty().multiply(0.1));
        frequencia.maxWidthProperty().bind(listaTabelas.get(indiceTabela).widthProperty().multiply(0.1));
        
        disciplina.minWidthProperty().bind(listaTabelas.get(indiceTabela).widthProperty().multiply(0.595));
        nota.minWidthProperty().bind(listaTabelas.get(indiceTabela).widthProperty().multiply(0.1));
        ano.minWidthProperty().bind(listaTabelas.get(indiceTabela).widthProperty().multiply(0.1));
        cargaHoraria.minWidthProperty().bind(listaTabelas.get(indiceTabela).widthProperty().multiply(0.1));
        frequencia.minWidthProperty().bind(listaTabelas.get(indiceTabela).widthProperty().multiply(0.1));

        listaTabelas.get(indiceTabela).setItems(listaNotas.get(indiceTabela));
        listaTabelas.get(indiceTabela).setFixedCellSize(23);
        listaTabelas.get(indiceTabela).prefHeightProperty().bind(Bindings.size(listaTabelas.get(indiceTabela).getItems()).multiply(listaTabelas.get(indiceTabela).getFixedCellSize()).add(50));
        listaTabelas.get(indiceTabela).getColumns().add(titulo);
        painelPDF.getChildren().add(listaTabelas.get(indiceTabela));

        listaTabelas.get(indiceTabela).setPrefWidth(painelPDF.getWidth()-20);
        listaTabelas.get(indiceTabela).setLayoutX(10);
        if(indiceTabela==0)
            listaTabelas.get(indiceTabela).setLayoutY(gridDados.getLayoutY()+gridDados.getHeight()+5);
        if(indiceTabela>0){
            listaTabelas.get(indiceTabela).setLayoutY(listaTabelas.get(indiceTabela-1).getLayoutY()+listaTabelas.get(indiceTabela-1).getPrefHeight()+20);
        }

        listaTabelas.get(indiceTabela).setEditable(false);

        titulo.getColumns().addListener(new ListChangeListener() {
            public boolean suspended;

            @Override
            public void onChanged(Change change) {
                change.next();
                if (change.wasReplaced() && !suspended) {
                    this.suspended = true;
                    titulo.getColumns().setAll(ano, disciplina, nota, cargaHoraria, frequencia);
                    this.suspended = false;
                }
            }
        });
    }

    public void imprimeRelatorio() {
        Printer printer = Printer.getDefaultPrinter();
        PageLayout pageLayout = printer.createPageLayout(Paper.A4, PageOrientation.PORTRAIT, Printer.MarginType.HARDWARE_MINIMUM);
        PrinterAttributes attr = printer.getPrinterAttributes();
        PrinterJob job = PrinterJob.createPrinterJob();
        double scaleX = pageLayout.getPrintableWidth() / painelPDF.getBoundsInParent().getWidth();
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
    
    public void setRelatorio7(Relatorio7 relatorio7){
        this.relatorio7=relatorio7;
    }
    
    public void voltar() throws SQLException, ParseException{
        relatorio7.invocaLayoutPesquisa();
    }
}
