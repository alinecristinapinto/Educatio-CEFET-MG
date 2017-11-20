
package relatoriosmultas;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Scanner;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;

public class RelatoriosMultas {
   
    public static void main(String[] args) throws SQLException {
        BancoDeDados bancoDeDados = new BancoDeDados();
        Scanner sc = new Scanner(System.in);
        ObservableList<Object> a = FXCollections.observableArrayList();
        ObservableList<Object> b = FXCollections.observableArrayList();
        
        System.out.println("\n"+"Digite o nome do aluno: ");
        String nome = sc.next();
        
        ResultSet resultadoAluno = bancoDeDados.selecionarRegistros("alunos", "nome", nome);
        resultadoAluno.first();
        ResultSet resultadoEmprestimos = bancoDeDados.selecionarRegistros("emprestimos", "idAluno", resultadoAluno.getString("idCPF"));
       
        System.out.println("\n"+"Coluna 1: Id do aluno, Coluna 2: Multas" );
        while (resultadoEmprestimos.next()) {
           a.add(resultadoEmprestimos.getString("multa"));
           b.add(resultadoEmprestimos.getString("aluno"));
        }
    }
    
}
