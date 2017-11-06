<!DOCTYPE html>
<html>
<head>
  <title>Educatio - CEFET-MG </title>
  <meta charset="utf-8">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="gerencia-web-estilos-rodape.css" rel="stylesheet">
  <link href="BLT-Web-Disciplinas.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script> 
 </head>
<body>
<div class="corpo">
  <div class="titulo">
  <h1><b>Gerenciamento de Disciplinas</b></h1>
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

$sql = "SELECT idTurma, nome, cargaHorariaMin FROM disciplinas WHERE ativo = 'S'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<div class=\"container-fluid\">";
    echo "<div class=\"TabelaExclusao\">";
    echo "<ul class=\"list-group\">";
    while($row = $result->fetch_assoc()) {
    	echo "<li class=\"list-group-item align-items-center\">ID Turma: ".$row["idTurma"]." | Nome da disciplina: ".$row["nome"]." | Carga horária mínima: ".$row["cargaHorariaMin"]."</li>
        </ul>
        </div>
        </div>";
  }
  echo "<body>
          <div class=\"margem-DLTEmp\">
          <div class=\"container-fluid\">
          <form action=\"BLT-Web-RMVDisciplinas2.php\" method=\"post\">
              <div class=\"row\" style=\"margin: 70px;\">
                <div class=\"col-md-6 mb-3\">
                    <label for=\"validationServer02\">Nome da disciplina que deseja excluir</label>
                    <input type=\"text\" class=\"form-control is-valid\" id=\"validationServer02\" name=\"nome\" placeholder=\"Nome da disciplina\" value=\"\" required>

                  </div>

                  <div class=\"col-md-6 mb-3\">
                  <label for=\"validationServer02\">ID da turma que vai excluir a disciplina</label>
                    <input type=\"text\" class=\"form-control is-valid\" id=\"validationServer02\" name=\"idTurma\" placeholder=\"ID da turma\" value=\"\" required>
                    </div>
                    <div class=\"col-md-12 mb-3\">
                    <label for=\"validationServer02\"></label>
                    <button type=\"submit\" class=\"btn btn-outline-info btn-block btn-lg\">Remover</button>


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
    echo "<h1><h3><b>Sem valores no banco de dados</b></h3></h1>";
    echo "</div>";
    echo "</div>
    <div class=\"container-fluid\">
      <div class=\"row\">
        <div class=\"col-md-12 mb-3\">
          <button type=\"button\" class=\"btn btn-outline-info btn-block \" onclick=\"window.location.href='BLT-Web-Disciplinas.html'\">Pronto</button>
        </div>
      </div>
      </div>";
}

$conn->close();
?>

