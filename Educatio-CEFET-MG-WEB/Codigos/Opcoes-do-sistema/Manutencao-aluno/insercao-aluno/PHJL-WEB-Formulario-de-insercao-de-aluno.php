<!DOCTYPE html>
<?php
	//header('content-type: text/html; charset=ISO-8859-1');
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "usbw");
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
		
		<!-- CSS -->       
		<link rel="stylesheet" type="text/css" href="../Opcoes-do-sistema/Manutencao-aluno/insercao-aluno/PHJL-WEB-Estilo-paginas.css">
		
		<!-- Arquivos js -->
		<!-- <script src="../Opcoes-do-sistema/insercao-aluno/PHJL-WEB-Formulario-de-insercao-de-alunos.js?v=2" defer></script> -->

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<base target="_parent">
        <script type="text/javascript">
            function colocaPonto(u){
                if(u == 0){
                    var str = document.querySelector("#entradaCPFID").value;
                
                    if((str.length == 3) || (str.length == 7)){
                    str += ".";
                    document.querySelector("#entradaCPFID").value = str;
                    }else if(str.length == 11){
                    str += "-";
                    document.querySelector("#entradaCPFID").value = str;
                    }
                }
                if(u == 1){
                    var str = document.querySelector("#entradaCEPID").value;
                    if(str.length == 5){
                    str += "-";
                    document.querySelector("#entradaCEPID").value = str;
                    }
                }                               
            }

            //Função para esconder os selects de : Departamento, Curso e Turma
            function escondeSelects(){
                document.querySelector("#entradaDeptoDIVID").style.display = "none";
                
                document.querySelector("#entradaCursoDIVID").style.display = "none";
                
                document.querySelector("#entradaTurmaDIVID").style.display = "none";
            }

            function mostrarSelects(valor, id){
                if(valor == "campi"){
                    //Apaga os valores que estavam anteriormente no select de Departamento
                    var tamanho = document.querySelector("#entradaDeptoID").options.length;
                    for (var i = 0; i <= tamanho; i++) {
                        document.querySelector("#entradaDeptoID").remove(0);
                    }
                    
                    //Chama a função que pega os Departamentos do Campus selecionado e insere no select de Departamento
                    retornaValores("#entradaDeptoID", valor, id);
                    
                    //Mostra o select de Departamento
                    document.querySelector("#entradaDeptoDIVID").style.display = "block";
                
                    //Esconde o select de Curso
                    document.querySelector("#entradaCursoDIVID").style.display = "none";
                    
                    //Esconde o select de Turma
                    document.querySelector("#entradaTurmaDIVID").style.display = "none";
                }else if(valor == "deptos"){
                    //Aqui faço o mesmo que fiz acima, porém substituindo o select de Cursos.
                    //Irá mostrar o select de Curso e esconder o de Turma.
                    var tamanho = document.querySelector("#entradaCursoID").options.length;
                    for (var i = 0; i <= tamanho; i++) {
                        document.querySelector("#entradaCursoID").remove(0);
                    }
                    
                    retornaValores("#entradaCursoID", valor, id);
                    
                    document.querySelector("#entradaCursoDIVID").style.display = "block";
                
                    document.querySelector("#entradaTurmaDIVID").style.display = "none";
                }else if(valor == "cursos"){
                    //Segue o mesmo padrão dos anteriores
                    var tamanho = document.querySelector("#entradaTurmaID").options.length;
                    for (var i = 0; i <= tamanho; i++) {
                        document.querySelector("#entradaTurmaID").remove(0);
                    }
                    
                    retornaValores("#entradaTurmaID", valor, id);
                    
                    document.querySelector("#entradaTurmaDIVID").style.display = "block";
                }
            }

            //Função para pedir o return de uma pagina PHP ( PHJL-WEB-Retorna-valor-dos-selects.php ) e inserí-lo no "inputid" relacionado.
            function retornaValores(inputid, valor, id){
                
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.querySelector(inputid).innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "../Opcoes-do-sistema/Manutencao-aluno/insercao-aluno/PHJL-WEB-Retorna-valor-dos-selects.php?valor=" + valor + "&id=" +id , true);
                xmlhttp.send();
                    
            }
        </script>
	</head>

	<body onload = "escondeSelects()">

    <!-- Essa classe é necessária para que quando o menu fique responsivo ele não sobreponha o formulário -->
    <div class="wrapper">     

      <!--  <div class="section landing-section">-->
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">

                        <h2 class="text-center">CADASTRO DE ALUNO</h2>

                        <form class="contact-form" method = "POST" action = "../Opcoes-do-sistema/Manutencao-aluno/insercao-aluno/PHJL-WEB-Insercao-de-aluno-no-BD.php" id= "formulario" 
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
                                <label class="fonteTexto">N&uacute;mero:</label>
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
	</body>
</html>