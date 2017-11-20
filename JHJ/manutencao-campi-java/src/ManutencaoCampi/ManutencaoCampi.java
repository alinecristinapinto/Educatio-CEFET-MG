package ManutencaoCampi;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import ManutencaoCampi.model.*;
import ManutencaoCampi.control.*;
import java.io.IOException;
import java.sql.SQLException;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Modality;
import javafx.stage.Stage;


public class ManutencaoCampi extends Application {
    private Stage palcoPrincipal;
    private BorderPane telaBase;
    private AnchorPane telaInicial;
    
    @Override
    public void start(Stage primaryStage) throws Exception {
        this.palcoPrincipal = primaryStage;
        palcoPrincipal.setTitle("Manutencao de Campi");
        
        invocaLayoutBase();
    }
    
    public void invocaLayoutBase(){
        try{
        FXMLLoader carregadorFXML = new FXMLLoader();
        carregadorFXML.setLocation(ManutencaoCampi.class.getResource("view/TelaFundo.fxml"));
        telaBase = (BorderPane)carregadorFXML.load();
        
        FXMLLoader auxiliar = new FXMLLoader();
        auxiliar.setLocation(ManutencaoCampi.class.getResource("view/LayoutBase.fxml"));
        telaInicial = (AnchorPane)auxiliar.load();


        telaBase.setCenter(telaInicial);
        Scene cena = new Scene(telaBase);
        palcoPrincipal.setScene(cena);
        palcoPrincipal.show();

        LayoutBaseController controller = (LayoutBaseController)auxiliar.getController();
        controller.setAplicacao(this);
        }
        catch (IOException e) {
                e.printStackTrace();
        }
    }
    
    public boolean invocaLayoutCriacao(){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoCampi.class.getResource("view/TelaFundo.fxml"));
            telaBase = (BorderPane)carregadorFXML.load();
            
            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(ManutencaoCampi.class.getResource("view/Criacao/LayoutCampiCriacao.fxml"));
            telaInicial = (AnchorPane)auxiliar.load();
            
            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            LayoutCampiCriacaoController controller = (LayoutCampiCriacaoController)auxiliar.getController();
            controller.setManutencao(new ManutencaoCampiBD());
            controller.setAplicacao(this);

            return controller.isOkClicked();   
        }
        catch (IOException e) {
                e.printStackTrace();
        }
        return false;
    }
    
    public boolean invocaLayoutDelete(){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoCampi.class.getResource("view/TelaFundo.fxml"));
            telaBase = (BorderPane)carregadorFXML.load();
            
            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(ManutencaoCampi.class.getResource("view/Exclusao/LayoutCampiDelete.fxml"));
            telaInicial = (AnchorPane)auxiliar.load();
            
            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            LayoutCampiDeleteController controller = (LayoutCampiDeleteController)auxiliar.getController();
            controller.setAplicacao(this);
            controller.setManutencao(new ManutencaoCampiBD());
            
            return controller.isOkClicked();
        }
        catch (IOException e) {
                e.printStackTrace();
        }
        return false;
    }
    
    public boolean invocaLayoutAlteracao(){
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoCampi.class.getResource("view/TelaFundo.fxml"));
            telaBase = (BorderPane)carregadorFXML.load();
            
            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(ManutencaoCampi.class.getResource("view/Alteracao/LayoutCampiAlteracao.fxml"));
            telaInicial = (AnchorPane)auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();

            LayoutCampiAlteracaoController controller = (LayoutCampiAlteracaoController)auxiliar.getController();
            controller.setAplicacao(this);

            return controller.isOkClicked();
        }
        catch (IOException e) {
                e.printStackTrace();
        }
        return false;
    }
    
    public boolean invocaLayoutAlteracao2(boolean[] dadosSelecao, String nomeCampus) throws SQLException{
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoCampi.class.getResource("view/TelaFundo.fxml"));
            telaBase = (BorderPane)carregadorFXML.load();
            
            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(ManutencaoCampi.class.getResource("view/Alteracao/LayoutCampiAlteracao2.fxml"));
            telaInicial = (AnchorPane)auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            LayoutCampiAlteracao2Controller controller = (LayoutCampiAlteracao2Controller)auxiliar.getController();
            controller.setAplicacao(this);
            controller.setDadosSelecao(dadosSelecao, nomeCampus);
            controller.setManutencao(new ManutencaoCampiBD());

            return controller.isOkClicked();
        }
        catch (IOException e) {
            e.printStackTrace();
        }
        return false;
    }
    
    public boolean invocaLayoutBusca(String nome, String cidade, String uf) throws SQLException{
        try{
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(ManutencaoCampi.class.getResource("view/TelaFundo.fxml"));
            telaBase = (BorderPane)carregadorFXML.load();
            
            FXMLLoader auxiliar = new FXMLLoader();
            auxiliar.setLocation(ManutencaoCampi.class.getResource("view/Busca/LayoutCampiBusca.fxml"));
            telaInicial = (AnchorPane)auxiliar.load();

            telaBase.setCenter(telaInicial);
            Scene cena = new Scene(telaBase);
            palcoPrincipal.setScene(cena);
            palcoPrincipal.show();
            
            LayoutCampiBuscaController controller = (LayoutCampiBuscaController)auxiliar.getController();
            controller.setDados(nome, cidade, uf);
            controller.setAplicacao(this);

            return controller.okEstaClicado();
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