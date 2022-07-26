<!-- Begin Page Content -->
<div class="container-fluid">
  <?php if (validation_errors()) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Warning!! Data gagal disimpan</strong> <?= validation_errors() ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif ?>
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

  <?= $this->session->flashdata('message') ?>



  <div class="jumbotron">
    <h1 class="display-5 text-uppercase">VERIFIKASI DATA <?= $pendaftar['namaSiswa'] ?></h1>
    <h2 class="text-success">Sukses !!!</h2>
    <hr class="my-4">
    <p>Silahkan Cetak Bukti Verifikasi Berkas Di Bawah Ini</p>
    <a class="btn btn-success" target="_BLANK" href="<?= base_url('admin/cetakBuktiVerifikasi/') . $pendaftar['koreg'] ?>" role="button">Cetak Verifikasi <i class="fa fa-print" aria-hidden="true"></i></a>
    <a class="btn btn-secondary" href="<?= base_url('admin') ?>" role="button">Kembali <i class="fa fa-home" aria-hidden="true"></i></a>
  </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->