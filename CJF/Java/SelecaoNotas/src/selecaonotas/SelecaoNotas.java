package selecaonotas;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Properties;
import javax.swing.JOptionPane;
import javax.swing.table.AbstractTableModel;//para a tabela
import javax.swing.table.DefaultTableModel;


public class SelecaoNotas{
    
    public static void main(String[] args) throws SQLException {
        System.out.println("Relação por seleção de aluno, "+
        "listando as notas, nas respectivas disciplinas, por etapa.");
        try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e){
            System.out.println("Driver nao encontrado!"+e);
        }
        
        //estabelecendo conexao com BD
        Connection connection = null;
        connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio?useSSL=true","root","");
        
        if(connection==null){
            System.out.println("Status-------->Erro ao conectar!");
            System.exit(0);
        }
        

        Statement executaComando1, executaComando2, executaComando3, executaComando4, executaComando5;//variaveis para executar comandos sql relativos ao BD
        ResultSet ResultadoSQL1, ResultadoSQL2, ResultadoSQL3, ResultadoSQL4, ResultadoSQL5;//variaveis para receber dados do BD
        String nomeAluno;
        int cpf;
        int idMatricula;
        int idDisciplina = 0;
        String nomeDisciplina;
        int idEtapa;
        int idConteudo;
        int notaAtividadeConteudo;
        int notaConteudo = 0;
        int notaEtapa = 0;
        
        //Variaveis de dados para tabela
        String disciplinasTabela = "";
        String etapasTabela = "";
        for(int i = 0; i<30; i++){
            etapasTabela += " ";
        }
        etapasTabela += ";";
        
