package blt.java.emprestimo.view;

import javafx.fxml.FXML;
import java.sql.SQLException;
import java.util.List;
import blt.java.emprestimo.ManutencaoEmprestimos;
import blt.java.emprestimo.jdbc.EmprestimoDao;
import blt.java.emprestimo.model.Emprestimo;
import javafx.scene.control.Alert;


public class EmprestimoVisaoGeralControlador {

    // Referencia à aplicação principal.
    private ManutencaoEmprestimos mainApp;
    EmprestimoDao bd = new EmprestimoDao(); //Conexão com o bd.
    
  
    public EmprestimoVisaoGeralControlador() {
    }

    /**
     * Chamado quando o usuário clica no botão novo. Abre uma janela para editar
     * detalhes de um novo empréstimo.
     * @throws SQLException
     */
    @FXML
    private void botaoNovoEmprestimo()  {
        Emprestimo tempEmprestimo = new Emprestimo();

        boolean okClicked = mainApp.mostrarEmprestimoCaixaEditar(tempEmprestimo);
        if (okClicked) {
            bd.adiciona(tempEmprestimo);
        }
    }

    /**
     * Chamado quando o usuário clica no botão remover. Abre a janela para pesquisar o id
     * do aluno que realizou empréstimo.
     */
    @FXML
    private void botaoDeletarEmprestimo() {
    	Emprestimo tempEmprestimo = new Emprestimo();
        Emprestimo tempEmprestimo2 = new Emprestimo();
    	boolean existeEmprestimo = false;
        
        boolean okClicked = mainApp.mostrarEmprestimoPesquisar(tempEmprestimo2);
        if(okClicked){

    	List<Emprestimo> emprestimos = bd.getLista();


		for (Emprestimo emprestimo : emprestimos) {
			if(tempEmprestimo2.getIdAluno().equals( emprestimo.getIdAluno() )){
				tempEmprestimo = emprestimo;
                                existeEmprestimo = true;
			}
		}
                
                if(existeEmprestimo){
			bd.remove(tempEmprestimo);
                }else{
                     Alert alert = new Alert(Alert.AlertType.ERROR);
                      alert.setTitle("Id do aluno Inválido");
                      alert.setHeaderText("Empréstimo não encontrada!");
                      alert.setContentText("Por favor, visualize os empréstimos existentes e tente novamente.");
                      alert.showAndWait();
                }
    	}

    }

    @FXML
    private void botaoVisualizarEmprestimo()  {
        
        mainApp.mostrarEmprestimoVisualizar();

    }

    /**
     * É chamado pela aplicação principal para dar uma referência de volta a si mesmo.
     *
     * @param mainApp
     */
    public void setMainApp(ManutencaoEmprestimos mainApp) {
        this.mainApp = mainApp;

    }
}