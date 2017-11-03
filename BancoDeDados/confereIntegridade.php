<?php
###############################################################################################
	header("Content-type: text/html; charset=utf-8");

	$servername = "localhost";
	$username = "root";
	$password = "usbw";
	$bd = "educatio";

	$conn = new mysqli($servername, $username, $password, $bd);
	
	mysqli_set_charset($conn, "utf8");
	
	// TESTANDO A CONEXÃO
	if ($conn -> connect_error) 
	{
	    die("Conexão falhou: " . $conn -> connect_error);
	}
	echo "<b>"."Conexão bem sucedida"."</b>".
		 "<br><br>";

###############################################################################################

	$stringRelatorioErros = "";

	$arrayTabelas = array('campi', 'deptos', 'cursos', 'turmas' , 
						  'alunos', 'matriculas', 'funcionario', 'disciplinas', 
						  'profDisciplinas', 'etapas', 'atividades', 'conteudos', 
						  'diarios', 'acervo', 'livros', 'academicos', 
						  'midias', 'periodicos', 'partes', 'autorAcervo', 
						  'autores', 'reservas', 'emprestimos', 'descartes');

	$arrayNomesTabelas = array('Campus', 'Departamento', 'Curso', 'Turmas' , 
						  'Aluno', 'Matrícula', 'Funcionário', 'Disciplina', 
						  'ProfDisciplina', 'Etapa', 'Atividade', 'Conteúdo', 
						  'Diário', 'Obra', 'Livro', 'Acadêmico', 
						  'Midia', 'Periódico', 'Parte', 'AutorAcervo', 
						  'Autor', 'Reserva', 'Empréstimo', 'Descarte');

	$houveErro = false;

	//CONFERINDO A INTEGRIDADE
	function conferidorDeIntegridade($tabelaMae,$tabelaFilho,$opc)
	{
		global $conn, $stringRelatorioErros, $arrayTabelas, $arrayNomesTabelas;

		$GLOBALS['houveErro'] = false;

		$sqlMae = "SELECT * FROM `{$arrayTabelas[$tabelaMae]}` WHERE ativo = 'S'";
		$rstMae = $conn -> query($sqlMae);

		if($rstMae -> num_rows > 0)
		{
			while($linhaAtual = $rstMae -> fetch_array(MYSQLI_BOTH))
			{
				//echo "<br>".$opc;
				$stmtFilho = $conn -> prepare("SELECT * FROM `{$arrayTabelas[$tabelaFilho]}` WHERE ativo = ? AND $opc = ?");
				$stmtFilho -> bind_param('si', $param1, $param2);

				$param1 = 'S';
				$param2 = $linhaAtual[0];
				
				$stmtFilho -> execute();

				$rstFilho = $stmtFilho -> get_result();

				if($rstFilho -> num_rows == 0)
				{
					$stringRelatorioErros .= $arrayNomesTabelas[$tabelaMae]." com id = ".$linhaAtual[0]." não possui nenhum(a) ".$arrayNomesTabelas[$tabelaFilho].".<br>";
					$GLOBALS['houveErro'] = true;
				}
			}
		}
		if($GLOBALS['houveErro'] == true)
		{
			$stringRelatorioErros .= "<br>";	
		}		
	}

###############################################################################################
	//CONFERINDO A INTEGRIDADE DAS TABELAS DA PARTE DE ACADÊMICOS
	/*
	'Campus', 0
	'Departamento', 1
	'Curso', 2
	'Turmas' , 3
	'Aluno', 4
	'Matricula', 5
	'Funcionario', 6
	'Disciplina', 7
	'ProfDisciplina', 8
	'Etapa', 9
	'Atividade', 10
	'Conteudo', 11
	'Diario', 12
	*/

	//Conferindo integridade de Campi (0)
	conferidorDeIntegridade(0,1,'idCampi');

	//Conferindo integridade de Departamentos (1)
	conferidorDeIntegridade(1,2,'idDepto');

	//Conferindo integridade de Cursos (2)
	conferidorDeIntegridade(2,3,'idCurso');

	//Conferindo integridade de Turmas (3)
	conferidorDeIntegridade(3,4,'idTurma');

	//Conferindo integridade de Alunos (4)
	conferidorDeIntegridade(4,5,'idAluno');
	
	//Conferindo integridade de Matrículas (5)
	conferidorDeIntegridade(5,12,'idMatricula');
	
	//Conferindo integridade de Professores (funcionario.hierarquia='Professor') (6)
	conferidorDeIntegridade(6,8,'idProfessor');
	//Conferindo integridade de Bibliotecários (funcionario.hierarquia='Bibliotecario') (6)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(6,23,'idFuncionario');

	//Conferindo integridade de Disciplinas (7)
	conferidorDeIntegridade(7,5,'idDisciplina');
	conferidorDeIntegridade(7,8,'idDisciplina');
	conferidorDeIntegridade(7,11,'idDisciplina');


	//Conferindo integridade de ProfDiscplinas (8)
	conferidorDeIntegridade(8,10,'idProfDisciplina');

	//Conferindo integridade de Etapas (9)
	conferidorDeIntegridade(9,11,'idEtapa');

	//Conferindo integridade de Atividades (10)
	conferidorDeIntegridade(10,12,'idAtividade');

	//Conferindo integridade de Conteúdos (11)
	conferidorDeIntegridade(11,12,'idConteudo');

	//Conferindo integridade de Diários (12)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(12,5,'idTurma');


	
	//CONFERINDO A INTEGRIDADE DAS TABELAS DA PARTE DE BIBLIOTECA
	/*
	'Obra', 13
	'Livro', 14
	'Acadêmico', 15 
	'Midia', 16
	'Periodico', 17
	'Parte', 18
	'AutorAcervo', 19
	'Autor', 20
	'Reserva', 21
	'Emprestimo', 22
	'Descarte' 23
	*/

	//Conferindo integridade de Acervo (13)
	conferidorDeIntegridade(13,19,'idAcervo');
	/*
	conferidorDeIntegridade(13,14,'idAcervo');

	if($bibliotecaVazia == true)
	{
		conferidorDeIntegridade(13,15,'idAcervo');

		if($bibliotecaVazia == true)
		{
			conferidorDeIntegridade(13,16,'idAcervo');

			if($bibliotecaVazia == true)
			{
				conferidorDeIntegridade(13,17,'idAcervo');
			}
		}
	}
	*/

	//Conferindo integridade de Livros (14)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(14,12,'idMatricula');

	//Conferindo integridade de Acadêmicos (15)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(15,12,'idMatricula');

	//Conferindo integridade de Mídias (16)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(16,12,'idMatricula');

	//Conferindo integridade de Periódicos (17)
	conferidorDeIntegridade(17,18,'idPeriodico');

	//Conferindo integridade de Partes (18)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(18,12,'idMatricula');

	//Conferindo integridade de AutorAcervo (19)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(19,12,'idMatricula');

	//Conferindo integridade de Autores (20)
	conferidorDeIntegridade(20,19,'idAutor');

	//Conferindo integridade de Reservas (21)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(21,12,'idMatricula');

	//Conferindo integridade de Empréstimos (22)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(22,12,'idMatricula');

	//Conferindo integridade de Descartes (23)
	//Acredito que não há necessidade
	//conferidorDeIntegridade(23,12,'idMatricula');
	
						
	echo $stringRelatorioErros;
?>