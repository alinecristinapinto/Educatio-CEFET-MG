<?php
	session_start();
	header('content-type: text/html; charset=ISO-8859-1');
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "usbw");
	define ("BD", "educatio");
	
	$usuario = $_SESSION['usuario'];

	define ("IDPROF", $usuario['idSIAPE']);
	define ("IDTURMA", $_SESSION["IDTURMA"]);
	define ("IDDISCIPLINA", $_SESSION["IDDISCIPLINA"]);
	
	if(isset($_GET["conteudo"])){
		$_SESSION["IDCONTEUDO"] = $_GET["conteudo"];
		define ("IDCONTEUDO", $_SESSION["IDCONTEUDO"]);
	}else{
		define ("IDCONTEUDO", $_SESSION["IDCONTEUDO"]);
	}
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);

	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);

	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM profdisciplinas WHERE idProfessor = " .IDPROF ." AND ativo = 'S'";
	$result = mysqli_query($conn,$sql);
	$linhaProf = mysqli_fetch_array($result);
	
	$sql = "SELECT * FROM turmas WHERE id = " .IDTURMA ." AND ativo = 'S'";
	$result = mysqli_query($conn,$sql);
	$linhaTurma = mysqli_fetch_array($result);
	
	$sql = "SELECT * FROM disciplinas WHERE id = " .IDDISCIPLINA ." AND ativo = 'S'";
	$result = mysqli_query($conn, $sql);
	$linhaDisciplina = mysqli_fetch_array($result);
	
	$_SESSION["IDPROFDISCIPLINAS"] = $linhaProf[0];
	
	$sql = "SELECT * FROM conteudos WHERE id = " .IDCONTEUDO ." AND ativo = 'S'";
	$result = mysqli_query($conn, $sql);
	$linhaConteudo = mysqli_fetch_array($result);
	
	//Cria um session para a etapa e define uma constante para etapa
	//*o id da etapa é igual ao "nome" dela
	$_SESSION["IDETAPA"] = $linhaConteudo[1];
	define ("IDETAPA", $_SESSION["IDETAPA"]);
	
	$sql = "SELECT * FROM etapas WHERE ativo = 'S' AND idOrdem = (SELECT MAX(idOrdem) FROM etapas)";
	$resultUltimaEtapa = mysqli_query($conn, $sql);
	$linhaUltimaEtapa = mysqli_fetch_array($resultUltimaEtapa);
	define ("MAXETAPAS", $linhaUltimaEtapa[0]);
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title> Acessar di&aacute;rio - Professor </title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="PHJL-WEB-Estilo-paginas.css?v=1">
		
		<!-- Arquivos js -->
		<script src="../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="../../../Estaticos/Bootstrap/js/popper.js" type="text/javascript"></script>
		<script src="../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Funcoes-mostrar-conteudo.js?v=1" defer></script>

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		<link href="../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<!--Chama a funcao com o evento onload para carregar a tabela assim que o body for gerado -->
	<body>
		
		<div class="wrapper">
			<div class="section landing-section">
				<div class="container">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto">
							<h2 class="text-center">ACESSAR DI&Aacute;RIO</h2>
							<?php 
								$atividades = array();
							
								echo "<h2 class = 'fonteCabecalho'> Disciplina de " .$linhaDisciplina[2] ."</h2>";
								echo "<h3 class = 'fonteCabecalho'>" .IDETAPA ."&ordm; Bimestre </h3>";
								echo "<h4 id = 'H4ConteudoID' class = 'fonteCabecalho'> $linhaConteudo[3] 
										<span class = 'fonteCabecalho' style = 'cursor : pointer;' onclick = 'alteraConteudo(\"$linhaConteudo[3]\", \"" .date_format(date_create_from_format('d/m/Y', $linhaConteudo[4]), 'Y-m-d') ."\", " .MAXETAPAS .", " .IDETAPA .")'>
											<i class='nc-icon nc-settings'></i>
											Editar
										</span>
										&nbsp;&nbsp;
										<span class = 'fonteCabecalho' style = 'cursor : pointer;' onclick = 'alertDeletaConteudo(\"$linhaConteudo[3]\")'>
											<i class='nc-icon nc-simple-remove'></i>
											Deletar
										</span>	
									</h4><br>";
								
								echo "<table class='table table-hover'>";
								
								$sql = "SELECT * FROM diarios WHERE idConteudo = $linhaConteudo[0] AND ativo = 'S'";
								$result = mysqli_query($conn, $sql);
								echo "<tbody id = 'DIVatividadesID'>";
								while($linhaDiario = mysqli_fetch_array($result)){
									if(in_array($linhaDiario[3], $atividades) == FALSE){
										$sql = "SELECT * FROM atividades WHERE id = $linhaDiario[3] AND ativo = 'S'";
										$result2 = mysqli_query($conn, $sql);
										$linhaAtividade = mysqli_fetch_array($result2);
										
										echo "<tr id = 'ID$linhaAtividade[0]'><td>
										<span class = 'fonteCabecalho' style = 'cursor : pointer;' onclick = 'alteraAtividade(\"ID$linhaAtividade[0]\", \"$linhaAtividade[2]\", \"" .date_format(date_create_from_format('d/m/Y', $linhaAtividade[3]), 'Y-m-d') ."\", \"$linhaAtividade[4]\")'>
											<i class='nc-icon nc-settings'></i>
										</span>
										&nbsp;&nbsp;
										<span class = 'fonteCabecalho' style = 'cursor : pointer;' onclick = 'alertDeletaAtividade(\"$linhaAtividade[2]\", \"$linhaAtividade[0]\")'>
											<i class='nc-icon nc-simple-remove'></i>
										</span>
										</td>";
										
										echo "<td class = 'fonteTexto' id = 'Atividade" .$linhaAtividade[0] ."ID' >" .$linhaAtividade[2] ."</td>";
										echo "<td class = 'fonteTexto' id = 'Data" .$linhaAtividade[0] ."ID' >" .$linhaAtividade[3] ."</td>";
										echo "<td class = 'fonteTexto'> <a href='PHJL-WEB-Lancar-presenca-diario.php?idatividade=$linhaAtividade[0]' > + Presen&ccedil;a </a> </td>";
										echo "<td class = 'fonteTexto'> <a href='PHJL-WEB-Lancar-notas-diario.php?idatividade=$linhaAtividade[0]' > + Lan&ccedil;ar notas </a> </td>";
										echo "</tr>";
										
										array_push($atividades, $linhaDiario[3]);
									}
								}
								echo "<tr style = 'cursor : pointer;' id = 'trNovaAtividadeID'>";
								echo "<td class = 'fonteTexto' colspan = '5' id = 'tdNovaAtividadeID' onclick = 'insereAtividade(this.id)'>";
								echo "<span> + Adicionar Atividade </span>";
								echo "</td>";
								echo "</tr>";
								echo "</tbody>";
								echo "</table>";								
							?>
							<input type = 'button' class='btn btn-info btn-round' onclick = 'voltaPagina("PHJL-WEB-Diario-prof")' value = 'Voltar'>
						</div>
						
						
					</div>
					
				</div>
			</div>	
		</div>
		
		<!-- Abaixo estão os modals que são utilizados na página -->
		<!-- Modal para ser exibido caso a alteração de conteúdo ocorra com sucesso -->
		<div class="modal fade" id="alertaSUCESSO" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                        	
						<h5 class="modal-title text-center">RESULTADO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Conte&uacute;do alterado com sucesso !
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal para ser exibido caso a alteração de conteúdo ocorra com falha -->
		<div class="modal fade" id="alertaERRO" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                        	
						<h5 class="modal-title text-center">RESULTADO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Erro ao alterar o conte&uacute;do !
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal para ser exibido caso o usuário clique na opção de deletar conteudo -->
		<div class="modal fade" id="alertaDeletarConteudo" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                        	
						<h5 class="modal-title text-center">ATEN&Ccedil;&Atilde;O</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<span class = 'fonteTexto'>Deseja realmente deletar o conte&uacute;do </span> <span class = 'fonteTexto' id = "spanDoModalDeletarConteudo"></span><!-- Usarei o Javascript para concatenar o nome do conteudo aqui -->
					</div>
					<div class="modal-footer">
						<div class="left-side">
							<button type="button" class="btn btn-danger btn-link" data-dismiss="modal" onclick='deletaConteudo()'>Deletar</button>
						</div>
						<div class="divider"></div>
						<div class="right-side">
							<button type="button" class="btn btn-default btn-link" data-dismiss="modal">N&atilde;o deletar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal para ser exibido caso a deleção de conteúdo ocorra com sucesso -->
		<div class="modal fade" id="alertaDeletarSUCESSO" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                        	
						<h5 class="modal-title text-center">RESULTADO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Conte&uacute;do deletado com sucesso !
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal para ser exibido caso a deleção de conteúdo ocorra com falha -->
		<div class="modal fade" id="alertaDeletarERRO" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                        	
						<h5 class="modal-title text-center">RESULTADO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Erro ao deletar o conte&uacute;do !
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal para ser exibido caso a alteração de atividade ocorra com sucesso -->
		<div class="modal fade" id="alertaAlteraAtividadeSUCESSO" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                        	
						<h5 class="modal-title text-center">RESULTADO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Atividade alterada com sucesso !
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal para ser exibido caso a alteração de atividade ocorra com falha -->
		<div class="modal fade" id="alertaAlteraAtividadeERRO" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                        	
						<h5 class="modal-title text-center">RESULTADO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Erro ao alterar a atividade !
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal para ser exibido caso o usuário clique na opção de deletar atividade -->
		<div class="modal fade" id="alertaDeletarAtividade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                        	
						<h5 class="modal-title text-center">ATEN&Ccedil;&Atilde;O</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<span class = 'fonteTexto'>Deseja realmente deletar a atividade</span> <span class = 'fonteTexto' id = "corpoDoModalDeletarAtividade"></span><!-- Usarei o Javascript para concatenar o nome da atividade aqui -->
					</div>
					<div class="modal-footer">
						<div class="left-side">
							<button type="button" class="btn btn-danger btn-link" data-dismiss="modal" onclick='deletaAtividadeBD()'>Deletar</button>
						</div>
						<div class="divider"></div>
						<div class="right-side">
							<button type="button" class="btn btn-default btn-link" data-dismiss="modal">N&atilde;o deletar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal para ser exibido caso a deleção de atividade ocorra com sucesso -->
		<div class="modal fade" id="alertaDeletarAtividadeSUCESSO" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                        	
						<h5 class="modal-title text-center">RESULTADO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Atividade deletada com sucesso !
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal para ser exibido caso a deleção de atividade ocorra com falha -->
		<div class="modal fade" id="alertaDeletarAtividadeERRO" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                        	
						<h5 class="modal-title text-center">RESULTADO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Erro ao deletar a atividade !
					</div>
				</div>
			</div>
		</div>
	</body>



</html>