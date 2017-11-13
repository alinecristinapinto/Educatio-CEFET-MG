<?php


class professor{

    public $intSiape;
    public $intDepto;    
    public $StringNome;
    public $StringTitulacao;   
    public $StringAtivo = "";
    public $StringHierarquia = "Professor";
    public $StringSenha;
    public $Foto;

    public $StringDeterminante;
    public $StringDeterminado;


    function adicionaProfessor($intSiape, $intDepto, $StringNome, $StringTitulacao, $StringAtivo, $StringHierarquia, $StringSenha, $Foto){

    	//Abre a conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}


		$sqlAdicionaProfessor = "INSERT INTO funcionario ( idSiape, idDepto, nome, titulacao, hierarquia, senha, foto, ativo) values ( '$intSiape', '$intDepto', '$StringNome', '$StringTitulacao', '$StringHierarquia', '$StringSenha', '$Foto', '$StringAtivo')";
		if ($result = mysqli_query($sqlConexao, $sqlAdicionaProfessor)) {		
		}else{
			echo "Erro: " . $sqlAdicionaProfessor . "<br>" . $sqlConexao->error;
		}
    }

    function deletaProfessor($StringDeterminante, $StringDeterminado){

    	//Abre a conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}

		$sqlDeletaProfessor = " UPDATE funcionario SET ativo = 'N' WHERE $StringDeterminante  = '$StringDeterminado'";
		if (mysqli_query($sqlConexao, $sqlDeletaProfessor)) {
			echo "profesoordeletado<br>";
		}
		else{
			echo "Erro ao deletar o professor: " . mysqli_error($sqlConexao);
		}


    }

    function alteraProfessor($StringDeterminante, $StringDeterminado, $StringCampo, $StringValor){

    	//Abre a conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}

    	$sqlAlteraProfessor = " UPDATE funcionario SET $StringCampo = '$StringValor'  WHERE $StringDeterminante  = '$StringDeterminado'";
		if (mysqli_query($sqlConexao, $sqlAlteraProfessor)) {
			echo "profesooralterado<br>";
		}
		else{
			echo "Erro ao alterar o professor: " . mysqli_error($sqlConexao);
		}
    }

    function pesquisaProfessor ($StringDeterminante, $StringDeterminado){

   		// Abre a conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}	
	
		$sql = "SELECT * FROM funcionario WHERE $StringDeterminante = '$StringDeterminado'";

		$resultado = $sqlConexao->query($sql);	

        while ($row = $resultado->fetch_assoc()){
    		echo 'nome ' .$row["nome"];
    		echo '<br /> idsiape = '.$row["idSIAPE"];
    	}
	}	
}

    $professorProf = new professor;  

    $professorProf->adicionaProfessor($_POST["siape"],$_POST["depto"],$_POST["nome"],$_POST["titulacao"],'S','Professor',$_POST["senha"],'123');

    echo "<script>location.href='proff.html';</script>";

?>