<?php
// Start the session
session_start();
?>
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

	
	</script>
	

	<title></title>
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
		<h1><b>Manutenção de Professor</b></h1>
	</div>
		<p id="p1">Crie, edite e exclua professores</p>

	<div class="container">
		<div class="head">
             <h2 class="text-center">Professor</h2>
        </div>
		<form class="contact-form" action="professor3.php" method="post">
			<div class="container">
				<div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Nome:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-circle-10"></i>
									</span>
									<input type="text" class="form-control" name="nome" value="<?php echo $_SESSION['nome']?>" placeholder="Nome do professor" required='required'>
								</div>
				      </div>
					</div>
					<div class="col ml-auto mr-auto">
       			<div class="col-md-12">
         			<label class="fonteTexto">ID Siape:</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-credit-card"></i>
								</span>
								<input type="text" name="idSIAPE" class="form-control" placeholder="ID Siape do professor" value="<?php echo $_SESSION['idSIAPE']?>" required='required'>
							</div>
			      </div>
					</div>	
				</div>

				<div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">ID Departamento:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-bookmark-2"></i>
									</span>
									<input type="number" name="idDepto" class="form-control" value="<?php echo $_SESSION['idDepto']?>" placeholder="Departamento do professor" required='required'>
								</div>
				      </div>
					</div>
					<div class="col ml-auto mr-auto">
       			<div class="col-md-12">
         			<label class="fonteTexto">Titulação:</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-hat-3"></i>
								</span>
								<input type="text" name="titulacao" class="form-control" value="<?php echo $_SESSION['titulacao']?>" placeholder="Formação do professor" required='required'>
							</div>
			      </div>
					</div>	
				</div>

				<div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Senha:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-lock-circle-open"></i>
									</span>
									<input type="password" name="senha" value="<?php echo $_SESSION['senha']?>" class="form-control" placeholder="********" required='required'>
								</div>
				      </div>
					</div>
					<div class="col ml-auto mr-auto">
       			<div class="col-md-12">
         			<label class="fonteTexto">Foto:</label>	
                        <input type="file" class="form-control" placeholder="Editora do livro" required='required'>
			      </div>
					</div>	
				</div>

				<div class="btn-group" role="group" aria-label="...">								
					<button type="submit" class="btn btn-neutral" >Editar</button>
				</div>
			</div>	
		</form>	
		<div>
		<form action="professor4.php" method="post">
			<button class="btn btn-neutral" name="excluir">Excluir</button>			
		</form>
</div>
	</div>


</div>

</body>
</html>