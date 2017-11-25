package controlador;
import java.awt.List;
import java.net.URL;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.ResourceBundle;

import com.sun.javafx.beans.IDProperty;

import bd.CriaConexao;

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
import model.Relatorio9Campi;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.Control;
import javafx.scene.control.Label;
import model.Relatorio9Campi;
import model.Relatorio9Professor;
import view.*;
public class Relatorio9BaseControlador implements Initializable {

    private Relatorio9 relatorio9;
    private Connection conexao;
    private boolean okClicado;
    private ResultSet result;
    private String sql;
    private PreparedStatement stmt;
    private ObservableList<String> listaCampus;

    @FXML
    private Label campoErro;
    @FXML
    private Label esconderLabel;
    @FXML
    private Control escondBotao;
    @FXML
    private ChoiceBox caixaSelecao1;
    @FXML
    private ChoiceBox caixaSelecao2;
    private ObservableList<String> nomesCampi;
    private ObservableList<String> nomesCursos;
    private ObservableList<Relatorio9Professor> professores = FXCollections.observableArrayList();


    public Relatorio9BaseControlador() throws SQLException{
    	//faz conexao com banco de dados
    	this.conexao = new CriaConexao().getConexao();
        nomesCampi = FXCollections.observableArrayList();
        sql = "SELECT nome FROM campi WHERE ativo='S'";
        Statement stmt1 = conexao.createStatement();
        ResultSet resultado = stmt1.executeQuery(sql);
        while(resultado.next()){
            nomesCampi.add(resultado.getString("nome"));
        }
        resultado.close();
    }


    public void setRelatorio9(Relatorio9 relatorio9){
        this.relatorio9=relatorio9;
    }

