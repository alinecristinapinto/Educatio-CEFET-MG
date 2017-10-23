package blt.java.principal.view;

import javafx.fxml.FXML;

import javafx.scene.control.TextInputDialog;


import java.sql.SQLException;
import java.util.List;
import java.util.Optional;

import blt.java.principal.MainApp;
import blt.java.principal.jdbc.DisciplinaDao;
import blt.java.principal.model.Disciplina;


public class DisciplinaVisaoGeralControlador {

	 // Reference to the main application.
    private MainApp mainApp;
    DisciplinaDao bd = new DisciplinaDao();
    /**
     * O construtor.
     * O construtor é chamado antes do método inicialize().
     */
    public DisciplinaVisaoGeralControlador() {
    }

    /**
     * Chamado quando o usuário clica no botão novo. Abre uma janela para editar
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
     * Chamado quando o usuário clica no botão edit. Abre a janela para editar
     * detalhes da pessoa selecionada.
     */
    @FXML
   private void botaoEditarDisciplina() {
    	Disciplina tempDisciplina = new Disciplina();

    	TextInputDialog dialog = new TextInputDialog("");
    	dialog.setTitle("Pesquisar disciplina");
    	dialog.setHeaderText("Pesquisar disciplina");
    	dialog.setContentText("Por favor, entre com o nome da disciplina:");

    	// Traditional way to get the response value.// Traditional way to get the response value.
    	Optional<String> result = dialog.showAndWait();
    	if (result.isPresent()){


    	List<Disciplina> disciplinas = bd.getLista();


		for (Disciplina disciplina : disciplinas) {
			if(result.get().equals( disciplina.getNome() )){
				tempDisciplina = disciplina;
			}
		}

		boolean okClicked = mainApp.mostrarDisciplinaCaixaEditar(tempDisciplina);
		if(okClicked){
			bd.altera(tempDisciplina, result.get());
		}
    	}

    }

    @FXML
    private void botaoDeletarDisciplina() {
    	Disciplina tempDisciplina = new Disciplina();

    	TextInputDialog dialog = new TextInputDialog("");
    	dialog.setTitle("Remover disciplina");
    	dialog.setHeaderText("Remover disciplina");
    	dialog.setContentText("Por favor, entre com o nome da disciplina:");

    	// Traditional way to get the response value.// Traditional way to get the response value.
    	Optional<String> result = dialog.showAndWait();
    	if (result.isPresent()){


    	List<Disciplina> disciplinas = bd.getLista();


		for (Disciplina disciplina : disciplinas) {
			if(result.get().equals( disciplina.getNome() )){
				tempDisciplina = disciplina;
			}
		}

			bd.remove(tempDisciplina);

    	}

    }

    @FXML
    private void botaoVisualizarDisciplina()  {


        mainApp.mostrarDisciplinasVisualizar();

    }
/*








    /**
     * É chamado pela aplicação principal para dar uma referência de volta a si mesmo.
     *
     * @param mainApp
     */
    public void setMainApp(MainApp mainApp) {
        this.mainApp = mainApp;

    }
}

