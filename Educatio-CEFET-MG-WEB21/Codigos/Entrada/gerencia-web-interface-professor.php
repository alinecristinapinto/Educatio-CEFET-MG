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
	<meta charset="utf-8" />
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
      require "../../Menu-rodape/gerencia-web-menu-interface-professor.php";

      switch ($_GET['acao']) {
        case 'acessarDiarios':
          require "../Opcoes-do-sistema/Manutencao-diario/PHJL-WEB-Pesquisa-turma-diario.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
          break;
        case 'adicionarEtapa':
          require "../Opcoes-do-sistema/Manutencao-etapas/CJF-AdicionarEtapas1.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
          break;
        case 'removerEtapa':
          require "../Opcoes-do-sistema/Manutencao-etapas/CJF-ExcluirEtapas1.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
          break;
        case 'alterarEtapa':
          require "../Opcoes-do-sistema/Manutencao-etapas/CJF-AlterarEtapas1.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
          break;       
      }  
    ?>

</body>
</html>  