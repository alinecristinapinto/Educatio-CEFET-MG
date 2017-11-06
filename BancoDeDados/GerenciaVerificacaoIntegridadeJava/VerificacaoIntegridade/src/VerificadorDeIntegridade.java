import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class VerificadorDeIntegridade 
{
    static ManipulaBD manipulaBD;
    private static final String [] arrayTabelas = {
                                    "campi", "deptos", "cursos", "turmas" , 
                                    "alunos", "matriculas", "funcionario", "disciplinas", 
                                    "profDisciplinas", "etapas", "atividades", "conteudos", 
                                    "diarios", "acervo", "livros", "academicos", 
                                    "midias", "periodicos", "partes", "autorAcervo", 
                                    "autores", "reservas", "emprestimos", "descartes"
                                };
    private static final String [] arrayNomesTabelas = {
                                    "Campus", "Departamento", "Curso", "Turmas" , 
                                    "Aluno", "Matrícula", "Funcionário", "Disciplina", 
                                    "ProfDisciplina", "Etapa", "Atividade", "Conteúdo", 
                                    "Diário", "Obra", "Livro", "Acadêmico", 
                                    "Midia", "Periódico", "Parte", "AutorAcervo", 
                                    "Autor", "Reserva", "Empréstimo", "Descarte"
                                };
    boolean houveErro;
    String relatorioErros = "";
    
    
    public void confereIntegridade () throws ClassNotFoundException, SQLException 
    {
        manipulaBD = new ManipulaBD();
        manipulaBD.conexaoServidor("3307", "educatio", "root", "usbw");
        houveErro = false;
        
        conferidorDeIntegridade(0, 1, "idCampi");
	//Conferindo integridade de Departamentos (1)
	conferidorDeIntegridade(1,2,"idDepto");
	//Conferindo integridade de Cursos (2)
	conferidorDeIntegridade(2,3,"idCurso");
	//Conferindo integridade de Turmas (3)
	conferidorDeIntegridade(3,4,"idTurma");
	//Conferindo integridade de Alunos (4)
	conferidorDeIntegridade(4,5,"idAluno");
	
	//Conferindo integridade de Matrículas (5)
	conferidorDeIntegridade(5,12,"idMatricula");
	
	//Conferindo integridade de Professores (funcionario.hierarquia="Professor") (6)
	conferidorDeIntegridade(6,8,"idProfessor");
	//Conferindo integridade de Bibliotecários (funcionario.hierarquia="Bibliotecario") (6)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(6,23,"idFuncionario");
	//Conferindo integridade de Disciplinas (7)
	conferidorDeIntegridade(7,5,"idDisciplina");
        conferidorDeIntegridade(7,8,"idDisciplina");
	conferidorDeIntegridade(7,11,"idDisciplina");
	//Conferindo integridade de ProfDiscplinas (8)
	conferidorDeIntegridade(8,10,"idProfDisciplina");
	//Conferindo integridade de Etapas (9)
	conferidorDeIntegridade(9,11,"idEtapa");
	//Conferindo integridade de Atividades (10)
	conferidorDeIntegridade(10,12,"idAtividade");
	//Conferindo integridade de Conteúdos (11)
	conferidorDeIntegridade(11,12,"idConteudo");
	//Conferindo integridade de Diários (12)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(12,5,"idTurma");
	
	//Conferindo integridade de Acervo (13)
	conferidorDeIntegridade(13,19,"idAcervo");
	//Conferindo integridade de Livros (14)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(14,12,'idMatricula');
	//Conferindo integridade de Acadêmicos (15)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(15,12,'idMatricula');
	//Conferindo integridade de Mídias (16)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(16,12,'idMatricula');
	//Conferindo integridade de Periódicos (17)
	conferidorDeIntegridade(17,18,"idPeriodico");
	//Conferindo integridade de Partes (18)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(18,12,'idMatricula');
	//Conferindo integridade de AutorAcervo (19)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(19,12,'idMatricula');
	//Conferindo integridade de Autores (20)
	conferidorDeIntegridade(20,19,"idAutor");
	//Conferindo integridade de Reservas (21)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(21,12,'idMatricula');
	//Conferindo integridade de Empréstimos (22)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(22,12,'idMatricula');
	//Conferindo integridade de Descartes (23)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(23,12,'idMatricula');
        return;
    }
    
    public void conferidorDeIntegridade(int tabelaMae, int tabelaFilho, String idReferencia) throws SQLException 
    {
        ResultSet resultado;
        Statement statement = manipulaBD.conexao.createStatement();
        // SQL
        PreparedStatement preparedStatement = manipulaBD.conexao.prepareStatement ( "SELECT * FROM " + arrayTabelas[tabelaMae] + " WHERE ativo = 'S'" );
        resultado = preparedStatement.executeQuery();
        
        
        resultado.last();
        if (resultado.getRow() > 0) 
        {
            resultado.first();
            while (resultado.next()) 
            {
                Statement statementFilho = manipulaBD.conexao.createStatement();
                PreparedStatement preparedStatementFilho = 
                        manipulaBD.conexao.prepareStatement(
                                "SELECT * FROM " + arrayTabelas[tabelaFilho] + " WHERE ativo = 'S' AND " + idReferencia + " = ?"
                        );
                Object id = resultado.getObject(1);
                preparedStatementFilho.setObject(1, id);
                
                ResultSet resultadoFilho = preparedStatementFilho.executeQuery();
                resultadoFilho.last();
                if (resultadoFilho.getRow() == 0)
                {
                    if (!"idAcervo".equals(idReferencia) || ("idAcervo".equals(idReferencia) && !"Periódico".equals(resultado.getString(4))))
                    {
                        houveErro = true;
                        relatorioErros += arrayNomesTabelas[tabelaMae] + " com id = " + resultado.getObject(1) + " não possui nenhum(a) " + arrayNomesTabelas[tabelaFilho] + "\n";
                    }
                }
                resultadoFilho.next();
            }
        }
        
        if (houveErro)
            relatorioErros += "\n";
        
    }
   
    public String retornaErros ()
    {
        return relatorioErros;
    }
}