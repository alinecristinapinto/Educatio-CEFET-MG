<!DOCTYPE html>
<html>
    <head>
        <title>Acessar professores</title>
        <meta charset="utf-8">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/JHJ-web-estilos.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script> 
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
        ?>

        <form id="formularioCampus" action="#" method="POST">
            <div class="alinhamento">
                <?php
                    //Seleciona os dados dos campus ativos
                    $query = mysqli_query($link, " SELECT id, nome, cidade, UF FROM campi WHERE ativo='S' ");
                ?>
                <!-- Usando os dados do BD para fazer o select com os campi ativos -->
                <h4>Campi onde os professores lecionam:</h4>
                <select style="width: 300px" required="required" class="custom-select" name="selectCampusParaAcessarProfessores[]">
                    <option value="">Selecione um campus&nbsp;</option>
                    <?php while($campus = mysqli_fetch_array($query)) { ?>
                        <option name="selectCampusParaAcessarProfessores[]" value="<?php echo $campus['id'] ?>">
                        <?php echo $campus['nome']." - ".$campus['cidade']."-".$campus['UF'] ?></option>
                    <?php } ?>
                </select><br><br>
                <button type="submit" class="btn btn-primary">Selecionar campus</button>
            </div>
        </form> <!-- fim do formularioCampus -->

        <?php
            if (!isset($_POST['selectCampusParaAcessarProfessores'])){ 
                //echo "select campus ainda não foi preenchido";
            } else {
                //Pega id e dados do campus que foi selecionado
                $select = $_POST['selectCampusParaAcessarProfessores'];
                foreach($select as $_valor){
                    $intIdCampus = $_valor;    
                }
                $query = mysqli_query($link, "SELECT nome, cidade, UF FROM campi WHERE id = $intIdCampus");
                $campus = mysqli_fetch_array($query);
                $strNomeCampusSelecionado = $campus['nome'];
                $strCidadeCampusSelecionado = $campus['cidade'];
                $strUFCampusSelecionado = $campus['UF'];

                //Seleciona o id dos departamentos ativos que estão no campus selecionado
                $query = mysqli_query($link, "SELECT id FROM deptos WHERE idCampi = $intIdCampus AND ativo='S' ");
                //Salvando id's dos departamentos em um vetor
                $intI = 0;
                $vetIdDeptos[$intI] = 0;
                while($deptos = mysqli_fetch_array($query)){
                    $vetIdDeptos[$intI] = $deptos['id'];
                    $intI++;
                }
                //Seleciona o id e o nome dos cursos ativos que estão nos departamentos contidos no vetor ($vetIdDeptos)
                //Salva id's e nomes dos cursos em um outros vetores ($vetIdCursos $vetNomeCursos)
                //OBS: count retorna a quantidade de elementos de um array
                $intJ = 0;
                for ($intK = 0; $intK < count($vetIdDeptos); $intK++){
                    $query = mysqli_query($link, " SELECT id, nome FROM cursos WHERE idDepto = $vetIdDeptos[$intK] AND ativo='S' ");
                    while($cursos = mysqli_fetch_array($query)){
                        $vetIdCursos[$intJ] = $cursos['id'];
                        $vetNomeCursos[$intJ] = $cursos['nome'];
                        $intJ++;
                    }
                }
        ?>
            <?php
                if (count($vetIdDeptos) == 1 &&  $vetIdDeptos[0] == 0){
            ?>
                    <div class="alinhamento">
                        <h4>Impossível acessar professores! Não existem cursos no <strong><?php echo $strNomeCampusSelecionado." - ".$strCidadeCampusSelecionado."-".$strUFCampusSelecionado ?></strong>.</h4>
                    </div>
            <?php
                } else {
            ?>
                    <form id="formularioCurso" action="JHJ-web-relatorio9-acessar-professores-2.php" method="POST">
                        <div class="alinhamento">
                            <!-- Usando os dados do BD para fazer o select com os cursos -->
                            <h4>Cursos existentes no <strong><?php echo $strNomeCampusSelecionado." - ".$strCidadeCampusSelecionado."-".$strUFCampusSelecionado ?></strong>:</h4>
                            <select style="width: 300px" required="required" class="custom-select" id="selectCursoParaAcessarProfessores" name="selectCursoParaAcessarProfessores[]">
                            <option value="">Selecione um curso&nbsp;</option>.";
                            <?php
                                for ($intZ = 0; $intZ < count($vetIdCursos); $intZ++){ 
                                    echo "<option name='selectCursoParaAcessarProfessores[]'' value='$vetIdCursos[$intZ]'>".
                                    $vetNomeCursos[$intZ]."</option>";
                                } 
                            ?>
                            </select><br><br>
                            <button style="width: 300px" type="submit" class="btn btn-primary" id="botaoSelecionaCurso">Selecionar curso e acessar professores!</button>
                        </div>
                    </form> <!-- fim do formularioCurso -->
            <?php
                } //fechando else
            ?>
        <?php } ?> <!-- fechando outro else  -->
        
        <!-- rodape -->
        <div class="containeer">
            <div class="row">
                <p><center><p class="footertext"><strong><a class="a" href="Colaboradores/gerencia-web-colaboradores.html">Educatio CEFET-MG - Copyright 2017</a></strong></p></center></p>
            </div>
        </div>
    </body>
</html>