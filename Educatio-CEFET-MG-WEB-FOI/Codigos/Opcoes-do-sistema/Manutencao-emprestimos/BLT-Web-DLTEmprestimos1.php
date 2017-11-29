<!DOCTYPE html>
<html>
<head>
  <title>Educatio - CEFET-MG </title>
  <meta charset="utf-8">
  <link href="../Opcoes-do-sistema/Manutencao-emprestimos/BLT-Web-Emprestimos.css" rel="stylesheet">
  <script src="../Opcoes-do-sistema/Manutencao-emprestimos/BLT-Web-Emprestimos.js"></script> 
 </head>
<body>
<div class="corpo">
  <div class="titulo">
    <h1><b>Remover empréstimo</b></h1>
  </div>
</div>

<?php
$servername = "localhost";
$username = "root";
$password = "usbw";
$bdNome = "educatio";

// Create connection
$conn = new mysqli($servername, $username, $password, $bdNome);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT idAluno, idAcervo, dataEmprestimo, dataPrevisaoDevolucao, dataDevolucao, multa FROM emprestimos WHERE ativo = 'S'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<div class=\"container-fluid\">";
    echo "<div id=\"Tab\">";
    echo "<ul class=\"list-group\">";
    while($row = $result->fetch_assoc()) {
      echo "<li class=\"list-group-item align-items-center\" >ID Aluno: ".$row["idAluno"]." | ID Acervo: ".$row["idAcervo"]." | Data empréstimo: ".$row["dataEmprestimo"]."</li>";
    }
    echo "</ul>
          </div>
          </div>";
    echo "
       
          <div class=\"margem-DLTEmp\">
         
                <form id=\"DLTemprestimo\" action=\"../Opcoes-do-sistema/Manutencao-emprestimos/BLT-Web-DLTEmprestimos2.php\" method= \"post\">
                  <div class=\"row\" style=\"margin: 70px;\">
                    <div class=\"col-md-6 mb-3\">
                      <label for=\"IDAcervo\">ID do acervo que deseja devolver</label>
                      <input type=\"text\" class=\"form-control is-valid\" id=\"IDAcervo\" name=\"IDAcervo\" placeholder=\"ID do acervo\" >
                    </div>
                    <div class=\"col-md-6 mb-3\">
                      <label for=\"validationServer02\"></label>
                      <button id=\"EnvioData\" type=\"button\" data-toggle=\"modal\" data-target=\"#exampleModal\" class=\"btn btn-outline-info btn-block btn-lg\">Remover</button>
                    </div>
                  
                    <div class=\"modal fade\" id=\"exampleModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
                        <div class=\"modal-dialog\" role=\"document\">
                          <div class=\"modal-content\">
                            <div class=\"modal-header\">
                              <h5 class=\"modal-title\" id=\"exampleModalLabel\">Data de entrega</h5>
                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                              </button>
                            </div>
                            <div class=\"modal-body\">
                                <div class=\"col-md-6 mb-3\">
                                  <label for=\"validationServer02\">Data de devolução</label>
                                  <input type=\"date\" name=\"datadevolucao\" class=\"form-control is-valid\" id=\"validationServer02\" placeholder=\"ID\" value=\"\" required>
                                </div>
                            </div>
                            <div class=\"modal-footer\">
                              <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Fechar</button>
                              <button type=\"submit\" id=\"Envio\" class=\"btn btn-primary\">Pronto</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>  
              </div>
            </div>
          </body>";
} else {
    echo "<div class=\"corpo\">";
    echo "<div class=\"titulo\">";
    echo "<h3><b>Sem valores no banco de dados</b></h3>";
    echo "</div>";
    /*echo "</div>
    <div class=\"container-fluid\">
      <div class=\"row\">
        <div class=\"col-md-12 mb-3\">
          <button type=\"button\" class=\"btn btn-outline-info btn-block \" onclick=\"window.location.href='gerencia-web-interface-bibliotecario.php?acao=removerEmprestimo'\">Pronto</button>
        </div>
      </div>
      </div>";*/
}

$conn->close();
?>

