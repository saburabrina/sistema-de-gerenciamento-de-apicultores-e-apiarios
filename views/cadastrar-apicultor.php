<?php

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

  <title>Cadastrar Apicultor</title>

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
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-plus"></i>
          <span>Cadastrar</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item active" href="cadastrar-apicultor.php">Apicultor</a>
            <a class="collapse-item" href="buscar-apicultor-para-cadastrar-fumegador.php">Fumegador</a>
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
            <a class="collapse-item" href="busca-por-apicultor.php">Apicultor</a>
            <a class="collapse-item" href="busca-por-fumegador.php">Fumegador</a>
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
              <?php
                if(isset($_SESSION['erro'])){
                  if($_SESSION['erro']){
                    echo '
                      <div class="alert alert-danger" role="alert">
                        Propriedade não cadastrada no sistema
                      </div>
                    ';
                  } else {
                    if(isset($_SESSION['status'])){
                      if($_SESSION['status']){
                        echo '
                          <div class="alert alert-success" role="alert">
                            Apicultor cadastrado com sucesso
                          </div>
                        ';
                      } else{
                        echo '
                          <div class="alert alert-danger" role="alert">
                            Não foi possível cadastrar o apicultor
                          </div>
                        ';
                      }

                      unset($_SESSION['status']);
                      unset($_SESSION['erro']);
                    }
                  }
                }
              ?>
            </div>
          </div>

          <div class="row">
            <div class="offset-lg-3 col-lg-6">
              <div class="card shadow h-100 py-2">
                <div class="card-body">
                  <form method="post" action="../controler/cadastrar-apicultor.php">
                    <h6 class="m-0 font-weight-bold text-primary">Informações Pessoais</h6>

                    <hr class="sidebar-divider d-none d-md-block">

                    <div class="form-group">
                      <label for="nome">Nome</label>
                      <input type="text" id="nome" name="nome" class="form-control">
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cpf">CPF</label>
                          <input type="text" id="cpf" name="cpf" class="form-control">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="telefone">Telefone</label>
                          <input type="text" id="telefone" name="telefone" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" id="email" name="email" class="form-control">
                    </div>

                    <div class="row">
                      <div class="col-lg-10">
                        <div class="form-group">
                          <label for="logradouro">Logradouro (Rua, Avenida, ...)</label>
                          <input type="text" id="logradouro" name="logradouro" class="form-control">
                        </div>
                      </div>

                      <div class="col-lg-2">
                        <div class="form-group">
                            <label for="numero">Nº</label>
                          <input type="text" id="numero" name="numero" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="complemento">Complemento</label>
                          <input type="text" id="complemento" name="complemento" class="form-control">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="bairro">Bairro</label>
                          <input type="text" id="bairro" name="bairro" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="comunidade">Comunidade</label>
                          <input type="text" id="comunidade" name="comunidade" class="form-control">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cidade">Cidade</label>
                          <input type="text" id="cidade" name="cidade" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="estado">Estado</label>
                          <input type="text" id="estado" name="estado" class="form-control">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cep">CEP</label>
                          <input type="text" id="cep" name="cep" class="form-control">
                        </div>
                      </div>
                    </div>

                    <h6 class="m-0 font-weight-bold text-primary">Informações Profissionais</h6>

                    <hr class="sidebar-divider d-none d-md-block">

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="perfil">Perfil</label>
                          <select name="perfil" id="perfil" class="custom-select">
                            <option value="cooperado" selected>Cooperado</option>
                            <option value="associado">Associado</option>
                            <option value="particular">Particular</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="certificacao">Certificação</label>
                          <select name="certificacao" id="certificacao" class="custom-select">
                            <option value="nao" selected>Não possui</option>
                            <option value="sif">SIF</option>
                            <option value="sie">SIE</option>
                            <option value="sim">SIM</option>
                            <option value="outra">Outra</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="offset-lg-6 col-lg-6">
                        <div class="form-group">
                          <input type="text" name="outra-certificacao" class="form-control">
                        </div>
                      </div>
                    </div>

                    <h6 class="m-0 font-weight-bold text-primary">Informações da Propriedade</h6>

                    <hr class="sidebar-divider d-none d-md-block">

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="vinculo">Vínculo</label>
                          <select name="vinculo" id="vinculo" class="custom-select">
                            <option value="propria" selected>Própria</option>
                            <option value="arrendada">Arrendada</option>
                            <option value="cedida">Cedida</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-10">
                        <div class="form-group">
                          <label for="logradouroPropriedade">Logradouro (Rua, Avenida, ...)</label>
                          <input type="text" id="logradouroPropriedade" name="logradouroPropriedade" class="form-control">
                        </div>
                      </div>

                      <div class="col-lg-2">
                        <div class="form-group">
                            <label for="numeroPropriedade">Nº</label>
                          <input type="text" id="numeroPropriedade" name="numeroPropriedade" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="complementoPropriedade">Complemento</label>
                          <input type="text" id="complementoPropriedade" name="complementoPropriedade" class="form-control">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="bairroPropriedade">Bairro</label>
                          <input type="text" id="bairroPropriedade" name="bairroPropriedade" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="comunidadePropriedade">Comunidade</label>
                          <input type="text" id="comunidadePropriedade" name="comunidadePropriedade" class="form-control">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cidadePropriedade">Cidade</label>
                          <input type="text" id="cidadePropriedade" name="cidadePropriedade" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="estadoPropriedade">Estado</label>
                          <input type="text" id="estadoPropriedade" name="estadoPropriedade" class="form-control">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="cepPropriedade">CEP</label>
                          <input type="text" id="cepPropriedade" name="cepPropriedade" class="form-control">
                        </div>
                      </div>
                    </div>

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
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#cpf').mask('000.000.000-00');
      $('#telefone').mask('(00)0000-0000');
      $('#cep').mask('00000-000');
      $('#cepPropriedade').mask('00000-000');
    });
  </script>

</body>

</html>
