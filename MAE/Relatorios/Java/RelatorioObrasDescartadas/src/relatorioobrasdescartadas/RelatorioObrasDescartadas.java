/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package relatorioobrasdescartadas;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Scanner;

/*
    Grupo:​ ​ MAE.
    Data​ ​ de​ ​ modificação:​ ​ 24/10/2017.
    Autor:​ ​Matheus Quintão Santiago.
    ​Objetivo​ ​ da​ ​ modificação:​ ​ Padronizando o codigo e comentando.
*/
public class RelatorioObrasDescartadas {
    public static void main(String[] args) throws SQLException {
        
        // Instancia o Banco de Dados.
        BancoDeDados bancoDeDados = new BancoDeDados();
        Scanner leitor = new Scanner(System.in);
        
        // Recebe do ususario o nome do livro.
        System.out.println("Digite o nome do livro:");
        String nome = leitor.nextLine();
        
        // Seleciono tudo da tabela acervo que tenha o mesmo nome do livro que o usuario passou.
        ResultSet resultadoAcervo = bancoDeDados.selecionarRegistros("acervo", "nome", nome);
        
        // Seleciono tudo da tabela descartes que tenha o mesmo idAcervo do livro que o usuario passou.
        ResultSet resultadoDescartes = bancoDeDados.selecionarRegistros("descartes", "idAcervo", resultadoAcervo.getString("id"));
        
        // Imprime na tela os dados do livro.
        System.out.println("Dados do livro " + nome);
        System.out.println("Funcionario que fez o descarte: " + resultadoDescartes.getString("idFuncionario"));
        System.out.println("Data do descarte: " + resultadoDescartes.getString("dataDescarte"));
        System.out.println("Motivo do descarte: " + resultadoDescartes.getString("motivos"));
    }
    
}






