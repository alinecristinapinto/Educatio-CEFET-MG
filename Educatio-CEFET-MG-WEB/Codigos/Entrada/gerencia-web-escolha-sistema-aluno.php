<?php 
  session_start(); 

  $usuario = $_SESSION['usuario'];
  
  echo "<script> 
          if(window.sessionStorage.getItem('logado') == 'N') 
            location.href = '../Login/gerencia-web-login.html'; 
        </script>";

   // header ('Content-type: text/html; charset=ISO-8859-1');      
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bem Vindo - Educatio CEFET-MG</title>
	<meta charset="utf-8" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />

  <!-- CSS do Bootstrap -->
  <link href="../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

  <!-- Arquivos js -->
  <script src="../../Estaticos/Bootstrap/js/popper.js"></script>
  <script src="../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
  <script src="../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  
  <!-- Fontes e icones -->
  <link href="../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
 
  <style type="text/css">

    .profile{
      border: 1px solid;
      border-radius: 25px;
      width: 22px; 
      height: 22px;
    }

    h1{
      text-align: center;
      font-size: 45px;
      color: #d8ac29;
    }

    .par{
      font-size: 30px;
    }

    .entrada{
      height: 200px;
      width: 200px;
      position:absolute;
      top:50%;
      left:50%;
      margin-top:-50px;
      margin-left:-50px;
    }

    .centralizado{
      text-align: center;
    }
    
    .navbar{
      background-color: black;
    }
    
    .logo{
      margin-top: -5px;
      height: 31px;
      width: 30px;
    }
    
    .perfil{
      border: 1px solid;
      border-radius: 25px;
      width: 22px; 
      height: 22px;
    }
    
    .navbar-expand-md{
      background-color: #0a0744;
    }
     
    .navbar .navbar-toggler .navbar-toggler-bar {
      background: white;
    }
    
    .navbar .navbar-nav .nav-item .nav-link {
      color: white;
    }

  </style>  
  
  <script type="text/javascript">
    function fazerLogout(){
    window.sessionStorage.setItem('logado', 'N'); 
  }  
  </script> 
</head>
<body> 

  <?php 
    require "../../Menu-rodape/gerencia-web-menu-escolha-sistema-aluno.php";
  ?>

  <div>
  <h1>Bem Vindo(a) ao Sistema Educatio-CEFET-MG</h1><br>
  <p class="par centralizado">Escolha qual Sistema deseja acessar no momento.</p>
  <img class="entrada" src="../../Estaticos/Logo/Educatio.png">    
  </div>  

  <?php 

    require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";

  ?>

</body>
</html>  