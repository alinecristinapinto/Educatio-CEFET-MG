package manutencaoDiario.controller.view;

import java.io.IOException;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Pos;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.VBox;
import manutencaoDiario.controller.AlteraDados;
import manutencaoDiario.controller.BancoDeDados;
import manutencaoDiario.controller.Main;

public class AcessoDiarioAlunoControlador {

    private BancoDeDados acessoBancoDeDados = new BancoDeDados();
    private Connection conexao = null;
    private AlteraDados alterar = new AlteraDados();

    private String valorCPF;
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
        
       /* List idConteudosDisciplina = new ArrayList();
        idConteudosDisciplina.addAll(Arrays.asList(alterar.alteraConteudo(idConteudos.get(1).toString())));*/
        
        for (int j = 0; j < atividades.size(); j++) {
            System.out.println(atividades.get(j));
        }

        for (int k = 0; k < nomeDisciplinas.size(); k++) {
            System.out.println(nomeDisciplinas.get(k));
            FXMLLoader carregadorFXML = new FXMLLoader();
            carregadorFXML.setLocation(Main.class.getResource("view/BlocoDiarioAluno.fxml"));
            AnchorPane painelPrincipal = (AnchorPane) carregadorFXML.load();
            BlocoDiarioAlunoControlador bloco = carregadorFXML.getController();
            
            List nomeAtividade = new ArrayList();
            nomeAtividade.addAll(Arrays.asList(alterar.alteraList(atividades.get(k).toString())));
            String atividadesLabel[];
            for(int y=0;y<nomeAtividade.size();y++){
                System.out.println(nomeAtividade.get(y));
            }
            
            
            String cabecalho = nomeDisciplinas.get(k).toString() + " - " + nomeProfessores.get(k).toString();
            bloco.setLabelCabecalho(cabecalho);
            vBox.getChildren().add(painelPrincipal);
            vBox.setSpacing(80);

            vBox.setAlignment(Pos.CENTER);
        }
    }
}
