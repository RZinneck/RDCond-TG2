<?php

session_start();

require_once('db.class.php'); // arquivo importado para dentro desse script

$cond_codigo = $_POST['cond_codigo']; // variavel pega por meio do formulario na tp_morador
$numero_ap = $_POST['numero_ap']; // variavel pega por meio do formulario na tp_morador
$id_usuario = $_SESSION['id_usuario'];

$objDb = new db();
$link = $objDb->conecta_mysql(); // conectando ao banco de dados

// Instrução para definir o condominio do morador. Comando pega info do condominio por meio do código digitado pelo morador
$sql = "SELECT * FROM condominio WHERE cond_codigo = '$cond_codigo'";

if (mysqli_query($link, $sql)) {
	$resultado_id = mysqli_query($link, $sql);
	$dados_usuario = mysqli_fetch_array($resultado_id);
	$cond_id = $dados_usuario['cond_id'];
}

// Instrução para definir o condominio do morador. Comando para inserir o cond_id da tabela condominio para fk_condominio na tabela usuario
$sql = "update usuario set fk_condominio = '$cond_id', usuario_ap = '$numero_ap' where usuario_id = $id_usuario";

if (mysqli_query($link, $sql)) {
	header('Location: home.php');
} else {
	echo "<script> alert('Código do condomínio inválido. Tente novamente ou consulte seu síndico para confirmar o código.'); 
		window.location.href = 'tp_morador.php'
		</script>";
}
