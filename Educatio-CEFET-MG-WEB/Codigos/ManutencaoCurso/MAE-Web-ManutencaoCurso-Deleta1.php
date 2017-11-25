<!DOCTYPE html>
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

            // Conectando com o servidor MySQL
            $link = mysqli_connect("localhost", "root", "");
            if (!$link){
            //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
            } else {
            //     echo "Conexao efetuada com sucesso!<br/>";
            }
            //Selecionado BD
            $sql = mysqli_select_db($link, 'Educatio');
            //Seleciona os dados dos cursos ativos
            $query = mysqli_query($link, " SELECT id, idDepto, nome, horasTotal, modalidade FROM cursos WHERE ativo='S' ");
        ?>
        
        <div class="wrapper">
            
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                        
                            <h2 class="text-center">Exclus&atilde;o de Curso</h2>
                            
                            <form class="contact-form" action="../ManutencaoCurso/MAE-Web-ManutencaoCurso-Deleta2.php" method="POST">
                                <div class="row">
                                
                                    <select required="required" class="form-control" id="selectParaExcluirCurso" name="selectParaExcluirCurso[]">
                                        <option value="">Selecione o curso que deseja excluir&nbsp;</option>
                                        <!-- Usando os dados do BD para fazer o select com os cursos ativos -->
                                        <?php while($curso = mysqli_fetch_array($query)) { ?>
                                        <option name="selectParaExcluirCurso[]" value="<?php echo $curso['id'] ?>">
                                        <?php echo $curso['idDepto']." - ".$curso['nome']."-".$curso['horasTotal']."-".$curso['modalidade'] ?></option><?php } ?>
                                    </select><span class="required"> </span><br><br>
                                    
                                    <div class="col-md-4 ml-auto mr-auto">
                                        <button type="button" id="botaoExcluirCurso" class="btn btn-info">Excluir curso</button>
                                    </div>
            
                                </div> 
                                
                                <!-- alerta para confirmar a exclusão -->
                                <div id="alertaConfirmaExclusao" class="modal in" style="display: block;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 style="color: #c42323;" class="modal-title">ALERTA</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Deseja <strong>excluir</strong> o curso selecionado?</p>
                                                <div class="row">
                                                    <div class="col-12-xs text-center">
                                                        <input type="submit" class="btn btn-success btn-md" value="Prosseguir"/>
                                                        <input type="button" class="btn btn-danger btn-md" value="Cancelar" onClick="voltarParaPaginaExclusaoCurso()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal --> 
                                <!--  fim do alerta para confirmar a exclusão-->
                    
                                <!-- alerta para verificar se o usuario selecionou um curso -->
                                <div id="alertaSelecioneCurso" class="modal in" style="display: block;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 style="color: #c42323;" class="modal-title">ALERTA</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Selecione um curso!</strong></p>
                                                <div class="row">
                                                    <div class="col-12-xs text-center">
                                                        <input type="button" class="btn btn-primary" value="OK" onClick="voltarParaPaginaExclusaoCurso()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal --> 
                                <!--  fim do alerta para verificar se o usuario selecionou um curso -->       
                            </form>
                        </div>
                    </div>
                </div>
            
        </div>	
    </body>
</html>
