package tpfinal.fx;

import java.sql.*;
import java.util.Optional;
import javafx.scene.control.Alert;
import javafx.scene.control.ButtonType;
import javafx.scene.control.DialogPane;
import javafx.scene.layout.Region;
import javax.swing.JOptionPane;


public class ManutencaoDepartamento {
    
    public void CriarDepartamento(int IdCampus, String nome) throws SQLException{
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if(connection!=null){
            
        }else{
            System.out.println("deu ruim :(");
        }
        
        Departamento temp = new Departamento (IdCampus, nome);
        
        
        
        sql = "INSERT INTO `deptos`"
                      + "(`id`, `idCampi`, `nome`, `ativo`)"
                      + "VALUES (NULL, ?, ?, ?)";
        
        
        try {
		        // prepared statement para inser��o
		        PreparedStatement stmt = connection.prepareStatement(sql);

		        // seta os valores

		        stmt.setInt(1, temp.getIdCampi());
		        stmt.setString(2, temp.getNome());
		        stmt.setString(3, "S");

		        // executa
		        stmt.execute();
		        stmt.close();
		    } catch (SQLException e) {
		        throw new RuntimeException(e);
		    }
        
    }
    
    
    public void AlterarDepartamento(String nome, String campiT, String depto){
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if(connection!=null){   
        }else{
            System.out.println("deu ruim :(");
        }
        
        int campusN;
        String auxIdNome = null;
        String auxData = null;
        
        
        
        
        
        if(!campiT.equals("")){
            campusN = Integer.parseInt(campiT);
            auxData = " SET `idCampi` = '"+campusN+"' ";
            
            if(!nome.equals("")){
                auxData += ", `nome` = '"+nome+"'";
            }
        }else{
            if(!nome.equals("")){
                auxData = " SET `nome` = '"+nome+"'";
            }
        }
        if(auxData!=null){
            sql = "UPDATE `deptos`"
                    + auxData
                    + " WHERE `deptos`.`nome` = '"+depto+"'";
            try {
                PreparedStatement stmt = connection.prepareStatement(sql);
                stmt.execute();
                stmt.close();
            } catch (SQLException e) {
                throw new RuntimeException(e);
            }
        } else {
        }

    }
    
    private boolean handleFuncionarioSubordinado(String campo, Object data) throws SQLException{
        boolean flag = false;
        String sql = null;
        String alerta= " ";
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if(connection!=null){   
        }else{
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        sql = "SELECT * FROM deptos WHERE ativo='S'";
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        int idDepto = -1;
        while(result.next()){
            if(data.equals(result.getObject(campo))){
                idDepto = result.getInt("id");
            }
        }
        sql = "SELECT * FROM funcionario WHERE ativo='S'";
        fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        while(result.next()){
            if(idDepto == result.getInt("idDepto")){
                flag = true;
                String add = result.getString("nome");
                alerta = alerta+add+"\n";
            }
        }
        if (flag = true){
            Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
            alert.setTitle("Subordinação de Funcionários");
            alert.setHeaderText("Existem funcionários nesse Departamento");
            alert.setContentText(alerta+"Eles também serão excluidos, está certo disso?\n");
            alert.getDialogPane().setMinHeight(Region.USE_PREF_SIZE);
                
            DialogPane dialogPane = alert.getDialogPane();
            dialogPane.getStylesheets().add(
            getClass().getResource("Padrao.css").toExternalForm());
            dialogPane.getStyleClass().add("myDialog");

            Optional<ButtonType> resulta = alert.showAndWait();
            if (resulta.get() == ButtonType.OK){
                System.out.println("Executa função de outro grupo");
                return true;
            } else {
                return false;
            }
        }
        return true;     
    }

    
    private boolean handleCursoSubordinado(String campo, Object data) throws SQLException{
        boolean flag = false;
        String sql = null;
        String alerta= " ";
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if(connection!=null){   
        }else{
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        sql = "SELECT * FROM deptos WHERE ativo='S'";
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        int idDepto = -1;
        while(result.next()){
            if(data.equals(result.getObject(campo))){
                idDepto = result.getInt("id");
            }
        }
        sql = "SELECT * FROM cursos WHERE ativo='S'";
        fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        while(result.next()){
            if(idDepto == result.getInt("idDepto")){
                flag = true;
                String add = result.getString("nome");
                alerta = alerta+add+"\n";
            }
        }
        if (flag = true){
            Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
            alert.setTitle("Subordinação de Cursos");
            alert.setHeaderText("Existem cursos nesse Departamento");
            alert.setContentText(alerta+"Eles também serão excluidos, está certo disso?\n");
            alert.getDialogPane().setMinHeight(Region.USE_PREF_SIZE);
                
            DialogPane dialogPane = alert.getDialogPane();
            dialogPane.getStylesheets().add(
            getClass().getResource("Padrao.css").toExternalForm());
            dialogPane.getStyleClass().add("myDialog");

            Optional<ButtonType> resulta = alert.showAndWait();
            if (resulta.get() == ButtonType.OK){
                System.out.println("Executa função de outro grupo");
                return true;
            } else {
                return false;
            }
        }
        return true;     
    }
    
    public void ExcluirDepartamento(String campo, Object data) throws SQLException{
        
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if(connection!=null){
            
        }else{
            System.out.println("deu ruim :(");
        }
        
        
        sql = "SELECT * FROM deptos WHERE "+campo+" = '"+data+"' && ativo='S'";
        Statement fetch = connection.createStatement();
        ResultSet result = fetch.executeQuery(sql);
        while(result.next()){
            if(handleCursoSubordinado("id", result.getInt("id"))){
                if(handleFuncionarioSubordinado("id", result.getInt("id"))){
                    try {
                        sql = "UPDATE `deptos`"
                        + " SET `ativo` = 'N'"
                        + " WHERE `deptos`.`id` = '"+result.getInt("id")+"'";
                        PreparedStatement stmt = connection.prepareStatement(sql);
                        stmt.execute();
                        stmt.close();
                    } catch (SQLException e) {
                        throw new RuntimeException(e);
                    }
                }
            }
        }
    }
}


