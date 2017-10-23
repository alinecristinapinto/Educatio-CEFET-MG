<!DOCTYPE html>
<pre>
<html>
<head>

	<div class="container">
  <!-- Content here -->

	<link ​ href = "Bootstrap/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css"​ ​ rel = "stylesheet">
	<title></title>
</head>
<body>
<h1>Descarte</h1>
<form method="POST" action="htmlobr.php">

<input class="btn btn-primary btn-lg btn-block" type="submit" name="Obras" value="Acervo"><br><br>
<input class="btn btn-primary btn-lg btn-block" type="submit" name="exemplar" value="Exemplar"><br><br>
<input class="btn btn-primary btn-lg btn-block" type="button" value="Voltar" onClick="history.go(-1)"> 
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
</div>
</form> 
</body>
</html>

<?php
if (isset($_POST["Obras"])){
 	
header('Location: htmldes.html');

}else if (isset($_POST["exemplar"])){

header('Location: htmldeslivro.html');

}
?>
</pre>
</div>