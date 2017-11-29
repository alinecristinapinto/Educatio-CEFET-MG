<?php 
  session_start(); 

  $usuario = $_SESSION['usuario'];

  echo "<script> 
          if(window.sessionStorage.getItem('logado') == 'N') 
            location.href = '../Login/gerencia-web-login.html'; 
        </script>";

  //header ('Content-type: text/html; charset=ISO-8859-1');      
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bem Vindo - Educatio CEFET-MG</title>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />

  <!-- CSS do Bootstrap -->
  <link href="../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

  <!-- CSS do grupo -->
  <link href="../../Estaticos/CSS/gerencia-web-login.css" rel="stylesheet">
  <link href="gerencia-web-interfaces.css" rel="stylesheet">

  <!-- Arquivos js -->
  <script src="../../Estaticos/Bootstrap/js/popper.js"></script>
  <script src="../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
  <script src="../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  <!-- js do grupo -->
  <script src="../../Estaticos/js/gerencia-web-login.js"></script>

  <!-- Fontes e icones -->
  <link href="../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">

  <script type="text/javascript">
      function fazerLogout(){
          window.sessionStorage.setItem('logado', 'N');
      }  
  </script>

</head>
<body>

  <?php 
    require "../../Menu-Rodape/gerencia-web-menu-interface-coordenador.php";

    switch ($_GET['acao']) {
      case 'adicionarCampus':
        require "../Opcoes-do-sistema/Manutencao-campi/adicionar-campus/JHJ-web-adicionar-campus-1.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
        break;

      case 'alterarCampus':
        require "../Opcoes-do-sistema/Manutencao-campi/alterar-campus/JHJ-web-alterar-campus-1.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
        break;

      case 'removerCampus':
        require "../Opcoes-do-sistema/Manutencao-campi/remover-campus/JHJ-web-remover-campus-1.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
        break; 

      case 'adicionarDepartamento':
        require "../Opcoes-do-sistema/Manutencao-departamentos/DepartamentoIncluirVerificacao.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break;

      case 'removerDepartamento':
        require "../Opcoes-do-sistema/Manutencao-departamentos/DepartamentoExcluirVerificacao.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break;

      case 'alterarDepartamento':
        require "../Opcoes-do-sistema/Manutencao-departamentos/DepartamentoAlterar.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break; 

      case 'professores':
        require "../Opcoes-do-sistema/Manutencao-professores/proff.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break;  

      case 'adicionarCurso':
        require "../Opcoes-do-sistema/Manutencao-curso/MAE-Web-ManutencaoCurso-Inclui1.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break;
      
      case 'removerCurso':
        require "../Opcoes-do-sistema/Manutencao-curso/MAE-Web-ManutencaoCurso-Deleta1.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
        break;
 
      case 'alterarCurso':
        require "../Opcoes-do-sistema/Manutencao-curso/MAE-Web-ManutencaoCurso-Altera1.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
        break;    

      case 'adicionarTurma':
        require "../Opcoes-do-sistema/Manutencao-turmas/MAE-Web-ManutencaoTurmas-Criar.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
        break;

      case 'removerTurma':
        require "../Opcoes-do-sistema/Manutencao-turmas/MAE-Web-ManutencaoTurmas-SelecionarTurma-Excluir.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
        break;

      case 'alterarTurma':
        require "../Opcoes-do-sistema/Manutencao-turmas/MAE-Web-ManutencaoTurmas-SelecionarTurma-Editar.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
        break;

      case 'adicionarDisciplina':
        require "../Opcoes-do-sistema/Manutencao-disciplinas/BLT-Web-ADCDisciplinas1.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break;

      case 'removerDisciplina':
        require "../Opcoes-do-sistema/Manutencao-disciplinas/BLT-Web-RMVDisciplinas1.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break;
      
      case 'editarDisciplina':
        require "../Opcoes-do-sistema/Manutencao-disciplinas/BLT-Web-EDTDisciplinas1.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break;

      case 'adicionarAluno':
        require "../Opcoes-do-sistema/Manutencao-aluno/insercao-aluno/PHJL-WEB-Formulario-de-insercao-de-aluno.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break;
      
      case "alterarAluno": 
        require "../Opcoes-do-sistema/Manutencao-aluno/alteracao-aluno/PHJL-WEB-Pesquisa-alterar-aluno.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break;  

      case "deletarAluno": 
        require "../Opcoes-do-sistema/Manutencao-aluno/remocao-aluno/PHJL-WEB-Pesquisa-deletar-aluno.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break;   

      case "acessarProfessores": 
        require "../Opcoes-do-sistema/Relatorios/relatorio-9-acessar-professores/JHJ-web-relatorio9-acessar-professores-1.php";
        require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php";
        break;

      case "acessarNotasAlunos": 
        require "../Opcoes-do-sistema/Relatorios/relatorio-10-notas-alunos/CJF-SelecaoNotas1.php";
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break;

      case 'acessarConteudos':
          require "../Opcoes-do-sistema/Relatorios/relatorio-11-conteudos/CJF-SelecaoConteudos1.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape.php";
          break; 

      case 'acessarHistoricoAlunos':
          require "../Opcoes-do-sistema/Relatorios/relatorio-7-historico/JHJ-web-relatorio7-historico-1.php";
          echo '<br>';
          require "../../Menu-Rodape/gerencia-web-rodape.php";
          break;      

      case 'integridadeSistema':
        require "../Opcoes-do-sistema/Integridade/confereIntegridade.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break;

      case 'transferirAluno':
        require "../Opcoes-do-sistema/Transferencia-aluno/TransferenciaVerificacaoCampi.php";
        echo '<br>';
        require "../../Menu-Rodape/gerencia-web-rodape.php";
        break;
    }
  ?>    

</body>
</html>  