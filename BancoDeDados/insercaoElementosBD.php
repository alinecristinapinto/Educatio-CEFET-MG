<?php
###############################################################################################
	header("Content-type: text/html; charset=utf-8");

	$servername = "localhost";
	$username = "root";
	$password = "usbw";
	$bd = "educatio";

	$conexao = mysqli_connect($servername, $username, $password, $bd);
	
	mysqli_set_charset($conexao, "utf8");
	
	// TESTANDO A CONEXÃO
	if (!$conexao) {
	    die("Conexão falhou: " . mysqli_connect_error());
	}
	
	echo "Conexão bem sucedida";
###############################################################################################
	//
	// CÓDIGO PARA INSERÇÃO NAS TABELAS DO SISTEMA ACADÊMICO
	//
	//INSERINDO NA TABELA CAMPI
	//
	$stmt = $conexao -> prepare (
		"INSERT INTO campi
			(nome, cidade, UF, ativo) 
			VALUES (?, ?, ?, ?)"
	);

	$stmt -> bind_param (
		"ssss", 
		$nome, $cidade, $UF, $ativo
	);
	####################################################
		// idCampi 1
		$nome = "Campus I";
		$cidade = "Belo Horizonte";
		$UF = "MG";
		$ativo = "S";
		$stmt -> execute();
		 
		// idCampi 2
		$nome = "Campus II";
		$cidade = "Belo Horizonte";
		$UF = "MG";
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	//INSERINDO NA TABELA DEPTOS
	//
	$stmt = $conexao -> prepare (
		"INSERT INTO deptos
			(idCampi, nome, ativo)
			VALUES (?, ?, ?)"
	);

	$stmt -> bind_param (
		"iss", 
		$idCampi, $nome, $ativo
	);
	####################################################
		// idDepto 1
		$idCampi = 1;
		$nome = "DGH";
		$ativo = "S";
		$stmt -> execute();
		 
		// idDepto 2
		$idCampi = 1;
		$nome = "DCSF";
		$ativo = "S";
		$stmt -> execute();

		// idDepto 3
		$idCampi = 2;
		$nome = "DECOM";
		$ativo = "S";
		$stmt -> execute();
		 
		// idDepto 4
		$idCampi = 2;
		$nome = "CIVIL";
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	//INSERINDO NA TABELA CURSOS
	//
	$stmt = $conexao -> prepare (
		"INSERT INTO cursos
			(idDepto, nome, horasTotal, modalidade, ativo)
			VALUES (?, ?, ?, ?, ?)"
	);

	$stmt -> bind_param (
		"issss", 
		$idDepto, $nome, $horasTotal, $modalidade, $ativo
	);
	####################################################
		// idCurso 1
		$idDepto = 1;
		$nome = "Meio Ambiente";
		$horasTotal = "500";
		$modalidade = "Técnico Integrado";
		$ativo = "S";
		$stmt -> execute();
		 
		// idCurso 2
		$idDepto = 2;
		$nome = "Filosofia da Tecnologia";
		$horasTotal = "400";
		$modalidade = "Graduação";
		$ativo = "S";
		$stmt -> execute();

		// idCurso 3
		$idDepto = 3;
		$nome = "Informática";
		$horasTotal = "700";
		$modalidade = "Técnico Integrado";
		$ativo = "S";
		$stmt -> execute();

		// idCurso 4
		$idDepto = 4;
		$nome = "Edificações";
		$horasTotal = "650";
		$modalidade = "Técnico Integrado";
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	//INSERINDO NA TABELA TURMAS
	//
	$stmt = $conexao -> prepare (
		"INSERT INTO turmas
			(idCurso, serie, nome, ativo)
			VALUES (?, ?, ?, ?)"
	);

	$stmt -> bind_param (
		"iiss", 
		$idCurso, $serie, $nome, $ativo
	);

	// série da graduação varia de 1 a 10 (numero de semestres)
	####################################################
		// idTurma 1
		$idCurso = 1;
		$serie = 3;
		$nome = "MEI A";
		$ativo = "S";
		$stmt -> execute();

		// idTurma 2
		$idCurso = 2;
		$serie = 2;
		$nome = "FIT";
		$ativo = "S";
		$stmt -> execute();

		// idTurma 3
		$idCurso = 3;
		$serie = 2;
		$nome = "INF A";
		$ativo = "S";
		$stmt -> execute();

		// idTurma 4
		$idCurso = 4;
		$serie = 1;
		$nome = "EDI A";
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	//INSERINDO NA TABELA ALUNOS
	//
	$stmt = $conexao -> prepare (
		"INSERT INTO alunos
  			(idCPF, idTurma, nome, sexo, nascimento, logradouro, numeroLogradouro, complemento,
  			 bairro, cidade, CEP, UF, email, senha, ativo)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
			// pode dar problema (foto)
	);

	$stmt -> bind_param (
		"sisssssssssssss", 
		$idCPF, $idTurma, $nome, $sexo, $nascimento, $logradouro, $numeroLogradouro, $complemento,
  		$bairro, $cidade, $CEP, $UF, $email, $senha, $ativo
	);

	####################################################
		$idCPF = "89594318180";
		$idTurma = 1;
		$nome = "Isabelle Lightwood";
		$sexo = "Feminino";
		$nascimento = "06/09/1999";
		$logradouro = "Rua Trinta e Cinco";
		$numeroLogradouro = "456";
		$complemento = "Casa";
		$bairro = "Santo Amaro";
		$cidade = "Montes Claro";
		$CEP = "39403368";
		$UF = "MG";
		$email = "izzylightwood@gmail.com";
		// senha - power
		$senha = "62cd275989e78ee56a81f0265a87562e";
		$ativo = "S";
		$stmt -> execute();

		$idCPF = "13612887106";
		$idTurma = 1;
		$nome = "Clarissa Fairchild";
		$sexo = "Feminino";
		$nascimento = "25/06/2000";
		$logradouro = "Rua Quênia";
		$numeroLogradouro = "422";
		$complemento = "Casa";
		$bairro = "Cariru";
		$cidade = "Ipatinga";
		$CEP = "35160133";
		$UF = "MG";
		$email = "claryf@gmail.com";
		// senha - arte
		$senha = "c8581bc43486c23ee099afe031f4de31";
		$ativo = "S";
		$stmt -> execute();

		$idCPF = "86312366243";
		$idTurma = 2;
		$nome = "Jonathan Morgenstern";
		$sexo = "Masculino";
		$nascimento = "21/07/1998";
		$logradouro = "Rua Eliza Maria Coelho";
		$numeroLogradouro = "66";
		$complemento = "Apartamento";
		$bairro = "Jardim Canaã";
		$cidade = "Uberlândia";
		$CEP = "38412490";
		$UF = "MG";
		$email = "jcmorgenstern@gmail.com";
		// senha - lilith
		$senha = "2cb1be65eb9f215215a0725a10b6e39e";
		$ativo = "S";
		$stmt -> execute();

		$idCPF = "37326385610";
		$idTurma = 2;
		$nome = "Jonathan Herondale";
		$sexo = "Masculino";
		$nascimento = "01/10/1998";
		$logradouro = "Rua Engenheiro Pedro Bax";
		$numeroLogradouro = "44";
		$complemento = "Apartamento";
		$bairro = "Santa Amélia";
		$cidade = "Belo Horizonte";
		$CEP = "31560380";
		$UF = "MG";
		$email = "jcherondale@gmail.com";
		// senha - anjo
		$senha = "41a1c0ea99261a72c5c51787d51b8935";
		$ativo = "S";
		$stmt -> execute();

		$idCPF = "70264415400";
		$idTurma = 3;
		$nome = "Teresa Gray";
		$sexo = "Feminino";
		$nascimento = "09/12/2000";
		$logradouro = "Rua Nhá Chica";
		$numeroLogradouro = "57";
		$complemento = "Apartamento";
		$bairro = "Cinquentenário";
		$cidade = "Belo Horizonte";
		$CEP = "30570170";
		$UF = "MG";
		$email = "tessgray@gmail.com";
		// senha - livros
		$senha = "a1ce0a5c0397d339acb4575c4af5e2a5";
		$ativo = "S";
		$stmt -> execute();

		$idCPF = "83755279711";
		$idTurma = 3;
		$nome = "William Herondale";
		$sexo = "Masculino";
		$nascimento = "11/11/2000";
		$logradouro = "Beco Estrela Dalva";
		$numeroLogradouro = "225";
		$complemento = "Apartamento";
		$bairro = "Vila Barragem Santa Lúcia";
		$cidade = "Belo Horizonte";
		$CEP = "30335630";
		$UF = "MG";
		$email = "willherondale@gmail.com";
		// senha - patos
		$senha = "328573e80f3dfc694143f580ba74b1ed";
		$ativo = "S";
		$stmt -> execute();

		$idCPF = "50595766714";
		$idTurma = 4;
		$nome = "James Carstairs";
		$sexo = "Masculino";
		$nascimento = "03/03/2000";
		$logradouro = "Rua Percília Ferreira Vasconcelos";
		$numeroLogradouro = "31";
		$complemento = "Apartamento";
		$bairro = "São Caetano";
		$cidade = "Divinópolis";
		$CEP = "35502238";
		$UF = "MG";
		$email = "jemcarstairs@gmail.com";
		// senha - parabatai
		$senha = "9a4d208d1b53ff8f95e4a7268a8aa786";
		$ativo = "S";
		$stmt -> execute();

		$idCPF = "41125360623";
		$idTurma = 4;
		$nome = "Julian Blackthorn";
		$sexo = "Masculino";
		$nascimento = "14/05/2001";
		$logradouro = "Rua Nhá Chica";
		$numeroLogradouro = "928";
		$complemento = "Casa";
		$bairro = "Cinquentenário";
		$cidade = "Belo Horizonte";
		$CEP = "";
		$UF = "MG";
		$email = "julesblackthorn@gmail.com";
		// senha - emma
		$senha = "00a809937eddc44521da9521269e75c6";
		$ativo = "S";
		$stmt -> execute();
	####################################################
	
	//
	//INSERINDO NA TABELA MATRICULAS
	//
	$stmt = $conexao -> prepare (
		"INSERT INTO matriculas
			(idAluno, idDisciplina, ano, ativo)
			VALUES (?, ?, ?, ?)"
	);

	$stmt -> bind_param (
		"siss", 
		$idAluno, $idDisciplina, $ano, $ativo
	);

	####################################################
		// idMatricula 1
		$idAluno = "89594318180";
		$idDisciplina = 1;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idMatricula 2
		$idAluno = "89594318180";
		$idDisciplina = 2;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// idMatricula 3
		$idAluno = "13612887106";
		$idDisciplina = 1;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idMatricula 4
		$idAluno = "13612887106";
		$idDisciplina = 2;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// idMatricula 5
		$idAluno = "86312366243";
		$idDisciplina = 3;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idMatricula 6
		$idAluno = "86312366243";
		$idDisciplina = 4;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// idMatricula 7
		$idAluno = "37326385610";
		$idDisciplina = 3;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idMatricula 8
		$idAluno = "37326385610";
		$idDisciplina = 4;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// idMatricula 9
		$idAluno = "70264415400";
		$idDisciplina = 5;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idMatricula 10
		$idAluno = "70264415400";
		$idDisciplina = 6;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// idMatricula 11
		$idAluno = "83755279711";
		$idDisciplina = 5;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idMatricula 12
		$idAluno = "83755279711";
		$idDisciplina = 6;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// idMatricula 13
		$idAluno = "50595766714";
		$idDisciplina = 7;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idMatricula 14
		$idAluno = "50595766714";
		$idDisciplina = 8;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// idMatricula 15
		$idAluno = "50595766714";
		$idDisciplina = 7;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idMatricula 16
		$idAluno = "50595766714";
		$idDisciplina = 8;
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	//INSERINDO NA TABELA FUNCIONARIO
	//
	$stmt = $conexao -> prepare (
		"INSERT INTO funcionario
			(idSIAPE, idDepto, nome, titulacao, hierarquia, senha, ativo)
			VALUES (?, ?, ?, ?, ?, ?, ?)"
	);

	$stmt -> bind_param (
		"sisssss", 
		$idSIAPE, $idDepto, $nome, $titulacao, $hierarquia, $senha, $ativo
	);

	####################################################
		$idSIAPE = "9543746";
		$idDepto = 1;
		$nome = "Letícia Carvalho";
		$titulacao = "M";
		$hierarquia = "P";
		// senha - geo
		$senha = "ecc174e3e02c82f34c14fe860bf47ef2";
		$ativo = "S";
		$stmt -> execute();

		$idSIAPE = "8026034";
		$idDepto = 1;
		$nome = "Margareth Cordeiro Franklim";
		$titulacao = "D";
		$hierarquia = "C";
		// senha - his
		$senha = "65b50b04a6af50bb2f174db30a8c6dad";
		$ativo = "S";
		$stmt -> execute();

		$idSIAPE = "3768433";
		$idDepto = 2;
		$nome = "Guilherme Araújo Cardoso";
		$titulacao = "D";
		$hierarquia = "P";
		// senha - filo
		$senha = "d47bfd5933612d778f880a64e7032751";
		$ativo = "S";
		$stmt -> execute();

		$idSIAPE = "3346386";
		$idDepto = 2;
		$nome = "Túlio Cardoso Rebehy";
		$titulacao = "D";
		$hierarquia = "C";
		// senha - socio
		$senha = "1b1844daa452df42c6f9123857ca686c";
		$ativo = "S";
		$stmt -> execute();

		$idSIAPE = "6089259";
		$idDepto = 3;
		$nome = "José Wilson da Costa";
		$titulacao = "G";
		$hierarquia = "C";
		// senha - lp
		$senha = "351325a660b25474456af5c9a5606c4e";
		$ativo = "S";
		$stmt -> execute();

		$idSIAPE = "8970835";
		$idDepto = 3;
		$nome = "William Geraldo Sallum";
		$titulacao = "M";
		$hierarquia = "P";
		// senha - web
		$senha = "2567a5ec9705eb7ac2c984033e06189d";
		$ativo = "S";
		$stmt -> execute();

		$idSIAPE = "4272678";
		$idDepto = 4;
		$nome = "Diego Barbosa";
		$titulacao = "E";
		$hierarquia = "C";
		// senha - edi123
		$senha = "d0163339ed4f88a47eb254aa784f4230";
		$ativo = "S";
		$stmt -> execute();

		$idSIAPE = "7130717";
		$idDepto = 4;
		$nome = "Marcos Paulo";
		$titulacao = "D";
		$hierarquia = "P";
		// senha - edi456
		$senha = "831fc87205fea5fbfbdf026f2f7d2803";
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	//INSERINDO NA TABELA DISCIPLINAS
	//
	$stmt = $conexao -> prepare (
		"INSERT INTO disciplinas
			(idTurma, nome, cargaHorariaMin, ativo)
			VALUES (?, ?, ?, ?)"
	);

	$stmt -> bind_param (
		"isss", 
		$idTurma, $nome, $cargaHorariaMin, $ativo
	);
	####################################################
		// idDisciplina 1
		$idTurma = 1;
		$nome = "Geografia";
		$cargaHorariaMin = "20";
		$ativo = "S";
		$stmt -> execute();

		// idDisciplina 2
		$idTurma = 1;
		$nome = "História";
		$cargaHorariaMin = "18";
		$ativo = "S";
		$stmt -> execute();

		// idDisciplina 3
		$idTurma = 2;
		$nome = "Filosofia";
		$cargaHorariaMin = "10";
		$ativo = "S";
		$stmt -> execute();

		// idDisciplina 4
		$idTurma = 2;
		$nome = "Sociologia";
		$cargaHorariaMin = "12";
		$ativo = "S";
		$stmt -> execute();

		// idDisciplina 5
		$idTurma = 3;
		$nome = "LP";
		$cargaHorariaMin = "50";
		$ativo = "S";
		$stmt -> execute();

		// idDisciplina 6
		$idTurma = 3;
		$nome = "WEB";
		$cargaHorariaMin = "40";
		$ativo = "S";
		$stmt -> execute();

		// idDisciplina 7
		$idTurma = 4;
		$nome = "TOP";
		$cargaHorariaMin = "35";
		$ativo = "S";
		$stmt -> execute();

		// idDisciplina 8
		$idTurma = 4;
		$nome = "Materiais";
		$cargaHorariaMin = "30";
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	//INSERINDO NA TABELA PROFDISCIPLINAS
	//
	$stmt = $conexao -> prepare (
		"INSERT INTO profDisciplinas
			(idProfessor, idDisciplina, idTurma, ativo)
			VALUES (?, ?, ?, ?)"
	);

	$stmt -> bind_param (
		"siis", 
		$idProfessor, $idDisciplina, $idTurma, $ativo
	);

	####################################################
		// idProfDisciplina 1
		$idProfessor = "9543746";
		$idDisciplina = 1;
		$idTurma = 1;
		$ativo = "S";
		$stmt -> execute();

		// idProfDisciplina 2
		$idProfessor = "8026034";
		$idDisciplina = 2;
		$idTurma = 1;
		$ativo = "S";
		$stmt -> execute();

		// idProfDisciplina 3
		$idProfessor = "3768433";
		$idDisciplina = 3;
		$idTurma = 2;
		$ativo = "S";
		$stmt -> execute();

		// idProfDisciplina 4
		$idProfessor = "3346386";
		$idDisciplina = 4;
		$idTurma = 2;
		$ativo = "S";
		$stmt -> execute();

		// idProfDisciplina 5
		$idProfessor = "6089259";
		$idDisciplina = 5;
		$idTurma = 3;
		$ativo = "S";
		$stmt -> execute();

		// idProfDisciplina 6
		$idProfessor = "8970835";
		$idDisciplina = 6;
		$idTurma = 3;
		$ativo = "S";
		$stmt -> execute();

		// idProfDisciplina 7
		$idProfessor = "4272678";
		$idDisciplina = 7;
		$idTurma = 4;
		$ativo = "S";
		$stmt -> execute();

		// idProfDisciplina 8
		$idProfessor = "7130717";
		$idDisciplina = 8;
		$idTurma = 4;
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	//INSERINDO NA TABELA ETAPAS
	//
	$stmt = $conexao -> prepare (
		"INSERT INTO etapas
			(idOrdem, valor, ativo)
			VALUES (?, ?, ?)"
	);

	$stmt -> bind_param (
		"sss", 
		$idOrdem, $valor, $ativo
	);

	####################################################
		// idEtapa 1
		$idOrdem = "1";
		$valor = "20";
		$ativo = "S";
		$stmt -> execute();

		// idEtapa 2
		$idOrdem = "2";
		$valor = "30";
		$ativo = "S";
		$stmt -> execute();

		// idEtapa 3
		$idOrdem = "3";
		$valor = "20";
		$ativo = "S";
		$stmt -> execute();

		// idEtapa 4
		$idOrdem = "4";
		$valor = "30";
		$ativo = "S";
		$stmt -> execute();

		// idEtapa 5
		$idOrdem = "5";
		$valor = "100";
		$ativo = "S";
		$stmt -> execute();

		// idEtapa 6
		$idOrdem = "6";
		$valor = "100";
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	//INSERINDO NA TABELA ATIVIDADES
	//
	$stmt = $conexao -> prepare (
		"INSERT INTO atividades
			(idProfDisciplina, nome, data, valor, ativo)
			VALUES (?, ?, ?, ?, ?)"
	);

	$stmt -> bind_param (
		"issss",
		$idProfDisciplina, $nome, $data, $valor, $ativo
	);

	####################################################
		// idAtividade 1
		$idProfDisciplina = 1;
		$nome = "Aula Geografia";
		$data = "20/02/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 2
		$idProfDisciplina = 2;
		$nome = "Aula História";
		$data = "20/02/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 3
		$idProfDisciplina = 3;
		$nome = "Aula Filosofia";
		$data = "21/02/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 4
		$idProfDisciplina = 4;
		$nome = "Aula Sociologia";
		$data = "21/02/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 5
		$idProfDisciplina = 5;
		$nome = "Aula LP";
		$data = "22/02/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 6
		$idProfDisciplina = 6;
		$nome = "Aula WEB";
		$data = "22/02/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 7
		$idProfDisciplina = 7;
		$nome = "Aula TOP";
		$data = "23/02/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 8
		$idProfDisciplina = 8;
		$nome = "Aula Materiais";
		$data = "23/02/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 9
		$idProfDisciplina = 1;
		$nome = "Prova Geografia";
		$data = "13/03/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 10
		$idProfDisciplina = 2;
		$nome = "Prova História";
		$data = "13/03/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 11
		$idProfDisciplina = 3;
		$nome = "Prova Filosofia";
		$data = "14/03/2017";
		$valor = "50";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 12
		$idProfDisciplina = 4;
		$nome = "Prova Sociologia";
		$data = "14/03/2017";
		$valor = "50";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 13
		$idProfDisciplina = 5;
		$nome = "Prova LP";
		$data = "15/03/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 14
		$idProfDisciplina = 6;
		$nome = "Prova WEB";
		$data = "15/03/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 15
		$idProfDisciplina = 7;
		$nome = "Prova TOP";
		$data = "16/03/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 16
		$idProfDisciplina = 8;
		$nome = "Prova Materiais";
		$data = "16/03/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 17
		$idProfDisciplina = 1;
		$nome = "Trabalho Geografia";
		$data = "20/03/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 18
		$idProfDisciplina = 2;
		$nome = "Trabalho História";
		$data = "20/03/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 19
		$idProfDisciplina = 3;
		$nome = "Trabalho Filosofia";
		$data = "21/03/2017";
		$valor = "50";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 20
		$idProfDisciplina = 4;
		$nome = "Trabalho Sociologia";
		$data = "21/03/2017";
		$valor = "50";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 21
		$idProfDisciplina = 5;
		$nome = "Trabalho LP";
		$data = "22/03/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 22
		$idProfDisciplina = 6;
		$nome = "Trabalho WEB";
		$data = "22/03/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 23
		$idProfDisciplina = 7;
		$nome = "Trabalho TOP";
		$data = "23/03/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 24
		$idProfDisciplina = 8;
		$nome = "Trabalho Materiais";
		$data = "23/03/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();
		///////////////////////////////////////
		// idAtividade 25
		$idProfDisciplina = 1;
		$nome = "Aula Geografia";
		$data = "08/05/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 26
		$idProfDisciplina = 2;
		$nome = "Aula História";
		$data = "08/05/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 27
		$idProfDisciplina = 3;
		$nome = "Aula Filosofia";
		$data = "09/08/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 28
		$idProfDisciplina = 4;
		$nome = "Aula Sociologia";
		$data = "09/08/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 29
		$idProfDisciplina = 5;
		$nome = "Aula LP";
		$data = "10/05/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 30
		$idProfDisciplina = 6;
		$nome = "Aula WEB";
		$data = "10/05/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 31
		$idProfDisciplina = 7;
		$nome = "Aula TOP";
		$data = "11/05/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 32
		$idProfDisciplina = 8;
		$nome = "Aula Materiais";
		$data = "11/05/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 33
		$idProfDisciplina = 1;
		$nome = "Prova Geografia";
		$data = "23/05/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 34
		$idProfDisciplina = 2;
		$nome = "Prova História";
		$data = "23/05/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 35
		$idProfDisciplina = 3;
		$nome = "Prova Filosofia";
		$data = "23/08/2017";
		$valor = "50";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 36
		$idProfDisciplina = 4;
		$nome = "Prova Sociologia";
		$data = "23/08/2017";
		$valor = "50";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 37
		$idProfDisciplina = 5;
		$nome = "Prova LP";
		$data = "25/05/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 38
		$idProfDisciplina = 6;
		$nome = "Prova WEB";
		$data = "25/05/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 39
		$idProfDisciplina = 7;
		$nome = "Prova TOP";
		$data = "26/05/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 40
		$idProfDisciplina = 8;
		$nome = "Prova Materiais";
		$data = "26/05/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 41
		$idProfDisciplina = 1;
		$nome = "Trabalho Geografia";
		$data = "29/05/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 42
		$idProfDisciplina = 2;
		$nome = "Trabalho História";
		$data = "29/05/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 43
		$idProfDisciplina = 3;
		$nome = "Trabalho Filosofia";
		$data = "30/08/2017";
		$valor = "50";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 44
		$idProfDisciplina = 4;
		$nome = "Trabalho Sociologia";
		$data = "30/08/2017";
		$valor = "50";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 45
		$idProfDisciplina = 5;
		$nome = "Trabalho LP";
		$data = "31/05/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 46
		$idProfDisciplina = 6;
		$nome = "Trabalho WEB";
		$data = "31/05/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 47
		$idProfDisciplina = 7;
		$nome = "Trabalho TOP";
		$data = "01/06/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 48
		$idProfDisciplina = 8;
		$nome = "Trabalho Materiais";
		$data = "01/06/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		///////////////////////////////////////
		// idAtividade 49
		$idProfDisciplina = 1;
		$nome = "Aula Geografia";
		$data = "07/08/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 50
		$idProfDisciplina = 2;
		$nome = "Aula História";
		$data = "07/08/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 51
		$idProfDisciplina = 5;
		$nome = "Aula LP";
		$data = "09/08/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 52
		$idProfDisciplina = 6;
		$nome = "Aula WEB";
		$data = "09/08/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 53
		$idProfDisciplina = 7;
		$nome = "Aula TOP";
		$data = "10/08/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 54
		$idProfDisciplina = 8;
		$nome = "Aula Materiais";
		$data = "10/08/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 55
		$idProfDisciplina = 1;
		$nome = "Prova Geografia";
		$data = "21/08/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 56
		$idProfDisciplina = 2;
		$nome = "Prova História";
		$data = "21/08/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 57
		$idProfDisciplina = 5;
		$nome = "Prova LP";
		$data = "23/08/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 58
		$idProfDisciplina = 6;
		$nome = "Prova WEB";
		$data = "23/08/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 59
		$idProfDisciplina = 7;
		$nome = "Prova TOP";
		$data = "24/08/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 60
		$idProfDisciplina = 8;
		$nome = "Prova Materiais";
		$data = "24/08/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 61
		$idProfDisciplina = 1;
		$nome = "Trabalho Geografia";
		$data = "28/08/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 62
		$idProfDisciplina = 2;
		$nome = "Trabalho História";
		$data = "28/08/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 63
		$idProfDisciplina = 5;
		$nome = "Trabalho LP";
		$data = "30/08/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 64
		$idProfDisciplina = 6;
		$nome = "Trabalho WEB";
		$data = "30/08/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 65
		$idProfDisciplina = 7;
		$nome = "Trabalho TOP";
		$data = "31/08/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 66
		$idProfDisciplina = 8;
		$nome = "Trabalho Materiais";
		$data = "31/08/2017";
		$valor = "10";
		$ativo = "S";
		$stmt -> execute();

		///////////////////////////////////////
		// idAtividade 67
		$idProfDisciplina = 1;
		$nome = "Aula Geografia";
		$data = "02/10/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 68
		$idProfDisciplina = 2;
		$nome = "Aula História";
		$data = "02/10/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 69
		$idProfDisciplina = 5;
		$nome = "Aula LP";
		$data = "04/10/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 70
		$idProfDisciplina = 6;
		$nome = "Aula WEB";
		$data = "04/10/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 71
		$idProfDisciplina = 7;
		$nome = "Aula TOP";
		$data = "05/10/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 72
		$idProfDisciplina = 8;
		$nome = "Aula Materiais";
		$data = "05/10/2017";
		$valor = "0";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 73
		$idProfDisciplina = 1;
		$nome = "Prova Geografia";
		$data = "16/10/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 74
		$idProfDisciplina = 2;
		$nome = "Prova História";
		$data = "16/10/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 75
		$idProfDisciplina = 5;
		$nome = "Prova LP";
		$data = "18/10/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 76
		$idProfDisciplina = 6;
		$nome = "Prova WEB";
		$data = "18/10/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 77
		$idProfDisciplina = 7;
		$nome = "Prova TOP";
		$data = "19/10/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 78
		$idProfDisciplina = 8;
		$nome = "Prova Materiais";
		$data = "19/10/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 79
		$idProfDisciplina = 1;
		$nome = "Trabalho Geografia";
		$data = "23/10/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 80
		$idProfDisciplina = 2;
		$nome = "Trabalho História";
		$data = "23/10/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 81
		$idProfDisciplina = 5;
		$nome = "Trabalho LP";
		$data = "25/10/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 82
		$idProfDisciplina = 6;
		$nome = "Trabalho WEB";
		$data = "25/10/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 83
		$idProfDisciplina = 7;
		$nome = "Trabalho TOP";
		$data = "26/10/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();

		// idAtividade 84
		$idProfDisciplina = 8;
		$nome = "Trabalho Materiais";
		$data = "26/10/2017";
		$valor = "15";
		$ativo = "S";
		$stmt -> execute();
	####################################################


	//
	//INSERINDO NA TABELA CONTEUDOS
	//

	$stmt = $conexao -> prepare (
		"INSERT INTO conteudos
			(idEtapa, idDisciplina, conteudo, datas, ativo)
			VALUES (?, ?, ?, ?, ?)"
	);

	$stmt -> bind_param (
		"iisss",
		$idEtapa, $idDisciplina, $conteudo, $datas, $ativo
	);

	####################################################
		// idConteudo 1
		$idEtapa = 1;
		$idDisciplina = 1;
		$conteudo = "Conteúdo 1 de Geografia 1º Bimestre";
		$datas = "20/02/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 2
		$idEtapa = 1;
		$idDisciplina = 2;
		$conteudo = "Conteúdo 1 de História 1º Bimestre";
		$datas = "20/02/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 3
		$idEtapa = 5;
		$idDisciplina = 3;
		$conteudo = "Conteúdo 1 de Filosofia 1º Semestre";
		$datas = "21/02/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 4
		$idEtapa = 5;
		$idDisciplina = 4;
		$conteudo = "Conteúdo 1 de Sociologia 1º Semestre";
		$datas = "21/02/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 5
		$idEtapa = 1;
		$idDisciplina = 5;
		$conteudo = "Conteúdo 1 de LP 1º Bimestre";
		$datas = "22/02/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 6
		$idEtapa = 1;
		$idDisciplina = 6;
		$conteudo = "Conteúdo 1 de WEB 1º Bimestre";
		$datas = "22/02/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 7
		$idEtapa = 1;
		$idDisciplina = 7;
		$conteudo = "Conteúdo 1 de TOP 1º Bimestre";
		$datas = "23/02/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 8
		$idEtapa = 1;
		$idDisciplina = 8;
		$conteudo = "Conteúdo 1 de Materiais 1º Bimestre";
		$datas = "23/02/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 9
		$idEtapa = 2;
		$idDisciplina = 1;
		$conteudo = "Conteúdo 1 de Geografia 2º Bimestre";
		$datas = "08/05/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 10
		$idEtapa = 2;
		$idDisciplina = 2;
		$conteudo = "Conteúdo 1 de História 2º Bimestre";
		$datas = "08/05/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 11
		$idEtapa = 6;
		$idDisciplina = 3;
		$conteudo = "Conteúdo 1 de Filosofia 2º Semestre";
		$datas = "09/05/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 12
		$idEtapa = 6;
		$idDisciplina = 4;
		$conteudo = "Conteúdo 1 de Sociologia 2º Semestre";
		$datas = "09/05/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 13
		$idEtapa = 2;
		$idDisciplina = 5;
		$conteudo = "Conteúdo 1 de LP 2º Bimestre";
		$datas = "10/05/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 14
		$idEtapa = 2;
		$idDisciplina = 6;
		$conteudo = "Conteúdo 1 de WEB 2º Bimestre";
		$datas = "10/05/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 15
		$idEtapa = 2;
		$idDisciplina = 7;
		$conteudo = "Conteúdo 1 de TOP 2º Bimestre";
		$datas = "11/05/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 16
		$idEtapa = 2;
		$idDisciplina = 8;
		$conteudo = "Conteúdo 1 de Materiais 2º Bimestre";
		$datas = "11/05/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 17
		$idEtapa = 3;
		$idDisciplina = 1;
		$conteudo = "Conteúdo 1 de Geografia 3º Bimestre";
		$datas = "07/08/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 18
		$idEtapa = 3;
		$idDisciplina = 2;
		$conteudo = "Conteúdo 1 de História 3º Bimestre";
		$datas = "07/08/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 19
		$idEtapa = 3;
		$idDisciplina = 5;
		$conteudo = "Conteúdo 1 de LP 3º Bimestre";
		$datas = "09/08/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 20
		$idEtapa = 3;
		$idDisciplina = 6;
		$conteudo = "Conteúdo 1 de WEB 3º Bimestre";
		$datas = "09/08/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 21
		$idEtapa = 3;
		$idDisciplina = 7;
		$conteudo = "Conteúdo 1 de TOP 3º Bimestre";
		$datas = "10/08/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 22
		$idEtapa = 3;
		$idDisciplina = 8;
		$conteudo = "Conteúdo 1 de Materiais 3º Bimestre";
		$datas = "10/08/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 23
		$idEtapa = 4;
		$idDisciplina = 1;
		$conteudo = "Conteúdo 1 de Geografia 4º Bimestre";
		$datas = "02/10/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 24
		$idEtapa = 4;
		$idDisciplina = 2;
		$conteudo = "Conteúdo 1 de História 4º Bimestre";
		$datas = "02/10/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 25
		$idEtapa = 4;
		$idDisciplina = 5;
		$conteudo = "Conteúdo 1 de LP 4º Bimestre";
		$datas = "04/10/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 26
		$idEtapa = 4;
		$idDisciplina = 6;
		$conteudo = "Conteúdo 1 de WEB 4º Bimestre";
		$datas = "04/10/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 27
		$idEtapa = 4;
		$idDisciplina = 7;
		$conteudo = "Conteúdo 1 de TOP 4º Bimestre";
		$datas = "05/10/2017";
		$ativo = "S";
		$stmt -> execute();

		// idConteudo 28
		$idEtapa = 4;
		$idDisciplina = 8;
		$conteudo = "Conteúdo 1 de Materiais 4º Bimestre";
		$datas = "05/10/2017";
		$ativo = "S";
		$stmt -> execute();
	####################################################
