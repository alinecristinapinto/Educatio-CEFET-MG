/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatorioobrasdescartadas;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Scanner;

/**
 *
 * @author Aluno
 */
public class RelatorioObrasDescartadas {

    /**
     * @param args the command line arguments
     * @throws java.sql.SQLException
     */
    public static void main(String[] args) throws SQLException {
        // TODO code application logic here
        BancoDeDados bancoDeDados = new BancoDeDados();
        Scanner leitor = new Scanner(System.in);
        System.out.println("Digite o nome do livro:");
        String nome = leitor.nextLine();
        ResultSet resultadoAcervo = bancoDeDados.selecionarRegistros("acervo", "nome", nome);
        ResultSet resultadoDescartes = bancoDeDados.selecionarRegistros("descartes", "idAcervo", resultadoAcervo.getString("id"));
        
        System.out.println("Dados do livro: " + nome);
        System.out.println("Funcionario: " + resultadoDescartes.getString("idFuncionario"));
        System.out.println("Data: " + resultadoDescartes.getString("dataDescarte"));
        System.out.println("Motivo: " + resultadoDescartes.getString("motivos"));
    }
    
}






