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
      require "../../Menu-rodape/gerencia-web-menu-interface-aluno-academico.php";

      switch($_GET['acao']){
        case "acessarDiario": 
          require "../Opcoes-do-sistema/Diario-aluno/Diario-aluno.php";
          echo "<br>";
          require "../../Menu-rodape/gerencia-web-rodape.php";
          break; 
        case "downloadHistorico": 
          require "../Opcoes-do-sistema/Relatorios/relatorio-7-historico/gerencia-web-chama-codigo-com-mpdf.php";
          echo "<br>";
          require "../../Menu-rodape/gerencia-web-rodape-caso-2.php";
          break;  
        case "mostrarCertificado": 
          require "../Opcoes-do-sistema/Relatorios/relatorio-8-certificado/JHJ-web-relatorio8-certificados-2.php";
          $_SESSION['opcaoEscolhida'] = "mostrarNaTela";
          echo "<br>";
          require "../../Menu-rodape/gerencia-web-rodape-caso-2.php";
          break; 
        case "downloadCertificado": 
          require "../Opcoes-do-sistema/Relatorios/relatorio-8-certificado/JHJ-web-relatorio8-certificados-2.php";
          $_SESSION['opcaoEscolhida'] = "fazerDownload";
          echo "<br>";
          require "../../Menu-rodape/gerencia-web-rodape-caso-2.php";
          break;  
        case "default": 
          require "gerencia-web-tela-aluno-default.php";
          echo "<br>";
          require "../../Menu-rodape/gerencia-web-rodape-caso-2.php";
          break;  
      }
      
    ?>        

</body>
</html>  