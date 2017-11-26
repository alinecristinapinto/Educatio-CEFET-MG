package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import ManutencaoDiarios.Modelo.AtividadeTabela;
import ManutencaoDiarios.Modelo.Conteudo;
import ManutencaoDiarios.Modelo.Disciplina;
import ManutencaoDiarios.Modelo.Turma;
import java.io.IOException;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.control.ListView;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.layout.AnchorPane;
import testeclassealert.AlertaPadrao;

/**
 *
 * @author Felipe
 */
public class EscolheController {
    private ManutencaoDiarios manutencaoDiarios;
    private Disciplina disciplina;
    private Turma turma;
    private Conteudo conteudo = new Conteudo();
    private Atividade atividade= new Atividade();
    private String visivel;
    
    @FXML
    private Label atividades;
    
    private ObservableList<AtividadeTabela> listaAtiv = FXCollections.observableArrayList();
    
    @FXML
    private AnchorPane painelDireita;
    
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
    
    //    private ManutencaoDiariosIntegracao manutencaoDiariosIntegracao;
//    public ManutencaoDiariosIntegracao getManutencaoDiariosIntegracao(){
//        return manutencaoDiariosIntegracao;
//    }
    
    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }
    
    public void setDisciplina(Disciplina disciplina) throws SQLException{
        this.disciplina = disciplina;
        listaConteudos.setItems(atividade.pegaConteudos(disciplina.getNome()));
    }
    
    public void setTurma(Turma turma) throws SQLException{
        this.turma = turma;
        setTabela(disciplina.getNome(), turma.getNome(), turma.getSerie(), conteudo.getNome());
    }
    
    @FXML
    private void initialize() throws SQLException{
        listaConteudos.getSelectionModel().selectedItemProperty().addListener(
            (observable, oldValue, newValue) -> {
            try {
                conteudo.setNome(newValue.toString());
                setTabela(disciplina.getNome(), turma.getNome(), turma.getSerie(), conteudo.getNome());
            } catch (SQLException ex) {
                Logger.getLogger(EscolheController.class.getName()).log(Level.SEVERE, null, ex);
            }
        });
    }
    
    public void setTabela(String disciplina, String turma, int serie, String conteudo) throws SQLException{
        tabela.setEditable(true);

        nome.setCellValueFactory(cellData -> cellData.getValue().getNome());
        data.setCellValueFactory(cellData -> cellData.getValue().getData());
        valor.setCellValueFactory(cellData -> cellData.getValue().getValor().asObject());
        
        listaAtiv = atividade.montaLista(disciplina, turma, serie, conteudo);
        
        tabela.setItems(listaAtiv);
        painelDireita.setVisible(true);
    }
    
    public void inserirAtividade() throws SQLException, IOException{
        if(listaConteudos.getSelectionModel().getSelectedItem() == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Selecione um conteúdo para continuar.");
        }else{
            conteudo.setNome(listaConteudos.getSelectionModel().getSelectedItem().toString());
            manutencaoDiarios.chamaLayoutInsere(disciplina, turma, conteudo);
            setTabela(disciplina.getNome(), turma.getNome(), turma.getSerie(), conteudo.getNome());
        }
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
            
            setTabela(disciplina.getNome(), turma.getNome(), turma.getSerie(), conteudo.getNome());
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

            atividade.removeAtividade(disciplina.getNome(), turma.getNome(), turma.getSerie(), nomeAtiv, dataAtiv, valorAtiv);
            
            setTabela(disciplina.getNome(), turma.getNome(), turma.getSerie(), conteudo.getNome());
            
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

            atividade.removeConteudo(disciplina.getNome(), turma.getNome(), turma.getSerie(), nomeCont);
            
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertConfirmacao(manutencaoDiarios.getPalcoPrincipal(), "Delete", "Sucesso!", "Atividade apagada com sucesso no banco de dados.");
            
            //Recarrega a página 
            manutencaoDiarios.chamaEscolhe(disciplina, turma);
            listaConteudos.setItems(atividade.pegaConteudos(disciplina.getNome()));
        }
    }
    
    public void notas() throws IOException, SQLException{
        if(tabela.getSelectionModel().getSelectedItem() == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
        }else{
            atividade.setNome(tabela.getSelectionModel().getSelectedItem().getNome().get());
            atividade.setData(tabela.getSelectionModel().getSelectedItem().getData().get());
            atividade.setValor(tabela.getSelectionModel().getSelectedItem().getValor().get());
            
            manutencaoDiarios.chamaNotas(atividade, disciplina, turma, conteudo);
        }
    }
    
    public void faltas() throws IOException, SQLException{
        if(tabela.getSelectionModel().getSelectedItem() == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
        }else{
            atividade.setNome(tabela.getSelectionModel().getSelectedItem().getNome().get());
            atividade.setData(tabela.getSelectionModel().getSelectedItem().getData().get());
            atividade.setValor(tabela.getSelectionModel().getSelectedItem().getValor().get());
            
            manutencaoDiarios.chamaFaltas(atividade, disciplina, turma, conteudo);
        }
    }
    
    public void sair(){
        manutencaoDiarios.chamaSelecionaDados();
    }
    
}
