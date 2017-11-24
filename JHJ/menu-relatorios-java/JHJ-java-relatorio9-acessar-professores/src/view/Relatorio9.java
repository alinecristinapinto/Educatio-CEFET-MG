package view;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.IOException;

import controlador.Relatorio9BaseControlador;
import controlador.Relatorio9VisualizarControlador;
import javafx.application.Application;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.StackPane;
import javafx.stage.Modality;
import javafx.stage.Stage;
import model.Relatorio9Professor;



public class Relatorio9 extends Application {
    private Stage palcoPrincipal;
    private BorderPane layoutRaiz;
    public Relatorio9(){

    }
    @Override
    public void start(Stage primCena) {
        this.palcoPrincipal = primCena;
        this.palcoPrincipal.setTitle("Relatorio9-Java");

        invocaBase();

    }

    public void invocaBase(){
        try{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(Relatorio9.class.getResource("LayoutRaiz.fxml"));
        layoutRaiz = (BorderPane)loader.load();

        FXMLLoader loader2 = new FXMLLoader();
        loader2.setLocation(Relatorio9.class.getResource("Relatorio9Base.fxml"));
        AnchorPane page = (AnchorPane)loader2.load();


        layoutRaiz.setCenter(page);
        Scene cena = new Scene(layoutRaiz);
        palcoPrincipal.setScene(cena);
        palcoPrincipal.show();


        Relatorio9BaseControlador controlador = (Relatorio9BaseControlador)loader2.getController();
        controlador.setRelatorio9(this);
     }
        catch (IOException e) {
         e.printStackTrace();
        }
    }

    public static void main(String[] args) {
        launch(args);
    }

    public boolean invocaVisualizar(ObservableList<Relatorio9Professor> professores) {
        try {
            // Carrega o arquivo fxml e cria um novo stage para a janela popup.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(Relatorio9.class.getResource("Relatorio9Visualizar.fxml"));
            AnchorPane pagina = (AnchorPane) loader.load();

            FXMLLoader loader2 = new FXMLLoader();
            loader2.setLocation(Relatorio9.class.getResource("LayoutRaiz.fxml"));
            layoutRaiz = (BorderPane)loader2.load();

            layoutRaiz.setCenter(pagina);
            // Cria o palco dialgStage.
             Relatorio9VisualizarControlador controlador = (Relatorio9VisualizarControlador)loader.getController();
             controlador.setRelatorio9(this);
             Scene cena = new Scene(layoutRaiz);
             palcoPrincipal.setScene(cena);


            // Define a pessoa no controller.
            Relatorio9VisualizarControlador controller = loader.getController();
            controller.setRelatorio9(this);
            controller.setLista(professores);

            // Mostra a janela e espera ate o usuario fechar.
            //palcoPrincipal.showAndWait();

            return controller.seOkClic();
        } catch (IOException e) {
            e.printStackTrace();
            return false;
        }
    }


}
