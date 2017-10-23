<?php
    $id = $_POST['nome'];
    
    $link = mysqli_connect("localhost", "root", "", "educatio");
    
    if(!$link){
        die("Conexão falhou");
    }
    
    $sql = "SELECT * FROM `emprestimos` WHERE id=$id";
    
    if($result = mysqli_query($link, $sql)){
        echo "Sucesso ao selecionar os registros<br>";
    }
    else{
        die("Falha ao selecionar os registros<br>");
    }
    
    if($row = mysqli_fetch_assoc($result)){
        $dataPrevDevol = $row['dataPrevisaoDevolucao'];
        $dataDevol = $row['dataDevolucao'];
    }
    
    //separa em um array
    $sepPrevDevol = explode("/", $dataPrevDevol);
    $sepDevol = explode("/", $dataDevol);
    
    //separa as partes do array p variaveis
    $anoDevol = $sepDevol[2];
    $mesDevol = $sepDevol[1];
    $diaDevol = $sepDevol[0];
    
    $anoPrevDevol = $sepPrevDevol[2];
    $mesPrevDevol = $sepPrevDevol[1];
    $diaPrevDevol = $sepPrevDevol[0];
    
    if($anoDevol <= $anoPrevDevol){
        if($mesDevol <= $mesPrevDevol){
            if($diaDevol <= $diaPrevDevol){
                echo "Nao existe atraso!<br>";
            } 
            else{
                echo "Existe um atraso!<br>";
            }
        } 
        else{
            echo "Existe um atraso!<br>";
        }
    } 
    else{
        echo "Existe um atraso!<br>";
    }
?>