<?php

  session_start();

  require_once("../model/Apiario.php");

  if(isset($_SESSION['apiarios'])){
    $a = $_SESSION['apiarios'];

    $apiarios = array();
    for($i=0; $i<count($a); $i++){
      $apiario = unserialize($a[$i]);
      array_push($apiarios, $apiario);
    }
  }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cadastrar Controle</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon">
          <img src="img/bee.png" alt="" width="42" height="42">
        </div>
        <div class="sidebar-brand-text mx-3">Sistema</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-home"></i>
          <span>Inicio</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-plus"></i>
          <span>Cadastrar</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="buscar-apiario-para-cadastrar-controle-veterinario.php">Controle Veterinário</a>
            <a class="collapse-item" href="buscar-caixa-para-cadastrar-tratamento.php">Tratamento</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-search"></i>
          <span>Buscar por</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="busca-controle-veterinario.php">Controle Veterinário</a>
            <a class="collapse-item" href="busca-tratamento.php">Tratamento</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nome']; ?></span>
                <!--<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
                <i class="fas fa-user-circle" style="font-size: 30px;"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Alterar Dados Cadastrais
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Sair
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <?php
            if(isset($_SESSION['status'])){
              if($_SESSION['status']){
                echo '
                  <div class="alert alert-success" role="alert">
                    Controle Veterinário cadastrado com sucesso
                  </div>
                ';
              } else {
                echo '
                  <div class="alert alert-danger" role="alert">
                    O Controle Veterinário não pôde ser cadastrado
                  </div>
                ';
              }

              unset($_SESSION['status']);
            }
          ?>

          <div class="row">
            <div class="offset-lg-3 col-lg-6">
              <div class="card shadow h-100 py-2">
                <div class="card-body">
                  <form method="post" action="../controler/cadastrar-controle.php">

                    <h6 class="m-0 font-weight-bold text-primary">Informações do Controle Veterinário</h6>

                    <hr class="sidebar-divider d-none d-md-block">
                  
                    <div class="row">
                      <div class="col-lg-5">
                        <div class="form-group">
                          <label for="data">Data do Exame</label>
                          <input type="date" id="data" name="data" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="nome-veterinario">Nome do Veterinário</label>
                          <input type="text" id="nome-veterinario" name="nome-veterinario" class="form-control">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="crmv">CRMV do Veterinário</label>
                          <input type="text" id="crmv" name="crmv" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="condicao-veterinaria">Condição Veterinária</label>
                          <input type="text" id="condicao-veterinaria" name="condicao-veterinaria" class="form-control">
                        </div>
                      </div>
                    </div>

                    <h6 class="m-0 font-weight-bold text-primary">Informações das Amostras</h6>

                    <hr class="sidebar-divider d-none d-md-block">

                    <h6 class="m-0 font-weight-bold text-secondary text-center mb-3">Amostra 1</h6>


                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="tipo-abelha">Tipo de Abelha</label>
                          <input type="text" id="tipo-abelha" name="tipo-abelha" class="form-control">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="mel">Mel</label>
                          <input type="text" id="mel" name="mel" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="material-biologico">Material Biológico</label>
                          <input type="text" id="material-biologico" name="material-biologico" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div id="novasAmostras">

                    </div>

                    <div class="form-group">
                      <button type="button" class="btn btn-warning btn-icon-split" onClick="adicionarNovaAmostra()">
                        <span class="icon text-white-50">
                          <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Adicionar Nova Amostra</span>
                      </button>
                    </div>

                    <input type="hidden" id="apiario" name="apiario" value="<?php echo $apiarios[$_GET['apiario']]->getNome(); ?>">
                    <input type="hidden" id="numero-amostras" name="numero-amostras" value="1">

                    <button type="submit" class="btn btn-success btn-block">Cadastrar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      
    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  
  <script type="text/javascript">
    let quantidade_amostras = 2;

    function adicionarNovaAmostra(){
      document.getElementById('novasAmostras').innerHTML += '<h6 class="m-0 font-weight-bold text-secondary text-center mb-3">Amostra ' +quantidade_amostras + '</h6><div class="row"><div class="col-lg-6"><div class="form-group"><label for="tipo-abelha-' + quantidade_amostras + '">Tipo de Abelha</label><input type="text" id="tipo-abelha-' + quantidade_amostras + '" name="tipo-abelha-' + quantidade_amostras +'" class="form-control"></div></div><div class="col-lg-6"><div class="form-group"><label for="mel-' + quantidade_amostras +'">Mel</label><input type="text" id="mel-' + quantidade_amostras +'" name="mel-' + quantidade_amostras + '" class="form-control"></div></div></div><div class="row"><div class="col-lg-12"><div class="form-group"><label for="material-biologico-' + quantidade_amostras + '">Material Biológico</label><input type="text" id="material-biologico-' + quantidade_amostras + '" name="material-biologico-' + quantidade_amostras + '" class="form-control"></div></div></div>';
      quantidade_amostras++;

      document.getElementById('numero-amostras').value = quantidade_amostras;
    }
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
