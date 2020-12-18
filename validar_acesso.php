<?php

session_start();

require_once('db.class.php'); //arquivo importado para dentro desse script

$email = $_POST['email']; //itens que serão pegos do formulario
$senha = md5($_POST['senha']); //criptografia md5 gera um hash de 32 caracteres

// procurando o email e senha no bd
$sql = "SELECT * FROM usuario WHERE usuario_email = '$email' AND usuario_senha = '$senha'";

$objDb = new db();
$link = $objDb->conecta_mysql(); //conectando ao banco de dados

$resultado_id = mysqli_query($link, $sql);

if ($resultado_id) {
	$dados_usuario = mysqli_fetch_array($resultado_id);

	// verificando se é o primeiro acesso do usuario morador
	if ($dados_usuario['usuario_tipo'] == 1 && $dados_usuario['fk_condominio'] == "") {
		$_SESSION['usuario_tipo'] = $dados_usuario['usuario_tipo'];
		$_SESSION['id_usuario'] = $dados_usuario['usuario_id'];
		$_SESSION['email'] = $dados_usuario['usuario_email'];
		header('Location: tp_morador.php');
	}

	// verificando se é o primeiro acesso do usuario sindico
	else if ($dados_usuario['usuario_tipo'] == 2 && $dados_usuario['fk_condominio'] == "") {
		$_SESSION['usuario_tipo'] = $dados_usuario['usuario_tipo'];
		$_SESSION['id_usuario'] = $dados_usuario['usuario_id'];
		$_SESSION['email'] = $dados_usuario['usuario_email'];
		header('Location: tp_sind.php');
	}

	// acesso normal
	else if (isset($dados_usuario['usuario_email'])) {
		$_SESSION['usuario_tipo'] = $dados_usuario['usuario_tipo'];
		$_SESSION['id_usuario'] = $dados_usuario['usuario_id'];
		$_SESSION['email'] = $dados_usuario['usuario_email'];
		header('Location: home.php');
	} else {
		header('Location: index.php?erro=1');
	}
} else {
	echo "Erro na execução da consulta, favor entrar em contato com o administrador do site.";
}
