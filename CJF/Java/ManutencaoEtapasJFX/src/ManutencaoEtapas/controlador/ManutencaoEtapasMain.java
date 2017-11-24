package ManutencaoEtapas.controlador;

import BD.ManutencaoEtapasBD;
import ManutencaoEtapas.controlador.visao.AdicionarTelaControlador;
import ManutencaoEtapas.controlador.visao.LayoutMenuControlador;
import ManutencaoEtapas.controlador.modelo.DadosEtapas;
import ManutencaoEtapas.controlador.visao.AlterarTelaControlador;
import ManutencaoEtapas.controlador.visao.ExcluirTelaControlador;
import java.io.IOException;

import javafx.application.Application;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;

public class ManutencaoEtapasMain extends Application {

    private Stage primaryStage;
    private BorderPane rootLayout;
    
    @Override
    public void start(Stage primaryStage) {
        this.primaryStage = primaryStage;
        this.primaryStage.setTitle("Manutenção de Etapas");

        initBarraMenu();

        showLayoutMenu();
        
    }

    /**
     * Inicializa o root layout (layout base).
     */
    public void initBarraMenu() {
        try {
            // Carrega o root layout do arquivo fxml.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoEtapasMain.class.getResource("visao/BarraMenu.fxml"));
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
    public void showLayoutMenu() {
        try {
            // Carrega o person overview.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoEtapasMain.class.getResource("visao/LayoutMenu.fxml"));
            AnchorPane LayoutMenu = (AnchorPane) loader.load();

            // Define o person overview dentro do root layout.
            rootLayout.setCenter(LayoutMenu);
            
            // Dá ao controlador acesso à the main app.
            LayoutMenuControlador controlador = loader.getController();
            controlador.setManutencaoEtapasMain(this);
            
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    
    public void showAdicionarTela() {
        try {
            // Carrega o person overview.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoEtapasMain.class.getResource("visao/AdicionarTela.fxml"));
            AnchorPane AdicionarTela = (AnchorPane) loader.load();

            // Define o person overview dentro do root layout.
            rootLayout.setCenter(AdicionarTela);
            
            AdicionarTelaControlador controlador = loader.getController();
            controlador.setDadosEtapas(new DadosEtapas());
            controlador.setManutencao(new ManutencaoEtapasBD());
            controlador.setManutencaoEtapasMain(this);
            
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    
    public void showAlterarTela() {
        try {
            // Carrega o person overview.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoEtapasMain.class.getResource("visao/AlterarTela.fxml"));
            AnchorPane AlterarTela = (AnchorPane) loader.load();

            // Define o person overview dentro do root layout.
            rootLayout.setCenter(AlterarTela);
            
            AlterarTelaControlador controlador = loader.getController();
            controlador.setDadosEtapas(new DadosEtapas());
            controlador.setManutencao(new ManutencaoEtapasBD());
            controlador.setManutencaoEtapasMain(this);
            
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    
    public void showExcluirTela() {
        try {
            // Carrega o person overview.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoEtapasMain.class.getResource("visao/ExcluirTela.fxml"));
            AnchorPane ExcluirTela = (AnchorPane) loader.load();

            // Define o person overview dentro do root layout.
            rootLayout.setCenter(ExcluirTela);
            
            ExcluirTelaControlador controlador = loader.getController();
            controlador.setDadosEtapas(new DadosEtapas());
            controlador.setManutencao(new ManutencaoEtapasBD());
            controlador.setManutencaoEtapasMain(this);
            
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
    
    /*public Stage getPrimaryStage() {
        return manutencaoEtapasMain.PalcoPrincipal();
    }*/

    public static void main(String[] args) {
        launch(args);
        
    }
}