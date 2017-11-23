package tpfinal.fx;

import java.sql.*;
import java.util.Optional;
import javafx.scene.control.Alert;
import javafx.scene.control.ButtonType;
import javafx.scene.control.DialogPane;
import javafx.scene.layout.Region;
import javax.swing.JOptionPane;

public class ManutencaoDepartamento {

    public void CriarDepartamento(int IdCampus, String nome) throws SQLException {
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {

        } else {
            System.out.println("deu ruim :(");
        }

        Departamento temp = new Departamento(IdCampus, nome);

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

    public void AlterarDepartamento(String nome, String campiT, String depto, int campiB) {
        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }

        int campusN;
        String auxData = null;

        if (!campiT.equals("")) {
            campusN = Integer.parseInt(campiT);
            auxData = " SET `idCampi` = '" + campusN + "' ";

            if (!nome.equals("")) {
                auxData += ", `nome` = '" + nome + "'";
            }
        } else {
            if (!nome.equals("")) {
                auxData = " SET `nome` = '" + nome + "'";
            }
        }
        if (auxData != null) {
            sql = "UPDATE `deptos`"
                    + auxData
                    + " WHERE `deptos`.`nome` = '" + depto + "' AND `deptos`.`idCampi` = " + campiB;
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

    private boolean handleFuncionarioSubordinado(int idDepto) throws SQLException {
        boolean flag = false;
        String sql = null;
        String alerta = " ";
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        ResultSet result;
        sql = "SELECT * FROM funcionario WHERE ativo='S' AND idDepto = " + idDepto;
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);
        while (result.next()) {
            flag = true;
            String add = result.getString("nome");
            alerta = alerta + add + "\n";
        }
        if (flag == true) {
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            alert.setTitle("Subordinação de Funcionários");
            alert.setHeaderText("Existem funcionários nesse Departamento");
            alert.setContentText(alerta + "Exclua-os antes de excluir esse departamento");
            alert.getDialogPane().setMinHeight(Region.USE_COMPUTED_SIZE);
            alert.getDialogPane().setMaxHeight(Region.USE_COMPUTED_SIZE);

            DialogPane dialogPane = alert.getDialogPane();
            dialogPane.getStylesheets().add(
            getClass().getResource("Padrao.css").toExternalForm());
            dialogPane.getStyleClass().add("myDialog");

            alert.showAndWait();

            return true;
        } else {
            return false;
        }

    }

    private boolean handleCursoSubordinado(int idDepto) throws SQLException {
        boolean flag = false;
        String sql = null;
        String alerta = " ";
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {
        } else {
            System.out.println("deu ruim :(");
        }
        ResultSet result;

        sql = "SELECT * FROM cursos WHERE ativo='S' AND idDepto = " + idDepto;
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql);

        while (result.next()) {
            flag = true;
            String add = result.getString("nome");
            alerta = alerta + add + "\n";
        }

        if (flag == true) {
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            alert.setTitle("Subordinação de Cursos");
            alert.setHeaderText("Existem cursos nesse Departamento");
            alert.setContentText(alerta + "Exclua-os antes de excluir esse departamento");
            alert.getDialogPane().setMinHeight(Region.USE_COMPUTED_SIZE);
            alert.getDialogPane().setMaxHeight(Region.USE_COMPUTED_SIZE);

            DialogPane dialogPane = alert.getDialogPane();
            dialogPane.getStylesheets().add(
                    getClass().getResource("Padrao.css").toExternalForm());
            dialogPane.getStyleClass().add("myDialog");

            alert.showAndWait();

            return false;
        } else {
            return true;
        }
    }

    public boolean handleSubordinados(int idDepto) throws SQLException {
        return (handleCursoSubordinado(idDepto) && handleFuncionarioSubordinado(idDepto));
    }

    public void ExcluirDepartamento(String nomeDepto, int idCampi) throws SQLException {

        String sql = null;
        Conexão conn = new Conexão();
        Connection connection = conn.getConnection();
        if (connection != null) {

        } else {
            System.out.println("deu ruim :(");
        }

        sql = "SELECT id FROM deptos WHERE nome = '" + nomeDepto + "' AND idCampi = " + idCampi;
        Statement fetch = connection.createStatement();
        ResultSet result = fetch.executeQuery(sql);
        while (result.next()) {
            if (handleSubordinados(result.getInt("id"))) {
                try {
                    sql = "UPDATE `deptos`"
                            + " SET `ativo` = 'N'"
                            + " WHERE `deptos`.`id` = '" + result.getInt("id") + "'";
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
