package relatorio8.controlador;
import relatorio8.view.Relatorio8;
import java.awt.List;
import java.net.URL;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.ResourceBundle;

import com.sun.javafx.beans.IDProperty;



import java.sql.PreparedStatement;

import java.sql.Statement;
import java.util.Arrays;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.Button;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.Control;
import javafx.scene.control.Label;
import relatorio8.model.*;
import relatorio8.bd.*;
public class Relatorio8BaseControlador implements Initializable {

    private Relatorio8 relatorio8;
    private Relatorio8Dao dao;
    private Relatorio8Aluno aluno;
    private Connection conexao;
    private boolean okClicado;
    private ResultSet result;
    private String sql;
    private PreparedStatement stmt;

    /*
    sql = "SELECT idDepto, id FROM cursos WHERE nome = '"+VARIAVEL+"'";
    stmt = conexao.prepareStatement(sql);
    result = stmt.executeQuery();
    while(result.next()){
         valor = result.getTIPO("COLUNA");
    }*/



    public Relatorio8BaseControlador() throws SQLException {
    	this.conexao = new CriaConexao().getConexao();

    }


    public void setRelatorio8(Relatorio8 relatorio8){
        this.relatorio8=relatorio8;
    }


    public void initialize(URL url, ResourceBundle rb) {

    }

    public void mostraRelatorio () throws SQLException {
    	aluno = new Relatorio8Aluno();
    	//CPF DO ALUNO a ser pego do login
    	String cpf = "70264415400";
    	dao = new Relatorio8Dao(cpf);

    	//Conclusao a ser pega pela funcao q verifica a validade do certificado
    	boolean conclusao=true;
    	aluno = dao.getAluno(cpf);

    	if(dao.testaRelatorio()==true){
    		boolean okclic;
    		okclic = relatorio8.invocaCertificado(aluno);
    	}else{
    		Alert alert = new Alert(AlertType.WARNING);
    		alert.setTitle("Erro");
    		alert.setHeaderText("O certificado não pode ser mostrado!");
    		alert.setContentText("Voce ainda nao concluiu seu curso.");

    		alert.showAndWait();

    	}


    }









}


