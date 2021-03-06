<?php

  require_once('../model/Endereco.php');
  require_once('../model/Propriedade.php');

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

  <title>Buscar Propriedade - Apiários e Propriedades</title>

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
            <a class="collapse-item" href="buscar-propriedade-para-cadastrar-apiario.php">Apiário</a>
            <a class="collapse-item" href="cadastrar-propriedade.php">Propriedade</a>
            <a class="collapse-item" href="buscar-apiario-para-cadastrar-caixa.php">Caixa</a>
            <a class="collapse-item" href="buscar-propriedade-para-cadastrar-medicao.php">Medição Climática</a>
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
            <a class="collapse-item" href="busca-por-apiario.php">Apiário</a>
            <a class="collapse-item active" href="busca-por-propriedade.php">Propriedade</a>
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
                <a class="dropdown-item" href="../controler/logout.php">
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
                        Propriedade removida com sucesso
                      </div>
                    ';
                  } else {
                    echo '
                      <div class="alert alert-danger" role="alert">
                        Houve um erro ao tentar remover a propriedade
                      </div>
                    ';
                  }

                  unset($_SESSION['erro']);
                }

                 if(isset($_SESSION['status'])){
                  if($_SESSION['status']){
                    echo '
                      <div class="alert alert-success" role="alert">
                        Propriedade alterada com sucesso
                      </div>
                    ';
                  } else {
                    echo '
                      <div class="alert alert-danger" role="alert">
                        Houve um erro ao tentar alterar a proprieade
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
                  <form method="post" action="../controler/buscar-por-propriedade.php">
                    <h6 class="m-0 font-weight-bold text-primary">Buscar Propriedade</h6>

                    <hr class="sidebar-divider d-none d-md-block">

                    <div class="row">
                      <div class="col-lg-1">
                        <input type="checkbox" id="check-area-destinada" name="check-area-destinada">
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="area-destinada">Área Destinada</label>
                          <input type="text" id="area-destinada" name="area-destinada" class="form-control" onClick="selecionarCheck('check-area-destinada')">
                        </div>
                      </div>
                    </div>                    

                    <div class="row">
                      <div class="col-lg-1">
                        <input type="checkbox" id="check-endereco" name="check-endereco">
                      </div>
                      <div class="col-lg-6">
                        <label for="endereco">Endereço</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-10">
                        <div class="form-group">
                          <label for="logradouro">Logradouro (Rua, Avenida, ...)</label>
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
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="complemento">Complemento</label>
                          <input type="text" id="complemento" name="complemento" class="form-control" onClick="selecionarCheck('check-endereco')">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="bairro">Bairro</label>
                          <input type="text" id="bairro" name="bairro" class="form-control" onClick="selecionarCheck('check-endereco')">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="comunidade">Comunidade</label>
                          <input type="text" id="comunidade" name="comunidade" class="form-control" onClick="selecionarCheck('check-endereco')">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cidade">Cidade</label>
                          <input type="text" id="cidade" name="cidade" class="form-control" onClick="selecionarCheck('check-endereco')">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="estado">Estado</label>
                          <input type="text" id="estado" name="estado" class="form-control" onClick="selecionarCheck('check-endereco')">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cep">CEP</label>
                          <input type="text" id="cep" name="cep" class="form-control" onClick="selecionarCheck('check-endereco')">
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
                    if(isset($_SESSION['propriedades'])){
                      $p = $_SESSION['propriedades'];

                      $propriedades = array();
                      for($i=0; $i<count($p); $i++){
                        $propriedade = unserialize($p[$i]);
                        array_push($propriedades, $propriedade);
                      }                      

                      if(count($propriedades) > 0){
                        echo '<div class="card shadow h-100 py-2 mt-2"><div class="card-body"><div class="table-responsive"><table class="table" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>ID</th><th>Endereço</th><th>Área Destinada</th><th>Ações</th></tr></thead><tfoot><tr><th>ID</th><th>Endereço</th><th>Área Destinada</th><th>Ações</th></tr></tfoot><tbody>';

                        for($i=0; $i<count($propriedades); $i++){
                          $endereco = $propriedades[$i]->getEndereco()->getLogradouro();
                          if($propriedades[$i]->getEndereco()->getNumero() != ''){
                            $endereco .= ', ' . $propriedades[$i]->getEndereco()->getNumero(); 
                          }
                          if($propriedades[$i]->getEndereco()->getComplemento() != ''){
                            $endereco .= ', ' . $propriedades[$i]->getEndereco()->getComplemento(); 
                          }
                          if($propriedades[$i]->getEndereco()->getBairro() != ''){
                            $endereco .= ', ' . $propriedades[$i]->getEndereco()->getBairro(); 
                          }
                          if($propriedades[$i]->getEndereco()->getComunidade() != ''){
                            $endereco .= ', ' . $propriedades[$i]->getEndereco()->getComunidade(); 
                          }
                          if($propriedades[$i]->getEndereco()->getCidade() != ''){
                            $endereco .= ', ' . $propriedades[$i]->getEndereco()->getCidade(); 
                          }
                          if($propriedades[$i]->getEndereco()->getEstado() != ''){
                            $endereco .= ', ' . $propriedades[$i]->getEndereco()->getEstado(); 
                          }
                          if($propriedades[$i]->getEndereco()->getCep() != ''){
                            $endereco .= ', ' . $propriedades[$i]->getEndereco()->getCep(); 
                          }

                          echo '<tr><td>' . $propriedades[$i]->getId() .'</td><td>' . $endereco . '</td><td>' . $propriedades[$i]->getAreaDestinada() . '</td><td><td><a href="editar-propriedade.php?propriedade=' . $i . '" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pencil-alt"></i></a> <td><button class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#removerPropriedade' . $i . '"><i class="fas fa-times"></i></button></td></tr>';
                        }

                        echo '</tbody></table></div></div></div>';

                        //unset($_SESSION['propriedades']);

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
            if(isset($_SESSION['propriedades'])){
              $p = $_SESSION['propriedades'];

              $propriedades = array();
              for($i=0; $i<count($p); $i++){
                $propriedade = unserialize($p[$i]);
                array_push($propriedades, $propriedade);
              }                      

              if(count($propriedades) > 0){
                for($i=0; $i<count($propriedades); $i++){
                  echo '
                  <div class="modal fade" id="removerPropriedade' . $i .'" >
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Remover Propriedade</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                          Clique em "Remover" abaixo se você deseja remover a propriedade dos registros
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <a href="../controler/remover-propriedade.php?propriedade=' . $i .'" class="btn btn-danger">Remover</a>
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

   <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
