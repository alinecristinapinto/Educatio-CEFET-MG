package educatio.app.view.Alunos.controlador;

import java.io.IOException;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.image.Image;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;

/**
 *
 * @author Pedro H
 */
public class ManutencaoAluno extends Application {
        
    private Stage palcoPrincipal;
    private AnchorPane formularioLayout;
    private BorderPane BaseDoForm;

    @Override
    public void start(Stage palcoPrincipal)  {
        this.palcoPrincipal = palcoPrincipal;
        palcoPrincipal.setTitle("Educatio");
        this.palcoPrincipal.getIcons().add(new Image("file:imagens/Educatio.png"));
        mostraFormulario();
    }

    public void mostraFormulario() {
       
        try {

            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoAluno.class.getResource("visao/VisaoGeralDoUsuario.fxml"));
            formularioLayout = (AnchorPane) carregadorFXML.load();
            
            Scene cena = new Scene(formularioLayout);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

        } catch (IOException ex) {

            ex.printStackTrace();
        }

    }
    
    public static void main(String[] args) {
        launch(args);
    }

}
