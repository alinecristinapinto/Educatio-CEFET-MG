$(document).ready(function(){
	$('#alerta').modal('show');
});

function mudaPagina(valor){
	if(valor == "novoaluno"){
		//document.location.href="../../Entrada/gerencia-web-perfil-coordenador.php";
	}else if(valor == "inicial"){
		//Redireciona para a HomePage do educatio
		document.location.href="../../Entrada/gerencia-web-perfil-coordenador.php";
	}else if(valor == "alteraraluno"){
		document.location.href="PHJL-WEB-Pesquisa-alterar-aluno.php";
	}else if(valor == "deletaraluno"){
		document.location.href="../../Entrada/gerencia-web-interface-coordenador.php?acao=deletarAluno";
	}
}