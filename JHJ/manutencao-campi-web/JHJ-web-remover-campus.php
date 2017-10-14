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
            // Conectando com o servidor MySQL
            $link = mysqli_connect("localhost", "root", "");
            if (!$link){
            //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
            } else {
            //     echo "Conexao efetuada com sucesso!<br/>";
            }

            //Selecionado BD
            $sql = mysqli_select_db($link, 'Educatio');
            //Seleciona os dados dos campus ativos
            $query = mysqli_query($link, " SELECT id, nome, cidade, UF FROM campi WHERE ativo='S' ");
        ?>

        <form action="JHJ-web-remover-campus-exclusao-efetuada.php" method="POST">
            <div class="alinhamento">
                <select required="required" class="custom-select" id="selectParaExcluirCampus" name="selectParaExcluirCampus[]">
                    <option value="">Selecione o campus que você deseja excluir&nbsp;</option>
                    <!-- Usando os dados do BD para fazer o select com os campus ativos -->
                    <?php while($campus = mysqli_fetch_array($query)) { ?>
                    <option name="selectParaExcluirCampus[]" value="<?php echo $campus['id'] ?>">
                    <?php echo $campus['nome']." - ".$campus['cidade']."-".$campus['UF'] ?></option><?php } ?>
                </select><span class="required"> *</span><br><br>
                <button type="button" id="botaoExcluirCampus" class="btn btn-primary">Excluir campus</button>
            </div>

            <!-- alerta para confirmar a exclusão -->
            <div id="alertaConfirmaExclusao" class="modal in" style="display: block;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 style="color: #c42323;" class="modal-title">ALERTA</h4>
                        </div>
                        <div class="modal-body">
                            <p>Você tem certeza que deseja <strong>excluir</strong> o campus selecionado?</p>
                            <div class="row">
                                <div class="col-12-xs text-center">
                                    <input type="submit" class="btn btn-success btn-md" value="Sim"/>
                                    <input type="button" class="btn btn-danger btn-md" value="Não" onClick="voltarParaPaginaExclusaoCampus()">
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal --> 
            <!--  fim do alerta para confirmar a exclusão-->

            <!-- alerta para verificar se o usuario selecionou um campus -->
            <div id="alertaSelecioneCampus" class="modal in" style="display: block;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 style="color: #c42323;" class="modal-title">ALERTA</h4>
                        </div>
                        <div class="modal-body">
                            <p><strong>Selecione um campus!</strong></p>
                            <div class="row">
                                <div class="col-12-xs text-center">
                                    <input type="button" class="btn btn-primary" value="OK" onClick="voltarParaPaginaExclusaoCampus()">
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal --> 
            <!--  fim do alerta para verificar se o usuario selecionou um campus -->
        </form>
        <!-- rodape -->
        <div class="containeer">
            <div class="row">
                <p><center><p class="footertext"><strong><a class="a" href="Colaboradores/gerencia-web-colaboradores.html">Educatio CEFET-MG - Copyright 2017</a></strong></p></center></p>
            </div>
        </div>
    </body>
</html>