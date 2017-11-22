<?php 

//Cria classe livro que tem todas as funções de criação, alteração e exclusão de livros e acervo



class Academico{

	function criaAcademico($StringPrograma, $StringAtivo, $intIdCampi, $charNome, $charTipo, $charLocal, $charAno, $charEditora, $charPaginas){
			
		//Abre a conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}

		$sqlIdAcervo = "SELECT  MAX(id) FROM acervo";

		$result = mysqli_query($sqlConexao, $sqlIdAcervo);

		$aux = mysqli_fetch_array($result);

		if (mysqli_query($sqlConexao, $sqlIdAcervo)) {
			echo "$aux[0] !<br>";
		}
		else{
			echo "Erro ao selecionar o acervo: " . mysqli_error($sqlConexao);
		}

		$intIdAcervo = $aux[0]+1;

		//Insere dados na tabela periodicos

		$sqlInsereAcademico = "INSERT INTO academicos (idAcervo, programa, ativo) VALUES ('$intIdAcervo','$StringPrograma', '$StringAtivo')";
		if ($result = mysqli_query($sqlConexao, $sqlInsereAcademico)) {	
		}else{
			echo "Erro: " . $sqlInsereAcademico . "<br>" . $sqlConexao->error;
		}

		//Insere dados na tabela acervo

		$sqlInsereAcademico = "INSERT INTO acervo (idCampi, nome, tipo, local, ano, editora, paginas, ativo) 
		VALUES ('$intIdCampi', '$charNome', '$charTipo', '$charLocal', '$charAno', '$charEditora', '$charPaginas', '$StringAtivo')";
		if ($result = mysqli_query($sqlConexao, $sqlInsereAcademico)) {		
		}
		else{
			echo "Erro: " . $sqlInsereAcademico . "<br>" . $sqlConexao->error;
		}

		}	
}



$aaa = new Academico;

$aaa -> criaAcademico($_POST["programa"],'S',$_POST["idCampi"],$_POST["nome"],'academicos',$_POST["local"],$_POST["ano"],$_POST["editora"],$_POST["paginas"]);



    echo "<script>location.href='cria_autor.php';</script>";

    //function criaAcademico($StringPrograma, $StringAtivo, $intIdCampi, $charNome, $charTipo, $charLocal, $charAno, $charEditora, $charPaginas){


 ?>	