<!DOCTYPE html>
<?php
	session_start(); 

	$usuario = $_SESSION['usuario'];

	echo "<script> 
	        if(window.sessionStorage.getItem('logado') == 'N') 
	          location.href = '../Login/gerencia-web-login.html'; 
	      </script>";

	header('content-type: text/html; charset=ISO-8859-1');
	if(isset($_GET["result"])){
		define ("RESULTADO", $_GET["result"]);
	}else{
		define("RESULTADO", null);
	}
	
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title> Resultado </title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="../../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

		<link rel="stylesheet" type="text/css" href="PHJL-WEB-Estilo-paginas.css"> <!--Aqui-->		
		<link rel="stylesheet" type="text/css" href="PHJL-WEB-Estilo-resultado.css"> <!--Aqui-->

		<!-- Arquivos js -->
		<script src="../../../../Estaticos/Bootstrap/js/popper.js" type="text/javascript"></script>
		<script src="../../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="../../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Resultado.js?v=1" defer></script> <!--Aqui-->

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		<link href="../../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">

  		<script type="text/javascript">
		    function fazerLogout(){
		        window.sessionStorage.setItem('logado', 'N');
		    }  
		</script>

	</head>
	
	<body>
							
		<!-- A seguir verificamos o valor da constante RESULTADO e imprimimos uma tela diferente para cada caso.
			Os iframes são utilizados para fazer com que o fundo da tela corresponda a o que o usuário está fazendo,
			por exemplo, se o usuário tiver acabado de inserir um aluno, aparece o alert e no fundo aparece a tela
			do formulário de inserção de aluno de tal forma que se o usuário fechar o alerta ele ainda poderá inserir
			outro aluno na mesma página, mas também pode clica em "inserir novo aluno" e ele será redirecionado à página
			de inserção de aluno -->
			
		<?php
			if(RESULTADO == "inserirSUCESSO"){
				echo '
				<iframe class="TelaCheiaiframe" src="PHJL-WEB-Formulario-de-insercao-de-aluno.php"></iframe>

				<div class="modal fade" id="alerta" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">                        	
								<h5 class="modal-title text-center">RESULTADO</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								Aluno(a) inserido(a) com sucesso ! 
							</div>
							<div class="modal-footer">
								<div class="left-side">
									<button type="button" class="btn btn-success btn-link" data-dismiss="modal" onclick=\'mudaPagina("novoaluno")\'>Inserir novo aluno</button>
								</div>
								<div class="divider"></div>
								<div class="right-side">
									<button type="button" class="btn btn-default btn-link" onclick=\'mudaPagina("inicial")\'>P&aacute;gina inicial</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				';
			}elseif(RESULTADO == "inserirERRO"){
				echo '
					<iframe class="TelaCheiaiframe" src="PHJL-WEB-Formulario-de-insercao-de-aluno.php"></iframe>

					<div class="modal fade" id="alerta" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">   
												<h5 class="modal-title text-center">RESULTADO</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
								</div>
								<div class="modal-body">
									Erro ao inserir o(a) aluno(a) ! 
								</div>
								<div class="modal-footer">
									<div class="left-side">
										<button type="button" class="btn btn-success btn-link" data-dismiss="modal" onclick=\'mudaPagina("novoaluno")\'>Tentar novamente</button>
									</div>
									<div class="divider"></div>
									<div class="right-side">
										<button type="button" class="btn btn-default btn-link" onclick=\'mudaPagina("inicial")\'>P&aacute;gina inicial</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				';
			}elseif(RESULTADO == "alterarSUCESSO"){ 
				echo '
					<iframe class="TelaCheiaiframe" src="PHJL-WEB-Pesquisa-alterar-aluno.php"></iframe>

					<div class="modal fade" id="alerta" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">   
									<h5 class="modal-title text-center">RESULTADO</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
								</div>
								<div class="modal-body">
									Aluno(a) alterado(a) com sucesso ! 
								</div>
								<div class="modal-footer">
									<div class="left-side">
										<button type="button" class="btn btn-success btn-link" data-dismiss="modal" onclick=\'mudaPagina("alteraraluno")\'>Alterar outro aluno</button>
									</div>
									<div class="divider"></div>
									<div class="right-side">
										<button type="button" class="btn btn-default btn-link" onclick=\'mudaPagina("inicial")\'>P&aacute;gina inicial</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				';
			}elseif(RESULTADO == "alterarERRO"){
				echo '
					<iframe class="TelaCheiaiframe" src="PHJL-WEB-Pesquisa-alterar-aluno.php"></iframe>

					<div class="modal fade" id="alerta" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">   
									<h5 class="modal-title text-center">RESULTADO</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
								</div>
								<div class="modal-body">
									Erro ao alterar o(a) aluno(a) ! 
								</div>
								<div class="modal-footer">
									<div class="left-side">
										<button type="button" class="btn btn-success btn-link" data-dismiss="modal" onclick=\'mudaPagina("alteraraluno")\'>Tentar novamente</button>
									</div>
									<div class="divider"></div>
									<div class="right-side">
										<button type="button" class="btn btn-default btn-link" onclick=\'mudaPagina("inicial")\'>P&aacute;gina inicial</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				';
			}elseif(RESULTADO == "deletarSUCESSO"){
				echo '
					<iframe class="TelaCheiaiframe" src="../../../Entrada/gerencia-web-interface-coordenador.php?acao=deletarAluno"></iframe>

					<div class="modal fade" id="alerta" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">   
									<h5 class="modal-title text-center">RESULTADO</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									Aluno(a) deletado(a) com sucesso ! 
								</div>
								<div class="modal-footer">
									<div class="left-side">
										<button type="button" class="btn btn-success btn-link" data-dismiss="modal" onclick=\'mudaPagina("deletaraluno")\'>Deletar outro aluno</button>
									</div>
									<div class="divider"></div>
									<div class="right-side">
										<button type="button" class="btn btn-default btn-link" onclick=\'mudaPagina("inicial")\'>P&aacute;gina inicial</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				';
			}elseif(RESULTADO == "deletarERRO"){
				echo '
					<iframe class="TelaCheiaiframe" src="../../../Entrada/gerencia-web-interface-coordenador.php?acao=deletarAluno"></iframe>

					<div class="modal fade" id="alerta" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">   
									<h5 class="modal-title text-center">RESULTADO</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									Erro ao deletar o(a) aluno(a) ! 
								</div>
								<div class="modal-footer">
									<div class="left-side">
										<button type="button" class="btn btn-success btn-link" data-dismiss="modal" onclick=\'mudaPagina("deletaraluno")\'>Tentar novamente</button>
									</div>
									<div class="divider"></div>
									<div class="right-side">
										<button type="button" class="btn btn-default btn-link" onclick=\'mudaPagina("inicial")\'>P&aacute;gina inicial</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				';
			}else{
				echo '
				<div class="wrapper">     

					<div class="section landing-section">
						<div class="container">
							<div class="row">
								<div class="col-md-8 ml-auto mr-auto border border-dark rounded">
									<h2>ERRO : P&Aacute;GINA N&Atilde;O ENCONTRADA</h2>
								</div>
							</div>
						</div>
					</div>
				</div>
				';
			}
		?>
	</body>
</html>