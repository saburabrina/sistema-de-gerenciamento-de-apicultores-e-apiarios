<?php

  require_once('../model/Producao.php');
  require_once('../model/Apiario.php');

  session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Produção</title>

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
            <a class="collapse-item" href="buscar-apiario-para-cadastrar-producao.php">Produção</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-search"></i>
          <span>Buscar por</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item active" href="busca-por-producao.php">Produção</a>
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

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar por..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar por..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

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

          <div class="row">
            <div class="offset-2 col-lg-8">
              <div class="card shadow h-100 py-2">
                <div class="card-body">
                  <form method="post" action="../controler/buscar-por-producao.php">
                    <h6 class="m-0 font-weight-bold text-primary">Buscar Produção</h6>

                    <hr class="sidebar-divider d-none d-md-block">

                    <div class="row">
                      <div class="col-lg-1">
                          <input type="checkbox" id="check-apiario" name="check-apiario">
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="apiario">Nome do Apiário</label>
                          <input type="text" id="apiario" name="apiario" class="form-control" onClick="selecionarCheck('check-apiario')">
                        </div>
                      </div>

                      <div class="col-lg-1">
                          <input type="checkbox" id="check-rotulo" name="check-rotulo">
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="rotulo">Possui rótulo?</label>
                          <select name="rotulo" id="rotulo" class="custom-select">
                            <option value="" selected></option>
                            <option value="sim">Sim</option>
                            <option value="nao">Não</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-1">
                          <input type="checkbox" id="check-tipo" name="check-tipo">
                      </div>
                      <div class="col-lg-5">
                        <div class="form-group">
                          <label for="tipo">Tipo</label>
                          <select name="tipo" id="tipo" class="custom-select">
                            <option value="" selected></option>
                            <option value="fixa">Fixa</option>
                            <option value="migratoria">Migratória</option>
                            <option value="fixa-migratoria">Fixa/Migratória</option>
                            <option value="pesquisa">Pesquisa</option>
                            <option value="ensino">Ensino</option>
                            <option value="outros">Outros</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-1">
                          <input type="checkbox" id="check-destino" name="check-destino">
                      </div>
                      <div class="col-lg-5">
                        <div class="form-group">
                          <label for="destino">Destino</label>
                          <select name="destino" id="destino" class="custom-select">
                            <option value="" selected></option>
                            <option value="interno">Mercado Interno</option>
                            <option value="externo">Mercado Externo</option>
                            <option value="cooperativa">Cooperativa</option>
                            <option value="entreposto">Entreposto</option>
                            <option value="consumidor">Direto ao Consumidor</option>
                            <option value="outros">Outros</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-1">
                          <input type="checkbox" id="check-material" name="check-material">
                      </div>
                      <div class="col-lg-5">
                        <div class="form-group">
                          <label for="material">Material</label>
                          <input type="text" id="material" name="material" class="form-control" onClick="selecionarCheck('check-material')">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-warning btn-block">Buscar</button>

                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
                  <?php
                    if(isset($_SESSION['producoes'])){
                      $p = $_SESSION['producoes'];

                      $producoes = array();
                      for($i=0; $i<count($p); $i++){
                        $producao = unserialize($p[$i]);
                        array_push($producoes, $producao);
                      }                      

                      if(count($producoes) > 0){
                        echo '<div class="card shadow h-100 py-2 mt-2"><div class="card-body"><div class="table-responsive"><table class="table" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>Apiário</th><th>Rótulo</th><th>Destino</th><th>Tipo</th><th>Material</th></tr></thead><tfoot><tr><th>ID</th><th>Apiário</th><th>Rótulo</th><th>Destino</th><th>Tipo</th><th>Material</th></tr></tfoot><tbody>';

                        for($i=0; $i<count($producoes); $i++){

                          echo '<tr><td>' . $producoes[$i]->getApiario()->getNome() .'</td><td>' . $producoes[$i]->getRotulo() . '</td><td>' . $producoes[$i]->getDestino() . '</td><td>' . $producoes[$i]->getTipo() . '</td><td>' . $producoes[$i]->getMaterial() . '</td><td><a href="editar-producao.php?producao=' . $i . '" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pencil-alt"></i></a> <td><button class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#removerProducao"><i class="fas fa-times"></i></button></td></tr>';
                        }

                        echo '</tbody></table></div></div></div>';

                      }
                    }
                  ?>
            </div>
          </div>

          <?php
            if(isset($_SESSION['producoes'])){
              $p = $_SESSION['producoes'];

              $producoes = array();
              for($i=0; $i<count($p); $i++){
                $producao = unserialize($p[$i]);
                array_push($producoes, $producao);
              }                      

              if(count($producoes) > 0){
                for($i=0; $i<count($producoes); $i++){
                  echo '
                  <div class="modal fade" id="removerProducao' . $i .'" >
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Remover Produção</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                          Clique em "Remover" abaixo se você deseja remover a produção dos registros
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <a href="../controler/remover-producao.php" class="btn btn-danger" data-dismiss="modal">Remover</a>
                        </div>

                      </div>
                    </div>
                  </div>
                  ';
                }
              }
            }
          ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Deseja realmente sair?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecione "Sair" abaixo se você deseja sair para encerrar sua sessão</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="index.html">Sair</a>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function selecionarCheck(id){
      document.getElementById(id).checked = true;
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
