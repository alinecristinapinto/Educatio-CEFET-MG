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
					} else {
						echo "DEU CERTO PORRA";
					}

			$dados = mysqli_fetch_assoc($resultado);

			$usuario = new Aluno($dados["nome"],
					$dados["email"],
					$dados["foto"]
					);

			return $usuario;
		}
   }

?>
