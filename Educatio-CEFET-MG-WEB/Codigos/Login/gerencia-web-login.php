<?php

   define ("SERVIDOR", "localhost");
   define ("USUARIO", "root");
   define ("SENHA", "Bruali16");
   define ("BD", "educatio");

   class Login{
		
		public static function logarAluno($login, $senha){


			$conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, BD);
			
			if(!$conexao){
				echo 'Erro ao conectar ao banco de dados';
				exit;
			}
			
			mysqli_select_db($conexao, BD);

			$query ="SELECT * FROM alunos WHERE idCPF='$login' ";
				$resultado = mysqli_query($conexao, $query);

					if(!$resultado){
						echo "Erro ao obter os dados da tabela";
					} 

			$dados = null;

			$dados = mysqli_fetch_assoc($resultado);

			//EXCEÇÃO PARA O CASO DOS CAMPOS NÃO ESTAREM PREENCHIDOS

			if( $senha == "d41d8cd98f00b204e9800998ecf8427e"|| $login == null){
				echo "
				<script> 
					alert('Preencha todos os campos para efetuar o login!'); 
					location.href = 'gerencia-web-login.html';
				</script>";	
			}

			//EXCEÇÃO PARA CASO O LOGIN NÃO EXISTA

			if($dados["idCPF"] == null){
				echo "
				<script> 
					alert('Este usuário não existe ou não está no sistema!'); 
					location.href = 'gerencia-web-login.html';
				</script>";			
				//header('location:gerencia-web-login.html');
			}

			//EXCEÇÃO PARA USUÁRIO NÃO CADASTRADO

			if($dados["ativo"] == "N"){
				echo "
				<script> 
					alert('Este usuário ainda não cadastrou uma senha! Clique em cadastrar para efetuar esta ação.'); 
					location.href = 'gerencia-web-login.html';
				</script>";			
				//header('location:gerencia-web-login.html');
			}		

			//EXCEÇÃO PARA O CASO DE SENHA INCORRETA

			if($senha != $dados["senha"]){
				echo "
				<script> 
					alert('Senha incorreta!'); 
					location.href = 'gerencia-web-login.html';
				</script>";	
			} else {
				$usuario = array(
					"nome" => $dados["nome"],
					"foto" => $dados["foto"],
					"email" => $dados["email"],
					"idCPF" => $dados["idCPF"],
					"sexo" => $dados["sexo"],
					"nascimento" => $dados["nascimento"],
					"logradouro" => $dados["logradouro"],
					"numeroLogradouro" => $dados["numeroLogradouro"],
					"complemento" => $dados["complemento"],
					"bairro" => $dados["bairro"],
					"cidade" => $dados["cidade"],
					"CEP" => $dados["CEP"],
					"UF" => $dados["UF"],
					"idTurma" => $dados["idTurma"],
				);	

				echo "<script> window.sessionStorage.setItem('logado', 'S'); </script>";
			}

			return $usuario;
		}

		public static function logarFuncionario($login, $senha, $tipoFuncionario){


			$conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, BD);
			
			if(!$conexao){
				echo 'Erro ao conectar ao banco de dados';
				exit;
			}
			
			mysqli_select_db($conexao, BD);

			if($tipoFuncionario == 'Professor')
				$query ="SELECT * FROM funcionario WHERE idSIAPE='$login' AND hierarquia='Professor'";

			if($tipoFuncionario == 'Bibliotecario')
				$query ="SELECT * FROM funcionario WHERE idSIAPE='$login' AND hierarquia='Bibliotecario'";

			if($tipoFuncionario == 'Coordenador')
				$query ="SELECT * FROM funcionario WHERE idSIAPE='$login' AND hierarquia='Coordenador'";

				$resultado = mysqli_query($conexao, $query);

					if(!$resultado){
						echo "Erro ao obter os dados da tabela";
					}

			$dados = null;

			$dados = mysqli_fetch_assoc($resultado);

			//EXCEÇÃO PARA O CASO DOS CAMPOS NÃO ESTAREM PREENCHIDOS

			if( $senha == "d41d8cd98f00b204e9800998ecf8427e"|| $login == null){
				echo "
				<script> 
					alert('Preencha todos os campos para efetuar o login!'); 
					location.href = 'gerencia-web-login.html';
				</script>";	
			}

			//EXCEÇÃO PARA CASO O LOGIN NÃO EXISTA

			if($dados["idSIAPE"] == null){
				echo "
				<script> 
					alert('Este usuário não existe ou não está no sistema!'); 
					location.href = 'gerencia-web-login.html';
				</script>";			
				//header('location:gerencia-web-login.html');
			}

			//EXCEÇÃO PARA USUÁRIO NÃO CADASTRADO

			if($dados["ativo"] == "N"){
				echo "
				<script> 
					alert('Este usuário ainda não cadastrou uma senha! Clique em cadastrar para efetuar esta ação.'); 
					location.href = 'gerencia-web-login.html';
				</script>";			
				//header('location:gerencia-web-login.html');
			}		

			//EXCEÇÃO PARA O CASO DE SENHA INCORRETA

			if($senha != $dados["senha"]){
				echo "
				<script> 
					alert('Senha incorreta!'); 
					location.href = 'gerencia-web-login.html';
				</script>";	
			} else {
				$usuario = array(
					"nome" => $dados["nome"],
					"foto" => $dados["foto"],
					"idSIAPE" => $dados["idSIAPE"],
					"idDepto" => $dados["idDepto"],
					"titulacao" => $dados["titulacao"],
					"hierarquia" => $dados["hierarquia"],
				);	
				echo "<script> window.sessionStorage.setItem('logado', 'S'); </script>";	
			}

			return $usuario;
		}

   }

?>
