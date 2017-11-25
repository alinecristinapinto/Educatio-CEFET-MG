<?php
###############################################################################################
	header("Content-type: text/html; charset=utf-8");
	ini_set('max_execution_time', 0); 
###############################################################################################
	$servername = "localhost";
	$username = "root";
	$password = "usbw";
	$bd = "educatio";
	$con = new mysqli($servername, $username, $password, $bd);
	
	mysqli_set_charset($con, "utf8");
	
	// TESTANDO A CONEXÃO
	if ($con->connect_error) 
	{
	    die("Conexão falhou: " . $con->connect_error);
	}
	
	echo "<b>".'Conexão bem sucedida.'."</b><br>";

###############################################################################################
	// CÓDIGO PARA INSERÇÃO NAS TABELAS DO SISTEMA ACADÊMICO

	/*
	Modo de inserção:
    
    //Preparando os parâmetros
	$stmt = $con->prepare (
		"INSERT INTO nomeDaTabela
			(coluna1, coluna2, coluna3, coluna4, ...) 
			VALUES (?, ?, ?, ?, ...)"
	);

	//Parâmetro não específico, para depois setar os valores e executar o query de inserção
		$stmt->bind_param (
		"tipagemDoParam1, tipagemDoParam2, tipagemDoParam3, ...", //s = string, i = inteiro, d = decimal
		$param1, $param2, $param3, ...
	);

	//Preparando os valores e executando
		$param1 = valor1
		$param2 = valor2
		$param3 = valor3
		...
		$stmt->execute();
	*/
