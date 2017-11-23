/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package LJL.transferenciaalunos;

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

    /**
     * @return the nome
     */
    public StringProperty getNome() {
        return nome;
    }


    /**
     * @return the CPF
     */
    public StringProperty getCPF() {
        return CPF;
    }

   
}
