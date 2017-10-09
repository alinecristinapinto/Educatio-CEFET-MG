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
public class Livros extends Obras {
    String ISBN;
    int edicao;

    public Livros(String ISBN, int edicao, int id, int idObra, int idCampi, String nome, String tipo, String local, int ano, String editora, int paginas) {
        super(id, idObra, idCampi, nome, tipo, local, ano, editora, paginas);
        this.ISBN = ISBN;
        this.edicao = edicao;
    }



    public String getISBN() {
        return ISBN;
    }

    public void setISBN(String ISBN) {
        this.ISBN = ISBN;
    }

    public int getEdicao() {
        return edicao;
    }

    public void setEdicao(int edicao) {
        this.edicao = edicao;
    }
    
    public String toString (){
        return "Nome: " + nome + "\ntipo: "  + tipo + "\nLocal: " + local + "\nAno: " + ano +
    "\nEditora: " + editora + "\nPaginas: " + paginas;      
    }
}
