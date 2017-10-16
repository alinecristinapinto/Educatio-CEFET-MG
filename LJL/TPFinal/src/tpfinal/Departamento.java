package tpfinal;


import java.sql.*;


public class Departamento {
    
    private int IdCampi;
    private String Nome;

    
    public Departamento(int IdCampi, String Nome) throws SQLException{
        this.IdCampi = IdCampi;
        this.Nome = Nome;
    }

    
    public int getIdCampi() {
        return IdCampi;
    }

    public void setIdCampi(int IdCampi) {
        this.IdCampi = IdCampi;
    }


    public String getNome() {
        return Nome;
    }

    public void setNome(String Nome) {
        this.Nome = Nome;
    }
    
}
