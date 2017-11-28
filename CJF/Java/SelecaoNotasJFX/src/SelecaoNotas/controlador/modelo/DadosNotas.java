/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package SelecaoNotas.controlador.modelo;

import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 *
 * @author Aluno
 */
public class DadosNotas {
    
    private final StringProperty nomeAluno;
    private final StringProperty cpf;
    private final StringProperty curso;
    private final StringProperty turma;
    private final StringProperty ano;
    private final StringProperty campus;
    private final StringProperty nomeDisciplina;
    private final StringProperty notaEtapa;
    
    
    public DadosNotas() {
      this(null,null,null,null,null,null,null,null);  
    }

    public DadosNotas(String nomeAluno, String cpf,String curso,String turma,String ano,String campus , String nomeDisciplina, String notaEtapa) {
        this.nomeAluno = new SimpleStringProperty(nomeAluno);
        this.cpf = new SimpleStringProperty(cpf);
        this.curso = new SimpleStringProperty(curso);
        this.turma = new SimpleStringProperty(turma);
        this.ano = new SimpleStringProperty(ano);
        this.campus = new SimpleStringProperty(campus);
        this.nomeDisciplina = new SimpleStringProperty(nomeDisciplina);
        this.notaEtapa = new SimpleStringProperty(notaEtapa);
    }
    
    public String getNomeAluno() {
        return nomeAluno.get();
    }
    
    public void setNomeAluno(String nomeAluno) {
        this.nomeAluno.set(nomeAluno);
    }
    
    public StringProperty nomeAlunoProperty() {
        return nomeAluno;
    }
    
    public String getCpf() {
        return cpf.get();
    }
    
    public void setCpf(String cpf) {
        this.cpf.set(cpf);
    }
    
    public StringProperty cpfProperty() {
        return cpf;
    }
    
    public String getCurso() {
        return curso.get();
    }
    
    public void setCurso(String curso) {
        this.curso.set(curso);
    }
    
    public StringProperty cursoProperty() {
        return curso;
    }
    
    public String getTurma() {
        return turma.get();
    }
    
    public void setTurma(String turma) {
        this.turma.set(turma);
    }
    
    public StringProperty turmaProperty() {
        return turma;
    }
    
    public String getAno() {
        return ano.get();
    }
    
    public void setAno(String ano) {
        this.ano.set(ano);
    }
    
    public StringProperty anoProperty() {
        return ano;
    }
    
    public String getCampus() {
        return campus.get();
    }
    
    public void setCampus(String campus) {
        this.campus.set(campus);
    }
    
    public StringProperty campusProperty() {
        return campus;
    }

    public String getNomeDisciplina() {
        return nomeDisciplina.get();
    }
    
    public void setNomeDisciplina(String nomeDisciplina) {
        this.nomeDisciplina.set(nomeDisciplina);
    }
    
    public StringProperty nomeDisciplinaProperty() {
        return nomeDisciplina;
    }
    
    public String getNotaEtapa() {
        return notaEtapa.get();
    }
    
    public void setNotaEtapa(String notaEtapa) {
        this.notaEtapa.set(notaEtapa);
    }
    
    public StringProperty notaEtapaProperty() {
        return notaEtapa;
    }
}
