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
          <!-- Example single danger button -->
          <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle mb-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-print" aria-hidden="true"></i> Cetak Berdasarkan Jalur
            </button>
            <div class="dropdown-menu">
              <?php foreach ($jalur as $j) : ?>
                <a class="dropdown-item" href="<?= base_url('Pendaftar/cetakTidakLulusByjalur/') . $j['id'] ?>" target="_Blank"><?= $j['ppdb']; ?></a>
                <div class="dropdown-divider"></div>
              <?php endforeach ?>
            </div>
          </div>
          <!-- batas akhir cetak -->
          <table class="table table-hover table-sm table-responsive-sm" id="tabelLulus">
            <thead>
              <tr>
                <th>#</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>Score Nilai</th>
                <th>Total Rata Rata</th>
                <th>Score Jarak</th>
                <th>Jalur</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($pendaftar as $daftar) : ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $daftar['koreg']; ?></td>
                  <td><?= $daftar['namaSiswa']; ?></td>
                  <td><?= $daftar['asalSekolah']; ?></td>
                  <td><?= $daftar['totalNilai']; ?></td>
                  <td><?= $daftar['jumlahRataRata']; ?></td>
                  <td><?= $daftar['totalJarak'] . ' m'; ?></td>
                  <td><?= $daftar['ppdb'] ?></td>
                  <td>
                    <a href="<?= base_url('Pendaftar/printDataTidakLulus/' . $daftar['koreg']); ?>" target="_Blank" class="badge badge-primary"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
                  </td>
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