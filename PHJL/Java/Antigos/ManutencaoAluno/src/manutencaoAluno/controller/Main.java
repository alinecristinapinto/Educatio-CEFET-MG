package manutencaoAluno.controller;

import java.io.IOException;
import javafx.application.Application;
import static javafx.application.Application.launch;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.image.Image;
import javafx.scene.layout.AnchorPane;
import javafx.stage.Stage;
import manutencaoAluno.controller.view.AlteraAlunoFormularioControlador;

/**
 *
 * @author Pedro H
 */
public class Main extends Application {

    private static Stage palcoPrincipal;
    private static AnchorPane formularioLayout;

    @Override
    public void start(Stage palcoPrincipal) {
        this.palcoPrincipal = palcoPrincipal;
        palcoPrincipal.setTitle("Educatio");
        this.palcoPrincipal.getIcons().add(new Image("file:imagens/Educatio.png"));
        mostraFormulario();
    }

    public void mostraFormulario() {

        try {

            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(Main.class.getResource("view/DeletaAluno.fxml"));
            //carregadorFXML.setLocation(Main.class.getResource("view/FormularioInsercaoDeAluno.fxml"));
            //carregadorFXML.setLocation(Main.class.getResource("view/AlteraAlunoPesquisa.fxml"));
            formularioLayout = (AnchorPane) carregadorFXML.load();

            Scene cena = new Scene(formularioLayout);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

        } catch (IOException ex) {

            ex.printStackTrace();
        }

    }

    public static void mostraFormularioAlteracao(String valorCPF) {

        try {

            AlteraAlunoFormularioControlador temp = new AlteraAlunoFormularioControlador();
            temp.defineCPF(valorCPF);

            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(Main.class.getResource("view/AlteraAlunoFormulario.fxml"));

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
