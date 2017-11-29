<?php 
 // session_start(); 

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
    <nav class="navbar navbar-expand-md navbar-default">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand"><img class="logo" src="../../../Estaticos/Logo/Educatio.png"></a>
           
        <div id="menu" class="collapse navbar-collapse" id="navbar-menu"> 
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarManutencaoAcervo"><i class="nc-icon nc-book-bookmark"></i>Manutenção do acervo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../Entrada/gerencia-web-interface-bibliotecario.php?acao=fazerDescarte"><i class="nc-icon nc-book-bookmark"></i>Descarte de obras</a>
                </li>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" role="button" aria-haspopup="true" aria-expanded="false"><i class="nc-icon nc-book-bookmark"></i>Empréstimos</a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href= "../../Entrada/gerencia-web-interface-bibliotecario.php?acao=adicionarEmprestimo">Conceder empréstimo</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../../Entrada/gerencia-web-interface-bibliotecario.php?acao=removerEmprestimo">Remover empréstimo</a>
                    </ul>
                </div>          
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" role="button" aria-haspopup="true" aria-expanded="false"><i class="nc-icon nc-icon nc-sound-wave"></i>Relatórios</a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href= "../../Entrada/erencia-web-interface-bibliotecario.php?acao=acessarObrasAcervo">Obras do acervo</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href= "../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarObrasEmprestadas">Obras emprestadas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href= "../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarObrasReservadas">Obras reservadas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarObrasDescartadas">Obras descartadas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href= "../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarAtrasos">Atrasos de devolução</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarMultas">Multas</a>
                    </ul>
                </div>   
            </ul>
            <ul class="nav navbar-nav">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" role="button" aria-haspopup="true" aria-expanded="false">
                    <?php 

                        if($usuario['foto'] == null){
                          echo '<img class="profile" src="../../../Estaticos/imagens/perfil.png"/>';

                        } else {
                          echo '<img class="profile" src="data:image/jpeg;base64,'.base64_encode( $usuario['foto'] ).'"/>';
                        }
                    ?> 
                    <?php echo $usuario['nome'];?> <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="gerencia-web-perfil-bibliotecario.php">Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href= "../Login/gerencia-web-login.html" onclick = "fazerLogout()">Sair</a>
                    </ul>
                </div> 
            </ul>
        </div>
    </nav>
</body>
</html>