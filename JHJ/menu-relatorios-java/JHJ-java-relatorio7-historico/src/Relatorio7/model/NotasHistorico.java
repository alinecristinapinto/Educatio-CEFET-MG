package Relatorio7.model;

import javafx.beans.property.SimpleStringProperty;

public class NotasHistorico {
    private SimpleStringProperty disciplina;
    private SimpleStringProperty nota;
    private SimpleStringProperty ano;
    private SimpleStringProperty cargaHoraria;
    private SimpleStringProperty frequencia;


    public NotasHistorico(String disciplina, String nota, String ano, String cargaHoraria, String frequencia) {
        this.disciplina = new SimpleStringProperty(disciplina);
        this.nota = new SimpleStringProperty(nota);
        this.ano = new SimpleStringProperty(ano);
        this.cargaHoraria = new SimpleStringProperty(cargaHoraria);
        this.frequencia = new SimpleStringProperty(frequencia);
    }

    public String getNota() {
        return nota.get();
    }
    public void setNota(String nota) {
        this.nota.set(nota);
    }

    
    public String getDisciplina() {
        return disciplina.get();
    }
    public void setDisciplina(String disciplina) {
        this.disciplina.set(disciplina);
    }

    
    public String getAno() {
        return ano.get();
    }
    public void setAno(String ano) {
        this.ano.set(ano);
    }
    
    
    public String getCargaHoraria() {
        return cargaHoraria.get();
    }
    public void setCargaHoraria(String cargaHoraria) {
        this.cargaHoraria.set(cargaHoraria);
    }
    
    
    public String getFrequencia() {
        return frequencia.get();
    }
    public void setFrequencia(String frequencia) {
        this.frequencia.set(frequencia);
    }

}
