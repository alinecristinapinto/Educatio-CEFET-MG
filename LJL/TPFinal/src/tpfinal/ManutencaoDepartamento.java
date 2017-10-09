package tpfinal;

import javax.swing.JOptionPane;


public class ManutencaoDepartamento {
    
    public Departamento CriarDepartamento(){
        
        
        int IdCampus = 0;
        String nome = null;
        boolean fl;
        
        
        do{
            fl = false;
            try{
                IdCampus = Integer.parseInt(JOptionPane.showInputDialog("Id do campus do novo Departamento"));
            }
            catch(NumberFormatException e){
                JOptionPane.showMessageDialog(null, "Digite um INTEIRO!\n"+e);
                fl=true;
            }
        }while(fl==true);
        
        do{
            fl = false;
            try{
                nome = JOptionPane.showInputDialog("Nome do novo Departamento");
                if (nome == null){
                    throw new ExcecaoNomeNulo("Dê um nome ao departamento!");
                }
            }catch (ExcecaoNomeNulo e){
                JOptionPane.showMessageDialog(null, e);
                fl=true;
            }
        }while(fl==true);
        
        
        Object[] options = { "Confirmar", "Cancelar" };
        if (JOptionPane.showOptionDialog(null, "Confirme a criação:\nLocalizado no campus: "+IdCampus+"\nNome: "+nome, "Confirmação", JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, options, options[0]) == 0){
            Departamento depto = new Departamento (IdCampus, nome);
            return depto;
        }
        return null;
        
    }
    
    public Departamento CriarDepartamento(int IdCampus, String nome){
        
        Object[] options = { "Confirmar", "Cancelar" };
        if (JOptionPane.showOptionDialog(null, "Confirme a criação:\nLocalizado no campus: "+IdCampus+"\nNome: "+nome, "Confirmação", JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, options, options[0]) == 0){
            Departamento depto = new Departamento (1, "null");
            return depto;
        }
        return null;
        
    }
    
    
    public void AlterarDepartamento(Departamento[] depto){
        int IDAlterar = 0;
        boolean fl = false;
        boolean flagID = false;
        boolean flagExc;
        boolean flag = false;
        int i;
        
        try{
            IDAlterar = Integer.parseInt(JOptionPane.showInputDialog("Digite o ID do departamento a ser alterado"));
            for (i=0; i<depto.length; i++){
                if(depto[i].getId()==IDAlterar && flagID == false){
                    IDAlterar = i;
                    flagID = true;
                }
            }
        }
        catch(NumberFormatException e){
            fl = true;
        }

        //if (fl = false && flagID == true){
            Object[] options = { "Confirmar", "Cancelar" };
            if (JOptionPane.showOptionDialog(null, "Deseja realmente alterar o departamento?\nID do departamento: "+depto[IDAlterar].getId()+"\nLocalizado no campus: "+depto[IDAlterar].getIdCampi()+"\nNome: "+depto[IDAlterar].getNome(), "Confirmação", JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, options, options[0]) == 0){
            
                Object[] option = { "Nome", "Campus", "Cancelar" };
                int selecionado = JOptionPane.showOptionDialog(null, "O que gostaria de alterar?", "Alterar", JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, option, option[0]);
            
                if (selecionado == 0){
                    do{
                        flagExc = false;
                        try{
                            depto[IDAlterar].setNome(JOptionPane.showInputDialog("Digite o novo nome"));
                            if (depto[IDAlterar].getNome() == null){
                                throw new ExcecaoNomeNulo("Digite um nome!");
                            }
                        }
                        catch (ExcecaoNomeNulo e){
                        JOptionPane.showMessageDialog(null, e);
                        flagExc=true;
                        }
                    }while(flagExc==true);
            
                    if (selecionado == 1){
                        depto[IDAlterar].setIdCampi(Integer.parseInt(JOptionPane.showInputDialog("Digite o novo campus")));
                    }
                
                }
            }
        //}
    }
    
    public void InativarDepartamento(Departamento[] depto){
        
        int i;
        int IDDel = 0;
        boolean fl = false;
        boolean flagID = false;
        
        try{
            IDDel = Integer.parseInt(JOptionPane.showInputDialog("Digite o ID do departamento a ser Desativado"));
            for (i=0; i<depto.length; i++){
                if(depto[i].getId()==IDDel && flagID == false){
                    IDDel = i;
                    flagID = true;
                }
            }
        }
        catch(NumberFormatException e){
            fl = true;
        }
        
        //if (fl = false && flagID == true){
            Object[] options = { "Confirmar", "Cancelar" };
            if (JOptionPane.showOptionDialog(null, "Deseja realmente alterar o departamento?\nID do departamento: "+depto[IDDel].getId()+"\nLocalizado no campus: "+depto[IDDel].getIdCampi()+"\nNome: "+depto[IDDel].getNome(), "Confirmação", JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, options, options[0]) == 0){
                depto[IDDel].setAtivo(false);
                //desativar outros grupos
            }
        //}    
    }
    
}
