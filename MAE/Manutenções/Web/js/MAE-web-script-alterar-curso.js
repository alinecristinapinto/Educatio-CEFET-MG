$(document).ready( function(){
    $("#alertaSelecioneAlteracaoCurso").hide();
    $("#alertaConfirma").hide();
    $("#botaoSelecionarAlteracoesCurso").click(function() {
        if ($('.checkboxAltera:checked').length == 0){
            $("#alertaSelecioneAlteracaoCurso").show();
        } else {
        	$("#alertaConfirma").show();
        }
    });    
});

function fecharAlerta(){
	$("#alertaSelecioneAlteracaoCurso").hide();
    $("#alertaConfirma").hide();
}

function voltarParaPaginaAlteracaoCampus(){
    location.href = "MAE-Web-ManutencaoCurso-Altera1.php";
}
