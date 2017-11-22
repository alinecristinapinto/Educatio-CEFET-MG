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

        //estabelecendo conexao com o bd test
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
            executaComando1=Conexao.prepareStatement("INSERT INTO etapas (idOrdem, valor, ativo) VALUES (?,?,?)");
            executaComando2=Conexao.createStatement();
            executaComando3=Conexao.createStatement();
            executaComando4=Conexao.createStatement();
            String etapasExistentes="";
            int valorEtapa;
            int idOrdemEtapa;
            int opcao;
            int idOrdemEtapaAlterar;
            int valorEtapaAlterar;
            char aux='S';
            char notAux='N';
            String ativoEtapa;
            
            etapasExistentes="";
            ResultadoSQL1 = executaComando1.executeQuery("SELECT idOrdem, valor FROM etapas WHERE ativo='"+aux+"'");
            while(ResultadoSQL1.next()){
                idOrdemEtapa=ResultadoSQL1.getInt("idOrdem");
                valorEtapa=ResultadoSQL1.getInt("valor");
                if( !etapasExistentes.contains("Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                    etapasExistentes+="Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                }
            }
            System.out.print(etapasExistentes);
            
            //Adiciona nova etapa
            System.out.println("Adicionando nova etapa");
            idOrdemEtapa=Integer.parseInt( JOptionPane.showInputDialog(null, "Digite o idOrdem da etapa: "));
            //Verificar se aquele idOrdem existe na tabela
            ResultadoSQL1=executaComando1.executeQuery("SELECT idOrdem FROM etapas WHERE idOrdem='"+idOrdemEtapa+"' AND ativo='"+aux+"'");
            while(ResultadoSQL1.next()){
                idOrdemEtapa=Integer.parseInt(JOptionPane.showInputDialog(null,"ID de etapa ja existe! Digite outro ID."));
                ResultadoSQL1=executaComando1.executeQuery("SELECT idOrdem FROM etapas WHERE idOrdem='"+idOrdemEtapa+"'");
            }
            System.out.println("idOrdem da nova etapa: "+idOrdemEtapa);
            valorEtapa=Integer.parseInt( JOptionPane.showInputDialog(null, "Digite o valor da etapa: "));
            System.out.println("Valor da nova etapa: "+valorEtapa);
            executaComando1.setInt(1,idOrdemEtapa);
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
            ResultadoSQL1 = executaComando1.executeQuery("SELECT idOrdem, valor FROM etapas WHERE ativo='"+aux+"'");
            while(ResultadoSQL1.next()){
                idOrdemEtapa=ResultadoSQL1.getInt("idOrdem");
                valorEtapa=ResultadoSQL1.getInt("valor");
                if( !etapasExistentes.contains("Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                    etapasExistentes+="Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                }
            }
            System.out.print(etapasExistentes);
            
            
            idOrdemEtapa=Integer.parseInt(JOptionPane.showInputDialog(null,"Digite o idOrdem da etapa a se alterar"));
            ResultadoSQL1=executaComando1.executeQuery("SELECT valor FROM etapas WHERE idOrdem='"+idOrdemEtapa+"' AND ativo='"+aux+"'");
            while(!ResultadoSQL1.next()){
                System.out.println("Etapa nao existe! Digite outro idOrdem de etapa. ");
                System.out.print(etapasExistentes);
                idOrdemEtapa=Integer.parseInt(JOptionPane.showInputDialog(null, "Novo idOrdem de etapa: "));
            }
            if(ResultadoSQL1.next()){
                valorEtapa=ResultadoSQL1.getInt("valor");
                System.out.println("Etapa selecionada: \nEtapa: "+idOrdemEtapa+" valor: "+valorEtapa);
            }
                
            
            opcao=Integer.parseInt(JOptionPane.showInputDialog(null,"Deseja alterar idOrdem ou valor? 1-idOrdem, 2-valor"));
            switch(opcao){
                case 1:
                    idOrdemEtapaAlterar=Integer.parseInt(JOptionPane.showInputDialog(null,"Para qual idOrdem voce deseja alterar? - idOrdem nao deve existir na tabela"));
                    verificaResultadoSQL1=executaComando1.execute("UPDATE etapas SET idOrdem='"+idOrdemEtapaAlterar +"'WHERE idOrdem='"+idOrdemEtapa+"'");
                    //update nao retorna nada-> not nada=alguma coisa
                    if(!verificaResultadoSQL1){
                        System.out.println("Alteracao realizada com sucesso!");
                        ResultadoSQL2=executaComando1.executeQuery("SELECT valor FROM etapas WHERE idOrdem='"+idOrdemEtapaAlterar+"'");
                        if(ResultadoSQL2.next()){
                            valorEtapa=ResultadoSQL2.getInt("valor");
                            System.out.println("Nova etapa:  Etapa: "+idOrdemEtapaAlterar+"  Valor: "+valorEtapa);
                            //Mostra etapas existentes
                            etapasExistentes="";
                            ResultadoSQL1 = executaComando1.executeQuery("SELECT idOrdem, valor FROM etapas WHERE ativo='"+aux+"'");
                            while(ResultadoSQL1.next()){
                                idOrdemEtapa=ResultadoSQL1.getInt("idOrdem");
                                valorEtapa=ResultadoSQL1.getInt("valor");
                                if( !etapasExistentes.contains("Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                                    etapasExistentes+="Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                                }
                            }
                            System.out.println(etapasExistentes); 
                        }
                    }else{
                        while(verificaResultadoSQL1){
                            
                            System.out.println("Erro na alteracao!");
                            //Mostra etapas existentes
                            etapasExistentes="";
                            ResultadoSQL1 = executaComando1.executeQuery("SELECT idOrdem, valor FROM etapas WHERE ativo='"+aux+"'");
                            while(ResultadoSQL1.next()){
                                idOrdemEtapa=ResultadoSQL1.getInt("idOrdem");
                                valorEtapa=ResultadoSQL1.getInt("valor");
                                if( !etapasExistentes.contains("Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                                    etapasExistentes+="Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                                }
                            }
                            System.out.println(etapasExistentes); 
                            idOrdemEtapaAlterar=Integer.parseInt(JOptionPane.showInputDialog(null,"Digite outro valor para o idOrdem"));
                            verificaResultadoSQL1=executaComando1.execute("UPDATE etapas SET idOrdem='"+idOrdemEtapaAlterar +"'WHERE idOrdem='"+idOrdemEtapa+"'");
                        }
                    }
                    break;
                case 2:
                    valorEtapaAlterar=Integer.parseInt(JOptionPane.showInputDialog(null,"Para qual valor voce deseja alterar?"));
                    verificaResultadoSQL1=executaComando1.execute("UPDATE etapas SET valor='"+valorEtapaAlterar +"'WHERE idOrdem='"+idOrdemEtapa+"'");
                    if(!verificaResultadoSQL1){
                        System.out.println("Alteracao realizada com sucesso!");
                        ResultadoSQL2=executaComando1.executeQuery("SELECT valor FROM etapas");
                        if(ResultadoSQL2.next()){
                            valorEtapa=ResultadoSQL2.getInt("valor");
                            System.out.println("Nova etapa:  Etapa: "+idOrdemEtapa+"  Valor: "+valorEtapa);
                        }
                        //Mostrando etapas existentes
                        etapasExistentes="";
                        ResultadoSQL1 = executaComando1.executeQuery("SELECT idOrdem, valor FROM etapas WHERE ativo='"+aux+"'");
                        while(ResultadoSQL1.next()){
                            idOrdemEtapa=ResultadoSQL1.getInt("idOrdem");
                            valorEtapa=ResultadoSQL1.getInt("valor");
                            if( !etapasExistentes.contains("Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                                etapasExistentes+="Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                            }
                        }
                        System.out.println(etapasExistentes);
                    }else{
                        while(verificaResultadoSQL1){
                            System.out.println("Erro na alteracao!");
                            System.out.println(etapasExistentes);
                            idOrdemEtapaAlterar=Integer.parseInt(JOptionPane.showInputDialog(null,"Digite outro valor para o idOrdem"));
                            verificaResultadoSQL1=executaComando1.execute("UPDATE etapas SET idOrdem='"+idOrdemEtapaAlterar +"'WHERE idOrdem='"+idOrdemEtapa+"'");
                        }
                    }
                    break;
            }
            //Exclui etapa - basicamente so iremos trocar o S para N
            //Mostrando etapas existentes
            //metodo de atualizar etapa
            etapasExistentes="";
            ResultadoSQL1 = executaComando1.executeQuery("SELECT idOrdem, valor FROM etapas WHERE ativo='"+aux+"'");
            while(ResultadoSQL1.next()){
                idOrdemEtapa=ResultadoSQL1.getInt("idOrdem");
                valorEtapa=ResultadoSQL1.getInt("valor");
                if( !etapasExistentes.contains("Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                    etapasExistentes+="Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                }
            }
            System.out.println(etapasExistentes);
            idOrdemEtapa=Integer.parseInt(JOptionPane.showInputDialog(null,"Digite o idOrdem da etapa que deseja excluir"));
            //Verificando idOrdemEtapa
            ResultadoSQL1=executaComando1.executeQuery("SELECT idOrdem FROM etapas WHERE idOrdem='"+idOrdemEtapa+"'");
            while(!ResultadoSQL1.next()){
                idOrdemEtapa=Integer.parseInt(JOptionPane.showInputDialog(null,"ID de etapa nao existe! Digite outro ID."));
                ResultadoSQL1=executaComando1.executeQuery("SELECT idOrdem FROM etapas WHERE idOrdem='"+idOrdemEtapa+"'");
            }
            verificaResultadoSQL1=executaComando1.execute("UPDATE etapas SET ativo='"+notAux+"' WHERE idOrdem='"+idOrdemEtapa+"'");
            while(verificaResultadoSQL1){
                System.out.println("Etapa nao existe! Digite outro idOrdem de etapa. ");
                etapasExistentes="";
                ResultadoSQL2 = executaComando2.executeQuery("SELECT idOrdem, valor FROM etapas WHERE ativo='"+aux+"'");
                while(ResultadoSQL2.next()){
                    idOrdemEtapa=ResultadoSQL2.getInt("idOrdem");
                    valorEtapa=ResultadoSQL2.getInt("valor");
                    if( !etapasExistentes.contains("Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                        etapasExistentes+="Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
                    }
                }
                System.out.print(etapasExistentes);
                idOrdemEtapa=Integer.parseInt(JOptionPane.showInputDialog(null, "Novo idOrdem de etapa: "));
            }
            if(!verificaResultadoSQL1){
                System.out.println("Etapa de idOrdem igual a "+idOrdemEtapa+" apagada com sucesso.Dados que  armazenados: ");
                ResultadoSQL2 = executaComando2.executeQuery("SELECT ativo, valor FROM etapas WHERE idOrdem='"+idOrdemEtapa+"'");
                if(ResultadoSQL2.next()){
                    ativoEtapa=ResultadoSQL2.getString("ativo");
                    System.out.println("Ativo atual: "+ativoEtapa);
                    valorEtapa=ResultadoSQL2.getInt("valor");
                    System.out.println("Valor: "+valorEtapa);
                }
                //Agora mostrar todas as etapas existentes
                etapasExistentes="";
                ResultadoSQL1 = executaComando1.executeQuery("SELECT idOrdem, valor FROM etapas WHERE ativo='"+aux+"'");
                while(ResultadoSQL1.next()){
                    idOrdemEtapa=ResultadoSQL1.getInt("idOrdem");
                    valorEtapa=ResultadoSQL1.getInt("valor");
                    if( !etapasExistentes.contains("Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n")){
                        etapasExistentes+="Etapa: "+idOrdemEtapa+"  Valor da Etapa: "+valorEtapa+"\n";
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
