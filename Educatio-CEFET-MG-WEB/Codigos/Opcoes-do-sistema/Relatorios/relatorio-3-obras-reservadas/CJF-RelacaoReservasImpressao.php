<?php
session_start();

//Inclui a biblioteca do MPDF
include("../../../../Estaticos/mpdf60/mpdf.php");
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
              <link href='../../../../Estaticos/Bootstrap/css/bootstrap.min.css' rel='stylesheet' />
              <link href='../../../../Estaticos/Bootstrap/css/bootstrap.css' rel='stylesheet'/>

              <!-- CSS do grupo -->
              <link href='../css/CJF-web-estilos.css' rel='stylesheet' type='text/css' >
              </head>
              <body>
              <p>Relat&#243;rio Reservas - ".$_SESSION['data']."</p>
              <!-- cria a tabela com os dados -->
              <table class='table table-hover'>
              <tr>
              <th>Id da Reserva</th>
              <th>Aluno</th>
              <th>Nome</th>
              <th>Data da Reserva</th>
              <th>Tempo de Espera</th>
              <th>Emprestou</th>
              </tr>";
              foreach ($arrayDados as $valor) {
                $html.="<tr>
                <td>".$valor['id']."</td>
                <td>".$valor['nomeAluno']."</td>
                <td>".$valor['nome']."</td>
                <td>".$valor['dataReserva']."</td>
                <td>".$valor['tempoEspera']."</td>
                <td>".$valor['emprestou']."</td>
                </tr>";   
              }
              $html.= "</table></body>";
              //seta o nome do arquivo
              $nomeDoArquivo = "Relatório Reservas - ".$_SESSION['data'].".pdf"; //cria nome do arquivo

  } else {
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

              <!-- CSS do grupo -->
              <link href='../css/CJF-web-estilos.css' rel='stylesheet' type='text/css' >
              </head>
              <body>
              <p>Relat&#243;rio Reservas - Geral</p>
              <!-- cria a tabela com os dados -->
              <table class='table table-hover'>
              <tr>
              <th>Id da Reserva</th>
              <th>Aluno</th>
              <th>Nome</th>
              <th>Data da Reserva</th>
              <th>Tempo de Espera</th>
              <th>Emprestou</th>
              </tr>";
              foreach ($arrayDados as $valor) {
                $html.= "<tr>
                <td>".$valor['id']."</td>
                <td>".$valor['nomeAluno']."</td>
                <td>".$valor['nome']."</td>
                <td>".$valor['dataReserva']."</td>
                <td>".$valor['tempoEspera']."</td>
                <td>".$valor['emprestou']."</td>
                </tr>";   
              }
              $html.="</table></body>";
              //seta o nome do arquivo
              $nomeDoArquivo = "Relatório Empréstimos - Geral.pdf"; //cria nome do arquivo
  }      

  //configura o mpdf e escreve nele as linhas de codigo salvas na variavel $html;
  $mpdf = new mPDF('utf-8', 'A4-P');// P vertical, L horizontal
  $html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1'); //evita o erro HTML contains invalid UTF-8 character(s) devido a acentuação no BD
  $mpdf -> SetTitle($nomeDoArquivo);
  $mpdf -> SetDisplayMode('fullpage');
  $mpdf -> WriteHTML($html);
  $mpdf -> Output($nomeDoArquivo, 'D');

?>