package ch.makery.address.model;

import java.util.Date;
import java.sql.SQLException;

public class Descarte {
    private String motivo;
    private String idFuncionario;
    private int idAcervo;
    private Date data;
    public void descarta(String nomeAcervo, String tipo) throws SQLException, ClassNotFoundException{
            data = new Date();
            ModificaBD bd = new ModificaBD();
            //acervo = bd.retornaId(nomeAcervo);
            if(bd.acervoAtivo(idAcervo)){
                bd.deletaAcervo(idAcervo, tipo);
                bd.guardaDescarte(motivo, data, motivo, idFuncionario);
            }else{
                
            }  
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

    public int getIdAcervo() {
        return idAcervo;
    }

    public void setIdAcervo(int idAcervo) {
        this.idAcervo = idAcervo;
    }

    public Date getData() {
        return data;
    }

    public void setData(Date data) {
        this.data = data;
    }
    
    
}
