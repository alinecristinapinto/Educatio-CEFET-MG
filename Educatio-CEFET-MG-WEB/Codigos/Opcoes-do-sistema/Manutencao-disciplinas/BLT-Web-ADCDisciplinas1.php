<!DOCTYPE html>
<html>
<head>
  <title>Adicionar Disciplina</title>
  <meta charset="utf-8">
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

        <!--<div class="section landing-section">-->
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">

                        <h2 class="text-center">Adicionar Disciplina</h2>

                         <form class="contact-form" action="../Opcoes-do-sistema/Manutencao-disciplinas/BLT-Web-ADCDisciplinas2.php" method="post">

                         <div class="row">
                                <label class="fonteTexto">Nome da disciplina:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-ruler-pencil"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Nome" required="required" name="nomeDisciplina">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">ID da turma:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-hat-3"></i>
                                    </span>
                                    <input type="number" class="form-control" placeholder="ID" required="required" name="idTurma">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">ID do professor:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-circle-10"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="ID" required="required" name="idProfessor">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Carga horária minima (horas):</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-time-alarm"></i>
                                    </span>
                                    <input type="number" class="form-control" placeholder="ID" required="required" name="cargaHoraria">
                                </div>
                            </div>
                            <br>

                             <div class="row">
                                <div class="col-md-4 ml-auto mr-auto">
                                <input type="submit" class="btn btn-info" value="Pronto">
                                </div>
                            </div>

                            </form>

                    </div>
                </div>
            </div>
        </div>

</div>

</body>
</html>