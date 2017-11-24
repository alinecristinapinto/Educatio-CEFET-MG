<!DOCTYPE html>
<html>
<head>
  <title>Educatio - CEFET-MG </title>
  <meta charset="utf-8">

  <!-- CSS do Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap.css" rel="stylesheet"/>

  <!-- CSS do grupo -->
    <link href="BLT-Web-Emprestimos.css" rel="stylesheet">

  <!-- Arquivos js -->
    <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/popper.js" type="text/javascript"></script>

  <!-- Fontes e icones -->
    <link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
    <link href="css/nucleo-icons.css" rel="stylesheet">

    <style type="text/css">
      .btn-info {
        background-color: #162e87;
        border-color: #162e87;
        color: #FFFFFF;
        opacity: 1;
        filter: alpha(opacity=100);
      }
      .btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .show > .btn-info.dropdown-toggle {
        background-color: #11277a;
        color: #FFFFFF;
        border-color: #11277a;
      }
      .fonteTexto{
         font-family: 'Inconsolata', monospace;
         font-size: 16px;
      }
    </style>

 </head>

<body>
<div class="corpo">
  <div class="titulo">
  <h1><b>Gerenciamento de Empréstimos</b></h1>
  </div>
</div>
</body>
</html>


<?php
$servername = "localhost";
$username = "root";
$password = "";
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
  echo "<div class=\"row\">";
	echo "<div class=\"container-fluid\">";
      echo "<div id=\"Tab\">";
        echo "<ul class=\"list-group\">";
          while($row = $result->fetch_assoc()) {
    	     echo "<li class=\"list-group-item align-items-center\" >ID Aluno: ".$row["idAluno"]." | ID Acervo: ".$row["idAcervo"]." | Data empréstimo: ".$row["dataEmprestimo"]."</li>";
    }
    echo "</ul>
          </div>
          </div>
          </div>";
    echo "<body>
            <div class=\"section landing-section\">
              <div class=\"container\">
                <div class=\"row\">
                  <div class=\"col-md-8 ml-auto mr-auto\">

                    <form id=\"DLTemprestimo\">

                          <div class=\"row\">
                            <label class=\"fonteTexto\">ID do acervo que deseja devolver</label>
                              <div class=\"input-group\">
                                <span class=\"input-group-addon\">
                                  <i class=\"nc-icon nc-ruler-pencil\"></i>
                                </span>
                                <input type=\"text\" name=\"IDAcervo\" class=\"form-control\" placeholder=\"ID do acervo\" required=\"required\">
                              </div>
                          </div>
                          <br>

                          <div class=\"row\">
                            <div class=\"col-md-4 ml-auto mr-auto\">
                                <button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#exampleModal\">Remover</button>
                            </div>
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
                                  <button type=\"button\" id=\"Envio\" class=\"btn btn-primary\">Pronto</button>
                                </div>
                              </div>
                            </div>
                          </div>                    
                    </form>  
                  </div>
                </div>
              </div>  
            </div>  
          </body>";
} else {
    echo "<div class=\"corpo\">";
    echo "<div class=\"titulo\">";
    echo "<h1><h3><b>Sem valores no banco de dados</b></h3></h1>";
    echo "</div>";
    echo "</div>
    <div class=\"row\">
      <div class=\"col-md-4 ml-auto mr-auto\">
        <button type=\"button\" class=\"btn btn-info\" onclick=\"window.location.href='BLT-Web-Emprestimos.html'\">Pronto</button>
      </div>
    </div>";
}

$conn->close();
?>

