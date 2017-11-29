<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Alterar Curso</title>
        <meta charset="utf-8" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
    
        <script type="text/javascript" src="../Opcoes-do-sistema/Manutencao-curso/MAE-web-script.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
        
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
       // header ('Content-type: text/html; charset=ISO-8859-1');

        // Conectando com o servidor MySQL
        $link = mysqli_connect("localhost", "root", "usbw");
        if (!$link){
        //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
        } else {
        //     echo "Conexao efetuada com sucesso!<br/>";
        }
        //Selecionado BD
        $sql = mysqli_select_db($link, 'Educatio');
        //Seleciona os dados dos cursos ativos
        $query = mysqli_query($link, " SELECT * FROM `cursos` WHERE ativo='S' ORDER BY idDepto ASC, nome ASC, horasTotal ASC, modalidade ASC");
    ?>
		
		
  
	<div class="wrapper">
            
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                        
                            <h2 class="text-center">Altera&ccedil;&atilde;o de Curso</h2>
                            
                            <form class="contact-form" action="../Opcoes-do-sistema/Manutencao-curso/MAE-Web-ManutencaoCurso-Altera2.php" method="POST">
                                <div class="row">
								
                                    <select required="required" class="form-control" id="selectParaAlterarCurso" name="selectParaAlterarCurso[]">
                                        <option value="">Selecione o curso que deseja alterar&nbsp;</option>
                                        <!-- Usando os dados do BD para fazer o select com os cursos ativos -->
                                        <?php while($curso = mysqli_fetch_array($query)) { ?>
                                        <option name="selectParaAlterarCurso[]" value="<?php echo $curso['id'] ?>">
                                        <?php echo $curso['idDepto']." - ".$curso['nome']." - ".$curso['horasTotal']." - ".$curso['modalidade'] ?></option><?php } ?>
                                    </select><span class="required"> </span><br><br>
                                    
                                    <div class="col-md-4 ml-auto mr-auto">
                                        <button type="submit" id="botaoExcluirCurso" class="btn btn-info">Alterar curso</button>
                                    </div>
            
                                </div> 
             
                            </form>
                        </div>
                    </div>
                </div>
            
        </div>	
  </body>
</html>