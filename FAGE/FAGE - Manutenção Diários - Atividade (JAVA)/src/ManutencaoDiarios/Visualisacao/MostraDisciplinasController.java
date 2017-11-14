package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import ManutencaoDiarios.Modelo.AtividadeTabela;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;

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
        
        disciplinas.getSelectionModel().selectedItemProperty().addListener(
            (observable, oldValue, newValue) -> {
            try {
                confirma(newValue.toString());
            } catch (SQLException ex) {
                Logger.getLogger(MostraDisciplinasController.class.getName()).log(Level.SEVERE, null, ex);
            }
        });
        
        turmas.getSelectionModel().selectedItemProperty().addListener(
            (observable, oldValue, newValue) -> {
            try {
                colocaNomes(newValue.toString());
            } catch (SQLException ex) {
                Logger.getLogger(MostraDisciplinasController.class.getName()).log(Level.SEVERE, null, ex);
            }
        });
    }

    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }
    
    public void confirma(String valor) throws SQLException{
        disciplina = valor;
        
        if(disciplina == null){
            Alert alerta = new Alert(Alert.AlertType.INFORMATION);
            alerta.setTitle("Campos vazios");
            alerta.setHeaderText(null);
            alerta.setContentText("Preencha todos os campos para continuar!");
            
            alerta.showAndWait();
        }else{
            turmas.setItems(atividade.pegaTurmas(disciplina));
            turmas.setVisible(true);
            
        }
    }
    
    public void colocaNomes(String valor) throws SQLException{
        turma = valor;
        
        if(turma == null){
            Alert alerta = new Alert(Alert.AlertType.INFORMATION);
            alerta.setTitle("Campos vazios");
            alerta.setHeaderText(null);
            alerta.setContentText("Preencha todos os campos para continuar!");
            
            alerta.showAndWait();
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
    
    
    
    public void alterar(){
        if(tabela.getSelectionModel().getSelectedItem() == null){
            Alert alerta = new Alert(Alert.AlertType.INFORMATION);
            alerta.setTitle("Campos vazios");
            alerta.setHeaderText(null);
            alerta.setContentText("Preencha todos os campos para continuar!");
            
            alerta.showAndWait();
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
    
    public void deletar() throws ClassNotFoundException, SQLException{
        if(tabela.getSelectionModel().getSelectedItem() == null){
            Alert alerta = new Alert(Alert.AlertType.INFORMATION);
            alerta.setTitle("Campos vazios");
            alerta.setHeaderText(null);
            alerta.setContentText("Preencha todos os campos para continuar!");
            
            alerta.showAndWait();
        }else{
            String nomeAtiv = tabela.getSelectionModel().getSelectedItem().getNome().get();
            String dataAtiv = tabela.getSelectionModel().getSelectedItem().getData().get();
            double valorAtiv = tabela.getSelectionModel().getSelectedItem().getValor().get();

            atividade.removeAtividade(disciplina, turma, nomeAtiv, dataAtiv, valorAtiv);

            Alert alerta = new Alert(Alert.AlertType.INFORMATION);
            alerta.setTitle("Deletar atividade do BD");
            alerta.setHeaderText(null);
            alerta.setContentText("Atividade apagada com sucesso!");

            alerta.showAndWait();

            System.exit(0);
        }
    }
    
    public void cancela(){
        System.exit(0);
    }
}
