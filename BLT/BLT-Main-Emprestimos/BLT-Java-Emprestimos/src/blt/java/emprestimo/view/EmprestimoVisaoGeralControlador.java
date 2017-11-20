package blt.java.emprestimo.view;

import javafx.fxml.FXML;
import java.sql.SQLException;
import java.util.List;
import blt.java.emprestimo.ManutencaoEmprestimos;
import blt.java.emprestimo.jdbc.EmprestimoDao;
import blt.java.emprestimo.model.Emprestimo;
import blt.java.emprestimo.model.Reserva;
import blt.java.emprestimo.util.DataUtil;
import java.text.ParseException;
import javafx.scene.control.Alert;


public class EmprestimoVisaoGeralControlador {

    // Referencia à aplicação principal.
    private ManutencaoEmprestimos mainApp;
    EmprestimoDao bd = new EmprestimoDao(); //Conexão com o bd.
    
  
    public EmprestimoVisaoGeralControlador() {
    }

    /**
     * Chamado quando o usuário clica no botão novo. Abre uma janela para editar
     * detalhes de um novo empréstimo.
     * @throws SQLException
     */
    @FXML
    private void botaoNovoEmprestimo() throws ParseException  {
        Emprestimo tempEmprestimo = new Emprestimo();
        Reserva tempReserva = new Reserva();
        String dataPrevisaoDevolucaoNovo = null;
        
        boolean okClicked = mainApp.mostrarEmprestimoCaixaEditar(tempEmprestimo);
        
        if (okClicked) {
            if(bd.existeEmprestimo(tempEmprestimo)){
                   tempReserva.setIdAluno(tempEmprestimo.getIdAluno());
                   tempReserva.setIdAcervo(tempEmprestimo.getIdAcervo());
                if(bd.existeReservaAdicionar(tempReserva)){
                   
                   tempReserva.setDataReserva(DataUtil.adicionaXDias(tempReserva.getDataReserva(), 8));
                   tempReserva.setTempoEspera(7L);
                   bd.adicionaReserva(tempReserva);
                   
                }else{
                    
                    tempReserva.setDataReserva(DataUtil.adicionaXDias(tempEmprestimo.getDataPrevisaoDevolucao(), 1));            
                    tempReserva.setTempoEspera(7L);
                    bd.adicionaReserva(tempReserva);
                
            }
            } else {
                bd.adicionaEmprestimo(tempEmprestimo);
            }
            
        }
    }

    /**
     * Chamado quando o usuário clica no botão remover. Abre a janela para pesquisar o id
     * do aluno que realizou empréstimo.
     */
    @FXML
    private void botaoDeletarEmprestimo() throws ParseException {
    	Emprestimo tempEmprestimo = new Emprestimo();
        Emprestimo tempEmprestimo2 = new Emprestimo();
        Reserva tempReserva = new Reserva();
    	boolean existeEmprestimo = false;
        
        boolean okClicked = mainApp.mostrarEmprestimoPesquisar(tempEmprestimo2);
        if(okClicked){

    	List<Emprestimo> emprestimos = bd.getLista();


		for (Emprestimo emprestimo : emprestimos) {
			if(tempEmprestimo2.getIdAcervo() == emprestimo.getIdAcervo() ){
				tempEmprestimo = emprestimo;
                                existeEmprestimo = true;
			}
		}
                
                //Verifica se a data de devolução é maior que a de previsao
                if(DataUtil.parse(tempEmprestimo2.getDataDevolucao()).toEpochDay() < DataUtil.parse(tempEmprestimo.getDataPrevisaoDevolucao()).toEpochDay()){
                    Alert alert = new Alert(Alert.AlertType.ERROR);
                      alert.setTitle("Data de devolução Inválida");
                      alert.setHeaderText("A data de entrega não pode ser anterior ao prazo de devolução!");
                      alert.setContentText("Por favor, visualize os empréstimos existentes e tente novamente.");
                      alert.showAndWait();
                }else{ 
                
                //Verifica se o empréstimo existe
                if(existeEmprestimo){
                        tempEmprestimo.setDataDevolucao(tempEmprestimo2.getDataDevolucao());
                        tempEmprestimo.setMulta(DataUtil.calculaDiferencaDias(DataUtil.parse(tempEmprestimo2.getDataDevolucao()), DataUtil.parse(tempEmprestimo.getDataPrevisaoDevolucao())));
			
                        //Remove o emprestimo e caso haja multa atualiza as reservas
                        bd.remove(tempEmprestimo);
                        tempReserva.setIdAcervo(tempEmprestimo.getIdAcervo());
                        bd.atualizaReservas(tempEmprestimo.getMulta(), tempEmprestimo.getIdAcervo());
                        
                        //Verifica se há reservas para o empréstimo devolvido e caso haja coloca a menos recente nos empréstimos
                        if(bd.existeReservaRemover(tempReserva)){
                            tempEmprestimo.setDataEmprestimo(tempReserva.getDataReserva());
                            tempEmprestimo.setDataPrevisaoDevolucao(DataUtil.adicionaXDias(tempReserva.getDataReserva(), 7));
                            bd.emprestaReserva(tempReserva);
                            tempEmprestimo.setIdAluno(tempReserva.getIdAluno());
                            bd.adicionaEmprestimo(tempEmprestimo);
                        }
                         
                }else{
                     Alert alert = new Alert(Alert.AlertType.ERROR);
                      alert.setTitle("Id do acervo Inválido");
                      alert.setHeaderText("Empréstimo não encontrado!");
                      alert.setContentText("Por favor, visualize os empréstimos existentes e tente novamente.");
                      alert.showAndWait();
                }
                }
        }

    }

    @FXML
    private void botaoVisualizarEmprestimo()  {
        
        mainApp.mostrarEmprestimoVisualizar();

    }

    /**
     * É chamado pela aplicação principal para dar uma referência de volta a si mesmo.
     *
     * @param mainApp
     */
    public void setMainApp(ManutencaoEmprestimos mainApp) {
        this.mainApp = mainApp;

    }
}