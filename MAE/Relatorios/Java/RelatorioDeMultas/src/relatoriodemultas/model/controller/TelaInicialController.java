/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatoriodemultas.model.controller;

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
import relatoriodemultas.model.RelatorioDeMultas;

/**
 * FXML Controller class
 *
 * @author mathe
 * @param <E>
 */
public class TelaInicialController<E> implements Initializable {

    private com.mysql.jdbc.Connection link = null;
    private static RelatorioDeMultas main;

    @FXML
    private TextField aluno;

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
    public void alteraTelaRelatorio() throws IOException, SQLException {
        
        main.abreTelaRelatorio(aluno.getText());
    }

    public void setMain(RelatorioDeMultas main) {
        TelaInicialController.main = main;
    }

}
