<!DOCTYPE html>

<!-- CSS do Bootstrap -->
<link href = "css/bootstrap.min.css" rel = "stylesheet" />
<link href = "css/bootstrap.css" rel = "stylesheet" />

<!-- CSS do grupo -->
 <link href ="" rel = "stylesheet" />

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

<!-- HTML para criar os botões da página -->
<html>
<head>
	<title></title>
</head>
<body>
	<div class = "section landing-section">
    <div class = "container">
      <div class = "row">
        <div class = "col-md-8 ml-auto mr-auto">
          <h2 class = "text-center"> Atividade </h2>
            <form class = "contact-form" method = "POST" action = "Atividades.php">
          	   <div class = "row">
                  <div class = "col-md-6 ml-auto mr-auto">
                    <button type = "submit" class = "btn btn-success  btn-lg btn-block" name = "criar" value = "criar"> Criar </button>
                  </div>
                </div>
                <div class = "row">
                  <div class = "col-md-6 ml-auto mr-auto">
          	        <button type = "submit" class = "btn btn-primary  btn-lg btn-block" name = "editar" value = "editar"> Editar </button>
                  </div>
                </div>  
                <div class = "row">
                  <div class = "col-md-6 ml-auto mr-auto">
                    <button type = "submit" class = "btn btn-danger  btn-lg btn-block" name = "deletar" value = "deletar"> Deletar </button>
                  </div>
                </div>
          	</form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<!-- PHP para redirecionar o botão para nova página -->

<?php
  if( isset( $_POST['criar'] ) ){
    header( 'Location: Criar.php' );
  }

  if( isset( $_POST['editar'] ) ){
    header( 'Location: Alterar.php' );
  }

  if( isset( $_POST['deletar'] ) ){
    header( 'Location: Excluir.php' );
  }
?>
