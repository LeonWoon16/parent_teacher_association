<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= (isset($pageTitle)) ? $pageTitle :'Document'; ?></title>
  <base href="/">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
      <li class="nav-item">
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/usercontroller" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PTA system</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
        
        <a href="/usercontroller" class="d-block"><?= $userInfo['fld_name'] ?> as <?= $userInfo['fld_role'] ?> </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          


          <li class="nav-item">
            <a href="<?= route_to('user.home') ?>" class="nav-link <?= (current_url() == base_url('user/home')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= route_to('user.profile') ?>" class="nav-link <?= (current_url() == base_url('user/profile')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= route_to('user.activity') ?>" class="nav-link <?= (current_url() == base_url('user/activity')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Activity
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?= route_to('user.result') ?>" class="nav-link <?= (current_url() == base_url('user/result')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-check"></i>
              <p>
                Result
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= route_to('user.crowdfunding') ?>" class="nav-link <?= (current_url() == base_url('user/crowdfunding')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Crowd Funding
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= route_to('user.viewTeacher') ?>" class="nav-link <?= (current_url() == base_url('user/viewTeacher')) ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Teachers
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= route_to('user.logout') ?>" class="nav-link <?= (current_url() == base_url('user/logout')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Logout
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= (isset($pageTitle)) ? $pageTitle :'Document'; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= route_to("user.home"); ?>">Home</a></li>
              <li class="breadcrumb-item active"><?= (isset($pageTitle)) ? $pageTitle :'Document'; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <?= $this->renderSection('content'); ?>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="<?= base_url(); ?>">Parent Teacher Association System</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
