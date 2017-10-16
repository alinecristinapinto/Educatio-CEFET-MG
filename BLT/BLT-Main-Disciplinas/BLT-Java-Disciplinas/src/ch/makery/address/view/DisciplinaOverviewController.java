package ch.makery.address.view;

import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;

import ch.makery.address.MainApp;
import ch.makery.address.jdbc.DisciplinaDao;
import ch.makery.address.model.Disciplina;
import java.sql.Connection;

public class DisciplinaOverviewController {

    // Reference to the main application.
    private MainApp mainApp;
    DisciplinaDao bd = new DisciplinaDao();
    /**
     * O construtor.
     * O construtor � chamado antes do m�todo inicialize().
     */
    public DisciplinaOverviewController() {
    }

    /**
     * Chamado quando o usu�rio clica no bot�o novo. Abre uma janela para editar
     * detalhes da nova pessoa.
     * @throws SQLException
     */
    @FXML
    private void handleNewDisciplina()  {
        Disciplina tempDisciplina = new Disciplina();

        boolean okClicked = mainApp.showDisciplinaEditDialog(tempDisciplina);
        if (okClicked) {
            bd.adiciona(tempDisciplina);
        }
    }

    /**
     * Chamado quando o usu�rio clica no bot�o edit. Abre a janela para editar
     * detalhes da pessoa selecionada.
     */
    /**@FXML
    private void handleEditDisciplina() {
        Disciplina selectedDisciplina = disciplinaTabela.getSelectionModel().getSelectedItem();
        if (selectedDisciplina != null) {
            boolean okClicked = mainApp.showDisciplinaEditDialog(selectedDisciplina);


        } else {
            // Nada seleciondo.
            Alert alert = new Alert(AlertType.WARNING);
                alert.setTitle("Nenhuma sele��o");
                alert.setHeaderText("Nenhuma Disciplina Selecionada");
                alert.setContentText("Por favor, selecione uma disciplina na tabela.");
                alert.showAndWait();
        }
    }

    @FXML
    private void handleDeleteDisciplina() {
        int selectedIndex = disciplinaTabela.getSelectionModel().getSelectedIndex();
        if (selectedIndex >= 0) {
            disciplinaTabela.getItems().remove(selectedIndex);
        } else {
 //            Nada selecionado.

        Alert alert = new Alert(AlertType.WARNING);
                alert.setTitle("Nenhuma sele��o");
                alert.setHeaderText("Nenhuma Disciplina Selecionada");
                alert.setContentText("Por favor, selecione uma disciplina na tabela.");

                alert.showAndWait();
        }
    }
/*








    /**
     * � chamado pela aplica��o principal para dar uma refer�ncia de volta a si mesmo.
     *
     * @param mainApp
     */
    public void setMainApp(MainApp mainApp) {
        this.mainApp = mainApp;

    }
}

