/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tpfinal.fx;

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
    
    private ManutencaoDepto manutencaoDepto;
    ManutencaoDepartamento manDep = new ManutencaoDepartamento();
    
    private TextField info;
    private Stage thisStage;
    
    
    public void setManutencaoDepto(ManutencaoDepto manutencaoDepto){
        this.manutencaoDepto=manutencaoDepto;
    }
    
    @FXML
    private void handleCriarAction(ActionEvent event) throws SQLException, IOException {
        manutencaoDepto.invocaLayoutCriar();
        
    }
    
    @FXML
    private void handleAlterarAction(ActionEvent event) throws IOException {
        manutencaoDepto.invocaVerificaCampi(1);
        
    }
    
    @FXML
    private void handleExcluirAction(ActionEvent event) throws IOException {
        manutencaoDepto.invocaVerificaCampi(2);
        
    }
    
    @FXML
    private void handleTransferirAlction(ActionEvent event) throws IOException {
        manutencaoDepto.invocaLayoutTransferirAluno();
        
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
