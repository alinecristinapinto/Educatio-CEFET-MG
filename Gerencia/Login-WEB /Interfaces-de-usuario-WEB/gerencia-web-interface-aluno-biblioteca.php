<?php 
  session_start(); 
  $usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bem Vindo - Educatio CEFET-MG</title>
	<meta charset="utf-8">
	<link href="../Bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="gerencia-web-interfaces.css" rel="stylesheet">
  <script src="../Bootstrap/js/jquery.min.js"></script>
  <script src="../Bootstrap/js/bootstrap.min.js"></script> 
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
            <a href="#" class="navbar-brand"><img class="slogan" src="Imagens/slogan.png"></a>
        </div>
            
        <div id="menu" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book"></span> Empréstimo</a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Acessar Empréstimos</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Renovar</a></li>
                  </ul>
                </li>

                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-search"></span> Reservas</a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Acessar Reservas</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Fazer Reserva</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Remover Reserva</a></li>
                  </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo '<img class="profile" src="data:image/jpeg;base64,'.base64_encode( $usuario['foto'] ).'"/>';?>  <?php echo $usuario['nome'];?> <span class="caret"></span>&emsp;</a>

                  <ul class="dropdown-menu">
                    <li><a href= "gerencia-web-escolha-sistema-aluno.php" ?><span class="glyphicon glyphicon-log-out"></span> - Voltar para a escolha de sistema</a></li>
                    <li><a href= "../login/gerencia-web-login.html" ?><span class="glyphicon glyphicon-log-out"></span> - Sair</a></li>
                  </ul>
              </li>
            </ul>
        </div>
    </nav>   

    <div class="alinhador">
      <h1>Sistema Educatio - CEFET-MG</h1>

      <p>Seja Bem Vindo(a) <?php echo $usuario['nome'];?>!</p>
      <p>Escolha qual sistema irá acessar!</p>    

    </div>
    
    <div class="container">
    <div class="row">
      <h3 class="footertext"><strong>  Quem Somos?</strong></h3><br>
        <div class="col-md-4">
          <center>
            <img src="Imagens/prom.jpg" class="img-circle">
              <h4 class="footertext"><strong>Desenvolvedores</strong></h4>
              <p class="footertext"></span> Alunos da turma de Informática 2A 2017 do CEFET-MG unidos para o desenvolvimento deste projeto. <a href="#">Clique aqui</a> para saber mais.</p>
          </center>
        </div>
        <div class="col-md-4">
          <center>
            <img src="Imagens/cefetop.png" class="img-circle">
            <h4 class="footertext"><strong>Instituição</strong></h4>
            <p class="footertext">Centro Federal de Educação Tecnológica de Minas Gerais. Av. Amazonas 5253 - Nova Suíssa - Belo
             Horizonte - Brasil.</p>
          </center>
        </div>
        <div class="col-md-4">
          <center>
            <img src="Imagens/bootstrap.png" class="img-circle">
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