<?php
###############################################################################################
	header("Content-type: text/html; charset=utf-8");
	ini_set('max_execution_time', 0); 
	date_default_timezone_set('America/Sao_Paulo');
	################################
	$arq = fopen("dadosAcervo-EmMassa.txt", "r");
    if ($arq)
    {
    	//echo "Arquivo aberto (para leitura) com sucesso!<br>";	
    } 
    $cont = 1;
    While(!feof($arq))
    {
    	$linha = fgets($arq);
	    $dados = explode(";", $linha);
	    if($dados[count($dados) - 2] == 'Acadêmico' && defined('FIM_LIVROS') == false)
	    {
	    	define('FIM_LIVROS', $cont);
	    }
	    elseif($dados[count($dados) - 2] == 'Mídia' && defined('FIM_ACADEMICOS') == false)
	    {
	    	define('FIM_ACADEMICOS', $cont);
	    }
	    elseif($dados[count($dados) - 2] == 'Periódico' && defined('FIM_MIDIAS') == false)
	    {
	    	define('FIM_MIDIAS', $cont);
	    }
	    $cont ++;
    }
    define('FIM_PERIODICOS', $cont);
    $cont --;
    define('NUM_ACERVO', $cont);
    ################################
###############################################################################################
	$servername = "localhost";
	$username = "root";
	$password = "usbw";
	$bd = "educatio";
	$con = new mysqli($servername, $username, $password, $bd);
	
	mysqli_set_charset($con, "utf8");
	
	//TESTANDO A CONEXÃO
	if ($con->connect_error) 
	{
	    die("Conexão falhou: " . $con->connect_error);
	}
	
	echo "<b>".'Conexão bem sucedida'."</b><br>";
