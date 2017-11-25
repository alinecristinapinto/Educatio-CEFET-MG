<!DOCTYPE html>
<?php
	header('content-type: text/html; charset=ISO-8859-1');
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	
	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);
?>

<html>

	<head>

		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title>Cadastrar Aluno</title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/bootstrap.css" rel="stylesheet"/>
		<link href="Rodape-Web/gerencia-web-estilos-rodape.css" rel="stylesheet">
		<!--<link rel="stylesheet" type="text/css" href="PHJL-WEB-Formulario-de-insercao-de-aluno.css">-->

		<!-- Arquivos js -->
		<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Formulario-de-insercao-de-alunos.js?v=2" defer></script>

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		<link href="css/nucleo-icons.css" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<style type="text/css">

			.text-center{
			   font-family: 'Abel', sans-serif;
			   color: #d8ac29;
			}

			.fonteTexto{
			   font-family: 'Inconsolata', monospace;
			   font-size: 16px;
			}

			.btn-info {
			  background-color: #162e87;
			  border-color: #162e87;
			  color: #FFFFFF;
			  opacity: 1;
			  filter: alpha(opacity=100);
			}

			.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .show > .btn-info.dropdown-toggle {
			  background-color: #11277a;
			  color: #FFFFFF;
			  border-color: #11277a;
			}

		</style>
	</head>

	<body onload = "escondeSelects()">

    <!-- Essa classe é necessária para que quando o menu fique responsivo ele não sobreponha o formulário -->
    <div class="wrapper">     

        <div class="section landing-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">

                        <h2 class="text-center">CADASTRO DE ALUNO</h2>

                        <form class="contact-form" method = "POST" action = "PHJL-WEB-Insercao-de-aluno-no-BD.php" id= "formulario" 
						enctype= "multipart/form-data" >
                            <div class="row">
                                <label class="fonteTexto">Nome:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-circle-10"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Nome" required="required" name = "entradaNome" id = "entradaNomeID">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Sexo:</label>
                            </div>
                                <div class="input-group">
                                    <input class="form-check-input" type = "radio" name = "entradaSexo" id = "entradaSexoID" value = "Feminino" >Feminino<br>
                                    <input class="form-check-input" type = "radio" name = "entradaSexo" id = "entradaSexoID" value = "Masculino" >Masculino
                                </div>

                            <div class="row">
                                <label class="fonteTexto">Data de Nascimento:</label>
                                <div class='input-group'>                                         
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                    <input type='date' class="form-control" name = "entradaNascimento" id = "entradaNascimentoID" required = "required"/>
                                </div>
                            </div>

							<!-- O atributo pattern está sendo utilizado para bloquear o envio do formulário caso o CPF (ou o CEP ou a UF) 
							estiverem fora do formato correto, o title dá uma dica ao usuário sobre como deve ser o formato. 
							A função colocaPonto() é utilizada para colocar pontos no input enquanto o usuário digita, e é utilizada para CPF e CEP -->
                            <div class="row">
                                <label class="fonteTexto">CPF:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-badge"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="000.000.000-00" required="required" name = "entradaCPF" 
									id = "entradaCPFID" onkeypress = "colocaPonto(0)" pattern = "([0-9]{3}[\.]?){3}[-]?[0-9]{2}" title = "000.000.000-00">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Logradouro:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-map-big"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Logradouro" required="required" name = "entradaLogradouro" 
									id = "entradaLogradouroID">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Número:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-check-2"></i>
                                    </span>
                                    <input type="number" class="form-control" placeholder="0" required="required" name = "entradaNumero" 
									id = "entradaNumeroID">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Complemento:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-shop"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Complemento" required="required" name = "entradaComplemento" 
									id = "entradaComplementoID">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Bairro:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-globe-2"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Bairro" required="required" name = "entradaBairro" 
									id = "entradaBairroID">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Cidade:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-globe"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Cidade" required="required" name = "entradaCidade" 
									id = "entradaCidadeID">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">CEP:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-compass-05"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="00000-000" required="required" name = "entradaCEP" 
									id = "entradaCEPID" onkeypress = "colocaPonto(1)" pattern = "[0-9]{5}[-]?[0-9]{3}" title = "00000-000">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Adicionar UF:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-world-2"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="UF" required="required" name = "entradaUF" id = "entradaUFID"
									pattern = "[A-Z]{2}" title = "Apenas 2 caracteres maiúsculos">
                                </div>
                            </div>    

                            <div class="row">
                                <label class="fonteTexto">E-mail:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-email-85"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="email" required="required" name = "entradaEmail" 
									id = "entradaEmailID">
                                </div>
                            </div>     

                            <div class="row">
                                <label class="fonteTexto">Insira uma foto:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-image"></i>
                                    </span>
                                    <input type="file" class="form-control" required="required" id='entradaFotoID' name = "entradaFoto">
                                </div>
                            </div>

                            <div class="row" >
                                <label class="fonteTexto">Campus</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-image"></i>
                                    </span>
                                    <select class="form-control" name="entradaCampus" class="form-control" onchange = 'mostrarSelects("campi", this.value)' 
									id = "entradaCampusID" required>
										<option disabled selected value = ""> Selecione um Campus </option>
                                        <?php
											$sql = "SELECT * FROM campi";
											$result = mysqli_query($conn, $sql);
											while($linhaCampus = mysqli_fetch_array($result)){
												echo "<option value = " .$linhaCampus[0] .">" .$linhaCampus[1] ."</option>";
											}
										?>
									</select>
                                </div>
                            </div> 
							
							<div class="row" id = "entradaDeptoDIVID">
                                <label class="fonteTexto">Departamento</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-image"></i>
                                    </span>
                                    <select class="form-control" name="entradaDepto" class="form-control" onchange = 'mostrarSelects("deptos", this.value)' 
									id = "entradaDeptoID" required>
									</select>
                                </div>
                            </div> 
							
							<div class="row" id = "entradaCursoDIVID">
                                <label class="fonteTexto">Curso</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-image"></i>
                                    </span>
                                    <select class="form-control" name="entradaCurso" class="form-control" onchange = 'mostrarSelects("cursos", this.value)' 
									id = "entradaCursoID" required>
									</select>
                                </div>
                            </div> 
							
							<div class="row" id = "entradaTurmaDIVID">
                                <label class="fonteTexto">Turma</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-image"></i>
                                    </span>
                                    <select class="form-control" name="entradaTurma" class="form-control" id = "entradaTurmaID" required>
									</select>
                                </div>
                            </div> 

                            <div class="row">	
                                <div class="col-md-4 ml-auto mr-auto">
									<button type="submit" class="btn btn-info btn-round">Adicionar Aluno</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>  
    </div> 


	<footer>
		<div id="rodape">
			<div class="container">
				<div class="row centralizado">
					<div class="col-md-4">
						<img src="Rodape-Web/prom.jpg" class="img-circle"><br>
						<h6><strong>Desenvolvedores</strong></h6>
						
						<p></span> Alunos da turma de Informática 2A 2017 do CEFET-MG.
						<a href="#">Clique aqui</a> para saber mais.</p>  
					</div>
					<div class="col-md-4">
				    	<img src="Rodape-Web/cefetop.png" class="img-circle"><br>
				    	<h6><strong>Instituição</strong></h6>
				    	<p>Centro Federal de Educação Tecnológica de Minas Gerais. Av. Amazonas 5253 -Nova                   Suíssa - Belo Horizonte - Brasil.</p>
        			</div>
        			<div class="col-md-4">
            			<img src="Rodape-Web/bootstrap.png" class="img-circle"><br>
            			<h6>Recursos Utilizados</h6>
            			<p>
					   	<a href="https://github.com/NinaCris16/Educatio-CEFET-MG">GitHub</a><br>
					   	<a href="http://getbootstrap.com/">Bootstrap</a><br>
					   	</p>
        			</div>
				</div>
			</div>
		</div>
	</footer>

	</body>
</html>