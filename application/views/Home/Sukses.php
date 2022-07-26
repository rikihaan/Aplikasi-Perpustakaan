<?php
if (!$this->session->userdata('koreg')) {
  redirect('home');
}
?>
<div class="container">
  <div class="formalert" data-formalert="<?= $this->session->flashdata('message') ?>"></div>
  <section class="sukses-pendaftran">
    <div class="container">
      <div class="row">
        <div class="col-9 judul">
          <h3 class="text-success">Selamat Pendaftaran Anda berhasil !!</h3>
          <p>Berikut data pendaftaran anda silakan cetak bukti pendaftaran pada tombol di bawah ini dan simpan dengan baik. Karena akan di perlukan saat verifikasi berkas asli
          </p>
        </div>
        <div class="col-3">
          <img src="<?= base_url('assets/HomeAssets/img/logo/2.svg') ?>" style="width:5em" class="img-fluid">
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h5>Identitas</h5>
        </div>
        <div class="row">

          <div class="col-6">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                No Urut Pendaftaran
                <span class="badge badge-light "><?= $pendaftar['noUrut'] ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                ID Registrasi
                <span class="badge badge-light "><?= $pendaftar['koreg'] ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Nama Lengkap
                <span class="badge badge-light "><?= $pendaftar['namaSiswa'] ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Jenis Kelamin
                <span class="badge badge-light ">
                  <?php if ($pendaftar['jk'] == "L") {
                    echo "Laki-laki";
                  } else {
                    echo "Perempuan";
                  } ?>
                </span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                NIK
                <span class="badge badge-light "><?= $pendaftar['nikSiswa'] ?></span>
              </li>
            </ul>
          </div>

          <div class="col-6">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Sekolah Asal
                <span class="badge badge-light "><?= $pendaftar['asalSekolah'] ?></span>
              </li>

              <li class="list-group-item d-flex justify-content-between align-items-center">
                NISN
                <span class="badge badge-light "><?= $pendaftar['nisnSiswa'] ?></span>
              </li>
            </ul>
            <a href="<?= base_url('home/cetak/') . $pendaftar['koreg'] ?>" target="_Blank" class="btn btn-outline-primary mt-3"><i class="fa fa-print" aria-hidden="true"></i> Cetak Bukti Registrasi</a>
          </div>

        </div>
      </div>
  </section>
  <!-- batas akhir informasi pendaftrana -->
</div>