package manutencaoDiario.controller;

import java.io.IOException;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.ScrollPane;
import javafx.stage.Stage;

public class ManutencaoDiario {
    private Stage palcoPrincipal;
    private ScrollPane diarioAlunoLayout;
    //private mainApp mainApp;
    
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

    /*public mainApp getMainApp() {
        return mainApp;
    }*/

    public Stage getPalcoPrincipal() {
        return palcoPrincipal;
    }
    
}
