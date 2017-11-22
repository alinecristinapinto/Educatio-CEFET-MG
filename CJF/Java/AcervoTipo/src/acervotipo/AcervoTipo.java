package acervotipo;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Properties;
import javax.swing.JOptionPane;

public class AcervoTipo {
    public static void main(String[] args) throws SQLException {
       try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e){
            System.out.println("Driver nao encontrado!"+e);
        }
        
        //estabelecendo conexao com BD
        Connection connection=null;
        connection = DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio","root","usbw");
        
        if(connection == null){
            System.out.println("Status-------->Erro ao conectar!");
            System.exit(0);
        }
        
        Statement stmt, stmt1, stmt2, stmt3, stmt4;//variaveis para executar comandos sql relativos ao BD
        ResultSet rs, rs1, rs2, rs3, rs4;//variaveis para receber dados do BD
        stmt1 = connection.createStatement();
        stmt2 = connection.createStatement();
        stmt3 = connection.createStatement();
        stmt4 = connection.createStatement();
        
        String tipo = "";
        
        int idAcervo;//COMPARTILHADA POR LIVROS, PERIODICOS, ACADEMICOS E MIDIAS
        
        
        String ativoAcervo = "";
        String nome = "";
        int campi;
        String ativoAutor = "";
        int idAutor = 0;
        String autor = "";//nome e sobrenome de um autor, compartilhada por todos os tipos - deve ser reiniciada
        int ano;
        String local = "";
        String editora = "";
        int paginas;
        
        //Variaveis de livros
        String ativoLivro = "";
        String ISBN;
        String edicao;
        
        //Variaveis de periodicos
        String ativoPeriodico = "";
        String periodicidade = "";
        String mes = "";
        String subtipo = "";//compartilhado com periodicos, midia
        int volume;
        int ISSN;
        
        //Variaveis de midias
        String ativoMidia = "";
        String tempo;
        
        //Variaveis de academicos
        String ativoAcademico = "";
        String programa = "";
        
