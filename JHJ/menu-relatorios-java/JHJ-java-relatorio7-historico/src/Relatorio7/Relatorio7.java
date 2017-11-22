package Relatorio7;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import Relatorio7.control.LayoutPesquisaAlunoController;
import Relatorio7.control.LayoutRelatorio7Controller;
import Relatorio7.model.Relatorio7BD;
import java.io.IOException;
import java.sql.SQLException;
import java.text.ParseException;
import javafx.application.Application;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.geometry.Insets;
import javafx.scene.Group;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;


public class Relatorio7 extends Application {
    private Stage palcoPrincipal;
    private BorderPane telaBase;
    private AnchorPane telaPrincipal;
    
    @Override
    public void start(Stage primaryStage) throws Exception {
        this.palcoPrincipal = primaryStage;
        palcoPrincipal.setTitle("Histórico Escolar");
        
        invocaLayoutPesquisa();
    }
    
    public void invocaLayoutRelatorio7(String cpf) throws SQLException, ParseException{
        try{
        FXMLLoader carregadorFXML = new FXMLLoader();
        carregadorFXML.setLocation(Relatorio7.class.getResource("view/TelaFundo.fxml"));
        telaBase = (BorderPane)carregadorFXML.load();
        
        FXMLLoader auxiliar = new FXMLLoader();
        auxiliar.setLocation(Relatorio7.class.getResource("view/LayoutRelatorio7.fxml"));
        telaPrincipal = (AnchorPane)auxiliar.load();

        telaBase.setCenter(telaPrincipal);
        Scene cena = new Scene(telaBase);
        palcoPrincipal.setScene(cena);
        palcoPrincipal.show();
        
        LayoutRelatorio7Controller controller = (LayoutRelatorio7Controller) auxiliar.getController();

        controller.setRelatorio7(this);
        controller.setCpf(cpf);
        if(controller.setNotasHistorico()==0){
            controller.setLabels();
        }
        else{
            Alert alert = new Alert(javafx.scene.control.Alert.AlertType.ERROR);
            alert.setTitle("Erro");
            alert.setHeaderText("Dados do aluno não disponíveis");
            alert.setContentText("Consulte a coordenação para mais informações");
            alert.show();
        }
        }
        catch (IOException e) {
                e.printStackTrace();
        }
    }
    
    
    public void invocaLayoutPesquisa() throws SQLException, ParseException{
        try{
        FXMLLoader carregadorFXML = new FXMLLoader();
        carregadorFXML.setLocation(Relatorio7.class.getResource("view/TelaFundo.fxml"));
        telaBase = (BorderPane)carregadorFXML.load();
        
        FXMLLoader auxiliar = new FXMLLoader();
        auxiliar.setLocation(Relatorio7.class.getResource("view/LayoutPesquisaAluno.fxml"));
        telaPrincipal = (AnchorPane)auxiliar.load();


        telaBase.setCenter(telaPrincipal);
        Scene cena = new Scene(telaBase);
        palcoPrincipal.setScene(cena);
        palcoPrincipal.show();
        
        LayoutPesquisaAlunoController controller = (LayoutPesquisaAlunoController) auxiliar.getController();
        controller.setRelatorio7(this);
        controller.centraliza(telaBase);
        
        }
        catch (IOException e) {
                e.printStackTrace();
        }
    }
    
    public static void main(String[] args) {
        launch(args);
    }
    
}