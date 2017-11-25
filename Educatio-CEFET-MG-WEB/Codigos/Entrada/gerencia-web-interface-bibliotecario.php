<?php 
  session_start(); 

  $usuario = $_SESSION['usuario'];

  echo "<script> 
          if(window.sessionStorage.getItem('logado') == 'N') 
            location.href = '../Login/gerencia-web-login.html'; 
        </script>";
   
  //header ('Content-type: text/html; charset=ISO-8859-1');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bem Vindo - Educatio CEFET-MG</title>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />

 <!-- CSS do Bootstrap -->
  <link href="../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

  <!-- CSS do grupo -->
  <link href="../../Estaticos/CSS/gerencia-web-login.css" rel="stylesheet">
  <link href="gerencia-web-interfaces.css" rel="stylesheet">

  <!-- Arquivos js -->
  <script src="../../Estaticos/Bootstrap/js/popper.js"></script>
  <script src="../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
  <script src="../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    
  <!-- js do grupo -->
  <script src="../../Estaticos/js/gerencia-web-login.js"></script>

  <!-- Fontes e icones -->
  <link href="../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">

  <script type="text/javascript">
      function fazerLogout(){
          window.sessionStorage.setItem('logado', 'N');
      }  
  </script>

</head>
<body>

    <?php 
    
      require "../../Menu-Rodape/gerencia-web-menu-interface-bibliotecario.php";

      switch ($_GET['acao']) {
        case 'adicionarAluno':
          require "..Opcoes-do-sistema/insercao-aluno/PHJL-WEB-Formulario-de-insercao-de-aluno.php";
          break;
        
      }
      
      echo '<br>';

      require "../../Menu-Rodape/gerencia-web-rodape.php";
    
    ?>

</body>
</html>  