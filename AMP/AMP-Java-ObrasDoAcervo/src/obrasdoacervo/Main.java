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
        connection = DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        if (connection != null){
            System.out.println("Conexão realizada com sucesso");
        }else{
            System.out.println("Não foi possível realizar a conexão");
        }
         
        /* 
        
        String ISBN;
        String edicao;
        int idObra;
        int idCampi;
        int idAutor;
        String nome;
        String local;
        String ano;
        String editora;
        String paginas;
        
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
        System.out.println("IdAutor:");
            idAutor = ent.nextInt();
        System.out.println("Nome: ");
            nome = ent.next();
            nome += ent.nextLine();

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
        */
            
        // Obras obras = new Obras(idCampi,  nome,  tipo,  local,  ano,  editora,  paginas);
        //Livros testes = new Livros (ISBN,  edicao, idCampi, idAutor, nome,  "livros",  local,  ano,  editora,  paginas);
        //Livros t1 = new Livros (ISBN,  edicao, idCampi, idAutor, nome,  "livros",  local,  ano,  editora,  paginas);
        //Livros t2 = new Livros (ISBN,  edicao, idCampi, idAutor, nome,  "livros",  local,  ano,  editora,  paginas);
        Partes testes = new Partes("Parte 1", 1, 20, "keywords", "Semanal", "Outubro", 2, "Edital", 1234, 1, "Parte 1", "periodicos", "Belo Horizonte", "2000", "Arqueiro", "20");
        //System.out.println("Dados do livro \n" + testes);
        System.out.println("\n\n");
        InserePartes(connection, testes);
        System.out.println("\n Insere 1 \n");
        Remove(connection, 35, "periodicos");
        System.out.println("\n Remove 2 \n");
        Altera(connection, 1, "acervo", "nome", "EMOCIONADO");
        System.out.println("\n Altera 3 \n");
    }

    public static void Insere (Connection connection, Obras obras){
        Statement stmt = null;
        // ResultSet rs = null;
        String sql = "INSERT INTO acervo(idCampi, nome,  tipo,  local,  ano,  editora,  paginas, ativo) VALUES(" + obras.idCampi + ", '" + obras.nome + 
               "', " + obras.tipo + ", '" + obras.local + "', '" + obras.ano + "', '" + obras.editora + "', '" + obras.paginas + "', 'S')";
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
       stmt.execute(sql);

        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Obras obras = new Obras (livro.idCampi, livro.nome,  "'livro'",  livro.local,  livro.ano,  livro.editora,  livro.paginas);
        Insere(connection, obras);
    }
    
    public static void InsereMidias (Connection connection, Midias midia){
        int id;
        Statement stmt = null;
        // ResultSet rs = null;
        // String sql = "INSERT INTO midias(idAcervo, tempo, subtipo, ativo) VALUES(" + (id + 1) + ", " + midia.tempo + 
        //       ", " + midia.subtipo + ", 'S')";
        // String sql = "SELECT *  FROM acervo";
        
        try{
        stmt = connection.createStatement();
        ResultSet rs = null;
        String findId = "SELECT *  FROM acervo";
        rs = stmt.executeQuery(findId);
        rs.last();
        id = rs.getInt("id");
        String sql = "INSERT INTO midias(idAcervo, tempo, subtipo, ativo) VALUES(" + (id + 1) + ", " + midia.tempo + 
               ", " + midia.subtipo + ", 'S')";
        // rs = stmt.executeQuery(sql);
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Obras obras = new Obras (midia.idCampi, midia.nome,  "'midias'",  midia.local,  midia.ano,  midia.editora,  midia.paginas);
        Insere(connection, obras);
    }
    
    public static void InsereAcademicos (Connection connection, Academicos academicos){
        int id;
        Statement stmt = null;
        // ResultSet rs = null;
        //String sql = "INSERT INTO academicos(idAcervo, programa, ativo) VALUES(" + (id + 1) + ", " + academicos.programa + ", 'S')";
        // String sql = "SELECT *  FROM acervo";
        
        try{
        stmt = connection.createStatement();
        ResultSet rs = null;
        String findId = "SELECT *  FROM acervo";
        rs = stmt.executeQuery(findId);
        rs.last();
        id = rs.getInt("id");
        // rs = stmt.executeQuery(sql);
        String sql = "INSERT INTO academicos(idAcervo, programa, ativo) VALUES(" + (id + 1) + ", " + academicos.programa + ", 'S')";
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Obras obras = new Obras (academicos.idCampi, academicos.nome,  "'academicos'",  academicos.local,  academicos.ano,  academicos.editora,  academicos.paginas);
        Insere(connection, obras);
    }
    
    public static void InserePeriodicos (Connection connection, Periodicos periodicos){
        int id;
        Statement stmt = null;
        // ResultSet rs = null;
        //String sql = "INSERT INTO periodicos(idAcervo, periodicidade, mes, volume, subtipo, ISSN, ativo) VALUES(" + (id + 1) + ", " + periodicos.periodicidade + 
        //       ", " + periodicos.mes + ", " + periodicos.volume + ", " + periodicos.subtipo + ", " + periodicos.ISSN + ", 'S')";
        // String sql = "SELECT *  FROM acervo";
        
        try{
        stmt = connection.createStatement();
        ResultSet rs = null;
        String findId = "SELECT *  FROM acervo";
        rs = stmt.executeQuery(findId);
        rs.last();
        id = rs.getInt("id");
        // rs = stmt.executeQuery(sql);
        String sql = "INSERT INTO periodicos(idAcervo, periodicidade, mes, volume, subtipo, ISSN, ativo) VALUES('" + (id + 1) + "', '" + periodicos.periodicidade + 
               "', '" + periodicos.mes + "', '" + periodicos.volume + "', '" + periodicos.subtipo + "', '" + periodicos.ISSN + "', 'S')";
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Obras obras = new Obras (periodicos.idCampi, periodicos.nome,  "'periodicos'",  periodicos.local,  periodicos.ano,  periodicos.editora,  periodicos.paginas);
        Insere(connection, obras);
    }
    
    public static void InserePartes (Connection connection, Partes partes){
        int id;
        Statement stmt = null;
        // ResultSet rs = null;
        //String sql = "INSERT INTO partes(idAcervo, titulo, pagInicio, pagFinal, palavrasChave, ativo) VALUES(" + (id + 1) + ", " + partes.titulo + 
        //       ", " + partes.pagInicio + ", " + partes.pagFinal + ", " + partes.palavrasChave + ", 'S')";
        // String sql = "SELECT *  FROM acervo";
        
        try{
        stmt = connection.createStatement();
        ResultSet rs = null;
        String findId = "SELECT *  FROM periodicos";
        rs = stmt.executeQuery(findId);
        rs.last();
        id = rs.getInt("id");
        // rs = stmt.executeQuery(sql);
        String sql = "INSERT INTO partes(idPeriodico, titulo, pagInicio, pagFinal, palavrasChave, ativo) VALUES('" + (id + 1) + "', '" + partes.titulo + 
               "', '" + partes.pagInicio + "', '" + partes.pagFinal + "', '" + partes.palavrasChave + "', 'S')";
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Periodicos periodicos = new Periodicos (partes.periodicidade, partes.mes, partes.volume, partes.subtipo, partes.ISSN, partes.idCampi, partes.nome, "'periodicos'", partes.local, partes.ano, partes.editora, partes.paginas);
        InserePeriodicos(connection, periodicos);
    }
    
    public static void InsereAutores (Connection connection, Autores autores){
        int id;
        Statement stmt = null;
        // ResultSet rs = null;
        //String sql = "INSERT INTO autores(idAcervo, nome,  sobrenome,  local,  ordem, qualificacao, ativo) VALUES(" + id + ", " + autores.nome + ", " + autores.sobrenome + 
        //      ", " + autores.local + ", " + autores.ordem + ", " + autores.qualificacao + ", 'S')";
        // String sql = "SELECT *  FROM acervo";
        
        
        try{
        stmt = connection.createStatement();
        ResultSet rs = null;
        String findId = "SELECT *  FROM acervo";
        rs = stmt.executeQuery(findId);
        rs.last();
        id = rs.getInt("id");
        // rs = stmt.executeQuery(sql);
        String sql = "INSERT INTO autores(idAcervo, nome,  sobrenome,  local,  ordem, qualificacao, ativo) VALUES(" + id + ", " + autores.nome + ", " + autores.sobrenome + 
               ", " + autores.local + ", " + autores.ordem + ", " + autores.qualificacao + ", 'S')";
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
    }
    
    public static void Remove (Connection connection, int ident, String tabela){
        String sql = "UPDATE " + tabela + " SET ativo='N' WHERE idAcervo=" + ident;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        
        RemoveAcervo(connection, ident);
        
    }
    
    public static void RemoveAcervo (Connection connection, int ident){
        String sql = "UPDATE acervo SET ativo='N' WHERE id=" + ident;
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
        String sql = "UPDATE " + tabela + " SET " + campo + "='" + valor + "' WHERE id=" + ident;
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
