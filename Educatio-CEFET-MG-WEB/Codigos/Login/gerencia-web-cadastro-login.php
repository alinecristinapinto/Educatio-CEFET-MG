<?php

define ("SERVIDOR", "localhost");
define ("USUARIO", "root");
define ("SENHA", "");
define ("BD", "educatio");

   class Cadastra{
		
		public static function CadastrarAluno($login, $senha, $confirmaSenha){


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

			$dados = null;
			
			$dados = mysqli_fetch_assoc($resultado);

			//EXCEÇÃO PARA O CASO DOS CAMPOS NÃO ESTAREM PREENCHIDOS

			if($login == null || $senha == "d41d8cd98f00b204e9800998ecf8427e" || $confirmaSenha == "d41d8cd98f00b204e9800998ecf8427e"){
				echo "
				<script>
					alert('Preencha todos os campos para efetuar o cadastro!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
			}
			
			//EXCEÇÃO PARA O CASO DO USUÁRIO NÃO EXISTIR

			if($dados["idCPF"] == null){
				echo "
				<script>
					alert('O usuário informado não existe ou não foi inserido no sistema!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
			}

			//EXCEÇÃO PARA O CASO DO USUÁRIO JÁ TER CADASTRADO UMA SENHA

			if($dados["ativo"] == "S"){
				echo "
				<script>
					alert('O usuário informado já cadastrou uma senha!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
			}			

			//EXCEÇÃO PARA O CASO DA SENHA E DA SUA CONFIRMAÇÃO NÃO COINCIDIREM
			
			if( $senha != $confirmaSenha ){
				echo "
				<script>
					alert('A confirmação da senha não coincide com a senha digitada!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
		
			} 
			
			if( $senha != "d41d8cd98f00b204e9800998ecf8427e" &&$senha == $confirmaSenha ){
				$query ="UPDATE alunos SET senha='$senha', ativo='S' WHERE idCPF='$login'";
					$resultado = mysqli_query($conexao, $query);

				echo "
				<script>
					alert('Cadastro de senha efetuado com sucesso!');
					location.href = 'gerencia-web-login.html';
				</script>
				";
			}	 

		}

		public static function CadastrarProfessor($login, $senha, $confirmaSenha){
			$conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, BD);
			
			if(!$conexao){
				echo 'Erro ao conectar ao banco de dados';
				exit;
			} 
			
			mysqli_select_db($conexao, BD);


			$query ="SELECT * FROM funcionario WHERE idSIAPE='$login' AND hierarquia = 'Professor'";
				$resultado = mysqli_query($conexao, $query);

					if(!$resultado){
						echo "Erro ao obter os dados da tabela";
					} 

			$dados = null;
			
			$dados = mysqli_fetch_assoc($resultado);

			//EXCEÇÃO PARA O CASO DOS CAMPOS NÃO ESTAREM PREENCHIDOS

			if($login == null || $senha == "d41d8cd98f00b204e9800998ecf8427e" || $confirmaSenha == "d41d8cd98f00b204e9800998ecf8427e"){
				echo "
				<script>
					alert('Preencha todos os campos para efetuar o cadastro!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
			}
			
			//EXCEÇÃO PARA O CASO DO USUÁRIO NÃO EXISTIR

			if($dados["idSIAPE"] == null){
				echo "
				<script>
					alert('O usuário informado não existe ou não foi inserido no sistema!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
			}

			//EXCEÇÃO PARA O CASO DO USUÁRIO JÁ TER CADASTRADO UMA SENHA

			if($dados["ativo"] == "S"){
				echo "
				<script>
					alert('O usuário informado já cadastrou uma senha!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
			}			

			//EXCEÇÃO PARA O CASO DA SENHA E DA SUA CONFIRMAÇÃO NÃO COINCIDIREM
			
			if( $senha != $confirmaSenha ){
				echo "
				<script>
					alert('A confirmação da senha não coincide com a senha digitada!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
		
			} 
			
			if( $senha != "d41d8cd98f00b204e9800998ecf8427e" &&$senha == $confirmaSenha ){
				$query ="UPDATE funcionario SET senha='$senha', ativo='S' WHERE idSIAPE='$login'";
					$resultado = mysqli_query($conexao, $query);

				echo "
				<script>
					alert('Cadastro de senha efetuado com sucesso!');
					location.href = 'gerencia-web-login.html';
				</script>
				";
			}	 
		

		}

		public static function CadastrarBibliotecario($login, $senha, $confirmaSenha){
			$conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, BD);
			
			if(!$conexao){
				echo 'Erro ao conectar ao banco de dados';
				exit;
			} 
			
			mysqli_select_db($conexao, BD);


			$query ="SELECT * FROM funcionario WHERE idSIAPE='$login' AND hierarquia = 'Bibliotecario'";
				$resultado = mysqli_query($conexao, $query);

					if(!$resultado){
						echo "Erro ao obter os dados da tabela";
					} 

			$dados = null;
			
			$dados = mysqli_fetch_assoc($resultado);

			//EXCEÇÃO PARA O CASO DOS CAMPOS NÃO ESTAREM PREENCHIDOS

			if($login == null || $senha == "d41d8cd98f00b204e9800998ecf8427e" || $confirmaSenha == "d41d8cd98f00b204e9800998ecf8427e"){
				echo "
				<script>
					alert('Preencha todos os campos para efetuar o cadastro!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
			}
			
			//EXCEÇÃO PARA O CASO DO USUÁRIO NÃO EXISTIR

			if($dados["idSIAPE"] == null){
				echo "
				<script>
					alert('O usuário informado não existe ou não foi inserido no sistema!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
			}

			//EXCEÇÃO PARA O CASO DO USUÁRIO JÁ TER CADASTRADO UMA SENHA

			if($dados["ativo"] == "S"){
				echo "
				<script>
					alert('O usuário informado já cadastrou uma senha!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
			}			

			//EXCEÇÃO PARA O CASO DA SENHA E DA SUA CONFIRMAÇÃO NÃO COINCIDIREM
			
			if( $senha != $confirmaSenha ){
				echo "
				<script>
					alert('A confirmação da senha não coincide com a senha digitada!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
		
			} 
			
			if( $senha != "d41d8cd98f00b204e9800998ecf8427e" &&$senha == $confirmaSenha ){
				$query ="UPDATE funcionario SET senha='$senha', ativo='S' WHERE idSIAPE='$login'";
					$resultado = mysqli_query($conexao, $query);

				echo "
				<script>
					alert('Cadastro de senha efetuado com sucesso!');
					location.href = 'gerencia-web-login.html';
				</script>
				";
			}	 
		

			

		}

		public static function CadastrarCoordenador($login, $senha, $confirmaSenha){
			$conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, BD);
			
			if(!$conexao){
				echo 'Erro ao conectar ao banco de dados';
				exit;
			} 
			
			mysqli_select_db($conexao, BD);


			$query ="SELECT * FROM funcionario WHERE idSIAPE='$login' AND hierarquia = 'Coordenador'";
				$resultado = mysqli_query($conexao, $query);

					if(!$resultado){
						echo "Erro ao obter os dados da tabela";
					} 

			$dados = null;
			
			$dados = mysqli_fetch_assoc($resultado);

			//EXCEÇÃO PARA O CASO DOS CAMPOS NÃO ESTAREM PREENCHIDOS

			if($login == null || $senha == "d41d8cd98f00b204e9800998ecf8427e" || $confirmaSenha == "d41d8cd98f00b204e9800998ecf8427e"){
				echo "
				<script>
					alert('Preencha todos os campos para efetuar o cadastro!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
			}
			
			//EXCEÇÃO PARA O CASO DO USUÁRIO NÃO EXISTIR

			if($dados["idSIAPE"] == null){
				echo "
				<script>
					alert('O usuário informado não existe ou não foi inserido no sistema!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
			}

			//EXCEÇÃO PARA O CASO DO USUÁRIO JÁ TER CADASTRADO UMA SENHA

			if($dados["ativo"] == "S"){
				echo "
				<script>
					alert('O usuário informado já cadastrou uma senha!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
			}			

			//EXCEÇÃO PARA O CASO DA SENHA E DA SUA CONFIRMAÇÃO NÃO COINCIDIREM
			
			if( $senha != $confirmaSenha ){
				echo "
				<script>
					alert('A confirmação da senha não coincide com a senha digitada!');
					location.href = 'gerencia-web-cadastro-login.html';
				</script>
				";
		
			} 
			
			if( $senha != "d41d8cd98f00b204e9800998ecf8427e" &&$senha == $confirmaSenha ){
				$query ="UPDATE funcionario SET senha='$senha', ativo='S' WHERE idSIAPE='$login'";
					$resultado = mysqli_query($conexao, $query);

				echo "
				<script>
					alert('Cadastro de senha efetuado com sucesso!');
					location.href = 'gerencia-web-login.html';
				</script>
				";
			}	 
			
		}
   }

?>
