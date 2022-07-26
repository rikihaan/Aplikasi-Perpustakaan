<!doctype html>
<html lang="en">

<head>
  <link rel="icon" href="<?= base_url('assets/HomeAssets/img/logo/PPDB 2020.png') ?>" type="image/x-icon">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/HomeAssets/') ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/HomeAssets/jquery-ui/') ?>jquery-ui.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/HomeAssets/jquery-ui/') ?>jquery-ui.theme.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/HomeAssets/') ?>css/all.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>DataTables/datatables.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
  <link rel="stylesheet" href="<?= base_url('assets/HomeAssets/') ?>css/style.css">
  <title><?= $title ?></title>
</head>

<body>

  <!-- loading -->
  <div class="loading d-flex justify-content-center ">
    <div class="gambar-loading align-self-center">
      <img src="<?= base_url('assets/HomeAssets/img/loading/loading.gif') ?>" class="img-fluid">
      <p class="align-items-center mt-1 font-weight-bold text-white ml-0">Mohon Tunggu.....</p>
    </div>
  </div>

  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="<?= base_url('assets/HomeAssets/') ?>img/logo/PPDB 2020.png" class="img-fluid">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav  text-uppercase mx-auto">
          <?php if ($this->uri->segment(2) == "Reg") {
          ?>
            <li class="nav-item ">
            <?php } else { ?>
            <li class="nav-item active">
            <?php } ?>
            <a class="nav-link" href="<?= base_url('Home') ?>"><i class="fas fa-home"></i> Home</a>
            </li>
            <?php if ($this->uri->segment(2) == "Reg") {
            ?>
              <li class="nav-item active">
              <?php } else { ?>
              <li class="nav-item">

              <?php } ?>
              <a class="nav-link" href="<?= base_url('Home/Reg'); ?>" data-toggle="modal" data-target="#modalKonfirmasiFormulir"><i class="fas fa-registered"></i> Pendaftaran</a>
              </li>
        </ul>
      </div>
    </div>
  </nav>
  <?= $this->session->flashdata('message') ?>
  <!-- batas akhir navbar -->