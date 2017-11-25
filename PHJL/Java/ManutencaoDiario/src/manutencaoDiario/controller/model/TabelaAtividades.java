package manutencaoDiario.controller.model;

import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

public class TabelaAtividades {
    
    private final StringProperty Conteudo;
    private final StringProperty Atividade;
    private final StringProperty Data;
    private final StringProperty Nota;

    public TabelaAtividades(String Conteudo, String Atividade, String Data, String Nota) {
        this.Conteudo = new SimpleStringProperty(Conteudo);
        this.Atividade =  new SimpleStringProperty(Atividade);
        this.Data =  new SimpleStringProperty(Data);
        this.Nota =  new SimpleStringProperty(Nota);
    }

    public StringProperty getConteudo() {
        return Conteudo;
    }

    public StringProperty getAtividade() {
        return Atividade;
    }

    public StringProperty getData() {
        return Data;
    }

    public StringProperty getNota() {
        return Nota;
    }
    
    
}
