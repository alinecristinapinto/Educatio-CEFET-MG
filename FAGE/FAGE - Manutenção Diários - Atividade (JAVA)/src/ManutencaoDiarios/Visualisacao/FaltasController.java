package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import ManutencaoDiarios.Modelo.Conteudo;
import ManutencaoDiarios.Modelo.Disciplina;
import ManutencaoDiarios.Modelo.FaltasTabela;
import ManutencaoDiarios.Modelo.NotasTabela;
import ManutencaoDiarios.Modelo.Turma;
import java.io.IOException;
import java.sql.SQLException;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import testeclassealert.AlertaPadrao;

/**
 *
 * @author Felipe
 */
public class FaltasController {
    
    private ManutencaoDiarios manutencaoDiarios;
    private Atividade atividade;
    private Disciplina disciplina;
    private Turma turma;
    private Conteudo conteudo;
    private String nomeCont;
    
    private ObservableList<FaltasTabela> lista = FXCollections.observableArrayList();
    
    //    private ManutencaoDiariosIntegracao manutencaoDiariosIntegracao;
//    public ManutencaoDiariosIntegracao getManutencaoDiariosIntegracao(){
//        return manutencaoDiariosIntegracao;
//    }

    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }

    public void setAtividade(Atividade atividade) {
        this.atividade = atividade;
    }

    public void setDisciplina(Disciplina disciplina) {
        this.disciplina = disciplina;
    }

    public void setTurma(Turma turma) {
        this.turma = turma;
    }

    public void setConteudo(Conteudo conteudo) throws SQLException {
        this.conteudo = conteudo;
        setTabela();
    }
    
    @FXML
    private TableView<FaltasTabela> tabela;
    
    @FXML
    private TableColumn<FaltasTabela, String> nome;
    
    @FXML
    private TableColumn<FaltasTabela, Integer> faltas;
    
    @FXML
    private TextField campo;
    
    @FXML
    public void initialize(){
        
    }
    
    public void setTabela() throws SQLException{
        tabela.setEditable(true);
        
        nome.setCellValueFactory(cellData -> cellData.getValue().getNomeAluno());
        faltas.setCellValueFactory(cellData -> cellData.getValue().getFaltasAluno().asObject());
        
        nomeCont = conteudo.getNome();
        lista = atividade.montaListaFaltas(nomeCont);
        
        tabela.setItems(lista);
    }
    
    public void confirma() throws IOException, SQLException{
        if(tabela.getSelectionModel().getSelectedItem() == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Selecione uma linha para continuar.");
        }else{
            int faltas = Integer.parseInt(campo.getText());
            String aluno = tabela.getSelectionModel().getSelectedItem().getNomeAluno().get();
            
            atividade.alteraNota(aluno, faltas, disciplina.getNome(), conteudo.getNome());
            manutencaoDiarios.chamaNotas(atividade, disciplina, turma, conteudo);
        }
    }
    
    public void concluir() throws SQLException{
        manutencaoDiarios.chamaEscolhe(disciplina, turma);
    }
}
