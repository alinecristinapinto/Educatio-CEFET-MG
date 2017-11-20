package ManutencaoDiarios.Visualisacao;

import ManutencaoDiarios.ManutencaoDiarios;
import ManutencaoDiarios.Modelo.Atividade;
import ManutencaoDiarios.Modelo.Disciplina;
import java.sql.SQLException;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.ListView;

/**
 *
 * @author Felipe
 */
public class EscolheController {
    private ManutencaoDiarios manutencaoDiarios;
    private Disciplina disciplina;
    private Atividade atividade= new Atividade();
    private String nomeDisciplina = new String();
    
    @FXML
    private Button inserir;
    
    @FXML
    private Button alterar;
    
    @FXML
    private Button deletar;
    
    @FXML
    private ListView listaConteudos;
    
    public void setManutencaoDiarios(ManutencaoDiarios manutencaoDiarios) {
        this.manutencaoDiarios = manutencaoDiarios;
    }
    
    public void setDisciplina(Disciplina disciplina) throws SQLException{
        this.disciplina = disciplina;
        nomeDisciplina = disciplina.getNome();
        listaConteudos.setItems(atividade.pegaConteudos(nomeDisciplina));
    }
    
    @FXML
    private void initialize() throws SQLException{
        
    }
    
}
