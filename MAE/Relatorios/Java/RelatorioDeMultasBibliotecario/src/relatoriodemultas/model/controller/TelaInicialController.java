/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatoriodemultas.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.text.ParseException;
import java.util.ResourceBundle;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.TextField;
import relatoriodemultas.model.RelatorioDeMultas;

/**
 * FXML Controller class
 *
 * @author mathe
 * @param <E>
 */
public class TelaInicialController implements Initializable {

    private static RelatorioDeMultas main;

    @FXML
    private TextField aluno;

    @Override
    public void initialize(URL url, ResourceBundle rb) {

    }

    @FXML
    public void alteraTelaRelatorio() throws IOException, SQLException {
        main.abreTelaRelatorio(aluno.getText());
    }

    @FXML
    public void alteraTelaRelatorioTodos() throws IOException, SQLException {
        main.abreTelaRelatorio("todos");
    }
    
    public void setMain(RelatorioDeMultas main) {
        TelaInicialController.main = main;
    }

}
