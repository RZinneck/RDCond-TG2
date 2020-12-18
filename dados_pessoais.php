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

  <title>Dados pessoais</title>
  <link rel="icon" href="imagens/favicon.ico">

  <!-- jquery - link cdn -->
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <!-- bootstrap - link cdn -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link href="estilo.css" rel="stylesheet">
</head>

<!-- ------------------------------------------------------------------------------------------------------------------------------ -->

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

        <a href="home.php"><div class="img-logo-principal"></div></a>
      </div> <!-- fecha header -->

      <!-- navbar -->
      <div class="collapse navbar-collapse nav-home" id="barra-navegacao">
        <ul class="nav navbar-nav navbar-right">
          <!-- escrevendo o e-mail do usuario na barra -->
          <li> <a href="home.php">Home</a></li>
          <li> <a href="dados_condominio.php"><?php print_r($cond_nome) ?></a></li>
          <li> <a href="dados_pessoais.php" class="fundo-cinza-claro"><?php print_r($usuario_nome) ?></a></li>
          <li> <a href="sair.php">sair</a> </li>
        </ul>
      </div> <!-- fecha navbar -->
    </div> <!-- fecha container -->
  </nav> <!-- fecha nav -->

  <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

  <!-- formulário modal para capturar nome -->
  <form method="post" action="atualizar_dados.php" class="modal fade in" id="atualizar_nome">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header lista">
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
          <h4 class="modal-title centralizar-texto texto-cinza">Atualização de dados</h4>
        </div>
        <div class="modal-body lista">
          <div class="form-group">
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite aqui" required="requiored">
          </div>
        </div>
        <div class="modal-footer lista">
          <button type="submit" class="btn btn-cinza form-control">
            Atualizar
          </button>
        </div>
      </div>
    </div>
  </form>

  <!-- formulário modal para capturar sobrenome -->
  <form method="post" action="atualizar_dados.php" class="modal fade in" id="atualizar_sobrenome">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-header lista">
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
          <h4 class="modal-title centralizar-texto texto-cinza">Atualização de dados</h4>
        </div>
        <div class="modal-body lista">
          <div class="form-group">
            <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Digite aqui" required="requiored">
          </div>
        </div>
        <div class="modal-footer lista">
          <button type="submit" class="btn btn-cinza form-control">
            Atualizar
          </button>
        </div>
      </div>
    </div>
  </form>

  <!-- formulário modal para capturar número do apartamento-->
  <form method="post" action="atualizar_dados.php" class="modal fade in" id="atualizar_apartamento">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header lista">
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
          <h4 class="modal-title centralizar-texto texto-cinza">Atualização de dados</h4>
        </div>
        <div class="modal-body lista">
          <div class="form-group">
            <input type="text" class="form-control" id="apartamento" name="apartamento" placeholder="Digite aqui" required="requiored">
          </div>
        </div>
        <div class="modal-footer lista">
          <button type="submit" class="btn btn-cinza form-control">
            Atualizar
          </button>
        </div>
      </div>
    </div>
  </form>

  <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

  <!-- container tela principal -->
  <div class="container tela-principal fadeIn">

    <div>
      <h3 class="centralizar-texto texto-cinza">Dados pessoais</h3>
    </div>

    <!-- efeito -->
    <div class="container centralizar-texto">
      <div class="col-md-3"> </div>
      <div class="col-md-6 dados1">
        <div><br><br></div>
      </div>
      <div class="col-md-3"> </div>
    </div>

    <!-- container dos dados pessoais -->
    <div class="container">

      <div class="col-md-3"></div>

      <div class="col-md-6 dados"><br>

        <!-- espaçamento da esquerda -->
        <div class="col-md-1"></div>

        <div class="col-md-7">
          <h4>Nome: <?php print_r($usuario_nome) ?></h4>
          <h4>Sobrenome: <?php print_r($usuario_sobrenome) ?></h4>
          <h4>Apartamento: <?php print_r($usuario_ap) ?></h4>
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-3">
          <a href="" data-toggle="modal" data-target="#atualizar_nome">
            <h4 class="texto-branco">alterar</h4>
          </a>
          <a href="" data-toggle="modal" data-target="#atualizar_sobrenome">
            <h4 class="texto-branco">alterar</h4>
          </a>
          <a href="" data-toggle="modal" data-target="#atualizar_apartamento">
            <h4 class="texto-branco">alterar</h4><br>
          </a>
        </div> <!-- fecha col-md-3 -->

      </div> <!-- fecha col-md-6 dados1 -->

      <div class="col-md-3"></div>

    </div> <!-- fecha container dos dados pessoais -->

  </div> <!-- fecha container tela principal -->

  <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>