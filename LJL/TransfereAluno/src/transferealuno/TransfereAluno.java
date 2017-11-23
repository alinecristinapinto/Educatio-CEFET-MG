/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package transferealuno;

import tpfinal.fx.LayoutTransferAlunoController;
import java.io.IOException;
import javafx.application.Application;
import static javafx.application.Application.launch;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;

/**
 *
 * @author Aluno
 */
public class TransfereAluno extends Application {
    private Stage palcoPrincipal;
    private AnchorPane telaInicial;
    private BorderPane telaBase;
    
    @Override
    public void start(Stage primaryStage) throws Exception {
        this.palcoPrincipal = primaryStage;
        
        Parent root = FXMLLoader.load(getClass().getResource("LayoutTransferirAluno.fxml"));
        
        invocaLayoutTransferirAluno();
    }
    
    Stage dialogStage = new Stage();
    
    public void invocaLayoutTransferirAluno(){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(TransfereAluno.class.getResource("TelaBase.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(TransfereAluno.class.getResource("LayoutTransferirAluno.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            LayoutTransferAlunoController controller = auxiliar.getController();
            controller.setManutencaoDepto(this);
    }
    catch (IOException e) {
            e.printStackTrace();
    }
    }

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        launch(args);
    }
    
}
