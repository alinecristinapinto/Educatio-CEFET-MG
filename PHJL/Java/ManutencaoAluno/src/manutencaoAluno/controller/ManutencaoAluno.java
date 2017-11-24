package manutencaoAluno.controller;

import java.io.IOException;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.stage.Stage;
import manutencaoAluno.controller.view.AlteraAlunoFormularioControlador;

public class ManutencaoAluno {
    private static Stage palcoPrincipal;
    private static AnchorPane formularioLayout;
    //private mainApp mainApp
            
    public void mostraFormularioInsercao() {

        try {

            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(Main.class.getResource("view/FormularioInsercaoDeAluno.fxml"));
            formularioLayout = (AnchorPane) carregadorFXML.load();

            Scene cena = new Scene(formularioLayout);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

        } catch (IOException ex) {
        }
    }

    public void mostraPesquisaAlteracao() {
        try {

            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(Main.class.getResource("view/AlteraAlunoPesquisa.fxml"));
            formularioLayout = (AnchorPane) carregadorFXML.load();

            Scene cena = new Scene(formularioLayout);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

        } catch (IOException ex) {
        }
    }

    public void mostraDeletaAluno() {
        try {

            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(Main.class.getResource("view/DeletaAluno.fxml"));
            formularioLayout = (AnchorPane) carregadorFXML.load();

            Scene cena = new Scene(formularioLayout);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

        } catch (IOException ex) {
        }
    }

    public static void mostraFormularioAlteracao(String valorCPF) {

        try {

            AlteraAlunoFormularioControlador temp = new AlteraAlunoFormularioControlador();
            temp.defineCPF(valorCPF);

            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(Main.class.getResource("view/AlteraAlunoFormulario.fxml"));

            formularioLayout = (AnchorPane) carregadorFXML.load();

            Scene cena = new Scene(formularioLayout);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

        } catch (IOException ex) {
        }
    }
    
    public Stage getPalcoPrincipal(){
        return palcoPrincipal;
    } 

    /*public void setMainApp(mainApp mainApp) {
        this.mainApp = mainApp;
    }*/
    
    
}
