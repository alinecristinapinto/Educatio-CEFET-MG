package selecaoconteudos;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import javax.swing.JOptionPane;


public class SelecaoConteudos{
    
    public static void main(String[] args) throws SQLException, Exception {
        System.out.println("Relacao de conteudos por disciplina (a selecionar) e por etapa (a selecionar)");
        try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e){
            System.out.println("Driver nao encontrado!"+e);
        }
        

        //estabelecendo conxao com o bd test
        Connection conexao = null;
        conexao = DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio","root","usbw");
        
        if(conexao == null){
            System.out.println("Status-------->Nao Conectado com sucesso!");
            System.exit(0);
        }
        
        //Local de declaracao da maioria das variaveis
        Statement executaComando1 = null;
        Statement executaComando2 = null;
        ResultSet ResultadoSQL1 = null;
        ResultSet ResultadoSQL2 = null;
        String nomeDisciplina = "";
        int idDisciplina;
        int idConteudo;
        String conteudo;
        ArrayList bufferSelecaoConteudos = new ArrayList();
        
        //Mostrar todas as opcoes de disciplinas e etapas
        String menuDisciplinas = "";
        String menuEtapas = "";
        try{
            executaComando1 = conexao.createStatement();
            executaComando2 = conexao.createStatement();
            
            
            //Lista todas as disciplinas disponiveis
            ResultadoSQL1 = executaComando1.executeQuery("SELECT nome, id FROM disciplinas WHERE ativo ='"+"S"+"'");
            while(ResultadoSQL1.next()){
                nomeDisciplina = ResultadoSQL1.getString("nome");
                idDisciplina = Integer.parseInt(ResultadoSQL1.getString("id"));
                menuDisciplinas += nomeDisciplina+"   idDisciplina:   "+idDisciplina+"\n";
            }
            System.out.println(menuDisciplinas);
            
            //Selecionando a disciplina 
            int escolhaIdDisciplina = Integer.parseInt(JOptionPane.showInputDialog(null, "Selecione uma disciplina por id"));
            
            String stringTemporaria1 = "";
            //Coleta nomes
            ResultadoSQL1 = executaComando1.executeQuery("SELECT nome FROM disciplinas WHERE ativo ='"+"S"+"' AND id = '"+escolhaIdDisciplina+"'");
            //Trata erros
            while(!ResultadoSQL1.next()){
                escolhaIdDisciplina = Integer.parseInt(JOptionPane.showInputDialog(null, "id da disciplina nao existe! Escolha uma disciplina por id"));
                ResultadoSQL1 = executaComando1.executeQuery("SELECT nome FROM disciplinas WHERE ativo ='"+"S"+"' AND id = '"+escolhaIdDisciplina+"'");
            }
            
            //Quando estiver certo salva os dados
            while(ResultadoSQL1.next()){
                nomeDisciplina = ResultadoSQL1.getString("nome");
                idDisciplina = Integer.parseInt(ResultadoSQL1.getString("id"));
            }
            menuEtapas = "";
            
            
            //Mostrando as etapas existentes para aquela determinada disciplina
            ResultadoSQL1 = executaComando1.executeQuery("SELECT idEtapa FROM conteudos  WHERE idDisciplina = '"+escolhaIdDisciplina+"'");
            while(ResultadoSQL1.next()){
                if(!menuEtapas.contains(ResultadoSQL1.getString("idEtapa"))){
                    menuEtapas += ResultadoSQL1.getString("idEtapa")+" ";
                }
                
            }
            System.out.println(menuEtapas);
            
            
            //Selecionando a etapa
            int escolhaIdEtapa = Integer.parseInt(JOptionPane.showInputDialog(null, "Digite o id da etapa"));
            ResultadoSQL1 = executaComando1.executeQuery("SELECT idEtapa FROM conteudos  WHERE idEtapa = '"+escolhaIdEtapa+"'");
            //Verificando se escolheu uma etapa valida
            while(!ResultadoSQL1.next()){
                escolhaIdEtapa = Integer.parseInt(JOptionPane.showInputDialog(null, "Etapa nao existe! Escolha uma etapa por id"));
                ResultadoSQL1 = executaComando1.executeQuery("SELECT idEtapa FROM conteudos  WHERE idEtapa = '"+escolhaIdEtapa+"'");
            }
            
            //Salvando etapa
            while(ResultadoSQL1.next()){
                escolhaIdEtapa = Integer.parseInt(ResultadoSQL1.getString("idEtapa"));
            }
            
            //Pegando os conteudos
            ResultadoSQL1 = executaComando1.executeQuery("SELECT id, conteudo FROM conteudos WHERE idEtapa = '"+escolhaIdEtapa+"' AND idDisciplina = '"+escolhaIdDisciplina+"'");
            while(ResultadoSQL1.next()){
                idConteudo = ResultadoSQL1.getInt("id");
                conteudo = ResultadoSQL1.getString("conteudo");
                bufferSelecaoConteudos.add(idConteudo+". "+conteudo);
            }
            
            int resposta = Integer.parseInt(JOptionPane.showInputDialog(null, "Deseja: \n1-exibir na tela  \n2-ou imprimir"));
            switch (resposta){
                    case 1:
                        //Mostrando na tela
                        for(Object objeto: bufferSelecaoConteudos){
                            System.out.println((String) objeto);
                        }
                        break;
                        
                    case 2:
                        //Criando o gerador de pdf
                        GeraPdfSelecaoConteudos geraPdf = new GeraPdfSelecaoConteudos(bufferSelecaoConteudos, escolhaIdEtapa, nomeDisciplina, escolhaIdDisciplina);
                        geraPdf.gerando();
                        break;
                        
                    default:
                        //Mostrando na tela
                        for(Object objeto: bufferSelecaoConteudos){
                            System.out.println((String) objeto);
                        }
                        break;
                        
            }
            
        }catch(SQLException ex){
            System.out.println("SQLExeption: "+ ex.getMessage());
            System.out.println("SQLState: "+ ex.getSQLState());
            System.out.println("VendorError : "+ ex.getErrorCode());
        }
    }
}


