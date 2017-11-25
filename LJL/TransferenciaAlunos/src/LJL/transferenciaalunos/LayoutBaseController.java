/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package LJL.transferenciaalunos;

import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.TextField;
import javafx.stage.Stage;


public class LayoutBaseController implements Initializable {
    
    private TransferenciaAlunos transferenciaAlunos;
    
    private TextField info;
    private Stage thisStage;
    
    
    public void setTransferenciaAlunos(TransferenciaAlunos transferenciaAlunos){
        this.transferenciaAlunos=transferenciaAlunos;
    }

    
    @FXML
    private void handleTransferirAlction(ActionEvent event) throws IOException, SQLException {
        transferenciaAlunos.invocaVerificaCampi();
        
    }
    
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }
    
    void setInfo (String info){
        this.info.setText(info);
    }

    /**
     * @param thisStage the thisStage to set
     */
    public void setThisStage(Stage thisStage) {
        this.thisStage = thisStage;
    }
    
}
