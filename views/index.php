<?php
  session_start();
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Entrar</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="post" action="../controler/login.php">
      <img class="mb-4" src="img/bee.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal text-white">Nome do Sistema</h1>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <?php
              if(isset($_SESSION['erro'])){
                if($_SESSION['erro'] == -1){
                  echo '
                    <div class="alert alert-warning" role="alert">
                      Senha incorreta
                    </div>
                  ';
                } else if($_SESSION['erro'] == 1){
                  echo '
                    <div class="alert alert-danger" role="alert">
                      Usuário não cadastrado no sistema
                    </div>
                  ';
                }

                unset($_SESSION['erro']);
              }
            ?>
          </div>
        </div>
      </div>
      <label for="cpf" class="sr-only">CPF</label>
      <input type="cpf" id="cpf" name="cpf" class="form-control" placeholder="CPF" required autofocus>
      <label for="senha" class="sr-only">Senha</label>
      <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
      <button class="btn btn-lg btn-warning btn-block" type="submit">Entrar</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#cpf').mask('000.000.000-00');
      });
    </script>
  </body>
</html>
