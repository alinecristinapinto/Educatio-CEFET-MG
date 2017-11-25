/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatoriodeobrasdescartadas.model;

import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 *
 * @author mathe
 */
public class ObrasDescartadas {
    private StringProperty funcionario;
    private StringProperty nome;
    private StringProperty data;
    private StringProperty motivo;

    public ObrasDescartadas(String nome, String funcionario, String data, String motivo) {
        this.funcionario = new SimpleStringProperty(funcionario);
        this.nome = new SimpleStringProperty(nome);
        this.data = new SimpleStringProperty(data);
        this.motivo = new SimpleStringProperty(motivo);
    }

    public StringProperty getFuncionario() {
        return funcionario;
    }

    public StringProperty getNome() {
        return nome;
    }

    public StringProperty getData() {
        return data;
    }

    public StringProperty getMotivo() {
        return motivo;
    }

    
}
