<!DOCTYPE html>
<html>
<head>
	<title>Bem Vindo - Educatio CEFET-MG</title>
	<meta charset="utf-8">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="gerencia-web-escolha-de-sistema.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script> 

  <?php 

    require '../gerencia-web-conecta-login.php'; 

    session_start();

    //print_r($_SESSION['usuario']);

  ?>

</head>
<body>

	<nav role="navigation" class="navbar navbar-default">        
        <div class="navbar-header">
            <button type="button" data-target="#menu" data-toggle="collapse" class="navbar-toggle">                    
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                
            </button>                
            <a href="#" class="navbar-brand"><img class="slogan" src="imagens/slogan.png"></a>
        </div>
            
        <div id="menu" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li><a href="#"><span class="glyphicon glyphicon-book"></span> Acessar Biblioteca</a>
                <li><a href="#"><span class="glyphicon glyphicon-folder-open"></span>  Acessar Sistema Acadêmico</a>
           </ul>

           <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo '<img class="profile" src="data:image/jpeg;base64,'.base64_encode( $_SESSION['usuario']->foto ).'"/>';?>  <?php echo $_SESSION['usuario']->nome;?> <span class="caret"></span>&emsp;</a>

                  <ul class="dropdown-menu">
                    <li><a href= <?php session_start(); session_destroy(); header("Location: ../gerencia-web-login.html"); ?>><span class="glyphicon glyphicon-log-out"></span> - Sair</a></li>
                  </ul>
              </li>
            </ul>
        </div>
    </nav>   

    <div class="alinhador">
      <h1>Sistema Educatio - CEFET-MG</h1>

      <p>Seja Bem Vindo(a) <?php echo $_SESSION['usuario']->nome;?>!</p>
      <p>Escolha qual sistema irá acessar!</p>    

    </div>
    
    <div class="container">
    <div class="row">
      <h3 class="footertext"><strong>  Quem Somos?</strong></h3><br>
        <div class="col-md-4">
          <center>
            <img src="imagens/prom.jpg" class="img-circle">
              <h4 class="footertext"><strong>Desenvolvedores</strong></h4>
              <p class="footertext"></span> Alunos da turma de Informática 2A 2017 do CEFET-MG unidos para o desenvolvimento deste projeto. <a href="#">Clique aqui</a> para saber mais.</p>
          </center>
        </div>
        <div class="col-md-4">
          <center>
            <img src="imagens/cefetop.png" class="img-circle">
            <h4 class="footertext"><strong>Instituição</strong></h4>
            <p class="footertext">Centro Federal de Educação Tecnológica de Minas Gerais. Av. Amazonas 5253 - Nova Suíssa - Belo
             Horizonte - Brasil.</p>
          </center>
        </div>
        <div class="col-md-4">
          <center>
            <img src="imagens/bootstrap.png" class="img-circle">
            <h4 class="footertext">Recursos Utilizados</h4>
            <p class="footertext">
            <a href="https://github.com/NinaCris16/Educatio-CEFET-MG">GitHub</a><br>
            <a href="http://getbootstrap.com/">Bootstrap</a><br>
            <a href="https://jquery.com/">jQuery</a>
            </p>
          </center>
        </div>
  </div>

</body>
</html>