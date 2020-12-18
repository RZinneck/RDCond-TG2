<?php

require_once('db.class.php'); //arquivo importado para dentro desse script

$tipo = $_POST['tipo'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email']; //itens que serão pegos do formulario
$rsenha = md5($_POST['rsenha']);
$senha = md5($_POST['senha']); //criptografia md5 gera um hash de 32 caracteres

if ($rsenha != $senha) {
	echo "<script>alert('Falha no cadastro de usuário, as senhas devem ser iguais.'); 
		window.location.href = 'index.php'
		</script>";
} else {

	$objDb = new db();
	$link = $objDb->conecta_mysql(); //conectando ao banco de dados

	$email_existe = false;

	// verificar se o email ja foi cadastrado
	$sql = " select * from usuario where usuario_email = '$email'";
	if ($resultado_id = mysqli_query($link, $sql)) {

		$dados_usuario = mysqli_fetch_array($resultado_id); // instrução fecth array recupera em forma de array os dados do usuario no banco de dados

		if (isset($dados_usuario['usuario_email'])) {
			$email_existe = true;
		}
	} else {
		echo 'Erro ao tentar localizar o registro de e-mail';
	}

	if ($email_existe) {

		$retorno_get = '';

		if ($email_existe) {
			$retorno_get .= "erro_email=1&";
		}

		header('Location: index.php?' . $retorno_get);

		die();
	}

	//inserção dos dados no banco de dados
	$sql = " insert into usuario(usuario_nome, usuario_sobrenome, usuario_email, usuario_senha, usuario_tipo) values ('$nome', '$sobrenome', '$email', '$senha', '$tipo')";

	//executar a query - alert para avisar que o cadastro foi efetuado e redirecionamento de pagina para a propria index
	if (mysqli_query($link, $sql)) {
		echo "<script>alert('Cadastro efetuado com sucesso! Entre com os seus dados para acessar.'); 
		window.location.href = 'index.php'
		</script>";
	} else {
		echo "Erro ao resgistrar o usuário!";
	}
}
