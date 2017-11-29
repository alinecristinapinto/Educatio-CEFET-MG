<!DOCTYPE html>
<html>
<head>
	<title>Manutenção de Etapas - Inclusão</title>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">

	<!-- CSS do Bootstrap -->

	<!-- CSS do grupo -->
	<link href="../Opcoes-do-sistema/Manutencao-etapas/CJF-web-estilos.css" rel="stylesheet" type="text/css" >

	<!-- Arquivos js -->

	<!-- Fontes e icones -->

</head>
<body>

		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto">
					<h2 class="text-center">Criação de etapa</h2>
					<form method='post' action='../Opcoes-do-sistema/Manutencao-etapas/CJF-AdicionarEtapas2.php' class="contact-form">
						<div class="row">
							<label class="fonteTexto">Digite o valor da etapa:</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-check-2"></i>
								</span>
								<input type='textarea' class="form-control" name='valor' placeholder="Valor da etapa" required='required'>
							</div>
							<label class="fonteTexto">Digite o Id da etapa:</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-check-2"></i>
								</span>
								<input type='textarea' class="form-control" name='etapa' placeholder="Id da etapa" required='required'>
							</div>
							<input class="btn btn-info" type='submit' value='Adicionar'>
						</div>
					</form>
				</div>
			</div>
		</div>				

</body>
</html>
