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
  <div class="row">
    <div class="col-lg">
      <table class="table table-hover table-responsive-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Jalur</th>
            <th scope="col">Quota</th>
            <th scope="col">Input Nilai Prestasi</th>
            <th scope="col">Status</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody>

          <?php $no = 1;
          foreach ($jalur as $j) : ?>
            <tr>
              <th scope="row"><?= $no++ ?></th>
              <td><?= $j['ppdb']; ?></td>
              <td><?= $j['quota'] . ' Orang' ?></td>
              <td><?php if ($j['inputPrestasi'] == 1) {
                    echo "Ya";
                  } else {
                    echo "No";
                  } ?></td>
              <td>

                <?php if ($j['statusAktif'] == 1) {
                  echo "Aktif";
                } else {
                  echo "NonAktif";
                } ?>
              </td>
              <td>
                <a href="" class="badge badge-success tombolEditJalur" data-toggle="modal" data-target="#syarat" data-id="<?= $j['id'] ?>"><i class="fas fa-edit"></i> Edit </a>
                <!-- <a href="<?= base_url('ppdb/hapusJalurPpdb/') . $j['id'] ?>" onClick="return confirm('Yakin Hapus ?');" class="badge badge-danger"><i class="fas fa-trash"></i> hapus </a> -->
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jalur PPDB</h5>
        <input type="hidden" name="url" id="url" value="<?= base_url(); ?>">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('ppdb/editJalurPpdb') ?>" method="POST" id="formUser">
        <input type="hidden" name="idJalur" id="idJalur">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" class="form-control" id="jalurPpdb" name="jalur" placeholder="syarat Baru">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="quota" name="quota" placeholder="Jumlah quota  (Orang)">
          </div>

          <div class="form-group">
            <select name="input_nilai" id="input-nilai" class="form-control">
              <option value="">Apakah perlu input nilai?</option>
              <option value="1">Ya</option>
              <option value="2">Tidak</option>
            </select>
          </div>

          <div class="form-group">
            <select name="inputPrestasi" id="inputPrestasi" class="form-control">
              <option value="">Apakah perlu input nilai Prestasi ?</option>
              <option value="1">Ya</option>
              <option value="0">Tidak</option>
            </select>
          </div>

          <div class="form-group">
            <select name="statusAktif" id="statusAktif" class="form-control">
              <option value="">Aktifkan / Nonaktifkan</option>
              <option value="1">Aktif</option>
              <option value="0">NonAktif</option>
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