###############################################################################################
	//INSERINDO DADOS NAS TABELAS DO BANCO DE DADOS
	
	//INSERÇÃO NAS TABELAS DO SISTEMA DE BIBLIOTECA
	//INSERINDO NA TABELA ACERVO
	$stmt = $con->prepare (
			"INSERT INTO acervo
				(idCampi, nome, tipo, local, ano, editora, paginas, ativo) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
			);
	$stmt->bind_param (
				"isssssss", 
				$idCampi, $nome, $tipo, $local, $ano, $editora, $paginas, $ativo
			 );
	####################################################
	################################
	rewind($arq);
    $arrayEditoras = array('Autêntica Editora','Autores Associados','Betânia','Boitempo','Bors','Brasiliense','Cidade Futura','Companhia das Letras','Cortez','Cultrix','DP&A','Ed. da FGV','Ed. da Universidade Católica Dom Bosco','Ed. da Universidade São Francisco','Ediouro','Editora Campus','Editora Central Gospel','Editora da PUC/RS','Editora da UFMG','Editora da UFMS','Editora da UFRGS','Editora da UFRJ','Editora da UFSC','Editora da UNESP','Editora da UNICAMP','Editora da UNIMEP','Editora UNISINOS','Editora da Universidade de Brasília','Editora Gente','Editora Saraiva','Ed. da Universidade Regional de Blumenau (FURB)','EDIUPF','EDUSC','EDUSP','Elsevier','Escala','Escrituras','Escuta','Estação Liberdade','Fiel','Forense','FTD','Fundação Perseu Abramo','Fundamento','Graça Editorial','Gryphus','Holos Editora','Horizontal','Imprensa Oficial do Estado de SP','Loyola','Martin Claret','LPM','Martins Fontes','Madras','Meca','Makron Books','Mediação','Melhoramentos','Memnon','Mercado de Letras','Mercuryo','Moderna','Mundo Cristão','Nova Fronteira','Olho D’Água','Paulus','Papirus','Paz e Terra','Perspectiva','Plexus','Puritanos','Quartet','Relume','Rocco','Senado Federal Publicações','Sextante','Sinodal','Theasaurus','Summus','UFC Edições da Universidade Federal do Ceará','UFJF','UFMT','Ultimato','Unijuí','Vozes','Zahar','Grupo Especial');
    $arrayEditorasPeriodicos = array('Alternativa Editorial','Assinaweb','Associação Nacional de Editores de Revistas','Editora Escala','Editora Europa','Editora Globo','Editora Jazz','Editora Segmento','Editora Terceiro Milênio','Ferreira & Bento','Grupo Lund','RPA','SA Petter Editora','Sonel Editora');
    $arrayAcervo = array();
    $cont = 1;
    ################################
		//LIVROS
    	while($cont != FIM_LIVROS)
    	{
    		$linha = fgets($arq);
	        $dados = explode(";", $linha);
    		$igual = false;
	        if(count($arrayAcervo) > 0)
	        {
	        	for($i = 0; $i < count($arrayAcervo); $i ++)
				{
					if($arrayAcervo[$i] == @$dados[0])
					{
						$igual = true;
					}
				}
	        }	        	
			if($igual == false)
			{
				$idCampi = rand(1,10);
				$nome = @$dados[0];
				array_push($arrayAcervo, $nome);
				$tipo = 'Livro';
				$local = 'Brasil';
				$ano = rand(1999,2017);
				$editora = $arrayEditoras[rand(0,86)];
				$paginas = rand(50,865);
				$ativo = 'S';
				$stmt->execute();
			}
	        
			$cont++;
		}
		//ACADÊMICOS
    	while($cont != FIM_ACADEMICOS)
    	{
    		$linha = fgets($arq);
	        $dados = explode(";", $linha);
	        $igual = false;
	        if(count($arrayAcervo) > 0)
	        {
	        	for($i = 0; $i < count($arrayAcervo); $i ++)
				{
					if($arrayAcervo[$i] == @$dados[0])
					{
						$igual = true;
					}
				}
	        }	        	
			if($igual == false)
			{
				$idCampi = rand(1,10);
				$nome = @$dados[0];
				$tipo = 'Acadêmico';
				$local = 'Brasil';
				$ano = 2017;
				$editora = '';
				$paginas = rand(20,213);
				$ativo = 'S';
				$stmt->execute();
			}
			$cont++;
		}
		//MÍDIAS
    	while($cont != FIM_MIDIAS)
    	{
    		$linha = fgets($arq);
	        $dados = explode(";", $linha);
	        $igual = false;
	        if(count($arrayAcervo) > 0)
	        {
	        	for($i = 0; $i < count($arrayAcervo); $i ++)
				{
					if($arrayAcervo[$i] == @$dados[0])
					{
						$igual = true;
					}
				}
	        }	        	
			if($igual == false)
			{
				$idCampi = rand(1, 10);
				$nome = @$dados[0];
				$tipo = 'Mídia';
				$local = 'Brasil';
				$ano = @$dados[1];
				$editora = '';
				$paginas = 0;
				$ativo = 'S';
				$stmt->execute();
			}
			$cont++;
		}
		//PERIÓDICOS
    	while($cont != FIM_PERIODICOS)
    	{
    		$linha = fgets($arq);
	        $dados = explode(";", $linha);
	        $igual = false;
	        if(count($arrayAcervo) > 0)
	        {
	        	for($i = 0; $i < count($arrayAcervo); $i ++)
				{
					if($arrayAcervo[$i] == @$dados[0])
					{
						$igual = true;
					}
				}
	        }	        	
			if($igual == false)
			{
				$idCampi = rand(1, 10);
				$nome = @$dados[0];
				$tipo = 'Periódico';
				$local = 'Brasil';
				$ano = rand(1980, 2017);
				$editora = $arrayEditorasPeriodicos[rand(0, count($arrayEditorasPeriodicos) - 1)];
				$paginas = rand(40, 200);
				$ativo = 'S';
				$stmt->execute();
			}
			$cont++;
		}
	####################################################################################
	//INSERINDO NA TABELA LIVROS
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
	################################
    $cont = 1;
    ################################
    	$sqlAcervoLivros = "SELECT id FROM `acervo` WHERE tipo = 'Livro'";
    	$rstAcervoLivros = $con->query($sqlAcervoLivros);
    	while($linhaAcervoLivros = $rstAcervoLivros->fetch_assoc())
    	{
    		$linha = fgets($arq);
	        $dados = explode(";", $linha);
			
			$idAcervo = $linhaAcervoLivros['id'];
			$ISBN1 = rand(100000000,999999999);
			$ISBN2 = rand(1000,9999); 
			$ISBN = "$ISBN1"."$ISBN2";
			$edicao = rand(1,18);
			$ativo = 'S';
			$stmt->execute();
		}
	####################################################################################
	//INSERINDO NA TABELA ACADEMICOS
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
	################################
    $arrayProgramas = array('Monografia','Dissertação','Tese','TCC','Artigo técnico','Trabalho de nível superior');
    ################################
    	$sqlAcervoAcademicos = "SELECT id FROM `acervo` WHERE tipo = 'Acadêmico'";
    	$rstAcervoAcademicos = $con->query($sqlAcervoAcademicos);
    	while($linhaAcervoAcademicos = $rstAcervoAcademicos->fetch_assoc())
    	{
    		$linha = fgets($arq);
	        $dados = explode(";", $linha);
			
			$idAcervo = $linhaAcervoAcademicos['id'];
			$programa = $arrayProgramas[rand(0,5)];
			$ativo = 'S';
			$stmt->execute();
		}
	####################################################################################
	//INSERINDO NA TABELA MIDIAS
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
	################################
    $arraySubtipo = array('PenDrive','CD','DVD','Fita');
    ################################
    	$sqlAcervoMidias = "SELECT id FROM `acervo` WHERE tipo = 'Mídia'";
    	$rstAcervoMidias = $con->query($sqlAcervoMidias);
    	while($linhaAcervoMidias = $rstAcervoMidias->fetch_assoc())
    	{
    		$linha = fgets($arq);
	        $dados = explode(";", $linha);
			
			$idAcervo = $linhaAcervoMidias['id'];
			$tempo = rand(55,195);
			$subtipo = $arraySubtipo[rand(0,3)];
			$ativo = 'S';
			$stmt->execute();
		}
	####################################################################################
	//INSERINDO NA TABELA PERIODICOS
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
	################################
    $arrayPeriodicidade = array('Diário', 'Semanal', 'Quinzenal', 'Mensal', 'Bimensal', 'Semestral', 'Anual');
    $arraySubtipoPeriodicos = array('Revista', 'Jornal', 'Boletim');
    ################################
    	$sqlAcervoPeriodicos = "SELECT id FROM `acervo` WHERE tipo = 'Periódico'";
    	$rstAcervoPeriodicos = $con->query($sqlAcervoPeriodicos);
    	while($linhaAcervoPeriodicos = $rstAcervoPeriodicos->fetch_assoc())
    	{
			$idAcervo = $linhaAcervoPeriodicos['id'];
			$periodicidade = $arrayPeriodicidade[rand(0, count($arrayPeriodicidade) - 1)];
			$mes = rand(1, 12);
			$volume = rand(10, 200);
			$subtipo = $arraySubtipoPeriodicos[rand(0, count($arraySubtipoPeriodicos) - 1)];
			$ISSN = rand(10000000, 99999999);
			$ativo = 'S';
			$stmt->execute();
		}
	####################################################################################
	//INSERINDO NA TABELA PARTES
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
	################################
    $arrayTItulos = array('Sumário', 'Parte 1', 'Parte 2', 'Parte 3');
    $arrayPalavrasChave = array('marketing', 'engenharia', 'ciência', 'tecnologia', 'medicina', 'empreendedorismo', 'política', 'sociedade', 'educação', 'saúde', 'psicologia', 'física', 'reflexão');
    ################################
    	$sql = "SELECT id, idAcervo FROM `periodicos` WHERE ativo = 'S'";
    	$rst = $con->query($sql);
    	while($linha = $rst->fetch_assoc())
    	{
    		$stmtAcervo = $con->prepare("SELECT paginas FROM `acervo` WHERE id = ? AND ativo = 'S'");
    		$stmtAcervo->bind_param('i', $idAcervo);
    		$idAcervo = $linha['idAcervo'];
    		$stmtAcervo->execute();
    		$rstAcervo = $stmtAcervo->get_result();
    		$linhaAcervo = $rstAcervo->fetch_assoc();
    		$cont = 0;
    		while($cont != 4)
    		{
    			$idPeriodico = $linha['id'];
				$titulo = $arrayTItulos[$cont];
				if($cont == 0)
				{
					$pagInicio = rand(3, 6);
					$pagFinal = ($pagInicio + 2);
					$pagFinalAnt = $pagFinal;
				}
				else if($cont > 0)
				{
					$pagInicio = ($pagFinalAnt + 1);
					if($cont < 3)
					{
						$pagFinal = $pagInicio + round(($linhaAcervo['paginas']/4));
						$pagFinalAnt = $pagFinal;
					}
					else if($cont == 3)	
					{
						$pagFinal = $linhaAcervo['paginas'];	
						$pagFinalAnt = $pagFinal;
					}				
				}
				$palavrasChave = '';
				$cont2 = 0;
				while($cont2 != 3)
				{
					$palavrasChave .= $arrayPalavrasChave[rand(0, count($arrayPalavrasChave)-1)].'; ';
					$cont2++;
				}
				$ativo = 'S';
				$stmt->execute();
				$cont++;
    		}
		}
	
	####################################################################################
	//INSERINDO NA TABELA AUTORES
	$stmt = $con->prepare (
			"INSERT INTO autores
				(nome, sobrenome, ordem, qualificacao, ativo) 
				VALUES (?, ?, ?, ?, ?)"
			);
	
	$stmt->bind_param (
				"sssss",
				$nome, $sobrenome, $ordem, $qualificacao, $ativo
			 );
	################################
    rewind($arq);
    $cont = 1;
    $arrayAutores = array();
    $arrayQualificacao = array( 'Tecnólogo',
							    'Bacharel',
								'Licenciado',
								'Pós-Graduado',
								'Especialista',
								'Mestre',
								'Doutor');
    ################################
    	while($cont != FIM_MIDIAS)
    	{
    		$linha = fgets($arq);
	        $dados = explode(";", $linha);
	        $igual = false;
	        if(count($arrayAutores) > 0)
	        {
	        	for($i = 0; $i < count($arrayAutores); $i ++)
				{
					if($arrayAutores[$i][0] == @$dados[1] && $arrayAutores[$i][1] == @$dados[2])
					{
						$igual = true;
					}
				}
			}
			if($igual == false)
			{
				$nome = @$dados[1];
				$sobrenome = @$dados[2];
				array_push($arrayAutores, array($nome, $sobrenome));
				$ordem = '1a';
				$qualificacao = $arrayQualificacao[rand(0, count($arrayQualificacao)-1)];
				$ativo = 'S';
				$stmt->execute();
			}
			
			$cont ++;
		}
	####################################################################################
	//INSERINDO NA TABELA AUTORACERVO
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
	################################
    rewind($arq);
    $cont = 1;
    ################################
    	//AUTOR ACERVO
    	while($cont != FIM_MIDIAS)
    	{
    		$linha = fgets($arq);
	        $dados = explode(";", $linha);
			
			$idAcervo = $cont;
			$igual = false;
			for($i = 0; $i < count($arrayAutores); $i ++)
			{
				if($arrayAutores[$i][0] == @$dados[1] && $arrayAutores[$i][1] == @$dados[2])
				{
					$idAutor = ($i + 1);
				}
			}
			$ativo = 'S';
			$stmt->execute();
			$cont++;
		}
	####################################################################################
	//INSERINDO NA TABELA RESERVAS
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
	################################
	
	$numReservas = rand(1, 20);
	$arrayAtivo = array('S', 'N');
	$cont = $numReservas;
    ################################
		$sqlAluno = "SELECT idCPF FROM `alunos` WHERE ativo = 'S'";
		$rstAluno = $con->query($sqlAluno);
		while($linhaAluno = $rstAluno->fetch_assoc())
		{
			if($cont == 0)
			{
				break;
			}
			$idAluno = $linhaAluno['idCPF'];
			$idAcervo = rand(1, NUM_ACERVO);
			
			$dia = rand(1,29);
			$mes = rand(1,12);
			$ano = rand(1990,2017);
			$data = new DateTime("$dia-$mes-$dia");
			$dataReserva = $data->format('d/m/Y');
			$tempoEspera = rand(1, 20);
			$emprestou = $arrayAtivo[rand(0, 1)];
			$ativo = 'S';
			$stmt->execute();
			$cont --;
		}
	####################################################################################
	//INSERINDO NA TABELA EMPRESTIMOS
	$stmt = $con->prepare (
			"INSERT INTO emprestimos
				(idAluno, idAcervo, dataEmprestimo, dataPrevisaoDevolucao, dataDevolucao, multa, ativo) 
				VALUES (?, ?, ?, ?, ?, ?, ?)"
			);
	
	$stmt->bind_param (
				"sisssss", 
				$idAluno, $idAcervo, $dataEmprestimo, $dataPrevisaoDevolucao, $dataDevolucao, $multa, $ativo
			 );
	####################################################
	################################
	$numEmprestimosDeReservas = $numReservas;
	$numEmprestimos = rand(1,20);
	$cont = $numEmprestimosDeReservas;
	$arrayEmprestados = array();
    ################################
		$sqlEmprestimos = "SELECT * FROM `reservas` WHERE ativo = 'S' AND emprestou = 'S'";
		$rstEmprestimos = $con->query($sqlEmprestimos);
		while($linhaEmprestimos = $rstEmprestimos->fetch_assoc()) 
		{
			if($cont == 0)
			{
				break;
			}
			$idAluno = $linhaEmprestimos['idAluno'];
			$idAcervo = $linhaEmprestimos['idAcervo'];
			array_push($arrayEmprestados, $idAcervo);
			$data1 = $linhaEmprestimos['dataReserva'];
			$data1 = explode('/',$data1);
			$data1 = new DateTime("$data1[0]-$data1[1]-$data1[2]");
			$data1->add(new DateInterval('P'.$linhaEmprestimos['tempoEspera'].'D'));
			$dataEmprestimo = $data1->format('d/m/Y');
			
			$data2 = $data1;
			$data2->add(new DateInterval('P7D'));
			$dataPrevisaoDevolucao = $data2->format('d/m/Y');
			$data3 = $data1;
			$data3->add(new DateInterval('P'.rand(0,21).'D'));
			$dataDevolucao = $data3->format('d/m/Y');
			$data4 = explode('/',$dataPrevisaoDevolucao);
			$data4 = new DateTime("$data4[0]-$data4[1]-$data4[2]");
			$data5 = explode('/',$dataDevolucao);
			$data5 = new DateTime("$data5[0]-$data5[1]-$data5[2]");
			if($data4 >= $data5)
			{
				$multa = 0;
			}
			else
			{	
				$data6 = $data4->diff($data5);
				$multa = ($data6->format('%R%a')) * 2;
			}
			$ativo = 'S';
			
			$stmt->execute();
			$cont --;
		}
		while($numEmprestimos != 0)
		{
			$rstAlunoRandom = $con->query("SELECT idCPF FROM `alunos` WHERE ativo = 'S' ORDER BY RAND() LIMIT 1");
			$linhaAlunoRandom = $rstAlunoRandom->fetch_assoc();
			$idAluno = $linhaAlunoRandom['idCPF'];
			$acervoEmprestado = false;
			while($acervoEmprestado == false)
			{
				$rstAcervoRandom = $con->query("SELECT id FROM `acervo` WHERE ativo = 'S' ORDER BY RAND() LIMIT 1");
				$linhaAcervoRandom = $rstAcervoRandom->fetch_assoc();
				for($i = 0; $i < (count($arrayEmprestados) - 1); $i ++)
				{
					if($arrayEmprestados[$i] == $linhaAcervoRandom['id'])
					{
						$acervoEmprestado = true;
					}
				}
				if($acervoEmprestado == true)
				{
					$idAcervo = $linhaAcervoRandom['id'];
					array_push($arrayEmprestados, $idAcervo);
				}
			}
			$dia = rand(1,29);
			$mes = rand(1,12);
			$ano = rand(1990,2017);
			$dataEmprestimo = new DateTime("$dia-$mes-$ano");
			$dataEmprestimo = $dataEmprestimo->format('d/m/Y');

			$dataPrevisaoDevolucao = explode('/', $dataEmprestimo);
			$dataPrevisaoDevolucao = new DateTime("$dataPrevisaoDevolucao[0]-$dataPrevisaoDevolucao[1]-$dataPrevisaoDevolucao[2]");
			$dataPrevisaoDevolucao->add(new DateInterval('P7D'));
			$dataPrevisaoDevolucao = $dataPrevisaoDevolucao->format('d/m/Y');
			$dataDevolucao = explode('/', $dataPrevisaoDevolucao);
			$dataDevolucao = new DateTime("$dataDevolucao[0]-$dataDevolucao[1]-$dataDevolucao[2]");
			$dataDevolucao->add(new DateInterval('P'.rand(0, 21).'D'));
			$dataDevolucao = $dataDevolucao->format('d/m/Y');
			$data1 = explode('/',$dataPrevisaoDevolucao);
			$data1 = new DateTime("$data1[0]-$data1[1]-$data1[2]");
			$data2 = explode('/',$dataDevolucao);
			$data2 = new DateTime("$data2[0]-$data2[1]-$data2[2]");
			if($data1 >= $data2)
			{
				$multa = 0;
			}
			else
			{	
				$data3 = $data1->diff($data2);
				$multa = ($data3->format('%R%a')) * 2;
			}
			$ativo = 'S';
			
			$stmt->execute();
			$numEmprestimos --;
		}
	####################################################################################
	//INSERINDO NA TABELA DESCARTES
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
	################################
	$numDescartes = rand(1,20);
	$cont = $numDescartes;
	$arrayMotivos = array('Amassado', 'Página rasgada', 'Páginas rasgadas', 'Sem capa', 'Páginas faltando', 'Obsoleto');
    ################################
		$stmtDescartes = $con->prepare("SELECT id FROM `acervo` WHERE ativo = 'S' ORDER BY RAND() LIMIT ?");
		$stmtDescartes->bind_param('i', $limit);
		$limit = $numDescartes;
		$stmtDescartes->execute();
		$rstDescartes = $stmtDescartes->get_result();
		while($linhaDescartes = $rstDescartes->fetch_assoc())
		{
			if($cont == 0)
			{
				break;
			}
			$idAcervo = $linhaDescartes['id'];
			$sqlFuncionario = "SELECT idSIAPE FROM `funcionario` WHERE ativo = 'S' ORDER BY RAND() LIMIT 1";
			$rstFuncionario = $con->query($sqlFuncionario);
			$linhaFuncionario = $rstFuncionario->fetch_assoc();
			$idFuncionario = $linhaFuncionario['idSIAPE'];
			$dia = rand(1,29);
			$mes = rand(1,12);
			$ano = rand(1990,2017);
			$dataDescarte = "$dia/$mes/$ano";
			$motivos = $arrayMotivos[rand(0, (count($arrayMotivos)-1))];
			$ativo = 'S';
			$stmt->execute();
			$cont --;
		}
		$sqlDescartes = "SELECT idAcervo FROM `descartes` WHERE ativo = 'S'";
		$rstDescartes = $con->query($sqlDescartes);
		while($linhaDescartes = $rstDescartes->fetch_assoc())
		{
			$rstDescartesAcervo = $con->query("UPDATE `acervo` SET ativo = 'N' WHERE id = ".$linhaDescartes['idAcervo']."");
			$rstDescartesLivros = $con->query("SELECT id FROM `livros` WHERE ativo = 'S' AND idAcervo = ".$linhaDescartes['idAcervo']."");
			if($rstDescartesLivros->num_rows == 1)
			{
				$linhaDescartesLivros = $rstDescartesLivros->fetch_assoc();
				$rstDescartesLivros = $con->query("UPDATE `livros` SET ativo = 'N' WHERE id = ".$linhaDescartesLivros['id']."");
			}
			else
			{
				$rstDescartesAcademicos = $con->query("SELECT id FROM `academicos` WHERE ativo = 'S' AND idAcervo = ".$linhaDescartes['idAcervo']."");
				if($rstDescartesAcademicos->num_rows == 1)
				{
					$linhaDescartesAcademicos = $rstDescartesAcademicos->fetch_assoc();
					$rstDescartesAcademicos = $con->query("UPDATE `academicos` SET ativo = 'N' WHERE id = ".$linhaDescartesAcademicos['id']."");
				}
				else
				{
					$rstDescartesMidias = $con->query("SELECT id FROM `midias` WHERE ativo = 'S' AND idAcervo = ".$linhaDescartes['idAcervo']."");
					if($rstDescartesMidias->num_rows == 1)
					{
						$linhaDescartesMidias = $rstDescartesMidias->fetch_assoc();
						$rstDescartesMidiasFinal = $con->query("UPDATE `midias` SET ativo = 'N' WHERE id = ".$linhaDescartesMidias['id']."");
					}
					else
					{
						$rstDescartesPeriodicos = $con->query("SELECT id FROM `periodicos` WHERE ativo = 'S' AND idAcervo = ".$linhaDescartes['idAcervo']."");
						if($rstDescartesPeriodicos->num_rows == 1)
						{
							$linhaDescartesPeriodicos = $rstDescartesPeriodicos->fetch_assoc();
							$rstDescartesPeriodicos = $con->query("UPDATE `periodicos` SET ativo = 'N' WHERE id = ".$linhaDescartesPeriodicos['id']."");
							$rstDescartesPartes = $con->query("SELECT id FROM `partes` WHERE ativo = 'S' AND idPeriodico = ".$linhaDescartesPeriodicos['id']."");
							while($linhaDescartesPartes = $rstDescartesPartes->fetch_assoc())
							{
								$rstDescartesPartesFinal = $con->query("UPDATE `partes` SET ativo = 'N' WHERE id = ".$linhaDescartesPartes['id']."");
							}
						}
					}
				}
			}
		}
###############################################################################################
	//FECHANDO A CONEXÃO
	//mysqli_close($con);
###############################################################################################
	echo "<b><h3>".'Dados inseridos com sucesso.'."</b></h3>";
