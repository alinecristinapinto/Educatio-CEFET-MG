package relatoriodeatraso.model;

import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

public class Atrasos {

    private final StringProperty nomeAluno;
    private final StringProperty dataPrevisaoDevolucao;
    private final StringProperty dataDevolucao;
    private final StringProperty tempoAtraso;

    public Atrasos(String nomeAluno, String dataPrevisaoDevolucao, String dataDevolucao, String tempoAtraso) {
        this.nomeAluno = new SimpleStringProperty(nomeAluno);
        this.dataPrevisaoDevolucao = new SimpleStringProperty(dataPrevisaoDevolucao);
        this.dataDevolucao = new SimpleStringProperty(dataDevolucao);
        this.tempoAtraso = new SimpleStringProperty(tempoAtraso);
    }

    public StringProperty getDataPrevisaoDevolucao() {
        return dataPrevisaoDevolucao;
    }

    public StringProperty getDataDevolucao() {
        return dataDevolucao;
    }

    public StringProperty getNomeAluno() {
        return nomeAluno;
    }

    public StringProperty getTempoAtraso() {
        return tempoAtraso;
    }

}
