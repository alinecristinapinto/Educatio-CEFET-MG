package blt.java.emprestimo;

import java.io.IOException;

import blt.java.emprestimo.model.Emprestimo;
import blt.java.emprestimo.view.EmprestimoCaixaEditarControlador;
import blt.java.emprestimo.view.EmprestimoPesquisarControlador;
import blt.java.emprestimo.view.EmprestimoVisaoGeralControlador;
import blt.java.emprestimo.view.EmprestimoVisualizarControlador;
import javafx.application.Application;

import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Modality;
import javafx.stage.Stage;

public class ManutencaoEmprestimos extends Application {

    private Stage primaryStage;
    private BorderPane rootLayout;


    public ManutencaoEmprestimos() {

    }

    @Override
    public void start(Stage primaryStage) {
        this.primaryStage = primaryStage;
        this.primaryStage.setTitle("BLT-Java-Disciplinas");

        initRootLayout();
        mostrarEmprestimoVisaoGeral();

    }

	/**
     * Inicializa o root layout (layout base).
     */
    public void initRootLayout() {
        try {
            // Carrega o root layout do arquivo fxml.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoEmprestimos.class.getResource("view/RootLayout.fxml"));
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
     * Mostra o emprestimo visao geral dentro do root layout.
     */
    public void mostrarEmprestimoVisaoGeral() {
        try {
            // Carrega o empréstimo visão geral.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoEmprestimos.class.getResource("view/EmprestimoVisaoGeral.fxml"));
            AnchorPane emprestimoVisaoGeral = (AnchorPane) loader.load();

            // Define a emprestimo visão geral no centro do root layout.
            rootLayout.setCenter(emprestimoVisaoGeral);

            // Dá ao controlador acesso à aplicação principal.
            EmprestimoVisaoGeralControlador controller = loader.getController();
            controller.setMainApp(this);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    
    public boolean mostrarEmprestimoPesquisar(Emprestimo emprestimo) {
        try {
            // Carrega o arquivo fxml e cria um novo stage para a janela popup.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoEmprestimos.class.getResource("view/EmprestimoPesquisar.fxml"));
            AnchorPane page = (AnchorPane) loader.load();

            // Cria o palco dialogStage.
            Stage dialogStage = new Stage();
            dialogStage.setTitle("Finalizar Empréstimo");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.initOwner(primaryStage);
            Scene scene = new Scene(page);
            dialogStage.setScene(scene);

            // Define a classe no controle.
            EmprestimoPesquisarControlador controller = loader.getController();
            controller.setDialogStage(dialogStage);
            controller.setDisciplina(emprestimo);

            // Mostra a janela e espera até o usuário fechar.
            dialogStage.showAndWait();
            
            return controller.isOkClicked();
        } catch (IOException e) {
            e.printStackTrace();
            return false;
        }
    }

    /**
     * Abre uma janela para editar detalhes para o empréstimo especificado. Se o usuário clicar
     * OK, as mudanças são salvas no objeto empréstimo fornecido e retorna true.
     *
     * @param emprestimo O objeto emprestimo a ser editado
     * @return true Se o usuário clicou OK, caso contrário false.
     */
    public boolean mostrarEmprestimoCaixaEditar(Emprestimo emprestimo) {
        try {
            // Carrega o arquivo fxml e cria um novo stage para a janela popup.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoEmprestimos.class.getResource("view/EmprestimoCaixaEditar.fxml"));
            AnchorPane page = (AnchorPane) loader.load();

            // Cria o palco dialogStage.
            Stage dialogStage = new Stage();
            dialogStage.setTitle("Criar Emprestimo");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.initOwner(primaryStage);
            Scene scene = new Scene(page);
            dialogStage.setScene(scene);

            // Define a classe no controlador.
            EmprestimoCaixaEditarControlador controller = loader.getController();
            controller.setDialogStage(dialogStage);
            controller.setEmprestimo(emprestimo);

            // Mostra a janela e espera até o usuário fechar.
            dialogStage.showAndWait();

            return controller.isOkClicked();
        } catch (IOException e) {
            e.printStackTrace();
            return false;
        }
    }

    //Mostra a tabela de resultados
    public void mostrarEmprestimoVisualizar() {
        try {
            // Carrega o fxml.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoEmprestimos.class.getResource("view/EmprestimoVisualizar.fxml"));
            AnchorPane page = (AnchorPane) loader.load();

            // Cria o palco dialogStage.
            Stage dialogStage = new Stage();
            dialogStage.setTitle("Visualizar Emprestimos");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.initOwner(primaryStage);
            Scene scene = new Scene(page);
            dialogStage.setScene(scene);

            // Dá ao controlador acesso à aplicação principal.
            EmprestimoVisualizarControlador controller = loader.getController();
            controller.setDialogStage(dialogStage);


            // Mostra a janela e espera até o usuário fechar.
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