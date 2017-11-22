package SelecaoNotas.controlador;

import SelecaoNotas.controlador.modelo.DadosNotas;
import SelecaoNotas.controlador.visao.TelaRelatorioControlador;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
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
        this.primaryStage.setTitle("Seleção de notas");

        initBarraMenu();

        showLayoutInicial();
        
        dadosNotas = new DadosNotas();
    }
    
    private ObservableList<DadosNotas> dadosNotasTabela = FXCollections.observableArrayList();
    
    public SelecaoNotasMain(){
        dadosNotasTabela.add(new DadosNotas("LP", "10","","","","","",""));
    }
    
   /* public ObservableList<DadosNotas> getDadosNotas() {
        return dadosNotas;
    }*/
    
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
        
        try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e){
            System.out.println("Driver nao encontrado!"+e);
        }
        
        //estabelecendo conexao com BD
        Connection connection = null;
        connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio","root","");
        
        if(connection==null){
            System.out.println("Status-------->Erro ao conectar!");
            System.exit(0);
        }
    }
}