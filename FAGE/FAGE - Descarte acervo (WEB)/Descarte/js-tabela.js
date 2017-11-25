			function enviaFormulario(valor,valor2){
			
				document.querySelector("#entradaNomeID").value = valor2;
				document.querySelector("#valorCPFID").value = valor;
			}
			
			
			
			
			//funcao utilizada para apagar um input
			function Apaga(id){
				document.querySelector("#" +id).value = "";
			}
			
			//funcao utilizada para fazer uma requisicao a pagina ProcuraAlunos.php, esta que devolvera alguns dados de TODOS os alunos e estes dados 
			//serao mostrados na tabela
			function escreveNomes(str){
				if (str.length == 0){
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("tabela").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET", "tabela-descarte.php?q=mostrar", true);
					xmlhttp.send();
				}
			}''
			
			//funcao utilizada para fazer uma requisicao a pagina ProcuraAlunos.php, onde serao pesquisados os alunos que possuam 'str' em seu nome/cpf, 
			//e alguns dados desses alunos serao devolvidos e mostrados na tabela
			function mostraAlunos(str, tipo) {
				str = str.toString();
				if (str.length == 0) { 
					escreveNomes(str);
					return;
				} else {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("tabela").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET", "tabela-descarte.php?q=" + str + "&tipo=" + tipo, true);
					xmlhttp.send();
				}
			}