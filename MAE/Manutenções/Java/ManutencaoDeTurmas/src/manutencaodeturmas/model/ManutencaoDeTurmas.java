
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaodeturmas.model;

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
import manutencaodeturmas.model.controller.AlterarTurmasController;
import manutencaodeturmas.model.controller.ApagarTurmasController;
import manutencaodeturmas.model.controller.CriarTurmasController;
import manutencaodeturmas.model.controller.TelaInicialController;

/**
 *
 * @author mathe
 */
public class ManutencaoDeTurmas extends Application {

    private Stage stage;
    private BorderPane borda;

    @Override
    public void start(Stage stage) {

        this.stage = stage;
        try {
            abreBaseTelaInicial();
            abreTelaInicial();
        } catch (IOException ex) {
            Logger.getLogger(ManutencaoDeTurmas.class.getName()).log(Level.SEVERE, null, ex);
        }

    }

    public void abreCriaTurma() throws IOException {
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeTurmas.class.getResource("view/CriarTurmas.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        CriarTurmasController controller = loader.getController();
        controller.setMain(this);
    }

    public void abreAlteraTurma() throws IOException {
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeTurmas.class.getResource("view/AlterarTurmas.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        AlterarTurmasController controller = loader.getController();
        controller.setMain(this);
    }

    public void abreApagaTurma() throws IOException {
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeTurmas.class.getResource("view/ApagarTurmas.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        ApagarTurmasController controller = loader.getController();
        controller.setMain(this);
    }

    public void abreBaseTelaInicial() throws IOException {
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeTurmas.class.getResource("view/Borda.fxml"));
        borda = (BorderPane) loader.load();
        stage.setScene(new Scene(borda));
        stage.show();
    }

    public void abreTelaInicial() throws IOException {
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeTurmas.class.getResource("view/TelaInicial.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        TelaInicialController controller = loader.getController();
        controller.setMain(this);
    }

    public static void main(String[] args) {
        launch(args);
    }

}
