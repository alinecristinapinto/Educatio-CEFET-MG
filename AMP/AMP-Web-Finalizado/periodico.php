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
             <h2 class="text-center">Periodicos</h2>
        </div>
		<form class="contact-form" action="periodicophp.php" method="post">
			<div class="container">
				<div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Nome:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-tag-content"></i>
									</span>
									<input type="text" class="form-control" name="nome" placeholder="Nome do periodico" required='required'>
								</div>
				      </div>
					</div>
					<div class="col ml-auto mr-auto">
       			<div class="col-md-12">
         			<label class="fonteTexto">Periodicidade:</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-check-2"></i>
								</span>
								<input type="text" name="periodicidade" class="form-control" placeholder="Periodicidade" required='required'>
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
								<input type="text" class="form-control" name="local" placeholder="Local do periodico" required='required'>
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
									<input type="number" class="form-control" name="ano" placeholder="Ano do periodico" required='required'>
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
								<input type="text" class="form-control" name="editora" placeholder="Editora do periodico" required='required'>
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
									<input type="number" class="form-control" name="paginas" placeholder="Numero de paginas" required='required'>
								</div>
				      </div>
					</div>
                    <div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Mês:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-calendar-60"></i>
									</span>
									<input type="number" class="form-control" name="mes" placeholder="Mês do periodico" required='required'>
								</div>
				      </div>
					</div>
				</div>
                
                <div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Volume:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-tile-56"></i>
									</span>
									<input type="number" class="form-control" name="volume" placeholder="Volume do periodico" required='required'>
								</div>
				      </div>
					</div>
                    <div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Subtipo:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-bullet-list-67"></i>
									</span>
									<input type="text" class="form-control" name="subtipo" placeholder="Subtipo do periodico" required='required'>
								</div>
				      </div>
					</div>
				</div>
                
                <div class="row">
                    <div class="col ml-auto mr-auto">
                    <div class="col-md-12">
                        <label class="fonteTexto">ISSN:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-badge"></i>
                                    </span>
                                    <input type="number" class="form-control" name="ISSN" placeholder="ISSN do periodico" required='required'>
                                </div>
                      </div>
                    </div>
                </div>

					<button type="submit" id="criar" class="btn btn-neutral">Criar</button>
			</div>	
		</form>	
	</div>


</div>

</body>
</html>