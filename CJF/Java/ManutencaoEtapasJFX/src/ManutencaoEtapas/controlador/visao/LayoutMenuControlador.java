/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ManutencaoEtapas.controlador.visao;

import ManutencaoEtapas.controlador.ManutencaoEtapasMain;
import javafx.fxml.FXML;

/**
 *
 * @author Aluno
 */
public class LayoutMenuControlador {
    
    private ManutencaoEtapasMain manutencaoEtapasMain;
    private boolean botaoAdicionar = false;
    private boolean botaoAlterar = false;
    private boolean botaoExcluir = false;
    
    @FXML
    private void initialize() {
    }
    
    public void setManutencaoEtapasMain(ManutencaoEtapasMain manutencaoEtapasMain) {
        this.manutencaoEtapasMain = manutencaoEtapasMain;
    
    }
    
    public boolean isBotaoAdicionar() {
        return botaoAdicionar;
    }
    
    public boolean isBotaoAlterar() {
        return botaoAlterar;
    }
    
    public boolean isBotaoExcluir() {
        return botaoExcluir;
    }
    
    @FXML
    private void ChamaAdicionarTela() {
        manutencaoEtapasMain.showAdicionarTela();
            
            botaoAdicionar = true;
        }
    
    @FXML
    private void ChamaAlterarTela() {
        manutencaoEtapasMain.showAlterarTela();

            botaoAdicionar = true;
        }
    
    @FXML
    private void ChamaExcluirTela() {
        manutencaoEtapasMain.showExcluirTela();

            botaoAdicionar = true;
        }
    }

