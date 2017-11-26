import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.sql.Statement;

public class ConferidoresDeIntegridade 
{
    static ConexaoBD manipulaBD;
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
    String relatorioErrosReverso = "";
    
    
    public void confereIntegridade () throws ClassNotFoundException, SQLException 
    {
        manipulaBD = new ConexaoBD();
        manipulaBD.conexaoServidor("3307", "educatio", "root", "usbw");

        //CONFERINDO A INTEGRIDADE DAS TABELAS DA PARTE DE ACADÊMICOS
    /*
        'Campus', 0
        'Departamento', 1
        'Curso', 2
        'Turmas' , 3
        'Aluno', 4
        'Matricula', 5
        'Funcionario', 6
        'Disciplina', 7
        'ProfDisciplina', 8
        'Etapa', 9
        'Atividade', 10
        'Conteudo', 11
        'Diario', 12
    */

        //Conferindo integridade de Campi (0)
        conferidorDeIntegridade(0,1,"idCampi");

        //Conferindo integridade de Departamentos (1)
        conferidorDeIntegridade(1,2,"idDepto");
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(0,1,"idCampi");

        //Conferindo integridade de Cursos (2)
        conferidorDeIntegridade(2,3,"idCurso");
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(1,2,"idDepto");

        //Conferindo integridade de Turmas (3)
        conferidorDeIntegridade(3,4,"idTurma");
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(2,3,"idCurso");

        //Conferindo integridade de Alunos (4)
        conferidorDeIntegridade(4,5,"idAluno");
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(3,4,"idTurma");

        //Conferindo integridade de Matrículas (5)
        conferidorDeIntegridade(5,12,"idMatricula");
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(4,5,"idAluno");
        conferidorDeIntegridadeReversa(7,5,"idDisciplina");

        //Conferindo integridade de Professores (funcionario.hierarquia='Professor') (6)
        conferidorDeIntegridade(6,8,"idProfessor");
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(1,6,"idDepto");
        //Conferindo integridade de Bibliotecários (funcionario.hierarquia='Bibliotecario') (6)
        //Acredito que não há necessidade
        //conferidorDeIntegridade(6,23,"idFuncionario");
        //Conferindo integridade, agora, reversamente
        //Não é possível

        //Conferindo integridade de Disciplinas (7)
        conferidorDeIntegridade(7,5,"idDisciplina");
        conferidorDeIntegridade(7,8,"idDisciplina");
        conferidorDeIntegridade(7,11,"idDisciplina");
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(3,7,"idTurma");


        //Conferindo integridade de ProfDiscplinas (8)
        conferidorDeIntegridade(8,10,"idProfDisciplina");
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(6,8,"idProfessor");
        conferidorDeIntegridadeReversa(7,8,"idDisciplina");

        //Conferindo integridade de Etapas (9)
        conferidorDeIntegridade(9,11,"idEtapa");
        //Conferindo integridade, agora, reversamente
        //Não é possível

        //Conferindo integridade de Atividades (10)
        conferidorDeIntegridade(10,12,"idAtividade");
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(8,10,"idProfDisciplina");

        //Conferindo integridade de Conteúdos (11)
        conferidorDeIntegridade(11,12,"idConteudo");
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(7,11,"idDisciplina");
        conferidorDeIntegridadeReversa(9,11,"idEtapa");

        //Conferindo integridade de Diários (12)
        //Acredito que não há necessidade
        //conferidorDeIntegridade(12,5,"idTurma");
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(11,12,"idConteudo");
        conferidorDeIntegridadeReversa(5,12,"idMatricula");
        conferidorDeIntegridadeReversa(10,12,"idAtividade");


    //CONFERINDO A INTEGRIDADE DAS TABELAS DA PARTE DE BIBLIOTECA
    /*
        'Obra', 13
        'Livro', 14
        'Acadêmico', 15 
        'Midia', 16
        'Periodico', 17
        'Parte', 18
        'AutorAcervo', 19
        'Autor', 20
        'Reserva', 21
        'Emprestimo', 22
        'Descarte' 23
    */
        //Conferindo integridade de Acervo (13), exceto por Periódico
        conferidorDeIntegridade(13,19,"idAcervo");
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(0,13,"idCampi");

        //Conferindo integridade de Livros (14)
        //Acredito que não há necessidade
        //conferidorDeIntegridade(?);
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(13,14,"idAcervo");

        //Conferindo integridade de Acadêmicos (15)
        //Acredito que não há necessidade
        //conferidorDeIntegridade(?);
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(13,15,"idAcervo");

        //Conferindo integridade de Mídias (16)
        //Acredito que não há necessidade
        //conferidorDeIntegridade(?);
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(13,16,"idAcervo");

        //Conferindo integridade de Periódicos (17)
        conferidorDeIntegridade(17,18,"idPeriodico");
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(13,17,"idAcervo");

        //Conferindo integridade de Partes (18)
        //Acredito que não há necessidade
        //conferidorDeIntegridade(?);
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(17,18,"idPeriodico");

        //Conferindo integridade de AutorAcervo (19)
        //Acredito que não há necessidade
        //conferidorDeIntegridade(?);
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(13,19,"idAcervo");
        conferidorDeIntegridadeReversa(20,19,"idAutor");

        //Conferindo integridade de Autores (20)
        conferidorDeIntegridade(20,19,"idAutor");
        //Conferindo integridade, agora, reversamente
        //Não é possível

        //Conferindo integridade de Reservas (21)
        //Acredito que não há necessidade
        //conferidorDeIntegridade(?);
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(4,21,"idAluno");
        conferidorDeIntegridadeReversa(13,21,"idAcervo");

        //Conferindo integridade de Empréstimos (22)
        //Acredito que não há necessidade
        //conferidorDeIntegridade(?);
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(4,22,"idAluno");
        conferidorDeIntegridadeReversa(13,22,"idAcervo");

        //Conferindo integridade de Descartes (23)
        //Acredito que não há necessidade
        //conferidorDeIntegridade(?);
        //Conferindo integridade, agora, reversamente
        conferidorDeIntegridadeReversa(13,23,"idAcervo");
        conferidorDeIntegridadeReversa(6,23,"idFuncionario");  

        return;
    }
    
