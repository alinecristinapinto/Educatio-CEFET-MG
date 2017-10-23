
package relatoriosmultas;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Scanner;

public class RelatoriosMultas {
   
    public static void main(String[] args) throws SQLException {
        BancoDeDados bancoDeDados = new BancoDeDados();
        Scanner sc = new Scanner(System.in);
        
        System.out.println("\n"+"Digite o nome do aluno: ");
        String nome = sc.next();
        
        ResultSet resultadoAluno = bancoDeDados.selecionarRegistros("alunos", "nome", nome);
        resultadoAluno.first();
        ResultSet resultadoEmprestimos = bancoDeDados.selecionarRegistros("emprestimos", "idAluno", resultadoAluno.getString("idCPF"));
       
        System.out.println("\n"+"Coluna 1: Id do aluno, Coluna 2: Multas" );
        while (resultadoEmprestimos.next()) {
           String multa = resultadoEmprestimos.getString("multa");
           System.out.println(nome + " | " + multa);
        }
    }
    
}
