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
  <button class="btn btn-outline-primary my-3 tombolTambah" data-toggle="modal" data-target="#syarat"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Persyaratan</button>
  <div class="row">
    <div class="col-lg">
      <table class="table table-hover table-responsive-sm tablePeryaratan">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Jalur</th>
            <th scope="col">Persyaratan</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody>

          <?php $no = 1;
          foreach ($sarat as $syarat) : ?>
            <tr>
              <th scope="row"><?= $no++ ?></th>
              <td><?= $syarat['ppdb']; ?></td>
              <td><?= $syarat['persyaratan']; ?></td>
              <td>
                <a href="" class="badge badge-success tombolEdit" data-toggle="modal" data-target="#syarat" data-id="<?= $syarat['id'] ?>"><i class="fas fa-edit"></i> Edit </a>
                <a href="<?= base_url('ppdb/hapusSyarat/') . $syarat['id'] ?>" class="badge badge-danger"><i class="fas fa-trash"></i> hapus </a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>






</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->





<!-- Modal -->
<div class="modal fade" id="syarat" tabindex="-1" role="dialog" aria-labelledby="syaratModelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Persyaratan</h5>
        <input type="hidden" name="url" id="url" value="<?= base_url(); ?>">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('ppdb') ?>" method="POST" id="formUser">
        <input type="hidden" name="idSyarat" id="idSyarat">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="syaratPpdb" name="syarat" placeholder="syarat Baru">
          </div>
          <div class="form-group">
            <label for="jalur">Untuk PPdb Jalur --</label>
            <select class="form-control" name="jalur" id="jalurPpdb">
              <option value="">Pilih---</option>
              <?php foreach ($jalur as $j) : ?>
                <option value="<?= $j['id'] ?>"><?= $j['ppdb'] ?></option>
              <?php endforeach ?>

            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>