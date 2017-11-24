package manutencaoAluno.controller;

import java.io.IOException;
import javafx.application.Application;
import static javafx.application.Application.launch;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.ScrollPane;
import javafx.scene.image.Image;
import javafx.scene.layout.AnchorPane;
import javafx.stage.Stage;
import manutencaoAluno.controller.view.AlteraAlunoFormularioControlador;

public class Main extends Application {

    private static Stage palcoPrincipal;
    private static AnchorPane formularioLayout;
    private static ScrollPane formularioLayout2;

    @Override
    public void start(Stage palcoPrincipal) {
        Main.palcoPrincipal = palcoPrincipal;
        palcoPrincipal.setTitle("Educatio");
        Main.palcoPrincipal.getIcons().add(new Image("file:imagens/Educatio.png"));
        mostraFormularioInsercao();
      // mostraPesquisaAlteracao();
       //mostraDeletaAluno();
    }

    public static void mostraFormularioInsercao() {

        try {

            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(Main.class.getResource("view/FormularioInsercaoDeAluno.fxml"));
            formularioLayout2 = (ScrollPane) carregadorFXML.load();

            Scene cena = new Scene(formularioLayout2);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

        } catch (IOException ex) {
        }
    }

    public static void mostraPesquisaAlteracao() {
        try {

            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(Main.class.getResource("view/AlteraAlunoPesquisa.fxml"));
            formularioLayout = (AnchorPane) carregadorFXML.load();

            Scene cena = new Scene(formularioLayout);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

        } catch (IOException ex) {
        }
    }

    public static void mostraDeletaAluno() {
        try {

            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(Main.class.getResource("view/DeletaAluno.fxml"));
            formularioLayout = (AnchorPane) carregadorFXML.load();

            Scene cena = new Scene(formularioLayout);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

        } catch (IOException ex) {
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
        }
    }
    
    public Stage getPalcoPrincipal(){
        return palcoPrincipal;
    } 

    public static void main(String[] args) {
        launch(args);
    }

}
