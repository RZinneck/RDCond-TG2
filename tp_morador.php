<?php

session_start();

require_once('db.class.php'); // arquivo importado para dentro desse script

// verificando se usuário está logado, senão fecha a sessão
if (!isset($_SESSION['email'])) {
  header('Location: index.php?erro=2');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Tela principal do morador</title>
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

        <div class="img-logo-principal"></div>

      </div> <!-- fecha header -->

      <!-- navbar -->
      <div class="collapse navbar-collapse" id="barra-navegacao">
        <ul class="nav navbar-nav navbar-right">
          <li> <a href="sair.php">sair</a> </li>
        </ul>
      </div> <!-- fecha navbar -->

    </div> <!-- fecha container -->
  </nav> <!-- fecha nav -->

  <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

  <div class="container tela-principal fadeIn">

    <div class="col-md-3"></div>

    <div class="col-md-6">

      <div class="centralizar-texto">
        <h3 class="dados"><br>Seja bem vindo(a)!<br><br></h3>
        <h3>Por favor, confirme alguns dados:</h3><br>
      </div>

      <div class="col-md-3"></div>
      <div class="col-md-6">
        <form action="morador_insere_condominio.php" method="post">
          <h4>Código do condomínio</h4>
          <input class="form-control" name="cond_codigo" placeholder="Código alfanumérico de 8 caracteres" required="requiored"></input><br>
          <h4>Número do apartamento</h4>
          <input class="form-control" name="numero_ap" placeholder="Ex: 41" required="requiored"></input><br>
          <input type="submit" class="btn btn-cinza form-control" value="Confirmar"></input><br><br><br>
        </form>
      </div>
      <div class="col-md-3"></div>

    </div> <!-- fecha col-md-6 dados -->

    <div class="col-md-3"></div>

  </div> <!-- fecha container tela-principal-->

  <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>

</html>