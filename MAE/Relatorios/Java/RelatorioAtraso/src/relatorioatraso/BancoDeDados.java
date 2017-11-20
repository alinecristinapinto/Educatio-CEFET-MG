package relatorioatraso;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Arrays;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.sql.Date;

public class BancoDeDados {
    private Connection link = null;
    private ResultSet resultado = null;
 
    public BancoDeDados() throws SQLException{
        try{
            Class.forName("com.mysql.jdbc.Driver");
        } catch(ClassNotFoundException e){
            System.out.println("Driver não encontrado!" +e);
        }
        //System.out.println("Driver encontrado com sucesso!");
        
        link = null;
        link = DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");       
        if(link != null){
            //System.out.println("Conexão realizada com sucesso");
        } else{
            System.out.println("Não foi possível realizar a conexão");
        }
    }
    
    public void selecionaRegistros(int id) throws SQLException, ParseException {
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `emprestimos` WHERE id=\'" + id+"\'";
        resultado = comando.executeQuery(query);
        
        while(resultado.next()){
            String previsaoDevolucao = resultado.getString("dataPrevisaoDevolucao");
            String[] previsaoDevolucaoSeparado = previsaoDevolucao.split("/");
            
            String devolucao = resultado.getString("dataDevolucao");
            String[] devolucaoSeparado = devolucao.split("/");
            
            boolean atraso = false;
            //***rever problema do for pq em alguns testes tem dado errado***
            for(int i = 2; i >= 0; i--){
                if(previsaoDevolucaoSeparado[i].compareTo(devolucaoSeparado[i])== -1){
                    atraso = true;
                    break;
                }
            }
            
            //concatenando as datas no formato dd-MM-yyyy
            String stringPrevisaoDevolucao =  previsaoDevolucaoSeparado[2] +"-";
            stringPrevisaoDevolucao += previsaoDevolucaoSeparado[1] +"-";
            stringPrevisaoDevolucao += previsaoDevolucaoSeparado[0];
            System.out.println("Data de previsão de devolução: " +stringPrevisaoDevolucao);
                
            String stringDevolucao =  devolucaoSeparado[2] +"-";
            stringDevolucao += devolucaoSeparado[1] +"-";
            stringDevolucao += devolucaoSeparado[0];
            System.out.println("Data de devolução: " +stringDevolucao +"\n");
            
            if(atraso){
                System.out.println("EXISTE ATRASO\n");
                
                //convertendo string p date
                SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd");
                java.sql.Date datePrevisaoDevolucao = new java.sql.Date(format.parse(stringPrevisaoDevolucao).getTime());
                java.sql.Date dateDevolucao = new java.sql.Date(format.parse(stringDevolucao).getTime());
                
                //System.out.println("\nData de previsão de devolução: " +datePrevisaoDevolucao);
                //System.out.println("Data de devolução: " +dateDevolucao +"\n" );
                  
                long diferencaDias = (dateDevolucao.getTime() - datePrevisaoDevolucao.getTime()) / (1000*60*60*24);
                long diferencaMeses = (dateDevolucao.getTime() - datePrevisaoDevolucao.getTime()) / (1000*60*60*24) / 30;
                long diferencaAnos = ((dateDevolucao.getTime() - datePrevisaoDevolucao.getTime()) / (1000*60*60*24) / 30) / 12;

                System.out.println(String.format("Diferença em Dias: "+ diferencaDias));
                System.out.println(String.format("Diferença em Meses: "+ diferencaMeses));
                System.out.println(String.format("Diferença em Anos: "+ diferencaAnos));
                
            } else
                System.out.println("NÃO EXISTE ATRASO\n");
        }       
    }             
}