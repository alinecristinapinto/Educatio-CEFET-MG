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

public class ReservasDataGeral {

    public static void main(String[] args) throws SQLException, ParseException {
        System.out.println("Relatório 3 - Relação de reservas (por data e geral)");
        try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e){
            System.out.println("Driver nao encontrado!"+e);
        }
        

        //estabelecendo conxao com o bd test
        Connection Conexao = null;
        Conexao = DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio","root","");
        
        if(Conexao == null){
            System.out.println("Status-------->Nao Conectado com sucesso!");
            System.exit(0);
        }
        Statement executaComando1=null;
        Statement executaComando2=null;
        ResultSet resultadoSQL1=null;
        ResultSet resultadoSQL2=null;
        try{
            executaComando1=Conexao.createStatement();
            executaComando2=Conexao.createStatement();
            //Variaveis
            int idReserva, idAcervo=0;
            String idAluno = "", nomeAluno = "", dataReserva = "", tempoEspera = "", ativo;
            String dataPadrao = "01/01/1970";
            Date data;
            SimpleDateFormat formato= new SimpleDateFormat("dd/MM/yyyy");
            String tituloAcervo="";
            
            //Variaveis especificas para data
            ArrayList lista = new ArrayList(); 
            long numMilissegundos = 0;
            
            //Geral -> mostra toda a tabela
            //Para essa logica, supoe-se que quando emprestou=N, o livro nao foi pego pelo solicitante.
            //Ou ainda, se emprestou=N, pode ser que o livro ainda esta na biblioteca. Se emprestou=S -> o livro pode estar emprestado para outra pessoa
            String aux="N";
            String auxx="S";
            resultadoSQL1 = executaComando1.executeQuery("SELECT * FROM reservas WHERE ativo = '"+auxx+"'");
            while(resultadoSQL1.next()){
                idAluno = resultadoSQL1.getString("idAluno");
                resultadoSQL2 = executaComando2.executeQuery("SELECT nome FROM alunos WHERE idCPF = '"+idAluno+"'");
                if(resultadoSQL2.next()){
                    nomeAluno=resultadoSQL2.getString("nome");
                }
                dataReserva=resultadoSQL1.getString("dataReserva");
                tempoEspera=resultadoSQL1.getString("tempoEspera");
                idAcervo=resultadoSQL1.getInt("idAcervo");
                resultadoSQL2=executaComando2.executeQuery("SELECT nome FROM acervo WHERE id="+idAcervo);
                if(resultadoSQL2.next()){
                    tituloAcervo=resultadoSQL2.getString("nome");
                }
                //Imprima tudo e mostre em uma tabela
                System.out.println("Aluno que solicitou reserva: "+nomeAluno+" ID do aluno: "+idAluno+"\tData da Reserva: "+dataReserva+" Tempo de espera do aluno: "+tempoEspera+"id do acervo reservado: "+idAcervo+"Titulo do acervo: "+tituloAcervo);
            
            }
            
            
            
            
            
            
            //Para saber se dataReserva existe mesmo - Parece redundante mas nao eh
            resultadoSQL1 = executaComando1.executeQuery("SELECT dataReserva FROM reservas WHERE ativo='"+"S"+"'");
            while(resultadoSQL1.next()){
                dataReserva = resultadoSQL1.getString("dataReserva");
                
                //Converter string para milissegundos
                
                data = (Date) formato.parse(dataReserva);
                numMilissegundos=data.getTime();
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
                System.out.println("\n\nReservas realizadas em: "+dataFormatada);
                resultadoSQL1 = executaComando1.executeQuery("SELECT * FROM reservas WHERE dataReserva='"+dataFormatada+"' AND ativo='"+"S"+"'");
                while(resultadoSQL1.next()){
                    
                    idAluno=resultadoSQL1.getString("idAluno");
                    resultadoSQL2 = executaComando2.executeQuery("SELECT nome FROM alunos WHERE idCPF='"+idAluno+"'");
                    if(resultadoSQL2.next()){
                        nomeAluno=resultadoSQL2.getString("nome");
                    }
                    dataReserva=resultadoSQL1.getString("dataReserva");
                    tempoEspera=resultadoSQL1.getString("tempoEspera");
                    idAcervo=resultadoSQL1.getInt("idAcervo");
                    
                    resultadoSQL2=executaComando2.executeQuery("SELECT nome FROM acervo WHERE id="+idAcervo);
                    if(resultadoSQL2.next()){
                        tituloAcervo=resultadoSQL2.getString("nome");
                    }
                    System.out.println("Aluno que solicitou reserva: "+nomeAluno+" ID do aluno: "+idAluno+"\tData da Reserva: "+dataReserva+
                            " Tempo de espera do aluno: "+tempoEspera+" id do acervo reservado: "+idAcervo+"Titulo do acervo: "+tituloAcervo);
                }
            }
        }catch(SQLException ex){
            System.out.println("SQLExeption: "+ ex.getMessage());
            System.out.println("SQLState: "+ ex.getSQLState());
            System.out.println("VendorError : "+ ex.getErrorCode());
        }
    }
    
}
