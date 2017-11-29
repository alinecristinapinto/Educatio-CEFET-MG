//Variável global utilizada para deletar atividades
var idAtividadeDeletar = 0;


//Função que substitui o <span> que continha a string "+ Adicionar Atividade" por alguns inputs para que o usuário
//insira os dados da atividade
function insereAtividade(id){
	document.querySelector("#" +id).innerHTML = "<div class = 'contact-form'><label class='fonteTexto'>Nome</label><div class = 'input-group'><input type = 'text' class='form-control' placeholder='Nome da Atividade' " 
	+" name = 'entradaAtividade' id = 'entradaAtividadeID' required></div> <label class='fonteTexto'>Data</label> <div class = 'input-group'><input type = 'date' class='form-control' name = 'entradaDataAtividade'" 
	+" id = 'entradaDataAtividadeID' required> </div> <label class='fonteTexto'>Valor</label> <div class = 'input-group'> <input type='number' class='form-control' placeholder='0,00' name = 'entradaValorAtividade'" 
	+" id = 'entradaValorAtividadeID' step='0.01' min = '0' required></div> <button id = 'botaoAdicionaID' class='btn btn-info btn-round'" 
	+" onclick = 'checaInputs(\"insereatividade\", \"null\")'> Adicionar </button></div><br>";
	document.querySelector("#" +id).onclick = null;
}

function adicionaAtividadeBD(id, dataid, valorid){
	var nomeAtividade = id.value;
	var idNovaAtividade = "novaAtividadeID";
	var valorData = dataid.value;
	var valorValor = valorid.value;
	
	$("#entradaAtividadeID").remove();
	$("#entradaDataAtividadeID").remove();
	$("#entradaValorAtividadeID").remove();
	$("#botaoAdicionaID").remove();
	$("#novaAtividadeID").remove();
	$("#trNovaAtividadeID").remove();
	
	if (nomeAtividade.length != 0) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.querySelector("#DIVatividadesID").innerHTML += this.responseText;
			}
		};
		xmlhttp.open("GET", "PHJL-WEB-Insercao-de-atividade-no-BD.php?atividade=" +nomeAtividade +"&data=" +valorData +"&valor=" +valorValor, true);
		xmlhttp.send();
	}

}

//Função que substitui o <h4> que continha a string "Conteúdo : X (ícone) (ícone)" por alguns inputs para que o
//usuário digite o dados que quiser alterar desse conteudo
function alteraConteudo(nomeAntigo, dataAntiga, maxEtapas, etapaAntiga){
	document.querySelector("#H4ConteudoID").innerHTML = "<div class = 'contact-form'><label class='fonteTexto'>Nome do Conte&uacutedo</label><div class = 'input-group'><input required type = 'text' class='form-control' placeholder='Nome do Conte&uacute;do' value='" 
	+nomeAntigo +"' name = 'entradaConteudo' id = 'entradaConteudoID'></div><label class='fonteTexto'>Data</label><div class = 'input-group'> <input required type = 'date' class='form-control' value='" +dataAntiga 
	+"' name = 'entradaDataConteudo' id = 'entradaDataConteudoID'></div> <label class='fonteTexto'>Etapa</label><div class = 'input-group'><input required type='number' class='form-control' name = 'entradaEtapaConteudo'" 
	+" id = 'entradaEtapaConteudoID' value='" +etapaAntiga +"' min = '1' max ='" +maxEtapas +"' ></div><button id = 'botaoAlteraID'" 
	+ " class='btn btn-info btn-round' onclick = 'checaInputs(\"conteudo\", null)'> Salvar </button></div><br>";
	document.querySelector("#H4ConteudoID").onclick = null;
}