        try{
            executaComando1 = connection.createStatement();
            executaComando2 = connection.createStatement();
            executaComando3 = connection.createStatement();
            executaComando4 = connection.createStatement();
            executaComando5 = connection.createStatement();
            
            nomeAluno = JOptionPane.showInputDialog(null, "Digite o nome do aluno para ver suas notas");
            ResultadoSQL1 = executaComando1.executeQuery("SELECT idCPF FROM alunos WHERE nome LIKE '%"+nomeAluno+"%' ");
            while(!ResultadoSQL1.next()){
               nomeAluno = JOptionPane.showInputDialog(null, "Nome nao existe! Digite outro nome."); 
               ResultadoSQL1 = executaComando1.executeQuery("SELECT idCPF FROM alunos WHERE nome LIKE '%"+nomeAluno+"%' ");
            
            }
            cpf = ResultadoSQL1.getInt("idCPF");
            ResultadoSQL1 = executaComando1.executeQuery("SELECT nome FROM alunos WHERE idCPF LIKE '%"+cpf+"%' ");
            if(ResultadoSQL1.next()){
                nomeAluno = ResultadoSQL1.getString("nome");
            }
            ResultadoSQL1 = executaComando1.executeQuery("SELECT id FROM matriculas WHERE idAluno LIKE '%"+cpf+"%' ");
            if(ResultadoSQL1.next()){
                idMatricula  = ResultadoSQL1.getInt("id");
            }
            //Selecionando todas as disciplinas em que o aluno esta matriculado
            ResultadoSQL1 = executaComando1.executeQuery("SELECT idDisciplina FROM matriculas WHERE idAluno LIKE '%"+cpf+"%' ");
            while(ResultadoSQL1.next()){
                idDisciplina = ResultadoSQL1.getInt("idDisciplina");
                ResultadoSQL2 = executaComando2.executeQuery("SELECT nome FROM disciplinas WHERE id LIKE '%"+idDisciplina+"%' ");
                if(ResultadoSQL2.next()){
                    nomeDisciplina  = ResultadoSQL2.getString("nome");
                    disciplinasTabela += nomeDisciplina+";";
                    
                }
                //Seleciona cada uma das etapas
                ResultadoSQL3 = executaComando3.executeQuery("SELECT id FROM etapas ");
                while(ResultadoSQL3.next()){
                    idEtapa  = ResultadoSQL3.getInt("id");
                    if(!etapasTabela.contains(""+ idEtapa+"")){
                        etapasTabela += "Etapa "+ idEtapa+";";
                    }
                    //System.out.println("etapas de novo"+etapasTabela);
                    //Selecionando cada conteudo da etapa
                    ResultadoSQL4 = executaComando4.executeQuery("SELECT id FROM conteudos WHERE idEtapa LIKE '%"+idEtapa+"%' ");
                    while(ResultadoSQL4.next()){//estrutura de repeticao aqui, p cada materia;tudo a seguir entra aqui
                        idConteudo  = ResultadoSQL4.getInt("id");
                        //Para cada conteudo, somar as notas de suas atividades, para obter a nota do conteudo
                        //Se houver duas atividades do mesmo conteudo, entao serao somadas pois sao procuradas pelo id do conteudo
                        ResultadoSQL5 = executaComando5.executeQuery("SELECT nota FROM diarios WHERE idConteudo LIKE '%"+idConteudo+"%' ");
                        while(ResultadoSQL5.next()){
                            notaAtividadeConteudo  = ResultadoSQL5.getInt("nota");
                            notaConteudo += notaAtividadeConteudo;
                        }
                        notaEtapa += notaConteudo;
                        //reseta o contador pois a proxima iteracao sera um novo conteudo
                        notaConteudo = 0;
                    }//fim conteudo
                    
                    disciplinasTabela += notaEtapa+";";
                    //reseta o contador pois a proxima iteracao sera uma nova etapa
                    notaEtapa = 0;
                }//fim etapa
                etapasTabela += "\n";
                disciplinasTabela += "\n";
            }//fim disciplina
            System.out.println("Relatorio de notas de "+nomeAluno+" de CPF: "+cpf);
            
            
            
            /*Tabela que exibe relatorio com algumas coisas erradas que precisam ser arrumadas*/
            //Os dados das Strings estao sendo pegos de forma esperada; o problema esta em formatar a tabela; nao posso testar pois estou sem BD
            //Ainda nao esta padronizada essa parte pois o codigo pode mudar
            //Vou deixar a tabela como uma matriz
            
            int numeroColunas = 0, numeroLinhas = 0;

            
            for(int indiceTemp1 = 0; indiceTemp1 < disciplinasTabela.length(); indiceTemp1++){
                if(disciplinasTabela.charAt(indiceTemp1)== '.'){
                    numeroLinhas++;
                    
                }
            }
            numeroLinhas++;
            for(int indiceTemp1 = 0; indiceTemp1 < etapasTabela.length(); indiceTemp1++){
                if(etapasTabela.charAt(indiceTemp1) =='x'){
                    numeroColunas++;
                    
                }
            }
            
            String matrizTabela[][]=new String[numeroLinhas][numeroColunas+1];
           
            int indiceTemp2=0;
            int indiceAnterior = 0; 
            
            for(int indiceTemp1 = 0; indiceTemp1 < etapasTabela.length(); indiceTemp1++){
                if(etapasTabela.charAt(indiceTemp1) =='x'){
                    matrizTabela[0][indiceTemp2] = etapasTabela.substring(indiceAnterior, indiceTemp1);//pega o que tiver escrito etapa
                    indiceTemp2++;
                    indiceAnterior = indiceTemp1+1;
                }
            }
            
            indiceAnterior = 0; 
            int linhaAtual = 1;
            int colunaAtual = 0;
            //"Matematicax10x20x30x10x.Portuguesx10x20x30x10x."
            for(int indiceTemp1 = 0; indiceTemp1 < disciplinasTabela.length(); indiceTemp1++){
                
                if(disciplinasTabela.charAt(indiceTemp1) == 'x'){
                    String aux=disciplinasTabela.substring(indiceAnterior, indiceTemp1);
                    //System.out.print(aux);
                    matrizTabela[linhaAtual][colunaAtual] = aux;
                    //System.out.print("matrizTabela[linhaAtual][colunaAtual]"+matrizTabela[linhaAtual][colunaAtual]+"\n");
                    indiceAnterior = indiceTemp1+1;
                    colunaAtual++;
                }
                
                if(disciplinasTabela.charAt(indiceTemp1)== '.'){
                    colunaAtual=0;
                    indiceAnterior++;
                    //novalinha
                    linhaAtual++;
                }
                
            }
            for(int i=0; i<numeroLinhas; i++){
                for(int j=0; j<numeroColunas; j++){
                    System.out.print(matrizTabela[i][j]+" ");
                }
                System.out.print("\n");
            }
        }catch(SQLException ex){
            System.out.println("SQLExeption: "+ ex.getMessage());
            System.out.println("SQLState: "+ ex.getSQLState());
            System.out.println("VendorError : "+ ex.getErrorCode());
        }
    }
}
