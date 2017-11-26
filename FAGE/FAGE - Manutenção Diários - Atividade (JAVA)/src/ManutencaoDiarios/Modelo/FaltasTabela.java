package ManutencaoDiarios.Modelo;

import javafx.beans.property.IntegerProperty;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 *
 * @author Felipe
 */
public class FaltasTabela {
    private StringProperty nomeAluno;
    private IntegerProperty faltasAluno;

    public FaltasTabela(String nomeAluno, Integer faltasAluno) {
        this.nomeAluno = new SimpleStringProperty(nomeAluno);
        this.faltasAluno = new SimpleIntegerProperty(faltasAluno);
    }

    public StringProperty getNomeAluno() {
        return nomeAluno;
    }

    public void setNomeAluno(StringProperty nomeAluno) {
        this.nomeAluno = nomeAluno;
    }

    public IntegerProperty getFaltasAluno() {
        return faltasAluno;
    }

    public void setFaltasAluno(IntegerProperty faltasAluno) {
        this.faltasAluno = faltasAluno;
    }
    
    
}
