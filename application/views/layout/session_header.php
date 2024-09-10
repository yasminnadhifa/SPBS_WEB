<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Console</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/assets/modules/summernote/summernote-bs4.css">
  
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/assets/node_modules/prismjs/themes/prism.css">


  <link rel="stylesheet" href="<?= base_url() ?>template/dist/assets/modules/chocolat/dist/css/chocolat.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/assets/css/components.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins');

    * {
      font-family: 'Poppins', sans-serif;
      src: url('https://fonts.googleapis.com/css?family=Poppins');
    }

  </style>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg" ></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
          <div class="search-element">

            <div class="search-backdrop"></div>

          </div>
        </form>
        <ul class="navbar-nav navbar-right">


          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?= base_url() ?>template/dist/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block"><?= $user['nama']; ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

              <a href="<?= base_url('Console/logout') ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">SPBS WEB</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SPBS</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="<?= base_url('Console/dashboard') ?>">
                <div class="test"><i class="fas fa-th-large test"></i>  <span>Dashboard</span> </div>
              </a></li>
            <li class="menu-header">Starter</li>

            <li><a class="nav-link" href="<?= base_url('Console/pegawai') ?>"><i class="far fa-square"></i> <span>Pegawai</span></a></li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Berkas</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" href="<?= base_url('Console/berkas') ?>">Daftar Berkas</a></li>
                <li><a class="nav-link" href="<?= base_url('Console/add_berkas') ?>">Enkripsi</a></li>
              </ul>
            </li>
            <li><a class="nav-link" href="<?= base_url('Console/pengaduan') ?>"><i class="far fa-square"></i> <span>Pengaduan</span></a></li>
            


          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">

          </div>
        </aside>
      </div>