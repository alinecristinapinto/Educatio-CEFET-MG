<!DOCTYPE html>

<?php
	header('content-type: text/html; charset=ISO-8859-1');
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//CPF inserido na pagina "PHJL-WEB-Entrada-Formulario-de-alteracao.html"
	define ("CPF", $_POST["valorCPF"]);
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);

	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);

	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM alunos WHERE idCPF = " .CPF;
	$result = mysqli_query($conn,$sql);
	
	$linha = mysqli_fetch_array($result);
	
	$sql = "SELECT * FROM turmas WHERE id = " .$linha[1];
	$resultTurma = mysqli_query($conn,$sql);
	
	$linhaTurma =  mysqli_fetch_array($resultTurma);
	
	$sql = "SELECT * FROM cursos WHERE id = " .$linhaTurma[1];
	$resultCurso = mysqli_query($conn, $sql);
	
	$linhaCurso = mysqli_fetch_array($resultCurso);
	
	$sql = "SELECT * FROM deptos WHERE id = " .$linhaCurso[1];
	$resultDepto = mysqli_query($conn, $sql);
	
	$linhaDepto = mysqli_fetch_array($resultDepto);
	
	$sql = "SELECT * FROM campi WHERE id = " .$linhaDepto[1];
	$resultCampus = mysqli_query($conn, $sql);
	
	$linhaCampus = mysqli_fetch_array($resultCampus);

	//verifica se o ID inserido existe. Se nao, retorna para a pagina anterior
	if(!mysqli_num_rows($result) > 0){
	   //Id nao encontrado
	   header('location:PHJL-WEB-Pesquisa-alterar-aluno.php');
	   return;
	}
	
