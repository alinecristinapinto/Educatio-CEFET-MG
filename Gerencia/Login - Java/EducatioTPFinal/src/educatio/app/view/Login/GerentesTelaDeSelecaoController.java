/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package educatio.app.view.Login;

import educatio.app.mainApp;
import educatio.app.model.Login.*;

/**
 *
 * @author 7
 */
public class GerentesTelaDeSelecaoController {
   
    
    String selecaoFeita;
    Usuario usuario;

    public void setUsuario(Usuario usuario) {
        this.usuario = usuario;
    }
    
    private mainApp mainApp;
    
    private void initialize() {
    
    }
    
    public void acaoSelecaoB()
    {
        mainApp.mostraPagInicialBiblioteca(usuario);
    }
    public void acaoSelecaoA()
    {
       mainApp.mostraPagInicialSistemaAcademico(usuario);
    }
    
    public void setMainApp(mainApp mainApp) {
        this.mainApp = mainApp;
    }
}
