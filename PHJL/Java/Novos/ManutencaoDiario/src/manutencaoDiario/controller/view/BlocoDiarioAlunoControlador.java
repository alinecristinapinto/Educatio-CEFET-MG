package manutencaoDiario.controller.view;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.control.SplitPane;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.ToolBar;
import javafx.scene.layout.BorderPane;
import manutencaoDiario.controller.ManutencaoDiario;
import manutencaoDiario.controller.model.TabelaAtividades;

public class BlocoDiarioAlunoControlador {

    AcessoDiarioAlunoControlador acesso;
    private ManutencaoDiario manutencaoDiario;
    private ObservableList<TabelaAtividades> dadosAtividade = FXCollections.observableArrayList();

    @FXML
    private TableView<TabelaAtividades> DiarioTabela;
    @FXML
    private TableColumn<TabelaAtividades, String> colunaConteudo;
    @FXML
    private TableColumn<TabelaAtividades, String> colunaAtividade;
    @FXML
    private TableColumn<TabelaAtividades, String> colunaData;
    @FXML
    private TableColumn<TabelaAtividades, String> colunaNota;

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

        colunaConteudo.setCellValueFactory(cellData -> cellData.getValue().getConteudo());
        colunaAtividade.setCellValueFactory(cellData -> cellData.getValue().getAtividade());
        colunaData.setCellValueFactory(cellData -> cellData.getValue().getData());
        colunaNota.setCellValueFactory(cellData -> cellData.getValue().getNota());
 
    }
    public void colocaDados()
    {
        DiarioTabela.setItems(acesso.getDadosAtividade());
    }
    public void setAcesso(AcessoDiarioAlunoControlador acesso) {
        this.acesso = acesso;
    }

    public void setManutencaoDiario(ManutencaoDiario manutencaoDiario) {
        this.manutencaoDiario = manutencaoDiario;
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
