package relatorioatraso;

import java.sql.Connection;
import java.sql.Date;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Arrays;

public class BancoDeDados {
    private Connection link = null;
    private ResultSet resultado = null;
 
    public BancoDeDados() throws SQLException{
        try{
            Class.forName("com.mysql.jdbc.Driver");
        } catch(ClassNotFoundException e){
            System.out.println("Driver não encontrado!" +e);
        }
        System.out.println("Driver encontrado com sucesso!");
        
        link = null;
        link = DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio", "root", "");       
        if(link != null){
            System.out.println("Conexão realizada com sucesso");
        } else{
            System.out.println("Não foi possível realizar a conexão");
        }
    }
    
    public void selecionaRegistros(int id) throws SQLException {
        Statement comando = link.createStatement();
        String query = "SELECT * FROM `emprestimos` WHERE id=\'" + id+"\'";
        resultado = comando.executeQuery(query);
        
        while(resultado.next()){
            String previsaoDevolucao = resultado.getString("dataPrevisaoDevolucao");
            String[] previsaoDevolucaoSeparado = previsaoDevolucao.split("/");
            
            String devolucao = resultado.getString("dataDevolucao");
            String[] devolucaoSeparado = devolucao.split("/");
            
            boolean atraso = false;
            for(int i = 2; i >= 0; i--){
                if(previsaoDevolucaoSeparado[i].compareTo(devolucaoSeparado[i])== -1){
                    atraso = true;
                    break;
                }
            }
            
            if(atraso){
                System.out.println("Tem atraso");
            } else
                System.out.println("Nao tem atraso");
        }
        
        
        
        
        
    }
    
    
              
}
// http://www.edneiparmigiani.com.br/calcular-diferenca-entre-datas-em-java/