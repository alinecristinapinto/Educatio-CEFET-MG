package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import java.sql.SQLException;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.DatePicker;
import javafx.scene.control.TextField;

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
    public void initialize(){
        
    }
    
    public void confirma() throws ClassNotFoundException, SQLException{
        if(nome.getText().equals("") || valor.getText().equals("") || data.getValue() == null){
            Alert alerta = new Alert(Alert.AlertType.INFORMATION);
            alerta.setTitle("Campos vazios");
            alerta.setHeaderText(null);
            alerta.setContentText("Preencha todos os campos para continuar!");
            
            alerta.showAndWait();
        }else if(!valor.getText().matches("[0-9]+")){
            Alert alerta = new Alert(Alert.AlertType.INFORMATION);
            alerta.setTitle("Campos incorretos");
            alerta.setHeaderText(null);
            alerta.setContentText("Preencha o campo corretamente (double) para continuar!");
            
            alerta.showAndWait();
        }else{
            nomeNovoAtiv = nome.getText();
            valorNovoAtiv = Double.parseDouble(valor.getText());
            dataNovoAtiv = data.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy"));
            
            atividade.alteraAtividade(nomeNovoAtiv, dataNovoAtiv, valorNovoAtiv, atividade.getIdProfDisciplina(), nomeAtiv, dataAtiv, valorAtiv);
            
            Alert alerta = new Alert(Alert.AlertType.INFORMATION);
            alerta.setTitle("Alteração");
            alerta.setHeaderText(null);
            alerta.setContentText("Alteração realizada com sucesso!");
        }
    }
    
    public void cancela(){
        manutencaoDiarios.chamaMostraDisciplinas();
    }
}
