<!DOCTYPE html>
<html>
<head>
	<title>Seleção de conteúdos</title>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">

	<!-- CSS do Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap.css" rel="stylesheet"/>

	<!-- CSS do grupo -->
	<link href="CJF-web-estilos.css" rel="stylesheet" type="text/css" >

	<!-- Arquivos js -->
	<script src="js/popper.js"></script>
	<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

	<!-- Fontes e icones -->
	<link href="css/nucleo-icons.css" rel="stylesheet">
</head>
<body>
	<div class="section landing-section">
		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto">
					<h2 class="text-center">Seleção de conteúdos</h2>
					<form method='post' action='SelecaoConteudos.php' class="contact-form">
						<div class="col-md-6">
							<label class="fonteTexto">Digite o número da etapa: </label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-check-2"></i>
								</span>
								<input type='textarea' class="form-control" name='etapa' placeholder="Número da etapa" required='required'>
							</div>
							<label class="fonteTexto">Digite o nome da disciplina: </label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-globe-2"></i>
								</span>
								<input type='textarea' class="form-control" name='disciplina' placeholder="Nome da disciplina" required='required'>
							</div>
							<input class="btn btn-info btn-round" type='submit' value='Exibir'>
						</div>
					</form>
				</div>
			</div>
		</div>				
	</div>					
</body>
</html>