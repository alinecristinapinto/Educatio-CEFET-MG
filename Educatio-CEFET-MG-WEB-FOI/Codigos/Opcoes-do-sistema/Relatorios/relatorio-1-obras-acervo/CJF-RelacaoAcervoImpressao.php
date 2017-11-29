<?php
session_start();
//Inclui a biblioteca do MPDF
include("../../../../Estaticos/mpdf60/mpdf.php");
ini_set('default_charset','UTF-8');

$strAcervo = $_SESSION['acervo'];
  
  if ($_SESSION['acervo'] == 'Mídias') {
    
    $arrayAutores = $_SESSION['arrayAutores'];
    $intAutorestotais = $_SESSION['autoresTotais'];
    $arrayDados = $_SESSION['arrayDados'];

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
          <p>Relat&#237;rio Geral - M&#205;dias</p><br>
          <table class='table table-hover'>
          <tr>
          <th>Id da Obra</th>
          <th>Id no Acervo</th>
          <th>Nome da obra</th>
          <th> Autor </th>
          <th> Campi </th>
          <th> Local </th>
          <th> Ano </th>
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
            <td>".$valor['tempo']."</td>
            <td>".$valor['subtipo']."</td>
            </tr>";   
          }
        $html.= "</table></body>";
        $nomeDoArquivo = 'Mídias.pdf'; //cria nome do arquivo

  //relatorio livros
  } else if ($_SESSION['acervo'] == 'Livros') {

    $arrayAutores = $_SESSION['arrayAutores'];
    $intAutorestotais = $_SESSION['autoresTotais'];
    $arrayDados = $_SESSION['arrayDados'];

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
          <p>Relat&#243;rio Geral - Livros</p><br>
          <table class='table table-hover'>
         <tr>
         <th>Id da Obra</th>
        <th>Id no Acervo</th
        ><th>Nome da obra</th>
        <th> Autores </th>
        <th> Campi </th>
        <th> Local </th>
        <th> Ano </th>
        <th>Editora</th>
        <th> ISBN </th>
        <th>Edicao</th>
        <th>Paginas</th>
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
              $html.= $arrayAutores[$valor['idAcervo']][$intI];
              $intContador++;
            }
          }
          $html.=
          "</td><td>".$valor['idCampi']."</td>
          <td>".$valor['local']."</td>
          <td>".$valor['ano']."</td>
          <td>".$valor['editora']."</td>
          <td>".$valor['ISBN']."</td>
          <td>".$valor['edicao']."</td>
          <td>".$valor['paginas']."</td>
          </tr>";   
        }
        $html.="</table></body>";
        $nomeDoArquivo = 'Livros.pdf'; //cria nome do arquivo


    //relatorio periodicos
  } else if ($_SESSION['acervo'] == 'Periódicos') {

    $arrayAutores = $_SESSION['arrayAutores'];
    $intAutorestotais = $_SESSION['autoresTotais'];
    $arrayDados = $_SESSION['arrayDados'];

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
            <link href='../cssCJF-web-estilos.css' rel='stylesheet' type='text/css' >
          </head>
          <body>
          <p>Relat&#243;rio Geral - Peri&#243;dicos</p><br>
          <table class='table table-hover'>
            <tr>
            <th>Id da Obra</th>
            <th>Id no Acervo</th>
            <th>Nome da obra</th>
            <th> Partes </th>
            <th> Campi </th>
            <th> Local </th>
            <th> Ano </th>
            <th>Editora</th>
            <th> Periodicidade </th>
            <th>Subtipo</th>
            <th>Mes</th>
            <th>Volume</th>
            <th>ISSN</th>
            </tr>";
            foreach ($arrayDados as $valor) {
              $intContador = 0;
              $html.="<tr>
              <td>".$valor['idObra']."</td>
              <td>".$valor['idAcervo']."</td>
              <td>".$valor['nome']."</td><td>";
              for ($intI = 0; $intI < $intPartestotais; $intI++) {
                if (isset($arrayPartes[$valor['idObra']][$intI])) {
                  if ($intContador != 0) {
                    $html.=", ";
                  }
                  $html.=$arrayPartes[$valor['idObra']][$intI];
                  $intContador++;
                }
              }
              $html.=
              "</td><td>".$valor['idCampi']."</td>
              <td>".$valor['local']."</td>
              <td>".$valor['ano']."</td>
              <td>".$valor['editora']."</td>
              <td>".$valor['periodicidade']."</td>
              <td>".$valor['subtipo']."</td>
              <td>".$valor['mes']."</td>
              <td>".$valor['volume']."</td>
              <td>".$valor['ISSN']."</td>
              </tr>";   
            }
            $html.="</table></body>";
            $nomeDoArquivo = 'Periódicos.pdf'; //cria nome do arquivo


  //relatorio academicos
  } else if ($_SESSION['acervo'] == 'Acadêmicos') {

    $arrayAutores = $_SESSION['arrayAutores'];
    $intAutorestotais = $_SESSION['autoresTotais'];
    $arrayDados = $_SESSION['arrayDados'];

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
          <p>Relat&#243;rio Geral - Acad&#234;micos</p><br>
          <table class='table table-hover'>
            <tr>
            <th>Id da Obra</th>
            <th>Id no Acervo</th
            ><th>Nome da obra</th>
            <th> Autor </th>
            <th> Campi </th>
            <th> Local </th>
            <th> Ano </th>
            <th>Programa</th>
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
              <td>".$valor['programa']."</td>
              </tr>";   
            }
            $html.="</table></body>";
            $nomeDoArquivo = 'Acadêmicos.pdf'; //cria nome do arquivo

  }



// define as configurações do mpdf e escreve no arquivo;
 $mpdf = new mPDF('utf-8', 'A4-L');
 $html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1'); //evita o erro HTML contains invalid UTF-8 character(s) devido a acentuação no BD
 $mpdf -> SetTitle($nomeDoArquivo);
 $mpdf -> SetDisplayMode('fullpage');
 $mpdf -> WriteHTML($html);
 $mpdf -> Output($nomeDoArquivo, 'D');

?>