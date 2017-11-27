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

	//recebe via POST o Id do aluno a ser pesquisado
	if (!empty($_POST["nomeObra"])) {
	$nomeObra = $_POST["nomeObra"];

	//seleciona o ID da obra pelo seu nome
	$stmt = $conn->prepare("SELECT id FROM acervo WHERE nome = ?");
	$stmt->bind_param('s', $nomeObra);
	$stmt->execute();
	$rst = $stmt->get_result();

	while($row = $rst->fetch_assoc()){
		$idObra = $row['id'];
	}

	//seleciona a data do descarte pelo ID do acervo
	$stmt = $conn->prepare("SELECT dataDescarte FROM descartes WHERE idAcervo = ?");
	$stmt->bind_param('s', $idObra);
	$stmt->execute();
	$rst = $stmt->get_result();

		while($row = $rst->fetch_assoc()){
			$dataDescarte[] = $row['dataDescarte'];
		}

		$html = "<!DOCTYPE html>
						<html>
						<head>
						</head>
						<body>
							<h3> Tabela de obras descartadas <h3>
              <table>
              	<tr>
					<th>Nome da Obra</th>
                  	<th>Data do descarte</th>
                </tr> ";
				foreach ($dataDescarte as $datas) {
	$html .=      "<tr>
			             <td>". $nomeObra ."</td>
			             <td>". $datas ."</td>
		            </tr>";
		            }
  $html.= "     </table>
            </body>
        		</html> ";

	} else {

  $sql = "SELECT id, nome FROM acervo";
  $rst = $conn->query($sql);

  $numRegistrosAcervo = mysqli_num_rows($rst);

  while($row = $rst->fetch_assoc()){
    $idAcervoo[] = $row['id'];
    $nomeAcervo[] = $row['nome'];
  }

  $stmt1 = "SELECT dataDescarte FROM descartes ORDER BY idAcervo";
  $rst1 = $conn->query($stmt1);

  $numRegistrosDescarte = mysqli_num_rows($rst1);

  while($row1 = $rst1->fetch_assoc()){
    $dataDescarteDescartes[] = $row1['dataDescarte'];
  }

  $html = "<!DOCTYPE html>
          <html>
            <head>
            </head>
              <body>
                <h3> Relatorio de Multas <h3>
                 <table>
                      <tr>
                      <th>Nome da Obra</th>
                  		<th>Data do descarte</th>
                      </tr>";

      for ($i = 0; $i  < $numRegistrosDescarte; $i ++) {
        $html .= "<tr>
                    <td>".$nomeAcervo[$i]."</td>
                    <td>".$dataDescarteDescartes[$i]."</td>
                  </tr>
                                 ";
                          }

$html.="         </table>
            </body>
        </html>";

}



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
