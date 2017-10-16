/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package educatio.app.model.Login;

import java.sql.Blob;

/*
  Grupo: Gerentes
  Data de modificação: 13/10/2017
  Autor: Eduardo Cotta
  Objetivo da modificação: criar instancias da tabela de BD
*/
public class Aluno extends Usuario{
    private String sexo;
    private String nascimento;
    private String logradouro;
    private int numeroLogradouro;
    private String complemento;
    private String bairro;
    private String cidade;
    private int CEP;
    private String UF;
    private String email;
    private Blob fotoAluno;
    private String matricula; 

    public Aluno(String sexo, String nascimento, String logradouro, int numeroLogradouro, String complemento, String bairro, String cidade, int CEP, 
            String UF, String email, Blob fotoAluno, String matricula, String nome, String id){
        
        super(nome, id);
        this.sexo = sexo;
        this.nascimento = nascimento;
        this.logradouro = logradouro;
        this.numeroLogradouro = numeroLogradouro;
        this.complemento = complemento;
        this.bairro = bairro;
        this.cidade = cidade;
        this.CEP = CEP;
        this.UF = UF;
        this.email = email;
        this.fotoAluno = fotoAluno;
        this.matricula = matricula;
    }

    public String getSexo() {
        return sexo;
    }

    public void setSexo(String sexo) {
        this.sexo = sexo;
    }

    public String getNascimento() {
        return nascimento;
    }

    public void setNascimento(String nascimento) {
        this.nascimento = nascimento;
    }

    public String getLogradouro() {
        return logradouro;
    }

    public void setLogradouro(String logradouro) {
        this.logradouro = logradouro;
    }

    public int getNumeroLogradouro() {
        return numeroLogradouro;
    }

    public void setNumeroLogradouro(int numeroLogradouro) {
        this.numeroLogradouro = numeroLogradouro;
    }

    public String getComplemento() {
        return complemento;
    }

    public void setComplemento(String complemento) {
        this.complemento = complemento;
    }

    public String getBairro() {
        return bairro;
    }

    public void setBairro(String bairro) {
        this.bairro = bairro;
    }

    public String getCidade() {
        return cidade;
    }

    public void setCidade(String cidade) {
        this.cidade = cidade;
    }

    public int getCEP() {
        return CEP;
    }

    public void setCEP(int CEP) {
        this.CEP = CEP;
    }

    public String getUF() {
        return UF;
    }

    public void setUF(String UF) {
        this.UF = UF;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public Blob getFotoAluno() {
        return fotoAluno;
    }

    public void setFotoAluno(Blob fotoAluno) {
        this.fotoAluno = fotoAluno;
    }

    public String getMatricula() {
        return matricula;
    }

    public void setMatricula(String matricula) {
        this.matricula = matricula;
    }

    @Override
    public String toString() {
        return super.toString() +"/nAluno{" + "sexo=" + sexo + ", nascimento=" + nascimento + ", logradouro=" + logradouro + ", numeroLogradouro=" + numeroLogradouro + ", complemento=" + complemento + ", bairro=" + bairro + ", cidade=" + cidade + ", CEP=" + CEP + ", UF=" + UF + ", email=" + email + ", fotoAluno=" + fotoAluno + ", matricula=" + matricula + '}';
    }

   
    

    
}
