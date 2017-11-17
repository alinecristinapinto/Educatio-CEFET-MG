/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaoDiario.controller;

import java.io.IOException;
import javafx.application.Application;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.ScrollPane;
import javafx.scene.image.Image;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;

/**
 *
 * @author Pedro H
 */
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
