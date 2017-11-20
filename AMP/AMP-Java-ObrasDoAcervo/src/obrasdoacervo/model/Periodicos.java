/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package obrasdoacervo.model;

/**
 *
 * @author Aluno
 */
public class Periodicos extends Obras {
    String periodicidade;
    String mes;
    String volume;
    String subtipo;
    String ISSN;

    public Periodicos(String periodicidade, String mes, String volume, String subtipo, String ISSN, int idCampi, String nome, String tipo, String local, String ano, String editora, String paginas) {
        super(idCampi, nome, tipo, local, ano, editora, paginas);
        
        this.periodicidade = periodicidade;
        this.mes = mes;
        this.volume = volume;
        this.subtipo = subtipo;
        this.ISSN = ISSN;
    }




    public String getMes() {
        return mes;
    }

    public void setMes(String mes) {
        this.mes = mes;
    }

    public String getVolume() {
        return volume;
    }

    public void setVolume(String volume) {
        this.volume = volume;
    }

    public String getSubtipo() {
        return subtipo;
    }

    public void setSubtipo(String subtipo) {
        this.subtipo = subtipo;
    }

    public String getISSN() {
        return ISSN;
    }

    public void setISSN(String ISSN) {
        this.ISSN = ISSN;
    }
    
    
}