//
	//INSERINDO NA TABELA DIARIOS
	//
	$stmt = $conexao -> prepare (
		"INSERT INTO diarios
			(idConteudo, idMatricula, idAtividade, faltas, nota, ano, ativo)
			VALUES (?, ?, ?, ?, ?, ?, ?)"
	);

	$stmt -> bind_param (
		"iiissss", 
		$idConteudo, $idMatricula, $idAtividade, $faltas, $nota, $ano, $ativo
	);

	####################################################
		// Aluno 1, disciplina 1, 1º bimestre (aula, prova e trabalho)
		// idDiario 1
		$idConteudo = 1;
		$idMatricula = 1;
		$idAtividade = 1;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 2
		$idConteudo = 1;
		$idMatricula = 1;
		$idAtividade = 9;
		$faltas = "0";
		$nota = "9";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 3
		$idConteudo = 1;
		$idMatricula = 1;
		$idAtividade = 17;
		$faltas = "0";
		$nota = "7";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 1, disciplina 2, 1º bimestre (aula, prova e trabalho)
		// idDiario 4
		$idConteudo = 2;
		$idMatricula = 2;
		$idAtividade = 2;
		$faltas = "2";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 5
		$idConteudo = 2;
		$idMatricula = 2;
		$idAtividade = 10;
		$faltas = "0";
		$nota = "6";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 6
		$idConteudo = 2;
		$idMatricula = 2;
		$idAtividade = 18;
		$faltas = "0";
		$nota = "10";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 2, disciplina 1, 1º bimestre (aula, prova e trabalho)
		// idDiario 7
		$idConteudo = 1;
		$idMatricula = 3;
		$idAtividade = 1;
		$faltas = "1";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 8
		$idConteudo = 1;
		$idMatricula = 3;
		$idAtividade = 9;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 9
		$idConteudo = 1;
		$idMatricula = 3;
		$idAtividade = 17;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 2, disciplina 2, 1º bimestre (aula, prova e trabalho)
		// idDiario 10
		$idConteudo = 2;
		$idMatricula = 4;
		$idAtividade = 2;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 11
		$idConteudo = 2;
		$idMatricula = 4;
		$idAtividade = 10;
		$faltas = "0";
		$nota = "7";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 12
		$idConteudo = 2;
		$idMatricula = 4;
		$idAtividade = 18;
		$faltas = "0";
		$nota = "9";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 3, disciplina 3, 1º semestre (aula, prova e trabalho)
		// idDiario 13
		$idConteudo = 3;
		$idMatricula = 5;
		$idAtividade = 3;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 14
		$idConteudo = 3;
		$idMatricula = 5;
		$idAtividade = 11;
		$faltas = "0";
		$nota = "47";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 15
		$idConteudo = 3;
		$idMatricula = 5;
		$idAtividade = 19;
		$faltas = "0";
		$nota = "38";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 3, disciplina 4, 1º semestre (aula, prova e trabalho)
		// idDiario 16
		$idConteudo = 4;
		$idMatricula = 6;
		$idAtividade = 4;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 17
		$idConteudo = 4;
		$idMatricula = 6;
		$idAtividade = 12;
		$faltas = "0";
		$nota = "28";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 18
		$idConteudo = 4;
		$idMatricula = 6;
		$idAtividade = 20;
		$faltas = "0";
		$nota = "40";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 4, disciplina 3, 1º semestre (aula, prova e trabalho)
		// idDiario 19
		$idConteudo = 3;
		$idMatricula = 7;
		$idAtividade = 3;
		$faltas = "4";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 20
		$idConteudo = 3;
		$idMatricula = 7;
		$idAtividade = 11;
		$faltas = "0";
		$nota = "42";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 21
		$idConteudo = 3;
		$idMatricula = 7;
		$idAtividade = 19;
		$faltas = "0";
		$nota = "42";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 4, disciplina 4, 1º semestre (aula, prova e trabalho)
		// idDiario 22
		$idConteudo = 4;
		$idMatricula = 8;
		$idAtividade = 4;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 23
		$idConteudo = 4;
		$idMatricula = 8;
		$idAtividade = 12;
		$faltas = "0";
		$nota = "28";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 24
		$idConteudo = 4;
		$idMatricula = 8;
		$idAtividade = 20;
		$faltas = "0";
		$nota = "47";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 5, disciplina 5, 1º bimestre (aula, prova e trabalho)
		// idDiario 25
		$idConteudo = 5;
		$idMatricula = 9;
		$idAtividade = 5;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 26
		$idConteudo = 5;
		$idMatricula = 9;
		$idAtividade = 13;
		$faltas = "0";
		$nota = "9";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 27
		$idConteudo = 5;
		$idMatricula = 9;
		$idAtividade = 21;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 5, disciplina 6, 1º bimestre (aula, prova e trabalho)
		// idDiario 28
		$idConteudo = 6;
		$idMatricula = 10;
		$idAtividade = 6;
		$faltas = "2";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 29
		$idConteudo = 6;
		$idMatricula = 10;
		$idAtividade = 14;
		$faltas = "0";
		$nota = "10";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 30
		$idConteudo = 6;
		$idMatricula = 10;
		$idAtividade = 22;
		$faltas = "0";
		$nota = "6";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 6, disciplina 5, 1º bimestre (aula, prova e trabalho)
		// idDiario 31
		$idConteudo = 5;
		$idMatricula = 11;
		$idAtividade = 5;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 32
		$idConteudo = 5;
		$idMatricula = 11;
		$idAtividade = 13;
		$faltas = "0";
		$nota = "7";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 33
		$idConteudo = 5;
		$idMatricula = 11;
		$idAtividade = 21;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 6, disciplina 6, 1º bimestre (aula, prova e trabalho)
		// idDiario 34
		$idConteudo = 6;
		$idMatricula = 12;
		$idAtividade = 6;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 35
		$idConteudo = 6;
		$idMatricula = 12;
		$idAtividade = 14;
		$faltas = "0";
		$nota = "10";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 36
		$idConteudo = 6;
		$idMatricula = 12;
		$idAtividade = 22;
		$faltas = "0";
		$nota = "10";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 7, disciplina 7, 1º bimestre (aula, prova e trabalho)
		// idDiario 37
		$idConteudo = 7;
		$idMatricula = 13;
		$idAtividade = 7;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 38
		$idConteudo = 7;
		$idMatricula = 13;
		$idAtividade = 15;
		$faltas = "0";
		$nota = "9";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 39
		$idConteudo = 7;
		$idMatricula = 13;
		$idAtividade = 23;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 7, disciplina 8, 1º bimestre (aula, prova e trabalho)
		// idDiario 40
		$idConteudo = 8;
		$idMatricula = 14;
		$idAtividade = 8;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 41
		$idConteudo = 8;
		$idMatricula = 14;
		$idAtividade = 16;
		$faltas = "0";
		$nota = "5";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 42
		$idConteudo = 8;
		$idMatricula = 14;
		$idAtividade = 24;
		$faltas = "0";
		$nota = "6";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 8, disciplina 7, 1º bimestre (aula, prova e trabalho)
		// idDiario 43
		$idConteudo = 7;
		$idMatricula = 15;
		$idAtividade = 7;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 44
		$idConteudo = 7;
		$idMatricula = 15;
		$idAtividade = 15;
		$faltas = "0";
		$nota = "6";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 45
		$idConteudo = 7;
		$idMatricula = 15;
		$idAtividade = 23;
		$faltas = "0";
		$nota = "10";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 8, disciplina 8, 1º bimestre (aula, prova e trabalho)
		// idDiario 46
		$idConteudo = 8;
		$idMatricula = 16;
		$idAtividade = 8;
		$faltas = "0";
		$nota = "2";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 47
		$idConteudo = 8;
		$idMatricula = 16;
		$idAtividade = 16;
		$faltas = "0";
		$nota = "7";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 48
		$idConteudo = 8;
		$idMatricula = 16;
		$idAtividade = 24;
		$faltas = "0";
		$nota = "6";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		//
		//
		// Aluno 1, disciplina 1, 2º bimestre (aula, prova e trabalho)
		// idDiario 49
		$idConteudo = 9;
		$idMatricula = 1;
		$idAtividade = 25;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 50
		$idConteudo = 9;
		$idMatricula = 1;
		$idAtividade = 33;
		$faltas = "0";
		$nota = "14";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 51
		$idConteudo = 9;
		$idMatricula = 1;
		$idAtividade = 41;
		$faltas = "0";
		$nota = "7";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 1, disciplina 2, 2º bimestre (aula, prova e trabalho)
		// idDiario 52
		$idConteudo = 10;
		$idMatricula = 2;
		$idAtividade = 26;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 53
		$idConteudo = 10;
		$idMatricula = 2;
		$idAtividade = 34;
		$faltas = "0";
		$nota = "12";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 54
		$idConteudo = 10;
		$idMatricula = 2;
		$idAtividade = 42;
		$faltas = "0";
		$nota = "12";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 2, disciplina 1, 2º bimestre (aula, prova e trabalho)
		// idDiario 55
		$idConteudo = 9;
		$idMatricula = 3;
		$idAtividade = 25;
		$faltas = "1";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 56
		$idConteudo = 9;
		$idMatricula = 3;
		$idAtividade = 33;
		$faltas = "0";
		$nota = "11";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 57
		$idConteudo = 9;
		$idMatricula = 3;
		$idAtividade = 41;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 2, disciplina 2, 2º bimestre (aula, prova e trabalho)
		// idDiario 58
		$idConteudo = 10;
		$idMatricula = 4;
		$idAtividade = 26;
		$faltas = "2";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 59
		$idConteudo = 10;
		$idMatricula = 4;
		$idAtividade = 34;
		$faltas = "0";
		$nota = "12";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 60
		$idConteudo = 10;
		$idMatricula = 4;
		$idAtividade = 42;
		$faltas = "0";
		$nota = "12";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 3, disciplina 3, 2º semestre (aula, prova e trabalho)
		// idDiario 61
		$idConteudo = 11;
		$idMatricula = 5;
		$idAtividade = 27;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 62
		$idConteudo = 11;
		$idMatricula = 5;
		$idAtividade = 35;
		$faltas = "0";
		$nota = "40";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 63
		$idConteudo = 11;
		$idMatricula = 5;
		$idAtividade = 43;
		$faltas = "0";
		$nota = "30";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 3, disciplina 4, 2º semestre (aula, prova e trabalho)
		// idDiario 64
		$idConteudo = 12;
		$idMatricula = 6;
		$idAtividade = 28;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 65
		$idConteudo = 12;
		$idMatricula = 6;
		$idAtividade = 36;
		$faltas = "0";
		$nota = "10";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 66
		$idConteudo = 12;
		$idMatricula = 6;
		$idAtividade = 44;
		$faltas = "0";
		$nota = "41";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 4, disciplina 3, 2º semestre (aula, prova e trabalho)
		// idDiario 67
		$idConteudo = 11;
		$idMatricula = 7;
		$idAtividade = 27;
		$faltas = "2";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 68
		$idConteudo = 11;
		$idMatricula = 7;
		$idAtividade = 35;
		$faltas = "0";
		$nota = "44";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 69
		$idConteudo = 11;
		$idMatricula = 7;
		$idAtividade = 43;
		$faltas = "0";
		$nota = "46";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 4, disciplina 4, 2º semestre (aula, prova e trabalho)
		// idDiario 70
		$idConteudo = 12;
		$idMatricula = 8;
		$idAtividade = 28;
		$faltas = "3";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 71
		$idConteudo = 12;
		$idMatricula = 8;
		$idAtividade = 36;
		$faltas = "0";
		$nota = "31";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 72
		$idConteudo = 12;
		$idMatricula = 8;
		$idAtividade = 44;
		$faltas = "0";
		$nota = "20";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 5, disciplina 5, 2º bimestre (aula, prova e trabalho)
		// idDiario 73
		$idConteudo = 13;
		$idMatricula = 9;
		$idAtividade = 29;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 74
		$idConteudo = 13;
		$idMatricula = 9;
		$idAtividade = 37;
		$faltas = "0";
		$nota = "9";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 75
		$idConteudo = 13;
		$idMatricula = 9;
		$idAtividade = 45;
		$faltas = "0";
		$nota = "15";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 5, disciplina 6, 2º bimestre (aula, prova e trabalho)
		// idDiario 76
		$idConteudo = 14;
		$idMatricula = 10;
		$idAtividade = 30;
		$faltas = "1";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 77
		$idConteudo = 14;
		$idMatricula = 10;
		$idAtividade = 38;
		$faltas = "0";
		$nota = "13";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 78
		$idConteudo = 14;
		$idMatricula = 10;
		$idAtividade = 46;
		$faltas = "0";
		$nota = "10";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 6, disciplina 5, 2º bimestre (aula, prova e trabalho)
		// idDiario 79
		$idConteudo = 13;
		$idMatricula = 11;
		$idAtividade = 37;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 80
		$idConteudo = 13;
		$idMatricula = 11;
		$idAtividade = 37;
		$faltas = "0";
		$nota = "12";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 81
		$idConteudo = 13;
		$idMatricula = 11;
		$idAtividade = 45;
		$faltas = "0";
		$nota = "11";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 6, disciplina 6, 2º bimestre (aula, prova e trabalho)
		// idDiario 82
		$idConteudo = 14;
		$idMatricula = 12;
		$idAtividade = 30;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 83
		$idConteudo = 14;
		$idMatricula = 12;
		$idAtividade = 38;
		$faltas = "0";
		$nota = "4";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 84
		$idConteudo = 14;
		$idMatricula = 12;
		$idAtividade = 46;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 7, disciplina 7, 2º bimestre (aula, prova e trabalho)
		// idDiario 85
		$idConteudo = 15;
		$idMatricula = 13;
		$idAtividade = 31;
		$faltas = "2";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 86
		$idConteudo = 15;
		$idMatricula = 13;
		$idAtividade = 39;
		$faltas = "0";
		$nota = "3";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 87
		$idConteudo = 15;
		$idMatricula = 13;
		$idAtividade = 47;
		$faltas = "0";
		$nota = "2";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 7, disciplina 8, 2º bimestre (aula, prova e trabalho)
		// idDiario 88
		$idConteudo = 16;
		$idMatricula = 14;
		$idAtividade = 32;
		$faltas = "1";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 89
		$idConteudo = 16;
		$idMatricula = 14;
		$idAtividade = 40;
		$faltas = "0";
		$nota = "7";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 90
		$idConteudo = 16;
		$idMatricula = 14;
		$idAtividade = 48;
		$faltas = "0";
		$nota = "5";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 8, disciplina 7, 2º bimestre (aula, prova e trabalho)
		// idDiario 91
		$idConteudo = 15;
		$idMatricula = 15;
		$idAtividade = 31;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 92
		$idConteudo = 15;
		$idMatricula = 15;
		$idAtividade = 39;
		$faltas = "0";
		$nota = "9";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 93
		$idConteudo = 15;
		$idMatricula = 15;
		$idAtividade = 47;
		$faltas = "0";
		$nota = "10";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 8, disciplina 8, 2º bimestre (aula, prova e trabalho)
		// idDiario 94
		$idConteudo = 16;
		$idMatricula = 16;
		$idAtividade = 32;
		$faltas = "0";
		$nota = "2";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 95
		$idConteudo = 16;
		$idMatricula = 16;
		$idAtividade = 40;
		$faltas = "0";
		$nota = "4";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 96
		$idConteudo = 16;
		$idMatricula = 16;
		$idAtividade = 48;
		$faltas = "0";
		$nota = "7";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		//
		//
		// Aluno 1, disciplina 1, 3º bimestre (aula, prova e trabalho)
		// idDiario 97
		$idConteudo = 17;
		$idMatricula = 1;
		$idAtividade = 49;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 98
		$idConteudo = 17;
		$idMatricula = 1;
		$idAtividade = 55;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 99
		$idConteudo = 17;
		$idMatricula = 1;
		$idAtividade = 61;
		$faltas = "0";
		$nota = "9";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 1, disciplina 2, 3º bimestre (aula, prova e trabalho)
		// idDiario 100
		$idConteudo = 18;
		$idMatricula = 2;
		$idAtividade = 50;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 101
		$idConteudo = 18;
		$idMatricula = 2;
		$idAtividade = 56;
		$faltas = "0";
		$nota = "2";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 102
		$idConteudo = 18;
		$idMatricula = 2;
		$idAtividade = 62;
		$faltas = "0";
		$nota = "10";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 2, disciplina 1, 3º bimestre (aula, prova e trabalho)
		// idDiario 103
		$idConteudo = 17;
		$idMatricula = 3;
		$idAtividade = 49;
		$faltas = "2";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 104
		$idConteudo = 17;
		$idMatricula = 3;
		$idAtividade = 55;
		$faltas = "0";
		$nota = "7";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 105
		$idConteudo = 17;
		$idMatricula = 3;
		$idAtividade = 61;
		$faltas = "0";
		$nota = "3";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 2, disciplina 2, 3º bimestre (aula, prova e trabalho)
		// idDiario 106
		$idConteudo = 18;
		$idMatricula = 4;
		$idAtividade = 50;
		$faltas = "2";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 107
		$idConteudo = 18;
		$idMatricula = 4;
		$idAtividade = 56;
		$faltas = "0";
		$nota = "4";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 108
		$idConteudo = 18;
		$idMatricula = 4;
		$idAtividade = 62;
		$faltas = "0";
		$nota = "2";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 5, disciplina 5, 3º bimestre (aula, prova e trabalho)
		// idDiario 109
		$idConteudo = 19;
		$idMatricula = 9;
		$idAtividade = 51;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 110
		$idConteudo = 19;
		$idMatricula = 9;
		$idAtividade = 57;
		$faltas = "0";
		$nota = "6";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 111
		$idConteudo = 19;
		$idMatricula = 9;
		$idAtividade = 63;
		$faltas = "0";
		$nota = "10";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 5, disciplina 6, 3º bimestre (aula, prova e trabalho)
		// idDiario 112
		$idConteudo = 20;
		$idMatricula = 10;
		$idAtividade = 52;
		$faltas = "1";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 113
		$idConteudo = 20;
		$idMatricula = 10;
		$idAtividade = 58;
		$faltas = "0";
		$nota = "4";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 114
		$idConteudo = 20;
		$idMatricula = 10;
		$idAtividade = 64;
		$faltas = "0";
		$nota = "7";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 6, disciplina 5, 3º bimestre (aula, prova e trabalho)
		// idDiario 115
		$idConteudo = 19;
		$idMatricula = 11;
		$idAtividade = 51;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 116
		$idConteudo = 19;
		$idMatricula = 11;
		$idAtividade = 57;
		$faltas = "0";
		$nota = "6";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 117
		$idConteudo = 19;
		$idMatricula = 11;
		$idAtividade = 63;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 6, disciplina 6, 3º bimestre (aula, prova e trabalho)
		// idDiario 118
		$idConteudo = 20;
		$idMatricula = 12;
		$idAtividade = 52;
		$faltas = "2";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 119
		$idConteudo = 20;
		$idMatricula = 12;
		$idAtividade = 58;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 120
		$idConteudo = 20;
		$idMatricula = 12;
		$idAtividade = 64;
		$faltas = "0";
		$nota = "7";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 7, disciplina 7, 3º bimestre (aula, prova e trabalho)
		// idDiario 121
		$idConteudo = 21;
		$idMatricula = 13;
		$idAtividade = 53;
		$faltas = "2";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 122
		$idConteudo = 21;
		$idMatricula = 13;
		$idAtividade = 59;
		$faltas = "0";
		$nota = "5";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 123
		$idConteudo = 21;
		$idMatricula = 13;
		$idAtividade = 65;
		$faltas = "0";
		$nota = "9";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 7, disciplina 8, 3º bimestre (aula, prova e trabalho)
		// idDiario 124
		$idConteudo = 22;
		$idMatricula = 14;
		$idAtividade = 54;
		$faltas = "1";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 125
		$idConteudo = 22;
		$idMatricula = 14;
		$idAtividade = 60;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 126
		$idConteudo = 22;
		$idMatricula = 14;
		$idAtividade = 66;
		$faltas = "0";
		$nota = "6";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 8, disciplina 7, 3º bimestre (aula, prova e trabalho)
		// idDiario 127
		$idConteudo = 21;
		$idMatricula = 15;
		$idAtividade = 53;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 128
		$idConteudo = 21;
		$idMatricula = 15;
		$idAtividade = 59;
		$faltas = "0";
		$nota = "9";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 129
		$idConteudo = 21;
		$idMatricula = 15;
		$idAtividade = 65;
		$faltas = "0";
		$nota = "7";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 8, disciplina 8, 3º bimestre (aula, prova e trabalho)
		// idDiario 130
		$idConteudo = 22;
		$idMatricula = 16;
		$idAtividade = 54;
		$faltas = "0";
		$nota = "2";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 131
		$idConteudo = 22;
		$idMatricula = 16;
		$idAtividade = 60;
		$faltas = "0";
		$nota = "5";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 132
		$idConteudo = 22;
		$idMatricula = 16;
		$idAtividade = 6;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		//
		//
		// Aluno 1, disciplina 1, 4º bimestre (aula, prova e trabalho)
		// idDiario 133
		$idConteudo = 23;
		$idMatricula = 1;
		$idAtividade = 67;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 134
		$idConteudo = 23;
		$idMatricula = 1;
		$idAtividade = 73;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 135
		$idConteudo = 23;
		$idMatricula = 1;
		$idAtividade = 79;
		$faltas = "0";
		$nota = "11";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 1, disciplina 2, 4º bimestre (aula, prova e trabalho)
		// idDiario 136
		$idConteudo = 24;
		$idMatricula = 2;
		$idAtividade = 68;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 137
		$idConteudo = 24;
		$idMatricula = 2;
		$idAtividade = 74;
		$faltas = "0";
		$nota = "12";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 138
		$idConteudo = 24;
		$idMatricula = 2;
		$idAtividade = 80;
		$faltas = "0";
		$nota = "11";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 2, disciplina 1, 4º bimestre (aula, prova e trabalho)
		// idDiario 139
		$idConteudo = 23;
		$idMatricula = 3;
		$idAtividade = 67;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 140
		$idConteudo = 23;
		$idMatricula = 3;
		$idAtividade = 73;
		$faltas = "0";
		$nota = "9";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 141
		$idConteudo = 23;
		$idMatricula = 3;
		$idAtividade = 79;
		$faltas = "0";
		$nota = "13";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 2, disciplina 2, 4º bimestre (aula, prova e trabalho)
		// idDiario 142
		$idConteudo = 24;
		$idMatricula = 4;
		$idAtividade = 68;
		$faltas = "1";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 143
		$idConteudo = 24;
		$idMatricula = 4;
		$idAtividade = 74;
		$faltas = "0";
		$nota = "14";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 144
		$idConteudo = 24;
		$idMatricula = 4;
		$idAtividade = 80;
		$faltas = "0";
		$nota = "12";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 5, disciplina 5, 4º bimestre (aula, prova e trabalho)
		// idDiario 145
		$idConteudo = 25;
		$idMatricula = 9;
		$idAtividade = 69;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 146
		$idConteudo = 25;
		$idMatricula = 9;
		$idAtividade = 75;
		$faltas = "0";
		$nota = "6";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 147
		$idConteudo = 25;
		$idMatricula = 9;
		$idAtividade = 81;
		$faltas = "0";
		$nota = "12";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 5, disciplina 6, 4º bimestre (aula, prova e trabalho)
		// idDiario 148
		$idConteudo = 26;
		$idMatricula = 10;
		$idAtividade = 70;
		$faltas = "1";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 149
		$idConteudo = 26;
		$idMatricula = 10;
		$idAtividade = 76;
		$faltas = "0";
		$nota = "10";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 150
		$idConteudo = 26;
		$idMatricula = 10;
		$idAtividade = 82;
		$faltas = "0";
		$nota = "9";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 6, disciplina 5, 4º bimestre (aula, prova e trabalho)
		// idDiario 151
		$idConteudo = 25;
		$idMatricula = 11;
		$idAtividade = 69;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 152
		$idConteudo = 25;
		$idMatricula = 11;
		$idAtividade = 75;
		$faltas = "0";
		$nota = "10";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 153
		$idConteudo = 25;
		$idMatricula = 11;
		$idAtividade = 81;
		$faltas = "0";
		$nota = "7";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 6, disciplina 6, 4º bimestre (aula, prova e trabalho)
		// idDiario 154
		$idConteudo = 26;
		$idMatricula = 12;
		$idAtividade = 70;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 155
		$idConteudo = 26;
		$idMatricula = 12;
		$idAtividade = 76;
		$faltas = "0";
		$nota = "9";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 156
		$idConteudo = 26;
		$idMatricula = 12;
		$idAtividade = 82;
		$faltas = "0";
		$nota = "12";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 7, disciplina 7, 4º bimestre (aula, prova e trabalho)
		// idDiario 157
		$idConteudo = 27;
		$idMatricula = 13;
		$idAtividade = 71;
		$faltas = "2";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 158
		$idConteudo = 27;
		$idMatricula = 13;
		$idAtividade = 77;
		$faltas = "0";
		$nota = "15";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 159
		$idConteudo = 27;
		$idMatricula = 13;
		$idAtividade = 83;
		$faltas = "0";
		$nota = "10";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 7, disciplina 8, 4º bimestre (aula, prova e trabalho)
		// idDiario 160
		$idConteudo = 28;
		$idMatricula = 14;
		$idAtividade = 72;
		$faltas = "1";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 161
		$idConteudo = 28;
		$idMatricula = 14;
		$idAtividade = 78;
		$faltas = "0";
		$nota = "14";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 162
		$idConteudo = 28;
		$idMatricula = 14;
		$idAtividade = 84;
		$faltas = "0";
		$nota = "13";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 8, disciplina 7, 4º bimestre (aula, prova e trabalho)
		// idDiario 163
		$idConteudo = 27;
		$idMatricula = 15;
		$idAtividade = 71;
		$faltas = "0";
		$nota = "0";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 164
		$idConteudo = 27;
		$idMatricula = 15;
		$idAtividade = 77;
		$faltas = "0";
		$nota = "11";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 165
		$idConteudo = 27;
		$idMatricula = 15;
		$idAtividade = 83;
		$faltas = "0";
		$nota = "9";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();

		// Aluno 8, disciplina 8, 3º bimestre (aula, prova e trabalho)
		// idDiario 166
		$idConteudo = 28;
		$idMatricula = 16;
		$idAtividade = 72;
		$faltas = "2";
		$nota = "2";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 167
		$idConteudo = 28;
		$idMatricula = 16;
		$idAtividade = 78;
		$faltas = "0";
		$nota = "8";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
		// idDiario 168
		$idConteudo = 28;
		$idMatricula = 16;
		$idAtividade = 84;
		$faltas = "0";
		$nota = "13";
		$ano = "2017";
		$ativo = "S";
		$stmt -> execute();
	####################################################


	//
	// CÓDIGO PARA INSERÇÃO NAS TABELAS DO SISTEMA DE BIBLIOTECA
	//
	// INSERINDO NA TABELA ACERVO
	//
	// preparando os parâmetros
	$stmt = $conexao -> prepare (
			"INSERT INTO acervo
				(idCampi, nome, tipo, local, ano, editora, paginas, ativo) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
			);
	// parâmetro não específico, para depois setar os valores e executar o query de inserção
	$stmt -> bind_param (
				"isssssss", 
				$idCampi, $nome, $tipo, $local, $ano, $editora, $paginas, $ativo
			 );
	// preparando os valores e executando
	####################################################
		// idAcervo 1
		$idCampi = 1;
		$nome = "Dom Casmurro";
		$tipo = "Livro";
		$local = "Brasil";
		$ano = "2003";
		$editora = "Martin Claret";
		$paginas = "223";
		$ativo = "S";
		$stmt -> execute();

		// idAcervo 2
		$idCampi = 1;
		$nome = "O Cortiço";
		$tipo = "Livro";
		$local = "Brasil";
		$ano = "2016";
		$editora = "Nova Fronteira";
		$paginas = "272";
		$ativo = "S";
		$stmt -> execute();

		// idAcervo 3
		$idCampi = 1;
		$nome = "Inteligência Artificial em Jogos Digitais";
		$tipo = "Acadêmico";
		$local = "Campinas, SP, Brasil";
		$ano = "2007";
		$editora = "";
		$paginas = "25";
		$ativo = "S";
		$stmt -> execute();

		// idAcervo 4
		$idCampi = 1;
		$nome = "O Futuro da Robótica";
		$tipo = "Acadêmico";
		$local = "Brasil";
		$ano = "2014";
		$editora = "";
		$paginas = "8";
		$ativo = "S";
		$stmt -> execute();

		// idAcervo 5
		$idCampi = 1;
		$nome = "300";
		$tipo = "Mídia";
		$local = "Estados Unidos";
		$ano = "2006";
		$editora = "";
		$paginas = "";
		$ativo = "S";
		$stmt -> execute();

		// idAcervo 6
		$idCampi = 1;
		$nome = "I like it when you sleep";
		$tipo = "Mídia";
		$local = "Estados Unidos";
		$ano = "2016";
		$editora = "";
		$paginas = "";
		$ativo = "S";
		$stmt -> execute();

		// idAcervo 7
		$idCampi = 1;
		$nome = "Superinteressante";
		$tipo = "Periódico";
		$local = "Brasil";
		$ano = "2006";
		$editora = "Abril";
		$paginas = "93";
		$ativo = "S";
		$stmt -> execute();

		// idAcervo 8
		$idCampi = 1;
		$nome = "SQL Magazine";
		$tipo = "Periódico";
		$local = "Brasil";
		$ano = "2010";
		$editora = "DevMedia";
		$paginas = "70";
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	// INSERINDO NA TABELA LIVROS
	//
	$stmt = $conexao -> prepare (
			"INSERT INTO livros
				(idAcervo, ISBN, edicao, ativo)
				VALUES (?, ?, ?, ?)"
			);
	
	$stmt -> bind_param (
				"isss", 
				$idAcervo, $ISBN, $edicao, $ativo
			 );

	####################################################
		// Livro 1 - Dom Casmurro
		$idAcervo = 1;
		$ISBN = "8572322647";
		$edicao = "1";
		$ativo = "S";
		$stmt -> execute();

		// Livro 2 - O Cortiço
		$idAcervo = 2;
		$ISBN = "9788520927823";
		$edicao = "1";
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	// INSERINDO NA TABELA ACADEMICOS
	//
	$stmt = $conexao -> prepare (
			"INSERT INTO academicos
				(idAcervo, programa, ativo) 
				VALUES (?, ?, ?)"
			);
	
	$stmt -> bind_param (
				"iss", 
				$idAcervo, $programa, $ativo
			 );

	####################################################
		// idAcademicos 1
		$idAcervo = 3;
		$programa = "Bacharelado";
		$ativo = "S";
		$stmt -> execute();

		// idAcademicos 2
		$idAcervo = 4;
		$programa = "Artigo Científico";
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	// INSERINDO NA TABELA MIDIAS
	//
	$stmt = $conexao -> prepare (
			"INSERT INTO midias
				(idAcervo, tempo, subtipo, ativo) 
				VALUES (?, ?, ?, ?)"
			);
	
	$stmt -> bind_param (
				"isss", 
				$idAcervo, $tempo, $subtipo, $ativo
			 );

	####################################################
		// idMidia 1
		$idAcervo = 5;
		$tempo = "117";
		$subtipo = "DVD";
		$ativo = "S";
		$stmt -> execute();

		// idMidia 2
		$idAcervo = 6;
		$tempo = "74";
		$subtipo = "CD";
		$ativo = "S";
		$stmt -> execute();
	####################################################
	
	//
	// INSERINDO NA TABELA PERIODICOS
	//
	$stmt = $conexao -> prepare (
			"INSERT INTO periodicos
				(idAcervo, periodicidade, mes, volume, subtipo, ISSN, ativo) 
				VALUES (?, ?, ?, ?, ?, ?, ?)"
			);
	
	$stmt -> bind_param (
				"issssss", 
				$idAcervo, $periodicidade, $mes, $volume, $subtipo, $ISSN, $ativo
			 );

	####################################################
		// idPeriodico 1
		$idAcervo = 7;
		$periodicidade = "Mensal";
		$mes = "Julho";
		$volume = "228";
		$subtipo = "Revista";
		$ISSN = "01041789";
		$ativo = "S";
		$stmt -> execute();

		// idPeriodico 2
		$idAcervo = 8;
		$periodicidade = "Mensal";
		$mes = "Outubro";
		$volume = "88";
		$subtipo = "Revista";
		$ISSN = "16779185";
		$ativo = "S";
		$stmt -> execute();
	####################################################
	
	//
	// INSERINDO NA TABELA PARTES
	//
	$stmt = $conexao -> prepare (
			"INSERT INTO partes
				(idPeriodico, titulo, pagInicio, pagFinal, palavrasChave, ativo) 
				VALUES (?, ?, ?, ?, ?, ?)"
			);
	
	$stmt -> bind_param (
				"isssss", 
				$idPeriodico, $titulo, $pagInicio, $pagFinal, $palavrasChave, $ativo
			 );

	####################################################
		// Periódico 1
		// idParte 1
		$idPeriodico = 1;
		$titulo = "Superpapo";
		$pagInicio = "14";
		$pagFinal = "17";
		$palavrasChave = "Indústria farmacêutica";
		$ativo = "S";
		$stmt -> execute();
		// idParte 2
		$idPeriodico = 1;
		$titulo = "Supernovas";
		$pagInicio = "18";
		$pagFinal = "27";
		$palavrasChave = "mamífero, pré-história, energia, hospital, militar, nuclear";
		$ativo = "S";
		$stmt -> execute();
		// idParte 3
		$idPeriodico = 1;
		$titulo = "Superrespostas";
		$pagInicio = "28";
		$pagFinal = "83";
		$palavrasChave = "Brasil, universo, bomba, Einstein, internet";
		$ativo = "S";
		$stmt -> execute();

		// Periódico 2
		// idParte 4
		$idPeriodico = 2;
		$titulo = "Modelagem de Dados";
		$pagInicio = "6";
		$pagFinal = "14";
		$palavrasChave = "modelagem, banco de dados, MySQL";
		$ativo = "S";
		$stmt -> execute();
		// idParte 5
		$idPeriodico = 2;
		$titulo = "Dia a Dia";
		$pagInicio = "15";
		$pagFinal = "24";
		$palavrasChave = "benchmark, MySQL, Linux, Windows";
		$ativo = "S";
		$stmt -> execute();
		// idParte 6
		$idPeriodico = 2;
		$titulo = "Expert";
		$pagInicio = "25";
		$pagFinal = "32";
		$palavrasChave = "práticas, Oracle, RAC";
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	// INSERINDO NA TABELA AUTORACERVO
	//
	$stmt = $conexao -> prepare (
			"INSERT INTO autorAcervo
				(idAcervo, idAutor, ativo) 
				VALUES (?, ?, ?)"
			);
	
	$stmt -> bind_param (
				"iis", 
				$idAcervo, $idAutor, $ativo
			 );

	####################################################
		// idAutorAcervo 1
		$idAcervo = 1;
		$idAutor = 1;
		$ativo = "S";
		$stmt -> execute();

		// idAutorAcervo 2
		$idAcervo = 2;
		$idAutor = 2;
		$ativo = "S";
		$stmt -> execute();

		// idAutorAcervo 3
		$idAcervo = 3;
		$idAutor = 3;
		$ativo = "S";
		$stmt -> execute();
		// idAutorAcervo 4
		$idAcervo = 3;
		$idAutor = 4;
		$ativo = "S";
		$stmt -> execute();
		// idAutorAcervo 5
		$idAcervo = 3;
		$idAutor = 5;
		$ativo = "S";
		$stmt -> execute();
		// idAutorAcervo 6
		$idAcervo = 3;
		$idAutor = 6;
		$ativo = "S";
		$stmt -> execute();

		// idAutorAcervo 7
		$idAcervo = 4;
		$idAutor = 7;
		$ativo = "S";
		$stmt -> execute();
		// idAutorAcervo 8
		$idAcervo = 4;
		$idAutor = 8;
		$ativo = "S";
		$stmt -> execute();

		// idAutorAcervo 9
		$idAcervo = 5;
		$idAutor = 9;
		$ativo = "S";
		$stmt -> execute();

		// idAutorAcervo 10
		$idAcervo = 6;
		$idAutor = 10;
		$ativo = "S";
		$stmt -> execute();
	####################################################

	//
	// INSERINDO NA TABELA AUTORES
	//

	$stmt = $conexao -> prepare (
			"INSERT INTO autores
				(nome, sobrenome, ordem, qualificacao, ativo) 
				VALUES (?, ?, ?, ?, ?)"
			);
	
	$stmt -> bind_param (
				"sssss",
				$nome, $sobrenome, $ordem, $qualificacao, $ativo
			 );
	####################################################
		// idAutor 1 - Machado de Assis
		$nome = "Machado";
		$sobrenome = "de Assis";
		$ordem = "1a";
		$qualificacao = "Doutor";
		$ativo = "S";
		$stmt -> execute();

		// idAutor 2 - Aluísio Azevedo 
		$nome = "Aluísio";
		$sobrenome = "Azevedo";
		$ordem = "1a";
		$qualificacao = "Doutor";
		$ativo = "S";
		$stmt -> execute();

		// idAutor 3 - acadêmico 1
		$nome = "Bruno";
		$sobrenome = "Ribeiro";
		$ordem = "1a";
		$qualificacao = "Bacharel";
		$ativo = "S";
		$stmt -> execute();
		// idAutor 4 - acadêmico 1
		$nome = "Fabiano";
		$sobrenome = "Lucchese";
		$ordem = "2a";
		$qualificacao = "Bacharel";
		$ativo = "S";
		$stmt -> execute();
		// idAutor 5 - acadêmico 1
		$nome = "Maycon";
		$sobrenome = "Rocha";
		$ordem = "3a";
		$qualificacao = "Bacharel";
		$ativo = "S";
		$stmt -> execute();
		// idAutor 6 - acadêmico 1
		$nome = "Vera";
		$sobrenome = "Figueiredo";
		$ordem = "4a";
		$qualificacao = "Bacharel";
		$ativo = "S";
		$stmt -> execute();

		// idAutor 7 - acadêmico 2
		$nome = "Roberto";
		$sobrenome = "Valério";
		$ordem = "1a";
		$qualificacao = "Pós-Graduado";
		$ativo = "S";
		$stmt -> execute();
		// idAutor 8 - acadêmico 2
		$nome = "Marcus";
		$sobrenome = "Valério Rocha Garcia";
		$ordem = "2a";
		$qualificacao = "Mestre";
		$ativo = "S";
		$stmt -> execute();

		// idAutor 9 - mídia 1
		$nome = "Zack";
		$sobrenome = "Snyder";
		$ordem = "1a";
		$qualificacao = "Diretor de cinema";
		$ativo = "S";
		$stmt -> execute();

		// idAutor 10 - mídia 2
		$nome = "The 1975";
		$sobrenome = "";
		$ordem = "1a";
		$qualificacao = "Banda";
		$ativo = "S";
		$stmt -> execute();
	####################################################
