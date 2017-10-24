<?php
    session_start();
    $select = $_POST['selectParaExcluirCampus'];
    foreach($select as $_valor){
        //pega id do campus que sera excluido
        $intIdCampus = $_valor;
        $_SESSION['intIdCampus'] =  $intIdCampus;
    }
    // Conectando com o servidor MySQL
    $link = mysqli_connect("localhost", "root", "");
    if (!$link){
    //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
    } else {
    //     echo "Conexao efetuada com sucesso!<br/>";
    }
    // Selecionado BD
    $sql = mysqli_select_db($link, 'Educatio');
?>
<html>
    <head>
        <title>Remover Campus</title>
        <meta charset="utf-8">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/JHJ-web-estilos.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script> 
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

        <h1>Exclusão de Campus</h1>
        <?php
            //Verificando se existem departamentos ligados com o campus selecionado
            if ($result = mysqli_query($link, " SELECT id FROM deptos WHERE idCampi = $intIdCampus AND ativo = 'S' ")) {
                //total de departamentos do campus selecionado
                $intTotalDeptosCampusSelecionado = mysqli_num_rows($result);
                mysqli_free_result($result);
            } else {
                // echo "erro";
            }

            if($intTotalDeptosCampusSelecionado > 0) {
                if ($result = mysqli_query($link, "SELECT id FROM deptos")) {
                    //total de linhas da tabela deptos
                    $intTotalLinhasTabelaDeptos = mysqli_num_rows($result);
                    mysqli_free_result($result);
                } else {
                    // echo "erro";
                }
                //Verifica linha por linha na tabela e salva o nome dos departamentos em um vetor
                $intJ = 0;
                for ($intI = 1; $intI <= $intTotalLinhasTabelaDeptos; $intI++){
                    if ($query = mysqli_query($link, " SELECT nome FROM deptos WHERE id = $intI AND idCampi = $intIdCampus AND ativo = 'S' ")) {
                        $departamento = mysqli_fetch_array($query);
                        if($departamento['nome'] != null){
                            $strVetorNomesDeptos[$intJ] = $departamento['nome']; 
                            $intJ++;
                        }
                    }
                }
            } else if($intTotalDeptosCampusSelecionado == 0) {
                //Seleciona os dados do campus com id recebido pelo select
                $query = mysqli_query($link, " SELECT nome, cidade, UF, ativo FROM campi WHERE id = $intIdCampus ");
                while($campus = mysqli_fetch_array($query)) { 
                    $strNomeCampus = $campus['nome'];
                    $strCidadeCampus = $campus['cidade'];
                    $strUFCampus = $campus['UF'];
                    $strAtivoCampus = $campus['ativo']; 
                }
                //Tornando campus inativo ("excluindo")
                $sql = "UPDATE campi SET ativo = 'N' WHERE id = $intIdCampus";
                if (mysqli_query($link, $sql)) {
                //     echo "sucesso";
                }else{
                //     echo "erro";
                }
            }
        ?>

        <!-- exibindo informações dentro de um painel -->
        <?php
            if($intTotalDeptosCampusSelecionado > 0) {
                echo "
                <div class='container'>    
                    <div style='margin-top:50px;' class='mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2'>                    
                        <div class='panel panel-info'>
                            <div class='panel-heading'>
                                <div class='panel-title'>O campus selecionado está interligado com ".$intTotalDeptosCampusSelecionado." departamento(s)!</div>
                            </div>  
                            <div style='padding-top:20px' class='panel-body'>     
                                    <p><strong>Nome(s) do(s) departamento(s):</strong></p>"; 
                                    foreach ($strVetorNomesDeptos as $valor) {
                                        echo $valor."<br>";
                                    }
                                    echo "<br>";
                                    echo "
                                    <input type='button' class='btn btn-primary' value='Estou ciente e desejo continuar' onClick='irParaPaginaExclusaoCampusComDepartamentos()'/>
                                    <input type='button' class='btn btn-primary' value='Voltar' onClick='voltarParaPaginaExclusaoCampus()'/>
                            </div>                     
                        </div>  
                    </div>
                </div> ";
            } else if($intTotalDeptosCampusSelecionado == 0) {
                echo "
                <div class='container'>    
                    <div style='margin-top:50px;' class='mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2'>                    
                        <div class='panel panel-info'>
                            <div class='panel-heading'>
                                <div class='panel-title'>Campus removido com sucesso!*</div>
                            </div>  
                            <div style='padding-top:20px' class='panel-body'>     
                                    <p><strong>As informações do campus excluído são:</strong></p> 
                                    <p><strong>Nome:</strong> ".$strNomeCampus."</p>
                                    <p><strong>Cidade:</strong> ".$strCidadeCampus."</p>
                                    <p><strong>UF:</strong> ".$strUFCampus."</p>
                                    <p><strong>*</strong>O campus  não estava interligado com nenhum departamento.</p> 
                                    <input type='button' class='btn btn-primary' value='Voltar' onClick='voltarParaPaginaExclusaoCampus()'/>
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