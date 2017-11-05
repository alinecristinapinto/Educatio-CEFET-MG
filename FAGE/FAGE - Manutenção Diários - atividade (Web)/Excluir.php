<?php 
  $servername = "localhost";
  $username = "root";
  $password = null;
  $dbname = "educatio";

  //cria conexão
  $conn = new mysqli( $servername, $username, $password, $dbname );
  //verifica conexão
  if ( $conn->connect_error ) {
    die( "Falha na conexão: " .$conn->connect_error. "<br>" );
  }
?>
<!DOCTYPE html>
<!-- CSS do Bootstrap -->
<link href = "css/bootstrap.min.css" rel = "stylesheet" />
<link href = "css/bootstrap.css" rel = "stylesheet" />

<!-- CSS do grupo -->
 <link href = "" rel = "stylesheet" />

<!-- Arquivos js -->
<script src = "js/popper.js"></script>
<script src = "js/jquery-3.2.1.js" type = "text/javascript"></script>
<script src = "js/bootstrap.min.js" type = "text/javascript"></script>

<!-- Fontes e icones -->
<link href = "css/nucleo-icons.css" rel = "stylesheet">
<style type = "text/css">
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
      filter: alpha( opacity = 100 );
     }

   .btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .show > .btn-info.dropdown-toggle {
      background-color: #11277a;
      color: #FFFFFF;
      border-color: #11277a;
    }
</style>
<html>
<head>
	<title></title>
</head>
<body>
  <div class = "section landing-section">
  	<div class = "container">
      <div class = "row">
        <div class = "col-md-8 ml-auto mr-auto">
          <h2 class = "text-center"> Excluir Atividade </h2>
            <form class = "contact-form" method = "POST" action = "Exclui.php">
          		<div class = "row">
              		<label class = "fonteTexto" for = "NomeAtividade"> Nome da Atividade </label>
              		<div class = "input-group">
                    <span class = "input-group-addon">
                        <i class = "nc-icon nc-check-2"></i>
                    </span>  
                    <input type = "text" class = "form-control" id = "NomeAtividade" name = "nome" required>
                  </div>
            	</div>
              <div class = "row">
                <label class = "fonteTexto"> Turma da Materia </label>
                  <div class = "input-group">
                    <span class = "input-group-addon">
                      <i class = "nc-icon nc-book-bookmark"></i>
                     </span>
                     <select class = "form-control" name = "materia" id = "MateriaAtividade" required>
                        <?php 
                          $idprof = 9543746; //$_SESSION['usuario']->idSIAPE;
                          $resultados = $conn->query( "SELECT idDisciplina, id, ativo FROM profdisciplinas WHERE idProfessor = $idprof  AND ativo = 'S' ORDER BY idDisciplina ASC "); 
                          $aux = -1;
                        ?>  
                        <option> Escolha a displina e turma </option>
                        <?php while( $linha = $resultados->fetch_assoc() ) { ?>
                              <?php
                                    $dis = $linha['idDisciplina'];
                                    if ( $aux != $dis ) {
                                        $aux = $dis;
                                        $disciplinas = $conn->query( "SELECT nome FROM disciplinas WHERE id = $dis AND ativo = 'S' " );
                                        $idturmas = $conn->query( "SELECT idTurma FROM profdisciplinas WHERE idDisciplina  = $dis AND idProfessor = $idprof AND ativo = 'S' " );
                              ?>
                                    <?php 
                                          while( $disciplina = $disciplinas->fetch_assoc() ) { ?>
                                                <optgroup label = "<?php echo "Disciplina: " .$disciplina['nome'] ?>">
                                    <?php } ?>
                                    <?php 
                                          while( $idturma = $idturmas->fetch_assoc() ){
                                                $idt = $idturma['idTurma'];
                                                $turma = $conn->query( "SELECT nome FROM turmas WHERE id = $idt AND ativo = 'S' " );
                                                $idprofdisplina = $conn->query( "SELECT id FROM profdisciplinas WHERE idProfessor = $idprof AND idTurma = $idt AND idDisciplina = $dis AND ativo = 'S' " );
                                    ?>  
                                          <?php 
                                                while( $tur = $turma->fetch_assoc() ){ 
                                          ?>
                                                      <option value = "<?php echo $linha['id'] ?>"> 
                                                        <?php echo "Turma: " .$tur['nome'] ?>
                                                      </option>
                                          <?php } ?>
                                    <?php } ?>     
                                          
                                              </optgroup>
                              <?php } ?>
                        <?php } ?>
                      </select>
                  </div>
              </div>
            	<div class = "row">
                <div class = "col-md-4 ml-auto mr-auto">
                  <button type = "submit" class = "btn btn-info btn-round"> Excluir </button>
              </div>
          	</form>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
<?php
  mysqli_close($conn);
?>