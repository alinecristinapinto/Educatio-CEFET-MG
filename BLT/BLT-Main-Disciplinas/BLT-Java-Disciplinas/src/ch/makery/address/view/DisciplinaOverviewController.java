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
import ch.makery.address.jdbc.ConnectionFactory;
import ch.makery.address.model.Disciplina;
import java.sql.Connection;
import java.sql.Connection;

public class DisciplinaOverviewController {

	 // Reference to the main application.
    private MainApp mainApp;

    /**
     * O construtor.
     * O construtor é chamado antes do método inicialize().
     */
    public DisciplinaOverviewController() {
    }

    /**
     * Chamado quando o usuário clica no botão novo. Abre uma janela para editar
     * detalhes da nova pessoa.
     * @throws SQLException
     */
    @FXML
    private void handleNewDisciplina() throws SQLException {
        Disciplina tempDisciplina = new Disciplina();

        boolean okClicked = mainApp.showDisciplinaEditDialog(tempDisciplina);
        if (okClicked) {
            Connection con = new ConnectionFactory().getConnection();

            String sql = "insert into disciplinas " +
                    "(idTurma,nome, cargaHorariaMin, ativo)" +
                    " values (?,?,?,?)";
            PreparedStatement stmt = con.prepareStatement(sql);

            stmt.setInt(1, tempDisciplina.getIdTurma());
            stmt.setString(2, tempDisciplina.getNome());
            stmt.setInt(3, tempDisciplina.getCargaHorariaMin());
            stmt.setString(4, "s");

            // executa
            stmt.execute();
            stmt.close();

            con.close();
        }
    }

    /**
     * Chamado quando o usuário clica no botão edit. Abre a janela para editar
     * detalhes da pessoa selecionada.
     */
    @FXML
  /**  private void handleEditDisciplina() {
        Disciplina selectedDisciplina = disciplinaTabela.getSelectionModel().getSelectedItem();
        if (selectedDisciplina != null) {
            boolean okClicked = mainApp.showDisciplinaEditDialog(selectedDisciplina);


        } else {
            // Nada seleciondo.
            Alert alert = new Alert(AlertType.WARNING);
                alert.setTitle("Nenhuma seleção");
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
                alert.setTitle("Nenhuma seleção");
                alert.setHeaderText("Nenhuma Disciplina Selecionada");
                alert.setContentText("Por favor, selecione uma disciplina na tabela.");

                alert.showAndWait();
        }
    }
*/








    /**
     * É chamado pela aplicação principal para dar uma referência de volta a si mesmo.
     *
     * @param mainApp
     */
    public void setMainApp(MainApp mainApp) {
        this.mainApp = mainApp;

    }
}

