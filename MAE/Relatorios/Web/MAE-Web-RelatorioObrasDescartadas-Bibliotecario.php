<?php

/**
 * @author 
 * @copyright 2017
 */

	function get_post_action($name){
	    $params = func_get_args();

	    foreach ($params as $name) {
	        if (isset($_POST[$name])) {
	            return $name;
	        }
	    }
	}

    if (isset($_POST["idAcervo"]))
	  	$id=$_POST["idAcervo"];
	else {
	  	$url="http://localhost/MAE-Web-RelatorioObrasDescartadas.html";
	  	echo '<script>window.location = "'.$url.'";</script>';
	}

    $link = new mysqli("localhost", "root", "", "educatio");
    if(!$link)
        die("Conexão falhou.");
    
    $sql = "SELECT * FROM `descartes` WHERE id=$id";
    $resultado = $link->query($sql);

    if(!$resultado)
    	die("Selecionar o Banco de Dados falhou.");
	
	$dataAtual = date("d-m-y"); //cria a Data da geração do arquivo
    $nomeDoArquivo = "Relatorio de Obras Descartadas (" .$dataAtual. ").txt"; //cria nome do arquivo de acordo com a    
   	$conteudoDoArquivo = "Relatorio de obras descartadas:\r\n \r\n";
	while($row = $resultado->fetch_assoc()){
		$conteudoDoArquivo .=  "O id do livro descartado e: ".$row['id'].
		        					"\r\nO funcionario que o descartou foi: ".$row['idFuncionario'].
		        					"\r\nO motivo foi: ".$row['motivos'].
		        					"\r\nData do descarte: ".$row['dataDescarte'];
    }
	$dir = dirname(__FILE__)."";

	$arquivo = fopen($nomeDoArquivo, "w");
	fwrite($arquivo, $conteudoDoArquivo);
	fclose($arquivo);
       
    $booleanDownload = false;

    switch (get_post_action('mostrarNaTela', 'download')) {
    	case 'mostrarNaTela':
	    	printf("<!DOCTYPE html>
			<html>
			<head>
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
				<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
				<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
				<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

				<title>Relatorio obras descartadas</title>

				<!-- jQuery (plugins JavaScript do Bootstrap) -->
				<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
				<script src='js/bootstrap.min.js'></script>
			</head>
			<body>
				<div class='container-fluid'>
					<h1>Relatorios:<small><em>Obras Descartadas</em></small></h1>
					<h3>Resultados da pesquisa:</h3>");
    		
    		$arquivo = fopen($nomeDoArquivo, "r");
    		while(!feof($arquivo)){
    			echo fgets($arquivo, 4096)."<br>";
    		}

    		    echo "		</div>
			    		</body>
						</html>";
			fclose($arquivo);
    		break;

    	case 'download':

    		// Configuração os headers que serão enviados para o browser
	    	header("Content-Type: application/save");
		    header("Content-Length:".filesize($nomeDoArquivo));
		    header('Content-Disposition: attachment; filename="' . $nomeDoArquivo . '"');
		    header("Content-Transfer-Encoding: binary");
		    header('Content-Description: File Transfer');
		    header('Content-Disposition: attachment; filename="'.$nomeDoArquivo.'"');
		    header('Content-Type: application/octet-stream');
		    header('Content-Transfer-Encoding: binary');
		    header('Content-Length: ' . filesize($nomeDoArquivo));
		    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		    header('Pragma: public');

		    // Envia o arquivo para o cliente
		    readfile($nomeDoArquivo);

		    $booleanDownload= true;
    		break;

    	default:
    		# code...
    		break;
    }

    if(!unlink($nomeDoArquivo))
    	die("Falha ao apagar o arquivo temporario.");
?>