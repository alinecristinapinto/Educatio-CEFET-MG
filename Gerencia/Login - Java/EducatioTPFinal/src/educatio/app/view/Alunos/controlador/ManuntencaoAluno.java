/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package educatio.app.view.Alunos.controlador;

import educatio.app.mainApp;
import java.io.IOException;
import static javafx.application.Application.launch;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.image.Image;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;

/**
 *
 * @author 7
 */
public class ManuntencaoAluno {
    private Stage palcoPrincipal;
    private AnchorPane formularioLayout;
    private BorderPane BaseDoForm;

    private mainApp mainApp;

    public void setMainApp(mainApp mainApp) {
        this.mainApp = mainApp;
    }

   
    
    public void mostraFormulario() {
       
        try {

            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoAluno.class.getResource("visao/AlteraAluno.fxml"));
            formularioLayout = (AnchorPane) carregadorFXML.load();
            
            mainApp.setTelaBaseCentro(formularioLayout);
        } catch (IOException ex) {

            ex.printStackTrace();
        }

    }
 
}

