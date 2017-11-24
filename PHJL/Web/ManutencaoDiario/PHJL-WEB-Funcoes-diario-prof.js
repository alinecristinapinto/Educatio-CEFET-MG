function voltaPagina(pagina){
	document.location.href= pagina +".php";
}

function insereConteudo(id, numeroBim){
	document.querySelector("#" +id).innerHTML = "<td class = 'fonteTexto'><div class = 'contact-form'><label class='fonteTexto'>Nome</label><div class = 'input-group'><input type = 'text' class='form-control' placeholder='Nome do Conte&uacute;do' name = 'entradaConteudo" +numeroBim +"' id = 'entradaConteudo" +numeroBim +"ID' required></div> <label class='fonteTexto'>Data</label> <div required class = 'input-group'><input type = 'date' class='form-control' name = 'entradaDataConteudo" +numeroBim +"' id = 'entradaDataConteudo" +numeroBim +"ID'></div><button id = 'botaoAdicionaID' class='btn btn-info btn-round' onclick = 'checaInputs(\"conteudo\",entradaConteudo" +numeroBim +"ID, " +numeroBim +", entradaDataConteudo" +numeroBim +"ID)'> Adicionar </button></div><br></td>";
	document.querySelector("#" +id).onclick = null;
}

function adicionaConteudoBD(id, numeroBim, dataid){
	var nomeConteudo = id.value;
	var idNovoConteudo = "novoConteudoBim" +numeroBim;
	var valorData = dataid.value;
	$("#entradaConteudo" +numeroBim +"ID").remove();
	$("#botaoAdicionaID").remove();
	$("#" +idNovoConteudo).remove();
	
	if (nomeConteudo.length != 0) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.querySelector("#DIVbim" +numeroBim +"ID").innerHTML += this.responseText;
			}
		};
		xmlhttp.open("GET", "PHJL-WEB-Insercao-de-conteudo-no-BD.php?conteudo=" +nomeConteudo +"&etapa=" +numeroBim +"&data=" +valorData, true);
		xmlhttp.send();
	}

}

function mostraConteudo(conteudo){
	location.href = "PHJL-WEB-Mostrar-conteudo?conteudo=" +conteudo;
}

function checaInputs(ValorChecado, id, numeroBim, dataid){
	if(ValorChecado == "conteudo"){
		if(!document.querySelector('#entradaConteudo' +numeroBim +'ID').checkValidity() || !document.querySelector('#entradaDataConteudo' +numeroBim +'ID').checkValidity()){
			document.querySelector('#entradaConteudo' +numeroBim +'ID').reportValidity();
			document.querySelector('#entradaDataConteudo' +numeroBim +'ID').reportValidity();
		} else {
			adicionaConteudoBD(id, numeroBim, dataid);
		}
	}
}