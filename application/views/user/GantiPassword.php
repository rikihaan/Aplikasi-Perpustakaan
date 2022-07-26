<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
  <div class="row">
    <div class="col-4">
      <?= $this->session->flashdata('message') ?>
    </div>
  </div>
  <div class="row d-flex justify-content-center">

    <div class="col-5">
      <form action="<?= base_url('User/Pass') ?>" method="POST">
        <div class="form-group">
          <label for="PasswordLama">Password Lama</label>
          <input type="Password" name="PasswordLama" class="form-control" id="PasswordLama">
          <?= form_error('PasswordLama', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="form-group">
          <label for="PasswordBaru">Password Baru</label>
          <input type="Password" name="PasswordBaru" class="form-control" id="PasswordBaru">
          <?= form_error('PasswordBaru', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="form-group">
          <label for="ulangiPassword">Ulangi Password</label>
          <input type="Password" name="PasswordUlang" class="form-control" id="ulangiPassword">
          <?= form_error('PasswordUlang', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="form-group">
          <button type="submit" class=" btn btn-block btn-info">Ubah</button>
        </div>
      </form>
    </div>
  </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->