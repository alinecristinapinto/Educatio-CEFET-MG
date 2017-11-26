package relatorio8.bd;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import com.sun.corba.se.impl.presentation.rmi.IDLTypesUtil;
import java.util.stream.*;

import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import relatorio8.model.*;

public class Relatorio8Dao {

    private Connection conexao;
    private ResultSet result;
    private String sql;
    private String CPF;
    private PreparedStatement stmt;
    Relatorio8Aluno aluno = new Relatorio8Aluno();

	public Relatorio8Dao (String CPF){
    	this.conexao = new CriaConexao().getConexao();
    	this.CPF = CPF;

	}

	public Relatorio8Aluno getAluno(String CPF) throws SQLException{
		this.conexao = new CriaConexao().getConexao();
    	//Idturma e nome
    	int idTurmaAluno = 0;
    	String nome = null;

    	sql = "SELECT idTurma, nome FROM alunos WHERE idCPF = '"+CPF+"'";
        stmt = conexao.prepareStatement(sql);
        result = stmt.executeQuery();
        while(result.next()){
              idTurmaAluno = result.getInt("idTurma");
              nome = result.getString("nome");
        }
        aluno.setNome(nome);


        //IdCurso
        int idCurso = 0;

    	sql = "SELECT idCurso FROM turmas WHERE id = '"+idTurmaAluno+"'";
        stmt = conexao.prepareStatement(sql);
        result = stmt.executeQuery();
        while(result.next()){
              idCurso = result.getInt("idCurso");
        }

        //Nome e Modalidade curso
        int idDepto = 0;
    	String nomeCurso = null;
    	String modalidadeCurso = null;

    	sql = "SELECT idDepto, nome, modalidade FROM cursos WHERE id ='"+idCurso+"'";
        stmt = conexao.prepareStatement(sql);
        result = stmt.executeQuery();
        while(result.next()){
              idDepto = result.getInt("idDepto");
              nomeCurso = result.getString("nome");
              modalidadeCurso = result.getString("modalidade");
        }
        aluno.setNomeCurso(nomeCurso);
        aluno.setModalidadeCurso(modalidadeCurso);

        //Nome Coodenador curso
        String nomeCoordenador = null;

    	sql = "SELECT nome FROM funcionario WHERE idDepto ='"+idDepto+"' AND hierarquia = 'Coordenador'";
        stmt = conexao.prepareStatement(sql);
        result = stmt.executeQuery();
        while(result.next()){
              nomeCoordenador = result.getString("nome");
        }
        aluno.setCoordenadorCurso(nomeCoordenador);
        //Anos Matriculado
		ArrayList anosMatriculado = new ArrayList();

    	sql = "SELECT ano FROM matriculas WHERE idAluno ='"+CPF+"'";
        stmt = conexao.prepareStatement(sql);
        result = stmt.executeQuery();
        while(result.next()){
              anosMatriculado.add(result.getInt("ano"));
        }
        int maior = (Integer) anosMatriculado.get(0);
        int menor = (Integer) anosMatriculado.get(0);
        for (int i = 0 ; i<anosMatriculado.size() ; i++ ){
        	if ((Integer) anosMatriculado.get(i) > maior)
        		maior = (Integer) anosMatriculado.get(i);
        	if ((Integer) anosMatriculado.get(i) < menor)
        		menor = (Integer) anosMatriculado.get(i);
        }
        aluno.setMaiorAnoMatriculado(maior);
        aluno.setMenorAnoMatriculado(menor);

        return aluno;
	}

