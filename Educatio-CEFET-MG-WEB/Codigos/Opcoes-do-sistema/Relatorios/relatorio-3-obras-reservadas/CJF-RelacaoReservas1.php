<!DOCTYPE html>
<html>
<head>
	<title>Relação de reservas</title>
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
					<h2 class="text-center">Relação de reservas por data e geral</h2>
					<form method='post' action='../Opcoes-do-sistema/Relatorios/relatorio-3-obras-reservadas/CJF-RelacaoReservas2.php' class="contact-form">
						<div class="col-md-6">
							<label class="fonteTexto">Digite a data das reservas ou deixe em branco para gerar um relatório geral:</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-book-bookmark"></i>
								</span>
								<!-- Recebe o valor a ser pesquisado -->
								<input type='textarea' class="form-control" name='data' placeholder="Data das reservas">
							</div>
							<input class="btn btn-info btn-round" type='submit' value='Exibir'>
						</div>	
					</form>
				</div>
			</div>
		</div>	

</body>
</html>