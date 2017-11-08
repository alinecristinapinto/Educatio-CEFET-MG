package ch.makery.address.view;

/*import ch.makery.address.MainApp;
import ch.makery.address.model.Acervo;
import ch.makery.jdbc.BancoDeDados;
import ch.makery.jdbc.ConectaComBD;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.collections.transformation.SortedList;
import javafx.fxml.FXML;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;

public class ListaAcervoController {

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
    
    private Acervo acervoDeletado;
    private static Connection conexao;
    
    public void setAcervoMostra(Acervo acervoMostra) {
        this.acervoDeletado = acervoDeletado;
    }
    
    @FXML
    private void deletaAcervo() {
        System.out.println(tabela.getSelectionModel().getSelectedItem());
        BancoDeDados bd = new BancoDeDados();
        try {
            bd.deletaAcervo(tabela.getSelectionModel().getSelectedItem().getIdAcervo().get());
            bd.guardaDescarte(
                    tabela.getSelectionModel().getSelectedItem().getIdAcervo().get(),
                    tabela.getSelectionModel().getSelectedItem().getData(),
                    tabela.getSelectionModel().getSelectedItem().getMotivo(),
                    tabela.getSelectionModel().getSelectedItem().getIdFuncionario());
        } catch (SQLException | ClassNotFoundException ex) {
            Logger.getLogger(ListaAcervoController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    @FXML
    public void initialize() {
                try {
                    conexao = ConectaComBD.getConnection();
                } catch (SQLException | ClassNotFoundException ex) {
                    Logger.getLogger(ListaAcervoController.class.getName()).log(Level.SEVERE, null, ex);
                }
                
                String sql = "SELECT * FROM acervo WHERE ativo = 'S'";
                
                lista = FXCollections.observableArrayList();
                
                try (PreparedStatement stmt = conexao.prepareStatement(sql)) {
                    ResultSet rs = stmt.executeQuery();
                    while(rs.next()){
                        lista.add(new Acervo(rs.getInt(1),rs.getInt(2),rs.getString(3),rs.getString(4),rs.getString(5),rs.getString(6),rs.getString(7),rs.getString(8)));
                    }
                }catch (SQLException ex) {
                    Logger.getLogger(ListaAcervoController.class.getName()).log(Level.SEVERE, null, ex);
                }
                colunaIdAcervo.setCellValueFactory(cellData -> cellData.getValue().getIdAcervo().asObject());
                colunaNomeAcervo.setCellValueFactory(cellData -> cellData.getValue().getNomeAcervo());
                colunaEditora.setCellValueFactory(cellData -> cellData.getValue().getEditora());
                colunaLocal.setCellValueFactory(cellData -> cellData.getValue().getLocal());  
                colunaAno.setCellValueFactory(cellData -> cellData.getValue().getAno());
                tabela.setItems(lista);
                
                FilteredList<Acervo> filtraDados = new FilteredList<>(lista, p -> true);
            
                txtNomeAcervo.textProperty().addListener((observable, oldValue, newValue) -> {
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
    
}  */
