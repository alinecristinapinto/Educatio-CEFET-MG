package SelecaoNotas.controlador;

import BD.SelecaoNotasBD;
import SelecaoNotas.controlador.modelo.DadosNotas;
import SelecaoNotas.controlador.visao.LayoutInicialControlador;
import SelecaoNotas.controlador.visao.TelaRelatorioControlador;
import java.io.IOException;
import java.sql.SQLException;

import javafx.application.Application;
import static javafx.application.Application.launch;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;

public class SelecaoNotasMain extends Application  {

    private Stage primaryStage;
    private BorderPane rootLayout;
    private DadosNotas dadosNotas;

    @Override
    public void start(Stage primaryStage) {
        this.primaryStage = primaryStage;
        this.primaryStage.setTitle("Relatorio de Notas");

        initBarraMenu();

        showLayoutInicial();
        
        dadosNotas = new DadosNotas();
    }
    
    private ObservableList<DadosNotas> dadosNotasTabela = FXCollections.observableArrayList();
    
    public SelecaoNotasMain(){
        dadosNotasTabela.add(new DadosNotas("", "","","","","","",""));
    }
    
    /**
     * Inicializa o root layout (layout base).
     */
    public void initBarraMenu() {
        try {
            // Carrega o root layout do arquivo fxml.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(SelecaoNotasMain.class.getResource("visao/BarraMenu.fxml"));
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
    public void showLayoutInicial() {
        try {
            // Carrega o person overview.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(SelecaoNotasMain.class.getResource("visao/LayoutInicial.fxml"));
            AnchorPane LayoutInicial = (AnchorPane) loader.load();

            // Define o person overview dentro do root layout.
            rootLayout.setCenter(LayoutInicial);
            
            LayoutInicialControlador controlador = loader.getController();
            controlador.setManutencao(new SelecaoNotasBD());
            controlador.setDadosNotas(new DadosNotas());
            controlador.setSelecaoNotasMain(this);
            
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    
    public void showTelaRelatorio() {
        try {
            // Carrega o person overview.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(SelecaoNotasMain.class.getResource("visao/TelaRelatorio.fxml"));
            AnchorPane TelaRelatorio = (AnchorPane) loader.load();

            // Define o person overview dentro do root layout.
            rootLayout.setCenter(TelaRelatorio);
            
            // Dá ao controlador acesso à the main app.
            TelaRelatorioControlador controlador = loader.getController();
            controlador.setSelecaoNotasMain(this);
            
            
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

    public static void main(String[] args) throws SQLException, Exception {
        launch(args);

    }
}