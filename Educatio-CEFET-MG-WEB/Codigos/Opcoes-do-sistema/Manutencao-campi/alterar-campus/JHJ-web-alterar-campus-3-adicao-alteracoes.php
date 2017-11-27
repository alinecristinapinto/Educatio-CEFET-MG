<!DOCTYPE html>
<html>
    <head>
        <title>Alterar Campus</title>
        <meta charset="utf-8">
        
        <!-- CSS do Bootstrap -->
        <link href="../../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

        <!-- CSS do grupo -->
        <link href="../JHJ-web-estilos.css" rel="stylesheet"/>

        <!-- Arquivos js -->
        <script src="../../../../Estaticos/Bootstrap/js/popper.js"></script>
        <script src="../../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="../../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- <script src="js/JHJ-web-script-alterar-campus.js" type="text/javascript"></script> -->

        <!-- Fontes e icones -->
        <link href="../../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">

        <script type="text/javascript">
            function voltarParaPaginaAlteracaoCampus(){
                location.href = "../../../Entrada/gerencia-web-interface-coordenador.php?acao=alterarCampus";
            }
        </script>
    </head>
    <body>
      <div class="wrapper">         
        <!-- <div class="section landing-section"> -->
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h2 class="text-center">ALTERAÇÃO DE CAMPUS</h2>
                        <?php
                			$caixaSelecao = $_POST["checkboxParaAlterarCampus"];
                			$intI = 0;
                			foreach($caixaSelecao as $_valor){
                		    	if($caixaSelecao[$intI] == 'Nome'){
                					$strVet[0] = $caixaSelecao[$intI];		    		
                		    	} else if ($caixaSelecao[$intI] == 'Cidade'){
                					$strVet[1] = $caixaSelecao[$intI];		    		
                		    	} else if ($caixaSelecao[$intI] == 'UF'){
                					$strVet[2] = $caixaSelecao[$intI];		    		
                		    	}  
                		    	$intI++;
                			}

                			if (!isset($strVet[0])){
                				$strVet[0] = '';
                			} 
                			if (!isset($strVet[1])){
                				$strVet[1] = '';
                			} 
                			if (!isset($strVet[2])){
                				$strVet[2] = '';
                			} 
                			
                			echo "<form class='contact-form' action='JHJ-web-alterar-campus-4-alteracao-efetuada.php' method='POST'>";
                			if($strVet[0] == 'Nome'){
                				echo "
                                <div class='col-md-6'>
                                    <label class='fonteTexto'>ALTERAR NOME:</label>
                                    <div class='input-group'>
                                        <span class='input-group-addon'>
                                            <i class='nc-icon nc-check-2'></i>
                                        </span>
                                        <input type='text' class='form-control' name='nomeCampus' placeholder='Nome do Campus' required='required'>
                                    </div>
                                </div>";
                			} 
                			if($strVet[1] == 'Cidade'){
                                echo "
                                <div class='col-md-6'>
                                    <label class='fonteTexto'>ALTERAR CIDADE:</label>
                                    <div class='input-group'>
                                        <span class='input-group-addon'>
                                            <i class='nc-icon nc-pin-3'></i>
                                        </span>
                                        <input type='text' class='form-control' name='cidadeCampus' placeholder='Nome da Cidade' required='required'>
                                    </div>
                                </div>";
                			} 
                			if($strVet[2] == 'UF'){
                                echo "
                                <div class='col-md-6'>
                                    <label class='fonteTexto'>ALTERAR UF:</label>
                                    <div class='input-group'>
                                        <span class='input-group-addon'>
                                            <i class='nc-icon nc-world-2'></i>
                                        </span>
                                        <input type='text' class='form-control' name='ufCampus' placeholder='UF' required='required'>
                                    </div>
                                </div>";
                			} 
                			echo "
                            <div class='row'>
                                <div style='float: left;' class='col-md-4 ml-auto mr-auto'>
                                    <button style='margin-left: 155px;' type='submit' class='btn btn-info btn-round'>ALTERAR!</button>
                                </div>
                                <div style='float: left;' class='col-md-4 ml-auto mr-auto'>
                                    <button style='margin-left: -105px;' type='button' class='btn btn-info btn-round' onClick='voltarParaPaginaAlteracaoCampus()'>VOLTAR PARA O INÍCIO</button>
                                </div>
                            </div>
                            </form>";
                		?>
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </body>
</html>