<?php

/*
 * @author
 * @copyright 2017
 */

 //Inclui a biblioteca do MPDF
 include("../../../../Estaticos/mpdf60/mpdf.php");

 // Cria conexão
 $conn = new mysqli("localhost", "root", "usbw","educatio");

 // Checa conexão
 if ($conn->connect_error) {
     die("Conexão falhou: " . $conn->connect_error);
 }

 $dataDescarte= array(0);
 $podeImprimir = 0;

	//recebe via POST o nome da Obra a ser pesquisado
	if (!empty($_POST["nomeObra"])) {
		$nomeObra = $_POST["nomeObra"];

		//seleciona o ID da obra pelo seu nome
		$stmt = $conn->prepare("SELECT id FROM acervo WHERE nome = ?");
		$stmt->bind_param('s', $nomeObra);
		$stmt->execute();
		$rst = $stmt->get_result();

		while($row = $rst->fetch_assoc()){
			//o ID acervo é o id da obra que está no acervo
			$idAcervo = $row['id'];
		}

		//seleciona a data do descarte pelo ID do acervo
		$stmt = $conn->prepare("SELECT dataDescarte FROM descartes WHERE idAcervo = ?");
		$stmt->bind_param('s', $idAcervo);
		$stmt->execute();
		$rst = $stmt->get_result();

			while($row = $rst->fetch_assoc()){
				$dataDescarte[] = $row['dataDescarte'];
			}

			//seleciona o ID funcionario pelo ID do acervo
			$stmt = $conn->prepare("SELECT idFuncionario FROM descartes WHERE idAcervo = ?");
			$stmt->bind_param('s', $idAcervo);
			$stmt->execute();
			$rst = $stmt->get_result();

				while($row = $rst->fetch_assoc()){
					$idFuncionario = $row['id'];
				}

			//seleciona o nome do funcionario pelo ID do funcionario
			$stmt = $conn->prepare("SELECT nome FROM funcionario WHERE idSIAPE = ?");
			$stmt->bind_param('s', $idFuncionario);
			$stmt->execute();
			$rst = $stmt->get_result();

				while($row = $rst->fetch_assoc()){
					//o nome do Operador que fez o descarte é o nome do funcionario no BD
					$nomeOperador[] = $row['nome'];
					echo "<br><h4>".$nomeOperador[0]."</h4>";
				}

				//seleciona o motivo do descarte pelo ID do acervo
				$stmt = $conn->prepare("SELECT motivos FROM descartes WHERE idAcervo = ?");
				$stmt->bind_param('s', $idAcervo);
				$stmt->execute();
				$rst = $stmt->get_result();

					while($row = $rst->fetch_assoc()){
						$motivos[] = $row['motivos'];
					}
	}

	if( $dataDescarte[0] == 0){
		echo "<script>
				alert('Esta obra não foi descartada!');
			    location.href = '../../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarObrasDescartadas';
			  </script>";
	} else {

	    $html .= " <!DOCTYPE html>
							<html lang='pt-br'>
							<head>
							</head>
							<body>
								<h3> Tabela de obras descartadas <h3>
	              <table>
	              	<tr>
										<th>Nome da Obra</th>
	                  <th>Data do descarte</th>
										<th>Nome do operador do descarte<th>
										<th>Motivos<th>
	                </tr> ";
									foreach ($dataDescarte as $data) {
		$html .=      	"<tr>
					             <td>". $nomeObra ."</td>
					             <td>". $data ."</td> ";
											foreach ($nomeOperador as $operador) {
		$html .=      			"<td>". $operador ."</td> ";
								  				foreach ($motivos as $motivo) {
		$html .=      						" <td>". $motivo ."</td> ";
													}//final do foreach, motivos
											}//final do foreach, nomes dos operadores
		$html .=	      "</tr> ";
			            }//final do foreach, datas de descartes
	    $html.= "     </table>
	                </body>
	        	</html> ";

		echo $html;

	 
	  	$dataAtual = date("d-m-y"); //cria a Data da geração do arquivo
		$nomeDoArquivo = "Obras descartadas (" .$dataAtual. ").pdf"; //cria nome do arquivo de acordo com a data atual

		$mpdf = new mPDF();
		$stylesheet = file_get_contents('../css/tabelaPDF.css'); // css da tabela
		$mpdf->WriteHTML($stylesheet,1);

		$mpdf -> SetTitle($nomeDoArquivo);
		$mpdf -> SetDisplayMode('fullpage');
		$mpdf -> WriteHTML($html);

		$mpdf -> Output($nomeDoArquivo, 'D');

    }

?>
