package manutencaoAluno.controller.view;

import java.io.File;
import java.sql.SQLException;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.DatePicker;
import javafx.scene.control.ListView;
import javafx.scene.control.TextField;
import javafx.scene.control.ToggleGroup;
import javafx.event.*;
import javafx.scene.control.ComboBox;
import javafx.scene.input.KeyCode;
import javafx.scene.input.KeyEvent;
import javafx.stage.FileChooser;
import manutencaoAluno.controller.AlteraDados;
import manutencaoAluno.controller.BancoDeDados;
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
        acessoBancoDeDados.ObtemTurmas(turma);

        cpf.addEventHandler(
                KeyEvent.KEY_PRESSED,
                (key)
                -> {
            if (key.getCode() != KeyCode.BACK_SPACE) {
                if(key.getCode() != KeyCode.TAB){
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
                if(key.getCode() != KeyCode.TAB){
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
    }

    public void setManutencaoAluno(ManutencaoAluno manutencaoAluno) {
        this.manutencaoAluno = manutencaoAluno;
    }
    
    
}
