package manutencaoDiario.controller.view;

import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.control.SplitPane;
import javafx.scene.control.ToolBar;
import javafx.scene.layout.BorderPane;

public class BlocoDiarioAlunoControlador {

    @FXML
    private ToolBar suporteCabecalho;

    @FXML
    private Label labelCabecalho;

    @FXML
    private Label labelNotas;

    @FXML
    private Label labelFrequencia;

    @FXML
    private SplitPane divisor;

    @FXML
    private BorderPane bordas;

    @FXML
    public void initialize() {
        // TODO
    }

    public ToolBar getSuporteCabecalho() {
        return suporteCabecalho;
    }

    public void setSuporteCabecalho(ToolBar suporteCabecalho) {
        this.suporteCabecalho = suporteCabecalho;
    }

    public Label getLabelCabecalho() {
        return labelCabecalho;
    }

    public void setLabelCabecalho(String labelCabecalho) {
        this.labelCabecalho.setText(labelCabecalho);
    }

    public Label getLabelNotas() {
        return labelNotas;
    }

    public void setLabelNotas(Label labelNotas) {
        this.labelNotas = labelNotas;
    }

    public Label getLabelFrequencia() {
        return labelFrequencia;
    }

    public void setLabelFrequencia(Label labelFrequencia) {
        this.labelFrequencia = labelFrequencia;
    }

    public SplitPane getDivisor() {
        return divisor;
    }

    public void setDivisor(SplitPane divisor) {
        this.divisor = divisor;
    }

    public BorderPane getBordas() {
        return bordas;
    }

    public void setBordas(BorderPane bordas) {
        this.bordas = bordas;
    }
    
    
}
