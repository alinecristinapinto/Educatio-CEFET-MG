<!DOCTYPE html>

<?php

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

	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM turmas";
	$resultTurma = mysqli_query($conn,$sql);
	

	//verifica se o ID inserido existe. Se nao, retorna para a pagina anterior
	if(!mysqli_num_rows($result) > 0){
	   //Id nao encontrado
	   header('location:PHJL-WEB-Pesquisa-alterar-aluno.php');
	}
	
	$linha = mysqli_fetch_array($result);
	
	//verifica se o ativo do aluno é N, se sim volta para a pagina anterior
	if($linha[15] == 'N'){
		header('location:PHJL-WEB-Pesquisa-alterar-aluno.php');
	}
?>

<html>
	<head>
	
		<meta charset = "UTF-8">

		<!-- TITULO DA PAGINA -->
		<title> Pedido de alteracao de dados</title>
		<link rel="shortcut icon" href="imagens/logo.png">		
		
		<!-- STYLES -->
		<link ​ href = "css/bootstrap.css"​ ​ rel = "stylesheet">
		<link ​ href = "PHJL-WEB-Formulario-de-insercao-de-aluno.css"​ ​ rel = "stylesheet">

		<!-- SCRIPTS -->
		<script src="js/jquery.min.js" defer></script>
		<script src="PHJL-WEB-Formulario-de-insercao-de-alunos.js" defer></script>
		<script src="js/bootstrap.min.js" defer></script>
	
	</head>
	
	<body>
		<div class="TamanhoDoFormulario">
			<div class="TituloDaPagina">
				<h1 > ALTERACAO DOS DADOS</h1>
			</div>
				
			<!-- formulario para alteracao dos dados de aluno -->
			<!-- Observe que os campos possuem codigos php dentro. 
			Eles sao utilizados para buscar os dados do BD e fazer algo com eles 
			(nao encontrei outra maneira melhor de fazer isso) -->
			<form method = "POST" action = "PHJL-WEB-Insercao-de-alteracao-no-BD.php?idcpf=<?php echo CPF; ?>" id="formulario" enctype="multipart/form-data" >

				<!-- Esta classe eh utilizada para que o div fique formatado -->
				<section class = "TamanhoDosCampos" id = "DIVentradaNomeID">
					<!-- A label eh utilizada para que o texto fique formatado -->
					<span> Nome</span>
					<input name = "entradaNome" id = "entradaNomeID" class="form-control" placeholder = "Digite o nome" onblur = "checaNome()"
					value = "<?php 
							echo "$linha[2]";  
						?>">
					<span id="Obrigatorio1" class="corSpan"></span>
					<p>	
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaSexoID">
					<span> Sexo</span><br>
						<input  type = "radio" name = "entradaSexo" id = "entradaSexoID" value = "Feminino" 
							<?php 
								if($linha[3] == "Feminino"){ 
									echo "checked"; 
								} 
							?> 
						>Feminino     
					<input type = "radio" name = "entradaSexo" id = "entradaSexoID" value = "Masculino" 
						<?php 
							if($linha[3] == "Masculino"){ 
								echo "checked"; 
							} 
						?> 
					>
					Masculino

				</section>
				
				<section class = "TamanhoDosCampos" id = "DIVentradaNascimentoID">
					<br>
					<span> Data de nascimento </span>
					<input type = "date" class = "form-control" name = "entradaNascimento" id = "entradaNascimentoID" onblur = "checaNascimento()" 
					value = "<?php 
						echo "$linha[4]";
					?>">
					<span id="Obrigatorio2" class="corSpan"></span>
					<p>	
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaCPFID">
					<span> CPF</span>
					<input type = "text" class = "form-control" name = "entradaCPF" id = "entradaCPFID" placeholder = "Apenas numeros" onblur = "checaCPF()" onkeypress = "colocaPonto(0)"
					value = "<?php
							echo "$linha[0]";
						?>">
					<span id="Obrigatorio3" class="corSpan"></span>
				    <p>	
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaLogradouroID">
					<span>Logradouro </span>
					<input type = "text" class = "form-control" name = "entradaLogradouro" id = "entradaLogradouroID" placeholder = "Digite o Logradouro" 
					onblur = "checaLogradouro()"
					value = "<?php
						echo "$linha[5]";
					?>">
					<span id="Obrigatorio4" class="corSpan"></span>
		            <p>			
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaNumeroID">
					<span> Número </span>
					<input type = "number" class = "form-control" name = "entradaNumero" id = "entradaNumeroID" placeholder = "Digite o numero" 
					onblur = "checaNumero()"
					value = "<?php
						echo "$linha[6]";
					?>">
					<span id="Obrigatorio5" class="corSpan"></span>
					<p>	
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaComplementoID">
					<span> Complemento </span>
					<input type = "text" class = "form-control" name = "entradaComplemento" id = "entradaComplementoID" 
					placeholder = "Digite o complemento" onblur = "checaComplemento()"
					value = "<?php
						echo "$linha[7]";
					?>">
					<span id="Obrigatorio6" class="corSpan"></span>
				    <p>	
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaBairroID">
					<span> Bairro </span>
					<input type = "text" class = "form-control" name = "entradaBairro" id = "entradaBairroID" placeholder = "Digite o bairro" 
					onblur = "checaBairro()"
					value = "<?php
						echo "$linha[8]";
					?>">
					<span id="Obrigatorio7" class="corSpan"></span>
				    <p>	
				</section>
				
				<section class = "TamanhoDosCampos" id = "DIVentradaCidadeID">
					<span> Cidade </span>
					<input type = "text" class = "form-control" name = "entradaCidade" id = "entradaCidadeID" placeholder = "Digite a cidade" 
					onblur = "checaCidade()"
					value = "<?php
						echo "$linha[9]";
					?>">
					<span id="Obrigatorio8" class="corSpan"></span>
					<p>	
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaCEPID">
					<span> CEP </span>
					<input type = "text" class = "form-control" name = "entradaCEP" id = "entradaCEPID" placeholder = "Apenas numeros" 
					onblur = "checaCEP()" onkeypress = "colocaPonto(1)"
					value = "<?php
						echo "$linha[10]";
					?>">
					<span id="Obrigatorio9" class="corSpan"></span>
					<p>
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaUFID">
					<span> UF </span>
					<input type = "text" class = "form-control" name = "entradaUF" id = "entradaUFID" placeholder = "Digite a UF" onblur = "checaUF()"
					value = "<?php
						echo "$linha[11]";
					?>">
					<span id="Obrigatorio10" class="corSpan"></span>
					<p>	
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaEmailID">
					<span> E-mail </span>
					<input type = "email" class = "form-control" name = "entradaEmail" id = "entradaEmailID" placeholder = "exemplo@email.com" 
					onblur = "checaEmail()"
					value = "<?php
						echo "$linha[12]";
					?>">
					<span id="Obrigatorio11" class="corSpan"></span>
					<p>
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaFotoID">
					<span>Insira uma foto </span>
					<br>
					<label for='entradaFotoID'>Selecionar um arquivo</label>
					<input id='entradaFotoID' name = "entradaFoto" type='file' on="putFoto()">
					<p>			
				</section>

				<section class = "TamanhoDosCampos" id = "DIVentradaTurmaID">
						<span> Escolha a turma </span>
						<br>
						<select name="entradaTurma" class="form-control">
							<?php
								while($linhaTurma = mysqli_fetch_array($resultTurma)){
									if($linhaTurma[3] == 'S'){
										//Verifica qual é a turma atual do aluno
										if($linhaTurma[0] == $linha[1]){
											echo "<option value='$linhaTurma[0]' selected>$linhaTurma[2]</option>";
										}else{
											echo "<option value='$linhaTurma[0]'>$linhaTurma[2]</option>";
										}
									}
								}
							?>
						</select>
						<p>
				</section>
					
				<section class = "TamanhoDosCampos" >
					<button type = "submit" id="Botaoenviar" style="margin-left: 110%" class = "btn btn-primary" onclick = "filtraDados()" >Enviar</button> 
				</section>
				<p>
			</form>
		</div>
			
	</body>
	
</html>