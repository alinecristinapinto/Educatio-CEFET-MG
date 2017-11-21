/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package obrasdoacervo.model;

import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 *
 * @author Augusto
 */
public class AutoresTabela {
    StringProperty nome;
    StringProperty sobrenome;
    StringProperty ordem;
    StringProperty qualificacao;
    
    public AutoresTabela(String nome, String sobrenome, String ordem, String qualificacao){
        this.nome = new SimpleStringProperty(nome);
        this.sobrenome = new SimpleStringProperty(sobrenome);
        this.ordem = new SimpleStringProperty(ordem);
        this.qualificacao = new SimpleStringProperty(qualificacao);
    }

    public StringProperty getNome() {
        return nome;
    }

    public void setNome(StringProperty nome) {
        this.nome = nome;
    }

    public StringProperty getSobrenome() {
        return sobrenome;
    }

    public void setSobrenome(StringProperty sobrenome) {
        this.sobrenome = sobrenome;
    }

    public StringProperty getOrdem() {
        return ordem;
    }

    public void setOrdem(StringProperty ordem) {
        this.ordem = ordem;
    }

    public StringProperty getQualificacao() {
        return qualificacao;
    }

    public void setQualificacao(StringProperty qualificacao) {
        this.qualificacao = qualificacao;
    }

    
}
