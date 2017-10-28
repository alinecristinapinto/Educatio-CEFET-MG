<!DOCTYPE html>
<?php
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	
	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);
	
	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM turmas";
	$result = mysqli_query($conn,$sql);
?>
<html>

	<head>

		<meta charset="utf-8">

		<!-- TITULO E LOGO DA PAGINA  -->
		<title>Cadastrar Aluno</title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<link rel="stylesheet" type="text/css" href="css/bootstrap">
		<link href="Rodape-Web/gerencia-web-estilos-rodape.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="PHJL-WEB-Formulario-de-insercao-de-aluno.css">

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="PHJL-WEB-Formulario-de-insercao-de-alunos.js" defer></script>

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">

	</head>

	<body>

		<div class="TamanhoDoFormulario">
			<div class="TituloDaPagina">
				<h1> CADASTRO DE ALUNO</h1>
			</div>
			<!-- formulario para insercao dos dados de aluno -->
			<form method = "POST" action = "PHJL-WEB-Insercao-de-aluno-no-BD.php" id= "formulario" enctype= "multipart/form-data" >

				<!-- Esta classe eh utilizada para que o div fique formatado -->
				<section class = "TamanhoDosCampos" id = "DIVentradaNomeID">
					<span> Nome</span>
					<input type = "text" class = "form-control" name = "entradaNome" id = "entradaNomeID" placeholder = "Digite o nome" onblur = "checaNome()">
					<span id="Obrigatorio1" class="corSpan"></span>
					<p>
				</section>

				<section id = "DIVentradaSexoID" class="TamanhoDosCampos">
					<span> Sexo</span><br>
					<input type = "radio" name = "entradaSexo" id = "entradaSexoID" value = "Feminino" >Feminino		
					<input type = "radio" name = "entradaSexo" id = "entradaSexoID" value = "Masculino" >Masculino
					<p>
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaNascimentoID">
					<span> Data de nascimento </span>
					<input type = "date" class = "form-control" name = "entradaNascimento" id = "entradaNascimentoID" onblur = "checaNascimento()">
					<span id="Obrigatorio2" class="corSpan"></span>
					<p>
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaCPFID">
					<span> CPF</span>
					<input type = "text" class = "form-control" name = "entradaCPF" id = "entradaCPFID" placeholder = "Apenas numeros" onblur = "checaCPF()" onkeypress = "colocaPonto(0)">
					<span id="Obrigatorio3" class="corSpan"></span>
					<p>
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaLogradouroID">
					<span> Logradouro </span>
					<input type = "text" class = "form-control" name = "entradaLogradouro" id = "entradaLogradouroID" placeholder = "Digite o Logradouro" onblur = "checaLogradouro()">
					<span id="Obrigatorio4" class="corSpan"></span>
					<p>
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaNumeroID">
					<span> Número </span>
					<input type = "number" class = "form-control" name = "entradaNumero" id = "entradaNumeroID" placeholder = "Digite o numero" onblur = "checaNumero()">
					<span id="Obrigatorio5" class="corSpan"></span>
					<p>
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaComplementoID">
					<span> Complemento </span>
					<input type = "text" class = "form-control" name = "entradaComplemento" id = "entradaComplementoID" placeholder = "Digite o complemento" onblur = "checaComplemento()">
					<span id="Obrigatorio6" class="corSpan"></span>
					<p>
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaBairroID">
					<span> Bairro </span>
					<input type = "text" class = "form-control" name = "entradaBairro" id = "entradaBairroID" placeholder = "Digite o bairro" onblur = "checaBairro()">
					<span id="Obrigatorio7" class="corSpan"></span>
					<p>
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaCidadeID">
					<span> Cidade </span>
					<input type = "text" class = "form-control" name = "entradaCidade" id = "entradaCidadeID" placeholder = "Digite a cidade" onblur = "checaCidade()">
					<span id="Obrigatorio8" class="corSpan"></span>
					<p>
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaCEPID">
					<span> CEP </span>
					<input type = "text" class = "form-control" name = "entradaCEP" id = "entradaCEPID" placeholder = "Apenas numeros" onblur = "checaCEP()" onkeypress = "colocaPonto(1)">
					<span id="Obrigatorio9" class="corSpan"></span>
					<p>
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaUFID">
					<span> UF </span>
					<input type = "text" class = "form-control" name = "entradaUF" id = "entradaUFID" placeholder = "Digite a UF" onblur = "checaUF()">
					<span id="Obrigatorio10" class="corSpan"></span>
					<p>
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaEmailID">
					<span>E-mail </span>
					<input type = "email" class = "form-control" name = "entradaEmail" id = "entradaEmailID" placeholder = "exemplo@email.com" onblur = "checaEmail()">
					<span id="Obrigatorio11" class="corSpan"></span>
					<p>
				</section>
					
				<section class = "TamanhoDosCampos" id = "DIVentradaFotoID">
					<span>Insira uma foto </span>
					<br>
					<label for='entradaFotoID'>Selecionar um arquivo</label>
					<input id='entradaFotoID' name = "entradaFoto" type='file'>
					<p>			
				</section>

				<section class = "TamanhoDosCampos" id = "DIVentradaTurmaID">
						<span> Escolha a turma </span>
						<br>
						<select name="entradaTurma" class="form-control">
							<?php
								while($linha = mysqli_fetch_array($result)){
									if($linha[3] == 'S'){
										echo "<option value='$linha[0]'>$linha[2]</option>";
									}
								}
							?>
						</select>
						<p>
				</section>
					
				<section class = "TamanhoDosCampos">
					<button type = "submit"  id="saidaBotaoID" class = "btn btn-primary" onclick = "filtraDados()" disabled="disable" >Enviar</button> 
	
				</section>

			</form>			
		  </div>
		  <footer>
		  	<div id="rodape">
				<div class="container">
					<div class="row centralizado">
						<div class="col-md-4">
							<img src="Rodape-Web/prom.jpg" class="img-circle"><br>
							<h6><strong>Desenvolvedores</strong></h6>

							<p></span> Alunos da turma de Informática 2A 2017 do CEFET-MG.
							<a href="#">Clique aqui</a> para saber mais.</p>  
						</div>
						<div class="col-md-4">
				    		<img src="Rodape-Web/cefetop.png" class="img-circle"><br>
				    		<h6><strong>Instituição</strong></h6>
				    		<p>Centro Federal de Educação Tecnológica de Minas Gerais. Av. Amazonas 5253 -Nova                   Suíssa - Belo Horizonte - Brasil.</p>
        				</div>
        				<div class="col-md-4">
            				<img src="Rodape-Web/bootstrap.png" class="img-circle"><br>
            				<h6>Recursos Utilizados</h6>
            				<p>
					    	<a href="https://github.com/NinaCris16/Educatio-CEFET-MG">GitHub</a><br>
					    	<a href="http://getbootstrap.com/">Bootstrap</a><br>
					    	</p>
        				</div>
					</div>
				</div>
			</div>

		  </footer>

	</body>
</html>