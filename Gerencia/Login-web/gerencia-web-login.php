<?php

	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");

	class Usuario {

		public $nome;
		public $email;
		public $foto;

		public function __construct($nome, $email, $foto) {
			$this->nome = $nome;
			$this->email = $email;
			$this->foto = $foto;
		}

		function setNome($nome) {
			$this->nome = $nome;
		} 

		function getNome() {
			return $nome;
		}
		
		function setEmail($email) {
			$this->email = $email;
		} 

		function getEmail() {
			return $email;
		}

		function setFoto($foto) {
			$this->foto = $foto;
		} 

		function getFoto() {
			return $foto;
		}
	}
	
   class Aluno extends Usuario{
				
		public function __construct($nome, $email, $foto) {
			parent::__construct($nome, $email, $foto);
		}

   }

   class Professor extends Usuario{
				
		public function __construct($nome, $email, $foto) {
			parent::__construct($nome, $email, $foto);
		}

   }

   class Bibliotecario extends Usuario{
				
		public function __construct($nome, $email, $foto) {
			parent::__construct($nome, $email, $foto);
		}

   }

   class Coordenador extends Usuario{
				
		public function __construct($nome, $email, $foto) {
			parent::__construct($nome, $email, $foto);
		}

   }
  
   class Login{
		
		public static function logarAluno($login, $senha){

			$conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, BD);
			
			if(!$conexao){
				echo 'Erro ao conectar ao banco de dados';
				exit;
			}
			
			mysqli_select_db($conexao, BD);

			$query ="SELECT * FROM alunos WHERE idCPF='$login' AND senha='$senha' AND ativo='S'";
				$resultado = mysqli_query($conexao, $query);

					if(!$resultado){
						echo "Erro ao obter os dados da tabela";
					} 

			$dados = null;
			$usuario;

			$dados = mysqli_fetch_assoc($resultado);

			if($dados == null){
				header('location:gerencia-web-login.html');
			} else {
				$usuario = new Aluno($dados["nome"],
					$dados["email"],
					$dados["foto"]
				);	
			}

			return $usuario;
		}


		public static function logarProfessor($login, $senha){

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

			$dados = null;
			$usuario;

			$dados = mysqli_fetch_assoc($resultado);

			if($dados == null){
				header('location:gerencia-web-login.html');
			} else {
				$usuario = new Professor($dados["nome"],
					$dados["email"],
					$dados["foto"]
				);		
			}

			return $usuario;
		}

		public static function logarBibliotecario($login, $senha){

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

			$dados = null;
			$usuario;

			$dados = mysqli_fetch_assoc($resultado);

			if($dados == null){
				header('location:gerencia-web-login.html');
			} else {
				$usuario = new Bibliotecario($dados["nome"],
					$dados["email"],
					$dados["foto"]
				);		
			}

			return $usuario;
		}

		public static function logarCoordenador($login, $senha){

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

			$dados = null;
			$usuario;

			$dados = mysqli_fetch_assoc($resultado);

			if($dados == null){
				header('location:gerencia-web-login.html');
			} else {
				$usuario = new Coordenador($dados["nome"],
					$dados["email"],
					$dados["foto"]
				);		
			}

			return $usuario;
		}
   }

?>
