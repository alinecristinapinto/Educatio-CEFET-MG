/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package educatio.app.view.Login;

import educatio.app.mainApp;
import educatio.app.model.Login.Aluno;
import educatio.app.model.Login.GerentesConexaoBDLogin;
import java.math.BigInteger;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.Menu;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;

public class GerentesTelaCadastroController {

    @FXML
    private ChoiceBox caixaSelecaoCargo;
    @FXML
    private TextField idUsuario;
    @FXML
    private PasswordField senha;
    @FXML
    private PasswordField confirmaSenha;

    private ObservableList<String> listaOpcoes = FXCollections.observableArrayList("Aluno", "Funcionário");

    private mainApp mainApp;

    boolean existeLogin;

    public void setExisteLogin(boolean existeLogin) {
        this.existeLogin = existeLogin;
    }

    @FXML
    private void initialize() {
        caixaSelecaoCargo.setValue("Aluno");
        caixaSelecaoCargo.setItems(listaOpcoes);
        idUsuario.setPromptText("Insira seu id");
        senha.setPromptText("Insira sua senha");
        confirmaSenha.setPromptText("Confirme sua senha");
    }

    public void setMainApp(mainApp mainApp) {
        this.mainApp = mainApp;
    }

    public void acaoAvancar() {
        String opcaoSelecionada = (String) caixaSelecaoCargo.getValue();
        String id = idUsuario.getText();
        String strsenha = geraMd5(senha.getText());
        String strconfirma = geraMd5(confirmaSenha.getText());

        GerentesConexaoBDLogin conexaoBD = new GerentesConexaoBDLogin();

        conexaoBD.conectar();
        conexaoBD.setController2(this);

        ResultSet resultado;
        String pesquisaBD;
        boolean cadastroSucesso;

        switch (opcaoSelecionada) {
            case "Aluno":
                pesquisaBD = "SELECT * FROM alunos WHERE idCPF=\'" + id + "\' AND ativo = 'N'";

                try {
                    resultado = conexaoBD.enviarQueryResultados2(pesquisaBD);

                    if (existeLogin) {
                        if (resultado.getString("senha").equals(geraMd5(""))) {
                            if (strsenha.equals(strconfirma)) {
                                cadastroSucesso = conexaoBD.enviarQueryCadastro(strsenha, id, "Aluno");
                                if (!cadastroSucesso) {
                                    Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
                                    alert.setTitle("Cadastro com sucesso.");
                                    alert.setContentText("Seu cadastro foi efetuado com sucesso");
                                    alert.showAndWait();
                                    voltaLogin();
                                }
                            } else {
                                Alert alert = new Alert(Alert.AlertType.ERROR);
                                alert.setTitle("Senhas incorretas.");
                                alert.setContentText("Suas senhas não correspondem uma a outra");
                                alert.showAndWait();
                                break;
                            }
                        } else {
                            Alert alert = new Alert(Alert.AlertType.ERROR);
                            alert.setTitle("Erro.");
                            alert.setContentText("Você está desativado do sistema.");
                            alert.showAndWait();
                            break;
                        }
                    } else {
                        Alert alert = new Alert(Alert.AlertType.ERROR);
                        alert.setTitle("ID Inexistente.");
                        alert.setContentText("Seu ID não existe");
                        alert.showAndWait();
                        break;
                    }

                } catch (SQLException ex) {
                    Logger.getLogger(GerentesTelaCadastroController.class.getName()).log(Level.SEVERE, null, ex);
                }
                break;
            case "Funcionário":
                pesquisaBD = "SELECT * FROM funcionario WHERE idSIAPE=\'" + id + "\' AND ativo = 'N'";
                try {
                    resultado = conexaoBD.enviarQueryResultados2(pesquisaBD);
                    if (existeLogin) {
                        if (resultado.getString("senha").equals(geraMd5(""))) {
                            if (strsenha.equals(strconfirma)) {
                                cadastroSucesso = conexaoBD.enviarQueryCadastro(strsenha, id, "Funcionario");
                                if (!cadastroSucesso) {
                                    Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
                                    alert.setTitle("Cadastro com sucesso.");
                                    alert.setContentText("Seu cadastro foi efetuado com sucesso");
                                    alert.showAndWait();
                                    voltaLogin();
                                }
                            } else {
                                Alert alert = new Alert(Alert.AlertType.ERROR);
                                alert.setTitle("Senhas incorretas.");
                                alert.setContentText("Suas senhas não correspondem uma a outra");
                                alert.showAndWait();
                                break;
                            }
                        } else {
                            Alert alert = new Alert(Alert.AlertType.ERROR);
                            alert.setTitle("Erro.");
                            alert.setContentText("Você está desativado do sistema");
                            alert.showAndWait();
                            break;
                        }
                    } else {
                        Alert alert = new Alert(Alert.AlertType.ERROR);
                        alert.setTitle("ID Inexistente.");
                        alert.setContentText("Seu ID não existe");
                        alert.showAndWait();
                        break;
                    }
                } catch (SQLException ex) {
                    Logger.getLogger(GerentesTelaCadastroController.class.getName()).log(Level.SEVERE, null, ex);
                }
        }
    }

    public void voltaLogin() {
        mainApp.mostraLogin();
    }

    public static String geraMd5(String senha) {
        String sen = "";
        MessageDigest md = null;
        try {
            md = MessageDigest.getInstance("MD5");
        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        }
        BigInteger hash = new BigInteger(1, md.digest(senha.getBytes()));
        sen = hash.toString(16);
        return sen;
    }
}
