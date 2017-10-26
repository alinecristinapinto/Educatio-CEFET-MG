/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package educatio.app.model.Login;

import educatio.app.view.Login.GerentesTelaCadastroController;
import educatio.app.view.Login.GerentesTelaDeLoginController;
import java.sql.*;


public class GerentesConexaoBDLogin {

    private Connection conexao;
    GerentesTelaDeLoginController controller;
    GerentesTelaCadastroController controller2;
    
    public void conectar() {
        
        try {
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e) {
            System.err.println("Driver não encontrado!" + e);
        }
        try {
            conexao = DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio","root","usbw");
        } catch (SQLException ex) {
            System.err.println("Erro ao conectar com o banco de dados!");
        }
    }

    public void setController(GerentesTelaDeLoginController controller) {
        this.controller = controller;
    }
    
     public void setController2(GerentesTelaCadastroController controller) {
        this.controller2 = controller;
    }
    
     
    public ResultSet enviarQueryResultados(String query) throws SQLException {
        Statement comando = conexao.createStatement();
        ResultSet resultado = comando.executeQuery(query);
        boolean existeLogin;
        
        existeLogin = resultado.first();
        
        if(existeLogin)
          controller.setExisteLogin(existeLogin);
        
        
        return resultado;
    }
    
    public ResultSet enviarQueryResultados2(String query) throws SQLException {
        Statement comando = conexao.createStatement();
        ResultSet resultado = comando.executeQuery(query);
        boolean existeLogin;
        
        existeLogin = resultado.first();
        
        if(existeLogin)
          controller2.setExisteLogin(existeLogin);
        
        
        return resultado;
    }
     
    
    public boolean enviarQuery(String query) throws SQLException{
        Statement comando = conexao.createStatement();
        boolean resultado = comando.execute(query);
        return resultado;
    }
    
    public boolean enviarQueryCadastro(String senha,String id,String usuario) throws SQLException{
        PreparedStatement query = null;
        if(usuario.equals("Aluno"))
        {
           query = conexao.prepareStatement("UPDATE alunos SET senha=?, ativo ='S' WHERE idCPF=?");
        }else if(usuario.equals("Funcionario"))
        {
           query = conexao.prepareStatement("UPDATE funcionario SET senha=?, ativo ='S' WHERE idSIAPE=?");
        }
        
        query.setString(1,senha);
        query.setString(2,id);
        
        boolean resultado = query.execute();
       
        return resultado;
    }
}
