<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
  <input type="hidden" class="url" value="<?= base_url() ?>">
  <?= '<small class="text-danger">' . validation_errors() . '</small>'; ?>
  <div class="row">
    <div class="col-lg-12">
      <?= $this->session->flashdata('message') ?>
      <div class="card">
        <div class="card-body">
          <a href="<?= base_url('Pendaftar/GenerateOrangTua') ?>" class="btn btn-outline-warning tombol-generatet">Generate <i class="fas fa-truck-loading"></i></a>
          <a href="<?= base_url('Admin') ?>" class="btn btn-info ">Kembali <i class="fas fa-backward"></i></a>
          <p class="text-danger">Data dibawah sudah benar tekan tombol Generate </p>
          <p class="text-danger">dan bila sudah menekan tombol Generate ternyata ada perubahan kembali, maka harus klik Generate kembali/ulang </p>
          <h5>JALUR <?= $jalurId['ppdb'] ?> DENGAN QUOTA <?= $jalurId['quota'] ?> Orang</h5>
          <table class="table table-hover" id="tabelZonasi">
            <thead class="thead-dark">
              <tr>
                <th>Rank</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>Score Jarak</th>
                <th>Usia</th>
                <th>Jumlah Rata Rata Nilai</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($orangtua as $o) : ?>
                <?php if ($no > $jalurId['quota']) { ?>
                  <tr style="color: red">
                  <?php } else { ?>
                  <tr>
                  <?php } ?>
                  <th><?= $no++; ?></th>
                  <th><?= $o['koreg'] ?></th>
                  <th><?= $o['namaSiswa'] ?></th>
                  <th><?= $o['asalSekolah'] ?></th>
                  <th><?= $o['totalJarak'] . ' m' ?></th>
                  <th><?= $o['usiaSiswa'] . ' tahun' ?></th>
                  <th><?= $o['jumlahRataRata'] ?></th>


                  </tr>
                <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->