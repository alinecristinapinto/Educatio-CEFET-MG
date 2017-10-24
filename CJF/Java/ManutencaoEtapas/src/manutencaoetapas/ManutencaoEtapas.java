package manutencaoetapas;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import javax.swing.JOptionPane;

public class ManutencaoEtapas {

    public static void main(String[] args) throws SQLException {
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
        PreparedStatement executaComando1=null;
        Statement executaComando2=null;
        Statement executaComando3=null;
        Statement executaComando4=null;
        ResultSet ResultadoSQL1=null;
        ResultSet ResultadoSQL2=null;
        ResultSet ResultadoSQL3=null;
        ResultSet ResultadoSQL4=null;
        boolean verificaResultadoSQL1;
        try{
            executaComando1=Conexao.prepareStatement("INSERT INTO etapas (id, valor, ativo) VALUES (?,?,?)");
            executaComando2=Conexao.createStatement();
            executaComando3=Conexao.createStatement();
            executaComando4=Conexao.createStatement();
            String etapasExistentes="";
            int valorEtapa;
            int idEtapa;
            int opcao;
            int idEtapaAlterar;
            int valorEtapaAlterar;
            char aux='S';
            char notAux='N';
            String ativoEtapa;
            
            etapasExistentes="";
            ResultadoSQL1 = executaComando1.executeQuery("SELECT id, valor FROM etapas WHERE ativo='"+aux+"'");
            while(ResultadoSQL1.next()){
                idEtapa=ResultadoSQL1.getInt("id");
                valorEtapa=ResultadoSQL1.getInt("valor");
                if( !etapasExistentes.contains("Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                    etapasExistentes+="Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                }
            }
            System.out.print(etapasExistentes);
            
            //Adiciona nova etapa
            System.out.println("Adicionando nova etapa");
            idEtapa=Integer.parseInt( JOptionPane.showInputDialog(null, "Digite o id da etapa: "));
            //Verificar se aquele id existe na tabela
            ResultadoSQL1=executaComando1.executeQuery("SELECT id FROM etapas WHERE id='"+idEtapa+"' AND ativo='"+aux+"'");
            while(ResultadoSQL1.next()){
                idEtapa=Integer.parseInt(JOptionPane.showInputDialog(null,"ID de etapa ja existe! Digite outro ID."));
                ResultadoSQL1=executaComando1.executeQuery("SELECT id FROM etapas WHERE id='"+idEtapa+"'");
            }
            System.out.println("id da nova etapa: "+idEtapa);
            valorEtapa=Integer.parseInt( JOptionPane.showInputDialog(null, "Digite o valor da etapa: "));
            System.out.println("Valor da nova etapa: "+valorEtapa);
            executaComando1.setInt(1,idEtapa);
            executaComando1.setInt(2,valorEtapa);
            executaComando1.setString(3, "S");
            verificaResultadoSQL1=executaComando1.execute();
            
            if(!verificaResultadoSQL1){
                System.out.println("Insercao realizada com sucesso!");
            }
            //Altera etapa - nao altera o ativo
            
            System.out.println("Alterando etapa");
            System.out.println("Etapas existentes: ");
            
            //metodo de atualizar etapa
            etapasExistentes="";
            ResultadoSQL1 = executaComando1.executeQuery("SELECT id, valor FROM etapas WHERE ativo='"+aux+"'");
            while(ResultadoSQL1.next()){
                idEtapa=ResultadoSQL1.getInt("id");
                valorEtapa=ResultadoSQL1.getInt("valor");
                if( !etapasExistentes.contains("Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                    etapasExistentes+="Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                }
            }
            System.out.print(etapasExistentes);
            
            
            idEtapa=Integer.parseInt(JOptionPane.showInputDialog(null,"Digite o id da etapa a se alterar"));
            ResultadoSQL1=executaComando1.executeQuery("SELECT valor FROM etapas WHERE id='"+idEtapa+"' AND ativo='"+aux+"'");
            while(!ResultadoSQL1.next()){
                System.out.println("Etapa nao existe! Digite outro id de etapa. ");
                System.out.print(etapasExistentes);
                idEtapa=Integer.parseInt(JOptionPane.showInputDialog(null, "Novo id de etapa: "));
            }
            if(ResultadoSQL1.next()){
                valorEtapa=ResultadoSQL1.getInt("valor");
                System.out.println("Etapa selecionada: \nEtapa: "+idEtapa+" valor: "+valorEtapa);
            }
                
            
            opcao=Integer.parseInt(JOptionPane.showInputDialog(null,"Deseja alterar id ou valor? 1-id, 2-valor"));
            switch(opcao){
                case 1:
                    idEtapaAlterar=Integer.parseInt(JOptionPane.showInputDialog(null,"Para qual id voce deseja alterar? - id nao deve existir na tabela"));
                    verificaResultadoSQL1=executaComando1.execute("UPDATE etapas SET id='"+idEtapaAlterar +"'WHERE id='"+idEtapa+"'");
                    //update nao retorna nada-> not nada=alguma coisa
                    if(!verificaResultadoSQL1){
                        System.out.println("Alteracao realizada com sucesso!");
                        ResultadoSQL2=executaComando1.executeQuery("SELECT valor FROM etapas WHERE id='"+idEtapaAlterar+"'");
                        if(ResultadoSQL2.next()){
                            valorEtapa=ResultadoSQL2.getInt("valor");
                            System.out.println("Nova etapa:  Etapa: "+idEtapaAlterar+"  Valor: "+valorEtapa);
                            //Mostra etapas existentes
                            etapasExistentes="";
                            ResultadoSQL1 = executaComando1.executeQuery("SELECT id, valor FROM etapas WHERE ativo='"+aux+"'");
                            while(ResultadoSQL1.next()){
                                idEtapa=ResultadoSQL1.getInt("id");
                                valorEtapa=ResultadoSQL1.getInt("valor");
                                if( !etapasExistentes.contains("Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                                    etapasExistentes+="Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                                }
                            }
                            System.out.println(etapasExistentes); 
                        }
                    }else{
                        while(verificaResultadoSQL1){
                            
                            System.out.println("Erro na alteracao!");
                            //Mostra etapas existentes
                            etapasExistentes="";
                            ResultadoSQL1 = executaComando1.executeQuery("SELECT id, valor FROM etapas WHERE ativo='"+aux+"'");
                            while(ResultadoSQL1.next()){
                                idEtapa=ResultadoSQL1.getInt("id");
                                valorEtapa=ResultadoSQL1.getInt("valor");
                                if( !etapasExistentes.contains("Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                                    etapasExistentes+="Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                                }
                            }
                            System.out.println(etapasExistentes); 
                            idEtapaAlterar=Integer.parseInt(JOptionPane.showInputDialog(null,"Digite outro valor para o id"));
                            verificaResultadoSQL1=executaComando1.execute("UPDATE etapas SET id='"+idEtapaAlterar +"'WHERE id='"+idEtapa+"'");
                        }
                    }
                    break;
                case 2:
                    valorEtapaAlterar=Integer.parseInt(JOptionPane.showInputDialog(null,"Para qual valor voce deseja alterar?"));
                    verificaResultadoSQL1=executaComando1.execute("UPDATE etapas SET valor='"+valorEtapaAlterar +"'WHERE id='"+idEtapa+"'");
                    if(!verificaResultadoSQL1){
                        System.out.println("Alteracao realizada com sucesso!");
                        ResultadoSQL2=executaComando1.executeQuery("SELECT valor FROM etapas");
                        if(ResultadoSQL2.next()){
                            valorEtapa=ResultadoSQL2.getInt("valor");
                            System.out.println("Nova etapa:  Etapa: "+idEtapa+"  Valor: "+valorEtapa);
                        }
                        //Mostrando etapas existentes
                        etapasExistentes="";
                        ResultadoSQL1 = executaComando1.executeQuery("SELECT id, valor FROM etapas WHERE ativo='"+aux+"'");
                        while(ResultadoSQL1.next()){
                            idEtapa=ResultadoSQL1.getInt("id");
                            valorEtapa=ResultadoSQL1.getInt("valor");
                            if( !etapasExistentes.contains("Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                                etapasExistentes+="Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                            }
                        }
                        System.out.println(etapasExistentes);
                    }else{
                        while(verificaResultadoSQL1){
                            System.out.println("Erro na alteracao!");
                            System.out.println(etapasExistentes);
                            idEtapaAlterar=Integer.parseInt(JOptionPane.showInputDialog(null,"Digite outro valor para o id"));
                            verificaResultadoSQL1=executaComando1.execute("UPDATE etapas SET id='"+idEtapaAlterar +"'WHERE id='"+idEtapa+"'");
                        }
                    }
                    break;
            }
            //Exclui etapa - basicamente so iremos trocar o S para N
            //Mostrando etapas existentes
            //metodo de atualizar etapa
            etapasExistentes="";
            ResultadoSQL1 = executaComando1.executeQuery("SELECT id, valor FROM etapas WHERE ativo='"+aux+"'");
            while(ResultadoSQL1.next()){
                idEtapa=ResultadoSQL1.getInt("id");
                valorEtapa=ResultadoSQL1.getInt("valor");
                if( !etapasExistentes.contains("Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                    etapasExistentes+="Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                }
            }
            System.out.println(etapasExistentes);
            idEtapa=Integer.parseInt(JOptionPane.showInputDialog(null,"Digite o id da etapa que deseja excluir"));
            //Verificando idEtapa
            ResultadoSQL1=executaComando1.executeQuery("SELECT id FROM etapas WHERE id='"+idEtapa+"'");
            while(!ResultadoSQL1.next()){
                idEtapa=Integer.parseInt(JOptionPane.showInputDialog(null,"ID de etapa nao existe! Digite outro ID."));
                ResultadoSQL1=executaComando1.executeQuery("SELECT id FROM etapas WHERE id='"+idEtapa+"'");
            }
            verificaResultadoSQL1=executaComando1.execute("UPDATE etapas SET ativo='"+notAux+"' WHERE id='"+idEtapa+"'");
            while(verificaResultadoSQL1){
                System.out.println("Etapa nao existe! Digite outro id de etapa. ");
                etapasExistentes="";
                ResultadoSQL2 = executaComando2.executeQuery("SELECT id, valor FROM etapas WHERE ativo='"+aux+"'");
                while(ResultadoSQL2.next()){
                    idEtapa=ResultadoSQL2.getInt("id");
                    valorEtapa=ResultadoSQL2.getInt("valor");
                    if( !etapasExistentes.contains("Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                        etapasExistentes+="Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                    }
                }
                System.out.print(etapasExistentes);
                idEtapa=Integer.parseInt(JOptionPane.showInputDialog(null, "Novo id de etapa: "));
            }
            if(!verificaResultadoSQL1){
                System.out.println("Etapa de id igual a "+idEtapa+" apagada com sucesso.Dados que  armazenados: ");
                ResultadoSQL2 = executaComando2.executeQuery("SELECT ativo, valor FROM etapas WHERE id='"+idEtapa+"'");
                if(ResultadoSQL2.next()){
                    ativoEtapa=ResultadoSQL2.getString("ativo");
                    System.out.println("Ativo atual: "+ativoEtapa);
                    valorEtapa=ResultadoSQL2.getInt("valor");
                    System.out.println("Valor: "+valorEtapa);
                }
                //Agora mostrar todas as etapas existentes
                etapasExistentes="";
                ResultadoSQL1 = executaComando1.executeQuery("SELECT id, valor FROM etapas WHERE ativo='"+aux+"'");
                while(ResultadoSQL1.next()){
                    idEtapa=ResultadoSQL1.getInt("id");
                    valorEtapa=ResultadoSQL1.getInt("valor");
                    if( !etapasExistentes.contains("Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                        etapasExistentes+="Etapa: "+idEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                    }
                }
                System.out.println("etapasExistentes: "+etapasExistentes);
            }
        }catch(SQLException ex){
            System.out.println("SQLException: "+ ex.getMessage());
            System.out.println("SQLState: "+ ex.getSQLState());
            System.out.println("VendorError : "+ ex.getErrorCode());
        }
    }
}
