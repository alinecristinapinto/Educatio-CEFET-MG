/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatoriodeatraso.model;

import java.io.IOException;
import java.sql.SQLException;
import java.text.ParseException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.application.Application;
import static javafx.application.Application.launch;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;
import relatoriodeatraso.model.controller.RelatorioController;
import relatoriodeatraso.model.controller.TelaInicialController;

/**
 *
 * @author Aluno
 */
public class RelatorioDeAtraso extends Application {
    
    private Stage stage;
    private BorderPane borda;

    @Override
    public void start(Stage stage) {

        this.stage = stage;
        try {
            abreBaseTelaInicial();
            abreTelaInicial();
        } catch (IOException ex) {
            Logger.getLogger(RelatorioDeAtraso.class.getName()).log(Level.SEVERE, null, ex);
        }

    }

    public void abreBaseTelaInicial() throws IOException {
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(RelatorioDeAtraso.class.getResource("view/Base.fxml"));
        borda = (BorderPane) loader.load();
        stage.setScene(new Scene(borda));
        stage.show();
    }

    public void abreTelaInicial() throws IOException {
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(RelatorioDeAtraso.class.getResource("view/TelaInicial.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        TelaInicialController controller = loader.getController();
        controller.setMain(this);
    }

    public void abreTelaRelatorio(String livro) throws IOException, SQLException, ParseException {

        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(RelatorioDeAtraso.class.getResource("view/Relatorio.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        RelatorioController controller = loader.getController();
        controller.setAluno(livro);

        controller.setMain(this);
        controller.mostrarRelatorio();

    }

    public static void main(String[] args) {
        launch(args);
    }
    
}
