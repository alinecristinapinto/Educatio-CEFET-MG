<?php

  /*
  Grupo:​ ​ MAE
	Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
	Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script da geração do arquivo para download dos relatórios de multas

        Comentário do desenvolvedor: Desculpe pela "gambiarra" usando vários echos, não sei fazer de outra forma ;-;
  */

//Inclui a biblioteca do MPDF
include("C:/wamp64/www/mpdf60/mpdf.php");

// Cria conexão
$conn = new mysqli("localhost", "root", "","educatio");
// Checa conexão
if ($conn->connect_error) {
      die("Conecção falhou: " . $conn->connect_error);
}

//recebe via POST o Id do aluno a ser pesquisado,se não tiver nada no input ele retorna para a página HTML
if (isset($_POST["idAlunoPesquisa"])) {
  $idAlunoPesquisa=$_POST["idAlunoPesquisa"];

  //Seleciona do BD o ID do aluno com as suas multas correspondentes
  $sql = "SELECT idAluno, multa FROM emprestimos WHERE idAluno = $idAlunoPesquisa ";
  $result = $conn->query($sql);
}
else {
  $url="http://localhost/MAE/RelatoriosMultas/MAE-Web-RelatoriosMultas-Aluno.html";
  echo '<script>window.location = "'.$url.'";</script>';
}

//Seta as opções do Bootstrap no html e o código para gerar a tabela que seleciona o ID do aluno e suas multas
$html = "<!DOCTYPE html>
        <html lang='pt-br'>
          <head>
            <!-- Bootstrap -->
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
            <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>


            <!-- jQuery (plugins JavaScript do Bootstrap) -->
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
            <script src='js/bootstrap.min.js'></script>
          </head>
            <body>
                <div class='container'>
                 <!-- Cria o começo da tabela com ID e Multa como colunas -->

                  <table class='table'>
                      <caption><center><strong> Minhas multas atrasadas </strong></center></caption>
                      <tr>
                       <th>Multas</th>
                      </tr>";
                      while($row = $result->fetch_assoc()) {
                            //echo dos valores do id do Aluno e multas
                        $html .= " <tr>
                                    <td>".$row["multa"]."</td>
                                   </tr>
                                 ";
                          }
$html.= "         </table>
                </div>
            </body>
        </html>";

$dataAtual = date("d-m-y"); //cria a Data da geração do arquivo
$nomeDoArquivo = "Minhas multas (" .$dataAtual. ").pdf"; //cria nome do arquivo de acordo com a data atual

 $mpdf = new mPDF();
 $mpdf -> SetTitle($nomeDoArquivo);
 $mpdf -> SetDisplayMode('fullpage');
 $mpdf -> WriteHTML($html);
 $mpdf -> Output($nomeDoArquivo, 'D');
?>
