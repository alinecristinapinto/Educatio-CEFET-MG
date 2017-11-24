package manutencaoAluno.controller.view;

import java.io.File;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import java.util.Optional;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.DatePicker;
import javafx.scene.control.ListView;
import javafx.scene.control.TextField;
import javafx.scene.control.ToggleGroup;
import javafx.event.*;
import javafx.scene.control.Alert;
import javafx.scene.control.ButtonBar;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ComboBox;
import javafx.scene.control.DialogPane;
import javafx.scene.input.KeyCode;
import javafx.scene.input.KeyEvent;
import javafx.stage.FileChooser;
import manutencaoAluno.controller.AlteraDados;
import manutencaoAluno.controller.BancoDeDados;
import manutencaoAluno.controller.Main;
import manutencaoAluno.controller.ManutencaoAluno;

public class FormularioInsercaoDeAlunoControlador {

    private BancoDeDados acessoBancoDeDados = new BancoDeDados();
    private AlteraDados alterar = new AlteraDados();
    private String imagem;
    private ManutencaoAluno manutencaoAluno;

    private static final int TAM_CPF = 14;
    private static final int INTERVALO_CPF = 4;
    private static final int TAM_SEGMENTO_CPF = (INTERVALO_CPF - 1)/* == 3*/;
    private static final int TRANSICAO_CPF = (TAM_CPF - 6)/* == 8*/;
    //Valores autodescritivos.

    private static final int TAM_CEP = 9;
    private static final int INTERVALO_CEP = 6;
    private static final int TAM_SEGMENTO_CEP = (INTERVALO_CEP - 1)/* == 5*/;

    @FXML
    private TextField nome;
    @FXML
    private ComboBox turma;
    @FXML
    private ComboBox campus;
    @FXML
    private ComboBox departamento;
    @FXML
    private ComboBox curso;
    @FXML
    private ToggleGroup sexoi;
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
    private ListView listaDeVizualizacao;
    @FXML
    private Button botaoEnviar;

    public FormularioInsercaoDeAlunoControlador() {
    }

    @FXML
    private void initialize() {

        nome.setPromptText("Digite o nome.");
        turma.setPromptText("Selecione uma turma.");
        turma.setDisable(true);
        departamento.setPromptText("Selecione um departamento.");
        departamento.setDisable(true);
        campus.setPromptText("Selecione um campus.");
        curso.setPromptText("Selecione um curso.");
        curso.setDisable(true);
        dataDeNascimento.setPromptText("dd/mm/aaaa");
        cpf.setPromptText("Apenas números.");
        logradouro.setPromptText("Digite o logadouro.");
        numero.setPromptText("Digite o número.");
        complemento.setPromptText("Digite o complemento.");
        bairro.setPromptText("Digite o bairro.");
        cidade.setPromptText("Digite a cidade.");
        cep.setPromptText("Apenas números.");
        uf.setPromptText("Digite a UF.");
        email.setPromptText("exemplo@email.com");
        acessoBancoDeDados.ObtemCampus(campus);
       // acessoBancoDeDados.ObtemDepartamento(departamento, acessoBancoDeDados.ObtemIdCampus((String) campus.getValue()));
        acessoBancoDeDados.ObtemTurmas(turma);

        cpf.addEventHandler(
                KeyEvent.KEY_PRESSED,
                (key)
                -> {
            if (key.getCode() != KeyCode.BACK_SPACE) {
                if (key.getCode() != KeyCode.TAB) {
                    formataCPF();
                }
            }
        }
        );

        cep.addEventHandler(
                KeyEvent.KEY_PRESSED,
                (key)
                -> {
            if (key.getCode() != KeyCode.BACK_SPACE) {
                if (key.getCode() != KeyCode.TAB) {
                    formataCEP();
                }
            }
        }
        );
    }

    @FXML
    public void formataCEP(/*char Digito*/) {
        if (cep.getText().length() < TAM_CEP)//Verifica o tamanho do texto contido em CEP.
        {
            //CEP exemplo: 54545-636.

            if (cep.getText().length() % INTERVALO_CEP == TAM_SEGMENTO_CEP)//Teste que verifica a necessidade de formatar.
            {
                cep.setText((cep.getText() + "-"));
                //Adiciona hífens.

                cep.end();
                //Move cursor até o fim da linha de texto.
            }
        } else {
            //Inserir mensagem de erro.

            cep.setText("");
            //Dá reset no texto.
        }
        //}
    }

    @FXML
    public void formataCPF() {
        if (cpf.getText().length() < TAM_CPF)//Verifica o tamanho do texto contido em CPF.
        {
            //CPF exemplo: 888.999.444-55.

            if (cpf.getText().length() % INTERVALO_CPF == TAM_SEGMENTO_CPF)//Teste que verifica a necessidade de formatar.
            {
                if (cpf.getText().length() < TRANSICAO_CPF)//Teste para qual tipo será colocado(ponto ou hífen).
                {
                    cpf.setText((cpf.getText() + "."));
                }//Adiciona pontos.
                else {
                    cpf.setText((cpf.getText() + "-"));
                }//Adiciona hífens.

                cpf.end();
                //Move cursor até o fim da linha de texto.
            }
        } else {
            //Inserir mensagem de erro.

            cpf.setText("");
            //Dá reset no texto.
        }
    }

