package tpfinal;

import java.sql.*;
import javax.swing.JOptionPane;


public class TPFinal {

    public static void main(String[] args) throws SQLException, ClassNotFoundException {
        
        int i;
        int j = 0;
        Departamento[] depto = new Departamento[10];
        for(i=0; i<depto.length; i++)
            depto[i]=null;
        int selecionado;
        boolean flag = false;
        boolean fl;

        
        TransferirAluno aluno  = new TransferirAluno();
        ManutencaoDepartamento manDep = new ManutencaoDepartamento();
        
        //depto[j] = manDep.CriarDepartamento();
        //j++;
        
        do{
        Object[] option = { "Criar", "Alterar", "Desativar", "Transferir Aluno", "Cancelar" };
        selecionado = JOptionPane.showOptionDialog(null, "O que gostaria de executar?", "Chamando Função", JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, option, option[0]);
        
        if (selecionado == 0){
            manDep.CriarDepartamento();
            
        }
        
        if (selecionado == 1){
            manDep.AlterarDepartamento();
        }
        
        if (selecionado == 2){
            manDep.InativarDepartamento();
        }
        
        /*if (selecionado == 3){
            manDep.
        }*/
        
        if (selecionado == 3){
            aluno.TransferirAluno();
        }
        }while (selecionado != 4);
    }
    
}
