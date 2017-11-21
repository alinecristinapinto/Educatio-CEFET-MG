package ManutencaoDiarios;

import ManutencaoDiarios.Modelo.Atividade;
import ManutencaoDiarios.Modelo.Disciplina;
import ManutencaoDiarios.Modelo.Turma;
import ManutencaoDiarios.Visualisacao.AlteraAtividadeController;
import ManutencaoDiarios.Visualisacao.AlteraConteudoController;
import ManutencaoDiarios.Visualisacao.EscolheController;
import ManutencaoDiarios.Visualisacao.InsereConteudoController;
import ManutencaoDiarios.Visualisacao.PainelInsereController;
import ManutencaoDiarios.Visualisacao.SelecionaDadosController;
import java.io.IOException;
import java.sql.SQLException;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.stage.Stage;

/**
 *
 * @author Felipe
 */
public class ManutencaoDiarios extends Application {
    
    private Stage palcoPrincipal;
    private AnchorPane telaBase;
    
    @Override
    public void start(Stage palcoPrincipal) {
        this.palcoPrincipal = palcoPrincipal;
        palcoPrincipal.setTitle("Manutenção Diários - Atividades");
        
        
        chamaSelecionaDados();
    }

    public Stage getPalcoPrincipal() {
        return palcoPrincipal;
    }
    
    
    public void chamaLayoutInsere(Disciplina disciplina, Turma turma){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/PainelInsere.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            PainelInsereController controller = carregadorFXML.getController();
            controller.setManutencaoDiarios(this);
            controller.setDisciplina(disciplina);
            controller.setTurma(turma);
        }catch(IOException e){
            e.printStackTrace();
        }
    }
    
    public void chamaAlteraAtividade(Atividade atividade, Disciplina disciplina, Turma turma){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/AlteraAtividade.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            AlteraAtividadeController controller = carregadorFXML.getController();
            controller.setAtividade(atividade);
            controller.setManutencaoDiarios(this);
            controller.setDisciplina(disciplina);
            controller.setTurma(turma);
        }catch(IOException e){
            e.printStackTrace();
        }
    }
    
    public void chamaEscolhe(Disciplina disciplina, Turma turma) throws SQLException{
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/Escolhe.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            EscolheController controller = carregadorFXML.getController();
            controller.setManutencaoDiarios(this);
            controller.setDisciplina(disciplina);
            controller.setTurma(turma);
        }catch(IOException e){
            e.printStackTrace();
        }
    }
    
    public void chamaSelecionaDados(){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/SelecionaDados.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            SelecionaDadosController controller = carregadorFXML.getController();
            controller.setManutencaoDiarios(this);
        }catch(IOException e){
            e.printStackTrace();
        }
    }
    
    public void chamaInsereConteudo(Disciplina disciplina, Turma turma) throws SQLException{
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/InsereConteudo.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            InsereConteudoController controller = carregadorFXML.getController();
            controller.setManutencaoDiarios(this);
            controller.setDisciplina(disciplina);
            controller.setTurma(turma);
        }catch(IOException e){
            e.printStackTrace();
        }
    }
    
    public void chamaAlteraConteudo(Atividade atividade, Disciplina disciplina, Turma turma){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/AlteraConteudo.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            AlteraConteudoController controller = carregadorFXML.getController();
            controller.setManutencaoDiarios(this);
            controller.setAtividade(atividade);
            controller.setDisciplina(disciplina);
            controller.setTurma(turma);
        }catch(IOException e){
            e.printStackTrace();
        }
    }
    

    public static void main(String[] args) {
        launch(args);
    }
    
}
