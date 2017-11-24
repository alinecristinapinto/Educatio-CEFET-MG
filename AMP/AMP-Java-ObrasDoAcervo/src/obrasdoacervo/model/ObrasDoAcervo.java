/*
148 / 200 = x / 45
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package obrasdoacervo.model;

import java.io.IOException;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import javafx.application.Application;
import static javafx.application.Application.launch;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;
import obrasdoacervo.model.controller.CriaAcademicoController;
import obrasdoacervo.model.controller.CriaAutorController;
import obrasdoacervo.model.controller.CriaLivroController;
import obrasdoacervo.model.controller.CriaMidiaController;
import obrasdoacervo.model.controller.CriaParteController;
import obrasdoacervo.model.controller.CriaPeriodicoController;
import obrasdoacervo.model.controller.EditaAcademicoController;
import obrasdoacervo.model.controller.EditaAutorController;
import obrasdoacervo.model.controller.EditaLivroController;
import obrasdoacervo.model.controller.EditaMidiaController;
import obrasdoacervo.model.controller.EditaParteController;
import obrasdoacervo.model.controller.EditaPeriodicosController;
import obrasdoacervo.model.controller.InterfacePrincipalController;
import obrasdoacervo.model.controller.MenuSwitchObrasController;
import obrasdoacervo.model.controller.PesquisarAutorController;
import obrasdoacervo.model.controller.PesquisarObraController;

/**
 *
 * @author Aluno
 */
public class ObrasDoAcervo extends Application {
   
    private Stage stage;
    private BorderPane borda;
    
    private ObservableList<AcervoTabela> listaAcervo;
    private ObservableList<AutoresTabela> listaAutores;
    
    @Override
    public void start(Stage stage) throws IOException{
        
        this.stage = stage;
        abreBaseTelaInicial();
        abreInterfacePrincipal();
        
    }

