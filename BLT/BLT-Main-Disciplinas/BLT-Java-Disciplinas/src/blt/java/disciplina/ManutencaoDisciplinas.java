package blt.java.disciplina;

import java.io.IOException;

import blt.java.disciplina.model.Disciplina;
import blt.java.disciplina.view.DisciplinaCaixaEditarControlador;
import blt.java.disciplina.view.DisciplinaPesquisarControlador;
import blt.java.disciplina.view.DisciplinaVisaoGeralControlador;
import blt.java.disciplina.view.DisciplinaVisualizarControlador;
import javafx.application.Application;

import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Modality;
import javafx.stage.Stage;

public class ManutencaoDisciplinas extends Application {

    private Stage primaryStage;
    private BorderPane rootLayout;
    
    public ManutencaoDisciplinas() {

    }

    @Override
    public void start(Stage primaryStage) {
        this.primaryStage = primaryStage;
        this.primaryStage.setTitle("BLT-Java-Disciplinas");

        initRootLayout();
        mostrarDisciplinaVisaoGeral();

    }

	/**
     * Inicializa o root layout (layout base).
     */
    public void initRootLayout() {
        try {
            // Carrega o root layout do arquivo fxml.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoDisciplinas.class.getResource("view/RootLayout.fxml"));
            rootLayout = (BorderPane) loader.load();

            // Mostra a scene (cena) contendo o root layout.
            Scene scene = new Scene(rootLayout);
            primaryStage.setScene(scene);
            primaryStage.show();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }



    /**
     * Mostra o disciplina visão geral dentro do root layout.
     */
    public void mostrarDisciplinaVisaoGeral() {
        try {
            // Carrega a disciplina visão geral.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoDisciplinas.class.getResource("view/DisciplinaVisaoGeral.fxml"));
            AnchorPane disciplinaVisaoGeral = (AnchorPane) loader.load();

            // Define a disciplina visão geral no centro do root layout.
            rootLayout.setCenter(disciplinaVisaoGeral);

            // Dá ao controlador acesso à aplicação principal.
            DisciplinaVisaoGeralControlador controller = loader.getController();
            controller.setMainApp(this);
            
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    
    public boolean mostrarDisciplinaPesquisar(Disciplina disciplina) {
        try {
            // Carrega o arquivo fxml e cria um novo stage para a janela popup.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoDisciplinas.class.getResource("view/DisciplinaPesquisar.fxml"));
            AnchorPane page = (AnchorPane) loader.load();

            // Cria o palco dialogStage.
            Stage dialogStage = new Stage();
            dialogStage.setTitle("Pesquisar Disciplina");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.initOwner(primaryStage);
            Scene scene = new Scene(page);
            dialogStage.setScene(scene);

            // Define a classe no controle.
            DisciplinaPesquisarControlador controller = loader.getController();
            controller.setDialogStage(dialogStage);
            controller.setDisciplina(disciplina);

            // Mostra a janela e espera até o usuário fechar.
            dialogStage.showAndWait();
            
            return controller.isOkClicked();
        } catch (IOException e) {
            e.printStackTrace();
            return false;
        }
    }

    /**
     * Abre uma janela para editar detalhes para a disciplina especificada. Se o usuário clicar
     * OK, as mudanças são salvas no objeto disciplina fornecido e retorna true.
     */
    public boolean mostrarDisciplinaCaixaEditar(Disciplina disciplina) {
        try {
            // Carrega o arquivo fxml e cria um novo stage para a janela popup.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoDisciplinas.class.getResource("view/DisciplinaCaixaEditar.fxml"));
            AnchorPane page = (AnchorPane) loader.load();

            // Cria o palco dialogStage.
            Stage dialogStage = new Stage();
            dialogStage.setTitle("Editar Disciplina");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.initOwner(primaryStage);
            Scene scene = new Scene(page);
            dialogStage.setScene(scene);

            DisciplinaCaixaEditarControlador controller = loader.getController();
            controller.setDialogStage(dialogStage);
            controller.setDisciplina(disciplina);
            
            dialogStage.showAndWait();

            return controller.isOkClicked();
        } catch (IOException e) {
            e.printStackTrace();
            return false;
        }
    }

    //Mostra a tabela de resultados
    public void mostrarDisciplinasVisualizar() {
        try {
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoDisciplinas.class.getResource("view/DisciplinaVisualizar.fxml"));
            AnchorPane page = (AnchorPane) loader.load();

            Stage dialogStage = new Stage();
            dialogStage.setTitle("Visualizar Disciplinas");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.initOwner(primaryStage);
            Scene scene = new Scene(page);
            dialogStage.setScene(scene);

            DisciplinaVisualizarControlador controller = loader.getController();
            controller.setDialogStage(dialogStage);
            
            dialogStage.showAndWait();

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    
    /**
     * Retorna o palco principal.
     * @return
     */
    public Stage getPrimaryStage() {
        return primaryStage;
    }

    public static void main(String[] args) {
        launch(args);
    }

}