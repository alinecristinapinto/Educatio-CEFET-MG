/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Label;

public class LayoutBaseController implements Initializable {
    private ManutencaoCampi manutencaoCampi;
    
    public void setManutencaoCampi(ManutencaoCampi manutencaoCampi){
        this.manutencaoCampi=manutencaoCampi;
    }
    
    @FXML
    private void handleCriaCampi(ActionEvent event) {
        boolean okClicked = manutencaoCampi.invocaLayoutCriacao();
    }
    
    @FXML
    private void handleDeletaCampi(ActionEvent event) {
        boolean okClicked = manutencaoCampi.invocaLayoutDelete();
    }
    
    @FXML
    private void handleEditaCampi(ActionEvent event) {
        boolean okCLicked = manutencaoCampi.invocaLayoutAlteracao();
    }
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    
    
}
