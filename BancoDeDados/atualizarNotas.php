<?php
###############################################################################################
    header("Content-type: text/html; charset=utf-8");
    ini_set('max_execution_time', 0); 

    date_default_timezone_set('America/Sao_Paulo');
###############################################################################################
    $servername = "localhost";
    $username = "root";
    $password = "usbw";
    $bd = "educatio";
    $con = new mysqli($servername, $username, $password, $bd);
    
    mysqli_set_charset($con, "utf8");
    
    // TESTANDO A CONEXÃO
    if ($con->connect_error) 
    {
        die("Conexão falhou: " . $con->connect_error);
    }
    
    echo "<b>".'Conexão bem sucedida.'."</b><br>";

###############################################################################################

    function confereDiario()
    {
        global $con;

        $intContaMaterias = 0;
        $intContaAprovacoes = 0;
        $intContaConteudos = 0;
        $intContaFaltas = 0;
        $doublePresencaAluno = 0.0;

        //Seleciona os alunos
        $stmt = $con->prepare("SELECT * FROM cursos WHERE modalidade = ? AND ativo = ?");
        $stmt->bind_param('ss', $modalidade, $ativo);

        $modalidade = 'Técnico Integrado';
        $ativo = 'S';

        $stmt->execute();
        $rstCursos = $stmt->get_result();

        while($linhaCursos = $rstCursos->fetch_assoc()) 
        {
            $stmt = $con->prepare("SELECT * FROM turmas WHERE idCurso = ? AND ativo = ?");
            $stmt->bind_param('is',$idCurso, $ativo);
            
            $idCurso = $linhaCursos['id'];
            $ativo = 'S';

            $stmt->execute();
            $rstTurmas = $stmt->get_result();

            while ($linhaTurmas = $rstTurmas->fetch_assoc()) {

                $stmt = $con->prepare("SELECT * FROM alunos WHERE idTurma = ? AND ativo = ?");
                $stmt->bind_param('is',$idTurma, $ativo);

                $idTurma = $linhaTurmas['id'];
                $ativo = 'S';

                $stmt->execute();
                $rstAlunos = $stmt->get_result();

                while ($linhaAlunos = $rstAlunos->fetch_assoc()) 
                {
                    echo "<br><b>".$linhaAlunos['nome']."</b>";

                    $intVetorMatriculas = array();
                    $intContadorRep = 0;
                    $doubleSomadorNota = 0.0;

                    $doublePresencaAluno = 0;
                    $intContaMaterias = 0;
                    $intContaAprovacoes = 0;
                    $intContaFaltas = 0;
                    $intContaConteudos = 0;

                    $stringAno = date("Y");

                    $stmt = $con->prepare("SELECT * FROM matriculas WHERE idAluno = ? AND ano = ? AND ativo = ?");
                    $stmt->bind_param('sss',$idAluno, $ano, $ativo);
                    
                    $idAluno = $linhaAlunos['idCPF'];
                    $ano = $stringAno;
                    $ativo = 'S';

                    $stmt->execute();
                    $rstMatriculas = $stmt->get_result();

                    while ($linhaMatriculas = $rstMatriculas->fetch_assoc()) 
                    {
                        $doubleSomadorNota = 0.0;
                        $doublePresencaAluno = 0;
                        $intContaFaltas = 0;
                        $intContaConteudos = 0;

                        $stmt = $con->prepare("SELECT * FROM conteudos WHERE idDisciplina = ? AND ativo = ?");
                        $stmt->bind_param('is', $idDisciplina, $ativo);

                        $idDisciplina = $linhaMatriculas['idDisciplina'];
                        $ativo = 'S';

                        $stmt->execute();
                        $rstConteudos = $stmt->get_result();

                        while ($linhaConteudos = $rstConteudos->fetch_assoc()) 
                        {
                            //Olha diarios
                            $stmt = $con->prepare("SELECT * FROM diarios WHERE idConteudo = ? AND idMatricula = ? AND ativo = ?");
                            $stmt->bind_param('iis', $idConteudo, $idMatricula, $ativo);

                            $idConteudo = $linhaConteudos['id'];
                            $idMatricula = $linhaMatriculas['id'];
                            $ativo = 'S';

                            $stmt->execute();
                            $rstDiarios = $stmt->get_result();

                            while ($linhaDiarios = $rstDiarios->fetch_assoc()) 
                            {
                                $doubleSomadorNota = $doubleSomadorNota + $linhaDiarios['nota'];
                                $intContaFaltas = $intContaFaltas + $linhaDiarios['faltas'];
                            }
                            $intContaConteudos += 2;
                        }

                        $doublePresencaAluno = $intContaFaltas / $intContaConteudos;

                        if ($doubleSomadorNota >= 60 && $doublePresencaAluno <= 0.25) 
                        {
                            $intContaAprovacoes++;
                            echo "<br>".'Aprovação - 1 disciplina';
                        } 
                        else if ($intContadorRep < 3) 
                        {
                            $intVetorMatriculas[$intContadorRep] = $linhaMatriculas['id'];
                            $intContadorRep++;
                            echo "<br>".'Recuperação - 1 disciplina';
                        }

                        $intContaMaterias++;
                    }

                    if($intContaMaterias == $intContaAprovacoes) 
                    {
                        aprovacaoAluno($linhaAlunos['idCPF'],'T');
                    } 
                    else if((($intContaMaterias - $intContaAprovacoes) <= 3) && (($intContaMaterias - $intContaAprovacoes) > 0)) 
                    {
                        echo "<br>".'Recuperação';
                        recuperacaoAluno($linhaAlunos['idCPF'], $intVetorMatriculas, $intContadorRep);
                    }
                    else if(($intContaMaterias - $intContaAprovacoes) > 3)
                    {
                        echo "<br>".'Bomba';
                        reprovaAluno($linhaAlunos['idCPF'],'T');
                    }
                }
            }
        }
    }

    function confereDiarioFinal()
    {
        global $con;

        $intContaMaterias = 0;
        $intContaAprovacoes = 0;
        $intContaConteudos = 0;
        $intContaFaltas = 0;
        $doublePresencaAluno = 0.0;

        $stmt = $con->prepare("SELECT * FROM cursos WHERE modalidade = ? AND ativo = ?");
        $stmt->bind_param('ss', $modalidade, $ativo);

        $modalidade = 'Técnico Integrado';
        $ativo = 'S';

        $stmt->execute();
        $rstCursos = $stmt->get_result();

        while($linhaCursos = $rstCursos->fetch_assoc()) 
        {
            $stmt = $con->prepare("SELECT * FROM turmas WHERE idCurso = ? AND ativo = ?");
            $stmt->bind_param('is', $idCurso, $ativo);

            $idCurso = $linhaCursos['id'];
            $ativo = 'S';

            $stmt->execute();
            $rstTurmas = $stmt->get_result();

            while($linhaTurmas = $rstTurmas->fetch_assoc()) 
            {
                $stmt = $con->prepare("SELECT * FROM alunos WHERE idTurma = ? AND ativo = ?");
                $stmt->bind_param('is', $idTurma, $ativo);

                $idTurma = $linhaTurmas['id'];
                $ativo = 'S';

                $stmt->execute();
                $rstAlunos = $stmt->get_result();

                while($linhaAlunos = $rstAlunos->fetch_assoc()) 
                {
                    echo "<br><b>".$linhaAlunos['nome']."</b>";

                    $doubleSomadorNota = 0;
                    $intContaMaterias = 0;
                    $intContaAprovacoes = 0;

                    $stmt = $con->prepare("SELECT * FROM matriculas WHERE idAluno = ? AND ativo = ?");
                    $stmt->bind_param('ss', $idAluno, $ativo);

                    $idAluno = $linhaAlunos['idCPF'];
                    $ativo = 'R';

                    $stmt->execute();
                    $rstMatriculas = $stmt->get_result();

                    while($linhaMatriculas = $rstMatriculas->fetch_assoc()) 
                    {
                        $doubleSomadorNota = 0;

                        $stmt = $con->prepare("SELECT * FROM conteudos WHERE idDisciplina = ? AND ativo = ?");
                        $stmt->bind_param('is', $idDisciplina, $ativo);
                        
                        $idDisciplina = $linhaMatriculas['idDisciplina'];
                        $ativo = 'S';

                        $stmt->execute();
                        $rstConteudos = $stmt->get_result();

                        while($linhaConteudos = $rstConteudos->fetch_assoc()) 
                        {
                            //Olha diarios
                            $stmt = $con->prepare("SELECT * FROM diarios WHERE idConteudo = ? AND idMatricula = ? AND ativo = ?");
                            $stmt->bind_param('iis', $idConteudo, $idMatricula, $ativo);
                            
                            $idConteudo = $linhaConteudos['id'];
                            $idMatricula = $linhaMatriculas['id'];
                            $ativo = 'S';

                            $stmt->execute();
                            $rstDiarios = $stmt->get_result();

                            while($linhaDiarios = $rstDiarios->fetch_assoc()) 
                            {
                                $doubleSomadorNota += $linhaDiarios['nota'];
                            }
                            $intContaMaterias++;
                        }

                        if ($doubleSomadorNota >= 60) 
                        {
                            $intContaAprovacoes++;
                            echo "<br>".'Aprovação - 1 disciplina';
                        }
                    }

                    if ($intContaMaterias == $intContaAprovacoes) 
                    {
                        echo "<br>".'Aprovação geral';
                        aprovacaoAluno($linhaAlunos['idCPF'],'T');
                    } 
                    else if ($intContaMaterias > $intContaAprovacoes) 
                    {
                        echo "<br>".'Bomba';
                        reprovaAluno($linhaAlunos['idCPF'],'T');
                    }
                }
            }
        }
    }

    function confereDiarioSuperior()
    {
        global $con;

        $intContaMaterias = 0;
        $intContaAprovacoes = 0;
        $intContaConteudos = 0;
        $intContaFaltas = 0;
        $doublePresencaAluno = 0.0;

        //Seleciona os alunos
        $stmt = $con->prepare("SELECT * FROM cursos WHERE modalidade = ? AND ativo = ?");
        $stmt->bind_param('ss', $modalidade, $ativo);

        $modalidade = 'Graduação';
        $ativo = 'S';

        $stmt->execute();
        $rstCursos = $stmt->get_result();

        while($linhaCursos = $rstCursos->fetch_assoc()) 
        {
            $stmt = $con->prepare("SELECT * FROM turmas WHERE idCurso = ? AND ativo = ?");
            $stmt->bind_param('is',$idCurso, $ativo);
            
            $idCurso = $linhaCursos['id'];
            $ativo = 'S';

            $stmt->execute();
            $rstTurmas = $stmt->get_result();

            while ($linhaTurmas = $rstTurmas->fetch_assoc()) {

                $stmt = $con->prepare("SELECT * FROM alunos WHERE idTurma = ? AND ativo = ?");
                $stmt->bind_param('is',$idTurma, $ativo);

                $idTurma = $linhaTurmas['id'];
                $ativo = 'S';

                $stmt->execute();
                $rstAlunos = $stmt->get_result();

                while ($linhaAlunos = $rstAlunos->fetch_assoc()) 
                {
                    echo "<br><b>".$linhaAlunos['nome']."</b>";

                    $intVetorMatriculas = array();
                    $intContadorRep = 0;
                    $doubleSomadorNota = 0;

                    $doublePresencaAluno = 0;
                    $intContaMaterias = 0;
                    $intContaAprovacoes = 0;
                    $intContaFaltas = 0;
                    $intContaConteudos = 0;

                    $stringAno = date("Y");

                    $stmt = $con->prepare("SELECT * FROM matriculas WHERE idAluno = ? AND ano = ? AND ativo = ?");
                    $stmt->bind_param('sss',$idAluno, $ano, $ativo);
                    
                    $idAluno = $linhaAlunos['idCPF'];
                    $ano = $stringAno;
                    $ativo = 'S';

                    $stmt->execute();
                    $rstMatriculas = $stmt->get_result();

                    while ($linhaMatriculas = $rstMatriculas->fetch_assoc()) 
                    {
                        $doubleSomadorNota = 0;
                        $doublePresencaAluno = 0;
                        $intContaFaltas = 0;
                        $intContaConteudos = 0;

                        $stmt = $con->prepare("SELECT * FROM conteudos WHERE idDisciplina = ? AND ativo = ?");
                        $stmt->bind_param('is', $idDisciplina, $ativo);

                        $idDisciplina = $linhaMatriculas['idDisciplina'];
                        $ativo = 'S';

                        $stmt->execute();
                        $rstConteudos = $stmt->get_result();

                        while ($linhaConteudos = $rstConteudos->fetch_assoc()) 
                        {
                            //Olha diarios
                            $stmt = $con->prepare("SELECT * FROM diarios WHERE idConteudo = ? AND idMatricula = ? AND ativo = ?");
                            $stmt->bind_param('iis', $idConteudo, $idMatricula, $ativo);

                            $idConteudo = $linhaConteudos['id'];
                            $idMatricula = $linhaMatriculas['id'];
                            $ativo = 'S';

                            $stmt->execute();
                            $rstDiarios = $stmt->get_result();

                            while ($linhaDiarios = $rstDiarios->fetch_assoc()) 
                            {
                                $doubleSomadorNota += $linhaDiarios['nota'];
                                $intContaFaltas += $linhaDiarios['faltas'];
                            }
                            $intContaConteudos += 2;
                        }

                        $doublePresencaAluno = $intContaFaltas / $intContaConteudos;

                        if ($doubleSomadorNota >= 70 && $doublePresencaAluno <= 0.25) 
                        {
                            $intContaAprovacoes++;
                            echo "<br>".'Aprovação - 1 disciplina';
                        } 
                        else if ($intContadorRep < 5) 
                        {
                            $intVetorMatriculas[$intContadorRep] = $linhaMatriculas['id'];
                            $intContadorRep++;
                            echo "<br>".'Recuperação - 1 disciplina';
                        }

                        $intContaMaterias++;
                    }

                    if($intContaMaterias == $intContaAprovacoes) 
                    {
                        echo "<br>".'Aprovação geral';
                        aprovacaoAluno($linhaAlunos['idCPF'],'G');
                    } 
                    else if((($intContaMaterias - $intContaAprovacoes) <= 5) && (($intContaMaterias - $intContaAprovacoes) > 0)) 
                    {
                        echo "<br>".'Recuperação final';
                        recuperacaoAluno($linhaAlunos['idCPF'], $intVetorMatriculas, $intContadorRep);
                    }
                    else if(($intContaMaterias - $intContaAprovacoes) > 5)
                    {
                        echo "<br>".'Bomba';
                        reprovaAluno($linhaAlunos['idCPF'],'G');
                    }
                }
            }
        }
    }
    
    function confereDiarioFinalSuperior()
    {
        global $con;

        $intContaMaterias = 0;
        $intContaAprovacoes = 0;
        $intContaConteudos = 0;
        $intContaFaltas = 0;
        $doublePresencaAluno = 0.0;

        $stmt = $con->prepare("SELECT * FROM cursos WHERE modalidade = ? AND ativo = ?");
        $stmt->bind_param('ss', $modalidade, $ativo);

        $modalidade = 'Graduação';
        $ativo = 'S';

        $stmt->execute();
        $rstCursos = $stmt->get_result();

        while($linhaCursos = $rstCursos->fetch_assoc()) 
        {
            $stmt = $con->prepare("SELECT * FROM turmas WHERE idCurso = ? AND ativo = ?");
            $stmt->bind_param('is', $idCurso, $ativo);

            $idCurso = $linhaCursos['id'];
            $ativo = 'S';

            $stmt->execute();
            $rstTurmas = $stmt->get_result();

            while($linhaTurmas = $rstTurmas->fetch_assoc()) 
            {
                $stmt = $con->prepare("SELECT * FROM alunos WHERE idTurma = ? AND ativo = ?");
                $stmt->bind_param('is', $idTurma, $ativo);

                $idTurma = $linhaTurmas['id'];
                $ativo = 'S';

                $stmt->execute();
                $rstAlunos = $stmt->get_result();

                while($linhaAlunos = $rstAlunos->fetch_assoc()) 
                {
                    echo "<br><b>".$linhaAlunos['nome']."</b>";

                    $doubleSomadorNota = 0;
                    $intContaMaterias = 0;
                    $intContaAprovacoes = 0;

                    $stmt = $con->prepare("SELECT * FROM matriculas WHERE idAluno = ? AND ativo = ?");
                    $stmt->bind_param('ss', $idAluno, $ativo);

                    $idAluno = $linhaAlunos['idCPF'];
                    $ativo = 'R';

                    $stmt->execute();
                    $rstMatriculas = $stmt->get_result();

                    while($linhaMatriculas = $rstMatriculas->fetch_assoc()) 
                    {
                        $doubleSomadorNota = 0;

                        $stmt = $con->prepare("SELECT * FROM conteudos WHERE idDisciplina = ? AND ativo = ?");
                        $stmt->bind_param('is', $idDisciplina, $ativo);
                        
                        $idDisciplina = $linhaMatriculas['idDisciplina'];
                        $ativo = 'S';

                        $stmt->execute();
                        $rstConteudos = $stmt->get_result();

                        while($linhaConteudos = $rstConteudos->fetch_assoc()) 
                        {
                            //Olha diarios para contar notas postadas na recuperação
                            $stmt = $con->prepare("SELECT * FROM diarios WHERE idConteudo = ? AND idMatricula = ? AND ativo = ?");
                            $stmt->bind_param('iis', $idConteudo, $idMatricula, $ativo);
                            
                            $idConteudo = $linhaConteudos['id'];
                            $idMatricula = $linhaMatriculas['id'];
                            $ativo = 'S';

                            $stmt->execute();
                            $rstDiarios = $stmt->get_result();

                            while($linhaDiarios = $rstDiarios->fetch_assoc()) 
                            {
                                $doubleSomadorNota += $linhaDiarios['nota'];
                            }
                            $intContaMaterias++;
                        }

                        if ($doubleSomadorNota >= 70) 
                        {
                            echo "<br>".'Aprovação - 1 disciplina';
                            $intContaAprovacoes++;
                        }
                    }

                    if ($intContaMaterias == $intContaAprovacoes) 
                    {
                        echo "<br>".'Aprovação geral';
                        aprovacaoAluno($linhaAlunos['idCPF'],'G');
                    } 
                    else if ($intContaMaterias > $intContaAprovacoes) 
                    {
                        echo "<br>".'Bomba';
                        reprovaAluno($linhaAlunos['idCPF'],'G');
                    }
                }
            }
        }
    }

    function aprovacaoAluno($stringIdCPF, $stringModalidadeCurso)
    {   
        global $con;

        $stmt = $con->prepare("SELECT * FROM alunos WHERE idCPF = ? AND ativo = ?");
        $stmt->bind_param('ss', $idCPF, $ativo);

        $idCPF = $stringIdCPF;
        $ativo = 'S';
            
        $stmt->execute();
        $rstAlunos = $stmt->get_result();
        $linhaAlunos = $rstAlunos->fetch_assoc();

        //
        $stmt = $con->prepare("SELECT * FROM turmas WHERE id = ? AND ativo = ?");
        $stmt->bind_param('is', $id, $ativo);

        $id = $linhaAlunos['idTurma'];
        $ativo = 'S';
            
        $stmt->execute();
        $rstTurmas = $stmt->get_result();
        $linhaTurmas = $rstTurmas->fetch_assoc();

        //
        $stringAno = date("Y");
        
        $stmt = $con->prepare("SELECT * FROM matriculas WHERE idAluno = ? AND ano = ? AND ativo = ?");
        $stmt->bind_param('sss', $idAluno, $ano, $ativo);

        $idAluno = $stringIdCPF;
        $ano = $stringAno;
        $ativo = 'S';
            
        $stmt->execute();
        $rstMatriculas = $stmt->get_result();

        //
        if ($rstMatriculas->num_rows > 0) 
        {
            //imprimeMatriculas(idCPF);
            $stmt = $con->prepare("SELECT * FROM turmas WHERE idCurso = ? AND serie = ? AND ativo = ?");
            $stmt->bind_param('iis', $idCurso, $serie, $ativo);

            $idCurso = $linhaTurmas['idCurso'];
            $serie = $linhaTurmas['serie'] + 1;
            $ativo = 'S';
            
            $stmt->execute();
            $rstTurmasProx = $stmt->get_result();

            //
            if ($linhaTurmasProx = $rstTurmasProx->fetch_assoc()) 
            {
                desmatriculaAluno($stringIdCPF);

                $stmt = $con->prepare("SELECT * FROM disciplinas WHERE idTurma = ? AND ativo = ?");
                $stmt->bind_param('is', $idTurma, $ativo);

                $idTurma = $linhaTurmasProx['id'];
                $ativo = 'S';
            
                $stmt->execute();
                $rstDisciplinasProx = $stmt->get_result();
                
                if($stringModalidadeCurso == 'T')
                {
                    $stringAno++;
                }
                else if($stringModalidadeCurso == 'G')
                {
                    if(conferePar($linhaTurmas['serie']))
                    {
                        $stringAno++;
                    }
                }
                
                while ($linhaDisciplinasProx = $rstDisciplinasProx->fetch_assoc()) 
                {
                    $stmt = $con->prepare("INSERT INTO matriculas (idAluno, idDisciplina, ano, ativo) VALUES (?,?,?,?)");
                    $stmt->bind_param('siss', $idAluno, $idDisciplina, $ano, $ativo);

                    $idAluno = $stringIdCPF;
                    $idDisciplina = $linhaDisciplinasProx['id'];
                    $ano = $stringAno;
                    $ativo = 'S';
            
                    $stmt->execute();
                }

                $stmt = $con->prepare("UPDATE alunos SET idTurma = ? WHERE idCPF = ?");
                $stmt->bind_param('is', $idTurma, $idCPF);

                $idTurma = $linhaTurmasProx['id'];
                $ativo = 'S';
            
                $stmt->execute();

            } 
            else 
            {
                //Else se ele estiver no último ano
                desmatriculaAluno($stringIdCPF);
                echo "<br>".'Último ano';
            }
            //imprimeMatriculas(idCPF);
        } 
        else 
        {
            echo "<br>".'Não possui matrículas';
            //return;
        }
    }

    function desmatriculaAluno($stringIdCPF)
    {
        global $con;

        $stmt = $con->prepare("UPDATE matriculas SET ativo = ? WHERE idAluno = ? AND (ativo = ? OR ativo = ?)");
        $stmt->bind_param('ssss', $ativo, $idCPF, $ativo2, $ativo3);

        $ativo = 'N';
        $idCPF = $stringIdCPF;
        $ativo2 = 'S';
        $ativo2 = 'R';

        $stmt->execute();
    }

    function imprimeMatriculas($stringIdCPF)
    {   
        global $con;

        $stmt = $con->prepare("SELECT * FROM matriculas WHERE idAluno = ? AND ativo = ?");
        $stmt->bind_param('ss', $idAluno, $ativo);

        $idAluno = $stringIdCPF;
        $ativo = 'S';

        $stmt->execute();
        $rstMatriculas = $stmt->get_result();

        while ($linhaMatriculas = $rstMatriculas->fetch_assoc()) 
        {
            echo "<br>".$linhaMatriculas['idAluno'];
            echo "<br>".$linhaMatriculas['ano'];
        }
    }

    function recuperacaoAluno($stringIdCPF, $intVetorMatriculas, $LIMITE)
    {
        global $con;

        for ($i = 0; $i < $LIMITE; $i++) 
        {
            $stmt = $con->prepare("UPDATE matriculas SET ativo = ? WHERE id = ? AND idAluno = ? AND ativo = ?");
            $stmt->bind_param('siss', $ativo, $id, $idAluno, $ativo2);

            $ativo = 'R';
            $id = $intVetorMatriculas[$i];
            $idAluno = $stringIdCPF;
            $ativo2 = 'S';

            $stmt->execute();
        }
    }

    function reprovaAluno($stringIdCPF, $stringModalidadeCurso)
    {
        global $con;

        //Procura turma do Aluno
        $stmt = $con->prepare("SELECT * FROM alunos WHERE idCPF = ? AND ativo = ?");
        $stmt->bind_param('ss', $idCPF, $ativo);

        $idCPF = $stringIdCPF;
        $ativo = 'S';

        $stmt->execute();
        $rstAlunos = $stmt->get_result();
        $linhaAlunos = $rstAlunos->fetch_assoc();
        
        //Acha turma do aluno para checar disciplinas
        $stmt = $con->prepare("SELECT * FROM turmas WHERE id = ? AND ativo = ?");
        $stmt->bind_param('is', $id, $ativo);

        $id = $linhaAlunos['idTurma'];
        $ativo = 'S';

        $stmt->execute();
        $rstTurmas = $stmt->get_result();
        $linhaTurmas = $rstTurmas->fetch_assoc();
        
        //Acha disciplinas da turma do aluno
        $stmt = $con->prepare("SELECT * FROM disciplinas WHERE idTurma =? AND ativo = ?");
        $stmt->bind_param('is', $idTurma, $ativo);

        $idTurma = $linhaTurmas['id'];
        $ativo = 'S';

        $stmt->execute();
        $rstDisciplinasProx = $stmt->get_result();
        
        //Pega ano atual
        $stringAno = date("Y");
        
        //Incrementa ano se for preciso
        if($stringModalidadeCurso == 'T')
        {
            $stringAno++;
        }
        else if($stringModalidadeCurso == 'G')
        {
            if(conferePar($linhaTurmas['serie']))
            {
                $stringAno++;
            }
        }
        
        //Retira as matrículas anteriores do aluno
        desmatriculaAluno($stringIdCPF);
        
        //Faz novas matriculas com base nas disciplinas da turma
        while($linhaDisciplinasProx = $rstDisciplinasProx->fetch_assoc()) 
        {
            $stmt = $con->prepare("INSERT INTO matriculas (idAluno, idDisciplina, ano, ativo) VALUES (?,?,?,?)");
            $stmt->bind_param('siss', $idAluno, $idDisciplina, $ano, $ativo);

            $idAluno = $stringIdCPF;
            $idDisciplina = $linhaDisciplinasProx['id'];
            $ano = $stringAno;
            $ativo = 'S';

            $stmt->execute();
        }  
    }
    
    function conferePar($intNumero)
    {
        if($intNumero % 2 == 0)
        {
            return true;
        }
        else
        {
            return false;
        }    
    }

    confereDiario();
    confereDiarioFinal();
    confereDiarioSuperior();
    confereDiarioFinalSuperior();
?>