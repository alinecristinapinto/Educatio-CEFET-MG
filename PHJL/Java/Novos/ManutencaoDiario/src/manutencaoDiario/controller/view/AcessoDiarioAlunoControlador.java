package manutencaoDiario.controller.view;

import java.io.IOException;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Pos;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.VBox;
import manutencaoDiario.controller.AlteraDados;
import manutencaoDiario.controller.BancoDeDados;
import manutencaoDiario.controller.Main;
import manutencaoDiario.controller.ManutencaoDiario;
import manutencaoDiario.controller.model.TabelaAtividades;

public class AcessoDiarioAlunoControlador {

    private final BancoDeDados acessoBancoDeDados = new BancoDeDados();
    private final Connection conexao = null;
    private final AlteraDados alterar = new AlteraDados();
    private ManutencaoDiario manutencaoDiario;

    private final String valorCPF;
    private ObservableList<TabelaAtividades> dadosAtividade = FXCollections.observableArrayList();
    List nomeDisciplinas = new ArrayList();
    List idDisciplinas = new ArrayList();
    List nomeProfessores = new ArrayList();
    List idConteudos = new ArrayList();
    List idMatriculas = new ArrayList();
    List atividades = new ArrayList();

    @FXML
    private VBox vBox;

    public AcessoDiarioAlunoControlador() {
        this.valorCPF = "89594318180";

    }

    @FXML
    private void initialize() throws IOException, SQLException {

        nomeDisciplinas = acessoBancoDeDados.pegaNomeDisciplinas(valorCPF);
        nomeProfessores = acessoBancoDeDados.pegaNomeProfessores(valorCPF);
        idConteudos = acessoBancoDeDados.pegaIdConteudo(valorCPF);
        idDisciplinas = acessoBancoDeDados.pegaIdDisciplinas(valorCPF);
        idMatriculas = acessoBancoDeDados.pegaIdMatricula(valorCPF, idDisciplinas);
        atividades = acessoBancoDeDados.pegaAtividade(valorCPF, idMatriculas);

        for (int k = 0; k < nomeDisciplinas.size(); k++) {
            dadosAtividade.clear();
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(Main.class.getResource("view/BlocoDiarioAluno.fxml"));
            AnchorPane painelPrincipal = (AnchorPane) carregadorFXML.load();
            BlocoDiarioAlunoControlador bloco = carregadorFXML.getController();
            bloco.setAcesso(this);

            List nomeAtividade = new ArrayList();
            String[] temp = alterar.alteraList(atividades.get(k).toString());
            for (String temp1 : temp) {
                nomeAtividade.addAll(Arrays.asList(alterar.alteraList(temp1)));
            }
            int p = 0;
            int o = 1;
            int q = 2;
            int r = 3;
            int u = nomeAtividade.size() / 4;
            for (int y = 0; y < u; y++) {
                dadosAtividade.add(new TabelaAtividades(nomeAtividade.get(p).toString(), nomeAtividade.get(o).toString(), nomeAtividade.get(q).toString(), nomeAtividade.get(r).toString()));
                r += 4;
                p += 4;
                o += 4;
                q += 4;
            }

            String cabecalho = nomeDisciplinas.get(k).toString() + " - " + nomeProfessores.get(k).toString();
            bloco.setLabelCabecalho(cabecalho);
            bloco.colocaDados();
            vBox.getChildren().add(painelPrincipal);
            vBox.setSpacing(80);

            vBox.setAlignment(Pos.CENTER);

        }
    }

    public ObservableList<TabelaAtividades> getDadosAtividade() {
        return dadosAtividade;
    }

    public void setManutencaoDiario(ManutencaoDiario manutencaoDiario) {
        this.manutencaoDiario = manutencaoDiario;
    }

}
