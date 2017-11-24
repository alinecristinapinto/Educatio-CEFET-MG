<!DOCTYPE html>
<html>
    <head>
        <title>Adicionar Curso</title>
		<meta charset="utf-8" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
    
        <!-- CSS do Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet"/>
    
        <!-- Arquivos js -->
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    
        <!-- Fontes e icones -->
        <link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
        <link href="css/nucleo-icons.css" rel="stylesheet">
        
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
			$strIdDepartamento = $_POST["idDepartamento"];
			$strNomeCurso = $_POST["nomeCurso"];
			$strHorasTotal = $_POST["horasTotal"];
			$strModalidade = $_POST["modalidade"];

            // Conectando com o servidor MySQL
            $link = mysqli_connect("localhost", "root", "");
            if (!$link){
            //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
            } else {
            //     echo "Conexao efetuada com sucesso!<br/>";
            }
            //Selecionado BD
            $sql = mysqli_select_db($link, 'Educatio');

            //Inserindo dados na tabela cursos
            $sql = "INSERT INTO cursos (idDepto, nome, horasTotal, modalidade, ativo) VALUES ('$strIdDepartamento', '$strNomeCurso', '$strHorasTotal', '$strModalidade', 'S')";
			
            if (mysqli_query($link, $sql)) {
            //     echo "Curso adicionado com sucesso!";
            }else{
            //     echo "Erro ao adicionar curso: ".$sql."<br/>".$link->error."<br/>";
            }
        ?>
        
        <div class="wrapper">
            <div class="section landing-sectionv">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            
                            <h2 class="text-center">Inclusão de Curso</h2>
                            
                             <!-- exibindo informações do novo campus adicionado dentro de um painel -->
                             
                            <div class="contact-form">
                                <h4>Curso adicionado com sucesso!</h4>
                                <label class="fonteTexto">ID do departamento:<?php echo " ".$strIdDepartamento ?></label><br />
                                <label class="fonteTexto">Nome:<?php echo " ".$strNomeCurso ?></label><br />
                                <label class="fonteTexto">Horas Totais:<?php echo " ".$strHorasTotal ?></label><br />
                                <label class="fonteTexto">Modalidae:<?php echo " ".$strModalidade ?></label><br />

                                <div class="col-md-4 ml-auto mr-auto">
                                    <button type="submit" class="btn btn-info btn-round" onClick="window.location.href = 'http://localhost/MAE/manutencaoCurso/MAE-Web-ManutencaoCurso-Inclui1.php'">Voltar</button>
                                </div>
                            </div>  
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>	                    
    </body>
</html>