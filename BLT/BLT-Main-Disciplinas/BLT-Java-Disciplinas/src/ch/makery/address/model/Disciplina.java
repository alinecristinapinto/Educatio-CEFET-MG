package ch.makery.address.model;


import javafx.beans.property.IntegerProperty;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 * Classe Model para uma Person (pessoa).
 *
 * @author Marco Jakob
 */
public class Disciplina {

    private final StringProperty nome;
    private final StringProperty professor;
    private final IntegerProperty numeroAlunos;
    private final StringProperty campus;
    private final StringProperty curso;
    /**
     *  Construtor padrão.
     */
    public Disciplina() {
        this(null, null, 0, null, null);
    }

    /**
     * Construtor com alguns dados iniciais.
     *
     * @param firstName Primeiro nome da Pessoa.
     * @param lastName Sobrenome da Pessoa.
     */
    public Disciplina(String nome, String professor, Integer numeroAlunos, String campus, String curso) {
        this.nome = new SimpleStringProperty(nome);
        this.professor = new SimpleStringProperty(professor);
        this.numeroAlunos = new SimpleIntegerProperty(numeroAlunos);
        this.campus = new SimpleStringProperty(campus);
        this.curso = new SimpleStringProperty(curso);
    }

    public String getNome() {
        return nome.get();
    }

    public void setNome(String nome) {
        this.nome.set(nome);
    }

    public StringProperty nomeProperty() {
        return nome;
    }

    public String getProfessor() {
        return professor.get();
    }

    public void setProfessor(String professor) {
        this.professor.set(professor);
    }

    public StringProperty professorProperty() {
        return professor;
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

    public int getNumeroAlunos() {
        return numeroAlunos.get();
    }

    public void setNumeroAlunos(int numeroAlunos) {
        this.numeroAlunos.set(numeroAlunos);
    }

    public IntegerProperty numeroAlunosProperty() {
        return numeroAlunos;
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

}