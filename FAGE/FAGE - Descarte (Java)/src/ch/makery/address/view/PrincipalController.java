package ch.makery.address.view;

import ch.makery.address.MainApp;
import ch.makery.address.model.Acervo;
import ch.makery.jdbc.BancoDeDados;
import ch.makery.jdbc.ConectaComBD;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.format.DateTimeFormatter;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.collections.transformation.SortedList;
import javafx.fxml.FXML;
import javafx.scene.control.DatePicker;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.TextArea;

public class PrincipalController {
    @FXML
    private TextField txtIdFuncionario;
    @FXML
    private TextArea txtMotivo;
    @FXML
    private DatePicker data;
    @FXML
    private TextField txtNomeAcervo;
    @FXML
    private TableView<Acervo> tabela;
    @FXML
    private TableColumn<Acervo, Integer> colunaIdAcervo;
    @FXML
    private TableColumn<Acervo, String> colunaNomeAcervo;
    @FXML
    private TableColumn<Acervo, String> colunaAno;
    @FXML
    private TableColumn<Acervo, String> colunaLocal;
    @FXML
    private TableColumn<Acervo, String> colunaEditora;
    
    private ObservableList<Acervo> lista;
    private MainApp mainApp;
    private static Connection conexao;
    
    public void setMainApp(MainApp mainApp) {
        this.mainApp = mainApp;
    }
    
    public TextField getTxtIdFuncionario() {
        return txtIdFuncionario;
    }

    public void setTxtIdFuncionario(TextField txtIdFuncionario) {
        this.txtIdFuncionario = txtIdFuncionario;
    }

    public TextArea getTxtMotivo() {
        return txtMotivo;
    }

    public void setTxtMotivo(TextArea txtMotivo) {
        this.txtMotivo = txtMotivo;
    }
    
    @FXML
    private void deletaAcervo() {
        BancoDeDados bd = new BancoDeDados();
        if(!emprestado()){
            try {
                bd.deletaAcervo(tabela.getSelectionModel().getSelectedItem().getIdAcervo().get());
                bd.guardaDescarte(
                    tabela.getSelectionModel().getSelectedItem().getIdAcervo().get(),
                    data.getValue().format(DateTimeFormatter.ofPattern("dd/MM/yyyy")),
                    txtMotivo.getText(),
                    txtIdFuncionario.getText());
            } catch (SQLException | ClassNotFoundException ex) {
                Logger.getLogger(PrincipalController.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
            txtMotivo.setText("");
            txtNomeAcervo.setText("");
            data.setValue(null);
            montaTabela();
    }
    
    private boolean emprestado(){
        String sql = "SELECT * FROM emprestimos WHERE ativo = 'S'";
        try{
            PreparedStatement stmt = conexao.prepareStatement(sql);
            ResultSet rs = stmt.executeQuery(sql);
            if(!rs.next()){
                rs.close();
                return false;
            }
                if(tabela.getSelectionModel().getSelectedItem().getIdAcervo().get()==rs.getInt(3)){
                        System.out.println("Livro emprestado para o aluno de id: " + rs.getString(2) +"\nData prevista para devolução: " + rs.getString(5));
                        return true;
                }
                while(rs.next()){
                    if(tabela.getSelectionModel().getSelectedItem().getIdAcervo().get()==rs.getInt(3)){
                        System.out.println("Livro emprestado para o aluno de id: " + rs.getString(2) +"\nData prevista para devolução: " + rs.getString(5));
                        return true;
                    }
                }
                rs.close();
        }catch (SQLException ex) {
            Logger.getLogger(PrincipalController.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }
    
    //private boolean entradaCorreta(){
        
    //}

    @FXML
    public void initialize() {
        try {
            conexao = ConectaComBD.getConnection();
        } catch (SQLException | ClassNotFoundException ex) {
            Logger.getLogger(PrincipalController.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        colunaIdAcervo.setCellValueFactory(cellData -> cellData.getValue().getIdAcervo().asObject());
        colunaNomeAcervo.setCellValueFactory(cellData -> cellData.getValue().getNomeAcervo());
        colunaEditora.setCellValueFactory(cellData -> cellData.getValue().getEditora());
        colunaLocal.setCellValueFactory(cellData -> cellData.getValue().getLocal());  
        colunaAno.setCellValueFactory(cellData -> cellData.getValue().getAno());
        
        montaTabela();
        
        FilteredList<Acervo> filtraDados = new FilteredList<>(lista, p -> true);
        txtNomeAcervo.textProperty().addListener((observable, oldValue, newValue) -> 
        {
            filtraDados.setPredicate(Acervo -> {
            // If filter text is empty, display all persons.
            if (newValue == null || newValue.isEmpty()) {
                return true;
            }
            // Compare first name and last name of every person with filter text.
            String lowerCaseFilter = newValue.toLowerCase();
            if (Acervo.getNomeAcervo().toString().toLowerCase().contains(lowerCaseFilter)) {
                return true; // Filter matches first name.
            }
                return false; // Does not match.
            });
        });
        SortedList<Acervo> sorteiaDados = new SortedList<>(filtraDados);
        sorteiaDados.comparatorProperty().bind(tabela.comparatorProperty());
        tabela.setItems(sorteiaDados);
    }
    
    private void montaTabela(){
        lista = FXCollections.observableArrayList();
        String sql = "SELECT * FROM acervo WHERE ativo = 'S'";
        try (PreparedStatement stmt = conexao.prepareStatement(sql)) {
            ResultSet rs = stmt.executeQuery();
                while(rs.next()){
                    lista.add(new Acervo(rs.getInt(1),rs.getInt(2),rs.getString(3),rs.getString(4),rs.getString(5),rs.getString(6),rs.getString(7),rs.getString(8)));
                }
                rs.close();
        }catch (SQLException ex) {
            Logger.getLogger(PrincipalController.class.getName()).log(Level.SEVERE, null, ex);
        }
        tabela.setItems(lista);
    }
    
    private void retornaTela(){
        
    }
}
