<!DOCTYPE html>
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
        <div class="alinhamento">
            <h4>Informações do campus</h4>
        </div>
        <?php
			$caixaSelecao = $_POST["checkboxParaAlterarCampus"];
			$intI = 0;
			foreach($caixaSelecao as $_valor){
		    	if($caixaSelecao[$intI] == 'Nome'){
					$strVet[0] = $caixaSelecao[$intI];		    		
		    	} else if ($caixaSelecao[$intI] == 'Cidade'){
					$strVet[1] = $caixaSelecao[$intI];		    		
		    	} else if ($caixaSelecao[$intI] == 'UF'){
					$strVet[2] = $caixaSelecao[$intI];		    		
		    	}  
		    	$intI++;
			}

			if (!isset($strVet[0])){
				$strVet[0] = '';
			} 
			if (!isset($strVet[1])){
				$strVet[1] = '';
			} 
			if (!isset($strVet[2])){
				$strVet[2] = '';
			} 
			
			echo "<form action='JHJ-web-alterar-campus-4-alteracao-efetuada.php' method='POST'>";
			if($strVet[0] == 'Nome'){
				echo "
				<div class='alinhamento'>
					<div class='form-group'>
	          			<labelfor='pwd'>ALTERAR NOME</label>
	          			<input type='text' class='input-xlarge' name='nomeCampus' required='required'/><span class='required'> *</span>
	    		    </div>
    		    </div>";
			} 
			if($strVet[1] == 'Cidade'){
				echo "
				<div class='alinhamento'>
					<div class='form-group'>
	          			<labelfor='pwd'>ALTERAR CIDADE</label>
	          			<input type='text' class='input-xlarge' name='cidadeCampus' required='required'/><span class='required'> *</span>
	    		    </div>
    		    </div>";
			} 
			if($strVet[2] == 'UF'){
				echo "
				<div class='alinhamento'>
					<div class='form-group'>
	          			<labelfor='pwd'>ALTERAR UF</label>
	          			<input type='text' class='input-xlarge' name='ufCampus' required='required'/><span class='required'> *</span>
	    		    </div>
    		    </div>";
			} 
			echo "
			<div class='alinhamento'>
				<input type='submit' class='btn btn-primary' value='Alterar!'/>
                <input type='button' class='btn btn-primary' value='Voltar para o início' onClick='voltarParaPaginaAlteracaoCampus()'/>
			</div>
			</form>";
		?>
                
        <!-- rodape -->
        <div class="containeer">
            <div class="row">
                <p><center><p class="footertext"><strong><a class="a" href="Colaboradores/gerencia-web-colaboradores.html">Educatio CEFET-MG - Copyright 2017</a></strong></p></center></p>
            </div>
        </div>
    </body>
</html>