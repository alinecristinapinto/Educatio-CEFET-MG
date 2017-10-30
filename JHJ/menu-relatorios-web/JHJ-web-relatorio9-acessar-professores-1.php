<!DOCTYPE html>
<html>
    <head>
        <title>Acessar professores</title>
        <meta charset="utf-8">
        
        <!-- CSS do Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet"/>

        <!-- CSS do grupo -->
        <link href="css/JHJ-web-estilos.css" rel="stylesheet" />

        <!-- Arquivos js -->
        <script src="js/popper.js"></script>
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>

        <!-- Fontes e icones -->
        <link href="css/nucleo-icons.css" rel="stylesheet">

    </head>
    <body>
    <div class="section landing-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <h2 class="text-center">Acessar Professores</h2>
                        <?php
                            // Conectando com o servidor MySQL
                            $link = mysqli_connect("localhost", "root", "");
                            if (!$link){
                            //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
                            } else {
                            //     echo "Conexao efetuada com sucesso!<br/>";
                            }
                            //Selecionado BD
                            $sql = mysqli_select_db($link, 'Educatio');
                        ?>

                        <form class="contact-form" action="#" method="POST">

                            <div class="row">
                                <?php
                                    //Seleciona os dados dos campus ativos
                                    $query = mysqli_query($link, " SELECT id, nome, cidade, UF FROM campi WHERE ativo='S' ");
                                ?>
                                <label class="fonteTexto">Campi onde os professores lecionam:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-settings"></i>
                                        </span>
                                        <select class="form-control" name="selectCampusParaAcessarProfessores[]" required="required">
                                            <option value="">Selecione um campus&nbsp;</option>
                                            <?php while($campus = mysqli_fetch_array($query)) { ?>
                                                <option name="selectCampusParaAcessarProfessores[]" value="<?php echo $campus['id'] ?>">
                                                <?php echo $campus['nome']." - ".$campus['cidade']."-".$campus['UF'] ?></option>
                                            <?php } ?>
                                        </select>
                                     </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-4 ml-auto mr-auto">
                                <button type="submit" class="btn btn-info btn-round">Selecionar campus</button>
                            </div>
        
                        </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        if (!isset($_POST['selectCampusParaAcessarProfessores'])){ 
            //echo "select campus ainda não foi preenchido";
        } else {
            //Pega id e dados do campus que foi selecionado
            $select = $_POST['selectCampusParaAcessarProfessores'];
            foreach($select as $_valor){
                $intIdCampus = $_valor;    
            }
            $query = mysqli_query($link, "SELECT nome, cidade, UF FROM campi WHERE id = $intIdCampus");
            $campus = mysqli_fetch_array($query);
            $strNomeCampusSelecionado = $campus['nome'];
            $strCidadeCampusSelecionado = $campus['cidade'];
            $strUFCampusSelecionado = $campus['UF'];

            //Seleciona o id dos departamentos ativos que estão no campus selecionado
            $query = mysqli_query($link, "SELECT id FROM deptos WHERE idCampi = $intIdCampus AND ativo='S' ");
            //Salvando id's dos departamentos em um vetor
            $intI = 0;
            $vetIdDeptos[$intI] = 0;
            while($deptos = mysqli_fetch_array($query)){
                $vetIdDeptos[$intI] = $deptos['id'];
                $intI++;
            }
            //Seleciona o id e o nome dos cursos ativos que estão nos departamentos contidos no vetor ($vetIdDeptos)
            //Salva id's e nomes dos cursos em um outros vetores ($vetIdCursos $vetNomeCursos)
            //OBS: count retorna a quantidade de elementos de um array
            $intJ = 0;
            for ($intK = 0; $intK < count($vetIdDeptos); $intK++){
                $query = mysqli_query($link, " SELECT id, nome FROM cursos WHERE idDepto = $vetIdDeptos[$intK] AND ativo='S' ");
                while($cursos = mysqli_fetch_array($query)){
                    $vetIdCursos[$intJ] = $cursos['id'];
                    $vetNomeCursos[$intJ] = $cursos['nome'];
                    $intJ++;
                }
            }    
        if (count($vetIdDeptos) == 1 &&  $vetIdDeptos[0] == 0){
     ?>
        <div class="alinhamento">
            <h4>Impossível acessar professores! Não existem cursos no <strong><?php echo $strNomeCampusSelecionado." - ".$strCidadeCampusSelecionado."-".$strUFCampusSelecionado ?></strong>.</h4>
        </div>
    <?php
        } else {
    ?>
    <div class="section landing-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <form class="contact-form" action="JHJ-web-relatorio9-acessar-professores-2.php" method="POST">
                        <div class="row">
                            <!-- Usando os dados do BD para fazer o select com os cursos -->
                            <label class="fonteTexto">Cursos existentes no <strong><?php echo $strNomeCampusSelecionado." - ".$strCidadeCampusSelecionado."-".$strUFCampusSelecionado ?></strong>:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="nc-icon nc-settings"></i>
                                </span>
                                <select class="form-control" name="selectCursoParaAcessarProfessores[]" required="required">
                                    <option value="">Selecione um curso&nbsp;</option>
                                        <?php
                                            for ($intZ = 0; $intZ < count($vetIdCursos); $intZ++){ 
                                                echo "<option name='selectCursoParaAcessarProfessores[]' value='$vetIdCursos[$intZ]'>".
                                                $vetNomeCursos[$intZ]."</option>";
                                            } 
                                        ?>
                                        </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 ml-auto mr-auto">
                            <button type="submit" class="btn btn-info btn-round" >Acessar professores!</button>
                        </div>       
                    </form> <!-- fim do formularioCurso -->
                </div>
            </div>
        </div>
    </div>
    <?php
            } //fechando else
    
        } 
    ?> <!-- fechando outro else  --> 
    </body>
</html>
