/*

 */
package selecaoconteudos;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Properties;
import javax.swing.JOptionPane;


public class SelecaoConteudos{
    
    public static void main(String[] args) throws SQLException {
        System.out.println("Relação de conteúdos por disciplina (a selecionar) e por etapa (a selecionar)");
        try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e){
            System.out.println("Driver nao encontrado!"+e);
        }
        

        //estabelecendo conxao com o bd test
        Connection Conexao=null;
        Conexao=DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio?useSSL=true","root","");
        
        if(Conexao==null){
            System.out.println("Status-------->Nao Conectado com sucesso!");
            System.exit(0);
        }
        Statement executaComando1=null;
        Statement executaComando2=null;
        ResultSet ResultadoSQL1=null;
        ResultSet ResultadoSQL2=null;
        String nomeDisciplina;
        int idConteudo;
        
        String menuDisciplinas="";
        String menuEtapas="";
        try{
            executaComando1=Conexao.createStatement();
            executaComando2=Conexao.createStatement();
            //Mostrar todas as opcoes de MenuDisciplinas
            
            ResultadoSQL1=executaComando1.executeQuery("SELECT nome FROM disciplinas ");
            while(ResultadoSQL1.next()){
                nomeDisciplina=ResultadoSQL1.getString("nome");
                menuDisciplinas+=nomeDisciplina;
                ResultadoSQL2=executaComando2.executeQuery("SELECT id FROM disciplinas WHERE nome LIKE '%"+nomeDisciplina+"%'");
                while(ResultadoSQL2.next()){
                    menuDisciplinas+="  ID : "+ResultadoSQL2.getInt("id")+"\n";
                }
            }
            System.out.println(menuDisciplinas);
            //Agora selecionar a etapa e a disciplina para pegar o conteudo
            int escolhaIdDisciplina=Integer.parseInt(JOptionPane.showInputDialog(null, "Escolha uma disciplina por id"));
            
            ResultadoSQL1=executaComando1.executeQuery("SELECT id FROM menuEtapas ");
                while(ResultadoSQL1.next()){
                    menuEtapas+=ResultadoSQL1.getInt("id")+" ";
                }
            
            System.out.println("Etapas existentes: "+menuEtapas);
            int escolhaIdEtapa=Integer.parseInt(JOptionPane.showInputDialog(null, "Escolha uma etapa por id"));
            
            
            ResultadoSQL1=executaComando1.executeQuery("SELECT id FROM conteudos WHERE idEtapa LIKE '%"+escolhaIdEtapa+"%' && idDisciplina LIKE '%"+escolhaIdDisciplina+"%'");//N FUNCIONA
            while(ResultadoSQL1.next()){
                idConteudo=ResultadoSQL1.getInt("id");
                System.out.print("\nConteudo "+idConteudo+": ");
                ResultadoSQL2=executaComando2.executeQuery("SELECT conteudo FROM conteudos WHERE id LIKE '%"+idConteudo+"%' && idDisciplina LIKE '%"+escolhaIdDisciplina+"%'");//N FUNCIONA
                while(ResultadoSQL2.next()){
                    String conteudo=ResultadoSQL2.getString("conteudo");
                    System.out.print(conteudo);
                }
                
            }
        }catch(SQLException ex){
            System.out.println("SQLExeption: "+ ex.getMessage());
            System.out.println("SQLState: "+ ex.getSQLState());
            System.out.println("VendorError : "+ ex.getErrorCode());
        }
    }
}

