$(document).ready(function(){
	$('#alerta').modal('show');
});

function mudaPagina(valor){
	if(valor == "novoaluno"){
		document.location.href="FAGE-WEB-form.php";
	}else if(valor == "inicial"){
		//Redireciona para a HomePage do educatio
		//document.location.href="";
	}
}