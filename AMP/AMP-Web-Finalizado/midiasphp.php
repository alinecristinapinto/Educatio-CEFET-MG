<?php 


class midias{

	function criaMidias($StringTempo, $StringSubtipo, $StringAtivo, $intIdCampi, $charNome, $charTipo, $charLocal, $charAno, $charEditora, $charPaginas){

			//Abre a conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}

		$sqlIdAcervo = "SELECT  MAX(id) FROM acervo";

		$result = mysqli_query($sqlConexao, $sqlIdAcervo);

		$aux = mysqli_fetch_array($result);

		if (mysqli_query($sqlConexao, $sqlIdAcervo)) {			
		}
		else{
			echo "Erro ao selecionar o acervo: " . mysqli_error($sqlConexao);
		}

		$intIdAcervo = $aux[0]+1;

		//Insere dados na tabela periodicos

		$sqlInseremidias = "INSERT INTO midias (idAcervo, tempo, subtipo, ativo) VALUES ('$intIdAcervo','$StringTempo', '$StringSubtipo', '$StringAtivo')";
		if ($result = mysqli_query($sqlConexao, $sqlInseremidias)) {
			
		}else{
			echo "Erro: " . $sqlInsereAcademico . "<br>" . $sqlConexao->error;
		}

		//Insere dados na tabela acervo

		$sqlInseremidias = "INSERT INTO acervo (idCampi, nome, tipo, local, ano, editora, paginas, ativo) 
		VALUES ('$intIdCampi', '$charNome', '$charTipo', '$charLocal', '$charAno', '$charEditora', '$charPaginas', '$StringAtivo')";
		if ($result = mysqli_query($sqlConexao, $sqlInseremidias)) {		
		}
		else{
			echo "Erro: " . $sqlInsereAcademico . "<br>" . $sqlConexao->error;
		}
	}	


}

$aaa = new midias;

$aaa -> criaMidias($_POST["tempo"],$_POST["subtipo"],'S',$_POST["idCampi"],$_POST["nome"],'midias',$_POST["local"],$_POST["ano"],$_POST["editora"],$_POST["paginas"]);



    echo "<script>location.href='cria_autor.php';</script>";

    //function criaMidias($StringTempo, $StringSubtipo, $StringAtivo, $intIdCampi, $charNome, $charTipo, $charLocal, $charAno, $charEditora, $charPaginas){


 ?>	