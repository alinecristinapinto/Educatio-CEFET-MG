<html>
    <head>
        <title>Remover Curso</title>
        <meta charset="utf-8" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        
        <script type="text/javascript" src="js/MAE-web-script.js"></script>
        
        <style type="text/css">
        .text-center{
           font-family: 'Abel', sans-serif;
           color: #d8ac29;
        }
        .fonteTexto{
           font-family: 'Inconsolata', monospace;
           font-size: 16px;
        }
        .btn-info {
          background-color: #162e87;
          border-color: #162e87;
          color: #FFFFFF;
          opacity: 1;
          filter: alpha(opacity=100);
        }
        .btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .show > .btn-info.dropdown-toggle {
          background-color: #11277a;
          color: #FFFFFF;
          border-color: #11277a;
        }
        </style>
        
    </head>
    <body>
		
		<?php
      header ('Content-type: text/html; charset=ISO-8859-1');
      
			//Seta as strings de acordo com seus respectivos inputs
			$StringNovoIdDepto = $_POST["NovoIdDepto"];
			$StringNovoNome = $_POST["NovoNome"];
			$StringNovoHorasTotal = $_POST["NovoHorasTotal"];
			$StringNovoModalidade = $_POST["NovoModalidade"];

			$StringIdDepto = $_POST["idDepto"];
			$StringNome = $_POST["nome"];
			$StringHorasTotal = $_POST["horasTotal"];
			$StringModalidade = $_POST["modalidade"];

			// Cria conexão
			$conn = new mysqli("localhost", "root", "","educatio");
			// Checa conexão
			if ($conn->connect_error) {
				die("Conecção falhou: " . $conn->connect_error);
			}

			$sqlSELECT = "SELECT `id` FROM `cursos` WHERE idDepto = '$StringIdDepto' AND nome = '$StringNome' AND horasTotal = '$StringHorasTotal' AND modalidade = '$StringModalidade'";
			$resultadoSELECT = $conn->query($sqlSELECT);
			while($linha = $resultadoSELECT->fetch_array() ) {
				  
				//atualiza na tabela as variaveis do input
				$sqlUPDATE = "UPDATE `cursos` SET `idDepto` = '$StringNovoIdDepto', `nome` = '$StringNovoNome', `horasTotal` = '$StringNovoHorasTotal', `modalidade` = '$StringNovoModalidade' WHERE `id` = ". $linha["id"];
				$resultadoUPDATE = $conn->query($sqlUPDATE);
			}
		?>

        <!-- exibindo informações dentro de um painel -->
        <div class="wrapper">
      
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            
                            <h2 class="text-center">Altera&ccedil;&atilde;o de Curso</h2>
                            
                             <!-- exibindo informações do novo campus adicionado dentro de um painel -->
                             
                            <div class="contact-form">
                                <h4>Curso alterado com sucesso!</h4>
                                <label class="fonteTexto">ID do departamento:<?php echo " ".$StringNovoIdDepto ?></label><br />
                                <label class="fonteTexto">Nome:<?php echo " ".$StringNovoNome ?></label><br />
                                <label class="fonteTexto">Horas Totais:<?php echo " ".$StringNovoHorasTotal ?></label><br />
                                <label class="fonteTexto">Modalidae:<?php echo " ".$StringNovoModalidade ?></label><br />

                                <div class="col-md-4 ml-auto mr-auto">
                                    <button type="submit" class="btn btn-info btn-round" onClick="window.location.href = 'http://localhost/MAE/manutencaoCurso/MAE-Web-ManutencaoCurso-Altera1.php'">Voltar</button>
                                </div>
                            </div>  
                            
                        </div>
                    </div>
                </div>
            
        </div>
    </body>
</html>
