function insereConteudo(id, numeroBim, iddisciplina){
	document.querySelector("#" +id).innerHTML = "<input type = 'text' name = 'entradaConteudo" +numeroBim +"' id = 'entradaConteudo" +numeroBim +"ID'> <button id = 'botaoAdicionaID' class='btn btn-info btn-round' onclick = 'adicionaConteudoBD(entradaConteudo" +numeroBim +"ID, " +numeroBim +", " +iddisciplina +")'> Adicionar </button>";
	document.querySelector("#" +id).onclick = null;
}

function adicionaConteudoBD(id, numeroBim, iddisciplina){
	var nomeConteudo = id.value;
	var idNovoConteudo = "novoConteudoBim" +numeroBim;
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
		xmlhttp.open("GET", "PHJL-WEB-Insercao-de-conteudo-no-BD.php?conteudo=" +nomeConteudo +"&etapa=" +numeroBim +"&iddisciplina=" +iddisciplina, true);
		xmlhttp.send();
	}
}