package manutencaoAluno.controller;

import java.time.format.DateTimeFormatter;
import javafx.scene.control.DatePicker;
import javafx.scene.control.ToggleGroup;

public class AlteraDados {

    public AlteraDados() {
    }

    public String alteraDataDeNascimento(DatePicker data) {
        return data.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy"));
    }

    public String alteraSexo(ToggleGroup sexo) {
        String temporario = sexo.getSelectedToggle().toString();
        String formataSexo[] = temporario.split("'");
        return formataSexo[1];
    }

    public String remove(String Texto, String RegExp) {
        String Retorno = "";
        String String_1 = Texto;
        String Trechos[];

        Trechos = String_1.split(RegExp);

        for (String Trecho : Trechos) {
            Retorno += Trecho;
        }

        return Retorno;
    }
}
