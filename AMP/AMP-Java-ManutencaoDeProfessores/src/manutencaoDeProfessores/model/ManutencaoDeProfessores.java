
package manutencaoDeProfessores.model;

import java.io.IOException;
import java.sql.*;
import javafx.application.Application;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;
import javax.swing.JOptionPane;
import manutencaoDeProfessores.model.controller.CriaProfessorController;
import manutencaoDeProfessores.model.controller.EditaProfessorController;
import manutencaoDeProfessores.model.controller.InterfacePrincipalController;
import manutencaoDeProfessores.model.controller.PesquisaProfessorController;


public class ManutencaoDeProfessores extends Application {

    
    public static void main(String[] args) throws SQLException {
        try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        }catch (ClassNotFoundException e) {
            System.out.println("Driver não encontrado!"+e);
        }
        System.out.println("Driver encontrado com sucesso!");
        
        Connection connection = null;
        connection = DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        if (connection != null){
            System.out.println("Conexão realizada com sucesso");
        }else{
            System.out.println("Não foi possível realizar a conexão");
        }
        
        launch(args);
        /* String determinante;
        String determinado;                     
        
        Professor p1 = new Professor(0, 00000, "Augusto", "Fundamental", "senha1");  
        
        Professor p2 = new Professor(1, 00001, "Pedro", "Doutorado", "senha2");
        
        Professor p3 = new Professor(2, 00002, "Morato", "Superior", "senha3");
                 
        FuncoesProfessorBD FuncProf1 = new FuncoesProfessorBD(p1);
        
        FuncProf1.abrebd();               
                           
        FuncProf1.adicionaProfessor();
        
        FuncProf1.setP1(p2);
        
        FuncProf1.adicionaProfessor();
        
        FuncProf1.setP1(p3);
        
        FuncProf1.adicionaProfessor();  
        
        JOptionPane.showMessageDialog(null, "'setando' um professor inativo"); 
        determinante = JOptionPane.showInputDialog(null, "insira a tabela");
        determinado = JOptionPane.showInputDialog(null, "insira o dado da tabela");
        
        FuncProf1.deletaProfessor(determinante,determinado);
        
        JOptionPane.showMessageDialog(null, "pesquisando "); 
        determinante = JOptionPane.showInputDialog(null, "insira a tabela");
        determinado = JOptionPane.showInputDialog(null, "insira o dado da tabela");
        
        FuncProf1.pesquisaProfessor(determinante, determinado);
        
        JOptionPane.showMessageDialog(null, "pesquisa com mais de um resultado "); 
        determinante = JOptionPane.showInputDialog(null, "insira a tabela");
        determinado = JOptionPane.showInputDialog(null, "insira o dado da tabela");
        
        FuncProf1.pesquisaProfessor(determinante, determinado);
        
        FuncProf1.alteraProfessor("idDepto", "0", "titulacao", "Mestrado");
        
        FuncProf1.fechabd();
        */
        
    }
    
    private Stage stage;
    private BorderPane borda;
    
    @Override
    public void start(Stage stage) throws IOException{
        
        this.stage = stage;
        abreBaseTelaInicial();
        abreInterfacePrincipal();
        
    }
    public ObservableList pesquisaDepto(Connection connection) throws SQLException{
        System.out.println("101");
        ObservableList nomes = FXCollections.observableArrayList();
        ResultSet result;
        System.out.println("104");
        String sql_fetch = "SELECT nome FROM deptos WHERE ativo='S'";
        try{
            System.out.println("105");
        Statement fetch = connection.createStatement();
            System.out.println("106");
        result = fetch.executeQuery(sql_fetch);
        while(result.next()){
        nomes.add(result.getString("nome"));
        }
            System.out.println("107");
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());  
        }
        
        return nomes;
    }
    
    
    public void abreBaseTelaInicial() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeProfessores.class.getResource("view/Borda.fxml"));
        borda = (BorderPane) loader.load();
        stage.setScene(new Scene(borda));
        stage.show();
    }
    
    public void abreInterfacePrincipal() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeProfessores.class.getResource("view/InterfacePrincipal.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        InterfacePrincipalController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abreCriaProfessor(Connection link) throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeProfessores.class.getResource("view/CriaProfessor.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        CriaProfessorController controller = loader.getController();
        controller.setMain(this, link);
    }
    
    public void abrePesquisaProfessor() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeProfessores.class.getResource("view/PesquisaProfessor.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        PesquisaProfessorController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abreEditaProfessor() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ManutencaoDeProfessores.class.getResource("view/EditaProfessor.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        EditaProfessorController controller = loader.getController();
        controller.setMain(this);
    }

}
