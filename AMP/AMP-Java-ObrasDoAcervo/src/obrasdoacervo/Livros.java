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
    String edicao;

    public Livros(String ISBN, String edicao, int idCampi, String nome, String tipo, String local, String ano, String editora, String paginas) {
        super(idCampi, nome, tipo, local, ano, editora, paginas);
        this.ISBN = ISBN;
        this.edicao = edicao;
    }



    public String getISBN() {
        return ISBN;
    }

    public void setISBN(String ISBN) {
        this.ISBN = ISBN;
    }

    public String getEdicao() {
        return edicao;
    }

    public void setEdicao(String edicao) {
        this.edicao = edicao;
    }
    
    public String toString (){
        return "Nome: " + nome + "\ntipo: "  + tipo + "\nLocal: " + local + "\nAno: " + ano +
    "\nEditora: " + editora + "\nPaginas: " + paginas;      
    }
}
