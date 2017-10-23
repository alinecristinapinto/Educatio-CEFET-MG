function voltarParaPaginaInsercaoCampus(){
    location.href = "JHJ-web-adicionar-campus-1.php";
}

function voltarParaPaginaExclusaoCampus(){
    location.href = "JHJ-web-remover-campus-1.php";
}

function irParaPaginaExclusaoCampusComDepartamentos(){
    location.href = "JHJ-web-remover-campus-3-exclusao-com-departamentos.php";
}

$(document).ready( function(){
	$("#alertaSelecioneCampus").hide();
    $("#alertaConfirmaExclusao").hide();
    $("#botaoExcluirCampus").click(function() {
    	if ($('#selectParaExcluirCampus').val() == ''){
    		$("#alertaSelecioneCampus").show();
    	} else {
        	$("#alertaConfirmaExclusao").show();
        }
    });
});


