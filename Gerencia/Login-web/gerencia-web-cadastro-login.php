<?php

define ("SERVIDOR", "localhost");
define ("USUARIO", "root");
define ("SENHA", "Bruali16");
define ("BD", "educatio");

   class Cadastra{
		
		public static function CadastrarAluno($login, $senha){

			$conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, BD);
			
			if(!$conexao){
				echo 'Erro ao conectar ao banco de dados';
				exit;
			}
			
			mysqli_select_db($conexao, BD);

			$query ="SELECT * FROM alunos WHERE idCPF='$login'";
				$resultado = mysqli_query($conexao, $query);

					if(!$resultado){
						echo "Erro ao obter os dados da tabela";
					} 
		}

		/*public static function CadastraProfessor($login, $senha){

			$conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, BD);
			
			if(!$conexao){
				echo 'Erro ao conectar ao banco de dados';
				exit;
			}
			
			mysqli_select_db($conexao, BD);

			$query ="SELECT * FROM funcionario WHERE idSIAPE='$login' AND senha='$senha' AND hierarquia='P' AND ativo='S'";
				$resultado = mysqli_query($conexao, $query);

					if(!$resultado){
						echo "Erro ao obter os dados da tabela";
					}

		}

		public static function CadastraBibliotecario($login, $senha){

			$conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, BD);
			
			if(!$conexao){
				echo 'Erro ao conectar ao banco de dados';
				exit;
			}
			
			mysqli_select_db($conexao, BD);

			$query ="SELECT * FROM funcionario WHERE idSIAPE='$login' AND senha='$senha' AND hierarquia='B' AND ativo='S'";
				$resultado = mysqli_query($conexao, $query);

					if(!$resultado){
						echo "Erro ao obter os dados da tabela";
					}

		}

		public static function CadastraCoordenador($login, $senha){

			$conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, BD);
			
			if(!$conexao){
				echo 'Erro ao conectar ao banco de dados';
				exit;
			}
			
			mysqli_select_db($conexao, BD);

			$query ="SELECT * FROM funcionario WHERE idSIAPE='$login' AND senha='$senha' AND hierarquia='C' AND ativo='S'";
				$resultado = mysqli_query($conexao, $query);

					if(!$resultado){
						echo "Erro ao obter os dados da tabela";
					}
		}*/
   }

?>