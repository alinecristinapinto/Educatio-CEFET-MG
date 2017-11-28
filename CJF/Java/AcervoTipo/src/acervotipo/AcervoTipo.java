package acervotipo;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import javax.swing.JOptionPane;

public class AcervoTipo {
    public static void main(String[] args) throws SQLException, Exception {
       try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e){
            System.out.println("Driver nao encontrado!"+e);
        }
        
        //estabelecendo conexao com BD
        Connection conexao = null;
        conexao  =  DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio","root","usbw");
        
        if(conexao  ==  null){
            System.out.println("Status-------->Erro ao conectar!");
            System.exit(0);
        }
        
        Statement executaComando, executaComando1, executaComando2, executaComando3, executaComando4;
        ResultSet rs, resultadoSql1, resultadoSql2, resultadoSql3, resultadoSql4;
        executaComando1  =  conexao.createStatement();
        executaComando2  =  conexao.createStatement();
        executaComando3  =  conexao.createStatement();
        executaComando4  =  conexao.createStatement();
        
        String tipo  =  "";
        
        //COMPARTILHADA POR LIVROS, PERIODICOS, ACADEMICOS E MIDIAS
        int idAcervo;
        
        
        String ativoAcervo  =  "";
        String nome  =  "";
        int campi;
        String ativoAutor  =  "";
        int idAutor  =  0;
        //nome e sobrenome de um autor, compartilhada por todos os tipos - deve ser reiniciada
        
        String autor  =  "";
        int ano;
        String local  =  "";
        String editora  =  "";
        int paginas;
        
        //Variaveis de livros
        String ativoLivro  =  "";
        String ISBN;
        String edicao;
        
        //Variaveis de periodicos
        String ativoPeriodico  =  "";
        String periodicidade  =  "";
        String mes  =  "";
        
        //compartilhado com periodicos, midia
        String subtipo  =  "";
        int volume;
        int ISSN;
        
        //Variaveis de midias
        String ativoMidia  =  "";
        String tempo;
        
        //Variaveis de academicos
        String ativoAcademico  =  "";
        String programa  =  "";
        
        String imprimir = "";
        ArrayList livros, periodicos, academicos, midias;
        livros = new ArrayList();
        periodicos = new ArrayList();
        academicos = new ArrayList();
        midias = new ArrayList();
        
