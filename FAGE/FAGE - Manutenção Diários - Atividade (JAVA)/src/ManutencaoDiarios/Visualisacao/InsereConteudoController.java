package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
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
public class InsereConteudoController {
    private ManutencaoDiarios manutencaoDiarios;
    private Atividade atividade = new Atividade();
    private Disciplina disciplina;
    private Turma turma;
    
    @FXML
    private TextField nomeConteudo;
    
    @FXML
    private DatePicker dataConteudo;
    
    @FXML
    private TextField etapaConteudo;
    
    @FXML
    public void initialize(){
        dataConteudo.setEditable(false);
    }
    
    //    private ManutencaoDiariosIntegracao manutencaoDiariosIntegracao;
//    public ManutencaoDiariosIntegracao getManutencaoDiariosIntegracao(){
//        return manutencaoDiariosIntegracao;
//    }

    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }

    public void setDisciplina(Disciplina disciplina) {
        this.disciplina = disciplina;
    }

    public void setTurma(Turma turma) {
        this.turma = turma;
    }
    
    public void insereBd() throws IOException, SQLException{
        if(nomeConteudo.getText().equals("") || dataConteudo.getValue() == null){
           AlertaPadrao alerta = new AlertaPadrao();
           alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
        }else if(!etapaConteudo.getText().matches("[1-6]")){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos incorretos", "Erro!", "Preencha todos os campos corretamente para continuar.");
        }else{
            atividade.insereConteudo(Integer.parseInt(etapaConteudo.getText()), disciplina.getNome(), nomeConteudo.getText(),
            dataConteudo.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy")));
        
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertConfirmacao(manutencaoDiarios.getPalcoPrincipal(), "Inserção", "Sucesso!", "Inserção realizada com sucesso no banco de dados.");
            manutencaoDiarios.chamaEscolhe(disciplina, turma);
        }
    }
    
    public void cancela() throws SQLException{
        manutencaoDiarios.chamaEscolhe(disciplina, turma);
    }
    
}
