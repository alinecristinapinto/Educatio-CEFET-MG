function voltarParaPaginaInsercaoCurso(){
    location.href = "MAE-Web-ManutencaoCurso-Inclui1.php";
}

function voltarParaPaginaExclusaoCurso(){
    location.href = "MAE-Web-ManutencaoCurso-Deleta1.php";
}

function voltarParaPaginaAlteraCurso(){
    location.href = "MAE-Web-ManutencaoCurso-Altera1.php";
}

/*
function irParaPaginaExclusaoCampusComDepartamentos(){
    location.href = "JHJ-web-remover-campus-3-exclusao-com-departamentos.php";
}
*/

$(document).ready( function(){
	$("#alertaSelecioneCurso").hide();
    $("#alertaConfirmaExclusao").hide();
    $("#botaoExcluirCurso").click(function() {
    	if ($('#selectParaExcluirCurso').val() == ''){
    		$("#alertaSelecioneCurso").show();
    	} else {
        	$("#alertaConfirmaExclusao").show();
        }
    });
});


