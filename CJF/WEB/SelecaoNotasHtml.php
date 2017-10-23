<!DOCTYPE html>
<html>
<head>
	<title>Seleção notas</title>
	<meta charset="utf-8">
	<link href="CJF-web-estilos.css" rel="stylesheet" type="text/css" >
	<link href="css/bootstrap.css" rel="stylesheet">
  	<link href="gerencia-web-estilos-rodape.css" rel="stylesheet">
  	<script src="js/jquery.min.js"></script>
 	<script src="js/bootstrap.min.js"></script> 
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<form method='post' action='SelecaoNotas.php'>
		<div class="jumbotron">
  			<h1 class="display-3">Relação por seleção de aluno</h1>
  			<hr class="my-4">
		</div>
		
		<div class="container" class="form-group">
			<br><label for="entraAluno">Digite o nome do Aluno: </label>
			<input type="textarea" class="form-control" name='aluno' aria-describedby="alunoAjuda" placeholder="Nome do aluno">
			<small id="alunoAjuda" class="form-text text-muted">Verifique se o nome do aluno foi digitado de forma correta.</small><br>
			
			<input class="btn btn-primary btn-lg btn-block" type='submit' value='Exibir'>
		</div>
	</form>

	<div id="rodape">
		<div class="container">
			<div class="row centralizado">
				<div class="col-md-4">
					<img src="prom.jpg" class="img-circle"><br>
					<h6><strong>Desenvolvedores</strong></h6>

					<p></span> Alunos da turma de Informática 2A 2017 do CEFET-MG.
					<a href="#">Clique aqui</a> para saber mais.</p>  
				</div>
				<div class="col-md-4">
				    <img src="cefetop.png" class="img-circle"><br>
				    <h6><strong>Instituição</strong></h6>
				    <p>Centro Federal de Educação Tecnológica de Minas Gerais. Av. Amazonas 5253 - Nova Suíssa - Belo Horizonte - Brasil.</p>
        			</div>
        			<div class="col-md-4">
            				<img src="bootstrap.png" class="img-circle"><br>
            				<h6>Recursos Utilizados</h6>
            				<p>
					    <a href="https://github.com/NinaCris16/Educatio-CEFET-MG">GitHub</a><br>
					    <a href="http://getbootstrap.com/">Bootstrap</a><br>
					    </p>
        			</div>
			</div>
		</div>
	</div>	
</body>
</html>
