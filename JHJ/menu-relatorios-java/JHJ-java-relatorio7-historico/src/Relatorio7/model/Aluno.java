/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Relatorio7.model;

import javafx.beans.property.IntegerProperty;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 *
 * @author Aluno
 */
public class Aluno {
    private StringProperty nome;
    private StringProperty CPF;
    
    public Aluno(String nome, String CPF){
        this.nome = new SimpleStringProperty(nome);
        this.CPF = new SimpleStringProperty((String) CPF);
    }

    public StringProperty getNome() {
        return nome;
    }


    public StringProperty getCPF() {
        return CPF;
    }
}
