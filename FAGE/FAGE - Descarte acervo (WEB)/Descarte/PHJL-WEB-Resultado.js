$(document).ready(function(){
	$('#alerta').modal('show');
});

function mudaPagina(valor){
	if(valor == "novoaluno"){
		document.location.href="http://localhost/edu/TPFinal/tabela-descarte-html.php";
	}else if(valor == "inicial"){
		//Redireciona para a HomePage do educatio
		//document.location.href="";
	}
}