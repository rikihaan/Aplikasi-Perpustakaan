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
      <form action="<?= base_url('User/EditEmail') ?>" method="POST">
        <div class="form-group">
          <label for="EmailLama">Email Lama</label>
          <input type="email" name="EmailLama" value="<?= set_value('EmailLama'); ?>" class="form-control" id="EmailLama">
          <?= form_error('EmailLama', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="form-group">
          <label for="EmailBaru">Email Baru</label>
          <input type="email" name="EmailBaru" value="<?= set_value('EmailBaru'); ?>" class="form-control" id="EmailBaru">
          <?= form_error('EmailBaru', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="form-group">
          <label for="ulangiEmail">Ulangi Email</label>
          <input type="email" name="EmailUlang" value="<?= set_value('EmailUlang'); ?>" class="form-control" id="ulangiEmail">
          <?= form_error('EmailUlang', '<small class="text-danger pl-3">', '</small>') ?>
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