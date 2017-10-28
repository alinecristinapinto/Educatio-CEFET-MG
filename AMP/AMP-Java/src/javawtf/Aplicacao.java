
package javawtf;

import java.sql.SQLException;
import javax.swing.JOptionPane;


public class Aplicacao {

    
    public static void main(String[] args) throws SQLException {
        
        String determinante;
        String determinado;                     
        
        Professor p1 = new Professor(0, 00000, "Augusto", "Fundamental", "senha1");  
        
        Professor p2 = new Professor(1, 00001, "Pedro", "Doutorado", "senha2");
        
        Professor p3 = new Professor(2, 00002, "Morato", "Superior", "senha3");
                 
        FuncoesProfessorBD FuncProf1 = new FuncoesProfessorBD(p1);
        
        FuncProf1.abrebd();               
                           
        FuncProf1.adicionaProfessor();
        
        FuncProf1.setP1(p2);
        
        FuncProf1.adicionaProfessor();
        
        FuncProf1.setP1(p3);
        
        FuncProf1.adicionaProfessor();  
        
        JOptionPane.showMessageDialog(null, "'setando' um professor inativo"); 
        determinante = JOptionPane.showInputDialog(null, "insira a tabela");
        determinado = JOptionPane.showInputDialog(null, "insira o dado da tabela");
        
        FuncProf1.deletaProfessor(determinante,determinado);
        
        JOptionPane.showMessageDialog(null, "pesquisando "); 
        determinante = JOptionPane.showInputDialog(null, "insira a tabela");
        determinado = JOptionPane.showInputDialog(null, "insira o dado da tabela");
        
        FuncProf1.pesquisaProfessor(determinante, determinado);
        
        JOptionPane.showMessageDialog(null, "pesquisa com mais de um resultado "); 
        determinante = JOptionPane.showInputDialog(null, "insira a tabela");
        determinado = JOptionPane.showInputDialog(null, "insira o dado da tabela");
        
        FuncProf1.pesquisaProfessor(determinante, determinado);
        
        FuncProf1.alteraProfessor("idDepto", "0", "titulacao", "Mestrado");
        
        FuncProf1.fechabd();
        
    }
    
}