/*
	//
	// INSERINDO NA TABELA RESERVAS
	//
	$stmt = $conexao -> prepare (
			"INSERT INTO reservas
				(idAluno, idAcervo, dataReserva,tempoEspera, emprestou, ativo) 
				VALUES (?, ?, ?, ?, ?, ?)"
			);
	
	$stmt -> bind_param (
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
		$stmt -> execute();
	####################################################

	//
	// INSERINDO NA TABELA EMPRESTIMOS
	//
	$stmt = $conexao -> prepare (
			"INSERT INTO emprestimos
				(idAluno, idAcervo, dataEmprestimo, dataPrevisaoDevolucao, dataDevolucao, multa, ativo) 
				VALUES (?, ?, ?, ?, ?, ?, ?)"
			);
	
	// pode dar problema!!
	$stmt -> bind_param (
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
		$stmt -> execute();
	####################################################

	//
	// INSERINDO NA TABELA DESCARTES
	//
	$stmt = $conexao -> prepare (
			"INSERT INTO descartes
				(idAcervo, idFuncionario, dataDescarte, motivos, ativo) 
				VALUES (?, ?, ?, ?, ?)"
			);
	
	$stmt -> bind_param (
				"issss", 
				$idAcervo, $idFuncionario, $dataDescarte, $motivos, $ativo
			 );

	####################################################
		$idAcervo = ;
		$idFuncionario = ;
		$dataDescarte = ;
		$motivos = ;
		$ativo = ;
		$stmt -> execute();
	####################################################
*/


###############################################################################################

	// FECHANDO A CONEXÃO
	//mysqli_close($conexao);

?>
