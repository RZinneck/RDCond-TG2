<?php

session_start();

require_once('db.class.php'); // arquivo importado para dentro desse script

$objDb = new db();
$link = $objDb->conecta_mysql(); // conectando ao banco de dados

$id_usuario = $_SESSION['id_usuario'];

if (isset($_POST['nome'])) {
	$nome = $_POST['nome'];
	$sql = "update usuario set usuario_nome = '$nome' where usuario_id = $id_usuario";
} else if (isset($_POST['sobrenome'])) {
	$sobrenome = $_POST['sobrenome'];
	$sql = "update usuario set usuario_sobrenome = '$sobrenome' where usuario_id = $id_usuario";
} else if (isset($_POST['apartamento'])) {
	$apartamento = $_POST['apartamento'];
	$sql = "update usuario set usuario_ap = '$apartamento' where usuario_id = $id_usuario";
}

if (mysqli_query($link, $sql)) {
	header('Location: dados_pessoais.php');
}
