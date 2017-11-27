<?php

/*
 * @author
 * @copyright 2017
 */
 header ('Content-type: text/html; charset=ISO-8859-1');

 //Inclui a biblioteca do MPDF
 include("mpdf60/mpdf.php");

 // Cria conexão
 $conn = new mysqli("localhost", "root", "","educatio");

 // Checa conexão
 if ($conn->connect_error) {
     die("Conecção falhou: " . $conn->connect_error);
 }

	//recebe via POST o nome da Obra a ser pesquisado
	if (!empty($_POST["nomeObra"])) {
		$nomeObra = $_POST["nomeObra"];

		//seleciona o ID da obra pelo seu nome
		$stmt = $conn->prepare("SELECT nome, id FROM acervo WHERE nome = ? AND ativo='N'");
		$stmt->bind_param('s', $nomeObra);
		$stmt->execute();
		$rst = $stmt->get_result();
  }
  else{
    //seleciona todos os ID da obra e nomes das obras
		$stmt = "SELECT nome, id FROM acervo WHERE ativo='N'";
		$rst = $conn->query($stmt);
  }
		$numRegistrosAcervo = mysqli_num_rows($rst);

		while($row = $rst->fetch_assoc()){
			//o ID acervo é o id da obra que está no acervo
			$idAcervo[] = $row['id'];
			$nomeAcervo[] = $row['nome'];
		}

		$sql = "SELECT idAcervo, dataDescarte, idFuncionario, motivos FROM descartes";
  	$rst1 = $conn->query($sql);

		$numRegistrosDescarte = mysqli_num_rows($rst1);

			while($row1 = $rst1->fetch_assoc()){
				$idAcervoDescarte[] = $row1['idAcervo'];
				$dataDescarte[] = $row1['dataDescarte'];
				$idFuncionario[] = $row1['idFuncionario'];
				$motivos[] = $row1['motivos'];
			}

		 $k = 0;

		  for ($i=0; $i < $numRegistrosDescarte ; $i++) {
		  	for ($j=0; $j < $numRegistrosAcervo ; $j++) {
		  		if ($idAcervo[$j] == $idAcervoDescarte[$i]) {
		  			$dataDescarteDescartes[$k] = $dataDescarte[$i];
		  			$idFuncionarioDescartes[$k] = $idFuncionario[$i];
		  			$motivosDescartes[$k] = $motivos[$i];
		  			$k ++;
		  		}
		  	}
		  }

		$sql = "SELECT nome, idSIAPE FROM funcionario";
  		$rst2 = $conn->query($sql);

  		$numRegistrosFuncionario = mysqli_num_rows($rst2);

  		while($row2 = $rst2->fetch_assoc()){
			$nomeFuncionario[] = $row2['nome'];
			$idFuncionarioFuncionarios[] = $row2['idSIAPE'];
		}

		 $k = 0;

		  for ($i=0; $i < $numRegistrosFuncionario ; $i++) {
		  	for ($j=0; $j < $numRegistrosDescarte ; $j++) {
		  		if ($idFuncionarioDescartes[$j] == $idFuncionarioFuncionarios[$i]) {
		  			$nomeFuncionarioFinal[$k] = $nomeFuncionario[$i];
		  			$k ++;
		  		}
		  	}
		  }


		   $html .= " <!DOCTYPE html>
						<html lang='pt-br'>
						<head>
						</head>
						<body>
							<h3> Tabela de obras descartadas <h3>
              <table>
              	<tr>
									<th>Nome da Obra </th>
                  <th>Data do descarte</th>
									<th>Nome do operador</th>
									<th>Motivos</th>
                </tr> ";
				 for ($i = 0; $i  < $numRegistrosAcervo; $i ++) {
        $html .= "<tr>
                    <td>".$nomeAcervo[$i]."</td>
                    <td>".$dataDescarteDescartes[$i]."</td>
                    <td>".$nomeFuncionarioFinal[$i]."</td>
                    <td>".$motivosDescartes[$i]."</td>
                  </tr>
                                 ";
                          }

$html.="
								</table>
            	</body>
        		</html> ";


  $dataAtual = date("d-m-y"); //cria a Data da geração do arquivo
	$nomeDoArquivo = "Obras descartadas (" .$dataAtual. ").pdf"; //cria nome do arquivo de acordo com a data atual

  $mpdf = new mPDF('utf-8');
  $stylesheet = file_get_contents('tabelaPDF.css'); // css da tabela
	$mpdf->WriteHTML($stylesheet,1);

  $html = utf8_encode($html);
	$mpdf -> SetTitle($nomeDoArquivo);
	$mpdf -> SetDisplayMode('fullpage');
	$mpdf -> WriteHTML($html);

	$mpdf -> Output($nomeDoArquivo, 'D');
  $mpdf -> charset_in = 'windows-1252';
  exit;
?>
