/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatoriodeobrasdescartadas.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.TextField;
import relatoriodeobrasdescartadas.model.RelatorioDeObrasDescartadas;

/**
 * FXML Controller class
 *
 * @author mathe
 */
public class TelaInicialController implements Initializable {

    private static RelatorioDeObrasDescartadas main;

    @FXML
    private TextField livro;

    @Override
    public void initialize(URL url, ResourceBundle rb) {

    }

    @FXML
    public void alteraTelaRelatorio() throws IOException, SQLException {
        main.abreTelaRelatorio(livro.getText());
    }

    public void setMain(RelatorioDeObrasDescartadas main) {
        TelaInicialController.main = main;
    }

}
