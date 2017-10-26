			var vet = [0,0,0,0,0,0,0,0,0,0,0];


			function checaNome (){
				if (document.querySelector("#entradaNomeID").value == ""){
					document.querySelector("#entradaNomeID").style.backgroundColor = "#ffebee";
					document.querySelector("#Obrigatorio1").innerText = "*Preenchimento Obrigatório/Formato incorreto";
				}else{
					document.querySelector("#entradaNomeID").style.backgroundColor = "white";
					document.querySelector("#Obrigatorio1").innerText = "";
					vet[0] = 1;
					tes();
					
				}
			}
			
			function checaNascimento(){
				if (document.querySelector("#entradaNascimentoID").value == ""){
					document.querySelector("#entradaNascimentoID").style.backgroundColor = "#ffebee";
					document.querySelector("#Obrigatorio2").innerText = "*Preenchimento Obrigatório/Formato incorreto";
				}else{
					document.querySelector("#entradaNascimentoID").style.backgroundColor = "white";
					document.querySelector("#Obrigatorio2").innerText = "";
					vet[1] = 1;
					tes();				
				}
			}
			
			function checaCPF(){
				var str = document.querySelector("#entradaCPFID").value;
				var padrao = /([0-9]{3}[\.]?){3}[-]?[0-9]{2}/g;
				if(str.match(padrao) != str){
					document.querySelector("#entradaCPFID").style.backgroundColor = "#ffebee";
					document.querySelector("#Obrigatorio3").innerText = "*Preenchimento Obrigatório/Formato incorreto";
				}else{
					document.querySelector("#entradaCPFID").style.backgroundColor = "white";
					document.querySelector("#Obrigatorio3").innerText = "";
					vet[2] = 1;
					tes();
				}
				
			}
			
			function checaLogradouro(){
				if (document.querySelector("#entradaLogradouroID").value == ""){
					document.querySelector("#entradaLogradouroID").style.backgroundColor = "#ffebee";
					document.querySelector("#Obrigatorio4").innerText = "*Preenchimento Obrigatório/Formato incorreto";
				}else{
					document.querySelector("#entradaLogradouroID").style.backgroundColor = "white";
					document.querySelector("#Obrigatorio4").innerText = "";
					vet[3] = 1;
					tes();
				}
			}
			
			function checaNumero(){
				if (document.querySelector("#entradaNumeroID").value == ""){
					document.querySelector("#entradaNumeroID").style.backgroundColor = "#ffebee";
					document.querySelector("#Obrigatorio5").innerText = "*Preenchimento Obrigatório/Formato incorreto";
				}else{
					document.querySelector("#entradaNumeroID").style.backgroundColor = "white";
					document.querySelector("#Obrigatorio5").innerText = "";
					vet[4] = 1;
					tes();
				}
			}
			
			function checaComplemento(){
				if (document.querySelector("#entradaComplementoID").value == ""){
					document.querySelector("#entradaComplementoID").style.backgroundColor = "#ffebee";
					document.querySelector("#Obrigatorio6").innerText = "*Preenchimento Obrigatório/Formato incorreto";
				}else{
					document.querySelector("#entradaComplementoID").style.backgroundColor = "white";
					document.querySelector("#Obrigatorio6").innerText = "";
					vet[5] = 1;
					tes();
				}
			}
			
			function checaBairro(){
				if (document.querySelector("#entradaBairroID").value == ""){
					document.querySelector("#entradaBairroID").style.backgroundColor = "#ffebee";
					document.querySelector("#Obrigatorio7").innerText = "*Preenchimento Obrigatório/Formato incorreto";
				}else{
					document.querySelector("#entradaBairroID").style.backgroundColor = "white";
					document.querySelector("#Obrigatorio7").innerText = "";
					vet[6] = 1;
					tes();
				}
			}
			
			function checaCidade(){
				if (document.querySelector("#entradaCidadeID").value == ""){
					document.querySelector("#entradaCidadeID").style.backgroundColor = "#ffebee";
					document.querySelector("#Obrigatorio8").innerText = "*Preenchimento Obrigatório/Formato incorreto";
				}else{
					document.querySelector("#entradaCidadeID").style.backgroundColor = "white";
					document.querySelector("#Obrigatorio8").innerText = "";
					vet[7] = 1;
					tes();
				}
			}
			
			
			function checaCEP(){
				var str = document.querySelector("#entradaCEPID").value;
				var padrao = /[0-9]{5}[-]?[0-9]{3}/g;
				if(str.match(padrao) != str){
					document.querySelector("#entradaCEPID").style.backgroundColor = "#ffebee";
					document.querySelector("#Obrigatorio9").innerText = "*Preenchimento Obrigatório/Formato incorreto";
				}else{
					document.querySelector("#entradaCEPID").style.backgroundColor = "white";
					document.querySelector("#Obrigatorio9").innerText = "";
					vet[8] = 1;
					tes();
				}
			}
			
			function checaUF(){
				var str = document.querySelector("#entradaUFID").value;
				var padrao = /[A-Z]{2}/g;
				if(str.match(padrao) != str){
					document.querySelector("#entradaUFID").style.backgroundColor = "#ffebee";
					document.querySelector("#Obrigatorio10").innerText = "*Preenchimento Obrigatório/Formato incorreto";
				}else{
					document.querySelector("#entradaUFID").style.backgroundColor = "white";
					document.querySelector("#Obrigatorio10").innerText = "";
					vet[9] = 1;
					tes();
				}
			}
			
			function checaEmail(){
				if (document.querySelector("#entradaEmailID").value == ""){
					document.querySelector("#entradaEmailID").style.backgroundColor = "#ffebee";
					document.querySelector("#Obrigatorio11").innerText = "*Preenchimento Obrigatório/Formato incorreto";
				}else{
					document.querySelector("#entradaEmailID").style.backgroundColor = "white";
					document.querySelector("#Obrigatorio11").innerText = "";
					vet[10] = 1;
					tes();
				}
			}
			
			//funcao que fara com que o BD receba os dados abaixo filtrados (sem "." ou "-")
			function filtraDados(){
			
				//CPF
				var str = document.querySelector("#entradaCPFID").value;
				document.querySelector("#entradaCPFID").value = document.querySelector("#entradaCPFID").value.replace(/\./g, "");
				document.querySelector("#entradaCPFID").value = document.querySelector("#entradaCPFID").value.replace(/\-/g, "");
				
				//CEP
				str = document.querySelector("#entradaCEPID").value;
				document.querySelector("#entradaCEPID").value = document.querySelector("#entradaCEPID").value.replace(/\-/g, "");
			}
			
			
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

			function tes(){
				var n = 0;
				for (var i = 0; i < 11; i++) {
					n += vet[i];
				}
				//alert(n);
				if(n == 11){
					alert(n);
					//document.querySelector("#dica-enviar").innerText = "";
					document.querySelector("#saidaBotaoID").disabled = false;
				}
			}