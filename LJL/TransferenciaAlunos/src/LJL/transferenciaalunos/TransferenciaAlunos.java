/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package LJL.transferenciaalunos;

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
public class TransferenciaAlunos extends Application {

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
            carregadorFXML.setLocation(TransferenciaAlunos.class.getResource("TelaBase.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(TransferenciaAlunos.class.getResource("LayoutBase.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            LayoutBaseController controller = auxiliar.getController();
            controller.setTransferenciaAlunos(this);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void invocaVerificaCampi() throws SQLException {
        try {
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(TransferenciaAlunos.class.getResource("TelaBase.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(TransferenciaAlunos.class.getResource("VerificaCampi.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            VerificaCampiController controller = auxiliar.getController();
            controller.setTransferenciaAlunos(this);
            controller.VerificaCampiPrep();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void invocaVerificaDepto(int idCampi) throws SQLException {
        try {
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(TransferenciaAlunos.class.getResource("TelaBase.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(TransferenciaAlunos.class.getResource("VerificaDepto.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            VerificaDeptoController controller = auxiliar.getController();
            controller.setTransferenciaAlunos(this);
            controller.setIdCampi(idCampi);
            controller.VerificaDeptoPrep();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    
    public void invocaVerificaCurso(int idDepto) throws SQLException {
        try {
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(TransferenciaAlunos.class.getResource("TelaBase.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(TransferenciaAlunos.class.getResource("VerificaCurso.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            VerificaCursoController controller = auxiliar.getController();
            controller.setTransferenciaAlunos(this);
            controller.setIdDepto(idDepto);
            controller.VerificaCursoPrep();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void invocaVerificaTurma(int idCurso) throws SQLException {
        try {
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(TransferenciaAlunos.class.getResource("TelaBase.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(TransferenciaAlunos.class.getResource("VerificaTurma.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            VerificaTurmaController controller = auxiliar.getController();
            controller.setTransferenciaAlunos(this);
            controller.setIdCurso(idCurso);
            controller.VerificaTurmaPrep();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void invocaLayoutTransferirAluno(int idTurma) {
        try {
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(TransferenciaAlunos.class.getResource("TelaBase.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(TransferenciaAlunos.class.getResource("LayoutTransferirAluno.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            LayoutTransferAlunoController controller = auxiliar.getController();
            controller.setTransferenciaAlunos(this);
            controller.setIdTurma(idTurma);
            controller.LayoutTransferirAlunoPrep();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public static void main(String[] args) {
        launch(args);
    }

}
