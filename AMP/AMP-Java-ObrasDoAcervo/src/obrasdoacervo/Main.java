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
    
    private static int id = 0;
    
    public static void main(String[] args) throws SQLException{
        try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        }catch (ClassNotFoundException e) {
            System.out.println("Driver não encontrado!"+e);
        }
        System.out.println("Driver encontrado com sucesso!");
        
        Connection connection = null;
        connection = DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        if (connection != null){
            System.out.println("Conexão realizada com sucesso");
        }else{
            System.out.println("Não foi possível realizar a conexão");
        }
                
        String ISBN; String edicao; int idObra; int idCampi; String nome; String tipo; String local; String ano; String editora; String paginas;
        // TODO code application logic here
        System.out.println("\n\nTeste com Livros");
        Scanner ent = new Scanner (System.in);
        
        System.out.println("Escreva os dados: ");
        System.out.println("Isbn:");
            ISBN = ent.next();
        System.out.println("Edicao:");
            edicao = ent.next();
            edicao += ent.nextLine();      
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
        
            
        // Obras obras = new Obras(idCampi,  nome,  tipo,  local,  ano,  editora,  paginas);
        Livros testes = new Livros (ISBN,  edicao, idCampi,  nome,  tipo,  local,  ano,  editora,  paginas);
        //System.out.println("Dados do livro \n" + testes);
        InsereLivro(connection, testes);
        // Remove(connection, 4);
    }

    public static void Insere (Connection connection, Obras obras){
        Statement stmt = null;
        // ResultSet rs = null;
        String sql = "INSERT INTO acervo(idCampi, nome,  tipo,  local,  ano,  editora,  paginas, ativo) VALUES(" + obras.idCampi + ", " + obras.nome + 
               ", " + obras.tipo + ", " + obras.local + ", " + obras.ano + ", " + obras.editora + ", " + obras.paginas + ", 'S')";
        // String sql = "SELECT *  FROM acervo";
        
        
        try{
        stmt = connection.createStatement();
        // rs = stmt.executeQuery(sql);
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
    }
    
    public static void InsereLivro (Connection connection, Livros livro) throws SQLException{
        int id;
        Statement stmt = connection.createStatement();
        ResultSet rs = null;
        String sql;
        String findId = "SELECT *  FROM acervo";
        
        try{
        rs = stmt.executeQuery(findId);
        rs.last();
        id = rs.getInt("id");
        sql = "INSERT INTO livros(idAcervo, ISBN, edicao, ativo) VALUES(" + (id + 1) + ", " + livro.ISBN + 
              ", " + livro.edicao + ", 'S')";
        
        stmt = connection.createStatement();
        // rs = stmt.executeQuery(sql);
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Obras obras = new Obras (livro.idCampi,  livro.nome,  "livro",  livro.local,  livro.ano,  livro.editora,  livro.paginas);
        Insere(connection, obras);
    }
    
    public static void InsereMidias (Connection connection, Midias midia){
        Statement stmt = null;
        // ResultSet rs = null;
        String sql = "INSERT INTO midias(idAcervo, tempo, subtipo, ativo) VALUES(" + (id + 1) + ", " + midia.tempo + 
               ", " + midia.subtipo + ", 'S')";
        // String sql = "SELECT *  FROM acervo";
        
        try{
        stmt = connection.createStatement();
        // rs = stmt.executeQuery(sql);
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Obras obras = new Obras (midia.idCampi,  midia.nome,  "midias",  midia.local,  midia.ano,  midia.editora,  midia.paginas);
        Insere(connection, obras);
    }
    
    public static void InsereAcademicos (Connection connection, Academicos academicos){
        Statement stmt = null;
        // ResultSet rs = null;
        String sql = "INSERT INTO academicos(idAcervo, programa, ativo) VALUES(" + (id + 1) + ", " + academicos.programa + ", 'S')";
        // String sql = "SELECT *  FROM acervo";
        
        try{
        stmt = connection.createStatement();
        // rs = stmt.executeQuery(sql);
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Obras obras = new Obras (academicos.idCampi,  academicos.nome,  "academicos",  academicos.local,  academicos.ano,  academicos.editora,  academicos.paginas);
        Insere(connection, obras);
    }
    
    public static void InserePeriodicos (Connection connection, Periodicos periodicos){
        Statement stmt = null;
        // ResultSet rs = null;
        String sql = "INSERT INTO periodicos(idAcervo, periodicidade, mes, volume, subtipo, ISSN, ativo) VALUES(" + (id + 1) + ", " + periodicos.periodicidade + 
               ", " + periodicos.mes + ", " + periodicos.volume + ", " + periodicos.subtipo + ", " + periodicos.ISSN + ", 'S')";
        // String sql = "SELECT *  FROM acervo";
        
        try{
        stmt = connection.createStatement();
        // rs = stmt.executeQuery(sql);
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Obras obras = new Obras (periodicos.idCampi,  periodicos.nome,  "periodicos",  periodicos.local,  periodicos.ano,  periodicos.editora,  periodicos.paginas);
        Insere(connection, obras);
    }
    
    public static void InserePartes (Connection connection, Partes partes){
        Statement stmt = null;
        // ResultSet rs = null;
        String sql = "INSERT INTO partes(idAcervo, titulo, pagInicio, pagFinal, palavrasChave, ativo) VALUES(" + (id + 1) + ", " + partes.titulo + 
               ", " + partes.pagInicio + ", " + partes.pagFinal + ", " + partes.palavrasChave + ", 'S')";
        // String sql = "SELECT *  FROM acervo";
        
        try{
        stmt = connection.createStatement();
        // rs = stmt.executeQuery(sql);
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Periodicos periodicos = new Periodicos (partes.periodicidade, partes.mes, partes.volume, partes.subtipo, partes.ISSN, partes.idCampi, partes.nome, partes.tipo, partes.local, partes.ano, partes.editora, partes.paginas);
        Insere(connection, periodicos);
    }
    
    public static void InsereAutores (Connection connection, Autores autores){
        Statement stmt = null;
        // ResultSet rs = null;
        String sql = "INSERT INTO autores(idAcervo, nome,  sobrenome,  local,  ordem, qualificacao, ativo) VALUES(" + id + ", " + autores.nome + ", " + autores.sobrenome + 
               ", " + autores.local + ", " + autores.ordem + ", " + autores.qualificacao + ", 'S')";
        // String sql = "SELECT *  FROM acervo";
        
        
        try{
        stmt = connection.createStatement();
        // rs = stmt.executeQuery(sql);
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
    }
    
    public static void Remove (Connection connection, int ident, String tabela){
        String sql = "UPDATE " + tabela + " SET ativo='N' WHERE id=" + ident;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        
    }
    
    public static void Altera (Connection connection, int ident, String tabela, String campo, String valor){
        String sql = "UPDATE " + tabela + " SET " + campo +"=" + valor + " WHERE id=" + ident;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        
    }
}