/*
###############################################################################################	

	//INSERINDO NA TABELA CAMPI
	//
	$stmt = $con->prepare (
		"INSERT INTO campi
			(nome, cidade, UF, ativo) 
			VALUES (?, ?, ?, ?)"
	);
	$stmt->bind_param (
		"ssss", 
		$nome, $cidade, $UF, $ativo
	);
	####################################################
		// idCampi 
		$nome = "";
		$cidade = "";
		$UF = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	//INSERINDO NA TABELA DEPTOS
	//
	$stmt = $con->prepare (
		"INSERT INTO deptos
			(idCampi, nome, ativo)
			VALUES (?, ?, ?)"
	);
	$stmt->bind_param (
		"iss", 
		$idCampi, $nome, $ativo
	);
	####################################################
		// idDepto 
		$idCampi = ;
		$nome = "";
		$ativo = "S";
		$stmt->execute();
		 
	####################################################
	//
	//INSERINDO NA TABELA CURSOS
	//
	$stmt = $con->prepare (
		"INSERT INTO cursos
			(idDepto, nome, horasTotal, modalidade, ativo)
			VALUES (?, ?, ?, ?, ?)"
	);
	$stmt->bind_param (
		"issss", 
		$idDepto, $nome, $horasTotal, $modalidade, $ativo
	);
	####################################################
		// idCurso 
		$idDepto = ;
		$nome = "";
		$horasTotal = "";
		$modalidade = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	//INSERINDO NA TABELA TURMAS
	//
	$stmt = $con->prepare (
		"INSERT INTO turmas
			(idCurso, serie, nome, ativo)
			VALUES (?, ?, ?, ?)"
	);
	$stmt->bind_param (
		"iiss", 
		$idCurso, $serie, $nome, $ativo
	);
	// série da graduação varia de 1 a 10 (numero de semestres)
	####################################################
		// idTurma 
		$idCurso = ;
		$serie = ;
		$nome = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	//INSERINDO NA TABELA ALUNOS
	//
	$stmt = $con->prepare (
		"INSERT INTO alunos
  			(idCPF, idTurma, nome, sexo, nascimento, logradouro, numeroLogradouro, complemento,
  			 bairro, cidade, CEP, UF, email, senha, ativo)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
	);
	$stmt->bind_param (
		"sisssssssssssss", 
		$idCPF, $idTurma, $nome, $sexo, $nascimento, $logradouro, $numeroLogradouro, $complemento,
  		$bairro, $cidade, $CEP, $UF, $email, $senha, $ativo
	);
	####################################################
		$idCPF = "";
		$idTurma = ;
		$nome = "";
		$sexo = "";
		$nascimento = "";
		$logradouro = "";
		$numeroLogradouro = "";
		$complemento = "";
		$bairro = "";
		$cidade = "";
		$CEP = "";
		$UF = "";
		$email = "";
		// senha - 
		$senha = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	
	//
	//INSERINDO NA TABELA MATRICULAS
	//
	$stmt = $con->prepare (
		"INSERT INTO matriculas
			(idAluno, idDisciplina, ano, ativo)
			VALUES (?, ?, ?, ?)"
	);
	$stmt->bind_param (
		"siss", 
		$idAluno, $idDisciplina, $ano, $ativo
	);
	####################################################
		// idMatricula 
		$idAluno = "";
		$idDisciplina = ;
		$ano = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	//INSERINDO NA TABELA FUNCIONARIO
	//
	$stmt = $con->prepare (
		"INSERT INTO funcionario
			(idSIAPE, idDepto, nome, titulacao, hierarquia, senha, ativo)
			VALUES (?, ?, ?, ?, ?, ?, ?)"
	);
	$stmt->bind_param (
		"sisssss", 
		$idSIAPE, $idDepto, $nome, $titulacao, $hierarquia, $senha, $ativo
	);
	####################################################
		$idSIAPE = "";
		$idDepto = ;
		$nome = "";
		$titulacao = "";
		$hierarquia = "";
		// senha - 
		$senha = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	//INSERINDO NA TABELA DISCIPLINAS
	//
	$stmt = $con->prepare (
		"INSERT INTO disciplinas
			(idTurma, nome, cargaHorariaMin, ativo)
			VALUES (?, ?, ?, ?)"
	);
	$stmt->bind_param (
		"isss", 
		$idTurma, $nome, $cargaHorariaMin, $ativo
	);
	####################################################
		// idDisciplina 
		$idTurma = ;
		$nome = "";
		$cargaHorariaMin = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	//INSERINDO NA TABELA PROFDISCIPLINAS
	//
	$stmt = $con->prepare (
		"INSERT INTO profDisciplinas
			(idProfessor, idDisciplina, idTurma, ativo)
			VALUES (?, ?, ?, ?)"
	);
	$stmt->bind_param (
		"siis", 
		$idProfessor, $idDisciplina, $idTurma, $ativo
	);
	####################################################
		// idProfDisciplina 
		$idProfessor = "";
		$idDisciplina = ;
		$idTurma = ;
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	//INSERINDO NA TABELA ETAPAS
	//
	$stmt = $con->prepare (
		"INSERT INTO etapas
			(idOrdem, valor, ativo)
			VALUES (?, ?, ?)"
	);
	$stmt->bind_param (
		"sds", 
		$idOrdem, $valor, $ativo
	);
	####################################################
		// idEtapa 1
		$idOrdem = "1";
		$valor = 20.00;
		$ativo = "S";
		$stmt->execute();
		// idEtapa 2
		$idOrdem = "2";
		$valor = 30.00;
		$ativo = "S";
		$stmt->execute();
		// idEtapa 3
		$idOrdem = "3";
		$valor = 20.00;
		$ativo = "S";
		$stmt->execute();
		// idEtapa 4
		$idOrdem = "4";
		$valor = 30.00;
		$ativo = "S";
		$stmt->execute();
		// idEtapa 5
		$idOrdem = "5";
		$valor = 100.00;
		$ativo = "S";
		$stmt->execute();
		// idEtapa 6
		$idOrdem = "6";
		$valor = 100.00;
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	//INSERINDO NA TABELA ATIVIDADES
	//
	$stmt = $con->prepare (
		"INSERT INTO atividades
			(idProfDisciplina, nome, data, valor, ativo)
			VALUES (?, ?, ?, ?, ?)"
	);
	$stmt->bind_param (
		"issds",
		$idProfDisciplina, $nome, $data, $valor, $ativo
	);
	####################################################
		// idAtividade
		$idProfDisciplina = ;
		$nome = "";
		$data = "";
		$valor = ;
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	//INSERINDO NA TABELA CONTEUDOS
	//
	$stmt = $con->prepare (
		"INSERT INTO conteudos
			(idEtapa, idDisciplina, conteudo, datas, ativo)
			VALUES (?, ?, ?, ?, ?)"
	);
	$stmt->bind_param (
		"iisss",
		$idEtapa, $idDisciplina, $conteudo, $datas, $ativo
	);
	####################################################
		// idConteudo 
		$idEtapa = ;
		$idDisciplina = ;
		$conteudo = "";
		$datas = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
//
	//INSERINDO NA TABELA DIARIOS
	//
	$stmt = $con->prepare (
		"INSERT INTO diarios
			(idConteudo, idMatricula, idAtividade, faltas, nota, ano, ativo)
			VALUES (?, ?, ?, ?, ?, ?, ?)"
	);
	$stmt->bind_param (
		"iiiidss", 
		$idConteudo, $idMatricula, $idAtividade, $faltas, $nota, $ano, $ativo
	);
	####################################################
		// Aluno "", disciplina "", ""º bimestre/semestre (aula, prova e trabalho)
		// idDiario 
		$idConteudo = ;
		$idMatricula = ;
		$idAtividade = ;
		$faltas = ;
		$nota = ;
		$ano = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	// CÓDIGO PARA INSERÇÃO NAS TABELAS DO SISTEMA DE BIBLIOTECA
	//
	// INSERINDO NA TABELA ACERVO
	//
	// preparando os parâmetros
	$stmt = $con->prepare (
			"INSERT INTO acervo
				(idCampi, nome, tipo, local, ano, editora, paginas, ativo) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
			);
	// parâmetro não específico, para depois setar os valores e executar o query de inserção
	$stmt->bind_param (
				"isssssss", 
				$idCampi, $nome, $tipo, $local, $ano, $editora, $paginas, $ativo
			 );
	// preparando os valores e executando
	####################################################
		// idAcervo 
		$idCampi = ;
		$nome = "";
		$tipo = "";
		$local = "";
		$ano = "";
		$editora = "";
		$paginas = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	// INSERINDO NA TABELA LIVROS
	//
	$stmt = $con->prepare (
			"INSERT INTO livros
				(idAcervo, ISBN, edicao, ativo)
				VALUES (?, ?, ?, ?)"
			);
	
	$stmt->bind_param (
				"isss", 
				$idAcervo, $ISBN, $edicao, $ativo
			 );
	####################################################
		// Livro  - Autor - 
		$idAcervo = ;
		$ISBN = "";
		$edicao = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	// INSERINDO NA TABELA ACADEMICOS
	//
	$stmt = $con->prepare (
			"INSERT INTO academicos
				(idAcervo, programa, ativo) 
				VALUES (?, ?, ?)"
			);
	
	$stmt->bind_param (
				"iss", 
				$idAcervo, $programa, $ativo
			 );
	####################################################
		// idAcademicos 
		$idAcervo = ;
		$programa = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	// INSERINDO NA TABELA MIDIAS
	//
	$stmt = $con->prepare (
			"INSERT INTO midias
				(idAcervo, tempo, subtipo, ativo) 
				VALUES (?, ?, ?, ?)"
			);
	
	$stmt->bind_param (
				"isss", 
				$idAcervo, $tempo, $subtipo, $ativo
			 );
	####################################################
		// idMidia 
		$idAcervo = ;
		$tempo = "";
		$subtipo = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	
	//
	// INSERINDO NA TABELA PERIODICOS
	//
	$stmt = $con->prepare (
			"INSERT INTO periodicos
				(idAcervo, periodicidade, mes, volume, subtipo, ISSN, ativo) 
				VALUES (?, ?, ?, ?, ?, ?, ?)"
			);
	
	$stmt->bind_param (
				"issssss", 
				$idAcervo, $periodicidade, $mes, $volume, $subtipo, $ISSN, $ativo
			 );
	####################################################
		// idPeriodico 
		$idAcervo = ;
		$periodicidade = "";
		$mes = "";
		$volume = "";
		$subtipo = "";
		$ISSN = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	
	//
	// INSERINDO NA TABELA PARTES
	//
	$stmt = $con->prepare (
			"INSERT INTO partes
				(idPeriodico, titulo, pagInicio, pagFinal, palavrasChave, ativo) 
				VALUES (?, ?, ?, ?, ?, ?)"
			);
	
	$stmt->bind_param (
				"isssss", 
				$idPeriodico, $titulo, $pagInicio, $pagFinal, $palavrasChave, $ativo
			 );
	####################################################
		// Periódico 
		// idParte 
		$idPeriodico = ;
		$titulo = "";
		$pagInicio = "";
		$pagFinal = "";
		$palavrasChave = "";
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	// INSERINDO NA TABELA AUTORACERVO
	//
	$stmt = $con->prepare (
			"INSERT INTO autorAcervo
				(idAcervo, idAutor, ativo) 
				VALUES (?, ?, ?)"
			);
	
	$stmt->bind_param (
				"iis", 
				$idAcervo, $idAutor, $ativo
			 );
	####################################################
		// idAutorAcervo 
		$idAcervo = ;
		$idAutor = ;
		$ativo = "S";
		$stmt->execute();
	####################################################
	//
	// INSERINDO NA TABELA AUTORES
	//
	$stmt = $con->prepare (
			"INSERT INTO autores
				(nome, sobrenome, ordem, qualificacao, ativo) 
				VALUES (?, ?, ?, ?, ?)"
			);
	
	$stmt->bind_param (
				"sssss",
				$nome, $sobrenome, $ordem, $qualificacao, $ativo
			 );
	####################################################
		// idAutor  - Nome: 
		$nome = "";
		$sobrenome = "";
		$ordem = "";
		$qualificacao = "";
		$ativo = "S";
		$stmt->execute();
	####################################################

	//
	// INSERINDO NA TABELA RESERVAS
	//
	$stmt = $con->prepare (
			"INSERT INTO reservas
				(idAluno, idAcervo, dataReserva,tempoEspera, emprestou, ativo) 
				VALUES (?, ?, ?, ?, ?, ?)"
			);
	
	$stmt->bind_param (
				"sissss", 
				$idAluno, $idAcervo, $dataReserva, $tempoEspera, $emprestou, $ativo
			 );
	####################################################
		$idAluno = ;
		$idAcervo = ;
		$dataReserva = ;
		$tempoEspera = ;
		$emprestou = ;
		$ativo = ;
		$stmt->execute();
	####################################################
	//
	// INSERINDO NA TABELA EMPRESTIMOS
	//
	$stmt = $con->prepare (
			"INSERT INTO emprestimos
				(idAluno, idAcervo, dataEmprestimo, dataPrevisaoDevolucao, dataDevolucao, multa, ativo) 
				VALUES (?, ?, ?, ?, ?, ?, ?)"
			);
	
	// pode dar problema!!
	$stmt->bind_param (
				"sisssss", 
				$idAluno, $idAcervo, $dataEmprestimo, $dataPrevisaoDevolucao, $dataDevolucao, $multa, $ativo
			 );
	####################################################
		$idAluno = ;
		$idAcervo = ;
		$dataEmprestimo = ;
		$dataPrevisaoDevolucao = ;
		$dataDevolucao = ;
		$multa = ;
		$ativo = ;
		$stmt->execute();
	####################################################
	//
	// INSERINDO NA TABELA DESCARTES
	//
	$stmt = $con->prepare (
			"INSERT INTO descartes
				(idAcervo, idFuncionario, dataDescarte, motivos, ativo) 
				VALUES (?, ?, ?, ?, ?)"
			);
	
	$stmt->bind_param (
				"issss", 
				$idAcervo, $idFuncionario, $dataDescarte, $motivos, $ativo
			 );
	####################################################
		$idAcervo = ;
		$idFuncionario = ;
		$dataDescarte = ;
		$motivos = ;
		$ativo = ;
		$stmt->execute();
	####################################################
*/
###############################################################################################
	// FECHANDO A CONEXÃO
	//mysqli_close($con);
		
###############################################################################################
	echo "<b><h3>".'Dados inseridos com sucesso.'."</b></h3>"
?>