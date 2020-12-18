<?php

session_start();

// verificando se usuário está logado, senão fecha a sessão
if (!isset($_SESSION['id_usuario'])) {
	header('Location: index.php?erro=2');
}

require_once('db.class.php'); // arquivo importado para dentro desse script

$id_usuario = $_SESSION['id_usuario'];
$cond_id = $_SESSION['fk_condominio'];

$objDb = new db();
$link = $objDb->conecta_mysql(); // conectando ao banco de dados

$sql = " SELECT date_format(a.aviso_data, '%d %b %Y %T') AS data_inclusao_aviso, a.aviso_texto, u.usuario_nome, u.usuario_ap, u.fk_condominio";
$sql .= " FROM aviso AS a JOIN usuario AS u ON (u.usuario_id = a.fk_usuario) ";
$sql .= " WHERE fk_usuario = $id_usuario ";
// comando responsavel por exibir na tela home, todos as postagens que tenham o id do condominio em comum
$sql .= " OR u.fk_condominio IN (SELECT fk_condominio from usuario WHERE fk_condominio = $cond_id)";
$sql .= " ORDER BY aviso_data DESC ";

$resultado_id = mysqli_query($link, $sql);

if ($resultado_id) {

	//laço de repetição para exibir as postagens
	while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
		echo '<a href="#" class="list-group-item borda-arredondada">';
		echo '<h4 class="list-group-item-heading texto-cinza">' . $registro['usuario_nome'] . ' <span class="texto-vermelho">(síndico)</span> nº ' . $registro['usuario_ap'] . ' <small> - ' . $registro['data_inclusao_aviso'] . ' </small></h4>';
		echo '<p class="list-group-item-text texto-cinza">' . $registro['aviso_texto'] . '</p>';
		echo '</a> <br>';
	}
} else {
	echo 'Erro na consulta dos avisos com o banco de dados.';
}