	public boolean testaRelatorio() throws SQLException{
		//Objeto aluno em que serao feitos os testes de verificacao
		Relatorio8Aluno alunoteste = new Relatorio8Aluno();
		this.conexao = new CriaConexao().getConexao();
    	//Idturma
    	int idTurmaAluno = 0;
    	sql = "SELECT idTurma FROM alunos WHERE idCPF = '"+CPF+"'";
        stmt = conexao.prepareStatement(sql);
        result = stmt.executeQuery();
        while(result.next()){
              idTurmaAluno = result.getInt("idTurma");
        }

        //IdCurso
        int idCurso = 0;
    	sql = "SELECT idCurso FROM turmas WHERE id = '"+idTurmaAluno+"'";
        stmt = conexao.prepareStatement(sql);
        result = stmt.executeQuery();
        while(result.next()){
              idCurso = result.getInt("idCurso");
        }

        //Modalidade
    	String modalidadeCurso = null;
    	sql = "SELECT  modalidade FROM cursos WHERE id ='"+idCurso+"'";
        stmt = conexao.prepareStatement(sql);
        result = stmt.executeQuery();
        while(result.next()){
              modalidadeCurso = result.getString("modalidade");
        }

        if (modalidadeCurso.equals("Técnico Integrado")){
        	//Aluno Técnico
        	//Verificar se está  no 3 ano
        	//Serie da turma
        	int serieTurma = 0;
        	sql = "SELECT serie FROM turmas WHERE id ='"+idTurmaAluno+"'";
            stmt = conexao.prepareStatement(sql);
            result = stmt.executeQuery();
            while(result.next()){
                  serieTurma = result.getInt("serie");
            }
            if(serieTurma!=3){
            	return false;
            }else {
            	//Verifica SE tem 60 OU MAIS em TODAS disciplinas

            	//Anos Matriculado
            	ArrayList anosMatriculado = new ArrayList();
            	sql = "SELECT ano FROM matriculas WHERE idAluno ='"+CPF+"'";
                stmt = conexao.prepareStatement(sql);
                result = stmt.executeQuery();
                while(result.next()){
                      anosMatriculado.add(result.getInt("ano"));
                }
                int maior = (Integer) anosMatriculado.get(0);
                for (int i = 0 ; i<anosMatriculado.size() ; i++ ){
                	if ((Integer) anosMatriculado.get(i) > maior)
                		maior = (Integer) anosMatriculado.get(i);
                }

                //ArrayList com id todas disciplinas pela matricula usando idAluno e Ano
                ArrayList idDisciplinas = new ArrayList();
            	sql = "SELECT idDisciplina FROM matriculas WHERE idAluno ='"+CPF+"' AND ano ='"+maior+"'";
                stmt = conexao.prepareStatement(sql);
                result = stmt.executeQuery();
                while(result.next()){
                      idDisciplinas.add(result.getInt("idDisciplina"));
                }

                //Improvisando Matriz e dando um valor maximo pq eu nao sei mais como fazer isso
                //Matriz associa id Disciplina com ids dos conteudos
                int i = 0;
                int j = 0;
                //For que pega quantos conteudos e guarda numa variavel
                int qtdeConteudos = 0;
                for (i = 0 ; i<idDisciplinas.size() ; i++){
                	sql = "SELECT id FROM conteudos WHERE idDisciplina ='"+idDisciplinas.get(i)+"'";
                    stmt = conexao.prepareStatement(sql);
                    result = stmt.executeQuery();
                    while(result.next()){
                          qtdeConteudos++;
                    }
                }

                int idConteudoAluno[][] = new int[qtdeConteudos][qtdeConteudos];
  //              ArrayList idConteudoAluno = new ArrayList();
                //For que salva os idConteudos em uma matriz
                for (i = 0 ; i<idDisciplinas.size() ; i++){
                	sql = "SELECT id FROM conteudos WHERE idDisciplina ='"+idDisciplinas.get(i)+"'";
                    stmt = conexao.prepareStatement(sql);
                    result = stmt.executeQuery();
                    while(result.next()){
                        idConteudoAluno[i][j]=result.getInt("id");
                          j++;
                    }
                    //System.out.println("i = "+i);

                }



                // IdMatricula do aluno
                ArrayList idMatricula = new ArrayList();
            	sql = "SELECT id FROM matriculas WHERE idAluno = '"+CPF+"' AND ano ='"+maior+"'";
                stmt = conexao.prepareStatement(sql);
                result = stmt.executeQuery();
                while(result.next()){
                      idMatricula.add(result.getInt("id"));
                }

                //Matriz a ser usada posteiormente
                i=0 ; j = 0; int k = 0;
                double notaConteudoAluno[][] = new double[qtdeConteudos][qtdeConteudos];
                for (i=0 ; i<idDisciplinas.size() ; i++){
                        for(j=0 ; j <idConteudoAluno.length ; j++){
               	//		System.out.println("i = "+i+"     k = "+k);
                			notaConteudoAluno[i][j] = 0;
                		}

                }

                // matriz que associa id Disciplina com notas dos conteudos
                i = 0; j =0; k =0; int z = 0;
                for (i=0 ; i < idDisciplinas.size() ; i++){
                		for(j=0 ; j <idConteudoAluno.length ; j++){
                			int aux = idConteudoAluno[i][k];

                			for(z = 0; z < idMatricula.size() ; z++){ //pegar a nota independente do id da matricula
                				sql = "SELECT nota FROM diarios WHERE idConteudo = '"+aux+"' AND idMatricula ='"+idMatricula.get(z)+"' "
                					+ "AND ano = '"+maior+"'";
                                stmt = conexao.prepareStatement(sql);
                                result = stmt.executeQuery();
                                while(result.next()){
                                      notaConteudoAluno[i][k] = result.getInt("nota");
                                }
                			}
                			k++;
                		}

                }
                // Somando NOTAS dos conteudos de cada material e pegar nota total
                i = 0;
                ArrayList notaTotal = new ArrayList();
                for ( i = 0; i< idDisciplinas.size() ; i++){
                	for(j = 0; j<idConteudoAluno.length ; j++){
                		int soma = (int) DoubleStream.of(notaConteudoAluno[i][j]).sum();
                		notaTotal.add(soma);
                	}

                }

                //TESTAR
                /*System.out.println(maior);
                System.out.println("Matriculas = "+ idMatricula);
                System.out.println("Disciplinas = "+ idDisciplinas);
                System.out.println("Conteudo = "+idConteudoAluno[0][0]);
                System.out.println("Nota por conteudo  = "+ notaConteudoAluno[0][0]);
                System.out.println("Nota total por disciplina = "+notaTotal+"\n\n\n");;*/


                i = 0;
                int flagNotaInsuficiente = 0;
                for ( i = 0; i< idDisciplinas.size() ; i++){
                	if (notaTotal!=null){
                		if ((Integer)notaTotal.get(i)<60){
                			flagNotaInsuficiente++;
                		}

                	}else
                		System.out.println("Nota total deu null");
                }

                if ( flagNotaInsuficiente != 0 ){
                	//Aluno nao esta com 60 ou mais em todas disciplinas
                        System.out.println("\n\n\n\n Nota menor que 60!!!");
                	return false;
                } else if (flagNotaInsuficiente == 0){
                	//  NOTA = OK
                	//Verifica Frequencia

                	i = 0 ;
                	int faltaTotal = 0;
                	int qtdeTotalAulas = 0;
                	for (i = 0; i < idMatricula.size() ; i ++){ //Pegar faltas
                		sql = "SELECT faltas FROM diarios WHERE idMatricula = '"+idMatricula.get(i)+"' AND ano ='"+maior+"'";
                        stmt = conexao.prepareStatement(sql);
                        result = stmt.executeQuery();
                        while(result.next()){
                              faltaTotal += result.getInt("faltas");
                              qtdeTotalAulas++;
                        }
                	}
                	// Dois horarios
                	qtdeTotalAulas = qtdeTotalAulas * 2;
                	int frequenciaAluno = faltaTotal / qtdeTotalAulas;

                	if (frequenciaAluno > 0.25){
                		//Bomba falta global
                		return false;
                	} if (frequenciaAluno <=0.25){
                		//Faltou menos que 25%
				    	//verifica se as matriculas do ano estao desativadas para ter certeza que passou de ano

                		i = 0;
                		int matriculasAtivas = 0;
                		for ( i = 0; i < idMatricula.size() ; i++){ //Pegar faltas independente do idmatricula
                			sql = "SELECT ativo FROM matriculas WHERE id = '"+idMatricula.get(i)+"'";
                            stmt = conexao.prepareStatement(sql);
                            result = stmt.executeQuery();
                            while(result.next()){
                                  if (result.getString("Ativo")=="S"){
                                	  matriculasAtivas++;
                                  }
                            }
                		}
                		if(matriculasAtivas!=0){
                			System.out.println("Matriculas ativas foi dif de zero");
                			return false;
                		}else if( matriculasAtivas==0){
                			return true;
                		}
                	}
                }
            }//else
        }else//If Tecnico
        	if (modalidadeCurso.equals("Graduacao")){
            	//Aluno Graduacao
            	//Verificar se esta  no 10 periodo
            	//Serie da turma
            	int serieTurma = 0;
            	sql = "SELECT serie FROM turmas WHERE id ='"+idTurmaAluno+"'";
                stmt = conexao.prepareStatement(sql);
                result = stmt.executeQuery();
                while(result.next()){
                      serieTurma = result.getInt("serie");
                }
                if(serieTurma!=3){
                	return false;
                }else {
                	//Verifica SE tem 70 OU MAIS em TODAS disciplinas

                	//Anos Matriculado
                	ArrayList anosMatriculado = new ArrayList();
                	sql = "SELECT ano FROM matriculas WHERE idAluno ='"+CPF+"'";
                    stmt = conexao.prepareStatement(sql);
                    result = stmt.executeQuery();
                    while(result.next()){
                          anosMatriculado.add(result.getInt("ano"));
                    }
                    int maior = (Integer) anosMatriculado.get(0);
                    for (int i = 0 ; i<anosMatriculado.size() ; i++ ){
                    	if ((Integer) anosMatriculado.get(i) > maior)
                    		maior = (Integer) anosMatriculado.get(i);
                    }

                    //ArrayList com id todas disciplinas pela matricula usando idAluno e Ano
                    ArrayList idDisciplinas = new ArrayList();
                	sql = "SELECT idDisciplina FROM matriculas WHERE idAluno ='"+CPF+"' AND ano ='"+maior+"'";
                    stmt = conexao.prepareStatement(sql);
                    result = stmt.executeQuery();
                    while(result.next()){
                          idDisciplinas.add(result.getInt("idDisciplina"));
                    }

                    //Improvisando Matriz e dando um valor maximo pq eu nao sei mais como fazer isso
                    //Matriz associa id Disciplina com ids dos conteudos
                    int i = 0;
                    int j = 0;

                  //For que pega quantos conteudos e guarda numa variavel
                    int qtdeConteudos = 0;
                    for (i = 0 ; i<idDisciplinas.size() ; i++){
                    	sql = "SELECT id FROM conteudos WHERE idDisciplina ='"+idDisciplinas.get(i)+"'";
                        stmt = conexao.prepareStatement(sql);
                        result = stmt.executeQuery();
                        while(result.next()){
                              qtdeConteudos++;
                        }
                    }

                    int idConteudoAluno[][] = new int[qtdeConteudos][qtdeConteudos];
                    for (i = 0 ; i<idDisciplinas.size() ; i++){


                    	sql = "SELECT id FROM conteudos WHERE idDisciplina ='"+idDisciplinas.get(i)+"'";
                        stmt = conexao.prepareStatement(sql);
                        result = stmt.executeQuery();

                        while(result.next()){
                              idConteudoAluno[i][j]=result.getInt("id");
                              j++;
                        }
                    }

                    // IdMatricula do aluno
                    ArrayList idMatricula = new ArrayList();
                	sql = "SELECT id FROM matriculas WHERE idAluno = '"+CPF+"' AND ano ='"+maior+"'";
                    stmt = conexao.prepareStatement(sql);
                    result = stmt.executeQuery();
                    while(result.next()){
                          idMatricula.add(result.getInt("id"));
                    }

                    //Matriz a ser usada posteiormente
                    i=0 ; j = 0; int k = 0;
                    double notaConteudoAluno[][] = new double[qtdeConteudos][qtdeConteudos];
                    for (i=0 ; i<idDisciplinas.size() ; i++){
                    		for(j=0 ; j <idConteudoAluno.length ; j++){
                    			notaConteudoAluno[i][j] = 0;
                    			k++;
                    		}
                    }

                    // matriz que associa id Disciplina com notas dos conteudos
                    i = 0; j =0; k =0; int z = 0;
                    for (i=0 ; i < idDisciplinas.size() ; i++){
                    		for(j=0 ; j <idConteudoAluno.length ; j++){
                    			int aux = idConteudoAluno[i][k];

                    			for(z = 0; z < idMatricula.size() ; z++){ //pegar a nota independente do id da matricula
                    				sql = "SELECT nota FROM diarios WHERE idConteudo = '"+aux+"' AND idMatricula ='"+idMatricula.get(z)+"' "
                    					+ "AND ano = '"+maior+"'";
                                    stmt = conexao.prepareStatement(sql);
                                    result = stmt.executeQuery();
                                    while(result.next()){
                                          notaConteudoAluno[i][k] = result.getInt("nota");
                                    }
                    			}
                    			k++;
                    		}
                    }
                    // Somando NOTAS dos conteudos de cada material e pegar nota total
                    i = 0;
                    ArrayList notaTotal = new ArrayList();
                    for ( i = 0; i< idDisciplinas.size() ; i++){
                    	for (j =0; j<notaConteudoAluno.length ; j++){
                    		int soma = (int) DoubleStream.of(notaConteudoAluno[i][j]).sum();
                    		notaTotal.add(soma);
                    		}
                    }

                    //TESTAR
                 //   System.out.println(maior);
                //    System.out.println("Matriculas = "+ idMatricula);
                 //   System.out.println("Disciplinas = "+ idDisciplinas);
                 //   System.out.println("Conteudo = "+idConteudoAluno[0][0]);
                //    System.out.println("Nota por conteudo  = "+ notaConteudoAluno[0][0]);
                //    System.out.println("Nota total por disciplina = "+notaTotal+"\n\n\n");


                    i = 0;
                    int flagNotaInsuficiente = 0;
                    for ( i = 0; i< idDisciplinas.size() ; i++){
                    	if (notaTotal!=null){
                    		if ((Integer)notaTotal.get(i)<70){
                    			flagNotaInsuficiente++;
                    		}

                    	}else
                    		System.out.println("Nota total deu null");
                    }

                    if ( flagNotaInsuficiente != 0 ){
                    	//Aluno nao esta com 60 ou mais em todas disciplinas
                        System.out.println("\n\n\n\n NOTA MENOR Q 60");
                                return false;
                    } else if (flagNotaInsuficiente == 0){
                    	//  NOTA = OK
                    	//Verifica Frequencia

                    	i = 0 ;
                    	int faltaTotal = 0;
                    	int qtdeTotalAulas = 0;
                    	for (i = 0; i < idMatricula.size() ; i ++){ //Pegar faltas
                    		sql = "SELECT faltas FROM diarios WHERE idMatricula = '"+idMatricula.get(i)+"' AND ano ='"+maior+"'";
                            stmt = conexao.prepareStatement(sql);
                            result = stmt.executeQuery();
                            while(result.next()){
                                  faltaTotal += result.getInt("faltas");
                                  qtdeTotalAulas++;
                            }
                    	}
                    	// Dois horarios
                    	qtdeTotalAulas = qtdeTotalAulas * 2;
                    	int frequenciaAluno = faltaTotal / qtdeTotalAulas;

                    	if (frequenciaAluno > 0.25){
                    		//Bomba falta global
                    		return false;
                    	} if (frequenciaAluno <=0.25){
                    		//Faltou menos que 25%
    				    	//verifica se as matriculas do ano estao desativadas para ter certeza que passou de ano

                    		i = 0;
                    		int matriculasAtivas = 0;
                    		for ( i = 0; i < idMatricula.size() ; i++){ //Pegar faltas independente do idmatricula
                    			sql = "SELECT ativo FROM matriculas WHERE id = '"+idMatricula.get(i)+"'";
                                stmt = conexao.prepareStatement(sql);
                                result = stmt.executeQuery();
                                while(result.next()){
                                      if (result.getString("Ativo")=="S"){
                                    	  matriculasAtivas++;
                                      }
                                }
                    		}
                    		if(matriculasAtivas!=0){
                    			System.out.println("Matriculas ativas foi dif de zero");
                    			return false;
                    		}else if( matriculasAtivas==0){
                    			return true;
                    		}

                    	}
                    }




                }//else


            }//If Graduacao




		return true;
	}

}

