function checaInputs(ValorChecado, id){
	if(ValorChecado == "conteudo"){
		if(!document.querySelector('#entradaConteudoID').checkValidity() || !document.querySelector('#entradaDataConteudoID').checkValidity() ||
		   !document.querySelector('#entradaEtapaConteudoID').checkValidity()){
			document.querySelector('#entradaConteudoID').reportValidity();
			document.querySelector('#entradaDataConteudoID').reportValidity();
			document.querySelector('#entradaEtapaConteudoID').reportValidity();
		} else {
			alteraConteudoBD();
		}
	} else if(ValorChecado == "alteraatividade"){
		if(!document.querySelector('#entradaAtividadeID' +id).checkValidity() || !document.querySelector('#entradaDataAtividadeID' +id).checkValidity() ||
		   !document.querySelector('#entradaValorAtividadeID' +id).checkValidity()){
			document.querySelector('#entradaAtividadeID' +id).reportValidity();
			document.querySelector('#entradaDataAtividadeID' +id).reportValidity();
			document.querySelector('#entradaValorAtividadeID' +id).reportValidity();
		} else {
			alteraAtividadeBD(id);
		}
	} else if(ValorChecado == "insereatividade"){
		if(!document.querySelector('#entradaAtividadeID').checkValidity() || !document.querySelector('#entradaDataAtividadeID').checkValidity() ||
		   !document.querySelector('#entradaValorAtividadeID').checkValidity()){
			document.querySelector('#entradaAtividadeID').reportValidity();
			document.querySelector('#entradaDataAtividadeID').reportValidity();
			document.querySelector('#entradaValorAtividadeID').reportValidity();
		} else {
			adicionaAtividadeBD(entradaAtividadeID, entradaDataAtividadeID, entradaValorAtividadeID);
		}
	}
}

function alteraConteudoBD(){
	
	var nomeConteudo = document.querySelector("#entradaConteudoID").value;
	var valorData = document.querySelector("#entradaDataConteudoID").value;
	var idEtapa = document.querySelector("#entradaEtapaConteudoID").value;
	
	if (nomeConteudo.length != 0) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//this.responseText é o valor retornado pela pagina "PHJL-WEB-Alteracao-de-conteudo.php"
				if (this.responseText == "SUCESSO") {
					$('#alertaSUCESSO').modal('show');
				} else {
					$('#alertaERRO').modal('show');
				}
			}
		};
		xmlhttp.open("GET", "PHJL-WEB-Alteracao-de-conteudo.php?conteudo=" +nomeConteudo +"&data=" +valorData +"&idetapa=" +idEtapa, true);
		xmlhttp.send();
		
		
	}
	
	
}

//Caso o modal de SUCESSO seja fechado, recarrega a página para que ela seja atualizada de acordo com os valores alterados
$('#alertaSUCESSO').on('hidden.bs.modal', function () {
	location.reload();
})

//Caso o modal de ERRO seja fechado, recarrega a página para que ela seja atualizada de acordo com os valores alterados
$('#alertaERRO').on('hidden.bs.modal', function () {
	location.reload();
})

//Caso o modal de AlterarAtividadeSUCESSO seja fechado, recarrega a página para que ela seja atualizada de acordo com os valores alterados
$('#alertaAlteraAtividadeSUCESSO').on('hidden.bs.modal', function () {
	location.reload();
})

//Caso o modal de AlterarAtividadeERRO seja fechado, recarrega a página para que ela seja atualizada de acordo com os valores alterados
$('#alertaAlteraAtividadeERRO').on('hidden.bs.modal', function () {
	location.reload();
})

$('#alertaDeletarAtividadeSUCESSO').on('hidden.bs.modal', function () {
	location.reload();
})

$('#alertaDeletarAtividadeERRO').on('hidden.bs.modal', function () {
	location.reload();
})

$('#alertaDeletarSUCESSO').on('hidden.bs.modal', function () {
	document.location.href = "PHJL-WEB-Diario-prof.php";
})

$('#alertaDeletarERRO').on('hidden.bs.modal', function () {
	document.location.href = "PHJL-WEB-Diario-prof.php";
})


