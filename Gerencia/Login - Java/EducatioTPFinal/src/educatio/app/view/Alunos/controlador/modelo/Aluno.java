package educatio.app.view.Alunos.controlador.modelo;

import javafx.beans.property.IntegerProperty;
import javafx.beans.property.ObjectProperty;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleObjectProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

public class Aluno {
 
    private final StringProperty Nome;
    private final IntegerProperty Turma; 
    private final StringProperty Sexo;
    private final StringProperty Data;
    private final StringProperty CPF;
    private final StringProperty Logradouro;
    private final StringProperty Numero;
    private final StringProperty Complemento;
    private final StringProperty Bairro;
    private final StringProperty Cidade;
    private final StringProperty CEP;
    private final StringProperty UF;
    private final StringProperty Email;

    public Aluno(String Nome, String Sexo, String Data, String CPF, String Logradouro, String Numero, String Complemento, String Bairro, String Cidade, String CEP, String UF, String Email, int Turma) {
        this.Nome = new SimpleStringProperty(Nome);
        this.Sexo = new SimpleStringProperty(Sexo);
        this.Data = new SimpleStringProperty(Data);
        this.CPF = new SimpleStringProperty(CPF);
        this.Logradouro = new SimpleStringProperty(Logradouro);
        this.Numero = new SimpleStringProperty(Numero);
        this.Complemento = new SimpleStringProperty(Complemento);
        this.Bairro = new SimpleStringProperty(Bairro);
        this.Cidade = new SimpleStringProperty(Cidade);
        this.CEP = new SimpleStringProperty(CEP);
        this.UF = new SimpleStringProperty(UF);
        this.Email = new SimpleStringProperty(Email);
        this.Turma = new SimpleIntegerProperty(Turma);
    }

    public StringProperty getNome() {
        return Nome;
    }

    public IntegerProperty getTurma() {
        return Turma;
    }

    public StringProperty getSexo() {
        return Sexo;
    }

    public StringProperty getData() {
        return Data;
    }

    public StringProperty getCPF() {
        return CPF;
    }

    public StringProperty getLogradouro() {
        return Logradouro;
    }

    public StringProperty getNumero() {
        return Numero;
    }

    public StringProperty getComplemento() {
        return Complemento;
    }

    public StringProperty getBairro() {
        return Bairro;
    }

    public StringProperty getCidade() {
        return Cidade;
    }

    public StringProperty getCEP() {
        return CEP;
    }

    public StringProperty getUF() {
        return UF;
    }

    public StringProperty getEmail() {
        return Email;
    }
    
    
}
