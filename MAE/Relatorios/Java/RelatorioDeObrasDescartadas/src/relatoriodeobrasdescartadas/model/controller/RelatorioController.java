/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatoriodeobrasdescartadas.model.controller;


import java.io.IOException;
import java.net.URL;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Label;
import relatoriodeobrasdescartadas.model.RelatorioDeObrasDescartadas;

/**
 * FXML Controller class
 *
 * @author mathe
 */
public class RelatorioController implements Initializable {

    private String livro;
    private RelatorioDeObrasDescartadas main;
    private com.mysql.jdbc.Connection link;
   
    @FXML
    private Label nomeLivro;
    @FXML
    private Label editoraLivro;
    @FXML
    private Label funcionarioDescarte;
    @FXML
    private Label dataDescarte;
    @FXML
    private Label motivoDescarte;

    /**
     * Initializes the controller class.
     * @param url
     * @param rb
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
        try {
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
        } catch (SQLException ex) {
            Logger.getLogger(TelaInicialController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    public void mostrarRelatorio() throws SQLException{
       // Seleciono tudo da tabela acervo que tenha o mesmo nome do livro que o usuario passou.
        ResultSet resultadoAcervo = selecionarRegistros("acervo", "nome", livro);
        
        // Seleciono tudo da tabela descartes que tenha o mesmo idAcervo do livro que o usuario passou.
        ResultSet resultadoDescartes = selecionarRegistros("descartes", "idAcervo", resultadoAcervo.getString("id")); 
       
        
        nomeLivro.setText(resultadoAcervo.getString("nome"));
        System.out.println(resultadoAcervo.getString("editora"));
        editoraLivro.setText(resultadoAcervo.getString("editora"));
        funcionarioDescarte.setText(resultadoDescartes.getString("idFuncionario"));
        dataDescarte.setText(resultadoDescartes.getString("dataDescarte"));
        motivoDescarte.setText(resultadoDescartes.getString("motivos"));
        
    }
    public void setMain(RelatorioDeObrasDescartadas main) {
        this.main = main;
    }
    
    public ResultSet selecionarRegistros(String tabela, String pesquisa, String pesquisado) throws SQLException{
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `" + tabela + "` WHERE " + pesquisa + " = \'" + pesquisado + "\'";
        ResultSet resultado = comando.executeQuery(query);
        resultado.next(); 
        return resultado;
    } 
    
    public void setLivro(String livro){
        this.livro = livro;
    }
    
    @FXML
    public void sairApp(){
        System.exit(0);
    }
    
    @FXML
    public void alterarTelaInicial() throws IOException{
        main.abreTelaInicial();
    }
    
}
