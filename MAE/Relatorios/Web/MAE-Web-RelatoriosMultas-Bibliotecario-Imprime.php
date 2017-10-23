<?php

  /*
  Grupo:​ ​ MAE
	Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
	Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script da impressão via tela dos relatórios de multas

        Comentário do desenvolvedor: Desculpe pela "gambiarra" usando vários echos, não sei fazer de outra forma ;-;
  */

// Cria conexão
$conn = new mysqli("localhost", "root", "","educatio");

// Checa conexão
if ($conn->connect_error) {
    die("Conecção falhou: " . $conn->connect_error);
}

//Seleciona o ID do aluno com a sua multa correspondente
$sql = "SELECT idAluno, multa FROM emprestimos ORDER BY idAluno ASC";
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

 echo "
      <!-- Cria a barra de pesquisa do tamanho da tabela  -->
      <div class='container'>
        <form action=# method='post'>
          <div class='input-group'>
           <input type='text' name='pesquisa' class='form-control' placeholder='Pesquise as multa pelo ID do aluno' >
             <div class='input-group-btn'>
               <button class='btn btn-default' type='submit'>
                 <i class='glyphicon glyphicon-search'></i>
               </button>
             </div>
          </div>
        </form><br>

         <!-- Cria o começo da tabela com ID e Multa como colunas -->
         <table class='table'>
          <caption><center><strong> Tabela de multas atrasadas </strong></center></caption>
          <tr>
           <th>Id do aluno</th>
           <th>Multas</th>
          </tr>";

  //recebe via POST o Id do aluno a ser pesquisado se ele não existir seta a String como " "
  if (isset($_POST["pesquisa"])) {
    $StringPesquisa=$_POST["pesquisa"];
  }
  else {
    $StringPesquisa="";
  }

  while($row = $result->fetch_assoc()) {

      if (($row["idAluno"] == $StringPesquisa) && ( $StringPesquisa!="")){
        //echo dos valores do id do Aluno e multas mostrados em verde de acordo com a pesquisa
        echo " <tr class='warning' id='linhaAmarela' href='#linhaAmarela'>
                <td>".$row["idAluno"]."</td>
                <td>".$row["multa"]."</td>
               </tr>
             ";
      }
      else {
        //echo dos valores do id do Aluno e multas
        echo " <tr >
                <td>".$row["idAluno"]."</td>
                <td>".$row["multa"]."</td>
               </tr>
             ";
      }

  }
  //Final da tabela
  echo "  </table>
        </div>";

?>
