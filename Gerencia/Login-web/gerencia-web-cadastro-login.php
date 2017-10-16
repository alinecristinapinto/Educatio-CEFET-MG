<?php

define ("SERVIDOR", "localhost");
define ("USUARIO", "root");
define ("SENHA", "Bruali16");
define ("BD", "educatio");

   class Cadastra{
		
		public static function CadastrarAluno($login, $senha, $confirmaSenha){

			$conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, BD);
			
			if(!$conexao){
				echo 'Erro ao conectar ao banco de dados';
				exit;
			} 
			
			mysqli_select_db($conexao, BD);

			$query ="SELECT * FROM alunos WHERE idCPF='$login' AND ativo='N' AND senha=''";
				$resultado = mysqli_query($conexao, $query);

					if(!$resultado){
						echo "Erro ao obter os dados da tabela";
					} 

			$dados = null;
			
			$dados = mysqli_fetch_assoc($resultado);

			if($dados == null){
				header('location:gerencia-web-cadastro-login.html');
			}
			
			//$senha = md5($senha);
			//$confirmaSenha = md5($confirmaSenha);
			
			if($senha != $confirmaSenha){
				header('location:gerencia-web-cadastro-login.html');		
			} 
			
			$query ="UPDATE alunos SET senha='$senha', ativo='S' WHERE idCPF='$login'";
				$resultado = mysqli_query($conexao, $query);

			header('location:gerencia-web-login.html');

		}

		/*public static function CadastraProfessor($login, $senha){

		

		}

		public static function CadastraBibliotecario($login, $senha){

			

		}

		public static function CadastraCoordenador($login, $senha){

			
		}*/
   }

?>
