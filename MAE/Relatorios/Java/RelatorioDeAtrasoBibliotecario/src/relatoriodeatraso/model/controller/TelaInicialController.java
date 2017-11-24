/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatoriodeatraso.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.text.ParseException;
import java.util.ResourceBundle;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.TextField;
import relatoriodeatraso.model.RelatorioDeAtraso;

/**
 * FXML Controller class
 *
 * @author Aluno
 */
public class TelaInicialController implements Initializable {

    private static RelatorioDeAtraso main;

    @FXML
    private TextField aluno;

    @Override
    public void initialize(URL url, ResourceBundle rb) {

    }

    @FXML
    public void alteraTelaRelatorio() throws IOException, SQLException, ParseException {
        main.abreTelaRelatorio(aluno.getText());
    }

    @FXML
    public void alteraTelaRelatorioTodos() throws IOException, SQLException, ParseException {
        main.abreTelaRelatorio("todos");
    }

    public void setMain(RelatorioDeAtraso main) {
        TelaInicialController.main = main;
    }

}
