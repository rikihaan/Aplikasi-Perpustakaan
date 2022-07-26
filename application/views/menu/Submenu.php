<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

  <?php if (validation_errors()) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Warning!! Data gagal disimpan</strong> <?= validation_errors() ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif ?>
  <div class="row">
    <div class="col-lg">
      <?= $this->session->flashdata('message') ?>
      <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addSubmenu">Tambah Submenu <i class="fa fa-plus" aria-hidden="true"></i></a>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Menu</th>
            <th>Url</th>
            <th>icon</th>
            <th>Active</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($subMenu as $sm) : ?>
            <tr>
              <th scope="row"><?= $no++ ?></th>
              <td><?= $sm['title']; ?></td>
              <td><?= $sm['menu']; ?></td>
              <td><?= $sm['url']; ?></td>
              <td><?= $sm['icon']; ?></td>
              <td><?= $sm['is_active']; ?></td>
              <td>
                <a href="#" class="badge badge-primary"><i class="fas fa-edit"></i> Edit</a>
                <a href="<?= base_url('menu/hapusSubMenu/' . $sm['id']) ?>" class="badge badge-danger"><i class="fas fa-delete"></i> Hapus</a>
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
<div class="modal fade" id="addSubmenu" tabindex="-1" role="dialog" aria-labelledby="addSubmenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Submenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu/subMenu') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" placeholder=" sub menu title">
          </div>

          <div class="form-group">
            <select name="menu_id" id="menu_id" class="form-control">
              <option value="">Select Menu---</option>
              <?php foreach ($menu as $m) : ?>
                <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="url" name="url" placeholder=" sub menu url">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="icon" name="icon" placeholder=" sub menu icon">
          </div>

          <div class="form-group">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="status" id="status1" value="1" checked>
              <label class="form-check-label" for="exampleRadios1">
                Aktif
              </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="status" id="status2" value="0">
              <label class="form-check-label" for="exampleRadios2">
                Nonaktif
              </label>
            </div>
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