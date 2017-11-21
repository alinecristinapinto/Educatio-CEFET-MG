<?php
session_start();
//Inclui a biblioteca do MPDF
include("C:\wamp\www\Felps\mpdf60/mpdf.php");
header ('Content-type: text/html; charset=ISO-8859-1');
ini_set('default_charset','UTF-8');

$strAcervo = $_SESSION['acervo'];
  
  if ($_SESSION['acervo'] == 'Mídias') {
    
    $arrayAutores = $_SESSION = ['arrayAutores'];
    $intAutorestotais = $_SESSION = ['autoresTotais'];
    $arrayDados = $_SESSION = ['arrayDados'];
    $html = "<!DOCTYPE html>
        <html lang='pt-br'>
          <head>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link href='https://fonts.googleapis.com/css?family=Abel|Inconsolata' rel='stylesheet'>
            <!-- CSS do Bootstrap -->
            <link href='css/bootstrap.min.css' rel='stylesheet' />
            <link href='css/bootstrap.css' rel='stylesheet'/>
            <!-- CSS do grupo -->
            <link href='CJF-web-estilos.css' rel='stylesheet' type='text/css' >
          </head>
          <body>
          <table class='table table-hover'>
          <tr>
          <th>Id da Obra</th>
          <th>Id no Acervo</th>
          <th>Nome da obra</th>
          <th> Autor </th>
          <th> Campi </th>
          <th> Local </th>
          <th> Ano </th>
          <th>Editora</th>
          <th> Tempo </th>
          <th>Subtipo</th>
          </tr>";
          foreach ($arrayDados as $valor) {
            $intContador = 0;
            $html.="<tr>
            <td>".$valor['idObra']."</td>
            <td>".$valor['idAcervo']."</td>
            <td>".$valor['nome']."</td><td>";
            for ($intI = 0; $intI < $intAutorestotais; $intI++) {
              if (isset($arrayAutores[$valor['idAcervo']][$intI])) {
                if ($intContador != 0) {
                  $html.=", ";
                }
                $html.=$arrayAutores[$valor['idAcervo']][$intI];
                $intContador++;
              }
            }
            $html.=
            "</td><td>".$valor['idCampi']."</td>
            <td>".$valor['local']."</td>
            <td>".$valor['ano']."</td>
            <td>".$valor['editora']."</td>
            <td>".$valor['tempo']."</td>
            <td>".$valor['subtipo']."</td>
            </tr>";   
          }
        }


$nomeDoArquivo = $_SESSION['acervo'].".pdf"; //cria nome do arquivo

 $mpdf = new mPDF('utf-8', 'A4-P');
 $html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1'); //evita o erro HTML contains invalid UTF-8 character(s) devido a acentuação no BD
 $mpdf -> SetTitle($nomeDoArquivo);
 $mpdf -> SetDisplayMode('fullpage');
 $mpdf -> WriteHTML($html);
 $mpdf -> Output($nomeDoArquivo, 'D');

?>