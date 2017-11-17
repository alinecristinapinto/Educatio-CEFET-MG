package manutencaoAluno.controller.view;

import java.io.File;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Optional;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ComboBox;
import javafx.scene.control.DatePicker;
import javafx.scene.control.ListView;
import javafx.scene.control.TextField;
import javafx.scene.control.ToggleGroup;
import javafx.stage.FileChooser;
import manutencaoAluno.controller.AlteraDados;
import manutencaoAluno.controller.BancoDeDados;

public class AlteraAlunoFormularioControlador {

    private BancoDeDados acessoBancoDeDados = new BancoDeDados();
    private AlteraDados alterar = new AlteraDados();

    private static String valorCPF;
    private Connection conexao = null;

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
    private Button botaoAlterar;
    @FXML
    private ListView listaDeVizualizacao;

    public AlteraAlunoFormularioControlador() {
    }

    public void defineCPF(String valorCPF) {
        this.valorCPF = valorCPF;
        //System.out.println(this.valorCPF);
    }

    @FXML
    private void initialize() throws SQLException {

        ResultSet resultado = null;
        conexao = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
        Statement stmt;
        try {
            stmt = conexao.createStatement();
            String sql = "SELECT * FROM alunos WHERE idCPF LIKE " + valorCPF;
            resultado = stmt.executeQuery(sql);
            if (resultado.next()) {

                nome.setText(resultado.getString(3));
                acessoBancoDeDados.ObtemTurmas(turma);
                cpf.setText(resultado.getString(1));
                logradouro.setText(resultado.getString(6));
                numero.setText(resultado.getString(7));
                complemento.setText(resultado.getString(8));
                bairro.setText(resultado.getString(9));
                cidade.setText(resultado.getString(10));
                cep.setText(resultado.getString(11));
                uf.setText(resultado.getString(12));
                email.setText(resultado.getString(13));

            } else {
                System.out.println("");
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
        }

    }

    @FXML
    public void acaoButao(ActionEvent evento) {
        FileChooser EscolherFoto = new FileChooser();
        File EscolherAFoto = EscolherFoto.showOpenDialog(null);

        if (EscolherAFoto != null) {
            listaDeVizualizacao.getItems().add(EscolherAFoto.getAbsolutePath());
            String imagem = EscolherAFoto.getAbsolutePath();
        }
    }

    @FXML
    private void AtualizaAluno() throws SQLException {
        Alert confirmacao = new Alert(Alert.AlertType.CONFIRMATION);

        confirmacao.setTitle("");
        confirmacao.setHeaderText("Confirmação de Exclusão de Aluno.");
        confirmacao.setContentText("Você realmente deseja deletar este aluno?");

        Optional<ButtonType> result = confirmacao.showAndWait();

        if (result.get() == ButtonType.OK) {
            //Código se o usuário clicou em OK

            String entradaNome = nome.getText();
            int entradaTurma = acessoBancoDeDados.ObtemIdTurma((String) turma.getValue());
            System.out.println(entradaTurma);
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
            System.out.println(entradaNome);
            conexao = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
            PreparedStatement ps;
            String sql;
            try {

                sql = "UPDATE alunos SET nome=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, entradaNome);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "UPDATE alunos SET idCPF=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, entradaCPF);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "UPDATE alunos SET sexo=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, entradaSexo);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "UPDATE alunos SET nascimento=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, entradaData);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "UPDATE alunos SET idTurma=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setInt(1, entradaTurma);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "UPDATE alunos SET logradouro=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, entradaLogradouro);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "UPDATE alunos SET numeroLogradouro=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, entradaNumero);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "UPDATE alunos SET complemento=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, entradaComplemento);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "UPDATE alunos SET bairro=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, entradaBairro);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "UPDATE alunos SET cidade=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, entradaCidade);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "UPDATE alunos SET CEP=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, entradaCEP);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "UPDATE alunos SET UF=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, entradaUF);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

                sql = "UPDATE alunos SET email=? WHERE idCPF =? ";
                ps = conexao.prepareStatement(sql);
                ps.setString(1, entradaEmail);
                ps.setString(2, valorCPF);
                ps.executeUpdate();

            } catch (SQLException ex) {
                ex.printStackTrace();
            }
        }
    }
}
