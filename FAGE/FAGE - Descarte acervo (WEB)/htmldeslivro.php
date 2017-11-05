<!DOCTYPE html>
<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap.css" rel="stylesheet"/>

	<!-- CSS do grupo -->
	 <link href="" rel="stylesheet" />

	<!-- Arquivos js -->
	<script src="js/popper.js"></script>
	<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

	<!-- Fontes e icones -->
	<link href="css/nucleo-icons.css" rel="stylesheet">
	<div class="container">

	<style type="text/css">
        .text-center{
           font-family: 'Abel', sans-serif;
           color: #d8ac29;
        }
        .fonteTexto{
           font-family: 'Inconsolata', monospace;
           font-size: 16px;
        }
        .btn-info {
          background-color: #162e87;
          border-color: #162e87;
          color: #FFFFFF;
          opacity: 1;
          filter: alpha(opacity=100);
        }
        .btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .show > .btn-info.dropdown-toggle {
          background-color: #11277a;
          color: #FFFFFF;
          border-color: #11277a;
        }
    </style>
<div class="container">
  <!-- Content here -->

<html>
<head>
	<title></title>
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="Bootstrap/js/bootstrap.min.js"></script>
	<pre>
		<h1>DESCARTE</h1>
	<form method="get" action="phpdescexem.php">
		 <div class="form-group">

		ID DA OBRA  
		<div class="input-group"> <div class="input-group-addon"><span
		class="glyphicon glyphicon-book"></span></div>  
		<input  class='form-control' type="text" name="num"><br>
	</div>
		DATA DO DESCARTE
		<div class="input-group"> <div class="input-group-addon"><span
		class="glyphicon glyphicon-book"></span></div>  
		<input  class='form-control' type="date" name="data"><br>
	</div>
		MOTIVOS 
		<div class="input-group"> <div class="input-group-addon"><span
		class="glyphicon glyphicon-book"></span></div>  

        <input  class='form-control' type="text" name="mot"><br>
		</div>
		
		ID-PROFESSOR    
		<div class="input-group"> <div class="input-group-addon"><span
		class="glyphicon glyphicon-book"></span></div>  
		<input  class='form-control' type="number" name="prof">
	</div>
		<input type="radio" class="form-check-input" name="tipo" value="l">Livro 
		<input type="radio" class="form-check-input" name="tipo" value="m">Midia  
		<input type="radio" class="form-check-input" name="tipo" value="a">Academico
		<input type="radio" class="form-check-input" name="tipo" value="p">Periodico
		</div>
		<input class="btn btn-primary btn-lg btn-block" type="submit" name="fim">
		<input class="btn btn-primary btn-lg btn-block" type="reset" name="d">
		<input class="btn btn-primary btn-lg btn-block" type="button" value="Voltar" onClick="history.go(-1)"> 
		<div class="progress">
  		<div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
		</div>

</form>
</pre>
</body>
</html>
</div>