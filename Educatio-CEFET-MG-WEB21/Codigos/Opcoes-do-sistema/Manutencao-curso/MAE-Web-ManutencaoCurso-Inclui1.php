<!DOCTYPE html>
<html>
    <head>
        <title>Adicionar Curso</title>
        
        <meta charset="utf-8" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

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
        <div class="wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                        
                            <h2 class="text-center">Inclusão de Curso</h2>
            
                            <form class="contact-form" action="../Opcoes-do-sistema/Manutencao-curso/MAE-Web-ManutencaoCurso-Inclui2.php" method="POST">
                                <div class="row">
                                
                                    <label class="fonteTexto">Inserir ID do departamento:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-credit-card"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="ID do departamento" name="idDepartamento" required="required">
                                    </div>
                                    
                                    <label class="fonteTexto">Inserir Nome:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-ruler-pencil"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Nome do Curso" name="nomeCurso" required="required">
                                    </div>
                                    
                                    <label class="fonteTexto">Inserir Horas Totais:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-time-alarm"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Horas Totais" name="horasTotal" required="required">
                                    </div>
                                    
                                    <label class="fonteTexto">Inserir Modalidade:</label>

                                    <select required="required" class="form-control" name="modalidade" id="selectModalidade">
                                        <option value="">Selecione a modalidade&nbsp;</option>
                                        <option value="Graduação">Graduação</option>
                                        <option value="Técnico Integrado">Técnico Integrado</option>

                                    </select>

                                    <div class="col-md-4 ml-auto mr-auto">
                                    <button type="submit" class="btn btn-info">Adicionar Curso</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>	
    </body>
</html>