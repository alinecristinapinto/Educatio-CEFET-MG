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

        .img {
          height: 120px;
          width: 120px;
        }    
    </style>  

</head>
<body>

    <?php 
    
      require "../../Menu-Rodape/gerencia-web-menu-interface-bibliotecario.php";

      switch ($_GET['acao']) {
        case 'acessarManutencaoAcervo':
          require "../Opcoes-do-sistema/Manutencao-acervo/pagina_inicial_manutencaoacervo.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape.php";
          break;
        case 'fazerDescarte':
          require "../Opcoes-do-sistema/Descarte/FAGE-WEB-form.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape.php";
          break;  
        case 'adicionarEmprestimo':
          require "../Opcoes-do-sistema/Manutencao-emprestimos/BLT-Web-ADCEmprestimos1.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
          break;  
        case 'removerEmprestimo':
          require "../Opcoes-do-sistema/Manutencao-emprestimos/BLT-Web-DLTEmprestimos1.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
          break;  
        case 'acessarObrasAcervo':
          require "../Opcoes-do-sistema/Relatorios/relatorio-1-obras-acervo/CJF-RelacaoAcervo1.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
          break;
        case 'acessarObrasEmprestadas':
          require "../Opcoes-do-sistema/Relatorios/relatorio-2-obras-emprestadas/CJF-RelacaoObras1.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
          break;
        case 'acessarObrasReservadas':
          require "../Opcoes-do-sistema/Relatorios/relatorio-3-obras-reservadas/CJF-RelacaoReservas1.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
          break;
        case 'acessarObrasDescartadas':
          require "../Opcoes-do-sistema/Relatorios/relatorio-6-obras-descartadas/MAE-Web-RelatorioObrasDescartadas-Bibliotecario1.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
          break;   
        case 'acessarAtrasos':
          require "../Opcoes-do-sistema/Relatorios/relatorio-4-atrasos/MAE-Web-RelatorioAtraso-Bibliotecario1.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
          break;
        case 'acessarMultas':
          require "../Opcoes-do-sistema/Relatorios/relatorio-5-multas/MAE-Web-RelatoriosMultas-Bibliotecario.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
          break;   
        
      }
    
    ?>

</body>
</html>  