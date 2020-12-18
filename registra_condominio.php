<?php

$numero_de_bytes = 4;

$restultado_bytes = random_bytes($numero_de_bytes); //função para gerar um código para o condominio
$cond_codigo = bin2hex($restultado_bytes);

session_start();

require_once('db.class.php'); // arquivo importado para dentro desse script

$cond_nome = $_POST['cond_nome'];
$numero_ap = $_POST['numero_ap']; // variavel pega por meio do formulario na tp_morador
$id_usuario = $_SESSION['id_usuario'];

$objDb = new db();
$link = $objDb->conecta_mysql(); // conectando ao banco de dados

// inserção dos dados no banco de dados
$sql = " insert into condominio (cond_nome, cond_codigo, fk_usuario) values ('$cond_nome', '$cond_codigo', '$id_usuario')";

if (mysqli_query($link, $sql)) {
	echo "<script>alert('Cadastro efetuado com sucesso! Entre com os seus dados para acessar.');
		</script>";
} else {
	echo "Erro ao resgistrar o condomínio!";
}

// comando sql para pegar o cond_id para usar no update
$sql = "SELECT * FROM condominio WHERE fk_usuario = '$id_usuario'";

if (mysqli_query($link, $sql)) {
	$resultado_id = mysqli_query($link, $sql);
	$dados_usuario = mysqli_fetch_array($resultado_id); // instrução fecth array recupera em forma de array os dados do usuario no banco de dados
	$_SESSION['id_cond'] = $dados_usuario['cond_id'];
	$cond_id = $_SESSION['id_cond'];
}

// comando sql para inserir o cond_id da tabela condominio para dentro do fk_condominio na tabela usuario
$sql = "update usuario set fk_condominio = '$cond_id', usuario_ap = '$numero_ap' where usuario_id = $id_usuario";

if (mysqli_query($link, $sql)) {
	header('Location: home.php');
} else {
	echo "Erro no cadastro do condomínio.";
}
