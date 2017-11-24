/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutencaoDeProfessores.model;

import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 *
 * @author Augusto
 */
public class ProfTabela {
    private StringProperty nome;
    //private StringProperty sobrenome;
    private StringProperty IDSiape;
    private StringProperty titulacao;

    public ProfTabela(String nome, String IDSiape, String titulacao) {
        this.nome = new SimpleStringProperty(nome);
        //.sobrenome = new SimpleStringProperty(sobrenome);
        this.IDSiape = new SimpleStringProperty(IDSiape);
        this.titulacao = new SimpleStringProperty(titulacao);
    }

    public StringProperty getNome() {
        return nome;
    }

    public void setNome(StringProperty nome) {
        this.nome = nome;
    }

    public StringProperty getIDSiape() {
        return IDSiape;
    }

    public void setIDSiape(StringProperty IDSiape) {
        this.IDSiape = IDSiape;
    }

    public StringProperty getTitulacao() {
        return titulacao;
    }

    public void setTitulacao(StringProperty titulacao) {
        this.titulacao = titulacao;
    }
    
    
}
