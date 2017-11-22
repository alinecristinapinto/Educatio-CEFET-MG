<!DOCTYPE html>
<html>
<head>

	<!-- CSS do Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap.css" rel="stylesheet"/>

	<!-- CSS do grupo -->
	 <link href="formularios.css" rel="stylesheet" />

	<!-- Arquivos js -->
	<script src="js/popper.js"></script>
	<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

	<!-- Fontes e icones -->
	<link href="css/nucleo-icons.css" rel="stylesheet">
	

	<title></title>
	<script type="text/javascript">
		function func1(){
			location.href='pagina_inicial_manutencaoacervo.html';
		}
	</script>

</head>
<body>
 
<!-- 
2644B2
6989FF
4F75FF 
d8ac29
-->


<div class="wrapper">
	<div class="title" style="text-align: center;">
		<h1><b>Manutenção de Acervo</b></h1>
	</div>
		<p id="p1">Crie, edite e exclua obras do acervo</p>

	<div class="container">
		<div class="head">
             <h2 class="text-center">Autor</h2>
        </div>
		<form class="contact-form" action="autor.php" method="post">
			<div class="container">                
                <div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Nome:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-single-02"></i>
									</span>
									<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do autor" required='required'>
								</div>
				      </div>
					</div>
                    <div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Sobrenome:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-single-02"></i>
									</span>
									<input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome do autor" required='required'>
								</div>
				      </div>
					</div>
				</div>
                <div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Ordem:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-single-02"></i>
									</span>
									<input type="text" class="form-control" id="ordem" name="ordem" placeholder="Ordem do autor" required='required'>
								</div>
				      </div>
					</div>
                    <div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Qualificação:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-single-02"></i>
									</span>
									<input type="text" class="form-control" id="qualificacao" name="qualificacao" placeholder="Qualificação do autor" required='required'>
								</div>
				      </div>
					</div>
				</div>
					<button class="btn btn-info btn-round" onclick="func1()">Sair</button>
					<button type="submit" id="criar" class="btn btn-info btn-round">Criar</button>
			</div>	
		</form>	
	</div>


</div>

</body>
</html>