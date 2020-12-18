<?php

$erro_email = isset($_GET['erro_email']) ? $_GET['erro_email'] : 0;

$erro = isset($_GET['erro']) ? $_GET['erro'] : 0; //identificando o erro no login

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Bem vindo a RD Cond</title>
  <link rel="icon" href="imagens/favicon.ico">

  <!-- jquery - link cdn -->
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <!-- bootstrap - link cdn -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link href="estilo.css" rel="stylesheet">

  <script>
    $(document).ready(function() {

      //verificando se os campos de email e senha estão preenchidos
      $('#btn_login').click(function() {

        var campo_vazio = false;

        if ($('#campo_email').val() == '') {
          $('#campo_email').css({
            'border-color': '#A94442'
          });
          campo_vazio = true;
        } else {
          $('#campo_email').css({
            'border-color': '#CCC'
          });
        }

        if ($('#campo_senha').val() == '') {
          $('#campo_senha').css({
            'border-color': '#A94442'
          });
          campo_vazio = true;
        } else {
          $('#campo_senha').css({
            'border-color': '#CCC'
          });
        }

        if (campo_vazio) return false;

      });

    });

    function Mudarestado(el) {
      var display = document.getElementById(el).style.display;
      if (display == "none")
        document.getElementById(el).style.display = 'block';
      else
        document.getElementById(el).style.display = 'none';
    }
  </script>

</head>

<!-- ------------------------------------------------------------------------------------------------------------------------------ -->

<body class="capa-index">

  <div class="container tela-principal">

    <div class="col-md-4">
      <a href="index.php">
        <div class="img-logo-index fadeIn"></div>
      </a>
    </div>

    <!-- formulario de login -->
    <div class="col-md-4 alinhar-direita fadeIn">

      <!-- metodo post e action, definem como e para onde sera enviado os dados de cadastro do formulario -->
      <form method="post" action="validar_acesso.php" id="logar">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content">

            <!-- cabecalho -->
            <div class="modal-header fundo-cinza">
              <h4 class="modal-title centralizar-texto">Já possui uma conta?
            </div> <!-- fecha cabecalho -->

            <!-- corpo -->
            <div class="modal-body">
              <div class="form-group">
                <input type="text" class="form-control" id="campo_email" name="email" placeholder="E-mail">
              </div>
              <div class="form-group">
                <input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha">
              </div>

              <!-- caso o email ou senha tenha sido digitado errado, aparecer a mensagem abaixo dentro da caixa de formulario -->
              <?php
              if ($erro == 1) {
                echo '<font color="#FF0000">E-mail e/ou senha inválido(s)</font>';
              }
              ?>

            </div> <!-- fecha corpo -->

            <!-- rodape -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-cinza form-control" id="btn_login">Entrar</button><br>
              <div  style="margin: auto auto; width: 50%"><button type="button" class="btn btn-cinza dados1"onclick="Mudarestado('cdt')">Criar nova conta</button></div>
            </div> <!-- fecha rodape -->
          </div>
        </div>
      </form> <!-- fecha formulario de login -->
    </div> <!-- fecha col-md-4 -->

    <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

    <div class="col-md-4">

      <div id="cdt" style="display:none" class="fadeIn">

        <!-- formulario de cadastro -->
        <!-- metodo post e action, definem como e para onde sera enviado os dados de cadastro do formulario -->
        <form method="post" action="registra_usuario.php" id="cadastrar">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">

              <!-- cabecalho -->
              <div class="modal-header fundo-vermelho">
                <h4 class="modal-title centralizar-texto texto-branco">Inscrever-se
                </h4>
              </div>
              <!-- fecha cabecalho -->

              <!-- corpo -->
              <div class="modal-body">

                <div class="form-group">
                  <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required="requiored">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" required="requiored">
                </div>

                <div class="form-group">
                  <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required="requiored">
                  <?php
                  if ($erro_email) {
                    echo '<font style="color:#FF0000"> E-mail já cadastrado</font>';
                  }
                  ?>
                </div>

                <div class="form-group">
                  <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required="requiored">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control" id="rsenha" name="rsenha" placeholder="Repita a senha" required="requiored">
                </div>

                <div class="form-group">
                  <h4 class="centralizar-texto texto-cinza">Cadastrar como</h4>
                  <select id="tipo" name="tipo" class="form-control texto-cinza" required="requiored">
                    <option id="tipo" name="tipo" value="1">Morador</option>
                    <option id="tipo" name="tipo" value="2">Síndico</option>
                  </select>
                </div>

              </div> <!-- fecha corpo -->

              <!-- rodape -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-vermelho form-control" id="btn_cadastro">
                  Cadastrar
                </button>
              </div> <!-- fecha rodape -->
            </div>
          </div>
      </div>
      </form> <!-- fecha formulario de cadastro -->
    </div> <!-- fecha col-md-4 -->

  </div> <!-- fecha container tela principal-->

  <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

  <!-- rodape -->
  <footer class="fundo-cinza-escuro" id="rodape">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">

        <div class="col-md-4">
        </div>

        <div class="col-md-4 centralizar-texto">
          <ul class="nav">
            <li>
              <h4><a href="index.php">RD COND</a></h4>
            </li>
          </ul>
        </div>

        <div class="col-md-4">
          <ul class="nav navbar-nav navbar-right texto-branco">
            <li>
              <h4><a href="contato.php"> Contato </a></h4>
            </li>
            <li class="texto-cinza-escuro">......</li>
            <li>
              <h4><a href="quemsomos.php"> Quem somos </a></h4>
            </li>
            <li class="texto-cinza-escuro">......</li>
            <li>
              <h4><a href="ajuda.php"> Ajuda </a></h4>
            </li>
          </ul>
        </div>

      </div> <!-- fecha row -->
    </div> <!-- fecha container -->
  </footer> <!-- fecha rodape -->

  <!-- -------------------------------------------------------------------------------------------------------------------------------- -->

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>