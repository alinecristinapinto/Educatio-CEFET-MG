<?php
session_start();

//Inclui a biblioteca do MPDF
include("mpdf60/mpdf.php");
header ('Content-type: text/html; charset=ISO-8859-1');
ini_set('default_charset','UTF-8');

$arrayDados = $_SESSION['arrayDados'];

  if ($_SESSION['data']!=null) {
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
              <p>Relat&#243;rio Emprestimos - ".$_SESSION['data']."</p>
              <table class='table table-hover'>
              <tr>
              <th>Id do Emprestimo</th>
              <th>Aluno</th>
              <th>Nome</th>
              <th>Data do Emprestimo</th>
              <th>Data da previsao de Entrega</th>
              <th>Multa</th>
              </tr>";
              foreach ($arrayDados as $valor) {
                $html.="<tr>
                <td>".$valor['id']."</td>
                <td>".$valor['nomeAluno']."</td>
                <td>".$valor['nome']."</td>
                <td>".$valor['dataEmprestimo']."</td>
                <td>".$valor['dataPrevisaoDevolucao']."</td>
                <td>".$valor['multa']."</td>
                </tr>";   
              }
              $html.="</table><body>";
              $nomeDoArquivo = "Relatório Emprestimos - ".$_SESSION['data'].".pdf"; //cria nome do arquivo

  } else {
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
              <p>Relat&#243;rio Emprestimos - Geral</p>
              <table class='table table-hover'>
              <tr>
              <th>Id do Emprestimo</th>
              <th>Aluno</th>
              <th>Nome</th>
              <th>Data do Emprestimo</th>
              <th>Data da previsao de Entrega</th>
              <th>Multa</th>
              </tr>";
              foreach ($arrayDados as $valor) {
                $html.="<tr>
                <td>".$valor['id']."</td>
                <td>".$valor['nomeAluno']."</td>
                <td>".$valor['nome']."</td>
                <td>".$valor['dataEmprestimo']."</td>
                <td>".$valor['dataPrevisaoDevolucao']."</td>
                <td>".$valor['multa']."</td>
                </tr>";   
              }
              $html.="</table><body>";

              $nomeDoArquivo = "Relatório Empréstimos - Geral.pdf"; //cria nome do arquivo
  }      

  $mpdf = new mPDF('utf-8', 'A4-P');
  $html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1'); //evita o erro HTML contains invalid UTF-8 character(s) devido a acentuação no BD
  $mpdf -> SetTitle($nomeDoArquivo);
  $mpdf -> SetDisplayMode('fullpage');
  $mpdf -> WriteHTML($html);
  $mpdf -> Output($nomeDoArquivo, 'D');

?>