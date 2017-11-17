function mudaPagina(valor){
	if(valor == "novoaluno"){
		document.location.href="PHJL-WEB-Formulario-de-insercao-de-aluno.php";
	}else if(valor == "inicial"){
		//Redireciona para a HomePage do educatio
		//document.location.href="";
	}else if(valor == "alteraraluno"){
		document.location.href="PHJL-WEB-Pesquisa-alterar-aluno.php";
	}else if(valor == "deletaraluno"){
		document.location.href="PHJL-WEB-Pesquisa-deletar-aluno.php";
	}
}