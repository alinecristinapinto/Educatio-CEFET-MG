/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package SelecaoConteudos.controlador;

import BD.SelecaoConteudosBD;
import SelecaoConteudos.controlador.modelo.DadosConteudos;
import SelecaoConteudos.controlador.visao.LayoutInicialControlador;
import SelecaoConteudos.controlador.visao.TelaRelatorioControlador;
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

public class SelecaoConteudosMain extends Application  {

    private Stage primaryStage;
    private BorderPane rootLayout;
    private DadosConteudos dadosConteudos;

    @Override
    public void start(Stage primaryStage) {
        this.primaryStage = primaryStage;
        this.primaryStage.setTitle("Relatorio de conteúdos");

        initBarraMenu();

        showLayoutInicial();
        
        dadosConteudos = new DadosConteudos();
    }
    
    public SelecaoConteudosMain(){
        
    }
    
    /**
     * Inicializa o root layout (layout base).
     */
    public void initBarraMenu() {
        try {
            // Carrega o root layout do arquivo fxml.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(SelecaoConteudosMain.class.getResource("visao/BarraMenu.fxml"));
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
            loader.setLocation(SelecaoConteudosMain.class.getResource("visao/LayoutInicial.fxml"));
            AnchorPane LayoutInicial = (AnchorPane) loader.load();

            // Define o person overview dentro do root layout.
            rootLayout.setCenter(LayoutInicial);
            
            LayoutInicialControlador controlador = loader.getController();
            controlador.setManutencao(new SelecaoConteudosBD());
            controlador.setDadosConteudos(new DadosConteudos());
            controlador.setSelecaoConteudosMain(this);
            
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    
    public void showTelaRelatorio() {
        try {
            // Carrega o person overview.
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(SelecaoConteudosMain.class.getResource("visao/TelaRelatorio.fxml"));
            AnchorPane TelaRelatorio = (AnchorPane) loader.load();

            // Define o person overview dentro do root layout.
            rootLayout.setCenter(TelaRelatorio);
            
            TelaRelatorioControlador controlador = loader.getController();
            controlador.setSelecaoConteudosMain(this);
            
            
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
