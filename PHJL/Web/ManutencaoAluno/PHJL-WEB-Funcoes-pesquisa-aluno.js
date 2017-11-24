			var valorFiltro = "";
			var tipoFiltro = "0";
			var tipoInput = "";
			
			function enviaFormulario(valor){
				document.querySelector("#valorCPFID").value = valor;
				document.querySelector("#formulario").submit();
			}
			
			//funcao utilizada para apagar um input
			function Apaga(id){
				document.querySelector("#" +id).value = "";
			}
			
			//funcao utilizada para fazer uma requisicao a pagina ProcuraAlunos.php, onde serao pesquisados os alunos que possuam 'str' em seu nome/cpf, 
			//e alguns dados desses alunos serao devolvidos e mostrados na tabela
			function mostraAlunos() {
				str = document.querySelector("#entradaNomeID").value + document.querySelector("#entradaCPFID").value;
				if(document.querySelector("#entradaNomeID"))
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.querySelector("#tabela").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "PHJL-WEB-Procura-alunos.php?q=" + str + "&tipo=" + tipoInput + "&valorfiltro=" + valorFiltro + "&tipofiltro=" + tipoFiltro, true);
				xmlhttp.send();
			}
			
			function mudaFiltro(tipo, valor){
				valorFiltro = valor;
				tipoFiltro = tipo;
			}
			
			function mudaTipoInput(tipo){
				tipoInput = tipo;
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
				xmlhttp.open("GET", "PHJL-WEB-Retorna-valor-dos-selects-alteracao.php?valor=" + valor + "&id=" +id , true);
				xmlhttp.send();
					
			}