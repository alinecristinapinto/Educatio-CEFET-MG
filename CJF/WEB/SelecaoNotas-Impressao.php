<?php
session_start();
//Inclui a biblioteca do MPDF
include("C:\wamp\www\Felps\mpdf60/mpdf.php");
header ('Content-type: text/html; charset=ISO-8859-1');
ini_set('default_charset','UTF-8');

$strAluno = $_SESSION['Aluno'];
$strano = $_SESSION['Ano'];
$arrayDados = $_SESSION['arrayDados'];
$arrayEtapas = $_SESSION['arrayEtapas'];
$arrayFaltas = $_SESSION['arrayFaltas'];
$intNotaTotal = $_SESSION['rendimento'];
$CPF = $_SESSION['CPF'];


  if ($arrayDados != null) {
    //Seta as opções do Bootstrap no html e o código para gerar a tabela que seleciona o ID do aluno e suas multas
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

              <p>Nome do aluno: ".$strAluno.".</p><p>CPF: ".$CPF.".</p><p>Ano: ".$strano.".</p><p>Coeficiente de Rendimento: ".number_format($intNotaTotal,2)."%.</p>
                <table class='table table-hover'>
                <tr>
                <th class='a' rowspan='2'></th>";
                foreach ($arrayEtapas as $valor) {
                  $html.= "<th colspan='2'><center>".$valor."</center></th>";
                }
                $html.= "</tr><tr>";
                foreach ($arrayEtapas as  $valor) {
                  $html.="<th>Nota</th><th>Faltas</th>";
                }
                $html.="</tr>";
                foreach ($arrayDados as $key => $valor) {
                $html.="<tr><th>".$key."</th>";
                for ($intX = 0; $intX < count($arrayEtapas); $intX++) {
                  if(array_key_exists($arrayEtapas[$intX], $arrayDados[$key])) {
                    $html.="<td>".$arrayDados[$key][$arrayEtapas[$intX]]."</td>";
                    $html.="<td>".$arrayFaltas[$key][$arrayEtapas[$intX]]."</td>";
                  } else {
                    $html.="<td>NE</td><td>NE</td>";
                  }
                }
                $html.="</tr>";
              }
              $html.="</table>
                  </body>
                </html>";
            }


$nomeDoArquivo = "Boletim - ".$strAluno.".pdf"; //cria nome do arquivo

 $mpdf = new mPDF('utf-8', 'A4-P');
 $html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1'); //evita o erro HTML contains invalid UTF-8 character(s) devido a acentuação no BD
 $mpdf -> SetTitle($nomeDoArquivo);
 $mpdf -> SetDisplayMode('fullpage');
 $mpdf -> WriteHTML($html);
 $mpdf -> Output($nomeDoArquivo, 'D');

?>