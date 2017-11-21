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
		<h1><b>Manutenção de Acervo</b></h1>
	</div>
		<p id="p1">Crie, edite e exclua obras do acervo</p>

	<div class="container">
		<div class="head">
             <h2 class="text-center">Livros</h2>
        </div>
		<form class="contact-form" action="alteralivro.php" method="post">
			<div class="container">
				<div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Nome:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-tag-content"></i>
									</span>
									<input type="text" name="nome" value="<?php echo $_SESSION['nome']?>" class="form-control" placeholder="Nome do livro" required='required'>
								</div>
				      </div>
					</div>
					<div class="col ml-auto mr-auto">
       			<div class="col-md-12">
         			<label class="fonteTexto">Edição:</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-check-2"></i>
								</span>
								<input type="text" class="form-control" value="<?php echo $_SESSION['edicao']?>"  name="edicao" placeholder="Edição do livro" required='required'>
							</div>
			      </div>
					</div>	
				</div>

				<div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Campus:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-bookmark-2"></i>
									</span>
									<select class="form-control" name="idCampi" class="form-control" 
					id = "idCampi" required>
					<option disabled selected value = ""> Selecione um Campus </option>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "educatio");
					if (!$conn) {
						die("Conexão falhou: " . mysqli_connect_error());
					}
						$sql = "SELECT * FROM campi";
						$result = mysqli_query($conn, $sql);
						while($linhaCampus = mysqli_fetch_array($result)){
							echo "<option value = " .$linhaCampus[0] .">" .$linhaCampus[1] ."</option>";
						}
					?>
				</select>
									
								</div>
				      </div>
					</div>
					<div class="col ml-auto mr-auto">
       			<div class="col-md-12">
         			<label class="fonteTexto">Local:</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-pin-3"></i>
								</span>
								<input type="text" value="<?php echo $_SESSION['local']?>" class="form-control" name="local" placeholder="Local do livro" required='required'>
							</div>
			      </div>
					</div>	
				</div>

				<div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Ano:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-calendar-60"></i>
									</span>
									<input type="number" value="<?php echo $_SESSION['ano']?>" class="form-control" name="ano" placeholder="qualquer coisa" required='required'>
								</div>
				      </div>
					</div>
					<div class="col ml-auto mr-auto">
       			<div class="col-md-12">
         			<label class="fonteTexto">Editora:</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-paper"></i>
								</span>
								<input type="text" value="<?php echo $_SESSION['editora']?>" class="form-control" name="editora" placeholder="Editora do livro" required='required'>
							</div>
			      </div>
					</div>	
				</div>

				<div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Paginas:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-single-copy-04"></i>
									</span>
									<input type="number" value="<?php echo $_SESSION['paginas']?>" class="form-control" name="paginas" placeholder="Numero de paginas" required='required'>
								</div>
				      </div>
					</div>
                    <div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">ISBN:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-book-bookmark"></i>
									</span>
									<input type="number" class="form-control" value="<?php echo $_SESSION['ISBN']?>" name="ISBN" placeholder="ISBN do livro" required='required'>
								</div>
				      </div>
					</div>
				</div>
					<button type="submit" id="criar" class="btn btn-neutral">Editar</button>
			</div>	
		</form>	
		<form class="contact-form" action="excluilivro.php" method="post">
			<button type="submit" id="criar" class="btn btn-neutral">Excluir</button>
		</form>
	</div>


</div>

</body>
</html>