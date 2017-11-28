package selecaonotas;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Properties;
import javax.swing.JOptionPane;

public class SelecaoNotas{
    
    public static void main(String[] args) throws SQLException, Exception {
        try{
            //Carrega o driver especificado
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e){
            System.out.println("Driver nao encontrado!"+e);
        }
        
        //estabelecendo conexao com BD
        Connection connection = null;
        connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/educatio?useSSL=true","root","");
        
        if(connection==null){
            System.out.println("Status-------->Erro ao conectar!");
            System.exit(0);
        }
        
        //variaveis para executar comandos sql relativos ao BD
        Statement executaComando1, executaComando2, executaComando3, executaComando4, executaComando5;
        
        //variaveis para receber dados do BD
        ResultSet ResultadoSQL1, ResultadoSQL2, ResultadoSQL3=null, ResultadoSQL4, ResultadoSQL5;
        
        String nomeAluno;
        //CPF do aluno
        String cpf = "";
        int idMatricula = 0;
        int idDisciplina = 0;
        String nomeDisciplina;
        String idEtapa = "";
        //Armazena as etapas onde o aluno tem um conteudo vinculado
        ArrayList etapasDisponiveis = new ArrayList();
        //ValorEtapa vai ser double porque eh um valor (necessario comparar)
        double valorEtapa;
        int idConteudo;
        //Nota atividade conteudo vai ser double porque e necessario somar
        double notaAtividadeConteudo = 0;
        double notaConteudo = 0;
        double notaEtapa = 0;
        ArrayList faltas = new ArrayList();
        int falta = 0;
        int faltaConteudo = 0;
        int faltaEtapa = 0;
        
        
        String stringTemporario1 = "";
        
        int idTurma = 0;
        String nomeTurma = "";
        int idCurso = 0;
        String nomeCurso = "";
        int idDepto = 0;
        String modalidadeCursoAluno = "";
        String idCampi = "";
        String nomeCampi = "";
        String anoSelecionado = "";
        String anoTeste = "";
        String anosDisciplinas = "";
        
        //Variaveis de dados para tabela
        //Foi optado usar string ao inves de array list pela dificuldade de acesso em uma matriz  dinamica de array list
        //Essa string armazena disciplinas e notas
        String disciplinasNotasTabela = "";
        //Essa armazena as etapas - bimestres
        String etapasTabela = "";
        //Esse for e realizado para que tenha 30 espacos no canto superior esquerdo
        //Nao ha como alterar para o for melhorado
        for(int i = 0; i < 30; i++){
            etapasTabela += " ";
        }
         etapasTabela += "x";
        //"                            x"
        
        try{
            executaComando1 = connection.createStatement();
            executaComando2 = connection.createStatement();
            executaComando3 = connection.createStatement();
            executaComando4 = connection.createStatement();
            executaComando5 = connection.createStatement();
            
            EntradaNomeAluno entrarAluno = new EntradaNomeAluno();
            
            int metodoSelecionarAluno = Integer.parseInt(JOptionPane.showInputDialog(null, "Deseja entrar com \n1-nome ou \n2-CPF?"));
            switch(metodoSelecionarAluno){
                case 1:
                    entrarAluno.metodoBuscaNome();
                    break;
                case 2:
                    entrarAluno.metodoBuscaCpf();
                    break;
                default:
                    entrarAluno.metodoBuscaNome();
                    break;
            }
            
            nomeAluno = entrarAluno.getNomeAluno();
            cpf = entrarAluno.getCpfAluno();
            
            ResultadoSQL1 = executaComando1.executeQuery("SELECT idTurma FROM alunos WHERE idCPF = '" + cpf + "' AND ativo='"+"S"+"'");                   
            if(ResultadoSQL1.next()){
                idTurma = ResultadoSQL1.getInt("idTurma");
                
            }
            
            ResultadoSQL1 = executaComando1.executeQuery("SELECT idCurso, nome FROM turmas WHERE id = '" + idTurma + "' AND ativo='"+"S"+"'");                   
            if(ResultadoSQL1.next()){
                idCurso = ResultadoSQL1.getInt("idCurso");
                nomeTurma = ResultadoSQL1.getString("nome");
                
            }
            
            ResultadoSQL1 = executaComando1.executeQuery("SELECT nome, idDepto, modalidade FROM cursos WHERE id = '" + idCurso + "' AND ativo='"+"S"+"'");                   
            if(ResultadoSQL1.next()){
                nomeCurso = ResultadoSQL1.getString("nome");
                idDepto = ResultadoSQL1.getInt("idDepto");
                modalidadeCursoAluno = ResultadoSQL1.getString("modalidade");
            }
            
            ResultadoSQL1 = executaComando1.executeQuery("SELECT idCampi FROM deptos WHERE id ='"+idDepto+"'AND ativo = '"+"S"+"'");
            if(ResultadoSQL1.next()){
                idCampi = ResultadoSQL1.getString("idCampi");
            }
            
            ResultadoSQL1 = executaComando1.executeQuery("SELECT nome FROM campi WHERE id ='"+idCampi+"' AND ativo = '"+"S"+"'");
            if(ResultadoSQL1.next()){
                nomeCampi = ResultadoSQL1.getString("nome");
            }
            
            //Selecionando todas as disciplinas em que o aluno esta matriculado
            //Se o aluno nao estiver matriculado em nenhuma disciplina, nao sera exibido o relatorio
            
            
            System.out.print("\nAnos disponiveis para as disciplinas do aluno: ");
            ResultadoSQL1 = executaComando1.executeQuery("SELECT ano FROM matriculas WHERE idAluno ='"+cpf+"'AND ativo = '"+"S"+"'");
            if(ResultadoSQL1.next()){
                anosDisciplinas = ResultadoSQL1.getString("ano");
                System.out.println("Ano das disciplinas: "+anosDisciplinas);
            }
            
            
            
            anoSelecionado = JOptionPane.showInputDialog(null, "Deseja ver a notas de qual ano?");
            ResultadoSQL1 = executaComando1.executeQuery("SELECT idDisciplina FROM matriculas WHERE idAluno = '"+cpf+"' AND ativo='"+"S"+"' AND ano = '"+anoSelecionado+"'");
            while(!ResultadoSQL1.next()){
                anoTeste = JOptionPane.showInputDialog(null,"Ano nao disponivel! Digite outro ano");
                ResultadoSQL1 = executaComando1.executeQuery("SELECT idDisciplina FROM matriculas WHERE idAluno = '"+cpf+"' AND ativo='"+"S"+"' AND ano = '"+anoTeste+"'");
            } 
            
            ResultadoSQL1 = executaComando1.executeQuery("SELECT idDisciplina FROM matriculas WHERE idAluno = '"+cpf+"' AND ativo='"+"S"+"' AND ano = '"+anoSelecionado+"'");
            while(ResultadoSQL1.next()){
                
                idDisciplina = ResultadoSQL1.getInt("idDisciplina");
                
                //Selecionar as etapas disponiveis
                ResultadoSQL2 = executaComando2.executeQuery("SELECT idEtapa FROM conteudos WHERE idDisciplina='" + idDisciplina + "' AND ativo='"+"S"+"'");
                while(ResultadoSQL2.next()){
                    int etapaDisponivel = ResultadoSQL2.getInt("idEtapa");
                    if(!etapasDisponiveis.contains(etapaDisponivel)){
                        etapasDisponiveis.add(etapaDisponivel);
                    }
                }  
            }
            
            ResultadoSQL1 = executaComando1.executeQuery("SELECT id,  idDisciplina FROM matriculas WHERE idAluno = '"+cpf+"' AND ativo='"+"S"+"' AND ano = '"+anoSelecionado+"'");
            while(ResultadoSQL1.next()){
                
                idDisciplina = ResultadoSQL1.getInt("idDisciplina");
                idMatricula = ResultadoSQL1.getInt("id");
               
                    
                ResultadoSQL2 = executaComando2.executeQuery("SELECT nome FROM disciplinas WHERE id = '"+idDisciplina+"' ");
                if(ResultadoSQL2.next()){
                    //A seguinte String serve para avaliar se aquela disciplina ja foi contada
                    String nomeDisciplinaAvaliar = ResultadoSQL2.getString("nome");
                    if(!disciplinasNotasTabela.contains(nomeDisciplinaAvaliar)){
                        
                        nomeDisciplina  = ResultadoSQL2.getString("nome");
                        int intTemporario1 = nomeDisciplina.length();
                        for(int r=0; r< 30-intTemporario1; r++){
                            nomeDisciplina+=" ";
                        }
                        disciplinasNotasTabela += nomeDisciplina+"x";
                        //Seleciona cada uma das etapas
                        
                        for(Object etapaDisponivel: etapasDisponiveis){
                            
                            
                            ResultadoSQL3 = executaComando3.executeQuery("SELECT valor FROM etapas WHERE ativo='"+"S"+"' AND idOrdem = '"+etapaDisponivel+"'");
                            while(ResultadoSQL3.next()){

                                idEtapa  =  ""+etapaDisponivel;
                                valorEtapa = ResultadoSQL3.getDouble("valor");

                                if(!etapasTabela.contains(""+ idEtapa+"")){
                                    etapasTabela += "Etapa "+ idEtapa+"x";
                                }

                                //Selecionando cada conteudo da disciplina da etapa que o while selecionou
                                ResultadoSQL4 = executaComando4.executeQuery("SELECT id FROM conteudos WHERE idEtapa LIKE '%" + idEtapa + "%'AND idDisciplina='" + idDisciplina + "' AND ativo='"+"S"+"'");
                                while(ResultadoSQL4.next()){//estrutura de repeticao aqui, p cada materia;tudo a seguir entra aqui

                                    idConteudo  = ResultadoSQL4.getInt("id");
                                    //Para cada conteudo, somar as notas de suas atividades, para obter a nota do conteudo
                                    //Nao importa em qual atividade ele tirou aquela nota, nao pode tirar mais do que o valor da atividade
                                    //Se houver duas atividades do mesmo conteudo, entao serao somadas pois sao procuradas pelo id do conteudo
                                    ResultadoSQL5 = executaComando5.executeQuery("SELECT idAtividade, nota, faltas FROM diarios WHERE idConteudo = '"+idConteudo+"' AND idMatricula = '" + idMatricula+"' AND ativo='"+"S"+"'");
                                    while(ResultadoSQL5.next()){

                                        notaAtividadeConteudo  = ResultadoSQL5.getDouble("nota");
                                        notaConteudo += notaAtividadeConteudo;
                                        faltaConteudo += Integer.parseInt(ResultadoSQL5.getString("faltas"));
                                    }

                                    notaEtapa += notaConteudo;
                                    faltaEtapa += faltaConteudo;
                                    if(notaEtapa > valorEtapa){
                                        notaEtapa = valorEtapa;
                                    }
                                    
                                    
                                    faltaConteudo = 0;
                                    //reseta o contador pois a proxima iteracao sera um novo conteudo
                                    notaConteudo = 0;
                                }//fim conteudo

                                faltas.add(faltaEtapa + "");
                                stringTemporario1 += ""+notaEtapa;

                                int intTemporario2 = stringTemporario1.length();

                                for(int intTemporario3 = 0; intTemporario3< 7-intTemporario2; intTemporario3++){
                                    stringTemporario1 += " ";
                                }
                                disciplinasNotasTabela += stringTemporario1 + "x";

                                //reseta para a proxima iteracao
                                stringTemporario1 = "";
                                //reseta o contador pois a proxima iteracao sera uma nova etapa
                                notaEtapa = 0;
                                faltaEtapa = 0;
                            }//fim etapa
                        }//fim for etapas
                        etapasTabela += "\n";
                        disciplinasNotasTabela += "\n";
                    }//FIM nome da disciplina
                }//fim disciplina
            }//fim da selecao por ano da disciplina
            
            ArrayList dadosAluno = new ArrayList();
            dadosAluno.add("Nome: "); 
            dadosAluno.add(nomeAluno);
            dadosAluno.add("CPF: "); 
            dadosAluno.add(cpf);
            dadosAluno.add("Ano letivo: "); 
            dadosAluno.add(anoSelecionado);
            dadosAluno.add("Curso: "); 
            dadosAluno.add(nomeCurso);
            dadosAluno.add("Modalidade: "); 
            dadosAluno.add(modalidadeCursoAluno);
            dadosAluno.add("Turma: "); 
            dadosAluno.add(nomeTurma);
            dadosAluno.add("Campus: "); 
            dadosAluno.add(nomeCampi);
            
            
            InsercaoMatrizString tabela = new InsercaoMatrizString(disciplinasNotasTabela, etapasTabela, dadosAluno, faltas);
            int resposta = Integer.parseInt(JOptionPane.showInputDialog(null, "Deseja: \n1-exibir na tela  \n2-ou imprimir"));
            switch (resposta){
                    case 1:
                        tabela.metodoExibicao();
                        break;
                        
                    case 2:
                        tabela.metodoImpressao();
                        break;
                        
                    default:
                        tabela.metodoExibicao();
                        break;
                        
            }//FIM SWITCH
            
        }//FIM TRY
        catch(SQLException ex){
            System.out.println("SQLExeption: "+ ex.getMessage());
            System.out.println("SQLState: "+ ex.getSQLState());
            System.out.println("VendorError : "+ ex.getErrorCode());
        }//FIM CATCH
    }//FIM MAIN
}//FIM CLASSE
    

