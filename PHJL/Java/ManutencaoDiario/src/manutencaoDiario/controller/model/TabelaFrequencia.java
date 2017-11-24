package manutencaoDiario.controller.model;

import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

public class TabelaFrequencia {

    private final StringProperty Data;
    private final StringProperty Falta;

    public TabelaFrequencia(String Data, String Falta) {
        this.Data = new SimpleStringProperty(Data);
        this.Falta = new SimpleStringProperty(Falta);
    }

    public StringProperty getData() {
        return Data;
    }

    public StringProperty getFalta() {
        return Falta;
    }

}
