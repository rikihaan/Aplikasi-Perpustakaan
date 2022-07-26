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
  <button class="btn btn-outline-primary my-3 tombolTambahInformasi" data-toggle="modal" data-target="#informasi"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Informasi</button>
  <div class="row">
    <div class="col-lg">
      <table class="table table-hover table-responsive-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Tanggal Publish</th>
            <th scope="col">Oleh</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($informasi as $info) : ?>
            <tr>
              <th scope="row"><?= $no++ ?></th>
              <td><?= $info['title']; ?></td>
              <td><?= date('d F Y', $info['date_created']); ?></td>
              <td><?= $info['by_created']; ?></td>
              <td>
                <a href="" class="badge badge-success tombolEditInformasi" data-toggle="modal" data-target="#informasi" data-id="<?= $info['id'] ?>"><i class="fas fa-edit"></i> Edit </a>
                <a href="<?= base_url('ppdb/hapusInformasi/') . $info['id'] ?>" onclick="return confirm('Yakin Akan dihapus');" class="badge badge-danger"><i class="fas fa-trash"></i> hapus </a>
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
<div class="modal fade" id="informasi" tabindex="-1" role="dialog" aria-labelledby="informasitModelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Informasi</h5>
        <input type="hidden" name="url" id="url" value="<?= base_url(); ?>">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('ppdb/informasi') ?>" method="POST" id="formUser">
        <input type="hidden" name="idInformasi" id="idInformasi">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" value="<?= set_value('titleInformasi') ?>" id="titleInformasi" name="titleInformasi" placeholder="Title / Judul Informasi">
          </div>
          <div class="form-group">
            <textarea type="text" class="form-control deskripsi" id="deskripsi" name="deskripsi" placeholder="deskrisi Baru" value="">
            <?= set_value('deskripsi') ?>
            </textarea>
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