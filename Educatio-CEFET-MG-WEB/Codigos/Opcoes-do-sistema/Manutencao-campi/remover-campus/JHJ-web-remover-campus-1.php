<!DOCTYPE html>
<html>
    <head>
        <title>Remover Campus</title>
        <meta charset="utf-8">
        
        <!-- CSS do Bootstrap -->

        <!-- CSS do grupo -->
        <link href="../Opcoes-do-sistema/Manutencao-campi/JHJ-web-estilos.css" rel="stylesheet"/>
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
        </style>

        <!-- Arquivos js -->
        <!-- <script src="../Opcoes-do-sistema/Manutencao-campi/JHJ-web-script-remover-campus.js" type="text/javascript"></script> -->

        <!-- Fontes e icones -->

        <script type="text/javascript">
            function voltarParaPaginaExclusaoCampus(){
                location.href = "../../../Entrada/gerencia-web-interface-coordenador.php?acao=removerCampus";
            }
        </script>
    </head>
    <body>
        <div class="wrapper">         
            <!-- <div class="section landing-section"> -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <h2 class="text-center">EXCLUSÃO DE CAMPUS</h2>
                            <?php
                                // Conectando com o servidor MySQL
                                $link = mysqli_connect("localhost", "root", "usbw");
                                if (!$link){
                                //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
                                } else {
                                //     echo "Conexao efetuada com sucesso!<br/>";
                                }
                                //Selecionado BD
                                $sql = mysqli_select_db($link, 'Educatio');
                                //Seleciona os dados dos campus ativos
                                $query = mysqli_query($link, " SELECT id, nome, cidade, UF FROM campi WHERE ativo='S' ");
                            ?>

                            <form class="contact-form" action="../Opcoes-do-sistema/Manutencao-campi/remover-campus/JHJ-web-remover-campus-2.php" method="POST" onsubmit="return valida();">
                                <div class="row">
                                    <label class="fonteTexto">SELECIONE UM CAMPUS PARA REMOVER: </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-simple-remove"></i>
                                        </span>
                                        <select class="form-control" required="required" name="selectParaExcluirCampus[]" id="selectParaExcluirCampus">
                                            <option value="">Nenhum campus selecionado</option>
                                            <!-- Usando os dados do BD para fazer o select com os campus ativos -->
                                            <?php while($campus = mysqli_fetch_array($query)) { ?>
                                            <option name="selectParaExcluirCampus[]" value="<?php echo $campus['id'] ?>">
                                            <?php echo $campus['nome']." - ".$campus['cidade']."-".$campus['UF'] ?></option><?php } ?>
                                        </select>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-4 ml-auto mr-auto">
                                        <input type="submit" class="btn btn-info" value="EXCLUIR CAMPUS">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        </div>
        <!-- alerta para confirmar a exclusão -->
        <div class="modal fade" id="alertaConfirmaExclusao" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center">Alerta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">Você tem certeza que deseja <strong>excluir</strong> o campus selecionado?</div>
                    <div class="modal-footer">
                        <div class="left-side">
                            <input type="button" class="btn btn-success btn-link" data-dismiss="modal" value="Prosseguir">
                        </div>
                        <div class="divider"></div>
                        <div class="right-side">
                            <button type="button" class="btn btn-danger btn-link" onClick="voltarParaPaginaExclusaoCampus()">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  fim do alerta para confirmar a exclusão-->                   
    </body>
</html>