<?php

session_start();
ini_set('default_charset','UTF-8');

printf(" 
	<html>
	<head>
	<title>Relação de reservas</title>
  	<meta charset='utf-8'>
  	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
  	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
  	<link href='https://fonts.googleapis.com/css?family=Abel|Inconsolata' rel='stylesheet'>

	<!-- CSS do Bootstrap -->
	<link href='css/bootstrap.min.css' rel='stylesheet'/>
	<link href='css/bootstrap.css' rel='stylesheet'/>

	<!-- CSS do grupo -->
	<link href='CJF-web-estilos.css' rel='stylesheet' type='text/css' >

	<!-- Arquivos js -->
	<script src='js/popper.js'></script>
	<script src='js/jquery-3.2.1.js' type='text/javascript'></script>
	<script src='js/bootstrap.min.js' type='text/javascript'></script>

	<!-- Fontes e icones -->
	<link href='css/nucleo-icons.css' rel='stylesheet'>
</head>
<body>
	<div class='section landing-section'>
		<div class='container'>
			<div class='row'>
				<div class='col-md-8 ml-auto mr-auto'>
					<h2 class='text-center'>Relação de reservas</h2><br>");

if (isset($_POST['data'])) {

	$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");

	if (!$sqlConexao) {
		echo "Falha na conexao com o Banco de Dados!";
		exit;
	}

	//confere se será exibido o relatorio geral;
	if ($_POST['data'] == null) {

		$arrayDados = array();
		$intContador = 0;


		//seleciona os dados das reservas do bd;
		$sqlSql = "SELECT * FROM reservas ORDER BY id";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['id'] = $genAux['id'];
				$arrayDados[$intContador]['idAluno'] = $genAux['idAluno'];
				$arrayDados[$intContador]['idAcervo'] = $genAux['idAcervo'];
				$arrayDados[$intContador]['dataReserva'] = $genAux['dataReserva'];
				$arrayDados[$intContador]['tempoEspera'] = $genAux['tempoEspera'];
				$arrayDados[$intContador]['emprestou'] = $genAux['emprestou'];
				$intContador++;
			}
		}
		
		$intContador = 0;

		foreach ($arrayDados as $valor) {
			$intIdaluno = $valor['idAluno'];
			$sqlSql = "SELECT nome FROM alunos WHERE idCPF='$intIdaluno'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['nomeAluno'] = $genAux['nome'];

			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT nome FROM acervo WHERE id='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['nome'] = $genAux['nome'];

			$intContador++;
		}

		//retorna caixa de texto com "voltar" caso nenhum dado tenha sido encontrado
		if ($arrayDados == null) {
			printf("<div class='alert alert-info' role='alert'>
 					 Nenhuma reserva encontrada nessa data. <a href='CJF-RelacaoReservas1.php' class='alert-link'>Tentar novamente</a>. 
							</div>
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

		//cria a tabela
		echo "<table class='table table-hover'>
		<tr>
		<th>Id da Reserva</th>
		<th>Aluno</th>
		<th>Nome</th>
		<th>Data da Reserva</th>
		<th>Tempo de Espera</th>
		<th>Emprestou</th>
		</tr>";
		foreach ($arrayDados as $valor) {
			echo utf8_encode("<tr>
			<td>".$valor['id']."</td>
			<td>".$valor['nomeAluno']."</td>
			<td>".$valor['nome']."</td>
			<td>".$valor['dataReserva']."</td>
			<td>".$valor['tempoEspera']."</td>
			<td>".$valor['emprestou']."</td>
			</tr>");		
		}
		echo "</table>";

		$_SESSION['data'] = $_POST['data'];
		$_SESSION['arrayDados'] = $arrayDados;

		echo "<form method='post' action='CJF-RelacaoReservasImpressao.php'>
				<input class='btn btn-info btn-round' type='submit' value='Download'>
			  </form>";

	//caso o if anterior tenha sido negado, mostra o relatorio por data;
	} else {

		$dateReserva = $_POST['data'];
		$arrayDados = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM reservas WHERE dataReserva='$dateReserva' ORDER BY id";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['id'] = $genAux['id'];
				$arrayDados[$intContador]['idAluno'] = $genAux['idAluno'];
				$arrayDados[$intContador]['idAcervo'] = $genAux['idAcervo'];
				$arrayDados[$intContador]['dataReserva'] = $genAux['dataReserva'];
				$arrayDados[$intContador]['tempoEspera'] = $genAux['tempoEspera'];
				$arrayDados[$intContador]['emprestou'] = $genAux['emprestou'];
				$intContador++;
			}
		}
		
		$intContador = 0;

		foreach ($arrayDados as $valor) {
			$intIdaluno = $valor['idAluno'];
			$sqlSql = "SELECT nome FROM alunos WHERE idCPF='$intIdaluno'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['nomeAluno'] = $genAux['nome'];

			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT nome FROM acervo WHERE id='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['nome'] = $genAux['nome'];

			$intContador++;
		}

		if ($arrayDados != null) {
			echo "<table class='table table-hover'>
			<tr>
			<th>Id da Reserva</th>
			<th>Aluno</th>
			<th>Nome</th>
			<th>Data da Reserva</th>
			<th>Tempo de Espera</th>
			<th>Emprestou</th>
			</tr>";
			foreach ($arrayDados as $valor) {
				echo utf8_encode("<tr>
				<td>".$valor['id']."</td>
				<td>".$valor['nomeAluno']."</td>
				<td>".$valor['nome']."</td>
				<td>".$valor['dataReserva']."</td>
				<td>".$valor['tempoEspera']."</td>
				<td>".$valor['emprestou']."</td>
				</tr>");		
			}
			echo "</table>";

			$_SESSION['arrayDados'] = $arrayDados;
			$_SESSION['data'] = $_POST['data'];

			echo "<form method='post' action='CJF-RelacaoReservasImpressao.php'>
				<input class='btn btn-info btn-round' type='submit' value='Download'>
			  </form>";

		} else {
			printf(
	"<div class='alert alert-info' role='alert'>
 					 Nenhuma reserva encontrada! <a href='CJF-RelacaoReservas1.php' class='alert-link'>Tentar novamente</a>. 
							</div>
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
		

	}

    

} else {
	printf(
	"<div class='alert alert-info' role='alert'>
 					 Erro: Falha na pesquisa. <a href='CJF-RelacaoReservas1.php' class='alert-link'>Tentar novamente</a>. 
							</div>
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
		</div>					
</body>
</html>");
?>	