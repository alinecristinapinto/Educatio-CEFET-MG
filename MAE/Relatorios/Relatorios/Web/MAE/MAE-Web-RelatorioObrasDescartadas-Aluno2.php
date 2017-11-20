<?php

/**
 * @author 
 * @copyright 2017
 */

	include("mpdf60/mpdf.php");

    if (isset($_POST["idAcervo"]))
	  	$id=$_POST["idAcervo"];
	else {
	  	$url="http://localhost/MAE-Web-RelatorioObrasDescartadas.html";
	  	echo '<script>window.location = "'.$url.'";</script>';
	}

    $link = new mysqli("localhost", "root", "", "educatio");
    if(!$link)
        die("Conexão falhou.");
    
    $sql = "SELECT id,dataDescarte FROM `descartes` WHERE id=$id";
    $resultado = $link->query($sql);

    if(!$resultado)
    	die("Selecionar o Banco de Dados falhou.");
	
	$dataAtual = date("d-m-y"); //cria a Data da geração do arquivo
    $nomeDoArquivo = "Relatorio de Obras Descartadas (" .$dataAtual. ").txt"; //cria nome do arquivo de acordo com 

    $html .= "
                    <table>
                      <caption><center><strong> Tabela de obras descartadas</strong></center></caption>
                      <tr>
                       <th>Id do livro descartado &emsp;</th>
                       <th>Data do descarte &emsp;</th>
                      </tr>";
                      
                      while($row = $resultado->fetch_assoc()) {
                            //echo dos valores do id do Aluno e multas
                        $html .= " <tr>
                                    <td>".$row["id"]."</td>
                                    <td>".$row["dataDescarte"]."</td>
                                   </tr>
                                 ";
                          }
$html.= "         </table>
                </div>
            </body>
        </html>";


    $dataAtual = date("d-m-y"); //cria a Data da geração do arquivo
	$nomeDoArquivo = "Minhas obras descartadas (" .$dataAtual. ").pdf"; //cria nome do arquivo de acordo com a data atual
    
    $mpdf = new mPDF();
	$mpdf -> SetTitle($nomeDoArquivo);
	$mpdf -> SetDisplayMode('fullpage');
	$mpdf -> WriteHTML($html);
	$mpdf -> Output($nomeDoArquivo, 'D');
?>