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
  <button type="button" class="btn btn-outline-secondary mb-3 tombolTambahPrestasi" data-toggle="modal" data-target="#nonAkademik">Tambah Data <i class="fa fa-plus" aria-hidden="true"></i></button>
  <?= $this->session->flashdata('message') ?>
  <div class="row">
    <div class="col-lg">
      <table class="table table-hover table-responsive-sm" id="tablePrestasi">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Peyelengara</th>
            <th scope="col">Kejur</th>
            <th scope="col">Kategori</th>
            <th scope="col">Nilai</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody>

          <?php $no = 1;
          foreach ($tingkat as $t) : ?>
            <tr>
              <th scope="row"><?= $no++ ?></th>
              <td><?= $t['peyelengara']; ?></td>
              <td><?= $t['kejuaraan']; ?></td>
              <td><?= $t['satuan'] ?></td>
              <td><?= $t['score'] ?></td>
              <td>
                <a href="" class="badge badge-success tombolEditPrestasi" data-toggle="modal" data-target="#nonAkademik" data-id="<?= $t['id'] ?>"><i class="fas fa-edit"></i> Edit </a>
                <a href="<?= base_url('ppdb/hapusPrestasi/') . $t['id'] ?>" onClick="return confirm('Yakin Hapus ?');" class="badge badge-danger"><i class="fas fa-trash"></i> hapus </a>
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
<div class="modal fade" id="nonAkademik" tabindex="-1" role="dialog" aria-labelledby="nonAkademikModelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jalur PPDB</h5>
        <input type="hidden" name="url" id="url" class="url" value="<?= base_url(); ?>">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('ppdb/nonAkademik') ?>" method="POST" id="formUser">
        <input type="hidden" name="idPrestasi" id="idPrestasi">
        <div class="modal-body">
          <div class="form-group">
            <select name="penyelengara" id="penyelengara" class="penyelengara form-control">
              <option value="">--Pilih Peyelengara</option>
              <?php foreach ($penyelengara as $p) : ?>
                <option value="<?= $p['id_penyelengara'] ?>"><?= $p['peyelengara'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <select name="kategori" id="kategori" class="kategori form-control">
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="tingkat" name="tingkat" placeholder="Tiangkat Prestasi">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nilaiPrestasi" name="nilaiPrestasi" placeholder="Score Prestasi">
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