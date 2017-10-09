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

    int id;
    int idObra;
    int idCampi;
    String nome;
    String tipo;
    String local;
    int ano;
    String editora;
    int paginas;

    public Obras (int id, int idObra, int idCampi, String nome, String tipo, String local, int ano, String editora, int paginas) {
        this.id = id;
        this.idObra = idObra;
        this.idCampi = idCampi;
        this.nome = nome;
        this.tipo = tipo;
        this.local = local;
        this.ano = ano;
        this.editora = editora;
        this.paginas = paginas;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }   
    
    public int getIdObra() {
        return idObra;
    }

    public void setIdobra(int idobra) {
        this.idObra = idobra;
    }
    public int getIdCampi() {
        return idCampi;
    }

    public void setIdCampi(int idcampi) {
        this.idCampi = idcampi;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getTipo() {
        return tipo;
    }

    public void setTipo(String tipo) {
        this.tipo = tipo;
    }

    public String getLocal() {
        return local;
    }

    public void setLocal(String local) {
        this.local = local;
    }

    public int getAno() {
        return ano;
    }

    public void setAno(int ano) {
        this.ano = ano;
    }

    public String getEditora() {
        return editora;
    }

    public void setEditora(String editora) {
        this.editora = editora;
    }

    public int getPaginas() {
        return paginas;
    }

    public void setPaginas(int paginas) {
        this.paginas = paginas;
    }
    
}
