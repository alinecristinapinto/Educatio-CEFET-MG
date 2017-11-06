package ManutencaoDiarios;

import ManutencaoDiarios.Visualisacao.PainelAltera2Controller;
import ManutencaoDiarios.Visualisacao.PainelAlteraController;
import ManutencaoDiarios.Visualisacao.PainelInsereController;
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
        
        chamaLayoutInsere();
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
    
    public void chamaLayoutAltera(){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/PainelAltera.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            PainelAlteraController controller = carregadorFXML.getController();
            controller.setManutencaoDiarios(this);
        }catch(IOException e){
            e.printStackTrace();
        }
    }
    
    public void chamaLayoutAltera2(){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDiarios.class.getResource("Visualisacao/PainelAltera2.fxml"));
            telaBase = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            PainelAltera2Controller controller = carregadorFXML.getController();
            controller.setManutencaoDiarios(this);
        }catch(IOException e){
            e.printStackTrace();
        }
    }

    public static void main(String[] args) {
        launch(args);
    }
    
}
