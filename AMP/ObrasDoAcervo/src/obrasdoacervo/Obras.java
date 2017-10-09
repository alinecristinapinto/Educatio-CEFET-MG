/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package obrasdoacervo;

import java.util.Scanner;

/**
 *
 * @author Aluno
 */
public class Obras {

    int idObra;    
    String nome;

    public Obras (int id, int idObra, int idCampi, String nome, String tipo, String local, int ano, String editora, int paginas) {
        this.idObra = idObra;
        this.nome = nome;
    }

    public int getIdObra() {
        return idObra;
    }

    public void setIdobra(int idobra) {
        this.idObra = idobra;
    }


    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

}
