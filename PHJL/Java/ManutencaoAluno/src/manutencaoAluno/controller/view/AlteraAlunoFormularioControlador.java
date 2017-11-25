package manutencaoAluno.controller.view;

import java.io.File;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Optional;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonBar;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ComboBox;
import javafx.scene.control.DatePicker;
import javafx.scene.control.DialogPane;
import javafx.scene.control.ListView;
import javafx.scene.control.RadioButton;
import javafx.scene.control.TextField;
import javafx.scene.control.ToggleGroup;
import javafx.stage.FileChooser;
import manutencaoAluno.controller.AlteraDados;
import manutencaoAluno.controller.BancoDeDados;
import manutencaoAluno.controller.Main;
import manutencaoAluno.controller.ManutencaoAluno;

public class AlteraAlunoFormularioControlador {

    private BancoDeDados acessoBancoDeDados = new BancoDeDados();
    private AlteraDados alterar = new AlteraDados();

    private static String valorCPF;
    private int valorIDTurma;
    private String entradaImagem;
    private Connection conexao = null;
    private ManutencaoAluno manutencaoAluno;

    @FXML
    private TextField nome;
    @FXML
    private ComboBox turma;
    @FXML
    private ToggleGroup sexoi;
    @FXML
    private RadioButton sexoF;
    @FXML
    private RadioButton sexoM;
    @FXML
    private DatePicker dataDeNascimento;
    @FXML
    private TextField cpf;
    @FXML
    private TextField logradouro;
    @FXML
    private TextField numero;
    @FXML
    private TextField complemento;
    @FXML
    private TextField bairro;
    @FXML
    private TextField cidade;
    @FXML
    private TextField cep;
    @FXML
    private TextField uf;
    @FXML
    private TextField email;
    @FXML
    private Button foto;
    @FXML
    private Button botaoAlterar;
    @FXML
    private ListView listaDeVizualizacao;

    public AlteraAlunoFormularioControlador() {
    }

    public void defineCPF(String valorCPF) {
        AlteraAlunoFormularioControlador.valorCPF = valorCPF;
    }

    @FXML
    private void initialize() throws SQLException {

        //Preenche o formulário de alteração com os dados do aluno
        ResultSet resultado = null;
        conexao = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
        PreparedStatement stmt;
        try {
            String sql = "SELECT * FROM alunos WHERE idCPF LIKE " + valorCPF;
            stmt = conexao.prepareStatement(sql);
            resultado = stmt.executeQuery();
            if (resultado.next()) {

                nome.setText(resultado.getString(3));
                acessoBancoDeDados.ObtemTurmas(turma);
                if (resultado.getString(4).equals("Feminino")) {
                    sexoF.setSelected(true);
                } else if (resultado.getString(4).equals("Masculino")) {
                    sexoM.setSelected(true);
                }
                turma.setValue(acessoBancoDeDados.ObtemNomeTurma(resultado.getInt(2)));
                dataDeNascimento.setValue(alterar.alteraDataDeNascimentoBD(resultado.getString(5)));
                cpf.setText(resultado.getString(1));
                logradouro.setText(resultado.getString(6));
                numero.setText(resultado.getString(7));
                complemento.setText(resultado.getString(8));
                bairro.setText(resultado.getString(9));
                cidade.setText(resultado.getString(10));
                cep.setText(resultado.getString(11));
                uf.setText(resultado.getString(12));
                email.setText(resultado.getString(13));

                valorIDTurma = resultado.getInt(2);
            }
        } catch (SQLException erro) {
            System.out.println(erro.getErrorCode());
            System.out.println(erro.getMessage());
            System.out.println(erro.getSQLState());
        }
    }

