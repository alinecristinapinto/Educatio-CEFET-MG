<!--
Grupo: MAE
  Data de modifica��o: 20/11/2017
  Autor: Emanuela Amorim
    Objetivo da modifica��o: fazer filtragem
-->
<?php
//EU NAO SOUBE ARRUMAR O ERRO DOS ACENTOS!!
header ('Content-type: text/html; charset=ISO-8859-1');

//Inclui a biblioteca do MPDF
include("mpdf60/mpdf.php");

// Cria conex�o
$conn = new mysqli("localhost", "root", "","educatio");
// Checa conex�o
if ($conn->connect_error) {
    die("Conec��o falhou: " . $conn->connect_error);
}

//recebe via POST o Id do aluno a ser pesquisado,se n�o tiver nada no input ele manda o pdf com os dados
if (!empty($_POST["nomeAlunoPesquisa"])) {

  $nomeAlunoPesquisa = $_POST["nomeAlunoPesquisa"];

  $stmt = $conn->prepare("SELECT nome, idCPF FROM alunos WHERE nome = ?");
  $stmt->bind_param('s',$nomeAlunoPesquisa);
  $stmt->execute();
  $rst = $stmt->get_result();

  while($row  = $rst->fetch_assoc()){
    $idAluno = $row['idCPF'];
	  $nomeAluno = $row['nome'];
  }

  $stmt = $conn->prepare("SELECT dataPrevisaoDevolucao, dataDevolucao FROM  emprestimos WHERE idAluno = ?");
  $stmt->bind_param('s', $idAluno);
  $stmt->execute();
  $rst = $stmt->get_result();

  while($row = $rst->fetch_assoc()){
    $dataPrevisaoDevolucao = $row['dataPrevisaoDevolucao'];
    $dataDevolucao[] = $row['dataDevolucao'];
  }

  $html = "<!DOCTYPE html>
          <html lang='pt-br'>
            <head>
            </head>
              <body>
                <h3> Relatorio de Atrasos <h3>
                 <table>
                      <tr>
                        <th>Nome do aluno &emsp;</th>
                        <th>Id do aluno &emsp;</th>
                        <th>Data prevista para devolucao &emsp;</th>
                        <th>Data de devolucao &emsp;</th>
                      </tr>";

foreach ($dataDevolucao as $devolucao) {

                        $html .= " <tr>
                                      <td>".$nomeAluno."</td>
                                      <td>".$idAluno."</td>
                                      <td>".$dataPrevisaoDevolucao."</td>
                                      <td>".$devolucao."</td>
                                   </tr>
                                 ";
                          }

$html.= "         </table>
            </body>
        </html>";


}
else {
  //Seleciona da tabela emprestimos os dados
  $sql = "SELECT idAluno, dataPrevisaoDevolucao, dataDevolucao FROM emprestimos ORDER BY idAluno";
  $rst = $conn->query($sql);

  $numRegistrosEmprestimos = mysqli_num_rows($rst);

  while($row = $rst->fetch_assoc()){
	$dataDevolucao[] = $row['dataDevolucao'];
	$dataPrevisaoDevolucao[] = $row['dataPrevisaoDevolucao'];
	$idAluno[] = $row['idAluno'];
  }

  $stmt1 = "SELECT nome, idCPF FROM  alunos";
  $rst1 = $conn->query($stmt1);

  $numRegistrosAlunos = mysqli_num_rows($rst1);

  while($row1 = $rst1->fetch_assoc()){
    $nomeAluno[] = $row1['nome'];
    $idAlunoAlunos[] = $row1['idCPF'];
  }

 $k = 0;

  for ($i=0; $i < $numRegistrosAlunos ; $i++) {
  	for ($j=0; $j < $numRegistrosEmprestimos ; $j++) {
  		if ($idAluno[$j] == $idAlunoAlunos[$i]) {
  			$nomeAlunoFinal[$k] = $nomeAluno[$i];
  			$k ++;
  		}
  	}
  }

  $html = "<!DOCTYPE html>
          <html lang='pt-br'>
            <head>
            </head>
              <body>
                <h3> Relatorio de Atrasos <h3>
                 <table>
                      <tr>
            <th>Nome do aluno &emsp;</th>
                       <th>Id do aluno &emsp;</th>
                       <th>Data prevista para devolucao &emsp;</th>
                       <th>Data de devolucao &emsp;</th>
                      </tr>";

      for ($i = 0; $i  < $numRegistrosEmprestimos; $i ++) {
        $html .= "<tr>
                    <td>".$nomeAlunoFinal[$i]."</td>
                    <td>".$idAluno[$i]."</td>
                    <td>".$dataPrevisaoDevolucao[$i]."</td>
                    <td>".$dataDevolucao[$i]."</td>
                  </tr>
                                 ";
                          }

$html.="         </table>
            </body>
        </html>";
}

//cria a Data da gera��o do arquivo
$dataAtual = date("d-m-y");
//cria nome do arquivo de acordo com a data atual
$nomeDoArquivo = "Relatorio de atrasos(" .$dataAtual. ").pdf"; 

$mpdf = new mPDF();
$stylesheet = file_get_contents('tabelaPDF.css'); // css da tabela
$mpdf->WriteHTML($stylesheet,1);

$mpdf -> SetTitle($nomeDoArquivo);
$mpdf -> SetDisplayMode('fullpage');
$mpdf -> WriteHTML($html);

$mpdf -> Output($nomeDoArquivo, 'D');
?>
