package ch.makery.address.model;

import java.util.List;
import javafx.beans.property.IntegerProperty;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;

/**
 *
 * @author Arthur
 */
public class Acervo {
    
    private IntegerProperty idAcervo;
    private StringProperty nomeAcervo;
    private StringProperty local;
    private StringProperty editora;
    private StringProperty ano;
    private String tipo;
    private String motivo;
    private String idFuncionario;
    private String data;

    public Acervo() {
        
    }
    
    public Acervo(Integer id, String nome, String local, String editora, String ano){
        this.idAcervo = new SimpleIntegerProperty(id);
        this.nomeAcervo = new SimpleStringProperty(nome);
        this.local = new SimpleStringProperty(local);
        this.editora = new SimpleStringProperty(editora);
        this.ano = new SimpleStringProperty(ano);
    }
    
    public void setTudo(Integer id, String nomeAcervo, String local, String editora, String ano, String tipo, String motivo, String idFuncionario, String data){
        this.idAcervo = new SimpleIntegerProperty(id);
        this.nomeAcervo = new SimpleStringProperty(nomeAcervo);
        this.local = new SimpleStringProperty(local);
        this.editora = new SimpleStringProperty(editora);
        this.ano = new SimpleStringProperty(ano);
        this.tipo = tipo;
        this.motivo = motivo;
        this.idFuncionario = idFuncionario;
        this.data = data;
    }

    @Override
    public String toString() {
        return "Acervo{" + "idAcervo=" + idAcervo + ", nomeAcervo=" + nomeAcervo + ", local=" + local + ", editora=" + editora + ", ano=" + ano + ", tipo=" + tipo + ", motivo=" + motivo + ", idFuncionario=" + idFuncionario + ", data=" + data + '}';
    }
    
    public Integer getIdAcervo() {
        return idAcervo.get();
    }
    
    public String getNomeAcervo() {
        return nomeAcervo.get();
    }

    public String getLocal() {
        return local.get();
    }

    public String getEditora() {
        return editora.get();
    }

    public String getAno() {
        return ano.get();
    }

    public String getTipo() {
        return tipo;
    }

    public void setTipo(String tipo) {
        this.tipo = tipo;
    }

    public String getMotivo() {
        return motivo;
    }

    public void setMotivo(String motivo) {
        this.motivo = motivo;
    }

    public String getIdFuncionario() {
        return idFuncionario;
    }

    public void setIdFuncionario(String idFuncionario) {
        this.idFuncionario = idFuncionario;
    }

    public String getData() {
        return data;
    }

    public void setData(String data) {
        this.data = data;
    }
    
    
}