?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title> Altera&ccedil;&atilde;o de aluno </title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/bootstrap.css" rel="stylesheet"/>
		<link href="Rodape-Web/gerencia-web-estilos-rodape.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="PHJL-WEB-Estilo-paginas.css">
		<!-- Arquivos js -->
		<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Formulario-de-alteracao-de-alunos.js" defer></script>

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		<link href="css/nucleo-icons.css" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>

    <!-- Essa classe é necessária para que quando o menu fique responsivo ele não sobreponha o formulário -->
    <div class="wrapper">     

        <div class="section landing-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">

                        <h2 class="text-center">ALTERA&Ccedil&Atilde;O DE ALUNO</h2>

                        <form class = "contact-form" method = "POST" action = "PHJL-WEB-Insercao-de-alteracao-no-BD.php?idcpf=<?php echo CPF; ?>" id="formulario" enctype="multipart/form-data" >
                            <div class="row">
                                <label class="fonteTexto">Nome:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-circle-10"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Nome" required="required" name = "entradaNome" id = "entradaNomeID"
									value = "<?php 
										echo "$linha[2]";  
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Sexo:</label>
                            </div>
                                <div class="input-group">
                                    <input class="form-check-input"  type = "radio" name = "entradaSexo" id = "entradaSexoID" value = "Feminino" 
										<?php 
											if($linha[3] == "Feminino"){ 
												echo "checked"; 
											} 
										?> 
									>Feminino<br>     
									<input class="form-check-input" type = "radio" name = "entradaSexo" id = "entradaSexoID" value = "Masculino" 
										<?php 
											if($linha[3] == "Masculino"){ 
												echo "checked"; 
											} 
										?> 
									>
									Masculino
                                </div>

                            <div class="row">
                                <label class="fonteTexto">Data de Nascimento:</label>
                                <div class='input-group'>                                         
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                    <input type='date' class="form-control" name = "entradaNascimento" id = "entradaNascimentoID"
									value = "<?php 
										//Formata a data do padrão d/m/Y para o padrão Y-d-m
										echo date_format(date_create_from_format("d/m/Y", $linha[4]), "Y-m-d");
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">CPF:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-badge"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="000.000.000-00" required="required" name = "entradaCPF" 
									id = "entradaCPFID" onkeypress = "colocaPonto(0)" pattern = "([0-9]{3}[\.]?){3}[-]?[0-9]{2}" title = "000.000.000-00"
									value = "<?php
										echo "$linha[0]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Logradouro:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-map-big"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Logradouro" required="required" name = "entradaLogradouro" id = "entradaLogradouroID"
									value = "<?php
										echo "$linha[5]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">N&uacute;mero:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-check-2"></i>
                                    </span>
                                    <input type="number" class="form-control" placeholder="0" required="required" name = "entradaNumero" id = "entradaNumeroID"
									value = "<?php
										echo "$linha[6]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Complemento:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-shop"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Complemento" required="required" name = "entradaComplemento" id = "entradaComplementoID"
									value = "<?php
										echo "$linha[7]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Bairro:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-globe-2"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Bairro" required="required" name = "entradaBairro" id = "entradaBairroID"
									value = "<?php
										echo "$linha[8]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Cidade:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-globe"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Cidade" required="required" name = "entradaCidade" id = "entradaCidadeID"
									value = "<?php
										echo "$linha[9]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">CEP:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-compass-05"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="00000-000" required="required" name = "entradaCEP" 
									id = "entradaCEPID" onkeypress = "colocaPonto(1)" pattern = "[0-9]{5}[-]?[0-9]{3}" title = "00000-000"
									value = "<?php
										echo "$linha[10]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Adicionar UF:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-world-2"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="UF" required="required" name = "entradaUF" id = "entradaUFID"
									pattern = "[A-Z]{2}" title = "Apenas 2 caracteres maiúsculos"
									value = "<?php
										echo "$linha[11]";
									?>">
                                </div>
                            </div>    

                            <div class="row">
                                <label class="fonteTexto">E-mail:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-email-85"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="email" required="required" name = "entradaEmail" id = "entradaEmailID"
									value = "<?php
										echo "$linha[12]";
									?>">
                                </div>
                            </div>     

                            <div class="row">
                                <label class="fonteTexto">Insira uma foto:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-image"></i>
                                    </span>
                                    <input type="file" class="form-control" id='entradaFotoID' name = "entradaFoto">
                                </div>
                            </div>

                            <div class="row" >
                                <label class="fonteTexto">Campus</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-image"></i>
                                    </span>
                                    <select class="form-control" name="entradaCampus" class="form-control" onchange = 'mostrarSelects("campi", this.value)' 
									id = "entradaCampusID" required>
										<option disabled selected value = ""> Selecione um Campus </option>
                                        <?php
											$sql = "SELECT * FROM campi";
											$result = mysqli_query($conn, $sql);
											while($linhaCampus2 = mysqli_fetch_array($result)){
												if($linhaCampus2[0] == $linhaCampus[0]){
													echo "<option value = " .$linhaCampus2[0] ." selected>" .$linhaCampus2[1] ."</option>";
												}else{
													echo "<option value = " .$linhaCampus2[0] .">" .$linhaCampus2[1] ."</option>";
												}
											}
										?>
									</select>
                                </div>
                            </div> 
							
							<div class="row" id = "entradaDeptoDIVID">
                                <label class="fonteTexto">Departamento</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-image"></i>
                                    </span>
                                    <select class="form-control" name="entradaDepto" class="form-control" onchange = 'mostrarSelects("deptos", this.value)' 
									id = "entradaDeptoID" required>
										<option disabled selected value = ""> Selecione um Departamento </option>
                                        <?php
											$sql = "SELECT * FROM deptos WHERE idCampi = " .$linhaCampus[0];
											$result = mysqli_query($conn, $sql);
											while($linhaDepto2 = mysqli_fetch_array($result)){
												if($linhaDepto2[0] == $linhaDepto[0]){
													echo "<option value = " .$linhaDepto2[0] ." selected>" .$linhaDepto2[2] ."</option>";
												}else{
													echo "<option value = " .$linhaDepto2[0] .">" .$linhaDepto2[2] ."</option>";
												}
											}
										?>
									</select>
                                </div>
                            </div> 
							
							<div class="row" id = "entradaCursoDIVID">
                                <label class="fonteTexto">Curso</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-image"></i>
                                    </span>
                                    <select class="form-control" name="entradaCurso" class="form-control" onchange = 'mostrarSelects("cursos", this.value)' 
									id = "entradaCursoID" required>
										<option disabled selected value = ""> Selecione um Curso </option>
                                        <?php
											$sql = "SELECT * FROM cursos WHERE idDepto = " .$linhaDepto[0];
											$result = mysqli_query($conn, $sql);
											while($linhaCurso2 = mysqli_fetch_array($result)){
												if($linhaCurso2[0] == $linhaCurso[0]){
													echo "<option value = " .$linhaCurso2[0] ." selected>" .$linhaCurso2[2] ."</option>";
												}else{
													echo "<option value = " .$linhaCurso2[0] .">" .$linhaCurso2[2] ."</option>";
												}
											}
										?>
									</select>
                                </div>
                            </div> 
							
							<div class="row" id = "entradaTurmaDIVID">
                                <label class="fonteTexto">Turma</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-image"></i>
                                    </span>
                                    <select class="form-control" name="entradaTurma" class="form-control" id = "entradaTurmaID" required>
										<option disabled selected value = ""> Selecione uma Turma </option>
                                        <?php
											$sql = "SELECT * FROM turmas WHERE idCurso = " .$linhaCurso[0];
											$result = mysqli_query($conn, $sql);
											while($linhaTurma2 = mysqli_fetch_array($result)){
												$sql = "SELECT * FROM cursos WHERE id = " .$linhaTurma2[1];
												$resultCurso = mysqli_query($conn, $sql);
												$linhaCursos = mysqli_fetch_array($resultCurso);
												
												if($linhaTurma2[4] == 'S'){
													if($linhaTurma2[0] == $linhaTurma[0]){
														
														if($linhaCursos[4] == utf8_decode("Técnico Integrado")){
															echo "<option value = " .$linhaTurma2[0] ." selected>" .substr_replace($linhaTurma2[3],$linhaTurma2[2],strlen($linhaTurma2[3]) - 1,0) ."</option>";
														}elseif($linhaCursos[4] == utf8_decode("Graduação")){
															echo "<option value = " .$linhaTurma2[0] ." selected>" .$linhaTurma2[3] ." " .$linhaTurma2[2] ."</option>";
														}
													}else{
														echo "<option value = " .$linhaTurma2[0] .">" .substr_replace($linhaTurma2[3],$linhaTurma2[2],strlen($linhaTurma2[3]) - 1,0) ."</option>";
													}
												}
											}
										?>
									</select>
                                </div>
                            </div> 
							
                            <div class="row">	
                                <div class="col-md-4 ml-auto mr-auto">
									<button type="submit" class="btn btn-info btn-round">Alterar Aluno</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>  
    </div> 
	</body>
	
</html>