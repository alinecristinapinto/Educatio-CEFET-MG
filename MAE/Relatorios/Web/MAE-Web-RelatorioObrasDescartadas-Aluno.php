<?php

/**
 * @author 
 * @copyright 2017
 */

	include("C:/xampp/htdocs/matheus/mpdf60/mpdf.php");


    if (isset($_POST["idAcervo"]))
	  	$id=$_POST["idAcervo"];
	else {
	  	$url="http://localhost/MAE-Web-RelatorioObrasDescartadas.html";
	  	echo '<script>window.location = "'.$url.'";</script>';
	}

    $link = new mysqli("localhost", "root", "", "educatio");
    if(!$link)
        die("Conexão falhou.");
    
    $sql = "SELECT id,dataDescarte FROM `descartes` WHERE id=$id";
    $resultado = $link->query($sql);

    if(!$resultado)
    	die("Selecionar o Banco de Dados falhou.");
	
	$dataAtual = date("d-m-y"); //cria a Data da geração do arquivo
    $nomeDoArquivo = "Relatorio de Obras Descartadas (" .$dataAtual. ").txt"; //cria nome do arquivo de acordo com 

	$html = "<!DOCTYPE html>
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
					<h3>Resultados da pesquisa:</h3>";

	while($row = $resultado->fetch_assoc()){
		$html .=  "<br>O id do livro descartado e: ".$row['id'].
		        					"<br>Data do descarte: ".$row['dataDescarte'];
    }

    $mpdf = new mPDF();
	$mpdf -> SetTitle($nomeDoArquivo);
	$mpdf -> SetDisplayMode('fullpage');
	$mpdf -> WriteHTML($html);
	$mpdf -> Output($nomeDoArquivo, 'D');
?>