<!DOCTYPE html>
<pre>
<html>
<head>

	<div class="container">
  <!-- Content here -->

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
	<title></title>
</head>
<body>
	
<h1>Descarte</h1>
<form method="POST" action="htmlobr.php">

<input class="btn btn-info btn-round" type="submit" name="Obras" value="Acervo"><br><br>
<input class="btn btn-info btn-round" type="submit" name="exemplar" value="Exemplar"><br><br>
<input class="btn btn-info btn-round" type="button" value="Voltar" onClick="history.go(-1)"> 

<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
</div>
</form> 
</body>
</html>

<?php
if (isset($_POST["Obras"])){
 	
header('Location: htmldes.php');

}else if (isset($_POST["exemplar"])){

header('Location: htmldeslivro.php');

}
?>
</pre>
</div>