    public void proximo() throws SQLException{
    	try {
	    	//Testa se campo esta vazio
	    	if (caixaSelecao1.getValue()==null){
                    Alert alert = new Alert(AlertType.ERROR);
                    alert.setTitle("Erro");
                    alert.setHeaderText("Nenhum campus selecionado");
                    alert.setContentText("Favor selecionar um campus !!");

                    alert.showAndWait();
	    	}else{

		    	//Prepara statement pra selecao de dados
		    	sql = "SELECT id, cidade, UF FROM campi WHERE nome = '"+caixaSelecao1.getValue().toString()+"'";
		    	PreparedStatement stmt = conexao.prepareStatement(sql);
		    	ResultSet result = stmt.executeQuery();
		    	Relatorio9Campi campus = new Relatorio9Campi();
		    	campus.setNome(caixaSelecao1.getValue().toString());
		    	int contador = 0;
		    	while(result.next()){
			    	campus.setIdCampus(result.getInt("id"));
			    	campus.setCidade(result.getString("cidade"));
			    	campus.setUf(result.getString("UF"));

			    	contador++;
		    	}
		        //Tornando elemenos visiveis
		    	esconderLabel.setText("Curso a ser selecionado do "+campus.getNomeCampus()+":");
	                escondBotao.setVisible(true);
                        caixaSelecao2.setVisible(true);

		    	//Seleciona o id dos departamentos ativos que estao no campus selecionado
	    		sql = "SELECT id FROM deptos WHERE idCampi ='"+campus.getIdCampus()+"' AND ativo='S' " ;
	    		stmt = conexao.prepareStatement(sql);
	    		result = stmt.executeQuery();
	    		ArrayList idDeptos = new ArrayList();
	    		int i=0;
		    	while (result.next()){
		    		idDeptos.add(result.getInt("id"));
		    		i++;
		    	}
		    	//Selecionando id e nome cursos ativos e guardando em lists
		    	int j = 0;
	    		ArrayList idCursos = new ArrayList();
                        nomesCursos = FXCollections.observableArrayList();
		    	for (int k=0 ; k<idDeptos.size() ; k++){
		    		sql = "SELECT id, nome FROM cursos WHERE idDepto = "+idDeptos.get(k)+" AND ativo='S'" ;
		    		stmt = conexao.prepareStatement(sql);
		    		result = stmt.executeQuery();
		    		while(result.next()){
		    			idCursos.add(result.getInt("id"));
		    			nomesCursos.add(result.getString("nome"));
		    		}
                                caixaSelecao2.setItems(nomesCursos);

		    	}//for



	    	}//else
    	}//try
    	catch (SQLException e) {
    		throw new RuntimeException(e);
	    }
    }
        public void proxJanela () throws SQLException{
            if (caixaSelecao2.getValue()==null){
                    Alert alert = new Alert(AlertType.ERROR);
                    alert.setTitle("Erro");
                    alert.setHeaderText("Nenhum curso selecionado");
                    alert.setContentText("Favor selecionar um curso !!");

                    alert.showAndWait();
            }else{
            try {

             String nomeCursoSelecionado = caixaSelecao2.getValue().toString();
             ArrayList idSIAPEProfessores = new ArrayList();
             ArrayList nomeProfessores = new ArrayList();
             ArrayList cargaHorariaMinimaDisciplinas = new ArrayList();
//             int cargaHorariaMinimaDisciplinas[] = null;


             //Pega id e dados do curso que foi selecionado
             int idDeptoCursoSelecionado = 0;
             int idCursoSelecionado = 0;
             sql = "SELECT idDepto, id FROM cursos WHERE nome = '"+caixaSelecao2.getValue().toString()+"'";
             stmt = conexao.prepareStatement(sql);
             result = stmt.executeQuery();

             while(result.next()){
	              idDeptoCursoSelecionado = result.getInt("idDepto");
	              idCursoSelecionado = result.getInt("id");
             }

             //Pegar nome do departamento
             String nomeDeptoCursoSelecionado=null;
             sql = "SELECT nome FROM deptos WHERE id = '"+idDeptoCursoSelecionado +"'";
             stmt = conexao.prepareStatement(sql);
             result = stmt.executeQuery();
             while(result.next()){
            	 nomeDeptoCursoSelecionado = result.getString("nome");
             }

             //Pegar id das turmas do curso
             int testeExisteTurma = 0;
             sql = "SELECT id FROM turmas WHERE idCurso = '"+idCursoSelecionado +"' AND ativo = 'S'";
             stmt = conexao.prepareStatement(sql);
             result = stmt.executeQuery();
             ArrayList idTurmas = new ArrayList();
             while(result.next()){
            	 idTurmas.add(result.getInt("id"));
            	 testeExisteTurma=1;
             }

             //Seleciona dados das disciplinas por meio dos id's das turmas
             int testeExisteDisciplina = 0;
             ArrayList idDisciplinas = new ArrayList();
             ArrayList nomeDisciplinas = new ArrayList();
             if (testeExisteTurma == 1){
            	 for (int j=0; j<idTurmas.size();j++){
            		 sql = "SELECT id, nome, cargaHorariaMin FROM disciplinas WHERE idTurma = '"+idTurmas.get(j)+"' AND ativo='S' ";
                     stmt = conexao.prepareStatement(sql);
                     result = stmt.executeQuery();
                     int k =0;
                     while(result.next()){
                    	 idDisciplinas.add(result.getInt("id"));
                    	 nomeDisciplinas.add(result.getString("nome"));
                    	 cargaHorariaMinimaDisciplinas.add(result.getInt("cargaHorariaMin"));
                    	 testeExisteDisciplina=1;
                    	 k++;
                     }
            	 }
             }
             else {
            	 Alert alert = new Alert(AlertType.ERROR);
                 alert.setTitle("Erro");
                 alert.setHeaderText("Curso = "+nomeCursoSelecionado+"  Departamento = "+nomeDeptoCursoSelecionado);
                 alert.setContentText("Naoo existem turmas no curso selecionado.");
             }


             //seleciona id's dos professores em profdisciplinas por meio dos id's das disciplinas
             int testeExisteProfessor = 0;
    		 ArrayList idProfDisciplinas = new ArrayList();

                   if (testeExisteDisciplina == 1){
                 int auxiliar = 0;
                 for (int k=0;k<idDisciplinas.size();k++){
                 sql = "SELECT idProfessor FROM profdisciplinas WHERE idDisciplina = '"+idDisciplinas.get(k)+"' AND ativo='S'";
                 stmt = conexao.prepareStatement(sql);
                 result = stmt.executeQuery();

                 while(result.next()){
                        idProfDisciplinas.add(result.getInt("idProfessor"));
                        testeExisteProfessor=1;

                 }//while
                 }

                 } if(testeExisteDisciplina== 0 && testeExisteTurma==0){
            	 Alert alert = new Alert(AlertType.ERROR);
                 alert.setTitle("Erro");
                 alert.setHeaderText("Curso = "+nomeCursoSelecionado+"  Departamento = "+nomeDeptoCursoSelecionado);
                 alert.setContentText("Nao existem dusciplinas no curso selecionado.");
             } if (testeExisteDisciplina == 0 && testeExisteTurma==1){
            	 Alert alert = new Alert(AlertType.ERROR);
                 alert.setTitle("Erro");
                 alert.setHeaderText("Curso = "+nomeCursoSelecionado+"  Departamento = "+nomeDeptoCursoSelecionado);
                 alert.setContentText("A turma do curso selecionado naoo possui disciplinas.");

             }if (testeExisteProfessor == 1 ){


	                 //seleciona idSIAPE de todos os professores ativos em fucionario para comparar com id de profdisciplinas
	            	 sql = "SELECT idSIAPE FROM funcionario WHERE hierarquia = 'Professor' OR hierarquia = 'Coordenador' AND ativo = 'S'  ";
	                 stmt = conexao.prepareStatement(sql);
	                 result = stmt.executeQuery();


	                 while(result.next()){
	                	 idSIAPEProfessores.add(result.getInt("idSIAPE"));

	                 }
	                 //grava nome dos professores que tiverem o idSIAPE no arrayList idProfessores em um arrayList de nomes
	                 int j = 0;
	                 for (int i = 0; i < idSIAPEProfessores.size() ; i++){
	                     for(j = (idProfDisciplinas.size() -1); j >= 0; j--){

	                    	 if ( idSIAPEProfessores.get(i).equals(idProfDisciplinas.get(j))  ){

	                    		 sql = "SELECT nome FROM funcionario WHERE idSIAPE = '"+idSIAPEProfessores.get(i)+"' AND ativo = 'S' ";
	                             stmt = conexao.prepareStatement(sql);
	                             result = stmt.executeQuery();
	                             while (result.next()){
	                            	 nomeProfessores.add(result.getString("nome"));
	                                 }
	                    	 }
	                     }//2for
	                 }//1for
                  }//if
                for ( int i = 0; i<nomeProfessores.size() ; i++){
                        professores.add(new Relatorio9Professor(((String)  nomeProfessores.get(i)),
                                                                ((String)  nomeDisciplinas.get(i)),
                                                                ((Integer) cargaHorariaMinimaDisciplinas.get(i))));
             	}
             }//try
            catch (SQLException e) {
            	throw new RuntimeException(e);
	    }

          boolean okclic;
          okclic = relatorio9.invocaVisualizar(professores);
        }
        }//else


    public void initialize(URL url, ResourceBundle rb) {
        caixaSelecao1.setItems(nomesCampi);
        caixaSelecao2.setVisible(false);
        escondBotao.setVisible(false);;
    }

}


