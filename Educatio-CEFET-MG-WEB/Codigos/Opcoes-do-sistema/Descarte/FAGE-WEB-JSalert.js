$(document).ready(function(){
	$('#alerta').modal('show');
});

function mudaPagina(valor){
	if(valor == "novoaluno"){
		document.location.href="../../Entrada/gerencia-web-interface-bibliotecario.php?acao=fazerDescarte";
	}else if(valor == "inicial"){
		//Redireciona para a HomePage do educatio
		document.location.href="../../Entrada/gerencia-web-perfil-bibliotecario.php";
	}
}