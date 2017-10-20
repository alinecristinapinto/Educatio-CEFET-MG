<?php

	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "Bruali16");
	define ("BD", "educatio");

	class Usuario {

		public $nome;
		public $foto;

		public function __construct($nome, $foto) {
			$this->nome = $nome;
			$this->foto = $foto;
		}

		function setNome($nome) {
			$this->nome = $nome;
		} 

		function getNome() {
			return $nome;
		}
		
		function setFoto($foto) {
			$this->foto = $foto;
		} 

		function getFoto() {
			return $foto;
		}
	}

	class funcionario extends Usuario
   {
   		public $idSIAPE;
   		public $idDepto;
   		public $titulacao;
   		public $hierarquia;	
				
		public function __construct($nome, $foto, $idSIAPE, $idDepto, $titulacao, $hierarquia) {
			parent::__construct($nome, $foto);

			$this->idSIAPE = $idSIAPE;
			$this->idDepto = $idDepto;
			$this->titulacao = $titulacao;
			$this->hierarquia = $hierarquia;
		}

		function setIdSIAPE($idSIAPE) {
			$this->idSIAPE = $idSIAPE;
		}

		function getIdSIAPE() {
			return $idSIAPE;
		}

		function setIdDepto($idDepto) {
			$this->idDepto = $idDepto;
		}

		function getIdDepto() {
			return $idDepto;
		}

		function setTitulacao($titulacao) {
			$this->titulacao = $titulacao;
		}

		function getTitulacao() {
			return $titulacao;
		}

		function setHierarquia($hierarquia) {
			$this->hierarquia = $hierarquia;
		}

		function getHierarquia() {
			return $hierarquia;
		}

   	
   }

   /*class Professor extends funcionario{
   		public function __construct($nome, $foto, $idSIAPE, $idDepto, $titulacao, $hierarquia) {
			parent::__construct($nome, $foto, $idSIAPE, $idDepto, $titulacao, $hierarquia);
		}
   }

   class Bibliotecario extends funcionario{
   		public function __construct($nome, $foto, $idSIAPE, $idDepto, $titulacao, $hierarquia) {
			parent::__construct($nome, $foto, $idSIAPE, $idDepto, $titulacao, $hierarquia);
		}
   }

   class Coordenador extends funcionario{
   		public function __construct($nome, $foto, $idSIAPE, $idDepto, $titulacao, $hierarquia) {
			parent::__construct($nome, $foto, $idSIAPE, $idDepto, $titulacao, $hierarquia);
		}
   }*/
	
   class Aluno extends Usuario{
   		public $email;
   		public $idCPF;
   		public $sexo;
   		public $nascimento;
   		public $logradouro;
   		public $numeroLogradouro;
   		public $complemento;
   		public $bairro;
   		public $cidade;
   		public $CEP;
   		public $UF;
		public $idTurma;
				
		public function __construct($nome, $foto, $email, $idCPF, $sexo, $nascimento, $logradouro, $numeroLogradouro, $complemento, $bairro, $cidade, $CEP, $UF, $idTurma) {
			parent::__construct($nome, $foto);

			$this->email = $email;
			$this->idCPF = $idCPF;
			$this->sexo = $sexo;
			$this->nascimento = $nascimento;
			$this->logradouro = $logradouro;
			$this->numeroLogradouro = $numeroLogradouro;
			$this->complemento = $complemento;
			$this->bairro = $bairro;
			$this->cidade = $cidade;
			$this->CEP = $CEP;
			$this->UF = $UF;
			$this->idTurma = $idTurma;
		}

		function setEmail($email) {
			$this->email = $email;
		}

		function getEmail() {
			return $email;
		}

		function setIdCPF($idCPF) {
			$this->idCPF = $idCPF;
		}

		function getIdCPF() {
			return $idCPF;
		}

		function setSexo($sexo) {
			$this->sexo = $sexo;
		}

		function getSexo() {
			return $sexo;
		} 

		function setNascimento($nascimento) {
			$this->nascimento = $nascimento;
		}

		function getNascimento() {
			return $nascimento;
		} 

		function setLogradouro($logradouro) {
			$this->logradouro = $logradouro;
		}

		function getLogradouro() {
			return $logradouro;
		}

		function setNumeroLogradouro($numeroLogradouro) {
			$this->numeroLogradouro = $numeroLogradouro;
		}

		function getNumeroLogradouro() {
			return $numeroLogradouro;
		}

		function setComplemento($complemento) {
			$this->complemento = $complemento;
		}

		function getComplemento() {
			return $complemento;
		}

		function setBairro($bairro) {
			$this->bairro = $bairro;
		}

		function getBairro() {
			return $bairro;
		}

		function setCidade($cidade) {
			$this->cidade = $cidade;
		}

		function getCidade() {
			return $cidade;
		}

		function setCEP($CEP) {
			$this->CEP = $CEP;
		}

		function getCEP() {
			return $CEP;
		}

		function setUF($UF) {
			$this->UF = $UF;
		}

		function getUF() {
			return $UF;
		}

		function setIdTurma($idTurma) {
			$this->idTurma = $idTurma;
		}

		function getIdTurma() {
			return $idTurma;
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
					$dados["foto"],
					$dados["email"],
					$dados["idCPF"],
					$dados["sexo"],
					$dados["nascimento"],
					$dados["logradouro"],
					$dados["numeroLogradouro"],
					$dados["complemento"],
					$dados["bairro"],
					$dados["cidade"],
					$dados["CEP"],
					$dados["UF"],
					$dados["idTurma"]
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
				$usuario = new funcionario($dados["nome"],
					$dados["foto"],
					$dados["idSIAPE"],
					$dados["idDepto"],
					$dados["titulacao"],
					$dados["hierarquia"]
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
				$usuario = new funcionario($dados["nome"],
					$dados["foto"],
					$dados["idSIAPE"],
					$dados["idDepto"],
					$dados["titulacao"],
					$dados["hierarquia"]
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
				$usuario = new funcionario($dados["nome"],
					$dados["foto"],
					$dados["idSIAPE"],
					$dados["idDepto"],
					$dados["titulacao"],
					$dados["hierarquia"]
				);		
			}

			return $usuario;
		}
   }

?>

