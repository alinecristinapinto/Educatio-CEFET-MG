/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package SelecaoConteudos.controlador.modelo;

import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 *
 * @author Aluno Carlos Henrique
 */
public class DadosConteudos {
    
    private StringProperty nomeDisicplina;
    private StringProperty numeroEtapa;
    
    public DadosConteudos() {
        this(null, null);
    }

    public DadosConteudos(String nomeDisicplina, String numeroEtapa) {
        this.nomeDisicplina = new SimpleStringProperty(nomeDisicplina);
        this.numeroEtapa = new SimpleStringProperty(numeroEtapa);
    }
       
    public String getNomeDisicplina() {
        return nomeDisicplina.get();
    }
    
    public void setNomeDisicplina(String nomeDisicplina) {
        this.nomeDisicplina.set(nomeDisicplina);
    }
    
    public StringProperty nomeDisicplinaProperty() {
        return nomeDisicplina;
    }

    public String getNumeroEtapa() {
        return numeroEtapa.get();
    }

    public void setNumeroEtapa(String numeroEtapa) {
        this.numeroEtapa.set(numeroEtapa);
    }
    
    public StringProperty numeroEtapaProperty() {
        return numeroEtapa;
    }
}