    //Este método é utilizado para obter a imagem (caminho da imagem) do aluno
    @FXML
    public void acaoBotao(ActionEvent evento) {
        FileChooser EscolherFoto = new FileChooser();
        File EscolherAFoto = EscolherFoto.showOpenDialog(null);

        if (EscolherAFoto != null) {
            listaDeVizualizacao.getItems().add(EscolherAFoto.getAbsolutePath());
            entradaImagem = EscolherAFoto.getAbsolutePath();
        }
    }

    //Este método obter os novos dados do aluno e envia para outro método o qual altera os dados no banco de dados
    @FXML
    private void AtualizaAluno() throws SQLException {
        
        ButtonType botaoConfirma = new ButtonType("Sim", ButtonBar.ButtonData.OK_DONE);
        ButtonType botaoCancela = new ButtonType("Não", ButtonBar.ButtonData.CANCEL_CLOSE);
        Alert confirmacao = new Alert(Alert.AlertType.CONFIRMATION, "",
                botaoConfirma,
                botaoCancela);
        
        //Adiciona o CSS ao dialog
        DialogPane dialogPane = confirmacao.getDialogPane();
        dialogPane.getStylesheets().add(getClass().getResource("AlteraAlunoEstilo.css").toExternalForm());
        dialogPane.getStyleClass().add("dialog-pane");

        confirmacao.setTitle("");
        confirmacao.setHeaderText("Confirmação de Alteração de dados do Aluno.");
        confirmacao.setContentText("Você realmente deseja alterar os dados deste aluno?");

        Optional<ButtonType> result = confirmacao.showAndWait();
        if (result.isPresent() && result.get() == botaoConfirma) {
            String entradaNome = nome.getText();
            int entradaTurma = acessoBancoDeDados.ObtemIdTurma((String) turma.getValue());
            String entradaSexo = alterar.alteraSexo(sexoi);
            String entradaData = alterar.alteraDataDeNascimento(dataDeNascimento);
            String entradaCPF = alterar.remove(alterar.remove(cpf.getText(), "-"), "[.]");
            String entradaLogradouro = logradouro.getText();
            String entradaNumero = numero.getText();
            String entradaComplemento = complemento.getText();
            String entradaBairro = bairro.getText();
            String entradaCidade = cidade.getText();
            String entradaCEP = alterar.remove(cep.getText(), "-");
            String entradaUF = uf.getText();
            String entradaEmail = email.getText();

            acessoBancoDeDados.atualizaDados(entradaCPF, entradaNome, entradaSexo,
                    entradaData, entradaLogradouro, entradaNumero,
                    entradaComplemento, entradaBairro, entradaCidade,
                    entradaCEP, entradaUF, entradaEmail, entradaTurma, valorCPF, valorIDTurma, entradaImagem);

            ButtonType botaoSim = new ButtonType("Sim", ButtonBar.ButtonData.OK_DONE);
            ButtonType botaoNao = new ButtonType("Não", ButtonBar.ButtonData.CANCEL_CLOSE);
            Alert confirmacao2 = new Alert(Alert.AlertType.CONFIRMATION, "",
                    botaoSim,
                    botaoNao);
            
            //Adiciona o CSS ao dialog
            DialogPane dialogPane2 = confirmacao2.getDialogPane();
            dialogPane2.getStylesheets().add(getClass().getResource("AlteraAlunoEstilo.css").toExternalForm());
            dialogPane2.getStyleClass().add("dialog-pane");

            confirmacao2.setTitle("");
            confirmacao2.setHeaderText("Aluno alterado com sucesso!");
            confirmacao2.setContentText("Você deseja alterar outro Aluno?");

            Optional<ButtonType> result2 = confirmacao2.showAndWait();
            if (result2.isPresent() && result2.get() == botaoSim) {
                Main.mostraPesquisaAlteracao();
            } else {
                confirmacao2.close();
                //retorna para a página inicial
            }
        } else {
            confirmacao.close();
        }
    }

    public void setManutencaoAluno(ManutencaoAluno manutencaoAluno) {
        this.manutencaoAluno = manutencaoAluno;
    }

}
