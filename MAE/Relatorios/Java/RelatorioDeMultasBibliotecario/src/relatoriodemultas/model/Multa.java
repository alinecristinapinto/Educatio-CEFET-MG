/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatoriodemultas.model;

import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 *
 * @author Aluno
 */
public class Multa {

    private final StringProperty nomeAluno;
    private final StringProperty multa;

    public Multa(String nomeAluno, String multa) {
        this.nomeAluno = new SimpleStringProperty(nomeAluno);
        this.multa = new SimpleStringProperty(multa);
    }

    public StringProperty getNomeAluno() {
        return nomeAluno;
    }

    public StringProperty getMulta() {
        return multa;
    }
    
}
