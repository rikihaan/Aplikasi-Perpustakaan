<input type="hidden" class="uriSegmen" value="<?= $this->uri->segment(1) ?>">
<input type="hidden" class="url">
<div class="content">
  <?= $this->session->flashdata('message') ?>

  <div class="header d-flex flex-row justify-content-between">
    <div class="jmlpengunjung">
      <h4>Jumlah Pengunjung</h4>
      <div class="jumlahp"></div>
    </div>
    <div class="logo-sekolah">
      <h4>Perpustakaan</h4>
      <h6>SMP NEGERI 1 CIGOMBONG</h6>
    </div>
    <div class="tanggal-box ">
      <div class="tanggal">
        20 September 2021
      </div>
      <div class="jam">
        08:09:09
      </div>
    </div>
  </div>
  <div class="main d-flex flex-row justify-content-between">
    <!-- main left -->
    <div class="main-left">
      <h4>Setting Pengguna</h4>
      <!-- awal form -->
      <form class="row g-3 mt-5" method="post" action="<?= base_url('Setting') ?>">
        <div class="col-md-3">
          <label for="maxKeterlambatan" class="form-label">Maksimal Ketelambatan (Hari)</label>
          <?php echo form_error('maxKeterlambatan'); ?>
          <input type="text" class="form-control" id="maxKeterlambatan" name="maxKeterlambatan" value="<?= $setting['maxKeterlambatan']; ?>">
        </div>
        <div class="col-md-3">
          <label for="maxPeminjamanHarian" class="form-label">Max Jumlah Peminjaman Reg</label>
          <input type="text" class="form-control" id="maxPeminjamanHarian" name="maxPeminjamanHarian" value="<?= $setting['maxPinjamanReguler']; ?>">
        </div>
        <div class="col-md-3">
          <label for="maxPeminjamanPaket" class="form-label">Max Jumlah Peminjaman Paket</label>
          <input type="text" class="form-control" id="maxPeminjamanPaket" name="maxPeminjamanPaket" value="<?= $setting['maxPinjamanPaket']; ?>">
        </div>
        <div class="col-md-3">
          <label for="denda" class="form-label">Denda Reguler (Rp.)</label>
          <input type="text" class="form-control" id="denda" name="denda" value="<?= $setting['denda']; ?>">
        </div>
        <div class="col-12 mt-3">
          <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
        </div>
      </form>
      <!-- end form setting -->

    </div>

  </div>

</div>