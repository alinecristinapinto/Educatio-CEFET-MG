package blt.java.emprestimo.model;

import javafx.beans.property.IntegerProperty;
import javafx.beans.property.LongProperty;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleLongProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;


/**
 * Classe Model para uma Reserva (reserva).
 *
 * @author Torres
 */
public class Reserva {
    
    private final LongProperty tempoEspera;
    private final IntegerProperty idAcervo;
    private final StringProperty idAluno;
    private final StringProperty dataReserva;

    /**
     *  Construtor padrão.
     */
    public Reserva() {
        this(0, 0L, null, null);
    }

    /**
     * Construtor com os dados inicializados.
     * 
     */
    public Reserva(Integer idAcervo, Long tempoEspera, String idAluno, String dataReserva) {
        this.idAcervo = new SimpleIntegerProperty(idAcervo);
        this.tempoEspera = new SimpleLongProperty(tempoEspera);
        this.idAluno = new SimpleStringProperty(idAluno);
        this.dataReserva = new SimpleStringProperty(dataReserva);
    }


    public int getIdAcervo() {
        return idAcervo.get();
    }

    public void setIdAcervo(int idAcervo) {
        this.idAcervo.set(idAcervo);
    }

    public IntegerProperty idAcervoProperty() {
        return idAcervo;
    }

    public Long getTempoEspera() {
        return tempoEspera.get();
    }

    public void setTempoEspera(Long tempoEspera) {
        this.tempoEspera.set(tempoEspera);
    }

    public LongProperty tempoEsperaProperty() {
        return tempoEspera;
    }

    public String getIdAluno() {
        return idAluno.get();
    }

    public void setIdAluno(String idAluno) {
        this.idAluno.set(idAluno);
    }

    public StringProperty idAlunoProperty() {
        return idAluno;
    }
    
    public String getDataReserva() {
        return dataReserva.get();
    }

    public void setDataReserva(String dataReserva) {
        this.dataReserva.set(dataReserva);
    }

    public StringProperty dataReservaProperty() {
        return dataReserva;
    }
    
}