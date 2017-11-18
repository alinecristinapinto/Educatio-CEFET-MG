package manutencaoAluno.view;

import manutencaoAluno.Altera;
import manutencaoAluno.BancoDeDados;
import java.io.File;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.DatePicker;
import javafx.scene.control.ListView;
import javafx.scene.control.TextField;
import javafx.scene.control.ToggleGroup;
import javafx.event.*;
import javafx.scene.control.ComboBox;
import javafx.stage.FileChooser;

public class VisaoGeralDoUsuarioControlador {

    private BancoDeDados bd = new BancoDeDados();
    private Altera Alterar = new Altera();
    private String imagem;
    
    
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

    public VisaoGeralDoUsuarioControlador() {
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
        
        bd.ObtemTurmas(turma);
    }
    
    @FXML
    public void formataCEP()
    {
            if(cep.getText().length() < TAM_CEP)//Verifica o tamanho do texto contido em CEP.
            {
                //CEP exemplo: 54545-636.

                if(cep.getText().length()%INTERVALO_CEP == TAM_SEGMENTO_CEP)//Teste que verifica a necessidade de formatar.
                {
                    cep.setText((cep.getText() + "-"));
                    //Adiciona hífens.

                    cep.end();
                    //Move cursor até o fim da linha de texto.
                }
            }
            else
            {
                //Inserir mensagem de erro.

                cep.setText("");
                //Dá reset no texto.
            }
        //}
    }
 
    @FXML
    public void formataCPF()
    {
        
        if(cpf.getText().length() < TAM_CPF)//Verifica o tamanho do texto contido em CPF.
        {
            //CPF exemplo: 888.999.444-55.
            
            if(cpf.getText().length()%INTERVALO_CPF == TAM_SEGMENTO_CPF)//Teste que verifica a necessidade de formatar.
            {
                if(cpf.getText().length() < TRANSICAO_CPF)//Teste para qual tipo será colocado(ponto ou hífen).
                {cpf.setText((cpf.getText() + "."));}//Adiciona pontos.
                else
                {cpf.setText((cpf.getText() + "-"));}//Adiciona hífens.
                
                 cpf.end();
                //Move cursor até o fim da linha de texto.
            }
        }
        else
        {
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
    public void acaoEntrada() {

        String entradaNome = nome.getText();
        int    entradaTurma = bd.ObtemIdTurma((String) turma.getValue());
        String entradaSexo = Alterar.alteraSexo(sexoi);
        String entradaData = Alterar.alteraDataDeNascimento(dataDeNascimento);
        String entradaCPF = Alterar.remove(Alterar.remove(cpf.getText(), "-"), "[.]");
        String entradaLogradouro = logradouro.getText();
        String entradaNumero = numero.getText();
        String entradaComplemento = complemento.getText();
        String entradaBairro = bairro.getText();
        String entradaCidade = cidade.getText();
        String entradaCEP = Alterar.remove(cep.getText(), "-");
        String entradaUF = uf.getText();
        String entradaEmail = email.getText(); 

        bd.enviaDados(entradaCPF, entradaNome, entradaSexo,
                entradaData, entradaLogradouro, entradaNumero,
                entradaComplemento, entradaBairro, entradaCidade,
                entradaCEP, entradaUF, entradaEmail, imagem, entradaTurma);

    }
}
