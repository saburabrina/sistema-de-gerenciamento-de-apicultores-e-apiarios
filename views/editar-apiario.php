<?php

  session_start();

  require_once("../model/Apiario.php");
  require_once("../model/Endereco.php");

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

  <title>Editar Apiário</title>

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
            <a class="collapse-item" href="buscar-propriedade-para-cadastrar-apiario.php">Apiário</a>
            <a class="collapse-item" href="cadastrar-propriedade.php">Propriedade</a>
            <a class="collapse-item" href="buscar-apiario-para-cadastrar-caixa.php">Caixa</a>
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
            <a class="collapse-item" href="busca-por-apiario.php">Apiário</a>
            <a class="collapse-item" href="busca-por-propriedade.php">Propriedade</a>
            <a class="collapse-item" href="busca-por-caixa.php">Caixa</a>
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
            <div class="offset-lg-3 col-lg-6">
              <div class="card shadow h-100 py-2">
                <div class="card-body">
                  <form method="post" action="../controler/editar-apiario.php">

                    <div class="form-group">
                      <label for="nome">Nome</label>
                      <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $apiarios[$_GET['apiario']]->getNome(); ?>">
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="dono">Dono</label>
                          <input type="text" id="dono" name="dono" class="form-control" value="<?php echo $apiarios[$_GET['apiario']]->getDono(); ?>">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="inscricao">Inscrição Estadual</label>
                          <input type="text" id="inscricao" name="inscricao" class="form-control" value="<?php echo $apiarios[$_GET['apiario']]->getInscricaoEstadual(); ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="data-fundacao">Data de Fundação</label>
                          <input class="form-control" type="date" id="data-fundacao" name="data-fundacao" value="<?php echo $apiarios[$_GET['apiario']]->getDataFundacao(); ?>">
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="latitude">Latitude</label>
                          <input class="form-control" type="text" id="latitude" name="latitude" value="<?php echo $apiarios[$_GET['apiario']]->getLatitude(); ?>">
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="longitude">Longitude</label>
                          <input class="form-control" type="text" id="longitude" name="longitude" value="<?php echo $apiarios[$_GET['apiario']]->getLongitude(); ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="florada">Florada</label>
                          <select name="florada" id="florada" class="custom-select">
                            <?php
                              if($apiarios[$_GET['apiario']]->getFlorada() == 'eucalipto'){
                                echo'
                                <option value="eucalipto" selected>Eucalipto</option>
                                <option value="laranjeira">Laranjeira Silvestre</option>
                                <option value="silveste">Lavoura</option>
                                <option value="outro">Outro</option>';
                              } else if($apiarios[$_GET['apiario']]->getFlorada() == 'laranjeira') {
                                echo'
                                <option value="eucalipto">Eucalipto</option>
                                <option value="laranjeira" selected>Laranjeira Silvestre</option>
                                <option value="silveste">Lavoura</option>
                                <option value="outro">Outro</option>';
                              } else if($apiarios[$_GET['apiario']]->getFlorada() == 'silvestre') {
                                echo'
                                <option value="eucalipto">Eucalipto</option>
                                <option value="laranjeira">Laranjeira Silvestre</option>
                                <option value="silveste" selected>Lavoura</option>
                                <option value="outro">Outro</option>';
                              } else {
                                echo'
                                <option value="eucalipto">Eucalipto</option>
                                <option value="laranjeira">Laranjeira Silvestre</option>
                                <option value="silveste">Lavoura</option>
                                <option value="outro" selected>Outro</option>';
                              }
                            ?>                            
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="instalacao">Instalação</label>
                          <select name="instalacao" id="instalacao" class="custom-select">
                            <?php
                              if($apiarios[$_GET['apiario']]->getInstalacao() == 'proprio'){
                                echo'
                                <option value="proprio" selected>Recurso Próprio</option>
                                <option value="financiada">Financiada</option>
                                <option value="arrendada">Arrendada</option>';
                              } else if($apiarios[$_GET['apiario']]->getInstalacao() == 'financiada'){
                                echo'
                                <option value="proprio">Recurso Próprio</option>
                                <option value="financiada" selected>Financiada</option>
                                <option value="arrendada">Arrendada</option>';
                              }
                              else {
                                echo'
                                <option value="proprio">Recurso Próprio</option>
                                <option value="financiada">Financiada</option>
                                <option value="arrendada" selected>Arrendada</option>';
                              }
                            ?>                            
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">                      
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input class="form-control" type="text" id="outra-florada" name="outra-florada" value="<?php echo $apiarios[$_GET['apiario']]->getFlorada(); ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="caixas-povoadas">Caixas Povoadas</label>
                          <input type="number" id="caixas-povoadas" name="caixas-povoadas" class="form-control" value="<?php echo $apiarios[$_GET['apiario']]->getNumeroCaixasPovoadas(); ?>">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="caixas-vazias">Caixas Vazias</label>
                          <input type="number" id="caixas-vazias" name="caixas-vazias" class="form-control" value="<?php echo $apiarios[$_GET['apiario']]->getNumeroCaixasVazias(); ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <div><label>Já houve problema sanitário?</label></div>
                          <div class="form-check-inline">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" value="sim" name="sanitario">Sim
                            </label>
                          </div>
                          <div class="form-check-inline">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" value="nao" name="sanitario">Não
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <div><label>Pode ser expandido?</label></div>
                          <div class="form-check-inline">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" value="sim" name="expandido">Sim
                            </label>
                          </div>
                          <div class="form-check-inline">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" value="nao" name="expandido">Não
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <input type="hidden" id="propriedade" name="propriedade" value="<?php echo $apiarios[$_GET['apiario']]->getPropriedade(); ?>"> 

                    <button type="submit" name="submit" class="btn btn-success btn-block">Salvar</button>
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

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
