package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import ManutencaoDiarios.Modelo.AtividadeTabela;
import ManutencaoDiarios.Modelo.Disciplina;
import ManutencaoDiarios.Modelo.Turma;
import java.io.IOException;
import java.sql.SQLException;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.control.ListView;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import testeclassealert.AlertaPadrao;

/**
 *
 * @author Felipe
 */
public class EscolheController {
    private ManutencaoDiarios manutencaoDiarios;
    private Disciplina disciplina;
    private Turma turma;
    private Atividade atividade= new Atividade();
    private String visivel;
    
    @FXML
    private Label atividades;
    
    private ObservableList<AtividadeTabela> listaAtiv = FXCollections.observableArrayList();
    
    @FXML
    private ListView listaConteudos;
    
    @FXML
    private TableView<AtividadeTabela> tabela;
    
    @FXML
    private TableColumn<AtividadeTabela, String> nome;
    
    @FXML
    private TableColumn<AtividadeTabela, String> data;
    
    @FXML
    private TableColumn<AtividadeTabela, Double> valor;
    
    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }
    
    public void setDisciplina(Disciplina disciplina) throws SQLException{
        this.disciplina = disciplina;
        listaConteudos.setItems(atividade.pegaConteudos(disciplina.getNome()));
    }
    
    public void setTurma(Turma turma) throws SQLException{
        this.turma = turma;
        setTabela(disciplina.getNome(), turma.getNome());
    }
    
    @FXML
    private void initialize() throws SQLException{
        
    }
    
    public void setTabela(String disciplina, String turma) throws SQLException{
        tabela.setEditable(true);

        nome.setCellValueFactory(cellData -> cellData.getValue().getNome());
        data.setCellValueFactory(cellData -> cellData.getValue().getData());
        valor.setCellValueFactory(cellData -> cellData.getValue().getValor().asObject());
        
        listaAtiv = atividade.montaLista(disciplina, turma);
        
        tabela.setItems(listaAtiv);
    }
    
    public void inserirAtividade() throws SQLException{
        manutencaoDiarios.chamaLayoutInsere(disciplina, turma);
        setTabela(disciplina.getNome(), turma.getNome());
    }
    
    public void alterarAtividade() throws SQLException, IOException{
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

            manutencaoDiarios.chamaAlteraAtividade(atividade, disciplina, turma);
            
            setTabela(disciplina.getNome(), turma.getNome());
        }
    }
    
    public void deletarAtividade() throws IOException, ClassNotFoundException, SQLException{
        if(tabela.getSelectionModel().getSelectedItem() == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
            
        }else{
            String nomeAtiv = tabela.getSelectionModel().getSelectedItem().getNome().get();
            String dataAtiv = tabela.getSelectionModel().getSelectedItem().getData().get();
            double valorAtiv = tabela.getSelectionModel().getSelectedItem().getValor().get();

            atividade.removeAtividade(disciplina.getNome(), turma.getNome(), nomeAtiv, dataAtiv, valorAtiv);
            
            setTabela(disciplina.getNome(), turma.getNome());
            
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertConfirmacao(manutencaoDiarios.getPalcoPrincipal(), "Delte", "Sucesso!", "Atividade apagada com sucesso no banco de dados.");
        }
    }
    
    public void inserirConteudo() throws SQLException{
        manutencaoDiarios.chamaInsereConteudo(disciplina, turma);
        listaConteudos.setItems(atividade.pegaConteudos(disciplina.getNome()));
    }
    
    public void alterarConteudo() throws IOException, SQLException{
        if(listaConteudos.getSelectionModel().getSelectedItem() == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
        }else{
            String nomeCont = listaConteudos.getSelectionModel().getSelectedItem().toString();
            
            atividade.setNomeConteudo(nomeCont);
            atividade.setEtapaConteudo(atividade.pegaEtapa(nomeCont, disciplina.getNome()));
            atividade.setDataConteudo(atividade.pegaData(nomeCont, disciplina.getNome()));
            
            manutencaoDiarios.chamaAlteraConteudo(atividade, disciplina, turma);
            listaConteudos.setItems(atividade.pegaConteudos(disciplina.getNome()));
        }
    }
    
    public void deletarConteudo() throws IOException, SQLException, ClassNotFoundException{
        if(listaConteudos.getSelectionModel().getSelectedItem() == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
            
        }else{
            String nomeCont = listaConteudos.getSelectionModel().getSelectedItem().toString();

            atividade.removeConteudo(disciplina.getNome(), turma.getNome(), nomeCont);
            
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertConfirmacao(manutencaoDiarios.getPalcoPrincipal(), "Delete", "Sucesso!", "Atividade apagada com sucesso no banco de dados.");
            
            //Recarrega a página 
            manutencaoDiarios.chamaEscolhe(disciplina, turma);
            listaConteudos.setItems(atividade.pegaConteudos(disciplina.getNome()));
        }
    }
    
    public void sair(){
        System.exit(0);
    }
    
}
