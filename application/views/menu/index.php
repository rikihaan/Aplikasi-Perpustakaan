<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
  <?= '<small class="text-danger">' . validation_errors() . '</small>'; ?>
  <div class="row">
    <div class="col-lg-6">
      <?= $this->session->flashdata('message') ?>;
      <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Tambah Menu <i class="fa fa-plus" aria-hidden="true"></i></a>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Menu</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($menu as $m) : ?>
            <tr>
              <th scope="row"><?= $no++ ?></th>
              <td><?= $m['menu']; ?></td>
              <td>
                <a href="#" class="badge badge-primary"><i class="fas fa-edit"></i> Edit</a>
                <a href="<?= base_url('menu/hapusMenu/' . $m['id']) ?>" class="badge badge-danger"><i class="fas fa-delete"></i> Hapus</a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Baru">
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