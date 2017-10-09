package tpfinal;

import java.util.regex.*;
import javax.swing.JOptionPane;

public class TransferirAluno {
    
    private static final Pattern PadraoCPF = Pattern.compile("[0-9]{3}\\.?[0-9]{3}\\.?[0-9]{3}\\-?[0-9]{2}");
    
    public void TransferirAluno(){
        
        boolean flag = false;
        
        do{
            try{
                flag = Pattern.matches(PadraoCPF.toString(), JOptionPane.showInputDialog("Digite o CPF"));
                if (flag == false){
                    throw new ExcecaoCPFInvalido("Digite um CPF valido");
                }
            }
            catch (ExcecaoCPFInvalido e){
                JOptionPane.showMessageDialog(null, e);
            }
        }while(flag == false);
        
        //procurar aluno no BD
        Object[] options = { "Confirmar", "Cancelar" };
        if (JOptionPane.showOptionDialog(null, "Confirme a Transferencia:\n"/*dados do aluno*/, "Confirmação", JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, options, options[0]) == 0){
            //Ativo do aluno = false
            //libera Historico
        }
        
    }
    
}