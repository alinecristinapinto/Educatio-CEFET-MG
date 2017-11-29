<!DOCTYPE html>
<html>
<head>
  <title>Educatio - CEFET-MG </title>
  <meta charset="utf-8">
  <!-- CSS do grupo -->
    <link href="../Opcoes-do-sistema/Manutencao-disciplinas/BLT-Web-Disciplinas.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">

      <style type="text/css">
        .text-center{
           font-family: 'Abel', sans-serif;
           color: #d8ac29;
        }
        .fonteTexto{
           font-family: 'Inconsolata', monospace;
           font-size: 16px;
        }
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
  <h1 class="text-center"><b>Gerenciamento de Disciplinas</b></h1>
</div>
</div>
</body>
</html>


<?php
$servername = "localhost";
$username = "root";
$password = "usbw";
$bdNome = "educatio";

//header ('Content-type: text/html; charset=ISO-8859-1');

// Create connection
$conn = new mysqli($servername, $username, $password, $bdNome);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT idTurma, nome, cargaHorariaMin FROM disciplinas WHERE ativo = 'S'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<div class=\"container\">";
  	echo "<div class=\"row\">";
      echo "<div class=\"col-md-12 ml-auto mr-auto\">";
        echo "<div class=\"TabelaExclusao\">";
          echo "<ul class=\"list-group\">";
            while($row = $result->fetch_assoc()) {
              echo "<li class=\"list-group-item align-items-center\">ID Turma: ".$row["idTurma"]." | Nome da disciplina: ".$row["nome"]." | Carga horaria minima: ".$row["cargaHorariaMin"]."
                  </li>";
            }
            echo " </ul>
        </div>
      </div>
    </div>
  </div>";

  echo "<h1 class='text-center'><b>Edição de Disciplinas</b></h1><br><br>";

  echo "<body>
          <div class=\"container\">
            <div class=\"row\">
              <div class=\"col-md-8 ml-auto mr-auto\">

                <form action=\"../Opcoes-do-sistema/Manutencao-disciplinas/BLT-Web-EDTDisciplinas2.php\" method=\"post\">

                <div class=\"row\">
                  <label class=\"fonteTexto\">Nome da disciplina que deseja editar</label>
                    <div class=\"input-group\">
                      <span class=\"input-group-addon\">
                        <i class=\"nc-icon nc-ruler-pencil\"></i>
                      </span>
                      <input type=\"text\" name=\"nome\" class=\"form-control\" placeholder=\"Nome da disciplina\" required=\"required\">
                    </div>
                </div>
                <br>

                <div class=\"row\">
                  <label class=\"fonteTexto\">ID da turma que vai editar a disciplina</label>
                    <div class=\"input-group\">
                      <span class=\"input-group-addon\">
                        <i class=\"nc-icon nc-hat-3\"></i>
                      </span>
                      <input type=\"text\" name=\"idTurma\" class=\"form-control\" placeholder=\"ID da turma\" required=\"required\">
                    </div>
                </div>
                <br>

                <div class=\"row\">
                  <div class=\"col-md-4 ml-auto mr-auto\">
                      <button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#modall\">Editar</button>
                  </div>
                </div>

                <div class=\"modal fade\" id=\"modall\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog\" role=\"document\">
                      <div class=\"modal-content\">
                        <div class=\"modal-header\">
                          <h5 class=\"modal-title\" id=\"exampleModalLabel\">Edição de disciplina</h5>
                          <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                          </button>
                        </div>
                        
                        <div class=\"modal-body\">
                            <div class=\"col-md-6 mb-3\">
                              <label for=\"validationServer02\">Nome da disciplina</label>
                              <input type=\"text\" name=\"nomeedt\" class=\"form-control is-valid\" id=\"validationServer02\" placeholder=\"Nome\" value=\"\" required>
                              <label for=\"validationServer02\">Id da turma</label>
                              <input type=\"number\" name=\"idTurmaedt\" class=\"form-control is-valid\" id=\"validationServer02\" placeholder=\"ID\" value=\"\" required>
                              <label for=\"validationServer02\">Carga horária mínima</label>
                              <input type=\"number\" name=\"carga\" class=\"form-control is-valid\" id=\"validationServer02\" placeholder=\"Horas\" value=\"\" required>
                            </div>
                        </div>

                        <div class=\"modal-footer\">
                          <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Fechar</button>
                          <button type=\"submit\" class=\"btn btn-primary\">Pronto</button>
                        </div>
                      
                      </div>
                    </div>
                </div>

                </form>

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
        <button type=\"button\" class=\"btn btn-info\" onclick=\"window.location.href='gerencia-web-interface-coordenador.php?acao=editarDisciplina'\">Pronto</button>
      </div>
    </div>";
}

$conn->close();
?>

