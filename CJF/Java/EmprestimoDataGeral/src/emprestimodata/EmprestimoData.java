
package emprestimodata;

import java.sql.Connection;

import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Date;
import javax.swing.JOptionPane;

public class EmprestimoData {

    public static void main(String[] args) throws SQLException, ParseException, Exception {
       System.out.println("Relatório 2 - Relação de obras emprestadas a devolver (por data e geral)");
        try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e){
            System.out.println("Driver nao encontrado!"+e);
        }
        

        //estabelecendo conxao com o bd educatio
        Connection conexao = null;
        conexao  =  DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio","root","usbw");
        
        if(conexao  ==  null){
            System.out.println("Status-------->Nao Conectado com sucesso!");
            System.exit(0);
        }
        Statement executaComando1  =  null;
        Statement executaComando2 = null;
        ResultSet resultadoSQL1 = null;
        ResultSet resultadoSQL2 = null;
        
        try{
            executaComando1 = conexao.createStatement();
            executaComando2 = conexao.createStatement();
            
            //Relacao de obras emprestadas a devolver - geral
            //Exibir o titulo do livro + idAcervo + nome e id do aluno que pegou emprestado + olhar se entregou
            //Como o foco eh apenas olhar para as obras que ainda tem que se devolvidas, 
            //basta mostrar a data de previsao. Se estiver atrasado, mostrar o numero de dias que esta atrasado
            //pegando o dia local e subtraindo da data de previsao
            //Para verificar se uma obra ainda nao foi devolvida, basta olhar se a data de devolucao esta vazia
            
            String dataPadrao = "01/01/1970";
            String dataEmprestimo = "";
            String dataPrevisaoDevolucao = "";
            int idAcervo = 0, idEmprestimo = 0;
            String idAluno = "";
            String nomeAluno = "";
            String tituloAcervo = "";
            
            Date data;
            SimpleDateFormat formato =  new SimpleDateFormat("dd/MM/yyyy");
            String impressaoGeral = "";
            String impressaoData = "";
            
            
            ArrayList bufferEmprestimoGeral = new ArrayList();
            ArrayList bufferEmprestimoData = new ArrayList();
            //Selecionando os emprestimos - geral
            resultadoSQL1  =  executaComando1.executeQuery("SELECT * FROM emprestimos WHERE ativo = '"+"S"+"'");
            
            while(resultadoSQL1.next()){
                
                idEmprestimo = resultadoSQL1.getInt("id");
                dataPrevisaoDevolucao = resultadoSQL1.getString("dataPrevisaoDevolucao");
                dataEmprestimo = resultadoSQL1.getString("dataEmprestimo");
                idAluno  =  resultadoSQL1.getString("idAluno");
                
                //Por meio do idAluno, vou obter o nome daquele aluno que pegou o livro
                resultadoSQL2 = executaComando2.executeQuery("SELECT nome FROM alunos WHERE idCPF = '"+idAluno+"'");
                if(resultadoSQL2.next()){
                    nomeAluno = resultadoSQL2.getString("nome");
                }
                idAcervo = resultadoSQL1.getInt("idAcervo");
                //Por meio do idAcervo vou obter dados sobre aquele livro
                resultadoSQL2 = executaComando2.executeQuery("SELECT nome FROM acervo WHERE id = '"+idAcervo+"'");
                if(resultadoSQL2.next()){
                    tituloAcervo = resultadoSQL2.getString("nome");
                }
                
                bufferEmprestimoGeral.add("\nId do Aluno: "+idAluno);
                bufferEmprestimoGeral.add("\nNome do aluno: "+nomeAluno);
                bufferEmprestimoGeral.add("\nEmprestimo: "+idEmprestimo);
                bufferEmprestimoGeral.add("\nTitulo do acervo: "+tituloAcervo);
                bufferEmprestimoGeral.add("\nData de previsao de devolucao: "+dataPrevisaoDevolucao);
                bufferEmprestimoGeral.add("\nData de realizacao do emprestimo: "+dataEmprestimo);
                
                impressaoGeral += "\nid do emprestimo: "+idEmprestimo+"\ndata de realizacao do Emprestimo:  "
                        +dataEmprestimo+"\ntitulo: "+tituloAcervo+"\nidAcervo: "+idAcervo
                        +"\ndataPrevisaoDevolucao:     "+dataPrevisaoDevolucao
                        +"\nCPF do aluno que tomou o livro: "+idAluno+"\nnomeAluno"+nomeAluno;
                
            }
            
            //Exiba a tabela completa, exceto com a coluna multa
            //Agora a parte hard que eh selecionar a data prevista de devolucao, passa-la para Date,
            //transformar em milissegundos, ordenar e colocar todos os livros relacionados a ela
            //Para ordenar um conjunto de datas vamos selecionando e depois ordenamos
            //Primeiro selecionamos se ainda nao foi devolvida
            
            //Nesta lista ficarao armazenadas todas as datas em ordem crescente
            ArrayList lista  =  new ArrayList(); 
            long numMilissegundos = 0;
            resultadoSQL1  =  executaComando1.executeQuery("SELECT dataEmprestimo FROM emprestimos WHERE ativo = '"+"S"+"'");
            while(resultadoSQL1.next()){
                dataEmprestimo = resultadoSQL1.getString("dataEmprestimo");
                
                //Converter string para milissegundos
                
                data  =  (Date) formato.parse(dataEmprestimo);
                numMilissegundos = data.getTime();
                //Ver se ja existe em arraylist
                //Se nao existir o numero de milissegundos em lista, coloque na posicao desejada
                if(!lista.contains(numMilissegundos)){
                    //percorra a lista e compare com cada indice existente
                    lista.add(numMilissegundos);
                    
                }
            }
            //Ordenando lista
            Collections.sort(lista);
            //Para cada elemento da lista imprimimos todos os livros relacionados a ele
            //Agora transformamos de volta para string os milissegundos
            String dataFormatada;
            for(Object ms : lista){
                data = new Date((long) ms);
                dataFormatada = formato.format(data);
                //Agora pega todos os dados do BD que tem essa data
                
                
                //Ordena por data de emprestimo - TESTAR
                resultadoSQL1  =  executaComando1.executeQuery("SELECT * FROM emprestimos WHERE dataEmprestimo  =  '"+dataFormatada+"' AND ativo = '"+"S"+"' ORDER BY dataEmprestimo ");
                while(resultadoSQL1.next()){
                    idEmprestimo = resultadoSQL1.getInt("id");
                    dataPrevisaoDevolucao = resultadoSQL1.getString("dataPrevisaoDevolucao");
                    dataEmprestimo = resultadoSQL1.getString("dataEmprestimo");
                    idAluno = resultadoSQL1.getString("idAluno");
                    //Por meio do idAluno, vou obter o nome daquele aluno que pegou o livro
                    resultadoSQL2 = executaComando2.executeQuery("SELECT nome FROM alunos WHERE idCPF = '"+idAluno+"'");
                    if(resultadoSQL2.next()){
                        nomeAluno = resultadoSQL2.getString("nome");
                    }
                    idAcervo = resultadoSQL1.getInt("idAcervo");
                    //Por meio do idAcervo vou obter dados sobre aquele livro
                    resultadoSQL2 = executaComando2.executeQuery("SELECT nome FROM acervo WHERE id = '"+idAcervo+"'");
                    if(resultadoSQL2.next()){
                        tituloAcervo = resultadoSQL2.getString("nome");
                    }
                    
                    //Exiba a tabela completa, exceto com a coluna multa
                    
                    bufferEmprestimoData.add("\nNome do aluno: "+nomeAluno);
                    bufferEmprestimoData.add("\nId do aluno: "+idAluno);
                    bufferEmprestimoData.add("\nEmprestimo: "+idEmprestimo);
                    bufferEmprestimoData.add("\nTitulo do acervo: "+tituloAcervo);
                    bufferEmprestimoData.add("\nData de previsao de devolucao: "+dataPrevisaoDevolucao);
                    bufferEmprestimoData.add("\nData de realizacao do emprestimo: "+dataEmprestimo);
                    
                    
                            
                    impressaoData += "\n\nid do emprestimo:"+idEmprestimo+"\ntitulo: "+tituloAcervo+"\nidAcervo: "+
                            idAcervo+"\ndataPrevisaoDevolucao: "+dataPrevisaoDevolucao+"\ndataEmprestimo: "+
                            dataEmprestimo+"\nidAluno:"+idAluno+"\nnomeAluno"+nomeAluno;
                }
            }
            int resposta  =  Integer.parseInt(JOptionPane.showInputDialog(null, "Deseja: \n1-exibir na tela  \n2-ou imprimir"));
            switch (resposta){
                    case 1:
                        System.out.println("Por data:");
                        
                        for(int intTemp2 = 0; intTemp2 < bufferEmprestimoData.size(); intTemp2++){
                            System.out.println((String) bufferEmprestimoData.get(intTemp2));
                        }
                        
                        System.out.println("\nGeral:"+impressaoGeral);
                        for(int intTemp3 = 0; intTemp3 < bufferEmprestimoGeral.size(); intTemp3++){
                                System.out.println((String) bufferEmprestimoGeral.get(intTemp3));
                        }
                        break;
                        
                    case 2:
                        GeraPdfEmprestimoDataGeral imprimir  =  new GeraPdfEmprestimoDataGeral(bufferEmprestimoGeral, bufferEmprestimoData);
                        imprimir.imprimindo();
                        break;
                        
                    default:
                        System.out.println();
                        break;
            }
        }catch(SQLException ex){
            System.out.println("SQLExeption: "+ ex.getMessage());
            System.out.println("SQLState: "+ ex.getSQLState());
            System.out.println("VendorError : "+ ex.getErrorCode());
        }
    }
    
}
