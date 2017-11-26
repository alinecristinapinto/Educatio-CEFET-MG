package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
//import ManutencaoDiarios.ManutencaoDiariosIntegracao;
import ManutencaoDiarios.Modelo.Atividade;
import ManutencaoDiarios.Modelo.Disciplina;
import ManutencaoDiarios.Modelo.Turma;
import java.io.IOException;
import java.sql.SQLException;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import javafx.fxml.FXML;
import javafx.scene.control.DatePicker;
import javafx.scene.control.TextField;
import testeclassealert.AlertaPadrao;

/**
 *
 * @author Felipe
 */
public class AlteraConteudoController {
    private ManutencaoDiarios manutencaoDiarios;
    private Atividade atividade;
    private Disciplina disciplina;
    private Turma turma;
    
    private String nomeNovo;
    private int etapaNova;
    private String dataNova;
    
    @FXML
    private TextField nome;
    
    @FXML
    private TextField etapa;
    
    @FXML
    private DatePicker data;
    
//    private ManutencaoDiariosIntegracao manutencaoDiariosIntegracao;
//    public ManutencaoDiariosIntegracao getManutencaoDiariosIntegracao(){
//        return manutencaoDiariosIntegracao;
//    }
    

    public ManutencaoDiarios getManutencaoDiarios() {
        return manutencaoDiarios;
    }

    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }

    public void setAtividade(Atividade atividade) {
        this.atividade = atividade;
        
        nome.setText(atividade.getNomeConteudo());
        etapa.setText(Integer.toString(atividade.getEtapaConteudo()));
        data.setValue(LocalDate.parse(atividade.getDataConteudo(), DateTimeFormatter.ofPattern("dd/MM/yyyy")));
    }

    public void setDisciplina(Disciplina disciplina) {
        this.disciplina = disciplina;
    }
    

    public void setTurma(Turma turma) {
        this.turma = turma;
    }
    
    @FXML
    private void initialize(){
        data.setEditable(false);
    }
    
    public void confirma() throws IOException, SQLException{
        if(nome.getText().equals("") || etapa.getText().equals("") || data.getValue() == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
        }else if(!etapa.getText().matches("[1-4]")){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos incorretos", "Erro!", "Preencha todos os campos corretamente para continuar.");
        }else{
            nomeNovo = nome.getText();
            etapaNova = Integer.parseInt(etapa.getText());
            dataNova = data.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy"));
            
            atividade.alteraConteudo(atividade.getNomeConteudo(), disciplina.getNome(), nomeNovo, etapaNova, dataNova);
            
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertConfirmacao(manutencaoDiarios.getPalcoPrincipal(), "Alteração", "Sucesso!", "Alteração realizada com sucesso no banco de dados.");
            
            manutencaoDiarios.chamaEscolhe(disciplina, turma);
            
        }
    }
    
    public void cancela() throws SQLException{
        manutencaoDiarios.chamaEscolhe(disciplina, turma);
    }
}
