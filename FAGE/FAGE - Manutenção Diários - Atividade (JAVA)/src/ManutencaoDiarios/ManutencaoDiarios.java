package ManutencaoDiarios;

import ManutencaoDiarios.Visualisacao.MostraDisciplinasController;
import ManutencaoDiarios.Visualizacao.PainelInsereController;
import ManutencaoDiarios.Visualizacao.PainelMostraAtividadeController;
import java.io.IOException;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.stage.Stage;

/**
 *
 * @author Aluno
 */
public class ManutencaoDiarios extends Application {
    
    private Stage palcoPrincipal;
    private AnchorPane telaBase;
    
    @Override
    public void start(Stage palcoPrincipal) {
        this.palcoPrincipal = palcoPrincipal;
        palcoPrincipal.setTitle("Manutenção Diários - Atividades");
        
        chamaMostraDisciplinas();
    }
    
    public void chamaLayoutInsere(){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/PainelInsere.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            PainelInsereController controller = carregadorFXML.getController();
            controller.setManutencaoDiarios(this);
        }catch(IOException e){
            e.printStackTrace();
        }
    }
    
    public void chamaMostraDisciplinas(){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/MostraDisciplinas.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            MostraDisciplinasController controller = carregadorFXML.getController();
            controller.setManutencaoDiarios(this);
        }catch(IOException e){
            e.printStackTrace();
        }
    }
    
    public void chamaLayoutMostraAtividades(){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/PainelMostraAtividades.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            PainelMostraAtividadeController controller = carregadorFXML.getController();
            controller.setManutencaoDiarios(this);
        }catch(IOException e){
            e.printStackTrace();
        }
    }

    public static void main(String[] args) {
        launch(args);
    }
    
}
