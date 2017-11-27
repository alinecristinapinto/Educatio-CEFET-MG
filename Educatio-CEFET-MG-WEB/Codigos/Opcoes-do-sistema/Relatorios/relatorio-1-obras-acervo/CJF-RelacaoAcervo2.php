<?php

printf(" 
	<html>
	<head>
	<title>Relação Acervo</title>
  	<meta charset='utf-8'>
  	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
  	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
  	<link href='https://fonts.googleapis.com/css?family=Abel|Inconsolata' rel='stylesheet'>

	<!-- CSS do Bootstrap -->
	<link href='../../../../Estaticos/Bootstrap/css/bootstrap.min.css' rel='stylesheet'/>
	<link href='../../../../Estaticos/Bootstrap/css/bootstrap.css' rel='stylesheet'/>

	<!-- CSS do grupo -->
	<link href='../css/CJF-web-estilos.css' rel='stylesheet' type='text/css' >

	<!-- Arquivos js -->
	<script src='../../../../Estaticos/Bootstrap/js/popper.js'></script>
	<script src='../../../../Estaticos/Bootstrap/js/jquery-3.2.1.js' type='text/javascript'></script>
	<script src='../../../../Estaticos/Bootstrap/js/bootstrap.min.js' type='text/javascript'></script>

	<!-- Fontes e icones -->
	<link href='../../../../Estaticos/Bootstrap/css/nucleo-icons.css' rel='stylesheet'>
</head>
<body>

		<div class='container'>
			<div class='row'>                                                                             
				<div>
					<h2 class='text-center'>Relação Acervo</h2><br>
						<div class='col-md-6'>");

if (isset($_POST['acervo'])) {

	session_start();

	$_SESSION['acervo'] = $_POST['acervo'];

	$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");

	if (!$sqlConexao) {
		echo "Falha na conexao com o Banco de Dados!";
		exit;
	}
	//relatorio midias
	if ($_POST['acervo'] == "Mídias") {

		//procura os dadose os salva em um array
		$arrayDados = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM acervo WHERE tipo='Midia'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['idAcervo'] = $genAux['id'];
				$arrayDados[$intContador]['idCampi'] = $genAux['idCampi'];
				$arrayDados[$intContador]['local'] = $genAux['local'];
				$arrayDados[$intContador]['ano'] = $genAux['ano'];
				$arrayDados[$intContador]['nome'] = $genAux['nome'];
				$intContador++;
			}
		}

		$arrayAutores = array();
		$intContador = 0;
		$intAutorestotais = 0;
		foreach ($arrayDados as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$intContador2 = 0;
			$sqlSql = "SELECT idAutor FROM autoracervo WHERE idAcervo='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			while($genAux = $sqlResultado->fetch_assoc()) {
				$arrayAutores[$intIdacervo][$intContador2] = $genAux['idAutor'];
				$intContador++;
				$intContador2++;
				if ($intAutorestotais < $intContador2) {
					$intAutorestotais++;
				}
			}
			
		}



		$intContador = 0;
		foreach ($arrayAutores as $key => $valor) {
			for ($intI = 0; $intI < $intAutorestotais; $intI++) {
				if (isset($valor[$intI])) {
					$intIdautor = $valor[$intI];
					$sqlSql = "SELECT nome, sobrenome FROM autores WHERE id='$intIdautor'";
					$sqlResultado = $sqlConexao->query($sqlSql);
					$genAux = $sqlResultado->fetch_assoc();
					$arrayAutores[$key][$intI] = $genAux['nome']." ".$genAux['sobrenome'];
				}
			}
			$intContador++;
		}

		$intContador = 0;

		foreach ($arrayDados as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT * FROM midias WHERE idAcervo='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['tempo'] = $genAux['tempo'];
			$arrayDados[$intContador]['subtipo'] = $genAux['subtipo'];
			$arrayDados[$intContador]['idObra'] = $genAux['id'];
			$intContador++;
		}

		// nada encontrado...
		if ($arrayDados == null) {
			printf("<div class='alert alert-info' role='alert'>
 					 Nenhum livro encontrado no sistema! <a href='../../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarObrasAcervo' class='alert-link'>Tentar novamente</a>. 
							</div>
						</div>
					</div>	
				</div>
			</div>	
		</div>				
					
</body>
</html>");
		exit;
		}


		//exibe os dados em uma tabela
		echo "<table class='table table-hover'>
		<tr>
		<th>Id da Obra</th>
		<th>Id no Acervo</th>
		<th white-space: nowrap>Nome Da Obra</th>
		<th> Autor </th>
		<th> Campi </th>
		<th> Local </th>
		<th> Ano </th>
		<th> Tempo </th>
		<th>Subtipo</th>
		</tr>";
		foreach ($arrayDados as $valor) {
			$intContador = 0;
			echo utf8_encode("<tr>
			<td>".$valor['idObra']."</td>
			<td>".$valor['idAcervo']."</td>
			<td>".$valor['nome']."</td><td >");
			for ($intI = 0; $intI < $intAutorestotais; $intI++) {
				if (isset($arrayAutores[$valor['idAcervo']][$intI])) {
					if ($intContador != 0) {
						echo ", ";
					}
					echo utf8_encode($arrayAutores[$valor['idAcervo']][$intI]);
					$intContador++;
				}
			}
			echo
			utf8_encode("</td><td>".$valor['idCampi']."</td>
			<td>".$valor['local']."</td>
			<td>".$valor['ano']."</td>
			<td>".$valor['tempo']."</td>
			<td>".$valor['subtipo']."</td>
			</tr>");		
		}
		echo "</table>";

		$_SESSION['arrayAutores'] = $arrayAutores;
		$_SESSION['autoresTotais'] = $intAutorestotais;
		$_SESSION['arrayDados'] = $arrayDados;

//____________________________________________________________________________________________________________________________________________-
	//relatorio livros
	} else if ($_POST['acervo'] == "Livros") {


		//procura os dados e os salva em um array
		$arrayDados = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM acervo WHERE tipo='Livro'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['idAcervo'] = $genAux['id'];
				$arrayDados[$intContador]['idCampi'] = $genAux['idCampi']; 
				$arrayDados[$intContador]['local'] = $genAux['local'];
				$arrayDados[$intContador]['ano'] = $genAux['ano']; 
				$arrayDados[$intContador]['editora'] = $genAux['editora']; 
				$arrayDados[$intContador]['paginas'] = $genAux['paginas']; 
				$arrayDados[$intContador]['nome'] = $genAux['nome'];
				$intContador++;
			}
		}

		$intContador = 0;

		foreach ($arrayDados as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT * FROM livros WHERE idAcervo='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['idObra'] = $genAux['id'];
			$arrayDados[$intContador]['ISBN'] = $genAux['ISBN'];
			$arrayDados[$intContador]['edicao'] = $genAux['edicao'];
			$intContador++;
		}

		

		$arrayAutores = array();
		$intContador = 0;
		$intAutorestotais = 0;
		foreach ($arrayDados as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$intContador2 = 0;
			$sqlSql = "SELECT idAutor FROM autoracervo WHERE idAcervo='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			while($genAux = $sqlResultado->fetch_assoc()) {
				$arrayAutores[$intIdacervo][$intContador2] = $genAux['idAutor'];
				$intContador++;
				$intContador2++;
				if ($intAutorestotais < $intContador2) {
					$intAutorestotais++;
				}
			}
			
		}



		$intContador = 0;
		foreach ($arrayAutores as $key => $valor) {
			for ($intI = 0; $intI < $intAutorestotais; $intI++) {
				if (isset($valor[$intI])) {
					$intIdautor = $valor[$intI];
					$sqlSql = "SELECT nome, sobrenome FROM autores WHERE id='$intIdautor'";
					$sqlResultado = $sqlConexao->query($sqlSql);
					$genAux = $sqlResultado->fetch_assoc();
					$arrayAutores[$key][$intI] = $genAux['nome']." ".$genAux['sobrenome'];
				}
			}
			$intContador++;
		}

		//nada encontrado...
		if ($arrayDados == null) {
			printf("<div class='alert alert-info' role='alert'>
 					 Nenhum livro encontrado no sistema! <a href='../../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarObrasAcervo' class='alert-link'>Tentar novamente</a>. 
							</div>
						</div>
					</div>	
				</div>
			</div>	
		</div>				
					
</body>
</html>");
		exit;
		}


		//exibe os dados em uma tabela
		echo "<table class='table table-hover'>
		<tr>
		<th>Id da Obra</th>
		<th>Id no Acervo</th
		><th white-space: nowrap>Nome da obra</th>
		<th> Autores </th>
		<th> Campi </th>
		<th> Local </th>
		<th> Ano </th>
		<th>Editora</th>
		<th> ISBN </th>
		<th>Edicao</th>
		<th>Paginas</th>
		</tr>";
		foreach ($arrayDados as $valor) {
			$intContador = 0;
			echo utf8_encode("<tr>
			<td>".$valor['idObra']."</td>
			<td>".$valor['idAcervo']."</td>
			<td>".$valor['nome']."</td><td white-space: nowrap>");
			for ($intI = 0; $intI < $intAutorestotais; $intI++) {
				if (isset($arrayAutores[$valor['idAcervo']][$intI])) {
					if ($intContador != 0) {
						echo ",<br></br>";
					}
					echo utf8_encode($arrayAutores[$valor['idAcervo']][$intI]);
					$intContador++;
				}
			}
			echo
			utf8_encode("</td><td>".$valor['idCampi']."</td>
			<td>".$valor['local']."</td>
			<td>".$valor['ano']."</td>
			<td>".$valor['editora']."</td>
			<td>".$valor['ISBN']."</td>
			<td>".$valor['edicao']."</td>
			<td>".$valor['paginas']."</td>
			</tr>");		
		}
		echo "</table>";

		$_SESSION['arrayAutores'] = $arrayAutores;
		$_SESSION['autoresTotais'] = $intAutorestotais;
		$_SESSION['arrayDados'] = $arrayDados;

//____________________________________________________________________________________________________________________________________________-		
	//relatorio periodicos
	} else if ($_POST['acervo'] == "Periódicos") {


		//procura os dados e os salva em um array
		$arrayDados = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM acervo WHERE tipo='Periodico'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['idAcervo'] = $genAux['id'];
				$arrayDados[$intContador]['idCampi'] = $genAux['idCampi'];
				$arrayDados[$intContador]['local'] = $genAux['local'];
				$arrayDados[$intContador]['ano'] = $genAux['ano']; 
				$arrayDados[$intContador]['editora'] = $genAux['editora']; 
				$arrayDados[$intContador]['nome'] = $genAux['nome'];
				$intContador++;
			}
		}


		$intContador = 0;

		foreach ($arrayDados as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT * FROM periodicos WHERE idAcervo='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['periodicidade'] = $genAux['periodicidade'];
			$arrayDados[$intContador]['subtipo'] = $genAux['subtipo'];
			$arrayDados[$intContador]['idObra'] = $genAux['id'];
			$arrayDados[$intContador]['mes'] = $genAux['mes'];
			$arrayDados[$intContador]['volume'] = $genAux['volume'];
			$arrayDados[$intContador]['ISSN'] = $genAux['ISSN'];
			$intContador++;
		}


		$arrayPartes = array();
		$intContador = 0;
		$intPartestotais = 0;
		foreach ($arrayDados as $valor) {
			$intIdperiodico = $valor['idObra'];
			$intContador2 = 0;
			$sqlSql = "SELECT titulo FROM partes WHERE idPeriodico='$intIdperiodico'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			while($genAux = $sqlResultado->fetch_assoc()) {
				$arrayPartes[$intIdperiodico][$intContador2] = $genAux['titulo'];
				$intContador++;
				$intContador2++;
				if ($intPartestotais < $intContador2) {
					$intPartestotais++;
				}
			}
			
		}

		//nada encontrado...
		if ($arrayDados == null) {
			printf("<div class='alert alert-info' role='alert'>
 					 Nenhum periódico encontrado no sistema! <a href='../../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarObrasAcervo' class='alert-link'>Tentar novamente</a>. 
							</div>
						</div>
					</div>	
				</div>
			</div>	
		</div>				
					
</body>
</html>");
		exit;

		}



		//exibe os dados em uma tabela
		echo "<table class='table table-hover'>
		<tr>
		<th>Id da Obra</th>
		<th>Id no Acervo</th>
		<th white-space: nowrap>Nome da obra</th>
		<th> Partes </th>
		<th> Campi </th>
		<th> Local </th>
		<th> Ano </th>
		<th>Editora</th>
		<th> Periodicidade </th>
		<th>Subtipo</th>
		<th>Mes</th>
		<th>Volume</th>
		<th>ISSN</th>
		</tr>";
		foreach ($arrayDados as $valor) {
			$intContador = 0;
			echo utf8_encode("<tr>
			<td>".$valor['idObra']."</td>
			<td>".$valor['idAcervo']."</td>
			<td>".$valor['nome']."</td><td>");
			for ($intI = 0; $intI < $intPartestotais; $intI++) {
				if (isset($arrayPartes[$valor['idObra']][$intI])) {
					if ($intContador != 0) {
						echo ", ";
					}
					echo utf8_encode($arrayPartes[$valor['idObra']][$intI]);
					$intContador++;
				}
			}
			echo
			utf8_encode("</td><td>".$valor['idCampi']."</td>
			<td>".$valor['local']."</td>
			<td>".$valor['ano']."</td>
			<td>".$valor['editora']."</td>
			<td>".$valor['periodicidade']."</td>
			<td>".$valor['subtipo']."</td>
			<td>".$valor['mes']."</td>
			<td>".$valor['volume']."</td>
			<td>".$valor['ISSN']."</td>
			</tr>");		
		}
		echo "</table>";

		$_SESSION['arrayPartes'] = $arrayPartes;
		$_SESSION['partesTotais'] = $intPartestotais;
		$_SESSION['arrayDados'] = $arrayDados;

//____________________________________________________________________________________________________________________________________________-
	//relatorio academicos
	} else if ($_POST['acervo'] == "Acadêmicos") {


		//procura os dadose os salva em um array
		$arrayDados = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM acervo WHERE tipo='Academico'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['idAcervo'] = $genAux['id'];
				$arrayDados[$intContador]['idCampi'] = $genAux['idCampi'];
				$arrayDados[$intContador]['local'] = $genAux['local'];
				$arrayDados[$intContador]['ano'] = $genAux['ano']; 
				$arrayDados[$intContador]['nome'] = $genAux['nome'];
				$intContador++;
			}
		}

		$intContador = 0;

		foreach ($arrayDados as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT * FROM academicos WHERE idAcervo='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['idObra'] = $genAux['id'];
			$arrayDados[$intContador]['programa'] = $genAux['programa'];

			$intContador++;
		}

		$arrayAutores = array();
		$intContador = 0;
		$intAutorestotais = 0;
		foreach ($arrayDados as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$intContador2 = 0;
			$sqlSql = "SELECT idAutor FROM autoracervo WHERE idAcervo='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			while($genAux = $sqlResultado->fetch_assoc()) {
				$arrayAutores[$intIdacervo][$intContador2] = $genAux['idAutor'];
				$intContador++;
				$intContador2++;
				if ($intAutorestotais < $intContador2) {
					$intAutorestotais++;
				}
			}
			
		}



		$intContador = 0;
		foreach ($arrayAutores as $key => $valor) {
			for ($intI = 0; $intI < $intAutorestotais; $intI++) {
				if (isset($valor[$intI])) {
					$intIdautor = $valor[$intI];
					$sqlSql = "SELECT nome, sobrenome FROM autores WHERE id='$intIdautor'";
					$sqlResultado = $sqlConexao->query($sqlSql);
					$genAux = $sqlResultado->fetch_assoc();
					$arrayAutores[$key][$intI] = $genAux['nome']." ".$genAux['sobrenome'];
				}
			}
			$intContador++;
		}

		//nada encontrado...
		if ($arrayDados == null) {
			printf("<div class='alert alert-info' role='alert'>
 					 Nenhum acadêmico encontrado no sistema! <a href='../../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarObrasAcervo' class='alert-link'>Tentar novamente</a>. 
							</div>
						</div>
					</div>	
				</div>
			</div>	
		</div>				
					
</body>
</html>");
		exit;
		}


		//exibe os dados em uma tabela
		echo "<table class='table table-hover'>
		<tr>
		<th>Id da Obra</th>
		<th>Id no Acervo</th
		><th white-space: nowrap>Nome da obra</th>
		<th><center>Autor</center></th>
		<th> Campi </th>
		<th> Local </th>
		<th> Ano </th>
		<th>Programa</th>
		</tr>";
		foreach ($arrayDados as $valor) {
			$intContador = 0;
			echo utf8_encode("<tr>
			<td>".$valor['idObra']."</td>
			<td>".$valor['idAcervo']."</td>
			<td>".$valor['nome']."</td><td white-space: nowrap>");
			for ($intI = 0; $intI < $intAutorestotais; $intI++) {
				if (isset($arrayAutores[$valor['idAcervo']][$intI])) {
					if ($intContador != 0) {
						echo ",<br></br>";
					}
					echo utf8_encode($arrayAutores[$valor['idAcervo']][$intI]);
					$intContador++;
				}
			}
			echo
			utf8_encode("</td><td>".$valor['idCampi']."</td>
			<td>".$valor['local']."</td>
			<td>".$valor['ano']."</td>
			<td>".$valor['programa']."</td>
			</tr>");		
		}
		echo "</table>";

		$_SESSION['arrayAutores'] = $arrayAutores;
		$_SESSION['autoresTotais'] = $intAutorestotais;
		$_SESSION['arrayDados'] = $arrayDados;
		
	}

	echo 	"<form method='post' action='CJF-RelacaoAcervoImpressao.php'>
			<input class='btn btn-info btn-round' type='submit' value='Download'>
			</form>";

//nada encontrado...
} else {
	printf("<div class='alert alert-info' role='alert'>
 					 Nenhum empréstimo encontrado no sistema! <a href='../../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarObrasAcervo' class='alert-link'>Tentar novamente</a>. 
							</div>
						</div>
					</div>	
				</div>
			</div>	
		</div>				
					
</body>
</html>");
		exit;
}

printf("		
				</div>
			</div>
		</div>				
					
</body>
</html>");
?>