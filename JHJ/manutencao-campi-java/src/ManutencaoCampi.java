/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.IOException;
import java.sql.SQLException;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.stage.Modality;
import javafx.stage.Stage;

/**
 *
 * @author gabri_000
 */
public class ManutencaoCampi extends Application {
    private Stage primaryStage;
    
    @Override
    public void start(Stage primaryStage) throws Exception {
        this.primaryStage = primaryStage;
        
        Parent root = FXMLLoader.load(getClass().getResource("LayoutBase.fxml"));
        
        invocaLayoutBase();
    }
    
    public void invocaLayoutBase(){
        try{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoCampi.class.getResource("LayoutBase.fxml"));
        AnchorPane page = (AnchorPane)loader.load();


        Stage dialogStage = new Stage();
        dialogStage.setTitle("Manutenção de Campi");
        dialogStage.initModality(Modality.WINDOW_MODAL);
        dialogStage.initOwner(primaryStage);
        Scene scene = new Scene(page);
        dialogStage.setScene(scene);


        LayoutBaseController controller = (LayoutBaseController)loader.getController();
        controller.setManutencaoCampi(this);


        dialogStage.showAndWait();
    }
    catch (IOException e) {
            e.printStackTrace();
    }
    }
    
    public boolean invocaLayoutCriacao(){
        try{
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoCampi.class.getResource("LayoutCampiCriacao.fxml"));
            AnchorPane page = (AnchorPane)loader.load();


            Stage dialogStage = new Stage();
            dialogStage.setTitle("Adicionar campus");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.initOwner(primaryStage);
            Scene scene = new Scene(page);
            dialogStage.setScene(scene);


            LayoutCampiCriacaoController controller = (LayoutCampiCriacaoController)loader.getController();
            controller.setDialogStage(dialogStage);
            controller.setManutencao(new ManutencaoCampiBD());


            dialogStage.showAndWait();

            return controller.isOkClicked();
        }
        catch (IOException e) {
                e.printStackTrace();
        }
        return false;
    }
    public boolean invocaLayoutDelete(){
        try{
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoCampi.class.getResource("LayoutCampiDelete.fxml"));
            AnchorPane page = (AnchorPane)loader.load();


            Stage dialogStage = new Stage();
            dialogStage.setTitle("Excluir campus");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.initOwner(primaryStage);
            Scene scene = new Scene(page);
            dialogStage.setScene(scene);


            LayoutCampiDeleteController controller = (LayoutCampiDeleteController)loader.getController();
            controller.setDialogStage(dialogStage);
            controller.setManutencao(new ManutencaoCampiBD());


            dialogStage.showAndWait();

            return controller.isOkClicked();
        }
        catch (IOException e) {
                e.printStackTrace();
        }
        return false;
    }
    public boolean invocaLayoutAlteracao(){
        try{
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoCampi.class.getResource("LayoutCampiAlteracao.fxml"));
            AnchorPane page = (AnchorPane)loader.load();


            Stage dialogStage = new Stage();
            dialogStage.setTitle("Selecionar campus");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.initOwner(primaryStage);
            Scene scene = new Scene(page);
            dialogStage.setScene(scene);


            LayoutCampiAlteracaoController controller = (LayoutCampiAlteracaoController)loader.getController();
            controller.setDialogStage(dialogStage);
            controller.setManutencaoCampi(this);
            
            dialogStage.showAndWait();

            return controller.isOkClicked();
        }
        catch (IOException e) {
                e.printStackTrace();
        }
        return false;
    }
    public boolean invocaLayoutAlteracao2(boolean[] dadosSelecao, String nomeCampus) throws SQLException{
        try{
            FXMLLoader loader = new FXMLLoader();
            loader.setLocation(ManutencaoCampi.class.getResource("LayoutCampiAlteracao2.fxml"));
            AnchorPane page = (AnchorPane)loader.load();


            Stage dialogStage = new Stage();
            dialogStage.setTitle("Alterar dados do campus");
            dialogStage.initModality(Modality.WINDOW_MODAL);
            dialogStage.initOwner(primaryStage);
            Scene scene = new Scene(page);
            dialogStage.setScene(scene);


            LayoutCampiAlteracao2Controller controller = (LayoutCampiAlteracao2Controller)loader.getController();
            controller.setDialogStage(dialogStage);
            controller.setDadosSelecao(dadosSelecao, nomeCampus);
            controller.setManutencao(new ManutencaoCampiBD());

            dialogStage.showAndWait();

            return controller.isOkClicked();
        }
        catch (IOException e) {
                e.printStackTrace();
        }
        return false;
    }
    public static void main(String[] args) {
        launch(args);
    }
    
}
