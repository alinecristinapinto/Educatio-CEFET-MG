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
    int mes;
    int volume;
    String subtipo;
    int ISSN;

    public Periodicos(int mes, int volume, String subtipo, int ISSN, int id, int idObra, int idCampi, String nome, String tipo, String local, int ano, String editora, int paginas) {
        super(id, idObra, idCampi, nome, tipo, local, ano, editora, paginas);
        this.mes = mes;
        this.volume = volume;
        this.subtipo = subtipo;
        this.ISSN = ISSN;
    }



    public int getMes() {
        return mes;
    }

    public void setMes(int mes) {
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
