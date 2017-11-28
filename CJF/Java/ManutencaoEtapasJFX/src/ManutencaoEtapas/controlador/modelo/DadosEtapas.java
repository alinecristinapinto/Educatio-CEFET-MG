/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ManutencaoEtapas.controlador.modelo;

import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 *
 * @author Aluno Carlos Henrique
 */
public class DadosEtapas {
    
    private StringProperty idOrdem;
    private StringProperty valor;
    
    public DadosEtapas() {
        this(null, null);
    }

    public DadosEtapas(String idOrdem, String valor) {
        this.idOrdem = new SimpleStringProperty(idOrdem);
        this.valor = new SimpleStringProperty(valor);
    }
       
    public String getIdOrdem() {
        return idOrdem.get();
    }
    
    public void setIdOrdem(String idOrdem) {
        this.idOrdem.set(idOrdem);
    }
    
    public StringProperty idOrdemProperty() {
        return idOrdem;
    }

    public String getValor() {
        return valor.get();
    }

    public void setValor(String valor) {
        this.valor.set(valor);
    }
    
    public StringProperty valorProperty() {
        return valor;
    }
}
