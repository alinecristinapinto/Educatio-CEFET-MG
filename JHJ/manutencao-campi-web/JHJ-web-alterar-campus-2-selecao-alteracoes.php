<?php
    session_start();
    $select = $_POST['selectParaAlterarCampus'];
    foreach($select as $_valor){
        //pega id do campus que sera alterado
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

    //Seleciona os dados do campus com id recebido pelo select
    $query = mysqli_query($link, " SELECT nome, cidade, UF, ativo FROM campi WHERE id = $intIdCampus ");
    while($campus = mysqli_fetch_array($query)) { 
        $strNomeCampus = $campus['nome'];
        $_SESSION['strNomeCampus'] = $strNomeCampus;

        $strCidadeCampus = $campus['cidade'];
        $_SESSION['strCidadeCampus'] = $strCidadeCampus;

        $strUFCampus = $campus['UF'];
        $_SESSION['strUFCampus'] = $strUFCampus;

        $strAtivoCampus = $campus['ativo']; 
    }
?>
<html>
    <head>
        <title>Alterar Campus</title>
        <meta charset="utf-8">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/JHJ-web-estilos.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script> 
        <script type="text/javascript" src="js/JHJ-web-script-alterar-campus.js"></script>
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

        <h1>Alteração de Campus</h1>
        <!-- exibindo informações originais do campus dentro de um painel -->
        <div class="container">    
            <div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Informações do Campus</div>
                    </div>  
                    <div style="padding-top:20px" class="panel-body">     
                            <p><strong>As informações originais do campus são:</strong></p> 
                            <p><strong>Nome:</strong> <?php echo " ".$strNomeCampus ?></p>
                            <p><strong>Cidade:</strong> <?php echo $strCidadeCampus ?></p>
                            <p><strong>UF:</strong> <?php echo " ".$strUFCampus ?></p><br>

        <form action="JHJ-web-alterar-campus-3-adicao-alteracoes.php" method="POST">
                                <p><strong>Selecione as informações que você deseja alterar:</strong></p> 

                                <div class="checkbox">
                                  <label><input type="checkbox" class="checkboxAltera" name="checkboxParaAlterarCampus[]" value="Nome">Nome</label>
                                </div>
                                <div class="checkbox">
                                  <label><input type="checkbox" class="checkboxAltera" name="checkboxParaAlterarCampus[]" value="Cidade">Cidade</label>
                                </div>
                                <div class="checkbox">
                                  <label><input type="checkbox" class="checkboxAltera" name="checkboxParaAlterarCampus[]" value="UF">UF</label>
                                </div>

                                <button id="botaoSelecionarAlteracoesCampus" type="button" class="btn btn-primary">Prosseguir</button>
                                <input type="button" class="btn btn-primary" value="Voltar" onClick="voltarParaPaginaAlteracaoCampus()"/>      
                    </div>                     
                </div>  
            </div>
        </div>
        <!-- alerta para verificar se o usuario selecionou pelo menos uma das opções de alteração -->
        <div id="alertaSelecioneAlteracaoCampus" class="modal in" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color: #c42323;" class="modal-title">ALERTA</h4>
                    </div>
                    <div class="modal-body">
                        <p><strong>Selecione pelo menos umas das opções disponíveis para alteração!</strong></p>
                        <div class="row">
                            <div class="col-12-xs text-center">
                                <input type="button" class="btn btn-primary" value="OK" onClick="fecharAlerta()">
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 
        <!--  fim do alerta para verificar se o usuario selecionou pelo menos uma das opções de alteração -->
        <!-- alerta para a confirmacao -->
            <div id="alertaConfirma" class="modal in" style="display: block;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 style="color: #c42323;" class="modal-title">ALERTA</h4>
                        </div>
                        <div class="modal-body">
                            <p>Você tem certeza que deseja seguir com as alterações?</p>
                            <div class="row">
                                <div class="col-12-xs text-center">
                                    <input type="submit" class="btn btn-success btn-md" value="Sim"/>
                                    <input type="button" class="btn btn-danger btn-md" value="Não" onClick="fecharAlerta()">
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal --> 
            <!--  fim do alerta para a confirmação-->
        </form>
        
        <!-- rodape -->
        <div class="containeer">
            <div class="row">
                <p><center><p class="footertext"><strong><a class="a" href="Colaboradores/gerencia-web-colaboradores.html">Educatio CEFET-MG - Copyright 2017</a></strong></p></center></p>
            </div>
        </div>
    </body>
</html>