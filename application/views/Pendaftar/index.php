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
          <table class="table table-hover" id="tabelVerifikasi">
            <thead>
              <tr>
                <th>#</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>Jalur</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
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

<div class="modal fade modalPendaftar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content p-4">
      <!-- container -->
      <div class="container">
        <form action="<?= base_url('Admin/verifiksai') ?>" method="POST" class="formVerifikasi">
          <input type="hidden" name="id" id="idDaftar">
          <input type="hidden" name="koregSen" id="koregSen">
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="koreg">ID REGISTER</label>
              <input type="text" class="form-control" id="koreg" readonly>
            </div>
            <div class="form-group col-md-3">
              <label for="nisn">NISN</label>
              <input type="text" class="form-control" id="nisn" name="nisn">
            </div>
            <div class="form-group col-md-6">
              <label for="nama">Nama</label>
              <input type="nama" name="nama" class="form-control" id="nama">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-5">
              <label for="tempatLahir">Tempat Lahir</label>
              <input type="text" name="tempatLahir" class="form-control" id="tempatLahir">
            </div>
            <div class="form-group col-md-5">
              <label for="tanggalLahir">Tanggal Lahir</label>
              <input type="text" name="tanggalLahir" class="form-control tanggalLahir" id="tanggalLahir">
            </div>
            <div class="form-group col-md-2">
              <label for="usiaSiswa">Usia</label>
              <input type="text" name="usiaSiswa" class="form-control" id="usiaSiswa" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="sekolah">Sekolah</label>
              <input type="text" name="namaSekolah" class="form-control" id="sekolah">
            </div>
            <div class="form-group col-md-6">
              <label for="npsn">NPSN</label>
              <input type="text" name="npsn" class="form-control" id="npsn">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="JalurPPDB">Jalur PPDB</label>
              <select id="JalurPPDB" name="jalurPPDB" class="form-control">
                <option value="">--Pilih</option>
                <?php foreach ($jalur as $d) : ?>
                  <option value="<?= $d['id'] ?>"><?= $d['ppdb'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="rataRataNilai">Rata-Rata Nilai</label>
              <input type="text" class="form-control" id="rataRataNilai" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="totalRataRata">Total Rata-Rata</label>
              <input type="text" class="form-control" id="totalRataRata" readonly>
            </div>
            <div class="form-group col-md-2">
              <label for="totalNilai">Total Nilai</label>
              <input type="text" class="form-control" id="totalNilai" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="longitude">longitude</label>
              <input type="text" class="form-control" id="longitude" name="longitude">
            </div>
            <div class="form-group col-md-2">
              <label for="nilaiJarak">Score Jarak (m)</label>
              <input type="text" name="nilaiJarak" class="form-control" id="nilaiJarak" readonly>
            </div>
          </div>
          <div class="jalurAkademikNonakademik">

          </div>
          <div class="form-row prestasiForm">
            <div class="form-group col-md-6">
              <label for="prestasi">Penyelengara</label>
              <select id="prestasi" class="form-control">
                <option value="">--Pilih</option>
                <?php foreach ($prestasi as $p) : ?>
                  <option value="<?= $p['id_penyelengara'] ?>"><?= $p['peyelengara'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="kategori">Kategori Prestasi</label>
              <select id="kategori" class="form-control kategori">
              </select>
            </div>

            <div class="form-group col-md-6">
              <label for="tingkat">Tingkat Prestasi</label>
              <select id="tingkat" name="tingkat" class="form-control tingkat">
              </select>
            </div>

            <input type="hidden" name="tingkat2" id="tingkat2">

            <div class="form-group col-md-6">
              <label for="nilaiPrestasi">Nilai Lomba Akademik dan Non Akademik</label>
              <input type="text" name="nilaiPrestasi" class="form-control nilaiPrestasi" id="nilaiPrestasi" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="cabangPrestasi">Cabang Prestasi</label>
              <input type="text" name="cabangPrestasi" class="form-control cabangPrestasi" id="cabangPrestasi">
            </div>

            <div class="form-group col-md-3">
              <label>Tambah Nilai Praktek disini</label>
              <input type="hidden" id="idEdit">
              <input type="hidden" id="koregEdit">
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-danger tombolMinus"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                <input type="text" style="text-align: center;" class="form-control inputNilaiPraktek" id="inputNilaiPraktek">
                <button type="button" class="btn btn-primary tombolPlus"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>
          <table class="table table-responsive">
            <thead>
              <tr>
                <td rowspan="2" align="center">No</td>
                <td rowspan="2" align="center">Mapel</td>
                <td colspan="2" align="center">Kelas 4</td>
                <td colspan="2" align="center">Kelas 5</td>
                <td colspan="2" align="center">Kelas 6</td>
              </tr>
              <tr>
                <td align="center">Semester 1</td>
                <td align="center">Semester 2</td>
                <td align="center">Semester 1</td>
                <td align="center">Semester 2</td>
                <td align="center">Semester 1</td>
                <td align="center">Semester 2</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>P A I</td>
                <td><input type="text" name="paiK4S1" id="paiK4S1" maxLength="4" required></td>
                <td><input type="text" name="paiK4S2" id="paiK4S2" maxLength="4" required></td>
                <td><input type="text" name="paiK5S1" id="paiK5S1" maxLength="4" required></td>
                <td><input type="text" name="paiK5S2" id="paiK5S2" maxLength="4" required></td>
                <td><input type="text" name="paiK6S1" id="paiK6S1" maxLength="4" required></td>
                <td><input type="text" name="paiK6S2" id="paiK6S2" maxLength="4" required></td>
              </tr>

              <tr>
                <td>2</td>
                <td>PPKN</td>
                <td><input type="text" name="pknK4S1" id="pknK4S1" maxLength="4" required></td>
                <td><input type="text" name="pknK4S2" id="pknK4S2" maxLength="4" required></td>
                <td><input type="text" name="pknK5S1" id="pknK5S1" maxLength="4" required></td>
                <td><input type="text" name="pknK5S2" id="pknK5S2" maxLength="4" required></td>
                <td><input type="text" name="pknK6S1" id="pknK6S1" maxLength="4" required></td>
                <td><input type="text" name="pknK6S2" id="pknK6S2" maxLength="4" required></td>
              </tr>

              <tr>
                <td>3</td>
                <td>Indonesia</td>
                <td><input type="text" name="indoK4S1" id="indoK4S1" maxLength="4" required></td>
                <td><input type="text" name="indoK4S2" id="indoK4S2" maxLength="4" required></td>
                <td><input type="text" name="indoK5S1" id="indoK5S1" maxLength="4" required></td>
                <td><input type="text" name="indoK5S2" id="indoK5S2" maxLength="4" required></td>
                <td><input type="text" name="indoK6S1" id="indoK6S1" maxLength="4" required></td>
                <td><input type="text" name="indoK6S2" id="indoK6S2" maxLength="4" required></td>
              </tr>

              <tr>
                <td>4</td>
                <td>Matematika</td>
                <td><input type="text" name="mtkK4S1" id="mtkK4S1" maxLength="4" required></td>
                <td><input type="text" name="mtkK4S2" id="mtkK4S2" maxLength="4" required></td>
                <td><input type="text" name="mtkK5S1" id="mtkK5S1" maxLength="4" required></td>
                <td><input type="text" name="mtkK5S2" id="mtkK5S2" maxLength="4" required></td>
                <td><input type="text" name="mtkK6S1" id="mtkK6S1" maxLength="4" required></td>
                <td><input type="text" name="mtkK6S2" id="mtkK6S2" maxLength="4" required></td>
              </tr>

              <tr>
                <td>5</td>
                <td>IPA</td>
                <td><input type="text" name="ipaK4S1" id="ipaK4S1" maxLength="4" required></td>
                <td><input type="text" name="ipaK4S2" id="ipaK4S2" maxLength="4" required></td>
                <td><input type="text" name="ipaK5S1" id="ipaK5S1" maxLength="4" required></td>
                <td><input type="text" name="ipaK5S2" id="ipaK5S2" maxLength="4" required></td>
                <td><input type="text" name="ipaK6S1" id="ipaK6S1" maxLength="4" required></td>
                <td><input type="text" name="ipaK6S2" id="ipaK6S2" maxLength="4" required></td>
              </tr>


              <tr>
                <td>6</td>
                <td>IPS</td>
                <td><input type="text" name="ipsK4S1" id="ipsK4S1" maxLength="4" required></td>
                <td><input type="text" name="ipsK4S2" id="ipsK4S2" maxLength="4" required></td>
                <td><input type="text" name="ipsK5S1" id="ipsK5S1" maxLength="4" required></td>
                <td><input type="text" name="ipsK5S2" id="ipsK5S2" maxLength="4" required></td>
                <td><input type="text" name="ipsK6S1" id="ipsK6S1" maxLength="4" required></td>
                <td><input type="text" name="ipsK6S2" id="ipsK6S2" maxLength="4" required></td>
              </tr>


              <tr>
                <td>7</td>
                <td>SBDP</td>
                <td><input type="text" name="sbdpK4S1" id="sbdpK4S1" maxLength="4" required></td>
                <td><input type="text" name="sbdpK4S2" id="sbdpK4S2" maxLength="4" required></td>
                <td><input type="text" name="sbdpK5S1" id="sbdpK5S1" maxLength="4" required></td>
                <td><input type="text" name="sbdpK5S2" id="sbdpK5S2" maxLength="4" required></td>
                <td><input type="text" name="sbdpK6S1" id="sbdpK6S1" maxLength="4" required></td>
                <td><input type="text" name="sbdpK6S2" id="sbdpK6S2" maxLength="4" required></td>
              </tr>


              <tr>
                <td>8</td>
                <td>PJOK</td>
                <td><input type="text" name="pjokK4S1" id="pjokK4S1" maxLength="4" required></td>
                <td><input type="text" name="pjokK4S2" id="pjokK4S2" maxLength="4" required></td>
                <td><input type="text" name="pjokK5S1" id="pjokK5S1" maxLength="4" required></td>
                <td><input type="text" name="pjokK5S2" id="pjokK5S2" maxLength="4" required></td>
                <td><input type="text" name="pjokK6S1" id="pjokK6S1" maxLength="4" required></td>
                <td><input type="text" name="pjokK6S2" id="pjokK6S2" maxLength="4" required></td>
              </tr>

              <tr>
                <td>9</td>
                <td>SUNDA</td>
                <td><input type="text" name="sundaK4S1" id="sundaK4S1" maxLength="4" required></td>
                <td><input type="text" name="sundaK4S2" id="sundaK4S2" maxLength="4" required></td>
                <td><input type="text" name="sundaK5S1" id="sundaK5S1" maxLength="4" required></td>
                <td><input type="text" name="sundaK5S2" id="sundaK5S2" maxLength="4" required></td>
                <td><input type="text" name="sundaK6S1" id="sundaK6S1" maxLength="4" required></td>
                <td><input type="text" name="sundaK6S2" id="sundaK6S2" maxLength="4" required></td>
              </tr>
            </tbody>
          </table>
          <div class="form-group">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="verifikasi" id="ver1" value="1">
              <label class="form-check-label" for="ver1">Belum Verifikasi <i class="fas fa-cog"></i></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="verifikasi" id="ver2" value="2">
              <label class="form-check-label" for="ver2">Verifikasi <i class="fa fa-check" aria-hidden="true"></i></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="verifikasi" id="ver3" value="3">
              <label class="form-check-label" for="ver3">Cabut Berkas <i class="fas fa-arrow-alt-circle-right"></i></label>
            </div>
          </div>
          <a class="btn btn-primary text-white tombol-cetak-verifikasi d-none" target="Blank">Cetak Verifikasi <i class="fa fa-print" aria-hidden="true"></i></a>
          <button type="button" class="btn btn-success tombolsave">Save & Verifikasi <i class="fa fa-spinner" aria-hidden="true"></i></button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
      <!-- batas akhir container -->
    </div>
  </div>
</div>