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
public class Partes extends Periodicos {
    String titulo;
    int pagInicio;
    int pagFinal;
    String palavrasChave;

    public Partes(String titulo, int pagInicio, int pagFinal, String palavrasChave, int mes, int volume, String subtipo, int ISSN, int id, int idObra, int idCampi, String nome, String tipo, String local, int ano, String editora, int paginas) {
        super(mes, volume, subtipo, ISSN, id, idObra, idCampi, nome, tipo, local, ano, editora, paginas);
        this.titulo = titulo;
        this.pagInicio = pagInicio;
        this.pagFinal = pagFinal;
        this.palavrasChave = palavrasChave;
    }   

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public int getPagInicio() {
        return pagInicio;
    }

    public void setPagInicio(int pagInicio) {
        this.pagInicio = pagInicio;
    }

    public int getPagFinal() {
        return pagFinal;
    }

    public void setPagFinal(int pagFinal) {
        this.pagFinal = pagFinal;
    }

    public String getPalavrasChave() {
        return palavrasChave;
    }

    public void setPalavrasChave(String palavrasChave) {
        this.palavrasChave = palavrasChave;
    }
}
