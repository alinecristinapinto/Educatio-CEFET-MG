<html>
    <head>
        <title>Remover Curso</title>
        <meta charset="utf-8" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
    
        <!-- CSS do Bootstrap -->
        <link href="../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

        <!-- CSS do grupo -->
        <link href="gerencia-web-interfaces.css" rel="stylesheet">

        <!-- Arquivos js -->
        <script src="../../Estaticos/Bootstrap/js/popper.js"></script>
        <script src="../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

        <!-- js do grupo -->
        <script type="text/javascript" src="js/MAE-web-script.js"></script>

        <!-- Fontes e icones -->
        <link href="../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
        
        
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
        
        session_start();
        $select = $_POST['selectParaExcluirCurso'];
        foreach($select as $_valor){
            //pega id do curso que sera excluido
            $intIdCurso = $_valor;
            $_SESSION['intIdCurso'] =  $intIdCurso;
        }
        // Conectando com o servidor MySQL
        $link = mysqli_connect("localhost", "root", "");
        if (!$link){
            //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
        } else {
            //     echo "Conexao efetuada com sucesso!<br/>";
        }
        // Selecionado BD
        $sql = mysqli_select_db($link, 'Educatio');


        //Seleciona os dados do curso com id recebido pelo select
        $query = mysqli_query($link, " SELECT idDepto, nome, horasTotal, modalidade, ativo FROM cursos WHERE id = $intIdCurso ");
        while($curso = mysqli_fetch_array($query)) { 
            $strIdDeptoCurso = $curso['idDepto'];
            $strNomeCurso = $curso['nome'];
            $strHorasTotalCurso = $curso['horasTotal'];
            $strModalidade = $curso['modalidade'];
            $strAtivoCurso = $curso['ativo']; 
        }
        //Tornando curso inativo ("excluindo")
        $sql = "UPDATE cursos SET ativo = 'N' WHERE id = $intIdCurso";
        if (mysqli_query($link, $sql)) {
           //     echo "sucesso";
        }else{
           //     echo "erro";
        }
     ?>

        <!-- exibindo informações dentro de um painel -->
        <div class="wrapper">
            <div class="section landing-sectionv">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            
                            <h2 class="text-center">Exclus&atilde;o de Curso</h2>
                            
                             <!-- exibindo informações do novo campus adicionado dentro de um painel -->
                             
                            <div class="contact-form">
                                <h4>Curso removido com sucesso!</h4>
                                <label class="fonteTexto">ID do departamento:<?php echo " ".$strIdDeptoCurso ?></label><br />
                                <label class="fonteTexto">Nome:<?php echo " ".$strNomeCurso ?></label><br />
                                <label class="fonteTexto">Horas Totais:<?php echo " ".$strHorasTotalCurso ?></label><br />
                                <label class="fonteTexto">Modalidae:<?php echo " ".$strModalidade ?></label><br />

                                <div class="col-md-4 ml-auto mr-auto">
                                    <button type="submit" class="btn btn-info btn-round" onClick="window.location.href = 'gerencia-web-interface-coordenador.php?acao=removerCurso'">Voltar</button>
                                </div>
                            </div>  
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>