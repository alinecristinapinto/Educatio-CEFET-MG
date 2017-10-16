/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package educatio.app.model.Login;

/**
 *
 * @author 7
 */
public class Professor extends Usuario{
    private String idDepto;
    private String titulacao;

    public Professor(String idDepto, String titulacao, String nome, String id) {
        super(nome, id);
        this.idDepto = idDepto;
        this.titulacao = titulacao;
    }
    
}
