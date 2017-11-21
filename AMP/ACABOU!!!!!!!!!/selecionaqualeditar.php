<?php


	
	$id = $_POST['valorCPF'];

	$tipo = $_POST['valorCPF2'];


	if ($tipo == 'livro') {

		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}	
	
		$sql = "SELECT * FROM acervo WHERE id = '$id' AND ativo = 'S'";

		$resultado = $sqlConexao->query($sql);	

		   session_start();

       		$row = $resultado->fetch_assoc();
    		$_SESSION['idCampi'] = $row["idCampi"];
   		
   			$_SESSION['nome'] = $row["nome"];
   			$_SESSION['local'] = $row["local"];  
  			$_SESSION['ativo'] = $row["ativo"];
   			$_SESSION['editora'] = $row["editora"];
  			$_SESSION['paginas'] = $row["paginas"];	
  			$_SESSION['ano'] = $row["ano"];	

  		$sql = "SELECT id FROM acervo WHERE id = '$id' AND ativo = 'S'";
		
		$result = mysqli_query($sqlConexao, $sql);

		$aux = mysqli_fetch_array($result);			

		$intIdAcervo = $aux[0]+1;

		$sql = "SELECT * FROM livros WHERE idAcervo = '$id' AND ativo = 'S'";

		$resultado = $sqlConexao->query($sql);	

		$row = $resultado->fetch_assoc();
		$_SESSION['ISBN'] = $row["ISBN"];	
		$_SESSION['edicao'] = $row["edicao"];

			echo "<script>location.href='editarlivro.php';</script>";

	}

	if ($tipo == 'midias') {


		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}	
	
		$sql = "SELECT * FROM acervo WHERE id = '$id' AND ativo = 'S'";

		$resultado = $sqlConexao->query($sql);	

		   session_start();

       		$row = $resultado->fetch_assoc();
    		$_SESSION['idCampi'] = $row["idCampi"];
   		
   			$_SESSION['nome'] = $row["nome"];
   			$_SESSION['local'] = $row["local"];  
  			$_SESSION['ativo'] = $row["ativo"];
   			$_SESSION['editora'] = $row["editora"];
  			$_SESSION['paginas'] = $row["paginas"];	
  			$_SESSION['ano'] = $row["ano"];	

  		$sql = "SELECT id FROM acervo WHERE id = '$id' AND ativo = 'S'";
		
		$result = mysqli_query($sqlConexao, $sql);

		$aux = mysqli_fetch_array($result);			

		$intIdAcervo = $aux[0]+1;

		$sql = "SELECT * FROM midias WHERE idAcervo = '$id' AND ativo = 'S'";

		$resultado = $sqlConexao->query($sql);	

		$row = $resultado->fetch_assoc();
		$_SESSION['tempo'] = $row["tempo"];	
		$_SESSION['subtipo'] = $row["subtipo"];






echo "<script>location.href='editarmidias.php';</script>";


	}

		if ($tipo == 'academicos') {


		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}	
	
		$sql = "SELECT * FROM acervo WHERE id = '$id' AND ativo = 'S'";

		$resultado = $sqlConexao->query($sql);	

		   session_start();

       		$row = $resultado->fetch_assoc();
    		$_SESSION['idCampi'] = $row["idCampi"];
   		
   			$_SESSION['nome'] = $row["nome"];
   			$_SESSION['local'] = $row["local"];  
  			$_SESSION['ativo'] = $row["ativo"];
   			$_SESSION['editora'] = $row["editora"];
  			$_SESSION['paginas'] = $row["paginas"];	
  			$_SESSION['ano'] = $row["ano"];	

  		$sql = "SELECT id FROM acervo WHERE id = '$id' AND ativo = 'S'";
		
		$result = mysqli_query($sqlConexao, $sql);

		$aux = mysqli_fetch_array($result);			

		$intIdAcervo = $aux[0]+1;

		$sql = "SELECT * FROM academicos WHERE idAcervo = '$id' AND ativo = 'S'";

		$resultado = $sqlConexao->query($sql);	

		$row = $resultado->fetch_assoc();
		$_SESSION['programa'] = $row["programa"];	



echo "<script>location.href='acad2.php';</script>";


	}

	if ($tipo == 'periodico') {

		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}	
	
		$sql = "SELECT * FROM acervo WHERE id = '$id' AND ativo = 'S'";

		$resultado = $sqlConexao->query($sql);	

		   session_start();

       		$row = $resultado->fetch_assoc();
    		$_SESSION['idCampi'] = $row["idCampi"];
   		
   			$_SESSION['nome'] = $row["nome"];
   			$_SESSION['local'] = $row["local"];  
  			$_SESSION['ativo'] = $row["ativo"];
   			$_SESSION['editora'] = $row["editora"];
  			$_SESSION['paginas'] = $row["paginas"];	
  			$_SESSION['ano'] = $row["ano"];	

  		$sql = "SELECT id FROM acervo WHERE id = '$id' AND ativo = 'S'";
		
		$result = mysqli_query($sqlConexao, $sql);

		$aux = mysqli_fetch_array($result);			

		$intIdAcervo = $aux[0]+1;

		$sql = "SELECT * FROM periodicos WHERE idAcervo = '$id' AND ativo = 'S'";

		$resultado = $sqlConexao->query($sql);	

		$row = $resultado->fetch_assoc();
		$_SESSION['ISSN'] = $row["ISSN"];	
		$_SESSION['periodicidade'] = $row["periodicidade"];
		$_SESSION['mes'] = $row["mes"];
		$_SESSION['volume'] = $row["volume"];
		$_SESSION['subtipo'] = $row["subtipo"];

			echo "<script>location.href='editaperiodico.php';</script>";

	}









?>