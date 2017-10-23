<?php

  /*
  Grupo:​ ​ MAE
	Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
	Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script da impressão via tela dos relatórios de multas

        Comentário do desenvolvedor: Desculpe pela "gambiarra" usando vários echos, não sei fazer de outra forma ;-;
  */

//recebe via POST o Id do aluno a ser pesquisado,se não tiver nada no input ele retorna para a página HTML
if (!empty($_POST["idAlunoPesquisa"])) {
  $idAlunoPesquisa=$_POST["idAlunoPesquisa"];
}
else {
  $url="http://localhost/MAE-Web-RelatoriosMultas-Aluno.html";
  echo '<script>window.location = "'.$url.'";</script>';
}

// Cria conexão
$conn = new mysqli("localhost", "root", "","educatio");


// Checa conexão
if ($conn->connect_error) {
    die("Conecção falhou: " . $conn->connect_error);
}

//Seleciona do BD o ID do aluno com as suas multas correspondentes
$sql = "SELECT idAluno, multa FROM emprestimos WHERE idAluno = $idAlunoPesquisa ";
$result = $conn->query($sql);

//Seta as opções do Bootstrap no html
echo "<!DOCTYPE html>
        <html lang='pt-br'>
          <head>
            <!-- Bootstrap -->
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
            <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

            <title>Relatórios Multas</title>

            <!-- jQuery (plugins JavaScript do Bootstrap) -->
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
            <script src='js/bootstrap.min.js'></script>
          </head>
            <body>
            </body>
          </html>";

 echo " <!-- Cria o começo da tabela com ID e Multa como colunas -->
        <div class='container'>
         <table class='table'>
         <caption><center><strong> Suas multas atrasadas </strong></center></caption>
          <tr>
           <th>Multas</th>
          </tr>";

  while($row = $result->fetch_assoc()) {
    echo " <tr>
            <td>".$row["multa"]."</td>
           </tr>";
  }

  //Final da tabela
  echo "  </table>
        </div>";

?>
