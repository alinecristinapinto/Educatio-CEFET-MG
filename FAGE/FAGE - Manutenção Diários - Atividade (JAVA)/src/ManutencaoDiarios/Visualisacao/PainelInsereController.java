package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import ManutencaoDiarios.Modelo.Conteudo;
import ManutencaoDiarios.Modelo.Disciplina;
import ManutencaoDiarios.Modelo.Turma;
import java.io.IOException;
import java.sql.SQLException;
import java.time.format.DateTimeFormatter;
import javafx.fxml.FXML;
import javafx.scene.control.DatePicker;
import javafx.scene.control.TextField;
import testeclassealert.AlertaPadrao;


/**
 *
 * @author Felipe
 */
public class PainelInsereController {
    private ManutencaoDiarios manutencaoDiarios;
    private Atividade atividade = new Atividade();
    private Disciplina disciplina;
    private Turma turma;
    private Conteudo conteudo;
    
    @FXML
    private TextField nomeAtividade;
    @FXML
    private TextField valorAtividade;
    @FXML
    private DatePicker dataAtividade;
    
    @FXML
    private void initialize() throws SQLException{
        dataAtividade.setEditable(false);
    }

    public void setDisciplina(Disciplina disciplina) {
        this.disciplina = disciplina;
    }

    public void setTurma(Turma turma) {
        this.turma = turma;
    }
    
    public void setConteudo(Conteudo conteudo){
        this.conteudo = conteudo;
    }
    
    //    private ManutencaoDiariosIntegracao manutencaoDiariosIntegracao;
//    public ManutencaoDiariosIntegracao getManutencaoDiariosIntegracao(){
//        return manutencaoDiariosIntegracao;
//    }

    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }
    
    public void insereBd() throws ClassNotFoundException, SQLException, IOException{
        if(valorAtividade.getText().equals("") || nomeAtividade.getText().equals("") || dataAtividade.getValue() == null){
           AlertaPadrao alerta = new AlertaPadrao();
           alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
            
        }else if(!valorAtividade.getText().matches("^([0-9]{1,2}){1}(.[0-9]{1,2})?$")){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos preenchidos incorretamente", "Erro!", "Preencha corretamente todos os campos para continuar.");
            
        }else{
            atividade.insereAtividade(disciplina.getNome(), nomeAtividade.getText(), 
            dataAtividade.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy")), 
            Double.parseDouble(valorAtividade.getText()), turma.getNome(), turma.getSerie(), conteudo.getNome());
        
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertConfirmacao(manutencaoDiarios.getPalcoPrincipal(), "Inserção", "Sucesso!", "Inserção realizada com sucesso no banco de dados.");
            manutencaoDiarios.chamaEscolhe(disciplina, turma);
        }
    }
    
    public void cancela() throws SQLException{
        manutencaoDiarios.chamaEscolhe(disciplina, turma);
    }
}
