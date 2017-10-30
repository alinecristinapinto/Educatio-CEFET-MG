package ch.makery.address;

import java.io.IOException;

import ch.makery.address.model.Disciplina;
import ch.makery.address.view.DisciplinaEditDialogController;
import ch.makery.address.view.DisciplinaOverviewController;
import javafx.application.Application;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Modality;
import javafx.stage.Stage;

public class MainApp extends Application {

    private Stage primaryStage;
    private BorderPane rootLayout;

    private ObservableList<Disciplina> disciplinaData = FXCollections.observableArrayList();

    public MainApp() {
    }

    public ObservableList<Disciplina> getDisciplinaData() {
        return disciplinaData;
    }

    @Override
    public void start(Stage primaryStage) {
        this.primaryStage = primaryStage;
        this.primaryStage.setTitle("BLT-Java-Disciplinas");

        initRootLayout();

        showDisciplinaOverview();
    }

	/**
     * Inicializa o root layout (layout base).
     */
    public void initRootLayout() {
        try {
            // Carrega o root layout do arquivo fxml.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(MainApp.class.getResource("view/RootLayout.fxml"));
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
     * Mostra o person overview dentro do root layout.
     */
    public void showDisciplinaOverview() {
        try {
            // Carrega a disciplina overview.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(MainApp.class.getResource("view/DisciplinaOverview.fxml"));
            AnchorPane disciplinaOverview = (AnchorPane) loader.load();

            // Define a person overview no centro do root layout.
            rootLayout.setCenter(disciplinaOverview);

            // Dá ao controlador acesso à the main app.
            DisciplinaOverviewController controller = loader.getController();
            controller.setMainApp(this);

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

    /**
     * Abre uma janela para editar detalhes para a pessoa especificada. Se o usuário clicar
     * OK, as mudanças são salvasno objeto pessoa fornecido e retorna true.
     *
     * @param person O objeto pessoa a ser editado
     * @return true Se o usuário clicou OK,  caso contrário false.
     */
    /**
     * Abre uma janela para editar detalhes para a pessoa especificada. Se o usuário clicar
     * OK, as mudanças são salvasno objeto pessoa fornecido e retorna true.
     *
     * @param person O objeto pessoa a ser editado
     * @return true Se o usuário clicou OK,  caso contrário false.
     */
    public boolean showDisciplinaEditDialog(Disciplina disciplina) {
        try {
            // Carrega o arquivo fxml e cria um novo stage para a janela popup.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(MainApp.class.getResource("view/DisciplinaEditDialog.fxml"));
            AnchorPane page = (AnchorPane) loader.load();

            // Cria o palco dialogStage.
            Stage dialogStage = new Stage();
            dialogStage.setTitle("Editar Disciplina");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.initOwner(primaryStage);
            Scene scene = new Scene(page);
            dialogStage.setScene(scene);

            // Define a pessoa no controller.
            DisciplinaEditDialogController controller = loader.getController();
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

}