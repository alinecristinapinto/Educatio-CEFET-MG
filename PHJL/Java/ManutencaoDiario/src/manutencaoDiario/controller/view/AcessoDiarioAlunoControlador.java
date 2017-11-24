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
import javafx.scene.control.Label;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.VBox;
import javafx.scene.paint.Color;
import javafx.scene.text.Font;
import manutencaoDiario.controller.AlteraDados;
import manutencaoDiario.controller.BancoDeDados;
import manutencaoDiario.controller.Main;
import manutencaoDiario.controller.ManutencaoDiario;
import manutencaoDiario.controller.model.TabelaAtividades;
import manutencaoDiario.controller.model.TabelaFrequencia;

public class AcessoDiarioAlunoControlador {

    private final BancoDeDados acessoBancoDeDados = new BancoDeDados();
    private final Connection conexao = null;
    private final AlteraDados alterar = new AlteraDados();
    private ManutencaoDiario manutencaoDiario;

    private final String valorCPF;
    private ObservableList<TabelaAtividades> dadosAtividades = FXCollections.observableArrayList();
    private ObservableList<TabelaFrequencia> dadosFrequencias = FXCollections.observableArrayList();
    
    List nomeDisciplinas = new ArrayList();
    List idDisciplinas = new ArrayList();
    List nomeProfessores = new ArrayList();
    List idConteudos = new ArrayList();
    List idMatriculas = new ArrayList();
    List atividades = new ArrayList();
    List frequencia = new ArrayList();        

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
        frequencia = acessoBancoDeDados.pegaFrequencia(valorCPF, idMatriculas);
        
        Label Titulo = new Label();
        Titulo.setText("Diário Aluno");
        Titulo.setTextFill(Color.WHITE);
        Titulo.setStyle("-fx-font-size: 40px");
        Titulo.setAlignment(Pos.CENTER_LEFT);
        vBox.getChildren().add(Titulo);
        
        for (int k = 0; k < nomeDisciplinas.size(); k++) {
            ObservableList<TabelaAtividades> dadosAtividade = FXCollections.observableArrayList();
            ObservableList<TabelaFrequencia> dadosFrequencia = FXCollections.observableArrayList();
            
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(Main.class.getResource("view/BlocoDiarioAluno.fxml"));
            AnchorPane painelPrincipal = (AnchorPane) carregadorFXML.load();
            BlocoDiarioAlunoControlador bloco = carregadorFXML.getController();
            bloco.setAcesso(this);
            System.out.println(frequencia.get(k));
            
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
            
            List dadosF = new ArrayList();
            String[] temporario = alterar.alteraList(frequencia.get(k).toString());
            for (String temp1 : temporario) {
                dadosF.addAll(Arrays.asList(alterar.alteraList(temp1)));
            }
            int z = 0;
            int x = 1;
                    
            int b = dadosF.size() / 2;
            for (int y = 0; y < b; y++) {
                dadosFrequencia.add(new TabelaFrequencia(dadosF.get(z).toString(),dadosF.get(x).toString()));
                z += 2;
                x += 2;
            }
            dadosAtividades = dadosAtividade;
            dadosFrequencias = dadosFrequencia;
            String cabecalho = nomeDisciplinas.get(k).toString() + " - " + nomeProfessores.get(k).toString();
            bloco.setLabelCabecalho(cabecalho);
            bloco.colocaDadosAtividades();
            bloco.colocaDadosFrequencia();
           
            vBox.getChildren().add(painelPrincipal);
            vBox.setSpacing(50);

            vBox.setAlignment(Pos.CENTER);

        }

    }

    public ObservableList<TabelaAtividades> getDadosAtividade() {
        return dadosAtividades;
    }
     public ObservableList<TabelaFrequencia> getDadosFrequencia() {
        return dadosFrequencias;
    }

    public void setManutencaoDiario(ManutencaoDiario manutencaoDiario) {
        this.manutencaoDiario = manutencaoDiario;
    }

}
