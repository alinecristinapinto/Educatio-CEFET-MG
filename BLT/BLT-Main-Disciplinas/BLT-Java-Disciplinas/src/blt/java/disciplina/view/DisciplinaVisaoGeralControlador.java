package blt.java.disciplina.view;

import javafx.fxml.FXML;



import java.sql.SQLException;
import java.util.List;


import blt.java.disciplina.ManutencaoDisciplinas;
import blt.java.disciplina.jdbc.DisciplinaDao;
import blt.java.disciplina.model.Disciplina;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;

/**
*
* @author Torres
*/

public class DisciplinaVisaoGeralControlador {
    
    private ManutencaoDisciplinas mainApp; // Referencia à aplicação principal.
    DisciplinaDao bd = new DisciplinaDao(); //Abre conexão com BD.
    
    
    //Construtor
    public DisciplinaVisaoGeralControlador() {
    }

    /**
     * Chamado quando o usuário clica no botão adicionar abre uma janela para editar
     * detalhes da nova pessoa.
     * @throws SQLException
     */
    @FXML
    private void botaoNovaDisciplina()  {
        Disciplina tempDisciplina = new Disciplina();

        boolean okClicked = mainApp.mostrarDisciplinaCaixaEditar(tempDisciplina);
        if (okClicked) {
            bd.adiciona(tempDisciplina);
        }
    }
    
    /**
     * Chamado quando o usuário clica no botão editar abre a janela para pesquisar
     * uma pessoa a ser editada.
     */
    @FXML
   private void botaoEditarDisciplina() {
    	Disciplina tempDisciplina = new Disciplina();
        Disciplina tempDisciplina2 = new Disciplina();
        boolean existeDisciplina = false;
        
        boolean okClicked = mainApp.mostrarDisciplinaPesquisar(tempDisciplina2);
        if(okClicked){
    	List<Disciplina> disciplinas = bd.getLista();

		for (Disciplina disciplina : disciplinas) {
			if(tempDisciplina2.getNome().equals(disciplina.getNome()) ){
				tempDisciplina = disciplina;
                                existeDisciplina = true;
			}
		}
                if(existeDisciplina){
                    boolean okClicked1 = mainApp.mostrarDisciplinaCaixaEditar(tempDisciplina);
                        if(okClicked1){
                            bd.altera(tempDisciplina, tempDisciplina2.getNome());
                        }
                }else{
                    Alert alert = new Alert(AlertType.ERROR);
                      alert.setTitle("Nome Inválido");
                      alert.setHeaderText("Disciplina não encontrada!");
                      alert.setContentText("Por favor, visualize os nomes das disciplinas e tente novamente.");
                      alert.showAndWait();
                }
        }
    }

    @FXML
    private void botaoDeletarDisciplina() {
    	Disciplina tempDisciplina = new Disciplina();
        Disciplina tempDisciplina2 = new Disciplina();
    	boolean existeDisciplina = false;
        
        boolean okClicked = mainApp.mostrarDisciplinaPesquisar(tempDisciplina2);
        if(okClicked){

    	List<Disciplina> disciplinas = bd.getLista();

		for (Disciplina disciplina : disciplinas) {
			if(tempDisciplina2.getNome().equals( disciplina.getNome() )){
				tempDisciplina = disciplina;
                                existeDisciplina = true;
			}
		}
                
                if(existeDisciplina){
			bd.remove(tempDisciplina);
                }else{
                    Alert alert = new Alert(AlertType.ERROR);
                      alert.setTitle("Nome Inválido");
                      alert.setHeaderText("Disciplina não encontrada!");
                      alert.setContentText("Por favor, visualize os nomes das disciplinas e tente novamente.");
                      alert.showAndWait();
                }
        }

    }

    @FXML
    private void botaoVisualizarDisciplina()  {

        mainApp.mostrarDisciplinasVisualizar();

    }

    /**
     * É chamado pela aplicação principal para dar uma referência de volta a si mesmo.
     *
     * @param mainApp
     */
    public void setMainApp(ManutencaoDisciplinas mainApp) {
        this.mainApp = mainApp;

    }
}

