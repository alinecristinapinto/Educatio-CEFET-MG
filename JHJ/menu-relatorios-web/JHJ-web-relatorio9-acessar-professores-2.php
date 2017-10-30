<!DOCTYPE html>
<html>
    <head>
        <title>Acessar professores</title>
        <meta charset="utf-8">
        <link href="css/bootstrap.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/JHJ-web-estilos.css" rel="stylesheet"> 
        <link href="css/JHJ-web-estilos-relatorio9-tabela.css" rel="stylesheet">
        <script type="text/javascript" src="js/JHJ-web-script-relatorio9-tabela.js"></script> 
        <script type="text/javascript" src="js/JHJ-web-script.js"></script>
        
    </head>
    <body>
        <!-- menu coordenador (codigo da gerencia)-->
        <nav role="navigation" class="navbar navbar-default">        
        <div class="navbar-header">
            <button type="button" data-target="#menu" data-toggle="collapse" class="navbar-toggle">                    
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                
            </button>                
                <a href="#" class="navbar-brand"><img src="slogan.png"></a>
        </div>
            
        <div id="menu" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pushpin"></span> Campus</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Alterar Campus</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Adicionar Campus</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Remover Campus</a></li>
                    </ul>
                </li>

                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"></span>  Departamentos</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Adicionar departamentos</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Remover departamentos</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Acessar departamentos</a></li>
                    </ul>
                </li>

                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon  glyphicon-user"></span>  Professores</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Adicionar professores</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Remover professores</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Acessar professores</a></li>
                    </ul>
                </li>

                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span>  Cursos</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Adicionar cursos</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Remover cursos</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Acessar cursos</a></li>
                    </ul>
                </li>

                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book"></span>  Disciplinas</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Adicionar disciplinas</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Remover disciplinas</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Acessar disciplinas</a></li>
                    </ul>
                </li>

                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="   glyphicon glyphicon-pencil"></span>  Alunos</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Adicionar alunos</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Remover alunos</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Acessar alunos</a></li>
                    </ul>
                </li>

                <li><a href="#"><span class="glyphicon glyphicon-folder-open"></span> Registros</a>

                <li><a href="#"><span class="glyphicon glyphicon-transfer"></span> Transferências</a>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="profile" src="padrao.png">  Coordenador (a) <span class="caret"></span>&emsp;</a>

                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="glyphicon glyphicon-user icon-size"></span> - Seu perfil </a></li>
                        <li class="divider"></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> - Sair</a></li>
                    </ul>
                </li>
                </ul>
        </div>
        </nav>        
        <!-- fim do menu coordenador (codigo da gerencia)-->

        <h1>Acessar professores</h1>
        <?php
            // Conectando com o servidor MySQL
            $link = mysqli_connect("localhost", "root", "");
            if (!$link){
            //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
            } else {
            //     echo "Conexao efetuada com sucesso!<br/>";
            }
            //Selecionado BD
            $sql = mysqli_select_db($link, 'Educatio');
            //Pega id e dados do curso que foi selecionado
            $select = $_POST['selectCursoParaAcessarProfessores'];
            foreach($select as $_valor){
                $intIdCurso = $_valor;    
            }
            $query = mysqli_query($link, "SELECT idDepto, nome FROM cursos WHERE id = $intIdCurso");
            $curso = mysqli_fetch_array($query);
            $intIdDeptoCursoSelecionado = $curso['idDepto'];  
            $strNomeCursoSelecionado = $curso['nome'];

            //Pegar nome do departamento
            $query = mysqli_query($link, "SELECT nome FROM deptos WHERE id = $intIdDeptoCursoSelecionado");
            $depto = mysqli_fetch_array($query);
            $strNomeDeptoCursoSelecionado = $depto['nome'];

            //Seleciona id's das turmas do curso por meio id do curso recebido pelo select
            $intExisteTurma = 0;
            $intJ = 0;
            $query = mysqli_query($link, "SELECT id FROM turmas WHERE idCurso = $intIdCurso AND ativo = 'S'");
            while($turmas = mysqli_fetch_array($query)){
                $vetIdTurmas[$intJ] = $turmas['id'];
                $intExisteTurma = 1;
                $intJ++;
            }

            //Seleciona dados das disciplinas por meio dos id's das turmas
            $intExisteDisciplina = 0;
            if ($intExisteTurma == 1){
                $intJ = 0;
                for ($intK = 0; $intK < count($vetIdTurmas); $intK++){
                    $query = mysqli_query($link, " SELECT id, nome, cargaHorariaMin FROM disciplinas WHERE idTurma = $vetIdTurmas[$intK] AND ativo='S' ");
                    while($disciplinas = mysqli_fetch_array($query)){
                        $vetIdDisciplinas[$intJ] = $disciplinas['id'];
                        $vetNomeDisciplinas[$intJ] = $disciplinas['nome'];
                        $vetCargaHorariaMinDisciplinas[$intJ] = $disciplinas['cargaHorariaMin'];
                        $intExisteDisciplina = 1;
                        $intJ++;
                    }
                }
            } else {
                echo "
                <div class='container'>    
                    <div style='margin-top:50px;' class='mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2'>                    
                        <div class='panel panel-info'>
                            <div class='panel-heading'>
                                <div class='panel-title'>Curso de ".$strNomeCursoSelecionado." - ".$strNomeDeptoCursoSelecionado."</div>
                            </div>  
                            <div style='padding-top:20px' class='panel-body'>  
                                <p><strong>O relatório não pode ser exibido!</strong></p>   
                                <p>Não existe nenhuma turma no curso selecionado</p>";
            }

            //seleciona id's dos professores em profdisciplinas por meio dos id's das disciplinas
            $intExisteProfessor = 0;
            if ($intExisteDisciplina == 1){
                $intJ = 0;
                $intAux = 0;
                for ($intK = 0; $intK < count($vetIdDisciplinas); $intK++){
                    $query = mysqli_query($link, " SELECT idProfessor FROM profdisciplinas WHERE idDisciplina = $vetIdDisciplinas[$intK] AND ativo='S' ");
                    while($profdisciplinas = mysqli_fetch_array($query)){
                        //OBS: se o professor der aula para mais de uma disciplina, seu id se repetirá no vetor, tratando isso aqui:
                        $intFlagRepeticao = 0;
                        $vetAuxVerificaRepeticao[$intAux] = $profdisciplinas['idProfessor'];
                        for ($intY = 0; $intY < $intAux; $intY++){
                            if ($vetAuxVerificaRepeticao[$intY] == $profdisciplinas['idProfessor']){
                                $intFlagRepeticao++;
                            }
                        }
                        if ($intFlagRepeticao == 0){
                            $vetIdProfDisciplinas[$intJ] = $profdisciplinas['idProfessor'];
                            $intExisteProfessor = 1;
                            $intJ++;
                        }
                        $intAux++;
                    } //fim do while
                }
            } if ($intExisteDisciplina == 0 && $intExisteTurma == 0) {
                echo "<p>Não existe nenhuma disciplina no curso selecionado</p>";
            } if ($intExisteDisciplina == 0 && $intExisteTurma == 1) {
                echo "
                <div class='container'>    
                    <div style='margin-top:50px;' class='mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2'>                    
                        <div class='panel panel-info'>
                            <div class='panel-heading'>
                                <div class='panel-title'>Curso de ".$strNomeCursoSelecionado." - ".$strNomeDeptoCursoSelecionado."</div>
                            </div>  
                            <div style='padding-top:20px' class='panel-body'>  
                                <p><strong>O relatório não pode ser exibido!</strong></p>   
                                <p>Não existe nenhuma disciplina no curso selecionado</p>";
            }

            if($intExisteProfessor == 1){
                //seleciona idSIAPE de todos os professores ativos em fucionario para comparar com id de profdisciplinas
                $query = mysqli_query($link, "SELECT idSIAPE FROM funcionario WHERE hierarquia = 'P' AND ativo = 'S' ");
                $intI = 0;
                $vetIdSiapeProfessores[$intI] = 0;
                while($funcionario = mysqli_fetch_array($query)){
                    $vetIdSiapeProfessores[$intI] = $funcionario['idSIAPE'];
                    $intI++;
                }

                //grava nome dos professores que tiverem o idSIAPE no vetor de idProfessores em um vetor de nomes
                $intI = 0;
                $intJ = 0;
                $intK = 0;
                for ($intI = 0; $intI < count($vetIdSiapeProfessores); $intI++){
                    for($intJ = (count($vetIdProfDisciplinas)-1); $intJ >= 0; $intJ--){
                        if ($vetIdSiapeProfessores[$intI] == $vetIdProfDisciplinas[$intJ]){
                            $query = mysqli_query($link, " SELECT nome FROM funcionario WHERE idSIAPE = $vetIdSiapeProfessores[$intI] AND ativo='S' ");
                            while($funcionario = mysqli_fetch_array($query)){
                                $vetNomeProfessores[$intK] = $funcionario['nome'];
                                $intK++;
                            }   

                        }
                    }
                } 
            
                // echo "TESTE <br>";
                // echo "Nome do curso selecionado: ";
                // print_r($strNomeCursoSelecionado);
                // echo "<br> Departamento do curso: ";
                // print_r($strNomeDeptoCursoSelecionado);
                // echo "<br> Id's das turmas do curso (não peguei nome porque não uso no relatório): ";
                // print_r($vetIdTurmas);
                // echo "<br> Id's das disciplinas do curso:  ";
                // print_r($vetIdDisciplinas);
                // echo "<br> Nomes das disciplinas do curso: ";
                // print_r($vetNomeDisciplinas);
                // echo "<br> Carga Horaria Min das disciplinas do curso: ";
                // print_r($vetCargaHorariaMinDisciplinas);
                // echo "<br> Id's dos professores em profdisciplinas: ";
                // print_r($vetIdProfDisciplinas);
                // echo "<br> Id's SIAPE de TODOS os professores: ";
                // print_r($vetIdSiapeProfessores);
                // echo "<br> Nomes dos professores APENAS DO CURSO SELECIONADO (obtidos com a comparação entre o idProfessor e o idSIAPE, que são a mesma coisa: ";
                // print_r($vetNomeProfessores);
                // echo "FIM DO TESTE <br><br>";

                //ORGANIZANDO DADOS PARA EXIBIÇÃO NA TABELA 
                //Ordenando array para os nomes ficarem em ordem alfabetica na tabela
                //OBS: função sort ordena um array. os elementos serão ordenados do menor para o maior ao final da execução dessa função.
                sort($vetNomeProfessores);
                // print_r($vetNomeProfessores);
                // echo "<br>";

                //Crindo vetor que armazena o idSIAPE na mesma posição que está o nome em $vetNomeProfessores
                //Por ex, se Vivas está em $vetNomeProfessores[20], seu idSIAPE estará em $vetAuxIdSiapeProfessores[20]
                $intI = 0;
                for ($intI = 0; $intI < count($vetNomeProfessores); $intI++){
                    $query = mysqli_query($link, " SELECT idSIAPE FROM funcionario WHERE nome = '$vetNomeProfessores[$intI]' AND ativo='S' ");
                    while($funcionario = mysqli_fetch_array($query)){
                        $vetAuxIdSiapeProfessores[$intI] = $funcionario['idSIAPE'];
                    }
                }
                // print_r($vetAuxIdSiapeProfessores);
                // echo "<br>";

                //Criando matriz[i][j] que armazena a posicao do idSIAPE do professor em [i] e o id da disciplina em [j]
                $intJ = 0;
                for ($intI = 0; $intI < count($vetAuxIdSiapeProfessores); $intI++){
                    $query = mysqli_query($link, " SELECT idDisciplina FROM profdisciplinas WHERE idProfessor = $vetAuxIdSiapeProfessores[$intI] AND ativo='S' ");
                    while($profdisciplinas = mysqli_fetch_array($query)){
                        $vetAuxIdDisciplinas[$intI][$intJ] = $profdisciplinas['idDisciplina'];
                        $intJ++;
                    }
                }
                // print_r($vetAuxIdDisciplinas);
                // echo "<br>";
                // echo count($vetAuxIdDisciplinas[0]);
                // echo "<br>";

                //criando vetor auxiliar com o id da disciplina para fazer a query abaixo (que pega o nome da disciplina)
                $intK = 0;
                $intAux = 0;
                for ($intI = 0; $intI < count($vetAuxIdSiapeProfessores); $intI++){
                    $intQuantidadeDisciplinas = count($vetAuxIdDisciplinas[$intI]);
                    $intAux = $intK;
                    for($intJ = $intAux; $intJ < ($intQuantidadeDisciplinas+$intAux); $intJ++){
                        $vetAux[$intK] = $vetAuxIdDisciplinas[$intI][$intJ];
                        $intK++;
                    }
                }
                // print_r($vetAux);
                // echo "<br>";

                //Criando matrizes[i][j] que armazenam a posicao do idSIAPE do professor em [i] e o nome/cargaHoraria da disciplina em [j]
                $intK = 0;
                for ($intI = 0; $intI < count($vetAuxIdSiapeProfessores); $intI++){
                    $intQuantidadeDisciplinas = count($vetAuxIdDisciplinas[$intI])+$intK;
                    for ($intJ = $intK; $intJ < count($vetAux); $intJ++){
                        $query = mysqli_query($link, " SELECT nome, cargaHorariaMin FROM disciplinas WHERE id = $vetAux[$intJ] AND ativo='S' ");
                        while(($disciplinas = mysqli_fetch_array($query)) && ($intK < $intQuantidadeDisciplinas)){
                            $vetAuxNomeDisciplinas[$intI][$intK] = $disciplinas['nome'];
                            $vetAuxCargaHorariaDisciplinas[$intI][$intK] = $disciplinas['cargaHorariaMin'];
                            $intK++;
                        }
                    }
                } 
                // print_r($vetAuxNomeDisciplinas);
                // echo "<br>";
                // print_r($vetAuxCargaHorariaDisciplinas);

                // TABELA ONDE SERÃO EXIBIDOS OS DADOS DO RELATORIO
                echo "
                <div class='container'>
                    <div class='row'>
                        <div class='panel panel-primary filterable'>
                            <div class='panel-heading'>
                                <h3 class='panel-title'>Curso de ".$strNomeCursoSelecionado." - ".$strNomeDeptoCursoSelecionado."</h3>
                                <div class='pull-right'>
                                    <button class='btn btn-default btn-xs btn-filter'><span class='glyphicon glyphicon-filter'></span> Filtrar</button>
                                </div>
                            </div>
                            <table class='table'>
                                <thead>
                                    <tr class='filters'>
                                        <th><input type='text' class='form-control' placeholder='Nome do professor' disabled></th>
                                        <th><input type='text' class='form-control' placeholder='Disciplinas' disabled></th>
                                        <th><input type='text' class='form-control' placeholder='Horas de trabalho' disabled></th>
                                    </tr>
                                </thead>
                                <tbody>";
                                  
                                    //função array_sum calcula a soma dos elementos de um array
                                    $intJ = 0;
                                    for ($intI = 0; $intI < count($vetNomeProfessores); $intI++){
                                        echo "
                                            <tr>
                                                <td rowspan = ".count($vetAuxIdDisciplinas[$intI]).">".$vetNomeProfessores[$intI]."</td>
                                                <td>".$vetAuxNomeDisciplinas[$intI][$intJ]."</td>
                                                <td rowspan = ".count($vetAuxIdDisciplinas[$intI]).">".array_sum($vetAuxCargaHorariaDisciplinas[$intI])."</td>";
                                                $intJ++;
                                        echo "</tr>";
                                        $intQuantidadeDisciplinas = count($vetAuxIdDisciplinas[$intI]);
                                        for ($intK = 0; $intK < ($intQuantidadeDisciplinas-1); $intK++){
                                            echo "
                                            <tr>
                                                <td>".$vetAuxNomeDisciplinas[$intI][$intJ]."</td>
                                            </tr>";
                                            $intJ++;
                                        }
                                    }

                                echo "
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class='alinhamento-botao-voltar'>
                    <input type='button' class='btn btn-primary' value='Voltar' onClick='voltarParaPaginaAcessarProfessoresSelecionarCurso()'/>  
                </div>";
            } // fim do if que verifica existencia do professor 
            if ($intExisteProfessor == 0 && $intExisteDisciplina == 0) {
                echo "<p>Não existe nenhum professor no curso selecionado<p>";
            }
            if ($intExisteProfessor == 0 && $intExisteDisciplina == 1) {
                echo "
                <div class='container'>    
                    <div style='margin-top:50px;' class='mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2'>                    
                        <div class='panel panel-info'>
                            <div class='panel-heading'>
                                <div class='panel-title'>Curso de ".$strNomeCursoSelecionado." - ".$strNomeDeptoCursoSelecionado."</div>
                            </div>  
                            <div style='padding-top:20px' class='panel-body'>  
                                <p><strong>O relatório não pode ser exibido!</strong></p>   
                                <p>Não existe nenhum professor associado a disciplina no curso selecionado</p>";

            }
            if ($intExisteTurma == 0 || $intExisteDisciplina == 0 || $intExisteProfessor == 0){ 
                echo "      
                                <input type='button' class='btn btn-primary' value='Voltar' onClick='voltarParaPaginaAcessarProfessoresSelecionarCurso()'/> 
                            </div>                     
                        </div>  
                    </div>
                </div>";

            }
        ?>
        <!-- rodape -->
        <div class="containeer">
            <div class="row">
                <p><center><p class="footertext"><strong><a class="a" href="Colaboradores/gerencia-web-colaboradores.html">Educatio CEFET-MG - Copyright 2017</a></strong></p></center></p>
            </div>
        </div>
    </body>
</html>