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
public class Obras {

    int idCampi;
    String nome;
    String tipo;
    String local;
    String ano;
    String editora;
    String paginas;
    String ativo;

    public Obras() {
    }
    
    public Obras(int idCampi, String nome, String tipo, String local, String ano, String editora, String paginas) {
        this.idCampi = idCampi;
        this.nome = nome;
        this.tipo = tipo;
        this.local = local;
        this.ano = ano;
        this.editora = editora;
        this.paginas = paginas;
    }


    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public int getIdCampi() {
        return idCampi;
    }

    public void setIdCampi(int idCampi) {
        this.idCampi = idCampi;
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

    public String getAno() {
        return ano;
    }

    public void setAno(String ano) {
        this.ano = ano;
    }

    public String getEditora() {
        return editora;
    }

    public void setEditora(String editora) {
        this.editora = editora;
    }

    public String getPaginas() {
        return paginas;
    }

    public void setPaginas(String paginas) {
        this.paginas = paginas;
    }

    public String getAtivo() {
        return ativo;
    }

    public void setAtivo(String ativo) {
        this.ativo = ativo;
    }

}
