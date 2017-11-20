<?php

  /*
  Grupo:? ? MAE
	Data? ? de? ? modificação:? ? 09/10/2017
	Autor:? ? Allan Barbosa
? ? ? ? ? ? ? ? ?Objetivo? ? da? ? modificação:? Criação do script da geração do arquivo para download dos relatórios de multas

        Comentário do desenvolvedor: Desculpe pela "gambiarra" usando vários echos, não sei fazer de outra forma ;-;
  */

//Inclui a biblioteca do MPDF
include("C:/wamp64/www/MAE/mpdf60/mpdf.php");

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
  $sql = "SELECT * FROM emprestimos WHERE idAluno = $idAlunoPesquisa ";
  $result = $conn->query($sql);
}
else {
  $url="http://localhost/MAE/MAE-Web-RelatorioAtraso-Aluno.html";
  echo '<script>window.location = "'.$url.'";</script>';
}

//Seta as opções do Bootstrap no html e o código para gerar a tabela que seleciona o ID do aluno e suas multas
$html = "
                    <table class='table'>
                      <caption><center><strong> Tabela de atrasos do aluno</strong></center></caption>
                      <tr>
                       <th>Id do aluno</th>
                       <th>Data prevista de devolucao</th>
                       <th>Data de devolucao</th>
                      </tr>";
                      
                      while($row = $result->fetch_assoc()) {
                            //echo dos valores do id do Aluno e multas
                        $html .= " <tr>
                                    <td>".$row["idAluno"]."</td>
                                    <td>".$row["dataPrevisaoDevolucao"]."</td>
                                    <td>".$row["dataDevolucao"]."</td>
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