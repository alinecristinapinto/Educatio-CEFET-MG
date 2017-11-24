package reservasdatageral;

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

public class ReservasDataGeral {

    public static void main(String[] args) throws SQLException, ParseException, Exception {
        System.out.println("Relatório 3 - Relação de reservas (por data e geral)");
        try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e){
            System.out.println("Driver nao encontrado!"+e);
        }
        

        //estabelecendo conxao com o bd test
        Connection conexao  =  null;
        conexao  =  DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio","root","usbw");
        
        if(conexao  ==  null){
            System.out.println("Status-------->Nao Conectado com sucesso!");
            System.exit(0);
        }
        Statement executaComando1  =  null;
        Statement executaComando2  =  null;
        ResultSet resultadoSQL1 = null;
        ResultSet resultadoSQL2 = null;
        
        try{
            executaComando1  =  conexao.createStatement();
            executaComando2  =  conexao.createStatement();
            //Variaveis
            int idReserva, idAcervo=0;
            String idAluno  =  "", nomeAluno  =  "", dataReserva  =  "", tempoEspera  =  "", ativo;
            String dataPadrao  =  "01/01/1970";
            Date data;
            SimpleDateFormat formato  =  new SimpleDateFormat("dd/MM/yyyy");
            String tituloAcervo  = "";
            String dadosImpressao  = "";
            String dadosGeralImpressao  =  "";
            ArrayList datas = new ArrayList();
            
            //Variaveis especificas para data
            ArrayList lista  =  new ArrayList(); 
            long numMilissegundos  =  0;
            
            //Salvando os dados
            ArrayList bufferDadosReservaGeral = new ArrayList();
            ArrayList bufferDadosReservaData = new ArrayList();
            
            
            //Geral -> mostra toda a tabela, sem nenhum criterio de selecao
            
            resultadoSQL1  =  executaComando1.executeQuery("SELECT * FROM reservas WHERE ativo  =  '"+"S"+"'");
            while(resultadoSQL1.next()){
                idAluno  =  resultadoSQL1.getString("idAluno");
                
                resultadoSQL2  =  executaComando2.executeQuery("SELECT nome FROM alunos WHERE idCPF  =  '"+idAluno+"'");
                if(resultadoSQL2.next()){
                    nomeAluno = resultadoSQL2.getString("nome");
                    bufferDadosReservaGeral.add("\nNome do aluno que solicitou a reserva: "+nomeAluno);
                    
                }
                bufferDadosReservaGeral.add("\nId do aluno: "+idAluno);  
                dataReserva = resultadoSQL1.getString("dataReserva");
                bufferDadosReservaGeral.add("\nData da reserva:    "+  dataReserva);
                tempoEspera = resultadoSQL1.getString("tempoEspera");
                bufferDadosReservaGeral.add("\nTempo de espera:    "+ tempoEspera);
                
                idAcervo = resultadoSQL1.getInt("idAcervo");
                bufferDadosReservaGeral.add( "\nId do acervo reservado:    "+idAcervo);
                
                resultadoSQL2=executaComando2.executeQuery("SELECT nome FROM acervo WHERE id = "+idAcervo);
                if(resultadoSQL2.next()){
                    tituloAcervo = resultadoSQL2.getString("nome");
                    bufferDadosReservaGeral.add("\nTitulo do acervo:   "+tituloAcervo);
                }
            }
            
            //Por data
            
            //Para saber se dataReserva existe mesmo - Parece redundante mas nao eh
            resultadoSQL1  =  executaComando1.executeQuery("SELECT dataReserva FROM reservas WHERE ativo='"+"S"+"'");
            while(resultadoSQL1.next()){
                dataReserva  =  resultadoSQL1.getString("dataReserva");
                
                //Converter string para milissegundos
                
                data  =  (Date) formato.parse(dataReserva);
                numMilissegundos = data.getTime();
                //Ver se ja existe em arraylist
                 if(!lista.contains(numMilissegundos)){
                    lista.add(numMilissegundos);
                }
            }
            //Ordenando lista
            Collections.sort(lista);
            //Para cada elemento da lista imprimimos todos os livros relacionados a ele
            //Agora transformamos de volta para string os milissegundos
            String dataFormatada;
            
            for(Object ms : lista){
                data  =  new Date((long) ms);
                dataFormatada  =  formato.format(data);
                //Agora pega todos os dados do BD que tem essa data
                datas.add("\n\nReservas realizadas em: "+dataFormatada);
                resultadoSQL1  =  executaComando1.executeQuery("SELECT * FROM reservas WHERE dataReserva='"+dataFormatada+"' AND ativo='"+"S"+"'");
                while(resultadoSQL1.next()){
                    
                    idAluno = resultadoSQL1.getString("idAluno");
                    resultadoSQL2  =  executaComando2.executeQuery("SELECT nome FROM alunos WHERE idCPF='"+idAluno+"'");
                    if(resultadoSQL2.next()){
                        nomeAluno = resultadoSQL2.getString("nome");
                    }
                    dataReserva = resultadoSQL1.getString("dataReserva");
                    tempoEspera = resultadoSQL1.getString("tempoEspera");
                    idAcervo = resultadoSQL1.getInt("idAcervo");
                    
                    resultadoSQL2 = executaComando2.executeQuery("SELECT nome FROM acervo WHERE id="+idAcervo);
                    if(resultadoSQL2.next()){
                        tituloAcervo = resultadoSQL2.getString("nome");
                    }
                    
                    bufferDadosReservaData.add("\n\nAluno que solicitou reserva: " + nomeAluno);
                    
                    bufferDadosReservaData.add("\nID do aluno: "+idAluno);
                    bufferDadosReservaData.add("\nData da Reserva: "+dataReserva);
                    bufferDadosReservaData.add("\nTempo de espera do aluno: "+tempoEspera);
                    bufferDadosReservaData.add("\nid do acervo reservado: "+idAcervo);
                    bufferDadosReservaData.add("\nTitulo do acervo: "+tituloAcervo);
                }
            }
            
            int resposta  =  Integer.parseInt(JOptionPane.showInputDialog(null, "Deseja: \n1-exibir na tela  \n2-ou imprimir"));
            switch (resposta){
                    case 1:
                        for(Object dadosGeral: bufferDadosReservaGeral){
                            System.out.println((String) dadosGeral);
                        }
                        for(Object dadosData: bufferDadosReservaData){
                            System.out.println((String) dadosData);
                        }
                        break;
                        
                    case 2:
                        ImpressaoReservasDataGeral imprimir  =  new ImpressaoReservasDataGeral(bufferDadosReservaGeral, bufferDadosReservaData, datas);
                        imprimir.imprimindo();
                        break;
                        
                    default:
                        System.out.println(dadosImpressao);
                        break;
                        
            }
        }catch(SQLException ex){
            System.out.println("SQLExeption: "+ ex.getMessage());
            System.out.println("SQLState: "+ ex.getSQLState());
            System.out.println("VendorError : "+ ex.getErrorCode());
        }
    }
    
}
