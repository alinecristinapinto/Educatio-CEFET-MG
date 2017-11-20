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
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import manutencaodecurso.model.ManutencaoDeCurso;

/**
 * FXML Controller class
 *
 * @author mathe
 * @param <E>
 */
public class TelaInicialController<E> implements Initializable {

    private com.mysql.jdbc.Connection link = null;
    private static ManutencaoDeCurso main;

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        
    }

    @FXML
    public void alteraTelaAlterarCurso() throws IOException {
        main.abreAlteraCurso();
    }

    @FXML
    public void alteraTelaApagarCurso() throws IOException {
        main.abreApagaCurso();
    }

    @FXML
    public void alteraTelaCriarCurso() throws IOException {
        main.abreCriaCurso();
    }

    public void setMain(ManutencaoDeCurso main) {
        this.main = main;
    }

}
