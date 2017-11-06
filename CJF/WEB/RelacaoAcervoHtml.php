<!DOCTYPE html>
<html>
<head>
	<title>Relação Acervo</title>
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
					<h2 class="text-center">Relação de acervo por tipo</h2>
					<form method='post' action='RelacaoAcervo.php' class="contact-form">
						<div class="col-md-6">
							<label class="fonteTexto">Selecione o acervo:</label>
							<select class="custom-select" name="acervo">
								<option>Livros</option>
								<option>Periódicos</option>
								<option>Acadêmicos</option>
								<option>Mídias</option>
							</select>
							<input class="btn btn-info btn-round" type='submit' value='Exibir'>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

