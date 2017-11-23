/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tpfinal.fx;

import java.io.IOException;
import java.sql.SQLException;
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
public class ManutencaoDepto extends Application {

    private Stage palcoPrincipal;
    private AnchorPane telaInicial;
    private BorderPane telaBase;

    @Override
    public void start(Stage primaryStage) throws Exception {
        this.palcoPrincipal = primaryStage;

        Parent root = FXMLLoader.load(getClass().getResource("LayoutBase.fxml"));

        invocaLayoutBase();
    }

    Stage dialogStage = new Stage();

    public void invocaLayoutBase() {
        try {
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDepto.class.getResource("TelaBase.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(ManutencaoDepto.class.getResource("LayoutBase.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            LayoutBaseController controller = auxiliar.getController();
            controller.setManutencaoDepto(this);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void invocaLayoutCriar() throws IOException {
        try {
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDepto.class.getResource("TelaBase.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(ManutencaoDepto.class.getResource("LayoutCriar.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            LayoutCriarController controller = auxiliar.getController();
            controller.setManutencaoDepto(this);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void invocaLayoutAlterar(int campi) throws IOException, SQLException {
        try {
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDepto.class.getResource("TelaBase.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(ManutencaoDepto.class.getResource("LayoutAlterar.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            LayoutAlterarController controller = auxiliar.getController();
            controller.setManutencaoDepto(this);
            controller.setCampiB(campi);
            controller.setData();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void invocaLayoutExcluir(int campi) throws IOException, SQLException {
        try {
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDepto.class.getResource("TelaBase.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(ManutencaoDepto.class.getResource("LayoutExcluir.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            LayoutExcluirController controller = auxiliar.getController();
            controller.setManutencaoDepto(this);
            controller.setCampiB(campi);
            controller.setData();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void invocaVerificaCampi(int sw) throws SQLException {
        try {
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoDepto.class.getResource("TelaBase.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(ManutencaoDepto.class.getResource("VerificaCampi.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            VerificaCampiController controller = auxiliar.getController();
            controller.setManutencaoDepto(this);
            controller.setSw(sw);
            controller.VerificaCampiPrep();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }


    public static void main(String[] args) {
        launch(args);
    }

}
