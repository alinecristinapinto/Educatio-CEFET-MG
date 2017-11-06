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
public class Partes{
    String titulo;
    int pagInicio;
    int pagFinal;
    String palavrasChave;

    public Partes(String titulo, int pagInicio, int pagFinal, String palavrasChave) {
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
