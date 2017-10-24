<?php



if (isset($_POST['acervo'])) {

	$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");

	if (!$sqlConexao) {
		echo "Falha na conexao com o Banco de Dados!";
		exit;
	}
	//relatorio midias
	if ($_POST['acervo'] == "Midias") {


		//procura os dadose os salva em um array
		$arrayDados = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM acervo WHERE Tipo='Midia'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['idAcervo'] = $genAux['id'];
				$arrayDados[$intContador]['idCampi'] = $genAux['idCampi'];
				$arrayDados[$intContador]['idAutor'] = $genAux['idAutor'];
				$arrayDados[$intContador]['local'] = $genAux['local'];
				$arrayDados[$intContador]['ano'] = $genAux['ano'];
				$arrayDados[$intContador]['editora'] = $genAux['editora'];
				$arrayDados[$intContador]['nome'] = $genAux['nome'];
				$intContador++;
			}
		}

		$intContador = 0;

		foreach ($arrayLivros as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT nome,sobrenome FROM autores WHERE idAcervo='$intIdacervo' AND qualificacao='autor-principal'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['nomeautor'] = $genAux['nome'];
			$arrayDados[$intContador]['sobrenomeautor'] = $genAux['sobrenome'];
			$intContador++;
		}

		$intContador = 0;

		foreach ($arrayLivros as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT * FROM midia WHERE idAcervo='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['tempo'] = $genAux['tempo'];
			$arrayDados[$intContador]['subtipo'] = $genAux['subtipo'];
			$arrayDados[$intContador]['idObra'] = $genAux['id'];
			$intContador++;
		}


		//exibe os dados em uma tabela
		echo "<table border='1'>
		<tr>
		<td>Id da Obra</td>
		<td>Id no Acervo</td
		><td>Nome da obra</td>
		<td> Autor </td>
		<td> Campi </td>
		<td> Local </td>
		<td> Ano </td>
		<td>Editora</td>
		<td> Tempo </td>
		<td>Subtipo</td>
		<td>Paginas</td>
		</tr>";
		foreach ($arrayLivros as $valor) {
			echo "<tr>
			<td>".$valor['idObra']."</td>
			<td>".$valor['idAcervo']."</td>
			<td>".$valor['nome']."</td>
			<td>".$valor['sobrenomeautor'].", ".$valor['nomeautor']."</td>
			<td>".$valor['idCampi']."</td>
			<td>".$valor['local']."</td>
			<td>".$valor['ano']."</td>
			<td>".$valor['editora']."</td>
			<td>".$valor['tempo']."</td>
			<td>".$valor['subtipo']."</td>
			<td>".$valor['paginas']."</td>
			</tr>";		
		}


	//relatorio livros
	} else if ($_POST['acervo'] == "Livros") {


		//procura os dadose os salva em um array
		$arrayLivros = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM acervo WHERE Tipo='Livro'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayLivros[$intContador]['idAcervo'] = $genAux['id'];
				$arrayLivros[$intContador]['idCampi'] = $genAux['idCampi'];
				$arrayLivros[$intContador]['idAutor'] = $genAux['idAutor']; 
				$arrayLivros[$intContador]['local'] = $genAux['local'];
				$arrayLivros[$intContador]['ano'] = $genAux['ano']; 
				$arrayLivros[$intContador]['editora'] = $genAux['editora']; 
				$arrayLivros[$intContador]['paginas'] = $genAux['paginas']; 
				$arrayLivros[$intContador]['nome'] = $genAux['nome'];
				$intContador++;
			}
		}

		$intContador = 0;

		foreach ($arrayLivros as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT * FROM livros WHERE idAcervo='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayLivros[$intContador]['idObra'] = $genAux['id'];
			$arrayLivros[$intContador]['ISBN'] = $genAux['ISBN'];
			$arrayLivros[$intContador]['edicao'] = $genAux['edicao'];
			$intContador++;
		}

		$intContador = 0;

		foreach ($arrayLivros as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT nome,sobrenome FROM autores WHERE idAcervo='$intIdacervo' AND qualificacao='autor-principal'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayLivros[$intContador]['nomeautor'] = $genAux['nome'];
			$arrayLivros[$intContador]['sobrenomeautor'] = $genAux['sobrenome'];
			$intContador++;
		}


		//exibe os dados em uma tabela
		echo "<table border='1'>
		<tr>
		<td>Id da Obra</td>
		<td>Id no Acervo</td
		><td>Nome da obra</td>
		<td> Autor </td>
		<td> Campi </td>
		<td> Local </td>
		<td> Ano </td>
		<td>Editora</td>
		<td> ISBN </td>
		<td>Edicao</td>
		<td>Paginas</td>
		</tr>";
		foreach ($arrayLivros as $valor) {
			echo "<tr>
			<td>".$valor['idObra']."</td>
			<td>".$valor['idAcervo']."</td>
			<td>".$valor['nome']."</td>
			<td>".$valor['sobrenomeautor'].", ".$valor['nomeautor']."</td>
			<td>".$valor['idCampi']."</td>
			<td>".$valor['local']."</td>
			<td>".$valor['ano']."</td>
			<td>".$valor['editora']."</td>
			<td>".$valor['ISBN']."</td>
			<td>".$valor['edicao']."</td>
			<td>".$valor['paginas']."</td>
			</tr>";		
		}
		
	//relatorio periodicos
	} else if ($_POST['acervo'] == "Periodicos") {


		//procura os dadose os salva em um array
		$arrayDados = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM acervo WHERE Tipo='Periodico'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['idAcervo'] = $genAux['id'];
				$arrayDados[$intContador]['idCampi'] = $genAux['idCampi'];
				$arrayDados[$intContador]['idAutor'] = $genAux['idAutor']; 
				$arrayDados[$intContador]['local'] = $genAux['local'];
				$arrayDados[$intContador]['ano'] = $genAux['ano']; 
				$arrayDados[$intContador]['editora'] = $genAux['editora']; 
				$arrayDados[$intContador]['nome'] = $genAux['nome'];
				$intContador++;
			}
		}

		$intContador = 0;

		foreach ($arrayLivros as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT nome,sobrenome FROM autores WHERE idAcervo='$intIdacervo' AND qualificacao='autor-principal'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['nomeautor'] = $genAux['nome'];
			$arrayDados[$intContador]['sobrenomeautor'] = $genAux['sobrenome'];
			$intContador++;
		}

		$intContador = 0;

		foreach ($arrayLivros as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT * FROM periodicos WHERE idAcervo='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['periodicidade'] = $genAux['tempo'];
			$arrayDados[$intContador]['subtipo'] = $genAux['subtipo'];
			$arrayDados[$intContador]['idObra'] = $genAux['id'];
			$arrayDados[$intContador]['mes'] = $genAux['mes'];
			$arrayDados[$intContador]['volume'] = $genAux['volume'];
			$arrayDados[$intContador]['ISSN'] = $genAux['ISSN'];
			$intContador++;
		}


		//exibe os dados em uma tabela
		echo "<table border='1'>
		<tr>
		<td>Id da Obra</td>
		<td>Id no Acervo</td
		><td>Nome da obra</td>
		<td> Autor </td>
		<td> Campi </td>
		<td> Local </td>
		<td> Ano </td>
		<td>Editora</td>
		<td> Periodicidade </td>
		<td>Subtipo</td>
		<td>Mes</td>
		<td>Volume</td>
		<td>ISSN</td>
		<td>Paginas</td>
		</tr>";
		foreach ($arrayLivros as $valor) {
			echo "<tr>
			<td>".$valor['idObra']."</td>
			<td>".$valor['idAcervo']."</td>
			<td>".$valor['nome']."</td>
			<td>".$valor['sobrenomeautor'].", ".$valor['nomeautor']."</td>
			<td>".$valor['idCampi']."</td>
			<td>".$valor['local']."</td>
			<td>".$valor['ano']."</td>
			<td>".$valor['editora']."</td>
			<td>".$valor['periodicidade']."</td>
			<td>".$valor['subtipo']."</td>
			<td>".$valor['mes']."</td>
			<td>".$valor['volume']."</td>
			<td>".$valor['ISSN']."</td>
			<td>".$valor['paginas']."</td>
			</tr>";		
		}
	//relatorio academicos
	} else if ($_POST['acervo'] == "Academicos") {


		//procura os dadose os salva em um array
		$arrayLivros = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM acervo WHERE Tipo='Academico'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayLivros[$intContador]['idAcervo'] = $genAux['id'];
				$arrayLivros[$intContador]['idCampi'] = $genAux['idCampi'];
				$arrayLivros[$intContador]['idAutor'] = $genAux['idAutor']; 
				$arrayLivros[$intContador]['local'] = $genAux['local'];
				$arrayLivros[$intContador]['ano'] = $genAux['ano']; 
				$arrayLivros[$intContador]['editora'] = $genAux['editora']; 
				$arrayLivros[$intContador]['paginas'] = $genAux['paginas']; 
				$arrayLivros[$intContador]['nome'] = $genAux['nome'];
				$intContador++;
			}
		}

		$intContador = 0;

		foreach ($arrayLivros as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT * FROM academicos WHERE idAcervo='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayLivros[$intContador]['idObra'] = $genAux['id'];
			$arrayLivros[$intContador]['programa'] = $genAux['Iprograma'];

			$intContador++;
		}

		$intContador = 0;

		foreach ($arrayLivros as $valor) {
			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT nome,sobrenome FROM autores WHERE idAcervo='$intIdacervo' AND qualificacao='autor-principal'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayLivros[$intContador]['nomeautor'] = $genAux['nome'];
			$arrayLivros[$intContador]['sobrenomeautor'] = $genAux['sobrenome'];
			$intContador++;
		}


		//exibe os dados em uma tabela
		echo "<table border='1'>
		<tr>
		<td>Id da Obra</td>
		<td>Id no Acervo</td
		><td>Nome da obra</td>
		<td> Autor </td>
		<td> Campi </td>
		<td> Local </td>
		<td> Ano </td>
		<td>Programa</td>
		<td>Edicao</td>
		<td>Paginas</td>
		</tr>";
		foreach ($arrayLivros as $valor) {
			echo "<tr>
			<td>".$valor['idObra']."</td>
			<td>".$valor['idAcervo']."</td>
			<td>".$valor['nome']."</td>
			<td>".$valor['sobrenomeautor'].", ".$valor['nomeautor']."</td>
			<td>".$valor['idCampi']."</td>
			<td>".$valor['local']."</td>
			<td>".$valor['ano']."</td>
			<td>".$valor['programa']."</td>
			<td>".$valor['edicao']."</td>
			<td>".$valor['paginas']."</td>
			</tr>";		
		}

	}

} else {
	echo "Nao encontramos sua pesquisa!";
}

?>