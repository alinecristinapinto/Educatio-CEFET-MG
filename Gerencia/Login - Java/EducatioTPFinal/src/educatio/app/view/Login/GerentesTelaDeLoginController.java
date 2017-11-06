package educatio.app.view.Login;

import educatio.app.mainApp;
import educatio.app.model.Login.*;
import java.math.BigInteger;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;

public class GerentesTelaDeLoginController {

    // Cria objetos de interação com o FXML
    @FXML
    private TextField login;
    @FXML
    private PasswordField senha;

    // Cria comunicação com a main 
    private mainApp mainApp;

    // Cria usuario atual da sessão
    private Usuario usuarioAtual;
    // Cria boolean que checa se existe o login digitado
    boolean existeLogin;

    @FXML
    private void initialize() {
        login.setPromptText("Insira seu id");
        senha.setPromptText("Insira sua senha");
    }

    public void setMainApp(mainApp mainApp) {
        this.mainApp = mainApp;
    }

    public boolean isExisteLogin() {
        return existeLogin;
    }

    public void setExisteLogin(boolean existeLogin) {
        this.existeLogin = existeLogin;
    }

    // Chamada quando usuário clica em ação entrada
    @FXML
    public void acaoEntrada() {
        //Pega LOGIN E SENHA DO USUARIO
        String loginEntrada = login.getText();
        String senhaEntrada = geraMd5(senha.getText());
        String pesquisaBD;
        ResultSet resultadoPesquisa;

        //System.out.println(senhaEntrada);
        existeLogin = false;

        GerentesConexaoBDLogin conexaoBD = new GerentesConexaoBDLogin();
        conexaoBD.setController(this);
        conexaoBD.conectar();

        switch (loginEntrada.length()) {
            case 11:
                pesquisaBD = "SELECT * FROM alunos WHERE idCPF=\'" + loginEntrada + "\' AND senha=\'" + senhaEntrada + "\'";
                try {
                    resultadoPesquisa = conexaoBD.enviarQueryResultados(pesquisaBD);

                    if (existeLogin) {
                        if (resultadoPesquisa.getString("ativo").equals("S")) {
                            usuarioAtual = new Aluno(resultadoPesquisa.getString("sexo"), resultadoPesquisa.getString("nascimento"),
                                    resultadoPesquisa.getString("logradouro"),
                                    resultadoPesquisa.getInt("numeroLogradouro"), resultadoPesquisa.getString("complemento"), resultadoPesquisa.getString("bairro"),
                                    resultadoPesquisa.getString("cidade"), resultadoPesquisa.getInt("CEP"), resultadoPesquisa.getString("UF"),
                                    resultadoPesquisa.getString("email"),
                                    resultadoPesquisa.getBlob("foto"), "", resultadoPesquisa.getString("nome"), resultadoPesquisa.getString("idCPF"));

                            mainApp.mostraPagSelecao(usuarioAtual);
                        } else if (resultadoPesquisa.getString("senha").equals(geraMd5(""))) {
                            Alert alert = new Alert(Alert.AlertType.ERROR);
                            alert.setTitle("Não foi possível efetuar o login.");
                            alert.setContentText("Você não está cadastrado no sistema. Clique em 'Cadastro'");
                            alert.showAndWait();
                        } else {
                            Alert alert = new Alert(Alert.AlertType.ERROR);
                            alert.setTitle("Não foi possível efetuar o login.");
                            alert.setContentText("Você está desativado do sistema.");
                            alert.showAndWait();
                        }

                    } else {
                        Alert alert = new Alert(Alert.AlertType.ERROR);
                        alert.setTitle("Não foi possível efetuar o login.");
                        alert.setContentText("Sua senha e/ou login não existem. Efetue um cadastro em nosso sistema");
                        alert.showAndWait();
                    }

                    resultadoPesquisa.close();
                } catch (SQLException ex) {
                    Logger.getLogger(GerentesTelaDeLoginController.class.getName()).log(Level.SEVERE, null, ex);
                }
                break;
            case 9:
                pesquisaBD = "SELECT * FROM funcionario WHERE idSIAPE='" + loginEntrada + "'AND senha='" + senhaEntrada + "';";
                try {
                    resultadoPesquisa = conexaoBD.enviarQueryResultados(pesquisaBD);
                    if (existeLogin) {
                        if (resultadoPesquisa.getString("ativo").equals("S")) {
                            switch (resultadoPesquisa.getString("hierarquia")) {
                                case "Professor":
                                    usuarioAtual = new Professor(resultadoPesquisa.getString("idDepto"), resultadoPesquisa.getString("titulacao"),
                                            resultadoPesquisa.getString("nome"), resultadoPesquisa.getString("idSIAPE"));
                                    mainApp.mostraPagSelecao(usuarioAtual);
                                    break;
                                case "Coordenador":
                                    usuarioAtual = new Coordenador(resultadoPesquisa.getString("nome"), resultadoPesquisa.getString("idSIAPE"));
                                    mainApp.mostraPagInicialSistemaAcademico(usuarioAtual);
                                    break;
                                case "Bibliotecário":
                                    usuarioAtual = new Bibliotecario(resultadoPesquisa.getString("nome"), resultadoPesquisa.getString("idSIAPE"));
                                    mainApp.mostraPagInicialBiblioteca(usuarioAtual);
                                    break;
                                default:
                                    Alert alert = new Alert(Alert.AlertType.ERROR);
                                    alert.setTitle("Seu funcionário não possui uma hierarquia.");
                                    alert.setContentText("Cadastre o funcionário corretamente!");
                                    alert.showAndWait();
                                    break;
                            }

                        } else if (resultadoPesquisa.getString("senha").equals(geraMd5(""))) {
                            Alert alert = new Alert(Alert.AlertType.ERROR);
                            alert.setTitle("Não foi possível efetuar o login.");
                            alert.setContentText("Você não está cadastrado no sistema. Clique em 'Cadastro'");
                            alert.showAndWait();
                        } else {
                            Alert alert = new Alert(Alert.AlertType.ERROR);
                            alert.setTitle("Não foi possível efetuar o login.");
                            alert.setContentText("Você está desativado do sistema.");
                            alert.showAndWait();
                        }
                    } else {
                        Alert alert = new Alert(Alert.AlertType.ERROR);
                        alert.setTitle("Não foi possível efetuar o login.");
                        alert.setContentText("Sua senha e/ou login não existem. Efetue um cadastro em nosso sistema");
                        alert.showAndWait();
                    }

                } catch (SQLException ex) {
                    Logger.getLogger(GerentesTelaDeLoginController.class.getName()).log(Level.SEVERE, null, ex);
                }
                break;

            default:
                Alert alert = new Alert(Alert.AlertType.ERROR);
                alert.setTitle("Não foi possível efetuar o login.");
                alert.setContentText("Sua senha e/ou login não existem. Efetue seu cadastro em nosso sistema");
                alert.showAndWait();
                break;
        }

    }

    public void acaoCadastro() {
        mainApp.mostraPagCadastro();
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

/*Alert alert = new Alert(Alert.AlertType.ERROR);
                alert.setTitle("Não foi possível efetuar o login.");
                alert.setContentText("Sua senha e/ou login não existem. Efetue um cadastro em nosso sistema");
                alert.showAndWait();
                break;*/
