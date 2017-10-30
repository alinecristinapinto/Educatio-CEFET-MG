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
public class Autores{
    String nome;
    String sobrenome;
    String ordem;
    String qualificacao;

    public Autores() {
    }

    public Autores(String nome, String sobrenome, String ordem, String qualificacao) {
        this.nome = nome;
        this.sobrenome = sobrenome;
        this.ordem = ordem;
        this.qualificacao = qualificacao;
    }

    
    
    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getSobrenome() {
        return sobrenome;
    }

    public void setSobrenome(String sobrenome) {
        this.sobrenome = sobrenome;
    }

    public String getOrdem() {
        return ordem;
    }

    public void setOrdem(String ordem) {
        this.ordem = ordem;
    }

    public String getQualificacao() {
        return qualificacao;
    }

    public void setQualificacao(String qualificacao) {
        this.qualificacao = qualificacao;
    }
    
    
    
}
