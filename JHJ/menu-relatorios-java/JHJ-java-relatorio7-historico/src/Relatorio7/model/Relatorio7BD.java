package Relatorio7.model;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class Relatorio7BD {
    private Connection conn;
    private String[] dadosCampus;
    private String sql;
    private PreparedStatement stmt;
    private String[][] notasAluno;
    private String nomeCurso;
    private String[] dadosAluno;
    
    public String[][] getNotasAluno(String cpf) throws SQLException{
        conn = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
        sql = "SELECT idDisciplina, id, ano FROM matriculas WHERE idAluno = '"+cpf+"' ORDER BY matriculas.ano";
        Statement leitura = conn.createStatement();
        ResultSet resultado = leitura.executeQuery(sql);

        double frequencia = 0;
        int faltas = 0;
        double nota = 0;
        int numLinhas=0;
        
        while(resultado.next()){
            numLinhas++;
        }
        
        notasAluno = new String[numLinhas][6];
        int auxiliar=0;

        if(resultado.first()){
            do{
                notasAluno[auxiliar][0]=resultado.getString("idDisciplina");
                notasAluno[auxiliar][1]=resultado.getString("id");
                notasAluno[auxiliar][2]=resultado.getString("ano");
                auxiliar++;
            }while(resultado.next());
            
            resultado.close();

            for(auxiliar=0; auxiliar<numLinhas; auxiliar++){
                sql = "SELECT nome, cargaHorariaMin, idTurma FROM disciplinas WHERE id = '"+notasAluno[auxiliar][0]+"'";
                resultado = leitura.executeQuery(sql);
                resultado.next();

                notasAluno[auxiliar][0]=resultado.getString("nome");
                notasAluno[auxiliar][3]=resultado.getString("cargaHorariaMin");
                notasAluno[auxiliar][5]=resultado.getString("idTurma");

                resultado.close();
            }
            
            for(auxiliar=0; auxiliar<numLinhas; auxiliar++){
                sql = "SELECT serie FROM turmas WHERE id = '"+notasAluno[auxiliar][5]+"'";
                resultado = leitura.executeQuery(sql);
                resultado.next();

                notasAluno[auxiliar][5]=resultado.getString("serie");

                resultado.close();
            }
            
            for(auxiliar=0; auxiliar<numLinhas; auxiliar++){
                sql = "SELECT nota, faltas FROM diarios WHERE idMatricula = '"+notasAluno[auxiliar][1]+"'";
                resultado = leitura.executeQuery(sql);
                while(resultado.next()){
                    nota += Double.parseDouble(resultado.getString("nota"));
                    faltas += Double.parseDouble(resultado.getString("faltas"));
                }
                frequencia = ((faltas*50*100)/(Double.parseDouble(notasAluno[auxiliar][3])*60));
                frequencia = (double)Math.round(frequencia*100)/100;
                frequencia = 100 - frequencia;
                notasAluno[auxiliar][1]=String.valueOf(nota);
                notasAluno[auxiliar][4]=String.valueOf(frequencia);
                nota=0;
                faltas=0;
                resultado.close();
            }
            
            conn.close();
            return notasAluno;
        }
        return null;
    }
    
    public String getCurso(String cpf) throws SQLException{
        conn = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
        sql = "SELECT idTurma FROM alunos WHERE idCPF = '"+cpf+"'";
        Statement leitura = conn.createStatement();
        ResultSet resultado = leitura.executeQuery(sql);
        resultado.next();
        String auxiliar = resultado.getString("idTurma");
        resultado.close();
        
        sql = "SELECT idCurso FROM turmas WHERE id = '"+auxiliar+"'";
        leitura = conn.createStatement();
        resultado = leitura.executeQuery(sql);
        resultado.next();
        auxiliar = resultado.getString("idCurso");
        resultado.close();
        
        sql = "SELECT nome FROM cursos WHERE id = '"+auxiliar+"'";
        leitura = conn.createStatement();
        resultado = leitura.executeQuery(sql);
        resultado.next();
        nomeCurso = resultado.getString("nome");
        resultado.close();
        
        resultado.close();
        conn.close();
        return nomeCurso;
    }
    
    public String[] getDadosAluno(String cpf) throws SQLException{
        conn = DriverManager.getConnection("jdbc:mysql://localhost/educatio?autoReconnect=true&useSSL=false", "root", "");
        sql = "SELECT nome, sexo, nascimento FROM alunos WHERE idCPF = '"+cpf+"'";
        Statement leitura = conn.createStatement();
        ResultSet resultado = leitura.executeQuery(sql);
        resultado.next();
        
        dadosAluno=new String[3];
        dadosAluno[0]=resultado.getString("nome");
        dadosAluno[1]=resultado.getString("sexo");
        dadosAluno[2]=resultado.getString("nascimento");
                
        resultado.close();
        conn.close();
        return dadosAluno;
    }
}