package ch.makery.address.view;

import ch.makery.address.MainApp;
import ch.makery.address.model.Acervo;
import ch.makery.jdbc.ConectaComBD;
import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.ListView;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;

public class ListaAcervoController {
    @FXML
    private ListView listaDeAcervos;
    @FXML
    private Alert alert;
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
    @FXML
    private ObservableList<Acervo> lista;
    
    private MainApp mainApp;
    private Acervo acervoMostra;

    //public ListaAcervoController(String nomeAcervo) {
    //    this.nomeAcervo = nomeAcervo;
    //}
    
    public void setAcervoMostra(Acervo acervoMostra) {
        this.acervoMostra = acervoMostra;
    }

    public void setMainApp(MainApp mainApp) {
        this.mainApp = mainApp;
    }
    @FXML
    public ListView getListaDeAcervos() {
        return listaDeAcervos;
    }
    @FXML
    public void setListaDeAcervos(ListView listaDeAcervos) {
        this.listaDeAcervos = listaDeAcervos;
    }
    
    @FXML
    private void selecionaId(){
        montaTabela();
    }

    @FXML
    public void initialize() {
        colunaIdAcervo = new TableColumn<>();
        colunaNomeAcervo = new TableColumn<>();
        colunaLocal = new TableColumn<>();
        colunaEditora = new TableColumn<>();
        colunaAno = new TableColumn<>();
        tabela = new TableView<>();
    }
    @FXML
    public void montaTabela()
    {
        try {
            
            Connection conexao = ConectaComBD.getConnection();
            String sql = "SELECT * FROM acervo WHERE nome = '" + acervoMostra.getNomeAcervo() + "' AND ativo = 'S' ORDER BY id";
            lista =  FXCollections.observableArrayList();
            PreparedStatement stmt = conexao.prepareStatement(sql);
            ResultSet rs = stmt.executeQuery();
            while(rs.next()){
                lista.add(new Acervo(rs.getInt("id"), rs.getString("nome"), rs.getString("local"), rs.getString("editora"), rs.getString("ano")));
                System.out.println(lista.toString());
            }
            stmt.close();
        } catch (SQLException | ClassNotFoundException ex) {
            Logger.getLogger(ListaAcervoController.class.getName()).log(Level.SEVERE, null, ex);
        }
        colunaIdAcervo.setCellValueFactory(new PropertyValueFactory<Acervo, Integer>("idAcervo"));
        colunaNomeAcervo.setCellValueFactory(new PropertyValueFactory<Acervo, String>("nomeAcervo"));
        colunaLocal.setCellValueFactory(new PropertyValueFactory<Acervo, String>("local"));
        colunaEditora.setCellValueFactory(new PropertyValueFactory<Acervo, String>("editora"));
        colunaAno.setCellValueFactory(new PropertyValueFactory<Acervo, String>("ano"));
        
        tabela.setItems(lista);
        
    }
}  
