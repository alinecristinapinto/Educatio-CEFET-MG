/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package manutençãodeturmas;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Scanner;

/**
 *
 * @author mathe
 */
public class ManutencaoDeTurmas {

    /**
     * @param args the command line arguments
     * @throws java.sql.SQLException
     */
    public static void main(String[] args) throws SQLException {
        // TODO code application logic here
        BancoDeDados bancoDeDados = new BancoDeDados();
        System.out.println("Digite 1 para criar, 2 para apagar e 3 para alterar uma turma: ");
        Scanner leitor = new Scanner(System.in);
        switch(leitor.nextInt()){
            case 1:
                System.out.println("\n"+"Digite o nome da turma: ");
                String nome = leitor.next();

                System.out.println("\n"+"Digite o id da turma: ");
                int id = leitor.nextInt();

                System.out.println("\n"+"Digite o id do curso da turma: ");
                int idCurso = leitor.nextInt();

                bancoDeDados.criaTurma(id, idCurso, nome);
                break;
            case 2:
                System.out.println("\n"+"Digite o id da turma: ");
                id = leitor.nextInt();
                
                bancoDeDados.apagaTurma(id);
                break;
                
            case 3:
                
                System.out.println("Digite o nome da turma turma: ");
                nome = leitor.next();
                ResultSet resultado = bancoDeDados.selecionarRegistros("turmas", "nome", nome);
                resultado.first();
                if("S".equals(resultado.getString("ativo"))){
                    System.out.println("Digite 1 para alterar o id, 2 para o id do curso e 3 para o nome da turma: ");
                    switch(leitor.nextInt()){
                        case 1:
                            System.out.println("Digite o novo valor: ");
                            bancoDeDados.alteraTurma("id", leitor.nextInt(), resultado.getString("id"));
                            break;
                        case 2:
                            System.out.println("Digite o novo valor: ");
                            bancoDeDados.alteraTurma("idCurso", leitor.nextInt(), resultado.getString("idCurso"));
                            break;
                        case 3:
                            System.out.println("Digite o novo valor: ");
                            bancoDeDados.alteraTurma("nome", leitor.next(), resultado.getString("nome"));
                            break;
                        default:
                            System.out.println("Valor invalido.");
                    }
                }
                else
                    System.out.println("A turma ja foi apagada.");
                
                break;
            default:
                System.out.println("Valor invalido.");
        }
        


    }
    
}