    public void abreBaseTelaInicial() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/Borda.fxml"));
        borda = (BorderPane) loader.load();
        stage.setScene(new Scene(borda));
        stage.show();
    }
    
    public void abreInterfacePrincipal() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/InterfacePrincipal.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        InterfacePrincipalController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abrePesquisarObra() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/PesquisarObra.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        PesquisarObraController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abrePesquisarAutor() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/PesquisarAutor.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        PesquisarAutorController controller = loader.getController();
        controller.setMain(this);
    }
    
    
    public void abreCriaAcademico() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/CriaAcademico.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        CriaAcademicoController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abreCriaLivro() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/CriaLivro.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        CriaLivroController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abreCriaMidia() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/CriaMidia.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        CriaMidiaController controller = loader.getController();
        controller.setMain(this);
    } 
    
    public void abreCriaParte() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/CriaParte.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        CriaParteController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abreCriaParteSecundario() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/CriaParteSecundario.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        CriaParteController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abreCriaPeriodico() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/CriaPeriodico.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        CriaPeriodicoController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abreCriaAutor() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/CriaAutor.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        CriaAutorController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abreCriaAutorSecundario() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/CriaAutorSecundario.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        CriaAutorController controller = loader.getController();
        controller.setMain(this);
    }
    
    public void abreEditaAcademico(Connection link, String nome, String tipo, String local, String ano, String editora, String paginas, int id) throws IOException, SQLException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/EditaAcademico.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        EditaAcademicoController controller = loader.getController();
        controller.setMain(this, link, nome, tipo, local, ano, editora, paginas, id);
    }
    
    public void abreEditaLivro(Connection link, String nome, String tipo, String local, String ano, String editora, String paginas, int id) throws IOException, SQLException{    FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/EditaLivro.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        EditaLivroController controller = loader.getController();
        controller.setMain(this, link, nome, tipo, local, ano, editora, paginas, id);
    }
    
    public void abreEditaMidia(Connection link, String nome, String tipo, String local, String ano, String editora, String paginas, int id) throws IOException, SQLException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/EditaMidia.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        EditaMidiaController controller = loader.getController();
        controller.setMain(this, link, nome, tipo, local, ano, editora, paginas, id);
    }
    
    public void abreEditaParte(Connection link, int id) throws IOException, SQLException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/EditaParte.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        EditaParteController controller = loader.getController();
        controller.setMain(this, link, id);
    }
    
    public void abreEditaPeriodicos(Connection link, String nome, String tipo, String local, String ano, String editora, String paginas, int id) throws IOException, SQLException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/EditaPeriodicos.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        EditaPeriodicosController controller = loader.getController();
        controller.setMain(this, link, nome, tipo, local, ano, editora, paginas, id);
    }

    public void abreEditaAutor(String nome, String sobrenome, String ordem, String qualificacao) throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/EditaAutor.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        EditaAutorController controller = loader.getController();
        controller.setMain(this, nome, sobrenome, ordem, qualificacao);
        //EditaAutorController.preenche(nome, sobrenome, ordem, qualificacao);
    }
    
    
    public void abreMenuSwitchObras() throws IOException{
        FXMLLoader loader = new FXMLLoader();
        loader.setLocation(ObrasDoAcervo.class.getResource("view/MenuSwitchObras.fxml"));
        AnchorPane tela = (AnchorPane) loader.load();
        borda.setCenter(tela);
        MenuSwitchObrasController controller = loader.getController();
        controller.setMain(this);
    }
        
    public static void insere (Connection connection, Obras obras){
        Statement stmt = null;
        // ResultSet rs = null;
        String sql = "INSERT INTO acervo(idCampi, nome,  tipo,  local,  ano,  editora,  paginas, ativo) VALUES(" + obras.idCampi + ", '" + obras.nome + 
               "', " + obras.tipo + ", '" + obras.local + "', '" + obras.ano + "', '" + obras.editora + "', '" + obras.paginas + "', 'S')";
        // String sql = "SELECT *  FROM acervo";
        
        
        try{
        stmt = connection.createStatement();
        // rs = stmt.executeQuery(sql);
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
    }
    
    public static void insereLivro (Connection connection, Livros livro) throws SQLException{
        int id;
        Statement stmt = connection.createStatement();
        ResultSet rs = null;
        String sql;
        String findId = "SELECT *  FROM acervo";
        
        try{
        rs = stmt.executeQuery(findId);
        rs.last();
        id = rs.getInt("id");
        sql = "INSERT INTO livros(idAcervo, ISBN, edicao, ativo) VALUES(" + (id + 1) + ", '" + livro.ISBN + 
              "', '" + livro.edicao + "', 'S')";
       stmt.execute(sql);

        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Obras obras = new Obras (livro.idCampi, livro.nome,  "'livros'",  livro.local,  livro.ano,  livro.editora,  livro.paginas);
        insere(connection, obras);
    }
    
    public static void insereMidias (Connection connection, Midias midia){
        int id;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        ResultSet rs = null;
        String findId = "SELECT *  FROM acervo";
        rs = stmt.executeQuery(findId);
        rs.last();
        id = rs.getInt("id");
        String sql = "INSERT INTO midias(idAcervo, tempo, subtipo, ativo) VALUES(" + (id + 1) + ", '" + midia.tempo + 
               "', '" + midia.subtipo + "', 'S')";
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Obras obras = new Obras (midia.idCampi, midia.nome,  "'midias'",  midia.local,  midia.ano,  midia.editora,  midia.paginas);
        insere(connection, obras);
    }
    
    public static void insereAcademicos (Connection connection, Academicos academicos){
        int id;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        ResultSet rs = null;
        String findId = "SELECT *  FROM acervo";
        rs = stmt.executeQuery(findId);
        rs.last();
        id = rs.getInt("id");
        String sql = "INSERT INTO academicos(idAcervo, programa, ativo) VALUES(" + (id + 1) + ", '" + academicos.programa + "', 'S')";
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Obras obras = new Obras (academicos.idCampi, academicos.nome,  "'academicos'",  academicos.local,  academicos.ano,  academicos.editora,  academicos.paginas);
        insere(connection, obras);
    }
    
    public static void inserePeriodicos (Connection connection, Periodicos periodicos){
        int id;
        Statement stmt = null;
        // ResultSet rs = null;
        //String sql = "INSERT INTO periodicos(idAcervo, periodicidade, mes, volume, subtipo, ISSN, ativo) VALUES(" + (id + 1) + ", " + periodicos.periodicidade + 
        //       ", " + periodicos.mes + ", " + periodicos.volume + ", " + periodicos.subtipo + ", " + periodicos.ISSN + ", 'S')";
        // String sql = "SELECT *  FROM acervo";
        
        try{
        stmt = connection.createStatement();
        ResultSet rs = null;
        String findId = "SELECT *  FROM acervo";
        rs = stmt.executeQuery(findId);
        rs.last();
        id = rs.getInt("id");
        // rs = stmt.executeQuery(sql);
        String sql = "INSERT INTO periodicos(idAcervo, periodicidade, mes, volume, subtipo, ISSN, ativo) VALUES('" + (id + 1) + "', '" + periodicos.periodicidade + 
               "', '" + periodicos.mes + "', '" + periodicos.volume + "', '" + periodicos.subtipo + "', '" + periodicos.ISSN + "', 'S')";
        stmt.execute(sql);
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        Obras obras = new Obras (periodicos.idCampi, periodicos.nome,  "'periodicos'",  periodicos.local,  periodicos.ano,  periodicos.editora,  periodicos.paginas);
        insere(connection, obras);
    }
    
    public static void inserePartes (Connection connection, Partes partes/*, Periodicos periodicos*/){
        int id;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        ResultSet rs = null;
        String findId = "SELECT *  FROM periodicos";
        rs = stmt.executeQuery(findId);
        rs.last();
        id = rs.getInt("id");
        // rs = stmt.executeQuery(sql);

        String sql = "INSERT INTO partes(idPeriodico, titulo, pagInicio, pagFinal, palavrasChave, ativo) VALUES('" + (id) + "', '" + partes.titulo + 
               "', '" + partes.pagInicio + "', '" + partes.pagFinal + "', '" + partes.palavrasChave + "', 'S')";
        stmt.execute(sql);
        
        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        // Periodicos periodicos = new Periodicos (partes[0].periodicidade, partes[0].mes, partes[0].volume, partes[0].subtipo, partes[0].ISSN, partes[0].idCampi, partes[0].nome, "'periodicos'", partes[0].local, partes[0].ano, partes[0].editora, partes[0].paginas);
        //inserePeriodicos(connection, periodicos);
    }
    
    public static void insereAutores (Connection connection, Autores autores){
        int id;
        int idAutor;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        ResultSet rs = null;
        String findId = "SELECT *  FROM acervo";
        rs = stmt.executeQuery(findId);
        rs.last();
        id = rs.getInt("id");
        String sql = "INSERT INTO autores(nome,  sobrenome, ordem, qualificacao, ativo) VALUES('" + autores.nome + "', '" + autores.sobrenome + 
               "', '" + autores.ordem + "', '" + autores.qualificacao + "', 'S')";
        stmt.execute(sql);
        String findIdAutor = "SELECT *  FROM autores";
        rs = stmt.executeQuery(findIdAutor);
        rs.last();
        idAutor = rs.getInt("id");
        String index = "INSERT INTO autoracervo(idAcervo, idAutor, ativo) VALUES('" + id + "', '" + idAutor + "', 'S')";
        stmt.execute(index);

        
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
    }
    
    public static void removePartes (Connection connection, int ident){
        int id;
        //String sql = "UPDATE partes SET ativo='N' WHERE idPeriodico=" + ident;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        ResultSet rs = null;
        String findId = "SELECT * FROM periodicos WHERE idAcervo = " +ident;
        rs = stmt.executeQuery(findId);
        rs.last();
        id = rs.getInt("id");
        String sql = "UPDATE partes SET ativo='N' WHERE idPeriodico = " + id;
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        
    }
    
    public static void remove (Connection connection, int ident, String tabela){
        Statement stmt = null;
        try{
        stmt = connection.createStatement();
        ResultSet rs = null;
        String findId = "SELECT * FROM emprestimos WHERE idAcervo = " +ident;
        rs = stmt.executeQuery(findId);
        while (rs.next()){
            String ativo = rs.getString("ativo");
            if ("S".equals(ativo)){
                System.out.println("O livro está emprestado e não pode ser removido");
                return;
            }
        }
        
        
        String sql = "UPDATE " + tabela + " SET ativo='N' WHERE idAcervo=" + ident;
        if (tabela.compareTo("periodicos") == 0){
            removePartes(connection, ident);
        }
        
        stmt = connection.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        
        removeAcervo(connection, ident);
        
    }
    
    public static void removeAcervo (Connection connection, int ident){
        String sql = "UPDATE acervo SET ativo='N' WHERE id=" + ident;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        
        removeAutores (connection, ident);
        
    }
    
    public static void removeAutores (Connection connection, int ident){
        int id = 0;
        int[] idAutor;
        idAutor = new int[5];
        Statement stmt = null;
        String sql;
        
        try{
        stmt = connection.createStatement();
        ResultSet rs = null;
        String findIdAutor = "SELECT * FROM autoracervo WHERE idAcervo = " + ident;
        sql = "UPDATE autoracervo SET ativo='N' WHERE idAcervo = " + ident;
        stmt.execute(sql);
        rs = stmt.executeQuery(findIdAutor);
        while(rs.next()){
        idAutor[id] = rs.getInt("idAutor");
        id++;
        }
        for(int j = 0; j < id; j++){
        sql = "UPDATE autores SET ativo='N' WHERE id=" + idAutor[j];
        stmt.execute(sql);
        }
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
    }
    
    public static void alteraAcervo (Connection connection, String nome, String tipo, String local, String ano, String editora, String paginas, String tabela, String campo, String valor){
        String sql = "UPDATE " + tabela + " SET " + campo + "='" + valor + "' WHERE nome='" + nome + "' AND tipo='"+tipo+"' AND ano='"+ano+"' AND editora='"+editora+"' AND ativo = 'S'";
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        
    }
    
    public static void alteraLivro (Connection connection, String edicao, String ISBN, int id){
        String sql = "UPDATE livros SET ISBN='"+ISBN+"', edicao='"+edicao+"' WHERE ativo='S' AND idAcervo="+id;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        
        
    }
    
    public static void alteraMidia (Connection connection, String tempo, String subtipo, int id){
        String sql = "UPDATE midias SET tempo='"+tempo+"', subtipo='"+subtipo+"' WHERE ativo='S' AND idAcervo="+id;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }        
    }
    
    public static void alteraAcademicos (Connection connection, String programa, int id){
        String sql = "UPDATE academicos SET programa='"+programa+"' WHERE ativo='S' AND idAcervo="+id;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }        
    }
    
    public static void alteraPeriodicos (Connection connection, String mes, String periodicidade, String volume, String subtipo, int id){
        String sql = "UPDATE periodicos SET mes='"+mes+"', periodicidade='"+periodicidade+"', subtipo='"+subtipo+"', volume='"+volume+"' WHERE ativo='S' AND idAcervo="+id;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }        
    }
    
    public static void alteraPartes (Connection connection, String titulo, String pagInicio, String pagFinal, String palavraschave, int id){
        String sql = "UPDATE partes SET titulo='"+titulo+"', pagInicio='"+pagInicio+"', pagFinal='"+pagFinal+"', palavraschave='"+palavraschave+"' WHERE ativo='S' AND id="+id;
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }        
    }

    public static void alteraAutor (Connection connection, String nome, String sobrenome, String ordem, String qualificacao, String tabela, String campo, String valor){
        String sql = "UPDATE " + tabela + " SET " + campo + "='" + valor + "' WHERE nome='" + nome + "' AND sobrenome='"+sobrenome+"' AND ordem='"+ordem+"' AND qualificacao='"+qualificacao+"' AND ativo = 'S'";
        Statement stmt = null;
        
        try{
        stmt = connection.createStatement();
        stmt.execute(sql);
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
        
    }
    
    public static void pesquisaAutores (Connection connection, String determinado){
        ArrayList<Autores> lista = new ArrayList<Autores>();
        Autores autor = new Autores();
        int verificador = 0;
        int i = 0;
        ResultSet result;
        String sql_fetch = "SELECT * FROM autores WHERE ativo='S'";
        try{
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql_fetch);        
        while(result.next()){
           autor.nome = result.getString(2);
           autor.sobrenome = result.getString(3);
           autor.ordem = result.getString(4);
           autor.qualificacao = result.getString(5);
           
           if (determinado.equals(autor.nome) || determinado.equals(autor.sobrenome) || determinado.equals(autor.ordem) || determinado.equals(autor.qualificacao) ){
               lista.add(new Autores(autor.nome, autor.sobrenome, autor.ordem, autor.qualificacao));
               i++;
           }
        }
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());  
        }
                
    }
    
    public static void pesquisaAcervo (Connection connection, String determinado){
        ArrayList<Obras> lista = new ArrayList<Obras>();
        Obras obra = new Obras();
        int verificador = 0;
        int i = 0;
        ResultSet result;
        String sql_fetch = "SELECT * FROM acervo WHERE ativo='S'";
        try{
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql_fetch);        
        while(result.next()){
           obra.idCampi = result.getInt(2);
           obra.nome = result.getString(3);
           obra.tipo = result.getString(4);
           obra.local = result.getString(5);
           obra.ano = result.getString(6);
           obra.editora = result.getString(7);
           obra.paginas = result.getString(8);
           
           if (determinado.equals(obra.idCampi) || determinado.equals(obra.nome) || determinado.equals(obra.tipo) || determinado.equals(obra.local) || determinado.equals(obra.ano) || determinado.equals(obra.editora) || determinado.equals(obra.paginas) ){
               lista.add(new Obras(obra.idCampi, obra.nome, obra.tipo, obra.local, obra.ano, obra.editora, obra.paginas));
               i++;
           }
        }
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());  
        }
    }
    
    public ObservableList pesquisaCampi(Connection connection) throws SQLException{
        ObservableList nomes = FXCollections.observableArrayList();
        ResultSet result;
        String sql_fetch = "SELECT nome FROM campi WHERE ativo='S'";
        try{
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql_fetch);
        while(result.next()){
        nomes.add(result.getString("nome"));
        }
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());  
        }
        
        return nomes;
    }
    
    public ObservableList pesquisaPartes(Connection connection, int id) throws SQLException{
        ObservableList nomes = FXCollections.observableArrayList();
        ResultSet result;
        String sql_fetch = "SELECT * FROM partes WHERE ativo='S' AND id="+id;
        try{
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql_fetch);
        while(result.next()){
        nomes.add(result.getString("titulo"));
        }
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());  
        }
        
        return nomes;
    }
    
    public int pegaIdCampi(Connection connection, String campus) throws SQLException{
        int id = 0;
        ResultSet result;
        String sql_fetch = "SELECT id FROM campi WHERE ativo='S' AND nome='" + campus + "'";
        try{
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql_fetch);
        result.next();
        id = result.getInt("id");
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());  
        }
        return id;
    }
    
    public int pegaIdParte(Connection connection, String parte){
        int id = 0;
        ResultSet result;
        String sql_fetch = "SELECT id FROM partes WHERE ativo='S' AND titulo='" + parte + "'";
        try{
        Statement fetch = connection.createStatement();
        result = fetch.executeQuery(sql_fetch);
        result.next();
        id = result.getInt("id");
        }catch(SQLException e){
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());  
        }
        return id;
        
    }
    
    public ObservableList<AcervoTabela> montaListaAcervo(Connection connection, String determinado) throws SQLException{      
        listaAcervo = FXCollections.observableArrayList();
        //int idProfDisc = pegaIdProfDisciplina(pegaIdDisciplina(disciplina), pegaIdTurma(turma));

        String sql = "SELECT * FROM acervo WHERE nome = '" + determinado + "' AND ativo = 'S'";
        
        PreparedStatement declaracao = connection.prepareStatement(sql);
       
        // declaracao.setInt(1, idProfDisc);
        
        ResultSet rs = declaracao.executeQuery();
        
        //String comm = "SELECT * FROM campi WHERE id = '" + rs.getInt("idCampi") + "' AND ativo = 'S'";
        //        PreparedStatement declara = connection.prepareStatement(comm);
        //        ResultSet result = declara.executeQuery();
        String comm;
        PreparedStatement declara;
        ResultSet result;
        
            
        while(rs.next()){
            comm = "SELECT * FROM campi WHERE id = '" + rs.getInt("idCampi") + "' AND ativo = 'S'";
            declara = connection.prepareStatement(comm);
            result = declara.executeQuery();
            result.next();
            listaAcervo.add(new AcervoTabela(result.getString("nome"), rs.getString("nome"), rs.getString("tipo"), rs.getString("local"), rs.getString("ano"), rs.getString("editora"), rs.getString("paginas"), rs.getInt("id")));
        }
        
        return listaAcervo;
    }
    
    public ObservableList<AutoresTabela> montaListaAutores(Connection connection, String determinado) throws SQLException{      
        listaAutores = FXCollections.observableArrayList();
        //int idProfDisc = pegaIdProfDisciplina(pegaIdDisciplina(disciplina), pegaIdTurma(turma));

        String sql = "SELECT * FROM autores WHERE nome = '" + determinado + "' AND ativo = 'S'";
        
        PreparedStatement declaracao = connection.prepareStatement(sql);
        // declaracao.setInt(1, idProfDisc);
        
        ResultSet rs = declaracao.executeQuery();
        while(rs.next()){
            listaAutores.add(new AutoresTabela(rs.getString("nome"), rs.getString("sobrenome"), rs.getString("ordem"), rs.getString("qualificacao")));
        }
        
        return listaAutores;
    }
        
    public static void main(String[] args) throws SQLException{
        launch(args);
        
        /*
        try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        }catch (ClassNotFoundException e) {
            System.out.println("Driver não encontrado!"+e);
        }
        System.out.println("Driver encontrado com sucesso!");
        
        Connection connection = null;
        connection = DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        if (connection != null){
            System.out.println("Conexão realizada com sucesso");
        }else{
            System.out.println("Não foi possível realizar a conexão");
        }
         
        Periodicos periodicos = new Periodicos ("Semanal","Outubro",2, "Magazine", 1678, 2, "4",  "periodicos",  "5",  "6",  "7",  "60");
        
        Partes[] testes = new Partes[3];
        int tam = 3;
        
        testes[0] = new Partes("Parte 1", 1, 20, "keywords");
        testes[1] = new Partes("Parte 2", 21, 40, "keywords");
        testes[2] = new Partes("Parte 3", 41, 60, "keywords");
        Autores autores = new Autores("John", "Friedrich", "Escritor", "Graduado"); 
        Autores autoresnovo = new Autores("K.", "J.", "John", "Doutora"); 
        
        System.out.println("\n\n");
        //inserePartes(connection, testes, periodicos, tam);
        //insereAutores(connection, autores);
        //insereAutores(connection, autoresnovo);
        //insereLivro(connection, testes);
        //insereLivro(connection, testes);
        //System.out.println("\n Insere 1 \n");
        remove(connection, 9, "periodicos");
        System.out.println("\n Remove 2 \n");
        //altera(connection, 2, "acervo", "nome", "EMOCIONADO");
        //System.out.println("\n Altera 3 \n");
        //pesquisaAutores(connection, "Kleber");
        //pesquisaAcervo(connection, "80");
        //System.out.println("\n Pesquisa 4 \n");
        */

    }
}
