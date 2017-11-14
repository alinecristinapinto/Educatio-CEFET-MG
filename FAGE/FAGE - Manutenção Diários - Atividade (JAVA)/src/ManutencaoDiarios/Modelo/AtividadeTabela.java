package ManutencaoDiarios.Modelo;

import javafx.beans.property.DoubleProperty;
import javafx.beans.property.SimpleDoubleProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 *
 * @author Felipe
 */
public class AtividadeTabela {
    private StringProperty nome;
    private StringProperty data;
    private DoubleProperty valor;

    public AtividadeTabela(String nome, String data, Double valor) {
        this.nome = new SimpleStringProperty(nome);
        this.data = new SimpleStringProperty(data);
        this.valor = new SimpleDoubleProperty(valor);
    }
    
    public StringProperty getNome() {
        return nome;
    }

    public void setNome(StringProperty nome) {
        this.nome = nome;
    }

    public StringProperty getData() {
        return data;
    }

    public void setData(StringProperty data) {
        this.data = data;
    }

    public DoubleProperty getValor() {
        return valor;
    }

    public void setValor(DoubleProperty valor) {
        this.valor = valor;
    }
    
}
