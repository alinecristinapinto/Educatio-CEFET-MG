/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package educatio.app.view;

import educatio.app.mainApp;


public class GerentesTelaInicialProfessoresController {
    
    
    
    private mainApp mainApp;
    
    private void initialize() {
    
    }
    
    public void setMainApp(mainApp mainApp) {
        this.mainApp = mainApp;
    }
    
    public void saiAplicacao(){
        mainApp.mostraLogin();
    }
}
