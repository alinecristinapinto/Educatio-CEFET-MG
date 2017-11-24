function valida() {
    if ($('#selectParaExcluirCampus').val() == ''){
        return false;
    } else {
        // $("#alertaConfirmaExclusao").modal('show');
        return true;
    }
}

function voltarParaPaginaExclusaoCampus(){
    location.href = "JHJ-web-remover-campus-1.php";
}

function irParaPaginaExclusaoCampusComDepartamentos(){
    location.href = "JHJ-web-remover-campus-3-exclusao-com-departamentos.php";
}
