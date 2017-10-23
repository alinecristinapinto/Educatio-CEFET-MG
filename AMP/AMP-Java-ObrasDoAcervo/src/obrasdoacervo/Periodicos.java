/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package obrasdoacervo;

/**
 *
 * @author Aluno
 */
public class Periodicos extends Obras {
    String periodicidade;
    String mes;
    int volume;
    String subtipo;
    int ISSN;

    public Periodicos(String periodicidade, String mes, int volume, String subtipo, int ISSN, int idCampi, String nome, String tipo, String local, String ano, String editora, String paginas) {
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

    public int getVolume() {
        return volume;
    }

    public void setVolume(int volume) {
        this.volume = volume;
    }

    public String getSubtipo() {
        return subtipo;
    }

    public void setSubtipo(String subtipo) {
        this.subtipo = subtipo;
    }

    public int getISSN() {
        return ISSN;
    }

    public void setISSN(int ISSN) {
        this.ISSN = ISSN;
    }
    
    
}
