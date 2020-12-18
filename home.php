<?php

session_start();

require_once('db.class.php'); // instrução usada para pegar o nome do condimínio e deixar na tela home
$objDb = new db();
$link = $objDb->conecta_mysql();

$email = $_SESSION['email']; // variavel usada para definir email na barra. Usado também na instrução abaixo
$usuario_tipo = $_SESSION['usuario_tipo'];

// pesquisar o cond_id para usar na instrução abaixo
$sql = "SELECT * FROM usuario WHERE usuario_email = '$email'";
if (mysqli_query($link, $sql)) {
  $resultado_id = mysqli_query($link, $sql);
  $dados_usuario = mysqli_fetch_array($resultado_id);
  $usuario_nome = $dados_usuario['usuario_nome'];
  $usuario_sobrenome = $dados_usuario['usuario_sobrenome'];
  $usuario_ap = $dados_usuario['usuario_ap'];
  $cond_id = $_SESSION['fk_condominio'] = $dados_usuario['fk_condominio'];
  $_SESSION['usuario_ap'] = $dados_usuario['usuario_ap']; // variavel de sessão definida para usar no get_mural para colocar numero_ap do lado dos nomes
}

// procurar o condominio por meio do cond_id atribuido na instrução acima. Variavel cond_nome usada para colocar o nome do cond
$sql = "SELECT * FROM condominio WHERE cond_id = '$cond_id'";
if (mysqli_query($link, $sql)) {
  $resultado_id = mysqli_query($link, $sql);
  $dados_usuario = mysqli_fetch_array($resultado_id);
  $cond_nome = $dados_usuario['cond_nome'];
  $cond_codigo = $dados_usuario['cond_codigo'];
}

//-- ---------------------------------------------------------------------------------------------------------------------------- -->

// verificando se usuário está logado, senão fecha a sessão
if (!isset($_SESSION['id_usuario'])) {
  header('Location: index.php?erro=2');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Home</title>
  <link rel="icon" href="imagens/favicon.ico">

  <!-- jquery - link cdn -->
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <!-- bootstrap - link cdn -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link href="estilo.css" rel="stylesheet">

  <!-- ------------------------------------------ ativar evento de botão para AVISO -->

  <script type="text/javascript">
    $(document).ready(function() {

      // associar o evento de click ao botão
      $('#btn_aviso').click(function() {
        if ($('#texto_aviso').val().length > 0) {
          $.ajax({
            url: 'inclui_aviso.php',
            method: 'post',
            data: $('#form_aviso').serialize(),
            success: function(data) {
              $('#texto_aviso').val('');
              atualizaAviso();
            }
          });
        }
      });

      function atualizaAviso() { //carrega os AVISOS
        $.ajax({
          url: 'get_aviso.php',
          success: function(data) {
            $("#avisos").html(data);
          }
        });
      }

      atualizaAviso();
    });

    // -------------------------------------------- ativar evento de botão para MURAL

    $(document).ready(function() {

      // associar o evento de click ao botão
      $('#btn_mural').click(function() {
        if ($('#texto_mural').val().length > 0) {
          $.ajax({
            url: 'inclui_mural.php',
            method: 'post',
            data: $('#form_mural').serialize(),
            success: function(data) {
              $('#texto_mural').val('');
              atualizaMural();
            }
          });
        }
      });

      function atualizaMural() { //carrega o MURAL
        $.ajax({
          url: 'get_mural.php',
          success: function(data) {
            $("#mural").html(data);
          }
        });
      }

      atualizaMural();

    });
  </script>

</head>

<body class="capa-home">

  <!-- nav -->
  <nav class="navbar navbar-fixed-top navbar-inverse navbar-transparente">

    <!-- container -->
    <div class="container">

      <!-- header -->
      <div class="navbar-header">

        <!-- botao toggle (aquele responsivo) -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barra-navegacao">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button> <!-- fechar botao toggle (aquele responsivo) -->

        <a href="home.php">
          <div class="img-logo-principal"></div>
        </a>

      </div> <!-- fecha header -->

      <!-- navbar -->
      <div class="collapse navbar-collapse nav-home" id="barra-navegacao">
        <ul class="nav navbar-nav navbar-right">
          <li> <a href="home.php" class="fundo-cinza-claro">Home</a></li>
          <li> <a href="dados_condominio.php"><?php print_r($cond_nome) ?></a></li>
          <li> <a href="dados_pessoais.php"><?php print_r($usuario_nome) ?></a></li>
          <li> <a href="sair.php">sair</a> </li>
        </ul>
      </div> <!-- fecha navbar -->
    </div> <!-- fecha container -->
  </nav> <!-- fecha nav -->

  <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

  <div class="container tela-principal fadeIn">

    <div class="col-md-1"></div>

    <!-- aviso -->
    <div class="col-md-5">
      <h3 class="centralizar-texto texto-cinza dados1"><br>Quadro de avisos<br><br></h3><br>
      <?php
      if ($usuario_tipo == 2) {
        echo '
          <div class="panel panel-default borda-arredondada">
            <div class="panel-body">
              <form id="form_aviso" class="input-group">
                <input type="text" id="texto_aviso" name="texto_aviso" class="form-control" placeholder="Digite um novo aviso" maxlength="400">
                </input>
                <span class="input-group-btn">
                  <button class="btn btn-vermelho" id="btn_aviso" type="button">Postar</button>
                </span>
              </form>
            </div>
          </div> ';
      } ?>
      <div id="avisos" class="list-group"></div> <br><br><br> <!-- tag <br> usada para espaçar tela do rodapé -->
    </div>

    <!-- mural -->
    <div class="col-md-5">
      <h3 class="centralizar-texto texto-cinza dados"><br>Mural dos moradores<br><br></h3><br>
      <div class="panel panel-default borda-arredondada">
        <div class="panel-body">
          <form id="form_mural" class="input-group">
            <input type="text" id="texto_mural" name="texto_mural" class="form-control" placeholder="Reclamação, sugestão ou elogio" maxlength="400"></input>
            <span class="input-group-btn">
              <button class="btn btn-cinza" id="btn_mural" type="button">Postar</button>
            </span>
          </form>
        </div>
      </div>
      <div id="mural" class="list-group"></div> <br><br><br> <!-- tag <br> usada para espaçar tela do rodapé -->
    </div>

    <div class="col-md-1"></div>

  </div> <!-- fecha tela principal -->

  <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>