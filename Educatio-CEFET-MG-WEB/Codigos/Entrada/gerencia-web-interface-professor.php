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
    ?>
    
    <footer class="footer footer-black">
        <div class="container centralizado">
            <div class="row">
                <div class="col-md-4">
                   <h6><strong>Desenvolvedores</strong></h6>
                        <p></span> Alunos da turma de Informática 2A 2017 do CEFET-MG.
                        <a href="#">Clique aqui</a> para saber mais.</p>  
                </div>
                <div class="col-md-4">
                    <h6><strong>Instituição</strong></h6>
                        <p>Centro Federal de Educação Tecnológica de Minas Gerais. Av. Amazonas 5253 - Nova                         Suíssa - Belo Horizonte - Brasil.</p>
                </div>
                <div class="col-md-4">       
                    <h6>Recursos Utilizados</h6>
                    <p>
                        <a href="https://github.com/NinaCris16/Educatio-CEFET-MG">GitHub</a><br>
                        <a href="http://getbootstrap.com/">Bootstrap</a><br>
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>  