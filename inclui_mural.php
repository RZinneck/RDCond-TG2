<?php

session_start();

// verificando se usuário está logado, senão fecha a sessão
if (!isset($_SESSION['id_usuario'])) {
	header('Location: index.php?erro=2');
}

require_once('db.class.php'); // arquivo importado para dentro desse script

$texto_mural = $_POST['texto_mural'];
$id_usuario = $_SESSION['id_usuario'];
$id_cond = $_SESSION['fk_condominio'];

if ($texto_mural == '' || $id_usuario == '') {
	die();
}

$objDb = new db();
$link = $objDb->conecta_mysql(); // conectando ao banco de dados

$sql = "INSERT INTO mural(mural_texto, fk_usuario, fk_condominio) values ('$texto_mural', '$id_usuario', '$id_cond')";

mysqli_query($link, $sql);
