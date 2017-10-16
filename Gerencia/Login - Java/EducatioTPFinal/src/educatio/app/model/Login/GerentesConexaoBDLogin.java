/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package educatio.app.model.Login;

import educatio.app.view.Login.GerentesTelaDeLoginController;
import java.sql.*;


public class GerentesConexaoBDLogin {

    private Connection conexao;
    GerentesTelaDeLoginController controller;
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
    
    public ResultSet enviarQueryResultados(String query) throws SQLException {
        Statement comando = conexao.createStatement();
        ResultSet resultado = comando.executeQuery(query);
        boolean existeLogin;
        
        existeLogin = resultado.first();
        
        if(existeLogin)
          controller.setExisteLogin(existeLogin);
        
        
        return resultado;
    }
}
