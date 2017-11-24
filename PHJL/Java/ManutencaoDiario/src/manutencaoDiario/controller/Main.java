package manutencaoDiario.controller;

import java.io.IOException;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.ScrollPane;
import javafx.scene.image.Image;
import javafx.stage.Stage;

public class Main extends Application {

    private Stage palcoPrincipal;
    private ScrollPane diarioAlunoLayout;

    @Override
    public void start(Stage palcoPrincipal) {
        this.palcoPrincipal = palcoPrincipal;
        palcoPrincipal.setTitle("Educatio");
        palcoPrincipal.getIcons().add(new Image("file:imagens/Educatio.png"));
        mostraDiarioAluno();
    }

    public void mostraDiarioAluno() {

        try {

            FXMLLoader carregadorFXML = new FXMLLoader();

            carregadorFXML.setLocation(Main.class.getResource("view/AcessoDiarioAluno.fxml"));
            diarioAlunoLayout = (ScrollPane) carregadorFXML.load();

            Scene cena = new Scene(diarioAlunoLayout);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

        } catch (IOException ex) {
        }
    }

    public static void main(String[] args) {
        launch(args);
    }

}
