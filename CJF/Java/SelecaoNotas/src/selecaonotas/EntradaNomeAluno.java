package selecaonotas;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Properties;
import javax.swing.JOptionPane;

public class EntradaNomeAluno {
    //variaveis para executar comandos sql relativos ao BD
    public Statement executaComando1, executaComando2, executaComando3, executaComando4, executaComando5;
    //variaveis para receber dados do BD
    public ResultSet ResultadoSQL1, ResultadoSQL2, ResultadoSQL3=null, ResultadoSQL4, ResultadoSQL5;
    public String nomeAluno = "";
    public String cpf = "";
    public EntradaNomeAluno() throws SQLException{
        
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
        
        executaComando1 = connection.createStatement();
        executaComando2 = connection.createStatement();
        executaComando3 = connection.createStatement();

    }
    public void metodoBuscaNome(){
        try{
            
            
            nomeAluno = JOptionPane.showInputDialog(null, "Digite o nome do aluno para ver suas notas");
            
            //Apos digitar um nome, lista todos os nomes possiveis - exceto se houver uma unica possibilidade de cpf
            //Isso acontece porque, por alguma coincidencia, duas pessoas podem ter o mesmo nome. A diferenca eh o cpf
            
            //Depois de digitar esse nome, aparecem todas as opcoes com pelo menos uma parte do nome igual
            //Ai na interface Java fx, aparecem nome e cpf. O usuario seleciona um desses individuos
            //Aqui eh implementado com switch
            int intTemporario1=0;
            
            //Conta a quantidade de registros com esse nome.
            ResultadoSQL1 = executaComando1.executeQuery("SELECT idCPF FROM alunos WHERE nome LIKE '%"+nomeAluno+"%' AND ativo='"+"S"+"'");
            while(ResultadoSQL1.next()){
                intTemporario1++;
                if(intTemporario1 == 2){
                    break;
                }
            }
            
            
            //Se houver so uma pessoa com aquele cpf, nao precisamos pedir para o usuario seleciona-la
            switch (intTemporario1){
                case 0:
                    System.out.println("Nenhuma correspondencia encontrada");
                    //Recursao para novo nome
                    metodoBuscaNome();
                    break;
                case 1:
                    ResultadoSQL2 = executaComando2.executeQuery("SELECT idCPF, idTurma, nome FROM alunos WHERE nome LIKE '%"+ nomeAluno +"%' AND ativo='"+"S"+"'");
                    if(ResultadoSQL2.next()){
                        nomeAluno = ResultadoSQL2.getString("nome");
                        cpf = ResultadoSQL2.getString("idCPF");
                    }
                    break;
                    
                default:
                    String alunosCPFNome;
                    ResultadoSQL1 = executaComando1.executeQuery("SELECT nome, idCPF FROM alunos WHERE nome LIKE '%"+nomeAluno+"%' AND ativo='"+"S"+"'");
                    while(ResultadoSQL1.next()){
                        
                        //Caso haja mais de uma pessoa com aquele nome, mostramos todas e pedimos pra ele selecionar um cpf
                        //Cria um vetor com todos os cpfs e nomes possiveis
                        
                        alunosCPFNome=ResultadoSQL1.getString("idCPF");
                        System.out.print(alunosCPFNome+"    ");
                        alunosCPFNome=ResultadoSQL1.getString("nome");
                        System.out.println(alunosCPFNome);
                        
                        //Imprimir o vetor na interface
                    }
                    //Manda o usuario digitar o cpf dentre todos aqueles alunos que ele viu e avalia se existe
                    String cpfAvaliar = "";
                    cpfAvaliar = JOptionPane.showInputDialog(null, "Digite o CPF do aluno que deseja selecionar");
                    //A linha abaixo parece ser redundante mas esta verificando a existencia do CPF
                    ResultadoSQL2 = executaComando2.executeQuery("SELECT nome, idCPF FROM alunos WHERE idCPF ='" + cpfAvaliar + "' AND ativo='"+"S"+"'");
                    if(ResultadoSQL2.next()){
                        cpf = ResultadoSQL2.getString("idCPF");
                        System.out.println("CPF selecionado: "+cpf);
                        nomeAluno = ResultadoSQL2.getString("nome");

                    }else{
                        while(!ResultadoSQL2.next()){
                           cpfAvaliar = JOptionPane.showInputDialog(null, "CPF nao existe! Digite outro numero de CPF."); 
                           //ResultadoSQL1 = executaComando1.executeQuery("SELECT idCPF FROM alunos WHERE nome LIKE '%"+nomeAluno+"%' ");
                           ResultadoSQL2 = executaComando3.executeQuery("SELECT nome, idCPF FROM alunos WHERE idCPF = '" + cpfAvaliar + "' AND ativo='"+"S"+"'");                   
                        }
                        cpf = ResultadoSQL2.getString("idCPF");
                        nomeAluno = ResultadoSQL2.getString("nome");
                    }//fim else pedindo o cpf errado
                    break;
                }//fim switch
            
        }catch(SQLException ex){
            System.out.println("SQLExeption: "+ ex.getMessage());
            System.out.println("SQLState: "+ ex.getSQLState());
            System.out.println("VendorError : "+ ex.getErrorCode());
        }//FIM CATCH
    }//fim do metodo
    public String getNomeAluno(){
        return this.nomeAluno;
    }
    public String getCpfAluno(){
        return this.cpf;
    }
    public void metodoBuscaCpf() throws SQLException{
        String cpfAvaliar = "";
        cpfAvaliar = JOptionPane.showInputDialog(null, "Digite o CPF do aluno que deseja selecionar");
        //A linha abaixo parece ser redundante mas esta verificando a existencia do CPF
        ResultadoSQL2 = executaComando2.executeQuery("SELECT nome, idCPF FROM alunos WHERE idCPF ='" + cpfAvaliar + "' AND ativo='"+"S"+"'");
        if(ResultadoSQL2.next()){
            cpf = ResultadoSQL2.getString("idCPF");
            System.out.println("CPF selecionado: "+cpf);
            nomeAluno = ResultadoSQL2.getString("nome");

        }else{
            while(!ResultadoSQL2.next()){
               cpfAvaliar = JOptionPane.showInputDialog(null, "CPF nao existe! Digite outro numero de CPF."); 
               ResultadoSQL2 = executaComando3.executeQuery("SELECT nome, idCPF FROM alunos WHERE idCPF = '" + cpfAvaliar + "' AND ativo='"+"S"+"'");                   
            }
            cpf = ResultadoSQL2.getString("idCPF");
            nomeAluno = ResultadoSQL2.getString("nome");
        }//fim else pedindo o cpf errado
    }//fim metodo
}
