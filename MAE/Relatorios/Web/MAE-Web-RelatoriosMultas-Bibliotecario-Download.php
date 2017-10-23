<?php

/*
Grupo:​ ​ MAE
Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script da geração do arquivo para download dos relatórios de multas

      Comentário do desenvolvedor: Desculpe pela "gambiarra" usando vários echos, não sei fazer de outra forma ;-;
*/

    header("Content-Type: application/save");
    header("Content-Length:".filesize($nomeDoArquivo));
    header('Content-Disposition: attachment; filename="' . $nomeDoArquivo . '"');
    header("Content-Transfer-Encoding: binary");

    $link = new mysqli("localhost", "root", "", "educatio");
    if(!$link)
        die("Conex�o falhou.");

    $sql = "SELECT idAluno, multa FROM emprestimos ORDER BY idAluno ASC ";
    $resultado = $link->query($sql);


    while($row = $resultado->fetch_assoc()){
        $conteudoDoArquivo =  "\r\nO id do aluno: ".$row['idAluno'].
        						          "\r\nA multa: ".$row['multa'];
    }

    $dataAtual = date("d-m-y"); //cria a Data da geração do arquivo
    $nomeDoArquivo = "Relatorio de multas (" .$dataAtual. ").txt"; //cria nome do arquivo de acordo com a data atual

    $dir = dirname(__FILE__)."";//diretorio do arquivo
    $arquivoLocal = $dir.$aquivoNome; // caminho absoluto

    $arquivo = fopen($nomeDoArquivo, 'a');
    fwrite($arquivo, $conteudoDoArquivo);
    fclose($arquivo);

    // Configuração dos headers que serão enviados para o browser
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="'.$nomeDoArquivo.'"');
    header('Content-Type: application/octet-stream');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($nomeDoArquivo));
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');

    // Envia o arquivo para o cliente
    readfile($nomeDoArquivo);

?>
