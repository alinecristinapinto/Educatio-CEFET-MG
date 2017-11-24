function valida() {
    if ($('.checkboxAltera:checked').length == 0){
        $("#alertaSelecioneAlteracaoCampus").modal('show');
        return false;
    } else {
        return true;
    }
}

function fecharAlerta(){
	$("#alertaSelecioneAlteracaoCampus").modal('hide');
}

function voltarParaPaginaAlteracaoCampus(){
    location.href = "JHJ-web-alterar-campus-1.php";
}

function irParaPaginaAdicaoAlteracoesCampus(){
    location.href = "JHJ-web-alterar-campus-3-adicao-alteracoes.php";
}

