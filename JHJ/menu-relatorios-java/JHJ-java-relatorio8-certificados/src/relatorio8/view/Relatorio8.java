package relatorio8.view;



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.IOException;

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
import relatorio8.model.*;
import relatorio8.controlador.*;
import relatorio8.model.*;



public class Relatorio8 extends Application {
    private Stage palcoPrincipal;
    private BorderPane layoutRaiz;
    private Relatorio8Aluno aluno;
    public Relatorio8(){

    }
    @Override
    public void start(Stage primCena) {
        this.palcoPrincipal = primCena;
        this.palcoPrincipal.setTitle("Relatorio8-Java");

        invocaBase();

    }

    public void invocaBase(){
        try{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(Relatorio8.class.getResource("LayoutRaiz.fxml"));
        layoutRaiz = (BorderPane)loader.load();

        FXMLLoader loader2 = new FXMLLoader();
        loader2.setLocation(Relatorio8.class.getResource("Relatorio8Base.fxml"));
        AnchorPane page = (AnchorPane)loader2.load();


        layoutRaiz.setCenter(page);
        Scene cena = new Scene(layoutRaiz);
        palcoPrincipal.setScene(cena);
        palcoPrincipal.show();

        Relatorio8BaseControlador controlador = (Relatorio8BaseControlador)loader2.getController();
          controlador.setRelatorio8(this);
     }
        catch (IOException e) {
         e.printStackTrace();
        }
    }

    public static void main(String[] args) {
        launch(args);
    }

    public boolean invocaCertificado(Relatorio8Aluno aluno) {
        try {
            // Carrega o arquivo fxml e cria um novo stage para a janela popup.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(Relatorio8.class.getResource("Certificado.fxml"));
            AnchorPane pagina = (AnchorPane) loader.load();

            FXMLLoader loader2 = new FXMLLoader();
            loader2.setLocation(Relatorio8.class.getResource("LayoutRaiz.fxml"));
            layoutRaiz = (BorderPane)loader2.load();

            layoutRaiz.setCenter(pagina);
            // Cria o palco dialgStage.
             CertificadoControlador controlador = (CertificadoControlador)loader.getController();
             controlador.setRelatorio8(this);
             Scene cena = new Scene(layoutRaiz);
             palcoPrincipal.setScene(cena);


            CertificadoControlador controller = loader.getController();
            controller.setRelatorio8(this);
            controller.setAluno(aluno);

            // Mostra a janela e espera ate o usuario fechar.
            //palcoPrincipal.showAndWait();

            return controller.seOkClic();
        } catch (IOException e) {
            e.printStackTrace();
            return false;
        }
    }


}
