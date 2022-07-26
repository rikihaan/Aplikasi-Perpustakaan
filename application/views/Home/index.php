<!-- carosell -->
<div id="carouselExampleControls" class="carousel slide mt-5" data-ride="carousel">
  <div class="carousel-inner p-5">
    <div class="container">
      <div class="carousel-item active">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 text-center">
            <h1>Selamat datang</h1>
            <h3 class="text-uppercase">Di website PPDB <?= $setting['nama_sekolah']; ?></h3>
            <a href="<?= base_url('Home/Pendaftaran') ?>" data-toggle="modal" data-target="#modalKonfirmasiFormulir" class="btn btn-warning text-white"> Daftar Sekarang</a>
          </div>
          <div class="col-12 col-md-4 d-none d-md-block text-right logoSlider">
            <img src="<?= base_url('assets/') ?>img/logo/<?= $setting['logo']; ?>" class="img-fluid w-65">
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 text-center">
            <h1>Selamat datang</h1>
            <h3 class="text-uppercase">Di website PPDB <?= $setting['nama_sekolah']; ?></h3>
            <a href="<?= base_url('Home/Pendaftaran') ?>" data-toggle="modal" data-target="#modalKonfirmasiFormulir" class="btn btn-warning text-white"> Daftar Sekarang</a>
          </div>
          <div class="col-12 col-md-4 d-none d-md-block text-right logoSlider">
            <img src="<?= base_url('assets/') ?>img/logo/<?= $setting['logo']; ?>" class="img-fluid w-65">
          </div>
        </div>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- batas carosel -->
<!-- info jalur ppdb -->
<section class="info-ppdb">
  <div class="container">
    <div class="row d-flex justify-content-around">
      <?php foreach ($dataJalur as $jalur) : ?>
        <div class="animate__animated animate__backInRight animate__delay-1s col-6 col-md-3 mb-5">
          <div class="judul-ppdb d-flex">
            <div class="buletInfo bg-primary d-flex justify-content-center">
              <p class="align-self-center">Quota<br> <?= $jalur['quota'] ?> </p>
            </div>
            <h2 class="align-content-end"><?= $jalur['ppdb'] ?> </h2>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="form-cekdata">
      <div class="judul-cekdata">
        <h1>Cek Status Data Pendaftaran</h1>
      </div>
      <div class="form-row p-3">
        <div class="form-group col-9 col-md-7 col-sm-12 col-12">
          <input type="text" class="form-control inputcekdata" maxlength="12" placeholder="Contoh: 20200909xxxx">
          <small class=" text-danger">Masukan kode Registrasi anda pada inputan di atas kemudian enter</small>
        </div>
      </div>
      <div class="row px-5 my-4">
        <div class="col-12 col-md-6">
          <div class="hasil-cekdata">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="hasil-cekdata2 p-3"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- batas akhir info ppdb -->
<!-- informasi pendaftaran -->
<section class="informasi-pendaftran mt-5">
  <div class="container">
    <div class="row">
      <div class="col-9 judul">
        <h3>Statistik Pendaftaran</h3>
        <p>Informasi dibawah ini adalah realtime jika terjadi kendala internet silahkan refresh halaman atau tekan F5
          pada Keyboard
        </p>
      </div>
    </div>

    <div class="row d-flex justify-content-md-around justify-content-around">
      <div class="col-3 col-md-6 col-lg-3 mb-3 mr-1 bg-info rounded overflow-hidden text-center p-4 info-container">
        <h4 class="text-white infoJudul">Total Pendaftar</h4>
        <div class="row">
          <div class="col">
            <p class="text-white infoAngka"><?= $jlmPendaftar ?> Orang</p>
          </div>
        </div>
        <div class="bulet"></div>
      </div>

      <div class="col-3 col-md-6 col-lg-3 mr-1 mb-3 bg-warning overflow-hidden rounded text-center p-4 info-container">
        <h4 class="text-primary infoJudul">Terverifikasi</h4>
        <div class="row">
          <div class="col">
            <p class="text-white infoAngka"><?= $jlmPendaftarVerifikasi ?> Orang</p>
          </div>
        </div>
        <div class="bulet"></div>
      </div>

      <div class="col-3 col-md-6 col-lg-3 mr-1 mb-3 bg-info overflow-hidden rounded text-center p-4 info-container">
        <h4 class="text-white infoJudul">Belum Terverifikasi</h4>
        <div class="row">
          <div class="col">
            <p class="text-white infoAngka"><?= $jlmPendaftarProses ?> Orang</p>
          </div>
        </div>
        <div class="bulet"></div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col">
        <h3 class="text-warning">Pemberitahuan Update</h3>
      </div>
    </div>
    <!-- row pengumuman -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body shadow">
            <div class="row d-flex">
              <?php
              if (count($informasi) < 1) { ?>
                <h5 class="text-danger font-weight-bold text-center">informasi belum tersedia !</h5>
                <?php } else {
                foreach ($informasi as $info) { ?>
                  <div class="col-md-4 col-6">
                    <div class="card pengumuman">
                      <div class="card-body">
                        <p class="align-items-end"><i class="fa fa-clock" aria-hidden="true"></i> <?= date('d F Y H:i:s', $info['date_created']) ?></p>
                        <h5 class="card-title"><?= $info['title'] ?></h5>
                        <button class="btn btn-primary text-gray-300 tombol-baca" data-id="<?= $info['id'] ?>">Baca</button>
                      </div>
                    </div>
                  </div>
              <?php }
              } ?>
              <!-- batas mulai col -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- batas akhir pengumuman -->
