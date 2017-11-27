function lancaNotasBD(alunos){
	
	//a seguir é criada uma string que passará alguns dados pela url.
	//ao final a string será parecida com : "PHJL-WEB-Lancar-notas-no-BD.php?ID89594318180=6&ID13612887106=2",
	//sendo o número que vem depois de "ID" igual ao idCPF do aluno, e o número que vem depois do "=" igual ao
	//valor digitado nos inputs de nota, logo é a nota deste aluno nesta atividade.
	//No exemplo acima, a aluna Isabele, cujo cpf é 89594318180 recebeu 6 pontos na atividade escolhida,
	//e a aluna Clarisse, cujo cpf é 13612887106 recebeu 2 pontos na atividade escolhida
	var url = "PHJL-WEB-Lancar-notas-no-BD.php?";
	for(i = 0; i < alunos.length; i++){
		url += alunos[i] +"=" +document.querySelector('#' +alunos[i]).value +"&";
	}
	url.slice(0, -1);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//this.responseText é o valor retornado pela pagina "PHJL-WEB-Lancar-notas-no-BD.php"
			///*
			if (this.responseText == "SUCESSO") {
				$('#alertaSUCESSO').modal('show');
			} else {
				$('#alertaERRO').modal('show');
			}
			//*/
			//alert(this.responseText);
		}
	};
	xmlhttp.open("GET", url, true);
	xmlhttp.send();
}

//Caso o modal de SUCESSO seja fechado, redireciona para a pagina mostraConteudos
$('#alertaSUCESSO').on('hidden.bs.modal', function () {
	document.location.href="PHJL-WEB-Mostrar-conteudo.php";
})

//Caso o modal de ERRO seja fechado, redireciona para a pagina mostraConteudos
$('#alertaERRO').on('hidden.bs.modal', function () {
	document.location.href="PHJL-WEB-Mostrar-conteudo.php";
})

function checaInputs(alunos){
	var variavelDeControle = 0;
	for(i = 0; i < alunos.length; i++){
		if(!document.querySelector('#' +alunos[i]).checkValidity()){
			document.querySelector('#' +alunos[i]).reportValidity();
			variavelDeControle = 1;
		}
	}
	if(variavelDeControle == 0){
		lancaNotasBD(alunos);
	}
}

function voltaPagina(pagina){
	document.location.href= pagina +".php";
}