package ManutencaoDiarios.Modelo;

import javafx.beans.property.DoubleProperty;
import javafx.beans.property.SimpleDoubleProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 *
 * @author Felipe
 */
public class NotasTabela {
    private StringProperty nomeAluno;
    private DoubleProperty valorAtividade;

    public NotasTabela(String nomeAluno, Double valorAtividade) {
        this.nomeAluno = new SimpleStringProperty(nomeAluno);
        this.valorAtividade = new SimpleDoubleProperty(valorAtividade);
    }

    public StringProperty getNomeAluno() {
        return nomeAluno;
    }

    public void setNomeAluno(StringProperty nomeAluno) {
        this.nomeAluno = nomeAluno;
    }

    public DoubleProperty getValorAtividade() {
        return valorAtividade;
    }

    public void setValorAtividade(DoubleProperty valorAtividade) {
        this.valorAtividade = valorAtividade;
    }
}
