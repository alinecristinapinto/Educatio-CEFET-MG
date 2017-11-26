package relatorio8.model;

import java.util.ArrayList;

public class Relatorio8Aluno {
	private String nome;
	private String nomeCurso;
	private String modalidadeCurso;
	private String coordenadorCurso;
	private int menorAnoMatriculado;
	private int maiorAnoMatriculado;
	
	//Variaveis usadas no teste de emissao de certificado
	private ArrayList idConteudoAluno = new ArrayList();
	private ArrayList idMatriculaAluno = new ArrayList();
	private ArrayList notaConteudoAluno = new ArrayList();

	
	public String getNome() {
		return nome;
	}
	public String getNomeCurso() {
		return nomeCurso;
	}
	public String getModalidadeCurso() {
		return modalidadeCurso;
	}
	public String getCoordenadorCurso() {
		return coordenadorCurso;
	}
	public int getMenorAnoMatriculado() {
		return menorAnoMatriculado;
	}
	public int getMaiorAnoMatriculado() {
		return maiorAnoMatriculado;
	}
	
	public void setNome(String nome) {
		this.nome = nome;
	}
	public void setNomeCurso(String nomeCurso) {
		this.nomeCurso = nomeCurso;
	}
	public void setModalidadeCurso(String modalidadeCurso) {
		this.modalidadeCurso = modalidadeCurso;
	}
	public void setCoordenadorCurso(String coordenadorCurso) {
		this.coordenadorCurso = coordenadorCurso;
	}
	public void setMenorAnoMatriculado(int menorAnoMatriculado) {
		this.menorAnoMatriculado = menorAnoMatriculado;
	}
	public void setMaiorAnoMatriculado(int maiorAnoMatriculado) {
		this.maiorAnoMatriculado = maiorAnoMatriculado;
	}
	
	//Variaveis teste emissao
	
	public ArrayList getIdConteudoAluno() {
		return idConteudoAluno;
	}
	public void setIdConteudoAluno(int idConteudoAluno) {
		this.idConteudoAluno.add(idConteudoAluno);
	}
	public ArrayList getIdMatriculaAluno() {
		return idMatriculaAluno;
	}
	public void setIdMatriculaAluno(ArrayList idMatriculaAluno) {
		this.idMatriculaAluno = idMatriculaAluno;
	}
	public ArrayList getNotaConteudoAluno() {
		return notaConteudoAluno;
	}
	public void setNotaConteudoAluno(ArrayList notaConteudoAluno) {
		this.notaConteudoAluno = notaConteudoAluno;
	}
	
	//Variaveis teste emissao
	
	
	
	
}
