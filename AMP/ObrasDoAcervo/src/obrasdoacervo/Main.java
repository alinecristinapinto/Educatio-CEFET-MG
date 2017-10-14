/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package obrasdoacervo;

import java.sql.*;
import java.util.Scanner;

/**
 *
 * @author Aluno
 */
public class Main {
    public static void main(String[] args) throws SQLException{
        try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        }catch (ClassNotFoundException e) {
            System.out.println("Driver não encontrado!"+e);
        }
        System.out.println("Driver encontrado com sucesso!");
        
        Connection connection = null;
        System.out.println("null");
        connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "usbw");
        if (connection != null){
            System.out.println("Conexão realizada com sucesso");
        }else{
            System.out.println("Não foi possível realizar a conexão");
        }
                
        String ISBN; String edicao; int idObra; int idCampi; String nome; String tipo; String local; String ano; String editora; String paginas;
        // TODO code application logic here
        System.out.println("\n\nTeste com Livros");
        Scanner ent = new Scanner (System.in);
        
        System.out.println("Escreva os dados: Strings sem espaço pelo amor de deus");
        System.out.println("Isbn:");
            ISBN = ent.next();
        System.out.println("Edicao:");
            edicao = ent.next();
            edicao += ent.nextLine();
        System.out.println("Idobra:");
            idObra = ent.nextInt();
        System.out.println("IdCampi:");
            idCampi = ent.nextInt();
        System.out.println("Nome: ");
            nome = ent.next();
            nome += ent.nextLine();
        System.out.println("Tipo: ");
            tipo = ent.next();
            tipo += ent.nextLine();
        System.out.println("Local: ");
            local = ent.next();
            local += ent.nextLine();
        System.out.println("Ano: ");
            ano = ent.next();
            ano += ent.nextLine();
        System.out.println("Editora: ");
            editora = ent.next();
            editora += ent.nextLine();
        System.out.println("Paginas: ");
            paginas = ent.next();
            paginas += ent.nextLine();
        
        Livros testes = new Livros (ISBN,  edicao, idObra,  idCampi,  nome,  tipo,  local,  ano,  editora,  paginas);
        
        
        System.out.println("Dados do livro \n" + testes);
                
        //
    }
}
