package tpfinal;

import javax.swing.JOptionPane;


public class TPFinal {

    public static void main(String[] args) {
        
        int i;
        int j = 0;
        Departamento[] depto = new Departamento[10];
        int selecionado;
        boolean flag = false;
        boolean fl;
        
        TransferirAluno aluno  = new TransferirAluno();
        ManutencaoDepartamento manDep = new ManutencaoDepartamento();
        depto[j] = manDep.CriarDepartamento();
        j++;
        do{
        Object[] option = { "Criar", "Alterar", "Desativar", "Procurar Departamento", "Mostrar Dados", "Transferir Aluno", "Cancelar" };
        selecionado = JOptionPane.showOptionDialog(null, "O que gostaria de alterar?", "Alterar", JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, option, option[0]);
        
        if (selecionado == 0){
            depto[j]=manDep.CriarDepartamento();
            j++;
        }
        
        if (selecionado == 1){
            manDep.AlterarDepartamento(depto);
        }
        
        if (selecionado == 2){
            manDep.InativarDepartamento(depto);
        }
        
        int IDDept = 0;
        if (selecionado == 3){
            do{
                fl = false;
                try{
                IDDept = Integer.parseInt(JOptionPane.showInputDialog("Digite o ID do departamento"));
                for (i=0; i<depto.length; i++){
                    if(depto[i].getId()==IDDept && flag == false){
                        IDDept = i;
                        flag = true;
                    }
                }
                }
                catch(NumberFormatException e){
                fl = true;
                }
            }while (fl == true);
            JOptionPane.showMessageDialog(null, depto[IDDept].paraString());
        }
        
        if(selecionado == 4){
            String tudo = "";
            for (i=0; i<depto.length; i++){
                if (depto[i] != null){
                tudo += "\n\n\n"+depto[i].paraString();
                }
            }
            JOptionPane.showMessageDialog(null, tudo);
        }
        
        if (selecionado == 5){
            aluno.TransferirAluno();
        }
        }while (selecionado != 6);
    }
    
}
