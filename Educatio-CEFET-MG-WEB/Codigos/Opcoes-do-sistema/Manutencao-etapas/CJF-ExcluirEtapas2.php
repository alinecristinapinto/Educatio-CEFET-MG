<?php

printf("<!DOCTYPE html>
<html>
<head>
	<title>Manutenção de Etapas - Exclusão</title>
  	<meta charset='utf-8'>
  	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
  	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
  	<link href='https://fonts.googleapis.com/css?family=Abel|Inconsolata' rel='stylesheet'>

	<!-- CSS do Bootstrap -->
	<link href='../../../Estaticos/Bootstrap/css/bootstrap.min.css' rel='stylesheet' />
	<link href='../../../Estaticos/Bootstrap/css/bootstrap.css' rel='stylesheet'/>

	<!-- CSS do grupo -->
	<link href='CJF-web-estilos.css' rel='stylesheet' type='text/css' >

	<!-- Arquivos js -->
	<script src='../../../Estaticos/Bootstrap/js/popper.js'></script>
	<script src='../../../Estaticos/Bootstrap/js/jquery-3.2.1.js' type='text/javascript'></script>
	<script src='../../../Estaticos/Bootstrap/js/bootstrap.min.js' type='text/javascript'></script>

	<!-- Fontes e icones -->
	<link href='../../../Estaticos/Bootstrap/css/nucleo-icons.css' rel='stylesheet'>	
</head>
<body>

		<div class='container'>
			<div class='row'>
				<div class='col-md-8 ml-auto mr-auto'>
					<h2 class='text-center'>");

if (isset($_POST['etapa'])) {

	$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
	if (!$sqlConexao) {
		echo "Falha na conexao com o Banco de Dados!";
		exit;
	}

	$intId = $_POST['etapa'];

	//pesquisa se a etapa existe;
	$sqlSql = "SELECT idOrdem FROM etapas WHERE ativo='S'";
	$sqlResultado = $sqlConexao->query($sqlSql);
	$arrayDados = array();
	$intContador = 0;
	while ($genAux = $sqlResultado->fetch_assoc()) {
		if ($intId == $genAux['idOrdem']) {
			$intContador++;
			break;
		}
	}

	if ($intContador == 0) {
		echo "Etapa Inexistente!<br></br><form method='post' action='CJF-ExcluirEtapas1.php'>
				<input class='btn btn-info btn-round' type='submit' value='Excluir Outra'>
			  </form>";
			printf("		</h>		
				</div>
			</div>
		</div>				

</body>
</html>");

			exit;
	}

	//confere se existe algo vinculado a etapa;
	$intContador = 0;
	$sqlSql = "SELECT id FROM conteudos WHERE idEtapa='$intId'";
	$sqlResultado = $sqlConexao->query($sqlSql);
	while ($genAux = $sqlResultado->fetch_assoc()) {
		$intContador++;
		break;
	}

	if ($intContador != 0) {
		echo "Impossível excluir: etapa vinculada a conteúdo(s)!<br></br><form method='post' action='CJF-ExcluirEtapas1.php'>
				<input class='btn btn-info btn-round' type='submit' value='Excluir Outra'>
			  </form>";
			printf("		</h>		
				</div>
			</div>
		</div>				
	</div>
</body>
</html>");

			exit;
	}


	$sqlSql = "UPDATE etapas SET ativo='N' WHERE idOrdem='".$intId."'";
	

	$resultado = $sqlConexao->query($sqlSql);
	if ($resultado) {
			echo"Exclusão efetuada com sucesso!";
	} else {
		echo"Erro ao excluir etapa!";
	}
	echo "<br></br><form method='post' action='CJF-ExcluirEtapas1.php'>
			<input class='btn btn-info btn-round' type='submit' value='Excluir Outra'>
		  </form>";
} else {

	printf("<div class='alert alert-info' role='alert'>
 					 Falha ao processar sua requisição! <a href='CJF-ExcluirEtapas1.php' class='alert-link'>Tentar novamente</a>. 
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
printf("		</h>		
				</div>
			</div>
		</div>				
	</div>
</body>
</html>");
?>
