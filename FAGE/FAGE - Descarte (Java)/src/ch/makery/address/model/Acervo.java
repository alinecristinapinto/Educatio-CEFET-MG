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
    private Integer idCampi;
    private String tipo;
    private String paginas;
    private String motivo;
    private String idFuncionario;
    private String data;

    public Acervo() {
        
    }
    
    public Acervo(Integer id, Integer idCampi, String nomeAcervo, String tipo, String local, String ano, String editora, String paginas){
        this.idAcervo = new SimpleIntegerProperty(id);
        this.idCampi = idCampi;
        this.nomeAcervo = new SimpleStringProperty(nomeAcervo);
        this.tipo = tipo;
        this.local = new SimpleStringProperty(local);
        this.ano = new SimpleStringProperty(ano);
        this.editora = new SimpleStringProperty(editora);
        this.paginas = paginas;
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

    public IntegerProperty getIdAcervo() {
        return idAcervo;
    }

    @Override
    public String toString() {
        return "Acervo{" + "idAcervo=" + idAcervo.get() + ", nomeAcervo=" + nomeAcervo.get() + ", local=" + local.get() + ", editora=" + editora.get() + ", ano=" + ano.get() + ", idCampi=" + idCampi + ", tipo=" + tipo + ", paginas=" + paginas + ", motivo=" + motivo + ", idFuncionario=" + idFuncionario + ", data=" + data + '}';
    }

    public void setIdAcervo(IntegerProperty idAcervo) {
        this.idAcervo = idAcervo;
    }

    public StringProperty getNomeAcervo() {
        return nomeAcervo;
    }

    public void setNomeAcervo(StringProperty nomeAcervo) {
        this.nomeAcervo = nomeAcervo;
    }

    public StringProperty getLocal() {
        return local;
    }

    public void setLocal(StringProperty local) {
        this.local = local;
    }

    public StringProperty getEditora() {
        return editora;
    }

    public void setEditora(StringProperty editora) {
        this.editora = editora;
    }

    public StringProperty getAno() {
        return ano;
    }

    public void setAno(StringProperty ano) {
        this.ano = ano;
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
