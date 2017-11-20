/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaodecurso.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.TextField;
import manutencaodecurso.model.ManutencaoDeCurso;

/**
 * FXML Controller class
 *
 * @author mathe
 */
public class CriarCursoController implements Initializable {

    private com.mysql.jdbc.Connection link = null;
    private static ManutencaoDeCurso main;
    @FXML
    private TextField idDepto;
    @FXML
    private TextField nome;
    @FXML
    private TextField horasTotal;
    @FXML
    private TextField modalidade;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {

        try {
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");
        } catch (SQLException ex) {
            Logger.getLogger(TelaInicialController.class.getName()).log(Level.SEVERE, null, ex);
        }
        if (link == null) {
            System.out.println("Erro!");
        } else {
            System.out.println("Conexao feita com sucesso!");
        }

    }

    @FXML
    public void criarCurso() throws SQLException, IOException {
        Statement comando = link.createStatement();
        String query = "INSERT INTO `cursos` ( `idDepto`, `nome`, `horasTotal`, `modalidade`, `ativo`) VALUES ('"
                + idDepto.getText() + "', '"
                + nome.getText() + "', '"
                + horasTotal.getText() + "', '"
                + modalidade.getText() + "', 'S');";
        comando.executeUpdate(query);
        System.out.println("Criou uma curso.");
        alteraTelaInicial();
    }

    @FXML
    public void alteraTelaInicial() throws IOException {
        main.abreTelaInicial();
    }

    public void setMain(ManutencaoDeCurso main) {
        this.main = main;
    }
}
