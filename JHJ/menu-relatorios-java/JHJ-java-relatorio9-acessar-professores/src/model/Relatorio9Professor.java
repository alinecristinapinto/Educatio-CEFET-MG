package model;

import javafx.beans.property.IntegerProperty;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;


public class Relatorio9Professor {

    
    


    private SimpleStringProperty nomeProfessor;
    private SimpleStringProperty nomeDisciplina;
    private SimpleIntegerProperty cargaHorariaMin;

    /**
     *  Construtor padrao.
     */
    public Relatorio9Professor() {
        nomeProfessor = new SimpleStringProperty();
        nomeDisciplina = new SimpleStringProperty();
        cargaHorariaMin = new SimpleIntegerProperty();
    }

    /**
     * Construtor com dados.
     */
    public Relatorio9Professor(String nomeProfessor, String nomeDisciplina, int cargaHorariaMin ) {
        this.cargaHorariaMin = new SimpleIntegerProperty(cargaHorariaMin);
        this.nomeProfessor = new SimpleStringProperty(nomeProfessor);
        this.nomeDisciplina = new SimpleStringProperty(nomeDisciplina);
    }


   

    public String getNomeProfessor() {
        return nomeProfessor.get();
    }

    public void setNomeProfessor(String nome) {
        this.nomeProfessor.set(nome);
    }

    public StringProperty nomeProfessorProperty() {
        return nomeProfessor;
    }

    public String getNomeDisciplina() {
        return nomeDisciplina.get();
    }

    public void setNomeDisciplina(String nome) {
        this.nomeDisciplina.set(nome);
    }

    public StringProperty nomeDisciplinaProperty() {
        return nomeDisciplina;
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