/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package SelecaoNotas.controlador.visao;

import BD.SelecaoNotasBD;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.TextField;
import SelecaoNotas.controlador.SelecaoNotasMain;
import SelecaoNotas.controlador.modelo.DadosNotas;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import javafx.collections.ObservableList;
import javafx.scene.control.ChoiceBox;
import javafx.scene.layout.GridPane;


/**
 *
 * @author Aluno
 */
public class LayoutInicialControlador {
    private SelecaoNotasMain selecaoNotasMain;
    private DadosNotas dadosNotas;
    private boolean BotaoSelecionaAno = false;
    private boolean BotaoChamaRelatorio = false;
    private Connection conexao=null;
    private ResultSet result;
    private ObservableList<String> anosEtapa;
    private SelecaoNotasBD manutencao;
    @FXML
    private TextField nomeAlunoField;
    @FXML
    private ChoiceBox caixaSelecao;
    @FXML
    private GridPane painelSelecionaAno;
    
    public LayoutInicialControlador(){
        
    }
    
    @FXML
    private void initialize() {
        painelSelecionaAno.setVisible(false);
    }
    
    public void setDadosNotas(DadosNotas dadosNotas ) {
        this.dadosNotas = dadosNotas;

        nomeAlunoField.setText(dadosNotas.getNomeAluno());

    }
    
    public void setManutencao(SelecaoNotasBD manutencao){
        this.manutencao = manutencao;
    }
    
    public void setSelecaoNotasMain(SelecaoNotasMain selecaoNotasMain) {
        this.selecaoNotasMain = selecaoNotasMain;
    }
    
    public boolean isBotaoSelecionaAno() {
        return BotaoSelecionaAno;
    }
    
    @FXML
    private void ChamaTelaRelatorio() {
        selecaoNotasMain.showTelaRelatorio();
            //caixaSelecao.getValue()
            BotaoChamaRelatorio = true;
        }
    
    @FXML
    private void SelecionaAno() throws SQLException{
        
        if (campoInvalido()) {
            dadosNotas.setNomeAluno(nomeAlunoField.getText());
            painelSelecionaAno.setVisible(true);
            BotaoSelecionaAno = true;
        }
        
        /*this.conexao = new CriaConexao().getConexao();
        anosEtapa = FXCollections.observableArrayList();
        String sql_fetch = "SELECT ano FROM matriculas WHERE idAluno ='"+dadosNotas.getNomeAluno()+" OR idAluno ='"+dadosNotas.getNomeAluno()+"  'AND ativo='S'";
        Statement fetch = conexao.createStatement();
        result = fetch.executeQuery(sql_fetch);
        while(result.next()){
            anosEtapa.add(result.getString("ano"));
        }
        result.close();
        
        caixaSelecao.setItems(anosEtapa);*/
    }
    
    public boolean isBotaoChamaRelatorio() {
        return BotaoChamaRelatorio;
    }
    
    private boolean campoInvalido() {
        String errorMessage = "";
        
        if (nomeAlunoField.getText() == null || nomeAlunoField.getText().length() == 0) {
            errorMessage += "Nome inválido!\n"; 
        }

        if (errorMessage.length() == 0) {
            return true;
        } else {
            // Mostra a mensagem de erro.
            Alert alert = new Alert(AlertType.ERROR);
                      alert.setTitle("Campo Inválido");
                      alert.setHeaderText("Por favor, digite um nome válido.");
                      alert.setContentText(errorMessage);
                alert.showAndWait();

            return false;
        }
    }
}