function deletaConteudo(){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//this.responseText é o valor retornado pela pagina "PHJL-WEB-Deletar-conteudo.php"
			if (this.responseText == "SUCESSO") {
				$('#alertaDeletarSUCESSO').modal('show');
			} else {
				$('#alertaDeletarERRO').modal('show');
			}
		}
	};
	xmlhttp.open("GET", "PHJL-WEB-Deletar-conteudo.php", true);
	xmlhttp.send();
}

//Quando a função abaixo é chamada, ela pega o elemento cujo id for passado por parâmetro, no caso o id de um <tr> e então
//cria uma string com um <td> e alguns inputs e coloca essa string dentro do <tr>
function alteraAtividade(id, nomeAntigo, dataAntiga, valorAntigo){
	document.querySelector("#" +id).innerHTML = "<td colspan = '4'><div class = 'contact-form'><label class='fonteTexto'>Nome da Atividade</label><div class = 'input-group'><input required type = 'text' class='form-control' placeholder='Nome da Atividade' value='" 
	+nomeAntigo +"' name = 'entradaAtividade' id = 'entradaAtividadeID" +id +"'></div> <label class='fonteTexto'>Data</label><div class = 'input-group'><input required type = 'date' class='form-control' value='" +dataAntiga 
	+"' name = 'entradaDataAtividade' id = 'entradaDataAtividadeID" +id +"'></div> <label class='fonteTexto'>Valor</label><div class = 'input-group'><input required type='number' class='form-control' name = 'entradaValorAtividade'" 
	+" id = 'entradaValorAtividadeID" +id +"' value='" +valorAntigo +"' step='0.01' min = '0' ></div> <button id = 'botaoAlteraID'" 
	+ " class='btn btn-info btn-round' onclick = 'checaInputs(\"alteraatividade\", \"" +id +"\")'> Salvar </button></div></td>";
}

function alteraAtividadeBD(id){
	var idAtividade = id.substring(2, id.length);
	var nomeAtividade = document.querySelector("#entradaAtividadeID" +id).value;
	var valorData = document.querySelector("#entradaDataAtividadeID" +id).value;
	var Valor = document.querySelector("#entradaValorAtividadeID" +id).value;
	
	if (nomeAtividade.length != 0) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//this.responseText é o valor retornado pela pagina "PHJL-WEB-Alteracao-de-atividade.php"
				if (this.responseText == "SUCESSO") {
					$('#alertaAlteraAtividadeSUCESSO').modal('show');
				} else {
					$('#alertaAlteraAtividadeERRO').modal('show');
				}
			}
		};
		xmlhttp.open("GET", "PHJL-WEB-Alteracao-de-atividade.php?idatividade=" +idAtividade +"&nomeatividade=" +nomeAtividade +"&data=" +valorData +"&valor=" +Valor, true);
		xmlhttp.send();
		
		
	}
	
	
}

function alertDeletaAtividade(nomeAtividade, idAtividade){
	idAtividadeDeletar = idAtividade;
	document.querySelector('#corpoDoModalDeletarAtividade').innerHTML = '"' +nomeAtividade +'" ?';
	$('#alertaDeletarAtividade').modal('show');
}

function deletaAtividadeBD(){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//this.responseText é o valor retornado pela pagina "PHJL-WEB-Deletar-atividade.php"
				///*
				if (this.responseText == "SUCESSO") {
					$('#alertaDeletarAtividade').modal('hide');
					$('#alertaDeletarAtividadeSUCESSO').modal('show');
				} else {
					$('#alertaDeletarAtividade').modal('hide');
					$('#alertaDeletarAtividadeERRO').modal('show');
				}
				//*/
				//alert(this.responseText);
			}
		};
		xmlhttp.open("GET", "PHJL-WEB-Deletar-atividade.php?idatividade=" +idAtividadeDeletar, true);
		xmlhttp.send();
		
}

function alertDeletaConteudo(nomeConteudo){
	document.querySelector('#spanDoModalDeletarConteudo').innerHTML = '"' +nomeConteudo +'" ?';
	$('#alertaDeletarConteudo').modal('show');
}

function voltaPagina(pagina){
	document.location.href= pagina +".php";
}