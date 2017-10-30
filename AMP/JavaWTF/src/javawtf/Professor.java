
package javawtf;

import javax.swing.JOptionPane;


public class Professor {
    public int siape;
    public int depto;    
    public String nome;
    public String titulacao;   
    public String ativo = "";
    public String hierarquia = "Professor";
    public String senha;
    
    
        public Professor(int siape, int depto, String nome, String titulacao, String senha){
            this.siape = siape;
            this.depto = depto;
            this.nome = nome;
            this.titulacao = titulacao;
            this.senha = senha;
        }

        public Professor() {
       
        }

        public void tostring(){
            JOptionPane.showMessageDialog(null, "Dados do professor: \nNome: " + nome + "\nDepto: " + depto + "\nidSiape: " + siape + "\nTitulação: " + titulacao + "\nAtivo: " + ativo + "\nHierarquia: " + hierarquia + "\nSenha: " + senha);
        }
    
}
