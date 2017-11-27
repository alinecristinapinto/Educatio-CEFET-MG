<?php 
	session_start();
	header('content-type: text/html; charset=ISO-8859-1');
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "usbw");
	define ("BD", "educatio");
	
	//sessions
	define ("IDDISCIPLINA", $_SESSION["IDDISCIPLINA"]);
	define ("IDPROFDISCIPLINAS", $_SESSION["IDPROFDISCIPLINAS"]);
	define ("IDCONTEUDO", $_SESSION["IDCONTEUDO"]);
	define ("IDTURMA", $_SESSION["IDTURMA"]);
	
	define ("ATIVIDADE", $_REQUEST["atividade"]);
	define ("DATA", date_format(new DateTime($_REQUEST["data"]), "d/m/Y"));
	define ("VALOR", $_REQUEST["valor"]);
	
	$erros = 0;
	
	//conexao com mysql
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	
	//seleciona o bd
	$bd_select = mysqli_select_db ($conn, BD);
	
	//inserindo os valores recebidos no Banco de Dados em conteudos.
	$sql = "INSERT INTO atividades
	(idProfDisciplina, nome, data, valor, ativo)
	VALUES 
	('" .IDPROFDISCIPLINAS ."', '" .ATIVIDADE ."', '" .DATA ."', '" .VALOR ."', 'S')";
	
	if (!mysqli_query ($conn, $sql)) {
		$erros++;
	}
	
	$sql = "SELECT * FROM atividades WHERE id=(SELECT MAX(id) FROM atividades)";
	$result = mysqli_query($conn, $sql);
	$linhaAtividade = mysqli_fetch_array($result);
	
	$sql = "SELECT * FROM alunos WHERE idTurma = " .IDTURMA ." AND ativo = 'S'";
	$result = mysqli_query($conn, $sql);
	
	while($linhaAlunos = mysqli_fetch_array($result)){
		$sql = "SELECT * FROM matriculas WHERE idAluno = " .$linhaAlunos[0] ." AND idDisciplina = " .IDDISCIPLINA;
		$resultMatricula = mysqli_query($conn, $sql);
		$linhaMatriculas = mysqli_fetch_array($resultMatricula);
		
		$sql = "INSERT INTO diarios
		(idConteudo, idMatricula, idAtividade, faltas, nota, ano, ativo)
		VALUES
		('" .IDCONTEUDO ."', '" .$linhaMatriculas[0] ."', '" .$linhaAtividade[0] ."', '0', '0.00', '" .date("Y") ."', 'S')";
		
		if(!mysqli_query($conn, $sql)){
			$erros++;
		}
	}
	
	$sql = "SELECT * FROM conteudos WHERE id = " .IDCONTEUDO;
	$resultConteudo = mysqli_query($conn, $sql);
	$linhaConteudo = mysqli_fetch_array($resultConteudo);
	
	if ($erros == 0) {
		echo "<tr id = 'ID$linhaAtividade[0]'><td>"
			."<span class = 'fonteCabecalho' style = 'cursor : pointer;' onclick = 'alteraAtividade(\"ID$linhaAtividade[0]\", "
			."\"$linhaAtividade[2]\", \"" .date_format(date_create_from_format('d/m/Y', $linhaAtividade[3]), 'Y-m-d') ."\", "
			."\"$linhaAtividade[4]\")'><i class='nc-icon nc-settings'></i></span>
			&nbsp;&nbsp;
			<span class = 'fonteCabecalho' style = 'cursor : pointer;' onclick = 'alertDeletaAtividade(\"$linhaAtividade[2]\", \"$linhaAtividade[0]\")'>"
			."<i class='nc-icon nc-simple-remove'></i></span>
			</td>
		<td class = 'fonteTexto' id = 'Atividade" .$linhaAtividade[0] ."ID' >" .ATIVIDADE ."</td>";
		echo "<td class = 'fonteTexto' id = 'Data" .$linhaAtividade[0] ."ID' >" .$linhaAtividade[3] ."</td>";
		echo "<td class = 'fonteTexto'> <a href='PHJL-WEB-Lancar-presenca-diario.php?idatividade=$linhaAtividade[0]' > + Presen&ccedil;a </a> </td>";
		echo "<td class = 'fonteTexto'> <a href='PHJL-WEB-Lancar-notas-diario.php?idatividade=$linhaAtividade[0]' > + Lan&ccedil;ar notas </a> </td></tr>";
		echo "<tr style = 'cursor : pointer;' id = 'trNovaAtividadeID'>";
		echo "<td class = 'fonteTexto' colspan = '5' id = 'tdNovaAtividadeID' onclick = 'insereAtividade(this.id)'>";
		echo "<span> + Adicionar Atividade </span>";
		echo "</td>";
		echo "</tr>";
		
		return;
	} else {
		echo "FAIL";
		return;
	}
?>