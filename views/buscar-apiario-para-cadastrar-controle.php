<?php

  session_start();
  require_once('../model/Endereco.php');
  require_once('../model/Apiario.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <title>Controle Veterinário e Tratamentos</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                  <form method="post" action="../controler/buscar-por-apiario.php">
                    <h6 class="m-0 font-weight-bold text-primary">Buscar Apiário</h6>

                    <hr class="sidebar-divider d-none d-md-block">

                    <div class="row">
                      <div class="col-lg-1">
                        <input type="checkbox" id="check-nome" name="check-nome">
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="nome">Nome</label>
                          <input type="text" id="nome" name="nome" class="form-control" onClick="selecionarCheck('check-nome')">
                        </div>
                      </div>

                      <div class="col-lg-1">
                        <input type="checkbox" id="check-inscricao" name="check-inscricao">
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="inscricao">Inscrição Estadual</label>
                          <input type="text" id="inscricao" name="inscricao" class="form-control" onClick="selecionarCheck('check-inscricao')">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-1">
                        <input type="checkbox" id="check-dono" name="check-dono">
                      </div>
                      <div class="col-lg-5">
                        <div class="form-group">
                          <label for="dono">Dono</label>
                          <input type="text" id="dono" name="dono" class="form-control" onClick="selecionarCheck('check-dono')">
                        </div>
                      </div>

                      <div class="col-lg-1">
                        <input type="checkbox" id="check-data-fundacao" name="check-data-fundacao">
                      </div>
                      <div class="col-lg-5">
                        <div class="form-group">
                          <label for="data-fundacao">Data Fundação</label>
                          <input type="date" id="data-fundacao" name="data-fundacao" class="form-control" onClick="selecionarCheck('check-data-fundacao')">
                        </div>
                      </div>
                    </div>

                    <div class="row">                   
                      <div class="col-lg-1">
                        <input type="checkbox" id="check-latitude" name="check-latitude">
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="latitude">Latitude</label>
                          <input type="text" id="latitude" name="latitude" class="form-control" onClick="selecionarCheck('check-latitude')">
                        </div>
                      </div>

                      <div class="col-lg-1">
                        <input type="checkbox" id="check-longitude" name="check-longitude">
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="longitude">Longitude</label>
                          <input type="text" id="longitude" name="longitude" class="form-control" onClick="selecionarCheck('check-longitude')">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-1">
                        <input type="checkbox" id="check-endereco" name="check-endereco">
                      </div>
                      <div class="col-lg-6">
                        <h6 class="m-0 font-weight-bold text-secondary" for="endereco">Endereço</h6>
                      </div>
                    </div>

                    <hr class="sidebar-divider d-none d-md-block">

                    <div class="row">
                      <div class="col-lg-10">
                        <div class="form-group">
                          <label for="logradouro">Logradouro</label>
                          <input type="text" id="logradouro" name="logradouro" class="form-control" onClick="selecionarCheck('check-endereco')">
                        </div>
                      </div>

                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="numero">Nº</label>
                          <input type="text" id="numero" name="numero" class="form-control" onClick="selecionarCheck('check-endereco')">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="complemento">Complemento</label>
                          <input type="text" id="complemento" name="complemento" class="form-control" onClick="selecionarCheck('check-endereco')">
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="bairro">Bairro</label>
                          <input type="text" id="bairro" name="bairro" class="form-control" onClick="selecionarCheck('check-endereco')">
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="comunidade">Comunidade</label>
                          <input type="text" id="comunidade" name="comunidade" class="form-control" onClick="selecionarCheck('check-endereco')">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="cidade">Cidade</label>
                          <input type="text" id="cidade" name="cidade" class="form-control" onClick="selecionarCheck('check-endereco')">
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="estado">Estado</label>
                          <input type="text" id="estado" name="estado" class="form-control" onClick="selecionarCheck('check-endereco')">
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="cep">CEP</label>
                          <input type="text" id="cep" name="cep" class="form-control" onClick="selecionarCheck('check-endereco')">
                        </div>
                      </div>
                    </div>

                    <hr class="sidebar-divider d-none d-md-block">

                    <div class="row">
                      <div class="col-lg-1">
                        <input type="checkbox" id="check-instalacao" name="check-instalacao">
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="instalacao">Tipo da Instalação</label>
                          <select name="instalacao" id="instalacao" class="custom-select" onClick="selecionarCheck('check-instalacao')">
                            <option value="" selected></option>
                            <option value="proprio">Recurso Próprio</option>
                            <option value="financiada">Financiada</option>
                          </select>
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
            <div class="offset-2 col-lg-8">
              <?php
                if(isset($_SESSION['apiarios'])){
                  $a = $_SESSION['apiarios'];

                  $apiarios = array();
                  for($i=0; $i<count($a); $i++){
                    $apiario = unserialize($a[$i]);
                    array_push($apiarios, $apiario);
                  }                      

                  if(count($apiarios) > 0){
                    echo '<div class="card shadow h-100 py-2 mt-2"><div class="card-body"><div class="table-responsive"><table class="table" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>Nome</th><th>Dono</th><th>Endereço</th><th>Inscrição Estadual</th></tr></thead><tfoot><tr><th>Nome</th><th>Dono</th><th>Endereço</th><th>Inscrição Estadual</th></tr></tfoot><tbody>';

                    for($i=0; $i<count($apiarios); $i++){
                      $endereco = $apiarios[$i]->getEndereco()->getLogradouro();
                      if($apiarios[$i]->getEndereco()->getNumero() != ''){
                        $endereco .= ', ' . $apiarios[$i]->getEndereco()->getNumero(); 
                      }
                      if($apiarios[$i]->getEndereco()->getComplemento() != ''){
                        $endereco .= ', ' . $apiarios[$i]->getEndereco()->getComplemento(); 
                      }
                      if($apiarios[$i]->getEndereco()->getBairro() != ''){
                        $endereco .= ', ' . $apiarios[$i]->getEndereco()->getBairro(); 
                      }
                      if($apiarios[$i]->getEndereco()->getComunidade() != ''){
                        $endereco .= ', ' . $apiarios[$i]->getEndereco()->getComunidade(); 
                      }
                      if($apiarios[$i]->getEndereco()->getCidade() != ''){
                        $endereco .= ', ' . $apiarios[$i]->getEndereco()->getCidade(); 
                      }
                      if($apiarios[$i]->getEndereco()->getEstado() != ''){
                        $endereco .= ', ' . $apiarios[$i]->getEndereco()->getEstado(); 
                      }
                      if($apiarios[$i]->getEndereco()->getCep() != ''){
                        $endereco .= ', ' . $apiarios[$i]->getEndereco()->getCep(); 
                      }

                      echo '<tr><td>' . $apiarios[$i]->getNome() .'</td><td>$apiarios[$i]->getDono()</td><td>' . $endereco . '</td><td>' . $apiarios[$i]->getInscricaoEstadual() . '<td><a href="cadastrar-controle.php?apiario=' . $i .'" class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></a></td></tr>';
                    }

                    echo '</tbody></table></div></div></div>';
                  }
                }
              ?>
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
          <a class="btn btn-primary" href="login.html">Sair</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
