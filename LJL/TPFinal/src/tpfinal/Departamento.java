package tpfinal;

import javax.swing.JOptionPane;


public class Departamento {
    
    private boolean ativo;
    private int IdCampi;
    private int Id;
    private String Nome;
    private static int IdContador=0;
    
    public Departamento(int IdCampi, String Nome){
        this.IdCampi = IdCampi;
        this.Nome = Nome;
        Id  = IdContador;
        IdContador++;
        ativo = true;
        JOptionPane.showMessageDialog(null, "Departamento criado!\nID: "+Id+"\nNome: "+this.Nome+"\nCampus: "+this.IdCampi+"\nAtivo: "+ativo);
    }

    public String paraString(){
        return "Departamento "+Id+":\nID: "+Id+"\nNome: "+this.Nome+"\nCampus: "+this.IdCampi+"\nAtivo: "+ativo;
    }
    
    public int getIdCampi() {
        return IdCampi;
    }

    public void setIdCampi(int IdCampi) {
        this.IdCampi = IdCampi;
    }


    public int getId() {
        return Id;
    }

    public void setId(int Id) {
        this.Id = Id;
    }


    public String getNome() {
        return Nome;
    }

    public void setNome(String Nome) {
        this.Nome = Nome;
    }


    public static int getIdContador() {
        return IdContador;
    }


    public boolean isAtivo() {
        return ativo;
    }

    public void setAtivo(boolean ativo) {
        this.ativo = ativo;
    }
    
}