        try{
            //JOptionPane.showMessageDialog(null, "Chegou nessa linha1");
            stmt=connection.createStatement();
            //JOptionPane.showMessageDialog(null, "Chegou nessa linha2");
            System.out.println("TIPO DO ACERVO:::LIVROS");
            rs=stmt.executeQuery("SELECT idAcervo, ISBN, edicao FROM livros WHERE ativo = '"+"S"+"'");
            while(rs.next()){
                idAcervo = rs.getInt("idAcervo");
                ISBN = rs.getString("ISBN");
                edicao = rs.getString("edicao");
                
                //Dados que estao em acervo
                rs2 = stmt2.executeQuery("SELECT nome, idCampi, local, ano, editora, paginas FROM acervo WHERE id = '"+idAcervo+"' AND ativo = '"+"S"+"'");
                if(rs2.next()){
                    
                    nome = rs2.getString("nome");
                    campi = rs2.getInt("idCampi");
                    local = rs2.getString("local");
                    paginas = rs2.getInt("paginas");
                    editora = rs2.getString("editora");
                    
                    
                    System.out.print("\nNome: "+nome);
                    System.out.print("\nCampi: "+campi);
                    System.out.print("\nLocal: "+local);
                    System.out.print("\nPaginas: "+paginas);
                    System.out.println("\nEditora: "+editora);
                    
                    rs3 = stmt3.executeQuery("SELECT idAutor FROM autoracervo WHERE idAcervo='"+idAcervo+"'");
                    if(rs3.next()){
                       idAutor = rs3.getInt("idAutor");
                    }
                    rs3 = stmt3.executeQuery("SELECT nome, sobrenome FROM autores WHERE id='"+idAutor+"' AND ativo = '"+"S"+"'");
                    if(rs3.next()){
                        autor += rs3.getString("nome");
                        autor += " "+rs3.getString("sobrenome");
                        System.out.println("Autor: "+autor);
                        autor = "";
                    }
                }//Fim do RS2
            }//Fim de periodicos
            
            System.out.println("\n\nTIPO DO ACERVO::PERIODICOS");
            
            rs1=stmt.executeQuery("SELECT * FROM periodicos WHERE ativo = '"+"S"+"'");
            while(rs1.next()){
                idAcervo = rs1.getInt("idAcervo");
                periodicidade = rs1.getString("periodicidade");
                mes = rs1.getString("mes");
                volume = rs1.getInt("volume");
                subtipo = rs1.getString("subtipo");
                ISSN = rs1.getInt("ISSN");
                System.out.print("\nPeriodicidade: "+periodicidade+"\nmes: "+mes+"\nvolume: "+volume+"\nsubtipo: "+subtipo+"\nISSN: "+ISSN);
                //Dados que estao em acervo
                rs2 = stmt2.executeQuery("SELECT nome, idCampi, local, ano, editora, paginas FROM acervo WHERE id = '"+idAcervo+"' AND ativo = '"+"S"+"'");
                if(rs2.next()){
                    
                    nome = rs2.getString("nome");
                    campi = rs2.getInt("idCampi");
                    local = rs2.getString("local");
                    paginas = rs2.getInt("paginas");
                    editora = rs2.getString("editora");
                    
                    
                    System.out.print("\nNome: "+nome);
                    System.out.print("\nCampi: "+campi);
                    System.out.print("\nLocal: "+local);
                    System.out.print("\nPaginas: "+paginas);
                    System.out.println("\nEditora: "+editora);
                    
                    rs3=stmt3.executeQuery("SELECT idAutor FROM autoracervo WHERE idAcervo='"+idAcervo+"'");
                    if(rs3.next()){
                       idAutor = rs3.getInt("idAutor");
                    }
                    rs3 = stmt3.executeQuery("SELECT nome, sobrenome FROM autores WHERE id='"+idAutor+"' AND ativo = '"+"S"+"'");
                    if(rs3.next()){
                        autor += rs3.getString("nome");
                        autor += " "+rs3.getString("sobrenome");
                        System.out.println("Autor: "+autor);
                        autor = "";
                    }
                }//Fim do RS2
            }//fim de periodicos
            
            
            
            System.out.println("\n\nTIPO DO ACERVO::MIDIAS");
            
            rs=stmt.executeQuery("SELECT * FROM midias WHERE ativo ='"+"S"+"'");
            while(rs.next()){
                idAcervo = rs.getInt("idAcervo");
                tempo = rs.getString("tempo");
                subtipo = rs.getString("subtipo");
                System.out.print("\nTempo: "+tempo+"\nSubtipo: "+subtipo);
                 rs2 = stmt2.executeQuery("SELECT nome, idCampi, local, ano, editora, paginas FROM acervo WHERE id = '"+idAcervo+"' AND ativo = '"+"S"+"'");
                if(rs2.next()){
                    
                    nome = rs2.getString("nome");
                    campi = rs2.getInt("idCampi");
                    local = rs2.getString("local");
                    paginas = rs2.getInt("paginas");
                    editora = rs2.getString("editora");
                    
                    
                    System.out.print("\nNome: "+nome);
                    System.out.print("\nCampi: "+campi);
                    System.out.print("\nLocal: "+local);
                    System.out.print("\nPaginas: "+paginas);
                    System.out.println("\nEditora: "+editora);
                    
                    rs3 = stmt3.executeQuery("SELECT idAutor FROM autoracervo WHERE idAcervo='"+idAcervo+"'");
                    if(rs3.next()){
                       idAutor = rs3.getInt("idAutor");
                    }
                    rs3 = stmt3.executeQuery("SELECT nome, sobrenome FROM autores WHERE id='"+idAutor+"' AND ativo = '"+"S"+"'");
                    if(rs3.next()){
                        autor += rs3.getString("nome");
                        autor += " "+rs3.getString("sobrenome");
                        System.out.println("Autor: "+autor);
                        autor = "";
                    }
                }//Fim do RS2  
            }//fim de midias
            
            
            System.out.println("\n\nTIPO DO ACERVO::ACADEMICOS");
            
            rs = stmt.executeQuery("SELECT * FROM academicos");
            while(rs.next()){
                idAcervo = rs.getInt("idAcervo");
                programa = rs.getString("programa");
                System.out.print("\nPrograma: "+programa);
                rs2 = stmt2.executeQuery("SELECT nome, idCampi, local, ano, editora, paginas FROM acervo WHERE id = '"+idAcervo+"' AND ativo = '"+"S"+"'");
                if(rs2.next()){
                    
                    nome = rs2.getString("nome");
                    campi = rs2.getInt("idCampi");
                    local = rs2.getString("local");
                    paginas = rs2.getInt("paginas");
                    editora = rs2.getString("editora");
                    
                    
                    System.out.print("\nNome: "+nome);
                    System.out.print("\nCampi: "+campi);
                    System.out.print("\nLocal: "+local);
                    System.out.print("\nPaginas: "+paginas);
                    System.out.println("\nEditora: "+editora);
                    
                    rs3 = stmt3.executeQuery("SELECT idAutor FROM autoracervo WHERE idAcervo='"+idAcervo+"'");
                    if(rs3.next()){
                       idAutor = rs3.getInt("idAutor");
                    }
                    rs3 = stmt3.executeQuery("SELECT nome, sobrenome FROM autores WHERE id='"+idAutor+"' AND ativo = '"+"S"+"'");
                    if(rs3.next()){
                        autor += rs3.getString("nome");
                        autor += " "+rs3.getString("sobrenome");
                        System.out.println("Autor: "+autor);
                        autor = "";
                    }
                }//Fim do RS2
            }//fim de periodicos
            
        }catch(SQLException ex){
            System.out.println("SQLExeption: "+ ex.getMessage());
            System.out.println("SQLState: "+ ex.getSQLState());
            System.out.println("VendorError : "+ ex.getErrorCode());
        }
    }
}
