<?php

/*Grupo Felipe, Juliana, Carlos;
Autor Felipe Linhares;
Seleção de notas por aluno/ano impressao
*/


session_start();
//Inclui a biblioteca do MPDF
include("../../../../Estaticos/mpdf60/mpdf.php");

ini_set('default_charset','UTF-8');

// "recebe" as variaveis
$strAluno = $_SESSION['Aluno'];
$strano = $_SESSION['Ano'];
$arrayDados = $_SESSION['arrayDados'];
$arrayEtapas = $_SESSION['arrayEtapas'];
$arrayFaltas = $_SESSION['arrayFaltas'];
$intNotaTotal = $_SESSION['rendimento'];
$CPF = $_SESSION['CPF'];


  if ($arrayDados != null) {
    //Seta as opções do Bootstrap no html
    $html = "<!DOCTYPE html>
            <html lang='pt-br'>
              <head>
              <meta charset='utf-8'>
              <meta http-equiv='X-UA-Compatible' content='IE=edge'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <link href='https://fonts.googleapis.com/css?family=Abel|Inconsolata' rel='stylesheet'>

              <!-- CSS do Bootstrap -->
              <link href='../../../../Estaticos/Bootstrap/css/bootstrap.min.css' rel='stylesheet' />
              <link href='../../../../Estaticos/Bootstrap/css/bootstrap.css' rel='stylesheet'/>
              <link href='https://fonts.googleapis.com/css?family=Abel|Inconsolata' rel='stylesheet'>

              <style type='text/css'>
                  .text-center{
                    font-family: 'Abel', sans-serif;
                    color: #d8ac29;
                  }
                  .fonteTexto{
                    font-family: 'Inconsolata', monospace;
                    font-size: 16px;
                  }
              </style>

              <!-- CSS do grupo -->
              <link href='CJF-web-estilos.css' rel='stylesheet' type='text/css' >
              </head>
              <body>";
              // cria a tabela no pdf
              $html.="<p>Nome do aluno: ".$strAluno.".</p><p>CPF: ".$CPF.".</p><p>Ano: ".$strano.".</p><p>Coeficiente de Rendimento: ".number_format($intNotaTotal,2)."%.</p>
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

//cria nome do arquivo
$nomeDoArquivo = utf8_encode("Boletim - ".$strAluno.".pdf"); 
//configurãcoes dp mPDF, e escrita no arquivo;
 $mpdf = new mPDF('utf-8', 'A4-P');
 $mpdf->charset_in='windows-1252';
 $html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1');
 $mpdf -> SetTitle($nomeDoArquivo);
 $mpdf -> SetDisplayMode('fullpage');
 $mpdf -> WriteHTML($html);
 $mpdf -> Output($nomeDoArquivo, 'D');

?>