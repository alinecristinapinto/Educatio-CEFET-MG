<?php
  /*
  Grupo:​ ​ MAE
	Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
	Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script da geração do arquivo para download dos relatórios de multas

        Comentário do desenvolvedor: Desculpe pela "gambiarra" usando vários echos, não sei fazer de outra forma ;-;
  */

  //Inclui a biblioteca do MPDF
  include("../../../../Estaticos/mpdf60/mpdf.php");

  //recebe via SESSION o Id do aluno a ser pesquisado,se não tiver nada no input ele retorna para a página HTML

  //session_start();
  $usuario = $_SESSION['usuario'];
  $idAlunoPesquisa = $usuario['idCPF'];

  // Cria conexão
  $conn = new mysqli("localhost", "root", "usbw","educatio");
  // Checa conexão
  if ($conn->connect_error) {
        die("Conecção falhou: " . $conn->connect_error);
  }

  //Seleciona do BD o ID do aluno com as suas multas correspondentes
  $sql = "SELECT idAluno, multa FROM emprestimos WHERE idAluno = '$idAlunoPesquisa'";
  $result = mysqli_query( $conn, $sql);

  $html = "<!DOCTYPE html>

          </head>
            <body>
              <h3> Relatorio de Multas <h3>
                <table class='tabela'>
                   <tr>
                      <th>Minhas multas</th>
                   </tr>";
                //While que pega todas as multas do aluno
                while($row = mysqli_fetch_assoc($result)) {   
  $html .=        "<tr>
                      <td>".$row["multa"]."</td>
                   </tr>";
                }
  $html.= "     </table>
              </body>
          </html>";

  if( empty($row['multa']) ){
    echo "<script>
               alert('Este aluno não possui nenhuma multa!');
               location.href = '../../../Entrada/gerencia-web-interface-aluno-biblioteca.php?acao=default';
            </script>";
  }else {

     $dataAtual = date("d-m-y"); //cria a Data da geração do arquivo
     $nomeDoArquivo = "Minhas multas (" .$dataAtual. ").pdf"; //cria nome do arquivo de acordo com a data atual

     $mpdf = new mPDF();
     $stylesheet = file_get_contents('../css/tabelaPDF.css'); // css da tabela
     $mpdf->WriteHTML($stylesheet,1);

     $mpdf -> SetTitle($nomeDoArquivo);
     $mpdf -> SetDisplayMode('fullpage');
     $mpdf -> WriteHTML($html);

     $mpdf -> Output($nomeDoArquivo, 'D');
  }
?>
