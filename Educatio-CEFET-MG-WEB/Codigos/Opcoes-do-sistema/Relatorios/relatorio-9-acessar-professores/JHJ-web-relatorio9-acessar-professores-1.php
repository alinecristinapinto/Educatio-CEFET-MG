<!-- <?php header ('Content-type: text/html; charset=ISO-8859-1'); ?> -->
<!DOCTYPE html>
<html>
    <head>
        <title>Acessar professores</title>
        <meta charset="utf-8">
        
        <!-- CSS do Bootstrap -->

        <!-- CSS do grupo -->
        <link href="../Opcoes-do-sistema/Relatorios/relatorio-9-acessar-professores/JHJ-web-estilos.css" rel="stylesheet" />

        <!-- Arquivos js -->

        <!-- Fontes e icones -->

    </head>
    <body>
    <!-- <div class="section landing-section"> -->
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <h2 class="text-center">ACESSAR PROFESSORES</h2><br>
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

                        ?>

                        <form action="#" method="POST">

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
                                            <option value="">Selecione um campus</option>
                                            <?php while($campus = mysqli_fetch_array($query)) { ?>
                                                <option name="selectCampusParaAcessarProfessores[]" value="<?php echo $campus['id'] ?>">
                                                <?php echo $campus['nome']." - ".$campus['cidade']."-".$campus['UF'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-4 ml-auto mr-auto">
                                <button type="submit" class="btn btn-info btn-round" id="flag">Selecionar campus</button>
                            </div>                         
                        </form>

                </div>
            </div>
        </div>
    </div>
    <br><br>
<?php
    
    

?>

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
            
        if (!isset($vetIdCursos)) {
        header ('Content-type: text/html; charset=UTF-8');
     ?>
        <div class="container">
            <label class="fonteTexto" style="margin-top: 20px; margin-left: 170px;">Impossível acessar professores! Não existem cursos no <label style="font-weight: bold;"><?php echo $strNomeCampusSelecionado." - ".$strCidadeCampusSelecionado."-".$strUFCampusSelecionado ?></label>.</label>
        </div>
    <?php
        } else {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <form action="../Opcoes-do-sistema/Relatorios/relatorio-9-acessar-professores/JHJ-web-relatorio9-acessar-professores-2.php" method="POST">
                    <div class="row">
                        <!-- Usando os dados do BD para fazer o select com os cursos -->
                        <label class="fonteTexto">Cursos existentes no <label style="font-weight: bold;"><?php echo $strNomeCampusSelecionado." - ".$strCidadeCampusSelecionado."-".$strUFCampusSelecionado ?></label>:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="nc-icon nc-settings"></i>
                            </span>
                            <select class="form-control" name="selectCursoParaAcessarProfessores[]" required="required">
                                <option value="">Selecione um curso</option>
                                    <?php
                                        for ($intZ = 0; $intZ < count($vetIdCursos); $intZ++){ 
                                            echo "<option name='selectCursoParaAcessarProfessores[]' value='$vetIdCursos[$intZ]'>".
                                            $vetNomeCursos[$intZ]."</option>";
                                        } 
                                    ?>
                                    </select>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4 ml-auto mr-auto">
                            <button type="submit" class="btn btn-info btn-round" >Acessar professores!</button>
                        </div>
                    </div>       
                </form> <!-- fim do formularioCurso -->
            </div>
        </div>
    </div>
    <?php
            } //fechando else
    
        } 
    ?> <!-- fechando outro else  --> 
         

    </body>
</html>
