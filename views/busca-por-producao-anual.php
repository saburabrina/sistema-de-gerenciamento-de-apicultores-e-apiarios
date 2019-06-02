<?php

  require_once('../model/ProducaoAnual.php');

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

  <title>Buscar Produção Anual - Apicultores e Materiais</title>

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
            <a class="collapse-item" href="cadastrar-apicultor.php">Apicultor</a>
            <a class="collapse-item" href="buscar-apicultor-para-cadastrar-fumegador.php">Fumegador</a>
            <a class="collapse-item" href="buscar-apicultor-para-cadastrar-producao.php">Produção Anual</a>
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
            <a class="collapse-item" href="busca-por-apicultor.php">Apicultor</a>
            <a class="collapse-item" href="busca-por-fumegador.php">Fumegador</a>
            <a class="collapse-item active" href="busca-por-producao-anual.php">Produção Anual</a>
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

          <div class="row">
            <div class="offset-2 col-lg-8">
              <?php
                if(isset($_SESSION['erro'])){
                  if($_SESSION['erro']){
                    echo '
                      <div class="alert alert-success" role="alert">
                        Produção Anual removida com sucesso
                      </div>
                    ';
                  } else {
                    echo '
                      <div class="alert alert-danger" role="alert">
                        Houve um erro ao tentar remover a produção anual
                      </div>
                    ';
                  }

                  unset($_SESSION['erro']);
                }

                if(isset($_SESSION['status'])){
                  if($_SESSION['status']){
                    echo '
                      <div class="alert alert-success" role="alert">
                        Produção Anual alterada com sucesso
                      </div>
                    ';
                  } else {
                    echo '
                      <div class="alert alert-danger" role="alert">
                        Houve um erro ao tentar alterar a produção anual
                      </div>
                    ';
                  }

                  unset($_SESSION['status']);
                }
              ?>
            </div>
          </div>

          <div class="row">
            <div class="offset-2 col-lg-8">
              <div class="card shadow h-100 py-2">
                <div class="card-body">
                  <form method="post" action="../controler/buscar-por-producao-anual.php">
                    <h6 class="m-0 font-weight-bold text-primary">Buscar Produção Anual</h6>

                    <hr class="sidebar-divider d-none d-md-block">

                    <div class="row">
                      <div class="col-lg-1">
                        <input type="checkbox" id="check-ano" name="check-ano">
                      </div>
                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="ano">Ano</label>
                          <input type="text" class="form-control" id="ano" name="ano" onClick="selecionarCheck('check-ano')">
                        </div> 
                      </div>

                      <div class="col-lg-1">
                        <input type="checkbox" id="check-apicultor" name="check-apicultor">
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="apicultor">CPF do Apicultor</label>
                          <input type="text" class="form-control" id="apicultor" name="apicultor" onClick="selecionarCheck('check-apicultor')">
                        </div> 
                      </div>

                      <div class="col-lg-1">
                        <input type="checkbox" id="check-valor" name="check-valor">
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="valor">Valor da Produção</label>
                          <input type="text" class="form-control" id="valor" name="valor" onClick="selecionarCheck('check-valor')">
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
                    if(isset($_SESSION['producoes_anuais'])){
                      $p = $_SESSION['producoes_anuais'];

                      $producoesAnuais = array();
                      for($i=0; $i<count($p); $i++){
                        $producao = unserialize($p[$i]);
                        array_push($producoesAnuais, $producao);
                      }                      

                      if(count($producoesAnuais) > 0){
                        echo '<div class="card shadow h-100 py-2 mt-2"><div class="card-body"><div class="table-responsive"><table class="table" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>Ano</th><th>Apicultor</th><th>Valor da Produção</th><th>Ações</th></tr></thead><tfoot><tr><th>Ano</th><th>Apicultor</th><th>Valor da Produção<th>Ações</th></tr></tfoot><tbody>';

                        for($i=0; $i<count($producoesAnuais); $i++){
                          echo '<tr><td>' . $producoesAnuais[$i]->getAno() .'</td><td>' . $producoesAnuais[$i]->getApicultor() . '</td><td>' . $producoesAnuais[$i]->getValorDaProducao() . '<td><a href="editar-producao-anual.php?producao=' . $i . '" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pencil-alt"></i></a> <button class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#removerProducaoAnual' . $i . '"><i class="fas fa-times"></i></button></td></tr>';
                        }

                        //unser($_SESSION['fumegadores']);
                        echo '</tbody></table></div></div></div>';

                      } else {
                        echo '
                          <div class="card shadow h-100 py-2 mt-2">
                            <div class="card-body">
                              <p class="text-lg text-center">Não foram encontrados resultados</p>
                            </div>
                          </div>
                        ';
                      }
                    }
                  ?>
            </div>
          </div>

          <?php
            if(isset($_SESSION['producoes_anuais'])){
              $p = $_SESSION['producoes_anuais'];

              $producoesAnuais = array();
              for($i=0; $i<count($p); $i++){
                $producao = unserialize($p[$i]);
                array_push($producoesAnuais, $producao);
              }                      

              if(count($producoesAnuais) > 0){
                for($i=0; $i<count($producoesAnuais); $i++){
                  echo '
                  <div class="modal fade" id="removerProducaoAnual' . $i .'" >
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Remover Produção Anual</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                          Clique em "Remover" abaixo se você deseja remover a produção anual dos registros
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <a href="../controler/remover-producao-anual.php?producao=' . $i . '" class="btn btn-danger">Remover</a>
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#apicultor').mask('000.000.000-00');
    });
  </script>

</body>

</html>
