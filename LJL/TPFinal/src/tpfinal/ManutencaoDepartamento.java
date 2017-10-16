package tpfinal;

import java.sql.*;
import javax.swing.JOptionPane;


public class ManutencaoDepartamento {
    
    public void CriarDepartamento() throws SQLException{
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if(connection!=null){
            
        }else{
            System.out.println("deu ruim :(");
        }
        
        int IdCampus = 0;
        String nome = null;
        boolean fl;
        
        
        do{
            fl = false;
            try{
                IdCampus = Integer.parseInt(JOptionPane.showInputDialog("Id do campus do novo Departamento"));
            }
            catch(NumberFormatException e){
                JOptionPane.showMessageDialog(null, "Digite um INTEIRO!\n"+e);
                fl=true;
            }
        }while(fl==true);
        
        do{
            fl = false;
            try{
                nome = JOptionPane.showInputDialog("Nome do novo Departamento");
                if (nome == null || nome == ""){
                    throw new ExcecaoNomeNulo("Dê um nome ao departamento!");
                }
            }catch (ExcecaoNomeNulo e){
                JOptionPane.showMessageDialog(null, e);
                fl=true;
            }
        }while(fl==true);
        
        Departamento temp = new Departamento (IdCampus, nome);
        
        Object[] options = { "Confirmar", "Cancelar" };
        if (JOptionPane.showOptionDialog(null, "Confirme a criação:\nLocalizado no campus: "+IdCampus+"\nNome: "+nome, "Confirmação", JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, options, options[0]) == 0){
                sql = "INSERT INTO `deptos`"
                      + "(`id`, `idCampi`, `nome`, `ativo`)"
                      + "VALUES (NULL, ?, ?, ?)";
        }
        
        try {
		        // prepared statement para inser��o
		        PreparedStatement stmt = connection.prepareStatement(sql);

		        // seta os valores

		        stmt.setInt(1, temp.getIdCampi());
		        stmt.setString(2, temp.getNome());
		        stmt.setString(3, "s");

		        // executa
		        stmt.execute();
		        stmt.close();
		    } catch (SQLException e) {
		        throw new RuntimeException(e);
		    }
        
    }
    
    
    public void AlterarDepartamento(){
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if(connection!=null){
            
        }else{
            System.out.println("deu ruim :(");
        }
        int opc = 0;
        int IDAlterar = 0;
        String NmAlterar = null;
        boolean fl = false;
        boolean flagID = false;
        boolean flagExc;
        boolean flag = false;
        String auxIdNome = null;
        String auxData = null;
        int i;
        int dataInt = 0;
        String dataString = null;
        
        
        Object[] options = { "ID", "NOME" };
        opc = JOptionPane.showOptionDialog(null, "ID ou Nome?", "ID/Nome",  JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, options, options[0]);
        if (opc == 0)
            IDAlterar = Integer.parseInt(JOptionPane.showInputDialog("Qual departamento será alterado?"));
        else
            NmAlterar = JOptionPane.showInputDialog("Qual departamento será alterado?");
        
        
        if(opc == 0){
            auxIdNome = "`id` = '"+IDAlterar+"'";
	}else{
            auxIdNome = "`nome` = '"+NmAlterar+"'";
	}

        //if (fl = false && flagID == true){
            Object[] option = { "Confirmar", "Cancelar" };
            if (JOptionPane.showOptionDialog(null, "Deseja realmente alterar o departamento?", "Confirmação", JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, option, option[0]) == 0){
            
                Object[] optionn = { "Nome", "Campus", "Cancelar" };
                int selecionado = JOptionPane.showOptionDialog(null, "O que gostaria de alterar?", "Alterar", JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, optionn, optionn[0]);
            
                if (selecionado == 0){
                    do{
                        flagExc = false;
                        try{
                            dataString = (JOptionPane.showInputDialog("Digite o novo nome"));
                            if (dataString == null){
                                throw new ExcecaoNomeNulo("Digite um nome!");
                            }
                        }
                        catch (ExcecaoNomeNulo e){
                        JOptionPane.showMessageDialog(null, e);
                        flagExc=true;
                        }
                    }while(flagExc==true);
                    
                    auxData = " SET `nome` = '"+dataString+"'";
                    
                }
                else{
                    if (selecionado == 1){
                        try{
                            dataInt = Integer.parseInt(JOptionPane.showInputDialog("Digite o novo campus"));
                        }catch (NumberFormatException e){
                            System.err.println(e);
                        }
                        auxData = " SET `idCampi` = '"+dataInt+"'";
                    }
                }
                sql = "UPDATE `deptos`"
                + auxData
                + " WHERE `deptos`."+auxIdNome;
                try {
		    // prepared statement para inser��o
		    PreparedStatement stmt = connection.prepareStatement(sql);
                    stmt.execute();
		    stmt.close();
                } catch (SQLException e) {
		    throw new RuntimeException(e);
		}
            }
        //}
    }
    
    public void InativarDepartamento(){
        
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if(connection!=null){
            
        }else{
            System.out.println("deu ruim :(");
        }
        
        int i;
        int IDDel = 0;
        String NmDel = null;
        String aux = null;
        int opc = 0;
        boolean flagID = false;
        
        Object[] options = { "ID", "NOME" };
        opc = JOptionPane.showOptionDialog(null, "ID ou Nome?", "ID/Nome",  JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, options, options[0]);
        if (opc == 0)
            IDDel = Integer.parseInt(JOptionPane.showInputDialog("Qual departamento será Desativado?"));
        else
            NmDel = JOptionPane.showInputDialog("Qual departamento será Desativado?");
        
        if(opc == 0){
            aux = "`id` = '"+IDDel+"'";
	}else{
            aux = "`nome` = '"+NmDel+"'";
	}
        //if (fl = false && flagID == true){
            Object[] option = { "Confirmar", "Cancelar" };
            if (JOptionPane.showOptionDialog(null, "Deseja realmente desativar o departamento?", "Confirmação", JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, option, option[0]) == 0){
                sql = "UPDATE `deptos`"
                + " SET `ativo` = 'n'"
                + " WHERE `deptos`."+aux;
                try {
		    // prepared statement para inser��o
		    PreparedStatement stmt = connection.prepareStatement(sql);
                    stmt.execute();
		    stmt.close();
                } catch (SQLException e) {
		    throw new RuntimeException(e);
		}
                //desativar outros grupos
            }
        //}    
    }
    /*
    public String ProcurarDepartamento (){
        
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if(connection!=null){
            
        }else{
            System.out.println("deu ruim :(");
        }
        
        int ID;
        String Nm;
        int opc;
        
       
        Object[] options = { "ID", "NOME" };
        opc = JOptionPane.showOptionDialog(null, "ID ou Nome?", "ID/Nome",  JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, options, options[0]);
        if (opc == 0)
            ID = Integer.parseInt(JOptionPane.showInputDialog("Qual departamento?"));
        else
            Nm = JOptionPane.showInputDialog("Qual departamento?");
        
        
        
                for (i=0; i<depto.length; i++){
                    if(depto[i]!=null){
                    if(depto[i].getId()==IDDept && flag == false){
                        IDDept = i;
                        flag = true;
                    }
                }
                }
                }
                catch(NumberFormatException e){
                fl = true;
                }
            }while (fl == true);
            JOptionPane.showMessageDialog(null, depto[IDDept].paraString());
    }*/
    
}
