<!DOCTYPE html>
<html lang='pt-br'>
  <head>
    <title>Alterar Curso</title>
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

              // Verifica se usuário escolheu algum nome
              if(isset($_POST["selectParaAlterarCurso"]))
              {
                foreach($_POST["selectParaAlterarCurso"] as $id)
                {
                  //seta a variavel "$id" (id da turma) com o input do select
                }
                // Cria conexão
                $conn = new mysqli("localhost", "root", "","educatio");
                // Checa conexão
                if ($conn->connect_error) {
                    die("Conecção falhou: " . $conn->connect_error);
                }
                //Seleciona do BD o ID da turma com as suas multas correspondentes
                $sql = "SELECT * FROM cursos WHERE id = $id ";
                $result = $conn->query($sql);
                while($curso = $result->fetch_assoc()) {
                  session_start();
				  $_SESSION['idDepto'] = $curso["idDepto"];
                  $_SESSION['nome'] = $curso["nome"];
                  $_SESSION['horasTotal'] = $curso["horasTotal"];
                  $_SESSION['modalidade'] = $curso["modalidade"];
                }
              }
          ?>
		  
		  
		  <div class="wrapper">
            <div class="section landing-sectionv">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                        
                            <h2 class="text-center">Altera&ccedil;&atilde;o de Curso</h2>

                            <form class="contact-form" action="MAE-Web-ManutencaoCurso-Altera3.php" method="POST">
                                <div class="row">

                                  <label class="fonteTexto">Novo ID do departamento:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                          <i class="nc-icon nc-credit-card"></i>
                                      </span>
                                      <input type="text" class="form-control" placeholder="ID do departamento" name="NovoIdDepto"  value='<?php  echo $_SESSION['idDepto']; ?>'>
                                  </div>

                                  <label class="fonteTexto">Novo nome:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                          <i class="nc-icon nc-credit-card"></i>
                                      </span>
                                      <input type="text" class="form-control" placeholder="Nome" name="NovoNome"  value='<?php  echo $_SESSION['nome']; ?>'>
                                  </div>

                                  <label class="fonteTexto">Novo horas totais:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                          <i class="nc-icon nc-credit-card"></i>
                                      </span>
                                      <input type="text" class="form-control" placeholder="Horas totais" name="NovoHorasTotal"  value='<?php  echo $_SESSION['horasTotal']; ?>'>
                                  </div>
								  
								  <label class="fonteTexto">Nova modalidade:</label>
								  <select required="required" class="form-control" name="NovoModalidade" id="selectModalidade">
                                        <option value="">Selecione a modalidade&nbsp;</option>
                                        <option value="Graduação">Graduação</option>
                                        <option value="Técnico Integrado">Técnico Integrado</option>
                                    </select>
					
                									<!--Passa o nome e antigo do Curso-->
                									<input type='hidden' name='idDepto' value='<?php  echo $_SESSION['idDepto']; ?>'/>
                									<input type='hidden' name='nome' value='<?php  echo $_SESSION['nome']; ?>'/>
                									<input type='hidden' name='horasTotal' value='<?php  echo $_SESSION['horasTotal']; ?>'/>
                									<input type='hidden' name='modalidade' value='<?php  echo $_SESSION['modalidade']; ?>'/>

                									<div class="col-md-4 ml-auto mr-auto">
                                    <button type="submit" class="btn btn-info btn-round">Alterar</button>
                                    </div>
            
                                </div> 
             
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
  </body>
</html>