        try{
            executaComando = conexao.createStatement();
            imprimir +=  "\n\nTIPO DO ACERVO::LIVROS";
            rs = executaComando.executeQuery("SELECT idAcervo, ISBN, edicao FROM livros WHERE ativo  =  '"+"S"+"'");
            while(rs.next()){
                idAcervo  =  rs.getInt("idAcervo");
                ISBN  =  rs.getString("ISBN");
                edicao  =  rs.getString("edicao");
                
                
                
                //Dados que estao em acervo
                resultadoSql2  =  executaComando2.executeQuery("SELECT nome, idCampi, local, ano, editora, paginas FROM acervo WHERE id  =  '"+idAcervo+"' AND ativo  =  '"+"S"+"'");
                if(resultadoSql2.next()){
                    
                    nome  =  resultadoSql2.getString("nome");
                    campi  =  resultadoSql2.getInt("idCampi");
                    local  =  resultadoSql2.getString("local");
                    paginas  =  resultadoSql2.getInt("paginas");
                    editora  =  resultadoSql2.getString("editora");
                    
                    livros.add("\nNome: "+nome);
                    livros.add("\nCampi: "+campi);
                    livros.add( "\nLocal: "+local);
                    livros.add("\nPaginas: "+paginas);
                    livros.add("\nEditora: "+editora);
                    
                    imprimir +=  "\n\nNome: "+nome;
                    imprimir +=  "\nCampi: "+campi;
                    imprimir +=  "\nLocal: "+local;
                    imprimir +=  "\nPaginas: "+paginas;
                    imprimir +=  "\nEditora: "+editora;
                    
                    resultadoSql3  =  executaComando3.executeQuery("SELECT idAutor FROM autoracervo WHERE idAcervo = '"+idAcervo+"'");
                    if(resultadoSql3.next()){
                       idAutor  =  resultadoSql3.getInt("idAutor");
                    }
                    resultadoSql3  =  executaComando3.executeQuery("SELECT nome, sobrenome FROM autores WHERE id = '"+idAutor+"' AND ativo  =  '"+"S"+"'");
                    if(resultadoSql3.next()){
                        autor +=  resultadoSql3.getString("nome");
                        autor +=  " "+resultadoSql3.getString("sobrenome");
                        imprimir +=  "\nAutor: "+autor;
                        livros.add( "\nAutor: "+autor);
                        autor  =  "";
                    }
                }
            }
            imprimir +=  "\n\n\nTIPO DO ACERVO::PERIODICOS";
            
            resultadoSql1 = executaComando.executeQuery("SELECT * FROM periodicos WHERE ativo  =  '"+"S"+"'");
            while(resultadoSql1.next()){
                idAcervo  =  resultadoSql1.getInt("idAcervo");
                periodicidade  =  resultadoSql1.getString("periodicidade");
                mes  =  resultadoSql1.getString("mes");
                volume  =  resultadoSql1.getInt("volume");
                subtipo  =  resultadoSql1.getString("subtipo");
                ISSN  =  resultadoSql1.getInt("ISSN");
                
                imprimir +=  "\nPeriodicidade: "+periodicidade+"\nmes: "+mes+"\nvolume: "+volume+"\nsubtipo: "+subtipo+"\nISSN: "+ISSN;
                
                //Dados que estao em acervo
                resultadoSql2  =  executaComando2.executeQuery("SELECT nome, idCampi, local, ano, editora, paginas FROM acervo WHERE id  =  '"+idAcervo+"' AND ativo  =  '"+"S"+"'");
                if(resultadoSql2.next()){
                    
                    nome  =  resultadoSql2.getString("nome");
                    campi  =  resultadoSql2.getInt("idCampi");
                    local  =  resultadoSql2.getString("local");
                    paginas  =  resultadoSql2.getInt("paginas");
                    editora  =  resultadoSql2.getString("editora");
                    
                    periodicos.add("\nNome: "+nome);
                    periodicos.add("\nCampi: "+campi);
                    periodicos.add( "\nLocal: "+local);
                    periodicos.add("\nPaginas: "+paginas);
                    periodicos.add("\nEditora: "+editora);
                    
                    imprimir +=  "\n\nNome: "+nome;
                    imprimir +=  "\nCampi: "+campi;
                    imprimir +=  "\nLocal: "+local;
                    imprimir +=  "\nPaginas: "+paginas;
                    imprimir += "\nEditora: " +editora;
                    
                    resultadoSql3 = executaComando3.executeQuery("SELECT idAutor FROM autoracervo WHERE idAcervo = '"+idAcervo+"'");
                    if(resultadoSql3.next()){
                       idAutor  =  resultadoSql3.getInt("idAutor");
                    }
                    resultadoSql3  =  executaComando3.executeQuery("SELECT nome, sobrenome FROM autores WHERE id = '"+idAutor+"' AND ativo  =  '"+"S"+"'");
                    if(resultadoSql3.next()){
                        autor +=  resultadoSql3.getString("nome");
                        autor +=  " "+resultadoSql3.getString("sobrenome");
                        periodicos.add("\nAutor: "+autor);
                        imprimir += "\nAutor: "+autor;
                        autor  =  "";
                    }
                }
            }
            
            
            
            imprimir += "\n\nTIPO DO ACERVO::MIDIAS";
            rs = executaComando.executeQuery("SELECT * FROM midias WHERE ativo  = '"+"S"+"'");
            while(rs.next()){
                idAcervo  =  rs.getInt("idAcervo");
                tempo  =  rs.getString("tempo");
                subtipo  =  rs.getString("subtipo");
                imprimir += "\nTempo: "+tempo+"\nSubtipo: "+subtipo;
                 resultadoSql2  =  executaComando2.executeQuery("SELECT nome, idCampi, local, ano, editora, paginas FROM acervo WHERE id  =  '"+idAcervo+"' AND ativo  =  '"+"S"+"'");
                if(resultadoSql2.next()){
                    
                    nome  =  resultadoSql2.getString("nome");
                    campi  =  resultadoSql2.getInt("idCampi");
                    local  =  resultadoSql2.getString("local");
                    paginas  =  resultadoSql2.getInt("paginas");
                    editora  =  resultadoSql2.getString("editora");
                    
                    midias.add("\nNome: "+nome);
                    midias.add("\nCampi: "+campi);
                    midias.add( "\nLocal: "+local);
                    midias.add("\nPaginas: "+paginas);
                    midias.add("\nEditora: "+editora);
                    
                    
                    imprimir +=  "\n\nNome: "+nome;
                    imprimir +=  "\nCampi: "+campi;
                    imprimir +=  "\nLocal: "+local;
                    imprimir +=  "\nPaginas: "+paginas;
                    imprimir +=  "\nEditora: "+editora;
                    
                    resultadoSql3  =  executaComando3.executeQuery("SELECT idAutor FROM autoracervo WHERE idAcervo = '"+idAcervo+"'");
                    if(resultadoSql3.next()){
                       idAutor  =  resultadoSql3.getInt("idAutor");
                    }
                    resultadoSql3  =  executaComando3.executeQuery("SELECT nome, sobrenome FROM autores WHERE id = '"+idAutor+"' AND ativo  =  '"+"S"+"'");
                    if(resultadoSql3.next()){
                        autor +=  resultadoSql3.getString("nome");
                        autor +=  " "+resultadoSql3.getString("sobrenome");
                        imprimir += "\nAutor: "+autor;
                        midias.add("\nAutor: "+autor);
                        autor  =  "";
                    }
                } 
            }
            
            imprimir +=  "\n\nTIPO DO ACERVO::ACADEMICOS";
            rs  =  executaComando.executeQuery("SELECT * FROM academicos WHERE ativo ='"+"S"+"'");
            while(rs.next()){
                idAcervo  =  rs.getInt("idAcervo");
                programa  =  rs.getString("programa");

                imprimir +=  "\nPrograma: "+programa;
                resultadoSql2  =  executaComando2.executeQuery("SELECT nome, idCampi, local, ano, editora, paginas FROM acervo WHERE id  =  '"+idAcervo+"' AND ativo  =  '"+"S"+"'");
                if(resultadoSql2.next()){
                    
                    nome  =  resultadoSql2.getString("nome");
                    campi  =  resultadoSql2.getInt("idCampi");
                    local  =  resultadoSql2.getString("local");
                    paginas  =  resultadoSql2.getInt("paginas");
                    editora  =  resultadoSql2.getString("editora");
                    
                    
                    academicos.add("\nNome: "+nome);
                    academicos.add("\nCampi: "+campi);
                    academicos.add( "\nLocal: "+local);
                    academicos.add("\nPaginas: "+paginas);
                    academicos.add("\nEditora: "+editora);
                    
                    
                    imprimir +=  "\n\nNome: "+nome;
                    imprimir +=  "\nCampi: "+campi;
                    imprimir +=  "\nLocal: "+local;
                    imprimir +=  "\nPaginas: "+paginas;
                    imprimir +=  "\nEditora: "+editora;
                    
                    resultadoSql3  =  executaComando3.executeQuery("SELECT idAutor FROM autoracervo WHERE idAcervo = '"+idAcervo+"'");
                    if(resultadoSql3.next()){
                       idAutor  =  resultadoSql3.getInt("idAutor");
                    }
                    resultadoSql3  =  executaComando3.executeQuery("SELECT nome, sobrenome FROM autores WHERE id = '"+idAutor+"' AND ativo  =  '"+"S"+"'");
                    if(resultadoSql3.next()){
                        autor +=  resultadoSql3.getString("nome");
                        autor +=  " "+resultadoSql3.getString("sobrenome");
                        academicos.add("\nAutor: "+autor);
                        imprimir +=  "\nAutor: "+autor;
                        autor  =  "";
                    }
                }
            }
            
            int resposta  =  Integer.parseInt(JOptionPane.showInputDialog(null, "Deseja: \n1-exibir na tela  \n2-ou imprimir"));
            switch (resposta){
                    case 1:
                        System.out.println(imprimir);
                        break;
                        
                    case 2:
                        GeraPdfAcervoTipo impressao  =  new GeraPdfAcervoTipo(livros, periodicos, academicos, midias);
                        impressao.imprimindo();
                        break;
                        
                    default:
                        System.out.println(imprimir);
                        break;
            }
            
        }catch(SQLException ex){
            //System.out.println("SQLExeption: "+ ex.getMessage());
            //System.out.println("SQLState: "+ ex.getSQLState());
            //System.out.println("VendorError : "+ ex.getErrorCode());
        }
    }
}