</section>
<!-- batas akhir informasi pendaftrana -->
<section class="tatacaraPendaftaran mt-5">
  <div class="container">
    <div class="row">
      <div class="col-9 judul">
        <h3>Informasi Tata Cara Pendaftaran</h3>
        <p>Informasi Penerimaan Peserta Didik Baru Pada <?= $setting['nama_sekolah'] ?>
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="embed-responsive embed-responsive-4by3">
          <iframe class="embed-responsive-item" src="<?= base_url('assets/HomeAssets/file/') . $setting['filePengumuman'] ?>" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="tabelMinMax mb-5">
  <div class="container">
    <div class="row">
      <div class="col-9 judul">
        <h3>Informasi Nilai Pendaftar Yang Sudah Terverifikasi</h3>
        <p>Penerimaan Peserta Didik Baru Pada <?= $setting['nama_sekolah'] ?>
        </p>
        <p>Informasi dibawah ini adalah realtime jika terjadi kendala internet silahkan refresh halaman atau tekan F5
          pada Keyboard
        </p>
      </div>
    </div>
    <div class="row my-5">
      <?php if ($ninMax1['pdfr']['jumlahPendaftar'] > 0) : ?>
        <div class="col-md-4 mb-5">
          <div class="card text-left">
            <div class="card-body shadow border">
              <h4 class="card-title rounded text-warning" style="position: absolute; top:-26px; background-color: #1f3c4d; padding: 5px 20px; font-size:16px;"><i class="fas fa-angle-double-right"></i> <?= $ninMax1['pdfr']['ppdb'] ?></h4>
              <table class="table table-sm">
                <tr>
                  <td><i class="fa fa-user" aria-hidden="true"></i> Pendaftar</td>
                  <td>:</td>
                  <td><?= $ninMax1['pdfr']['jumlahPendaftar']; ?></td>
                </tr>
                <tr>
                  <td> <i class="fa fa-check-circle" aria-hidden="true"></i> Terverifikasi</td>
                  <td>:</td>
                  <td><?= $ninMax1['pdfr']['jumlahVerifiksi']; ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-chalkboard-teacher"></i> Belum Terverifikasi</td>
                  <td>:</td>
                  <td><?= $ninMax1['pdfr']['jumlahTidakVerifiksi']; ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-ban"></i> Cabut Berkas/Pindah</td>
                  <td>:</td>
                  <td><?= $ninMax1['pdfr']['jumlahPindah']; ?></td>
                </tr>
                <tr>
                  <td> <i class="fa fa-street-view" aria-hidden="true"></i> Score Jarak Terdekat</td>
                  <td>:</td>
                  <td><?= $ninMax1['nilai']['minTotalJarak'] . ' m'; ?></td>
                </tr>
                <tr>
                  <td><i class="fa fa-street-view" aria-hidden="true"></i> Score Jarak Terjauh</td>
                  <td>:</td>
                  <td><?= $ninMax1['nilai']['maxTotalJarak'] . ' m'; ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      <?php endif ?>
      <?php if ($ninMax2['pdfr']['jumlahPendaftar'] > 0) : ?>
        <!-- afirmasi -->
        <div class="col-md-4 mb-5">
          <div class="card text-left">
            <div class="card-body shadow border">
              <h4 class="card-title rounded text-warning" style="position: absolute; top:-26px; background-color: #1f3c4d; padding: 5px 20px; font-size:16px;"><i class="fas fa-angle-double-right"></i> <?= $ninMax2['pdfr']['ppdb'] ?></h4>
              <table class="table table-sm">
                <tr>
                  <td><i class="fa fa-user" aria-hidden="true"></i> Pendaftar</td>
                  <td>:</td>
                  <td><?= $ninMax2['pdfr']['jumlahPendaftar']; ?></td>
                </tr>
                <tr>
                  <td> <i class="fa fa-check-circle" aria-hidden="true"></i> Terverifikasi</td>
                  <td>:</td>
                  <td><?= $ninMax2['pdfr']['jumlahVerifiksi']; ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-chalkboard-teacher"></i> Belum Terverifikasi</td>
                  <td>:</td>
                  <td><?= $ninMax2['pdfr']['jumlahTidakVerifiksi']; ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-ban"></i> Cabut Berkas/Pindah</td>
                  <td>:</td>
                  <td><?= $ninMax2['pdfr']['jumlahPindah']; ?></td>
                </tr>
                <tr>
                  <td> <i class="fa fa-street-view" aria-hidden="true"></i> Score Jarak Terdekat</td>
                  <td>:</td>
                  <td><?= $ninMax2['nilai']['minTotalJarak'] . ' m'; ?></td>
                </tr>
                <tr>
                  <td><i class="fa fa-street-view" aria-hidden="true"></i> Score Jarak Terjauh</td>
                  <td>:</td>
                  <td><?= $ninMax2['nilai']['maxTotalJarak'] . ' m'; ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      <?php endif ?>
      <?php if ($ninMax3['pdfr']['jumlahPendaftar'] > 0) : ?>
        <!-- Ortu -->
        <div class="col-md-4 mb-5">
          <div class="card text-left">
            <div class="card-body shadow border">
              <h4 class="card-title rounded text-warning" style="position: absolute; top:-26px; background-color: #1f3c4d; padding: 5px 20px; font-size:16px;"><i class="fas fa-angle-double-right"></i> <?= $ninMax3['pdfr']['ppdb'] ?></h4>
              <table class="table table-sm">
                <tr>
                  <td><i class="fa fa-user" aria-hidden="true"></i> Pendaftar</td>
                  <td>:</td>
                  <td><?= $ninMax3['pdfr']['jumlahPendaftar']; ?></td>
                </tr>
                <tr>
                  <td> <i class="fa fa-check-circle" aria-hidden="true"></i> Terverifikasi</td>
                  <td>:</td>
                  <td><?= $ninMax3['pdfr']['jumlahVerifiksi']; ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-chalkboard-teacher"></i> Belum Terverifikasi</td>
                  <td>:</td>
                  <td><?= $ninMax3['pdfr']['jumlahTidakVerifiksi']; ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-ban"></i> Cabut Berkas/Pindah</td>
                  <td>:</td>
                  <td><?= $ninMax3['pdfr']['jumlahPindah']; ?></td>
                </tr>

                <!-- <tr>
                <td> <i class="fas fa-basketball-ball"></i> Score Prestasi Terbawah</td>
                <td>:</td>
                <td><?= $ninMax3['nilai']['minNilaiPrestasi'] ?></td>
              </tr>
              <tr>
                <td><i class="fas fa-basketball-ball"></i> Score Prestasi Tertinggi</td>
                <td>:</td>
                <td><?= $ninMax3['nilai']['maxNilaiPrestasi']  ?></td>
              </tr>

              <tr>
                <td> <i class="fas fa-address-book"></i> Jml Rata" Raport Terbawah</td>
                <td>:</td>
                <td><?= $ninMax3['nilai']['minrataRataNilai']; ?></td>
              </tr>
              <tr>
                <td><i class="fas fa-address-book"></i> Jml Rata" Raport Teringgi</td>
                <td>:</td>
                <td><?= $ninMax3['nilai']['maxrataRataNilai']; ?></td>
              </tr> -->

                <tr>
                  <td> <i class="fa fa-street-view" aria-hidden="true"></i> Score Jarak Terdekat</td>
                  <td>:</td>
                  <td><?= $ninMax3['nilai']['minTotalJarak'] . ' m'; ?></td>
                </tr>
                <tr>
                  <td><i class="fa fa-street-view" aria-hidden="true"></i> Score Jarak Terjauh</td>
                  <td>:</td>
                  <td><?= $ninMax3['nilai']['maxTotalJarak'] . ' m'; ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      <?php endif ?>
      <?php if ($ninMax4['pdfr']['jumlahPendaftar'] > 0) : ?>
        <div class="col-md-4 mb-5">
          <div class="card text-left">
            <div class="card-body shadow border">
              <h4 class="card-title rounded text-warning" style="position: absolute; top:-26px; background-color: #1f3c4d; padding: 5px 20px; font-size:16px;"><i class="fas fa-angle-double-right"></i> <?= $ninMax4['pdfr']['ppdb'] ?></h4>
              <table class="table table-sm">
                <tr>
                  <td><i class="fa fa-user" aria-hidden="true"></i> Pendaftar</td>
                  <td>:</td>
                  <td><?= $ninMax4['pdfr']['jumlahPendaftar']; ?></td>
                </tr>
                <tr>
                  <td> <i class="fa fa-check-circle" aria-hidden="true"></i> Terverifikasi</td>
                  <td>:</td>
                  <td><?= $ninMax4['pdfr']['jumlahVerifiksi']; ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-chalkboard-teacher"></i> Belum Terverifikasi</td>
                  <td>:</td>
                  <td><?= $ninMax4['pdfr']['jumlahTidakVerifiksi']; ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-ban"></i> Cabut Berkas/Pindah</td>
                  <td>:</td>
                  <td><?= $ninMax4['pdfr']['jumlahPindah']; ?></td>
                </tr>
                <tr>
                  <td> <i class="fas fa-basketball-ball"></i> Score Prestasi Terbawah</td>
                  <td>:</td>
                  <td><?= $ninMax4['nilai']['minNilaiPrestasi'] ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-basketball-ball"></i> Score Prestasi Tertinggi</td>
                  <td>:</td>
                  <td><?= $ninMax4['nilai']['maxNilaiPrestasi']  ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      <?php endif ?>
      <?php if ($ninMax5['pdfr']['jumlahPendaftar'] > 0) : ?>
        <!-- Ortu -->
        <div class="col-md-4 mb-5">
          <div class="card text-left">
            <div class="card-body shadow border">
              <h4 class="card-title rounded text-warning" style="position: absolute; top:-26px; background-color: #1f3c4d; padding: 5px 20px; font-size:16px;"><i class="fas fa-angle-double-right"></i> <?= $ninMax5['pdfr']['ppdb'] ?></h4>
              <table class="table table-sm">
                <tr>
                  <td><i class="fa fa-user" aria-hidden="true"></i> Pendaftar</td>
                  <td>:</td>
                  <td><?= $ninMax5['pdfr']['jumlahPendaftar']; ?></td>
                </tr>
                <tr>
                  <td> <i class="fa fa-check-circle" aria-hidden="true"></i> Terverifikasi</td>
                  <td>:</td>
                  <td><?= $ninMax5['pdfr']['jumlahVerifiksi']; ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-chalkboard-teacher"></i> Belum Terverifikasi</td>
                  <td>:</td>
                  <td><?= $ninMax5['pdfr']['jumlahTidakVerifiksi']; ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-ban"></i> Cabut Berkas/Pindah</td>
                  <td>:</td>
                  <td><?= $ninMax5['pdfr']['jumlahPindah']; ?></td>
                </tr>

                <!-- <tr>
                <td> <i class="fas fa-basketball-ball"></i> Score Prestasi Terbawah</td>
                <td>:</td>
                <td><?= $ninMax5['nilai']['minNilaiPrestasi'] ?></td>
              </tr>
              <tr>
                <td><i class="fas fa-basketball-ball"></i> Score Prestasi Tertinggi</td>
                <td>:</td>
                <td><?= $ninMax5['nilai']['maxNilaiPrestasi']  ?></td>
              </tr>

              <tr>
                <td> <i class="fas fa-address-book"></i> Jml Rata" Raport Terbawah</td>
                <td>:</td>
                <td><?= $ninMax5['nilai']['minrataRataNilai']; ?></td>
              </tr>
              <tr>
                <td><i class="fas fa-address-book"></i> Jml Rata" Raport Teringgi</td>
                <td>:</td>
                <td><?= $ninMax5['nilai']['maxrataRataNilai']; ?></td>
              </tr> -->

                <tr>
                  <td> <i class="fa fa-street-view" aria-hidden="true"></i> Score Jarak Terdekat</td>
                  <td>:</td>
                  <td><?= $ninMax5['nilai']['minTotalJarak'] . ' m'; ?></td>
                </tr>
                <tr>
                  <td><i class="fa fa-street-view" aria-hidden="true"></i> Score Jarak Terjauh</td>
                  <td>:</td>
                  <td><?= $ninMax5['nilai']['maxTotalJarak'] . ' m'; ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      <?php endif ?>
      <?php if ($ninMax6['pdfr']['jumlahPendaftar'] > 0) : ?>
        <!-- Ortu -->
        <div class="col-md-4 mb-5">
          <div class="card text-left">
            <div class="card-body shadow border">
              <h4 class="card-title rounded text-warning" style="position: absolute; top:-26px; background-color: #1f3c4d; padding: 5px 20px; font-size:16px;"><i class="fas fa-angle-double-right"></i> <?= $ninMax6['pdfr']['ppdb'] ?></h4>
              <table class="table table-sm">
                <tr>
                  <td><i class="fa fa-user" aria-hidden="true"></i> Pendaftar</td>
                  <td>:</td>
                  <td><?= $ninMax6['pdfr']['jumlahPendaftar']; ?></td>
                </tr>
                <tr>
                  <td> <i class="fa fa-check-circle" aria-hidden="true"></i> Terverifikasi</td>
                  <td>:</td>
                  <td><?= $ninMax6['pdfr']['jumlahVerifiksi']; ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-chalkboard-teacher"></i> Belum Terverifikasi</td>
                  <td>:</td>
                  <td><?= $ninMax6['pdfr']['jumlahTidakVerifiksi']; ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-ban"></i> Cabut Berkas/Pindah</td>
                  <td>:</td>
                  <td><?= $ninMax6['pdfr']['jumlahPindah']; ?></td>
                </tr>

                <tr>
                  <td> <i class="fas fa-address-book"></i> Jml Rata" Raport Terbawah</td>
                  <td>:</td>
                  <td><?= $ninMax6['nilai']['minrataRataNilai']; ?></td>
                </tr>
                <tr>
                  <td><i class="fas fa-address-book"></i> Jml Rata" Raport Teringgi</td>
                  <td>:</td>
                  <td><?= $ninMax6['nilai']['maxrataRataNilai']; ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      <?php endif ?>
    </div>
  </div>
</section>
<!-- modal konfirmasi pendaftaran -->
<!-- Modal -->
<div class="modal fade" id="modalKonfirmasiFormulir" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiFormulirTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger text-center" id="modalKonfirmasiFormulirTitle"> PERINGATAN !!!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Sebelum Anda melanjukan ke form pendaftaran kami himbau baiknya membaca terlebih dahulu persyaratan jalur PPDB yang akan anda Pilih</p>
        <p>Agar tidak terjadi kesalahan saat mendaftar</p>
        <p><b>Anda Yakin Telah Membaca Persyaratan ?</b></p>
      </div>
      <div class="modal-footer">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="baca" value="option1">
          <label class="form-check-label" for="baca">Ya Saya sudah Membaca Persyaratan</label>
        </div>
        <a href="<?= base_url('Home/Reg') ?>" class="btn btn-warning lanjut">Lanjut</a>
      </div>
    </div>
  </div>
</div>
<!-- modal baca informasi -->
<div class="modal fade" id="pengumuman" tabindex="-1" role="dialog" aria-labelledby="pengumumanTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pengumumanTitle" id="pengumumanTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="deskripsiPengumuman"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>