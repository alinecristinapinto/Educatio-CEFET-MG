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

    private final IntegerProperty id;
    private final IntegerProperty idTurma;
    private final IntegerProperty cargaHorariaMin;
    private final StringProperty nome;
    private final StringProperty ativo;
    /**
     *  Construtor padrão.
     */
    public Disciplina() {
        this(0, 0, 0, null, null);
    }

    /**
     * Construtor com alguns dados iniciais.
     *
     * @param firstName Primeiro nome da Pessoa.
     * @param lastName Sobrenome da Pessoa.
     */
    public Disciplina(Integer id, Integer idTurma, Integer cargaHorariaMin, String nome, String ativo) {
        this.id = new SimpleIntegerProperty(id);
        this.idTurma = new SimpleIntegerProperty(idTurma);
        this.cargaHorariaMin = new SimpleIntegerProperty(cargaHorariaMin);
        this.nome = new SimpleStringProperty(nome);
        this.ativo = new SimpleStringProperty(ativo);
    }

    public int getId() {
        return id.get();
    }

    public void setId(int id) {
        this.id.set(id);
    }

    public IntegerProperty idProperty() {
        return id;
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

    public String getAtivo() {
        return ativo.get();
    }

    public void setAtivo(String ativo) {
        this.ativo.set(ativo);
    }

    public StringProperty ativoProperty() {
        return ativo;
    }

}