function voltarParaPaginaInsersaoCampus(){
    location.href = "JHJ-web-adicionar-campus.html";
}

function voltarParaPaginaExclusaoCampus(){
    location.href = "JHJ-web-remover-campus.php";
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


