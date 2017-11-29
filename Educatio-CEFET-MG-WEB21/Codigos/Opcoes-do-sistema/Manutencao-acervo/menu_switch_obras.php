<!DOCTYPE html>
<html>
<head>
	
	<!-- CSS do Bootstrap -->
	<link href="../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

	<!-- CSS do grupo -->
	 <link href="pagina_inicial.css" rel="stylesheet" />

	<!-- Arquivos js -->
	<script src="../../../Estaticos/Bootstrap/js/popper.js"></script>
	<script src="../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

	<!-- Fontes e icones -->
	<link href="../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">

	<style type="text/css">
		.text-center{
           font-family: 'Abel', sans-serif;
           color: #d8ac29;
        }
        .fonteTexto{
           font-family: 'Inconsolata', monospace;
           font-size: 20px;
        }
		button.btn {
			background-color: #2644B2;
			color: white;
		}

		div.title {
			margin-top: 2%;
		}

		h1 {
			color: #d8ac29; 
		}

		div.container {
			margin-top: 2%;
		}

		#p1 {
			text-align: center;
		}

		#voltar {
		    margin-top: 5%;
		    float: right;
		}
		.btn-info {
          background-color: #162e87;
          border-color: #162e87;
          color: #FFFFFF;
          opacity: 1;
          filter: alpha(opacity=100);
        }
        .btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .show > .btn-info.dropdown-toggle {
          background-color: #11277a;
          color: #FFFFFF;
          border-color: #11277a;
        }
	 </style>
		<script type="text/javascript">

		function func1(){
			window.location.href="periodico.php?"
		}
		
		function func2(){
			window.location.href="midias.php?"
		}

		function func3(){
			window.location.href="livro.php?"
		}

		function func4(){
			window.location.href="acad.php?"
		}

		function func5(){
			window.location.href="../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarManutencaoAcervo"
		}

	</script>


	<title></title>
</head>
<body>
	<?php 
        session_start();
        require "../../Menu-Rodape-Secundarios/caso-2/gerencia-web-menu-interface-bibliotecario.php"; 
    ?>
	<div class="wrapper">
		<div class="title" style="text-align: center;">
			<h1 class="text-center"><b>Manutenção de Acervo</b></h1>
		</div>
			<p id="p1">Crie, edite e exclua obras do acervo</p>
		<div class="container">
			
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-body">	
							<h5 class="card-title">Crie um novo livro</h5>
							<button type="button" onclick="func3()" class="btn btn-info">Criar Livro</button>
						</div>
					</div>
				</div>
                <div class="col">
					<div class="card">
						<div class="card-body">	
							<h5 class="card-title">Crie um novo academico</h5>
							<button type="button" onclick="func4()" class="btn btn-info">Criar Academico</button>
						</div>
					</div>
				</div>
	
            </div>
            <div class="row"> 
                <div class="col">
					<div class="card">
						<div class="card-body">	
							<h5 class="card-title">Crie uma nova midia</h5>
							<button type="button"  onclick="func2()" class="btn btn-info">Criar Midia</button>
						</div>
					</div>
				</div>
            
				<div class="col">
					<div class="card">
						<div class="card-body">	
							<h5 class="card-title">Crie um novo periodico</h5>
							<button type="button" onclick="func1()" class="btn btn-info">Criar Periodico</button>
						</div>
					</div>
				</div>
			</div>
            <button id="voltar" class="btn btn-info" onclick="func5()">Voltar</button>
        </div>  
	</div>
	<br><br><br><br><br><br>
	<?php require "../../Menu-Rodape-Secundarios/caso-2/gerencia-web-rodape.php"; ?>
</body>
</html>