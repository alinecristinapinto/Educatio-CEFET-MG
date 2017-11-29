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
    <title>Login - Educatio - CEFET-MG</title>
    <meta charset="utf-8">
    <style type="text/css">
        <style type="text/css">
        .profile{
          border: 1px solid;
          border-radius: 25px;
          width: 22px; 
          height: 22px;
        }
        
        .logo{
          margin-top: -5px;
          height: 31px;
          width: 30px;
        }
        
        .img {
          height: 22px;
          width: 23px;
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
    </style>
</head>
<body>
	<nav class="navbar navbar-expand-md fixed-top" color-on-scroll="150">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand"><img class="logo" src="../../Estaticos/Logo/Educatio.png"> Sistema Educatio-CEFET-MG</a>
        
            <ul class="nav navbar-nav">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" role="button" aria-haspopup="true" aria-expanded="false">

                    <?php 

                        if($usuario['foto'] == null){
                          echo '<img class="profile img" src="../../Estaticos/imagens/perfil.png"/>';

                        } else {
                          echo '<img class="profile" src="data:image/jpeg;base64,'.base64_encode( $usuario['foto'] ).'"/>';
                        }
                    ?> 

                    <?php echo $usuario['nome'];?> <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href= "../Login/gerencia-web-login.html" onclick = "fazerLogout()">Sair</a>
                    </ul>
                </div> 
            </ul>
        </div>
    </nav>    
</body>
</html>