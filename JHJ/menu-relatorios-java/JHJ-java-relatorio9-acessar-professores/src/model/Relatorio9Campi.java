package model;
import javafx.beans.property.IntegerProperty;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.beans.property.StringProperty;


public class Relatorio9Campi {
 
    private int idCampus;
    private String nomeCampus;
    private String cidade;
    private String ufCampus;

    public Relatorio9Campi(Integer idCampus,String nomeCampus, String cidade, String uf ) {
        this.idCampus = idCampus;
        this.nomeCampus = nomeCampus;
        this.cidade = cidade;
        this.ufCampus = uf;
    }

    public Relatorio9Campi() {
    	idCampus=0;
    	nomeCampus=null;
    	cidade=null;
    	ufCampus=null;
    }

	public int getIdCampus() {
		return idCampus;
	}

	public String getNomeCampus() {
		return nomeCampus;
	}

	public String getCidade() {
		return cidade;
	}

	public String getUfCampus() {
		return ufCampus;
	}


	public void setNome(String nome) {
        this.nomeCampus=nome;
    }
	public void setIdCampus(int id) {
		this.idCampus=id;
	}
	public void setCidade(String cidade) {
		this.cidade=cidade;
	}
	public void setUf(String ufCampus) {
		this.ufCampus=ufCampus;
	}


}