    public void conferidorDeIntegridade(int tabelaMae, int tabelaFilho, String idReferencia) throws SQLException 
    {
        houveErro = false;

        ResultSet rstMae;
        Statement stmtMae = manipulaBD.conexao.createStatement();
        // SQL
        PreparedStatement prprdStmtMae = manipulaBD.conexao.prepareStatement ("SELECT * FROM " + arrayTabelas[tabelaMae] + " WHERE ativo = 'S'");
        rstMae = prprdStmtMae.executeQuery();
                
        rstMae.last();
        if(rstMae.getRow() > 0) 
        {
            rstMae.first();
            while(rstMae.next()) 
            {
                Statement stmtFilho = manipulaBD.conexao.createStatement();
                PreparedStatement prprdStmtFilho = manipulaBD.conexao.prepareStatement
                    ("SELECT * FROM " + arrayTabelas[tabelaFilho] + " WHERE ativo = 'S' AND " + idReferencia + " = ?");

                Object id = rstMae.getObject(1);
                prprdStmtFilho.setObject(1, id);
                
                ResultSet rstFilho = prprdStmtFilho.executeQuery();
                
                rstFilho.last();
                if (rstFilho.getRow() == 0)
                {
                    if (!"idAcervo".equals(idReferencia) || ("idAcervo".equals(idReferencia) && !"Periódico".equals(rstMae.getString(4))))
                    {
                        houveErro = true;
                        relatorioErros += arrayNomesTabelas[tabelaMae] + " com id = " + rstMae.getObject(1) + " não possui nenhum(a) " + arrayNomesTabelas[tabelaFilho] + "\n";
                    }
                }
            }
            //rstFilho.next();
        }
        if (houveErro)
        {
            relatorioErros += "\n";   
        }
    }

    public void conferidorDeIntegridadeReversa(int tabelaMae, int tabelaFilho, String idReferencia) throws SQLException
    {
        houveErro = false;
        
        ResultSet rstFilho;
        Statement stmtFilho = manipulaBD.conexao.createStatement();
        
        // SQL
        PreparedStatement prprdStmtFilho = manipulaBD.conexao.prepareStatement("SELECT * FROM " + arrayTabelas[tabelaFilho] + " WHERE ativo = 'S'");
        rstFilho = prprdStmtFilho.executeQuery();
        
        rstFilho.last();
        if(rstFilho.getRow() > 0)
        {
            rstFilho.first();
            while(rstFilho.next())
            {
                Statement stmtMaeMD = manipulaBD.conexao.createStatement();
                PreparedStatement prprdStmtMaeMD = manipulaBD.conexao.prepareStatement ("SELECT * FROM " + arrayTabelas[tabelaMae]);
                ResultSetMetaData rstmd = prprdStmtMaeMD.getMetaData();
                String colunaId = rstmd.getColumnName(1); 
                
                Statement stmtMae = manipulaBD.conexao.createStatement();
                PreparedStatement prprdStmtMae = manipulaBD.conexao.prepareStatement
                    ("SELECT * FROM " + arrayTabelas[tabelaMae] + " WHERE ativo = ? AND " + colunaId + " = ?");

                if(tabelaMae != 13 && tabelaFilho != 23)
                {
                    prprdStmtMae.setObject(1,"S");
                }                    
                else
                {
                    prprdStmtMae.setObject(1,"N");    
                }
                Object id = rstFilho.getObject(idReferencia);
                prprdStmtMae.setObject(2, id);

                ResultSet rstMae = prprdStmtMae.executeQuery();
                
                rstMae.last();
                if(rstMae.getRow() == 0)
                {
                    if(tabelaMae != 13 && tabelaFilho != 23)
                    {
                        relatorioErrosReverso += arrayNomesTabelas[tabelaFilho] + " com id = " + rstFilho.getObject(1) + " não possui " + idReferencia + " conectado a um(a) " + arrayNomesTabelas[tabelaMae] + " ativo(a)."+"\n";  
                        houveErro = true;
                    }
                    else if(tabelaMae == 13 && tabelaFilho == 23)
                    {
                        relatorioErrosReverso += arrayNomesTabelas[tabelaFilho] + " com id = " + rstFilho.getObject(1) + " possui " + idReferencia + " conectado a um(a) " + arrayNomesTabelas[tabelaMae] + " ativo(a)."+"\n";  
                        houveErro = true;
                    }               
                }
                //rstFilho.next();
            }
        }
        if(houveErro == true)
        {
            relatorioErrosReverso += "\n"; 
        }
    }
   
    public String retornaErros ()
    {
        return relatorioErros;
    }
    
    public String retornaErrosReverso ()
    {
        return relatorioErrosReverso;
    }
}