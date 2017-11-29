<!--
Grupo: MAE
  Data de modificação: 20/11/2017
  Autor: Emanuela Amorim
    Objetivo da modificação: fazer filtragem
-->
<?php

//Inclui a biblioteca do MPDF
include("../../../../Estaticos/mpdf60/mpdf.php");

  //session_start();
  $usuario = $_SESSION['usuario'];

// Cria conexão
$conn = new mysqli("localhost", "root", "usbw","educatio");
// Checa conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

//recebe via POST o Id do aluno a ser pesquisado,se não tiver nada no input ele manda o pdf com os dados
// if (!empty($_POST["nomeAlunoPesquisa"])) {
//   $nomeAlunoPesquisa=$_POST["nomeAlunoPesquisa"];

  // $stmt = $conn->prepare("SELECT * FROM alunos WHERE nome = ?");
  // $stmt->bind_param('s',$nomeAlunoPesquisa);
  // $stmt->execute();
  // $rst = $stmt->get_result(); 

  // while($row  = $rst->fetch_assoc()){
  //   $idAluno = $row['idCPF'];
  //   $nomeAluno = $row['nome'];
  //   //echo $nomeAluno. " - " .$idAluno;
  // }

  // $stmt = $conn->prepare("SELECT * FROM  emprestimos WHERE idAluno = ?");
  // $stmt->bind_param('s', $idAluno);
  // $stmt->execute();
  // $rst = $stmt->get_result();

  // while($row = $rst->fetch_assoc()){
  //   $dataPrevisaoDevolucao = $row['dataPrevisaoDevolucao'];
  //   $dataDevolucao = $row['dataDevolucao'];
  //   //echo "<br>".$dataPrevisaoDevolucao. " - " .$dataDevolucao;
  // }

// }
// if( empty($row['idAluno']) ) {
//   $url="../../../Entrada/gerencia-web-interface-aluno-biblioteca.php?acao=default";
//   echo "<script>
//           alert('Não há nenhum atraso!');
//           window.location = '".$url."';
//         </script>";
// }else{

  $idAluno = $usuario['idCPF'];

  $dataPrevisaoDevolucao = "";
  $dataDevolucao = "";

  $stmt = $conn->prepare("SELECT dataPrevisaoDevolucao, dataDevolucao FROM  emprestimos WHERE idAluno = ?");
  $stmt->bind_param('s', $idAluno);
  $stmt->execute();
  $rst = $stmt->get_result();

  while($row = $rst->fetch_assoc()){
     $dataPrevisaoDevolucao = $row['dataPrevisaoDevolucao'];
     $dataDevolucao = $row['dataDevolucao'];
   }

  if ($rst == null) {
    $url="../../../Entrada/gerencia-web-interface-aluno-biblioteca.php?acao=default";
   echo "<script>
          alert('Não há nenhum atraso!');
          window.location = '".$url."';
         </script>";
  } else {

  $html .= "
                      <table>
                        <caption><center><strong> Tabela de atrasos do aluno</strong></center></caption>
                        <tr>
                         <th>Id do aluno &emsp;</th>
                         <th>Data prevista para devolucao &emsp;</th>
                         <th>Data de devolucao &emsp;</th>
                        </tr>";
                        
                       // while($row = $rst->fetch_assoc()) {
                              //echo dos valores do id do Aluno e datas
                          $html .= " <tr>
                                      <td>".$idAluno."</td>
                                      <td>".$dataPrevisaoDevolucao."</td>
                                      <td>".$dataDevolucao."</td>
                                     </tr>
                                   ";
                         //   }
  $html.= "         </table>
                  </div>
              </body>
          </html>";
  //cria a Data da geração do arquivo
  $dataAtual = date("d-m-y");
  //cria nome do arquivo de acordo com a data atual 
  $nomeDoArquivo = "Minhas multas (" .$dataAtual. ").pdf"; 

   $mpdf = new mPDF();
   $mpdf -> SetTitle($nomeDoArquivo);
   $mpdf -> SetDisplayMode('fullpage');
   $mpdf -> WriteHTML($html);
   $mpdf -> Output($nomeDoArquivo, 'D');
}

?>