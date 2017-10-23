
import java.sql.*;
import javax.swing.JOptionPane;

/**
 *
 * @author Aluno
 */
public class ManutencaoDiariosAtividades {
    
    public static void main(String[] args) throws ClassNotFoundException, SQLException {
        int idProfessor;
        int flag;
        double valorAtividade;
        String nomeTurma;
        String nomeDisciplina;
        String nomeNovoAtividade;
        String nomeAtividade;
        String dataAtividade;
        Atividade atividade = new Atividade();
        
        
        flag = Integer.parseInt(JOptionPane.showInputDialog("Digite 1 para inserir, 2 para alterar e 3 para remover"));
        switch(flag){
            case 1:
                idProfessor = Integer.parseInt(JOptionPane.showInputDialog("Insira o seu SIAPE"));
                nomeDisciplina = JOptionPane.showInputDialog("Insira o nome da disciplina");
                nomeTurma = JOptionPane.showInputDialog("Insira o nome da turma");
                nomeAtividade = JOptionPane.showInputDialog("Insira o nome da atividade");
                dataAtividade = JOptionPane.showInputDialog("Insira a data em que a atividade irá ocorrer");
                valorAtividade = Double.parseDouble(JOptionPane.showInputDialog("Insira o valor da atividade"));
                
                atividade.insereAtividade(nomeDisciplina, nomeAtividade, dataAtividade, valorAtividade, idProfessor, nomeTurma);
                
                break;
                
            case 2:
                int tempFlag;
                
                idProfessor = Integer.parseInt(JOptionPane.showInputDialog("Insira o seu SIAPE"));
                nomeAtividade = JOptionPane.showInputDialog("Insira o nome da atividade que deseja alterar");
                nomeDisciplina = JOptionPane.showInputDialog("Insira o nome da disciplina referente a atividade");
                nomeTurma = JOptionPane.showInputDialog("Insira o nome da turma");
                
                tempFlag = Integer.parseInt(JOptionPane.showInputDialog("Digite 1 para alterar o nome, 2 para alterar o valor e 3 para alterar a data"));
                
                switch(tempFlag){
                    case 1:
                        nomeNovoAtividade = JOptionPane.showInputDialog("Insira o novo nome da atividade");
                        atividade.alteraNomeAtividade(nomeNovoAtividade, nomeAtividade, nomeDisciplina, idProfessor, nomeTurma);
                        
                        break;
                    
                    case 2:
                        valorAtividade = Double.parseDouble(JOptionPane.showInputDialog("Insira o novo valor da atividade"));
                        atividade.alteraValorAtividade(valorAtividade, nomeAtividade, nomeDisciplina, idProfessor, nomeTurma);
                        
                        break;
                    
                    case 3:
                        dataAtividade = JOptionPane.showInputDialog("Insira a nova data da atividade");
                        atividade.alteraDataAtividade(dataAtividade, nomeAtividade, nomeDisciplina, idProfessor, nomeTurma);
                        
                        break;
                }
                
                break;
                
            case 3:
                idProfessor = Integer.parseInt(JOptionPane.showInputDialog("Insira o seu SIAPE"));
                nomeAtividade = JOptionPane.showInputDialog("Insira o nome da atividade que deseja alterar");
                nomeDisciplina = JOptionPane.showInputDialog("Insira o nome da disciplina referente a atividade");
                nomeTurma = JOptionPane.showInputDialog("Insira o nome da turma");
                
                atividade.removeAtividade(nomeAtividade, nomeDisciplina, idProfessor, nomeTurma);
                
                break;
        }
    }
}