    @FXML
    public void acaoButao(ActionEvent evento) {
        FileChooser EscolherFoto = new FileChooser();
        File EscolherAFoto = EscolherFoto.showOpenDialog(null);

        if (EscolherAFoto != null) {
            listaDeVizualizacao.getItems().add(EscolherAFoto.getAbsolutePath());
            imagem = EscolherAFoto.getAbsolutePath();
        }
    }

    @FXML
    public void acaoEntrada() throws SQLException {
        List camposVazios = new ArrayList();
        //System.out.println(campus.getValue());
        if (nome.getText().isEmpty()) {
            camposVazios.add("Nome");
        }
        if (!sexoi.getToggles().get(0).isSelected() || sexoi.getToggles().get(1).isSelected()) {
            camposVazios.add("Sexo");
        }
        if (cpf.getText().isEmpty()) {
            camposVazios.add("CPF");
        }
        if (logradouro.getText().isEmpty()) {
            camposVazios.add("Logradouro");
        }
        if (numero.getText().isEmpty()) {
            camposVazios.add("Número Logradouro");
        }
        if (complemento.getText().isEmpty()) {
            camposVazios.add("Completo");
        }
        if (bairro.getText().isEmpty()) {
            camposVazios.add("Bairro");
        }
        if (cidade.getText().isEmpty()) {
            camposVazios.add("Cidade");
        }
        if (cep.getText().isEmpty()) {
            camposVazios.add("CEP");
        }
        if (uf.getText().isEmpty()) {
            camposVazios.add("UF");
        }
        if (email.getText().isEmpty()) {
            camposVazios.add("Email");
        }

        if (!camposVazios.isEmpty()) {
            Alert mensagemErro = new Alert(Alert.AlertType.WARNING, "");

            //Adiciona o CSS ao dialog
            DialogPane dialogPane = mensagemErro.getDialogPane();
            dialogPane.getStylesheets().add(getClass().getResource("FormularioInsercaoDeAlunoEstilo.css").toExternalForm());
            dialogPane.getStyleClass().add("dialog-pane");

            String mensagemVista = "O(s) seguinte(s) campo(s) não está(estão) preenchido(s):\n\n";
            int tagParada = camposVazios.size() - 1;
            mensagemErro.setTitle("");
            for (int y = 0; y < camposVazios.size(); y++) {
                String[] temp = alterar.alteraList(camposVazios.get(y).toString());

                for (String temp1 : temp) {
                    mensagemVista += "" + temp1 + "\n";
                }
            }
            mensagemErro.setHeaderText(mensagemVista);
            mensagemErro.setContentText("Para continuar o cadastro, preencha-o(os)");
            mensagemErro.showAndWait();
        } else {
            ButtonType botaoSim = new ButtonType("Sim", ButtonBar.ButtonData.OK_DONE);
            ButtonType botaoNao = new ButtonType("Não", ButtonBar.ButtonData.CANCEL_CLOSE);
            Alert confirmacao = new Alert(Alert.AlertType.CONFIRMATION, "",
                    botaoSim,
                    botaoNao);
            //Adiciona o CSS ao dialog
            DialogPane dialogPane = confirmacao.getDialogPane();
            dialogPane.getStylesheets().add(getClass().getResource("FormularioInsercaoDeAlunoEstilo.css").toExternalForm());
            dialogPane.getStyleClass().add("dialog-pane");

            confirmacao.setTitle("");
            confirmacao.setHeaderText("Confirmação de Cadastro de Aluno.");
            confirmacao.setContentText("Você realmente deseja cadastrar este aluno?");

            Optional<ButtonType> result = confirmacao.showAndWait();
            if (result.isPresent() && result.get() == botaoSim) {

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

                acessoBancoDeDados.enviaDados(entradaCPF, entradaNome, entradaSexo,
                        entradaData, entradaLogradouro, entradaNumero,
                        entradaComplemento, entradaBairro, entradaCidade,
                        entradaCEP, entradaUF, entradaEmail, imagem, entradaTurma);

                acessoBancoDeDados.InsereMatricula(entradaTurma, entradaCPF);

                ButtonType botaoS = new ButtonType("Sim", ButtonBar.ButtonData.OK_DONE);
                ButtonType botaoN = new ButtonType("Não", ButtonBar.ButtonData.CANCEL_CLOSE);
                Alert confirmacao2 = new Alert(Alert.AlertType.CONFIRMATION, "",
                        botaoS,
                        botaoN);

                //Adiciona o CSS ao dialog
                DialogPane dialogPane2 = confirmacao2.getDialogPane();
                dialogPane2.getStylesheets().add(getClass().getResource("FormularioInsercaoDeAlunoEstilo.css").toExternalForm());
                dialogPane2.getStyleClass().add("dialog-pane");

                confirmacao2.setTitle("");
                confirmacao2.setHeaderText("Aluno cadastrado com sucesso!");
                confirmacao2.setContentText("Você deseja cadastrar outro Aluno?");

                Optional<ButtonType> result2 = confirmacao2.showAndWait();
                if (result2.isPresent() && result2.get() == botaoSim) {
                    Main.mostraFormularioInsercao();
                } else {
                    confirmacao2.close();
                    //retorna para a página inicial
                }
            } else {
                confirmacao.close();
            }
        }
    }

    public void setManutencaoAluno(ManutencaoAluno manutencaoAluno) {
        this.manutencaoAluno = manutencaoAluno;
    }

}
