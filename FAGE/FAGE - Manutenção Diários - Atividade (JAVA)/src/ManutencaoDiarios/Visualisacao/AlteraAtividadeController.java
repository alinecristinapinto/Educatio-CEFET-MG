package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
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
public class AlteraAtividadeController {
    private ManutencaoDiarios manutencaoDiarios;
    private Atividade atividade;
    private String nomeNovoAtiv;
    private String dataNovoAtiv;
    private double valorNovoAtiv;
    private String nomeAtiv;
    private String dataAtiv;
    private double valorAtiv;

    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }

    public void setAtividade(Atividade atividade) {
        this.atividade = atividade;
        
        nomeAtiv = atividade.getNome();
        dataAtiv = atividade.getData();
        valorAtiv = atividade.getValor();
        
        nome.setText(nomeAtiv);
        valor.setText(Double.toString(valorAtiv));
        data.setValue(LocalDate.parse(dataAtiv, DateTimeFormatter.ofPattern("dd/MM/yyyy")));
    }
    
    @FXML
    private TextField nome;
    
    @FXML
    private TextField valor;
    
    @FXML
    private DatePicker data;
    
    @FXML
    private void initialize(){
        data.setEditable(false);
    }
    
    public void confirma() throws ClassNotFoundException, SQLException, IOException{
        if(nome.getText().equals("") || valor.getText().equals("") || data.getValue() == null){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos vazios", "Erro!", "Existem campos vazios, preencha todos para continuar.");
            
        }else if(!valor.getText().matches("^([0-9]{1,2}){1}(.[0-9]{1,2})?$")){
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertErro(manutencaoDiarios.getPalcoPrincipal(), "Campos preenchidos incorretamente", "Erro!", "Preencha corretamente todos os campos para continuar.");
            
        }else{
            nomeNovoAtiv = nome.getText();
            valorNovoAtiv = Double.parseDouble(valor.getText());
            dataNovoAtiv = data.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy"));
            atividade.alteraAtividade(nomeNovoAtiv, dataNovoAtiv, valorNovoAtiv, atividade.getIdProfDisciplina(), nomeAtiv, dataAtiv, valorAtiv);
            
            AlertaPadrao alerta = new AlertaPadrao();
            alerta.mostraAlertConfirmacao(manutencaoDiarios.getPalcoPrincipal(), "Alteração", "Sucesso!", "Alteração realizada com sucesso no banco de dados.");
        }
    }
    
    public void cancela(){
        manutencaoDiarios.chamaMostraDisciplinas();
    }
}
