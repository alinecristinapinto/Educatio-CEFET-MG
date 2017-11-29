<!DOCTYPE html>
<html>
<head>
	<title>Relação Acervo</title>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">

	<!-- CSS do Bootstrap -->

	<!-- CSS do grupo -->
	<link href="../Opcoes-do-sistema/Relatorios/css/CJF-web-estilos.css" rel="stylesheet" type="text/css" >

	<!-- Arquivos js -->

	<!-- Fontes e icones -->
</head>
<body>

		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto">
					<h2 class="text-center">Relação de acervo por tipo</h2>
					<form method='post' action='../Opcoes-do-sistema/Relatorios/relatorio-1-obras-acervo/CJF-RelacaoAcervo2.php' class="contact-form">
						<div class="col-md-6">
							<label class="fonteTexto">Selecione o acervo:</label>
							<select class="custom-select" name="acervo">
								<option>Livros</option>
								<option>Periódicos</option>
								<option>Acadêmicos</option>
								<option>Mídias</option>
							</select>
							<input class="btn btn-info" type='submit' value='Exibir'>
						</div>
					</form>
				</div>
			</div>
		</div>

</body>
</html>

