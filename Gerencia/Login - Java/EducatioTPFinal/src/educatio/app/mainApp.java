/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package educatio.app;

import educatio.app.model.Login.*;
import educatio.app.view.Alunos.*;
import educatio.app.view.Login.*;
import educatio.app.view.Professores.*;

import java.io.IOException;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;

/**
 *
 * @author 7
 */
public class mainApp extends Application {

    private Stage palcoPrincipal;
    private AnchorPane loginLayout;
    private AnchorPane telaInicial;
    private BorderPane telaBase;
    private String loginUsuario;
    private Usuario usuarioAtual;

    public Usuario getUsuarioAtual() {
        return usuarioAtual;
    }

    public void setUsuarioAtual(Usuario usuarioAtual) {
        this.usuarioAtual = usuarioAtual;
    }

    @Override
    public void start(Stage palcoPrincipal) {
        usuarioAtual = null;
        this.palcoPrincipal = palcoPrincipal;
        palcoPrincipal.setTitle("Educatio");

        mostraLogin();

    }

    public void mostraLogin() {
        try {
            usuarioAtual = null;
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(mainApp.class.getResource("view/Login/GerentesTelaBaseLogin.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(mainApp.class.getResource("view/Login/GerentesTelaDeLogin.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            GerentesTelaDeLoginController controller = auxiliar.getController();
            controller.setMainApp(this);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void mostraPagInicialSistemaAcademico(Usuario usuario) {
        try {

            FXMLLoader carregadorFXML = new FXMLLoader();
            usuarioAtual = usuario;

            if (usuarioAtual instanceof Aluno) {

                carregadorFXML.setLocation(mainApp.class.getResource("view/GerentesTelaBase.fxml"));
                telaBase = (BorderPane) carregadorFXML.load();

                FXMLLoader auxiliar = new FXMLLoader();
                auxiliar.setLocation(mainApp.class.getResource("view/Alunos/GerentesTelaInicialAlunos.fxml"));
                telaInicial = (AnchorPane) auxiliar.load();
                

                telaBase.setTop(telaInicial);
                Scene cena = new Scene(telaBase,1280,720);
                palcoPrincipal.setScene(cena);
                palcoPrincipal.show();

                GerentesTelaInicialAlunoController controller = auxiliar.getController();
                controller.setMainApp(this);
                controller.mudaUsuario();

            } else if (usuarioAtual instanceof Professor) {

                carregadorFXML.setLocation(mainApp.class.getResource("view/GerentesTelaBase.fxml"));
                telaBase = (BorderPane) carregadorFXML.load();

                FXMLLoader auxiliar = new FXMLLoader();
                auxiliar.setLocation(mainApp.class.getResource("view/Professores/GerentesTelaInicialProfessores.fxml"));
                telaInicial = (AnchorPane) auxiliar.load();

                telaBase.setTop(telaInicial);
                Scene cena = new Scene(telaBase,1280,720);
                palcoPrincipal.setScene(cena);
                palcoPrincipal.show();

                GerentesTelaInicialProfessoresController controller = auxiliar.getController();
                controller.setMainApp(this);
                controller.mudaUsuario();
            } else if (usuarioAtual instanceof Coordenador) {

              /*  carregadorFXML.setLocation(mainApp.class.getResource("view/TelaInicialCoordenadorGeral.fxml"));
                telaInicial = (AnchorPane) carregadorFXML.load();
                Scene cena = new Scene(telaBase,1280,720);
                palcoPrincipal.setScene(cena);
                palcoPrincipal.show();
                GerentesTelaDeLoginController controller = carregadorFXML.getController();
                controller.setMainApp(this);*/
                System.out.println(usuarioAtual);
            }

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void mostraPagInicialBiblioteca(Usuario usuario) {
        try {

            FXMLLoader carregadorFXML = new FXMLLoader();
            usuarioAtual = usuario;

            if (usuarioAtual instanceof Aluno) {

                /*carregadorFXML.setLocation(mainApp.class.getResource("view/TelaInicialAlunos.fxml"));
                telaInicial = (AnchorPane) carregadorFXML.load();
                Scene cena = new Scene(telaInicial);
                palcoPrincipal.setScene(cena);
                palcoPrincipal.show();
                GerentesTelaDeLoginController controller = carregadorFXML.getController();
                controller.setMainApp(this);*/
                System.out.println("Deu certo bb!!!!!!!!!!!!!!");

            } else if (usuarioAtual instanceof Professor) {
                carregadorFXML.setLocation(mainApp.class.getResource("view/TelaInicialProfessores.fxml"));
                telaInicial = (AnchorPane) carregadorFXML.load();
               Scene cena = new Scene(telaBase,1280,720);
                palcoPrincipal.setScene(cena);
                palcoPrincipal.show();
                GerentesTelaInicialProfessoresController controller = carregadorFXML.getController();
                controller.setMainApp(this);
            } else if (usuarioAtual instanceof Bibliotecario) {

                /*carregadorFXML.setLocation(mainApp.class.getResource("view/TelaInicialCoordenadorGeral.fxml"));
                telaInicial = (AnchorPane) carregadorFXML.load();
                Scene cena = new Scene(telaBase,1280,720);
                palcoPrincipal.setScene(cena);
                palcoPrincipal.show();
                GerentesTelaDeLoginController controller = carregadorFXML.getController();
                controller.setMainApp(this);*/
                
                System.out.println(usuarioAtual);
            }

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void mostraPagSelecao(Usuario usuario) {
        try {
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(mainApp.class.getResource("view/Login/GerentesTelaDeSelecao.fxml"));
            loginLayout = (AnchorPane) carregadorFXML.load();

            Scene cena = new Scene(loginLayout,1280,720);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            GerentesTelaDeSelecaoController controller = carregadorFXML.getController();
            controller.setMainApp(this);
            controller.setUsuario(usuario);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void mostraPagCadastro() {
        try {
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(mainApp.class.getResource("view/Login/GerentesTelaBaseLogin.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(mainApp.class.getResource("view/Login/GerentesTelaCadastro.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase,1280,720);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            GerentesTelaCadastroController controller = auxiliar.getController();
            controller.setMainApp(this);
            

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    
  /*  public void mostraSegundaPagCadastro(Usuario usuario) {
        try {
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(mainApp.class.getResource("view/Login/GerentesTelaBase.fxml"));
            telaBase = (BorderPane) carregadorFXML.load();

            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(mainApp.class.getResource("view/Login/GerentesSegundaTelaCadastro.fxml"));
            telaInicial = (AnchorPane) auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            GerentesTelaInicialAlunoController controller = auxiliar.getController();
            controller.setMainApp(this);
            controller.mudaUsuario();

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
*/
    public static void main(String[] args) {
        launch(args);
    }

}
