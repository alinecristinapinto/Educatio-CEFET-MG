<!-- PHP para fazer conexão com BD -->
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
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/bootstrap.css" rel="stylesheet"/>

<!-- CSS do grupo -->
 <link href="" rel="stylesheet" />

<!-- Arquivos js -->
<script src="js/popper.js"></script>
<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>

<!-- Fontes e icones -->
<link href="css/nucleo-icons.css" rel="stylesheet">

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
</style>

<html>
<head>
	<title></title>
</head>
<body>
	<div class="section landing-section">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <h2 class="text-center"> Criar Atividade </h2>
            <form class="contact-form" method = "POST" action = "Cria.php">
              <div class = "row">
                <label class="fonteTexto" for = "NomeAtividade"> Nome da Atividade </label>
                <div class="input-group">
                    <span class="input-group-addon">
                      <i class="nc-icon nc-check-2"></i>
                    </span>  
                    <input type = "text" class = "form-control" id = "NomeAtividade" name = "nome" required>
                </div>
              </div>
            <div class = "row">
              <label class="fonteTexto" for = "DataAtividade"> Data da Atividade </label>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="nc-icon nc-calendar-60"></i>
                </span>  
                <input type = "date" class = "form-control" id = "DataAtividade" name = "data" required>
              </div>
            </div>
          	<div class = "row">
              <label class="fonteTexto" for = "ValorAtividade"> Valor da Atividade </label>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="nc-icon nc-simple-add"></i>
                </span>  
                <input type = "number" class = "form-control" min = "0.1" step = "any" class = "form-control" id = "ValorAtividade" name = "valor" required>
              </div>
            </div>
            <div class = "row">
              <label class="fonteTexto" for = "MateriaAtividade"> Turma da Materia </label>
               <div class="input-group">
                  <span class="input-group-addon">
                    <i class="nc-icon nc-book-bookmark"></i>
                  </span>
                  <select class = "form-control" name = "materia" id = "MateriaAtividade" required>
                    <?php 
                      //variável utilizada para pegar o id do Usuario através da variável SESSION
                      $idprof = 9543746; //$_SESSION['usuario']->idSIAPE;
                      //busca todas as disciplinas ministradas pelo professor idDisplina e id -> idProfDisciplina
                      $resultados = $conn->query( "SELECT idDisciplina, id, ativo FROM profdisciplinas WHERE idProfessor = $idprof  AND ativo = 'S' ORDER BY idDisciplina ASC "); 
                      //utilizada para descartar disciplinas desativadas
                      $aux = -1;
                    ?>  
                    <option> Escolha a displina e turma </option>
                    <?php while( $linha = $resultados->fetch_assoc() ) { ?>
                          <?php
                                $dis = $linha['idDisciplina'];
                                if ( $aux != $dis ) {
                                    $aux = $dis;
                                    //busca o nome da disciplina referente ao idDisciplina
                                    $disciplinas = $conn->query( "SELECT nome FROM disciplinas WHERE id = $dis AND ativo = 'S' " );
                                    //busca o id de todas turmas que o professor ministra essa disciplina
                                    $idturmas = $conn->query( "SELECT idTurma FROM profdisciplinas WHERE idDisciplina  = $dis AND idProfessor = $idprof AND ativo = 'S' " );
                          ?>
                              <?php 
                                    //nesse while criamos o optgroup di select com o nome das disciplinas ministradas
                                    while( $disciplina = $disciplinas->fetch_assoc() ) { ?>
                                          <optgroup label = "<?php echo "Disciplina: " .$disciplina['nome'] ?>">
                              <?php } ?>
                               <?php  
                                    //esse while serve para buscar no BD todas informações que fazem o option do select
                                    while( $idturma = $idturmas->fetch_assoc() ){
                                          $idt = $idturma['idTurma'];
                                          //busca no BD os nomes das turma referentes aos ids de $idturmas
                                          $turma = $conn->query( "SELECT nome FROM turmas WHERE id = $idt AND ativo = 'S' " );
                                          //busca o id -> idProfDisciplina referente ao idTurma e idDisciplina  do idProfessor
                                          $idprofdisplina = $conn->query( "SELECT id FROM profdisciplinas WHERE idProfessor = $idprof AND idTurma = $idt AND idDisciplina = $dis AND ativo = 'S' " );
                                ?>  
                                    <?php 
                                          //esse while faz a inserção dos valores no option do select
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
            <div class="row">
              <div class="col-md-4 ml-auto mr-auto">
                <button type="submit" class="btn btn-info btn-round">Criar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<!-- Fecha conexão com BD -->
<?php
  $conn->close();
?>