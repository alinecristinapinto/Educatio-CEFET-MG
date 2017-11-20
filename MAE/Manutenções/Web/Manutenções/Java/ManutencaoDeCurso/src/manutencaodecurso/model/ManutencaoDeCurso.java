/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaodecurso.model;

import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.application.Application;
import static javafx.application.Application.launch;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;
import manutencaodecurso.model.controller.AlterarCursoController;
import manutencaodecurso.model.controller.ApagarCursoController;
import manutencaodecurso.model.controller.CriarCursoController;
import manutencaodecurso.model.controller.TelaInicialController;

/**
 *
 * @author mathe
 */
public class ManutencaoDeCurso extends Application {

    private Stage stage;
    private BorderPane borda;

    @Override
    public void start(Stage stage) {

        this.stage = stage;
        try {
            abreBaseTelaInicial();
            abreTelaInicial();
        } catch (IOException ex) {
            Logger.getLogger(ManutencaoDeCurso.class.getName()).log(Level.SEVERE, null, ex);
        }

    }

    public void abreCriaCurso() throws IOException {
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeCurso.class.getResource("view/CriarCursos.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        CriarCursoController controller = loader.getController();
        controller.setMain(this);
    }

    public void abreAlteraCurso() throws IOException {
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeCurso.class.getResource("view/AlterarCurso.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        AlterarCursoController controller = loader.getController();
        controller.setMain(this);
    }

    public void abreApagaCurso() throws IOException {
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeCurso.class.getResource("view/ApagarCurso.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        ApagarCursoController controller = loader.getController();
        controller.setMain(this);
    }

    public void abreBaseTelaInicial() throws IOException {
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeCurso.class.getResource("view/Borda.fxml"));
        borda = (BorderPane) loader.load();
        stage.setScene(new Scene(borda));
        stage.show();
    }

    public void abreTelaInicial() throws IOException {
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeCurso.class.getResource("view/TelaInicial.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        TelaInicialController controller = loader.getController();
        controller.setMain(this);
    }

    public static void main(String[] args) {
        launch(args);
    }

}
