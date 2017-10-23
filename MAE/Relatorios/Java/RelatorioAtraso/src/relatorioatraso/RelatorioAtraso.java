package relatorioatraso;

import java.sql.SQLException;
import java.util.Scanner;

public class RelatorioAtraso {

    public static void main(String[] args) throws SQLException {
        BancoDeDados bancoDeDados = new BancoDeDados();
        Scanner usuario = new Scanner(System.in);
        System.out.println("Digite o id: ");
        int id = usuario.nextInt();
        bancoDeDados.selecionaRegistros(id);
    }   
}