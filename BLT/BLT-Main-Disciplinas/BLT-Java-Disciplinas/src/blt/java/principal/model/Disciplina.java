package blt.java.principal.model;


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


    private final IntegerProperty idTurma;
    private final IntegerProperty cargaHorariaMin;
    private final StringProperty nome;

    /**
     *  Construtor padrão.
     */
    public Disciplina() {
        this(0, 0, null);
    }

    /**
     * Construtor com alguns dados iniciais.
     *
     * @param firstName Primeiro nome da Pessoa.
     * @param lastName Sobrenome da Pessoa.
     */
    public Disciplina(Integer idTurma, Integer cargaHorariaMin, String nome) {
        this.idTurma = new SimpleIntegerProperty(idTurma);
        this.cargaHorariaMin = new SimpleIntegerProperty(cargaHorariaMin);
        this.nome = new SimpleStringProperty(nome);
    }


    public int getIdTurma() {
        return idTurma.get();
    }

    public void setIdTurma(int idTurma) {
        this.idTurma.set(idTurma);
    }

    public IntegerProperty idTurmaProperty() {
        return idTurma;
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

    public int getCargaHorariaMin() {
        return cargaHorariaMin.get();
    }

    public void setCargaHorariaMin(int cargaHorariaMin) {
        this.cargaHorariaMin.set(cargaHorariaMin);
    }

    public IntegerProperty cargaHorariaMinProperty() {
        return cargaHorariaMin;
    }


}