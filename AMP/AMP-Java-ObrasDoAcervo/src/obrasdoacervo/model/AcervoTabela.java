/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package obrasdoacervo.model;

import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 *
 * @author Aluno
 */
public class AcervoTabela {
    private StringProperty campus;
    private StringProperty nome;
    private StringProperty tipo;
    private StringProperty local;
    private StringProperty ano;
    private StringProperty editora;
    private StringProperty paginas;
    private int id;

    public AcervoTabela(String campus, String nome, String tipo, String local, String ano, String editora, String paginas, int id) {
        this.campus = new SimpleStringProperty(campus);
        this.nome = new SimpleStringProperty(nome);
        this.tipo = new SimpleStringProperty(tipo);
        this.local = new SimpleStringProperty(local);
        this.ano = new SimpleStringProperty(ano);
        this.editora = new SimpleStringProperty(editora);
        this.paginas = new SimpleStringProperty(paginas);
        this.id = id;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public StringProperty getCampus() {
        return campus;
    }

    public void setCampus(StringProperty campus) {
        this.campus = campus;
    }

    public StringProperty getNome() {
        return nome;
    }

    public void setNome(StringProperty nome) {
        this.nome = nome;
    }

    public StringProperty getTipo() {
        return tipo;
    }

    public void setTipo(StringProperty tipo) {
        this.tipo = tipo;
    }

    public StringProperty getLocal() {
        return local;
    }

    public void setLocal(StringProperty local) {
        this.local = local;
    }

    public StringProperty getAno() {
        return ano;
    }

    public void setAno(StringProperty ano) {
        this.ano = ano;
    }

    public StringProperty getEditora() {
        return editora;
    }

    public void setEditora(StringProperty editora) {
        this.editora = editora;
    }

    public StringProperty getPaginas() {
        return paginas;
    }

    public void setPaginas(StringProperty paginas) {
        this.paginas = paginas;
    }
    
    
}
