package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import ManutencaoDiarios.Modelo.AtividadeTabela;
import java.io.IOException;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import testeclassealert.AlertaPadrao;

/**
 *
 * @author Felipe
 */
public class MostraDisciplinasController {
    private ManutencaoDiarios manutencaoDiarios;
    private Atividade atividade = new Atividade();
    private String disciplina = new String();
    private String turma = new String();
    
    private ObservableList<AtividadeTabela> listaAtiv = FXCollections.observableArrayList();
    
    @FXML
    private ChoiceBox disciplinas;
    
    @FXML
    private ChoiceBox turmas;
    
    @FXML
    private Label labelTurma;
    
    @FXML
    private TableView<AtividadeTabela> tabela;
    
    @FXML
    private TableColumn<AtividadeTabela, String> nome;
    
    @FXML
    private TableColumn<AtividadeTabela, String> data;
    
    @FXML
    private TableColumn<AtividadeTabela, Double> valor;
    
    @FXML
    private void initialize() throws SQLException{
        disciplinas.setItems(atividade.pegaDisciplinas());
        turmas.setVisible(false);
        tabela.setVisible(false);
        labelTurma.setVisible(false);
        
        disciplinas.getSelectionModel().selectedItemProperty().addListener(
            (observable, oldValue, newValue) -> {
            try {
                confirma(newValue.toString());
            } catch (SQLException ex) {
                Logger.getLogger(MostraDisciplinasController.class.getName()).log(Level.SEVERE, null, ex);
            } catch (IOException ex) {
                Logger.getLogger(MostraDisciplinasController.class.getName()).log(Level.SEVERE, null, ex);
            }
        });
        
        turmas.getSelectionModel().selectedItemProperty().addListener(
            (observable, oldValue, newValue) -> {
            try {
                colocaNomes(newValue.toString());
            } catch (SQLException ex) {
                Logger.getLogger(MostraDisciplinasController.class.getName()).log(Level.SEVERE, null, ex);
            } catch (IOException ex) {
                Logger.getLogger(MostraDisciplinasController.class.getName()).log(Level.SEVERE, null, ex);
            }
        });
    }

    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }
    
    public void confirma(String valor) throws SQLException, IOException{
        disciplina = valor;
        
        if(disciplina == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
            
        }else{
            turmas.setItems(atividade.pegaTurmas(disciplina));
            turmas.setVisible(true);
            labelTurma.setVisible(true);
            
        }
    }
    
    public void colocaNomes(String valor) throws SQLException, IOException{
        turma = valor;
        
        if(turma == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
            
        }else{
            setTabela(turma, disciplina);
            tabela.setVisible(true);
        }
    }
    
    public void setTabela(String turma, String disciplina) throws SQLException{
        tabela.setEditable(true);

        nome.setCellValueFactory(cellData -> cellData.getValue().getNome());
        data.setCellValueFactory(cellData -> cellData.getValue().getData());
        valor.setCellValueFactory(cellData -> cellData.getValue().getValor().asObject());
        
        listaAtiv = atividade.montaLista(disciplina, turma);
        
        tabela.setItems(listaAtiv);
    }
    
    
    
    public void alterar() throws IOException{
        if(tabela.getSelectionModel().getSelectedItem() == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
            
        }else{
            String nomeAtiv = tabela.getSelectionModel().getSelectedItem().getNome().get();
            String dataAtiv = tabela.getSelectionModel().getSelectedItem().getData().get();
            double valorAtiv = tabela.getSelectionModel().getSelectedItem().getValor().get();

            atividade.setNome(nomeAtiv);
            atividade.setData(dataAtiv);
            atividade.setValor(valorAtiv);

            manutencaoDiarios.chamaAlteraAtividade(atividade);
        }
        
    }
    
    public void deletar() throws ClassNotFoundException, SQLException, IOException{
        if(tabela.getSelectionModel().getSelectedItem() == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
            
        }else{
            String nomeAtiv = tabela.getSelectionModel().getSelectedItem().getNome().get();
            String dataAtiv = tabela.getSelectionModel().getSelectedItem().getData().get();
            double valorAtiv = tabela.getSelectionModel().getSelectedItem().getValor().get();

            atividade.removeAtividade(disciplina, turma, nomeAtiv, dataAtiv, valorAtiv);

            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertConfirmacao(manutencaoDiarios.getPalcoPrincipal(), "Delte", "Sucesso!", "Atividade apagada com sucesso no banco de dados.");
        }
    }
    
    public void cancela(){
        System.exit(0);
    }
}
