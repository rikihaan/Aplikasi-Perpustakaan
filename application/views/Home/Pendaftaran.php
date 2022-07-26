<?php
if ($setting['formulir'] == 1) {
?>
  <!-- formulir Pendaftaran -->
  <section class="formulir mb-5">
    <div class="container">
      <div class="row">
        <div class="col-9 judul">
          <h3>Formulir Pendaftaran</h3>
          <p>Isi formulir pendaftaran dibawah ini dengan data yang valid!!
          </p>
        </div>
      </div>
      <?php if (validation_errors()) : ?>
        <div class="formalert" data-formalert="Gagal"></div>
      <?php endif ?>
      <input type="hidden" value="<?= base_url() ?>" name="url" id="url">
      <form action="<?= base_url('Home/Register') ?>" method="post" id="formFormulir" class="formFormulir">
        <!-- jalur pendaftaran -->
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h6 class=" text-uppercase align-self-center">Jalur Pendaftaran</h6>
            <i class="fas fa-angle-double-left"></i>
          </div>
          <div class="card-body">
            <div class="container">
              <div class="form-row d-flex justify-content-between">
                <div class="form-group col-lg-5 col-6">
                  <label for="jalurPpdb">Pilih Jalur PPDB</label>
                  <select name="jalurPpdb" id="jalurPpdb" class="form-control">
                    <option value="">Pilih Jalur</option>
                    <?php foreach ($jalurPpdb as $ppdb) : ?>
                      <option value="<?= $ppdb['id'] ?>" <?php echo  set_select('jalurPpdb', $ppdb['id']) ?> class="text-uppercase"><?= $ppdb['ppdb'] ?></option>
                    <?php endforeach ?>
                  </select>
                  <?= form_error('jalurPpdb', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>

              <!-- inputan khusus akademik dan non akademik -->
              <div class="prestasi">
                <div class="form-row">
                  <div class="form-group col-lg-5 col-6">
                    <label for="nilaiPrestasi">Pilih Penyelenggara</label>
                    <select name="nilaiPrestasi" id="nilaiPrestasi" class="form-control nilaiPrestasi">
                      <option value="">Pilih Prestasi</option>
                      <?php foreach ($prestasi as $tingkat) : ?>
                        <option value="<?= $tingkat['id_penyelengara'] ?>" class="text-uppercase"><?= $tingkat['peyelengara'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="form-group col-lg-5 col-6">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control kategori">
                    </select>
                  </div>

                  <div class="form-group col-lg-5 col-6">
                    <label for="tingkat">Tingkat</label>
                    <select name="tingkat" id="tingkat" class="form-control tingkat">
                    </select>
                  </div>

                  <div class="form-group">
                    <input type="hidden" name="scorePrestasi" id="scorePrestasi">
                    <input type="hidden" name="idPrestasi" id="idPrestasi">
                  </div>

                  <div class="form-group col-lg-5 col-6">
                    <label for="namaKejuaraan">Nama Kejuaraan</label>
                    <input type="text" id="namaKejuaraan" value="<?= set_value('namaKejuaraan') ?>" name="namaKejuaraan" class="form-control" required>
                    <?= form_error('namaKejuaraan', '<small class="text-danger pl-3">', '</small>') ?>
                    <small class="text-muted">Contoh : Olimpiade Olahraga Siswa Nasional Cabang Volley</small>
                  </div>
                </div>
              </div>
              <div class="nilaiP">
              </div>
            </div>
          </div>
        </div>
        <!-- batas Akhir Jalur Pendaftaran -->
        <!-- identitas Sekolah Asal Calon Peserta Didik -->
        <div class="card mt-5">
          <div class="card-header d-flex justify-content-between">
            <h6 class="text-gray text-uppercase align-self-center">Identitas Sekolah Asal</h6>
            <i class="fas fa-angle-double-left"></i>
          </div>
          <div class="card-body">
            <div class="container">
              <div class="form-row">
                <div class="form-group col-lg-5 col-6">
                  <label for="sekolahAsal">Nama Sekolah Asal</label>
                  <input type="text" id="sekolahAsal" value="<?= set_value('sekolahAsal') ?>" name="sekolahAsal" class="form-control" required>
                  <?= form_error('sekolahAsal', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-lg-5 col-6">
                  <label for="npsn">NPSN Sekolah Asal</label>
                  <input type="text" id="npsn" value="<?= set_value('npsn') ?>" name="npsn" class="form-control" required>
                  <?= form_error('npsn', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--batas akhir data sekolah asal calon peserta didik  -->

        <!-- identitas Siswa -->
        <div class="card  mt-5">
          <div class="card-header d-flex justify-content-between">
            <h6 class="text-uppercase align-self-center">Identitas Calon Peserta Didik</h6>
            <i class="fas fa-angle-double-left"></i>
          </div>
          <div class="card-body">
            <div class="container">
              <div class="form-row">
                <div class="form-group col-lg-5 col-6">
                  <label for="namaSiswa">Nama Lengkap Calon Peserta Didik</label>
                  <input type="text" id="namaSiswa" value="<?= set_value('namaSiswa') ?>" name="namaSiswa" class="form-control" required>
                  <?= form_error('namaSiswa', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-lg-5 col-6">
                  <label style="display: inline-block; margin-left:45px;">Jenis Kelamin</label>
                  <br>
                  <div class="form-check ml-5 mt-2 form-check-inline">
                    <input class="form-check-input" <?php echo  set_radio('jk', 'L'); ?> type="radio" name="jk" id="inlineCheckbox1" value="L" required>
                    <label class="form-check-label" for="inlineCheckbox1">Laki - laki</label>
                  </div>
                  <div class="form-check ml-5 mt-2 form-check-inline">
                    <input class="form-check-input" type="radio" <?php echo  set_radio('jk', 'P'); ?> name="jk" id="inlineCheckbox2" value="P" required>
                    <label class="form-check-label" for="inlineCheckbox2">Perempuan</label>
                    <?= form_error('jk', '<small class="text-danger pl-3">', '</small>') ?>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-lg-5 col-6">
                  <label for="nikSiswa">NIK Calon Peserta Didik</label>
                  <input type="text" id="nikSiswa" value="<?= set_value('nikSiswa') ?>" maxlength="16" name="nikSiswa" class="form-control" required>
                  <?= form_error('nikSiswa', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-lg-5 col-6">
                  <label for="noKK">Nomor Kartu Keluarga</label>
                  <input type="text" id="noKK" value="<?= set_value('noKK') ?>" maxlength="16" name="noKK" class="form-control" required>
                  <?= form_error('noKK', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-lg-5 col-6">
                  <label for="nisnSiswa">NISN</label>
                  <input type="text" id="nisnSiswa" maxlength="10" value="<?= set_value('nisnSiswa') ?>" name="nisnSiswa" class="form-control" required>
                  <?= form_error('nisnSiswa', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-lg-5 col-6">
                  <label for="tglLahirSiswa">Tanggal Lahir</label>
                  <input type="text" id="tglLahirSiswa" autocomplete="off" value="<?= set_value('tglLahirSiswa') ?>" name="tglLahirSiswa" class="form-control notranslate" required>
                  <?= form_error('tglLahirSiswa', '<small class="text-danger pl-3">', '</small>') ?>
                  <small class="text-primary">Pastikan Tahun lahir di cek kembali!!! Usia menjadi pertimbangan ke lulusan</small>
                </div>
                <div class="form-group col-lg-5 col-6">
                  <label for="tempatLahir">Tempat Lahir</label>
                  <input type="text" id="tempatLahir" name="tempatLahir" value="<?= set_value('tempatLahir') ?>" class="form-control" required>
                  <?= form_error('tempatLahir', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-lg-5 col-6">
                  <label for="tinggiBadan">Tinggi Badan</label>
                  <input type="text" id="tinggiBadan" value="<?= set_value('tinggiBadan') ?>" name="tinggiBadan" class="form-control" required>
                  <?= form_error('tinggiBadan', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-lg-5 col-6">
                  <label for="beratBadan">Berat Badan</label>
                  <input type="text" id="beratBadan" name="beratBadan" value="<?= set_value('beratBadan') ?>" class="form-control" required>
                  <?= form_error('beratBadan', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-lg-5 col-6">
                  <label for="noHp">Agama</label>

                  <select name="agama" id="Agama" class="form-control">
                    <option value="">Pilih Agama----</option>
                    <option value="Islam" <?php echo  set_select('agama', 'Islam') ?>>Islam</option>
                    <option value="Kristen Katolik" <?php echo  set_select('agama', 'Kristen Katolik') ?>>Kristen Katolik</option>
                    <option value="Kristen Protestan" <?php echo  set_select('agama', 'Kristen Protestan') ?>>Kristen Protestan</option>
                    <option value="Hindu" <?php echo  set_select('agama', 'Hindu') ?>>Hindu</option>
                    <option value="Budha" <?php echo  set_select('agama', 'Budha') ?>>Budha</option>
                    <option value="Konghucu" <?php echo  set_select('agama', 'Konghucu') ?>>Konghucu</option>
                  </select>
                </div>

                <div class="form-group col-lg-5 col-6">
                  <label for="noHp">Nomor Telepon / Whatsapp Aktif</label>
                  <input type="text" id="noHp" name="noHp" value="<?= set_value('noHp') ?>" class="form-control" required>
                  <?= form_error('noHp', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>

              <div class="form-row">
                <div class=" form-group col-lg-5 col-6">
                  <label for="provinsi">Provinsi</label>
                  <select id="provinsi" required name="provinsi" class="form-control provinsi">
                    <option value="">Pilih Provinsi</option>
                    <?php foreach ($provinsi as $prov) : ?>
                      <option value="<?= $prov['id'] ?>"><?= $prov['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                  <?= form_error('provinsi', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-lg-5 col-6">
                  <label for="kabKota">Kabupaten/Kota</label>
                  <select id="kabKota" name="kabKota" class="form-control kabKota" required>
                  </select>
                </div>
              </div>


              <div class="form-row">
                <div class=" form-group col-6 col-lg-5">
                  <label for="kecamatan">Kecamatan</label>
                  <Select id="kecamatan" required name="kecamatan" class="form-control kecamatan">
                  </Select>
                </div>
                <div class="form-group col-6 col-lg-5">
                  <label for="desa">Desa / Kelurahan</label>
                  <select id="desa" required name="desa" class="form-control desa">
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-2 col-lg-2">
                  <label for="rt">Rt</label>
                  <input type="text" id="rt" name="rt" value="<?= set_value('rt') ?>" required class="form-control">
                  <?= form_error('rt', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class=" form-group col-2 col-lg-2">
                  <label for="rw">Rw</label>
                  <input type="text" id="rw" name="rw" value="<?= set_value('rw') ?>" required class="form-control">
                  <?= form_error('rw', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class=" form-group col-2 col-lg-2">
                  <label for="kodePos">Kode Pos</label>
                  <input type="text" id="kodePos" name="kodePos" value="<?= set_value('kodePos') ?>" required class="form-control">
                  <?= form_error('kodePos', '<small class="text-danger pl-3">', '</small>') ?>
                </div>

                <div class="form-group col-lg-4 col-6">
                  <label for="alamat">Alamat</label>
                  <textarea id="alamat" name="alamat" class="form-control" required> <?= set_value('alamat') ?> </textarea>
                  <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-lg-5 col-6">
                  <label for="longitude">Titik Kordinat/Longitude</label>
                  <input type="text" id="longitude" value="<?= set_value('longitude') ?>" required name="longitude" class="form-control">
                  <small class="text-muted pl-3">CONTOH: (-6.7487747,106.8026829) bisa di ambil <a href="https://www.google.co.id/maps/@-7.1087082,106.6527112,14z" target="blank">Disini</a></small>
                  <?= form_error('longitude', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- batas Identitas Siswa -->


        <!-- identitas orang tua calon peserta didik ayah-->
        <div class="card mt-5">
          <div class="card-header d-flex justify-content-between">
            <h6 class=" text-uppercase align-self-center">Identitas Orang tua Calon Peserta Didik (ayah)</h6>
            <i class="fas fa-angle-double-left"></i>
          </div>
          <div class="card-body">
            <div class="container">
              <div class="form-row">
                <div class="form-group col-lg-5 col-6">
                  <label for="namaAyah">Nama Ayah</label>
                  <input type="text" id="namaAyah" value="<?= set_value('namaAyah') ?>" required name="namaAyah" class="form-control">
                  <?= form_error('namaAyah', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-lg-5 col-6">
                  <label for="nikAyah">NIK Ayah</label>
                  <input type="text" id="nikAyah" maxlength="16" name="nikAyah" value="<?= set_value('nikAyah') ?>" required class="form-control">
                  <?= form_error('nikAyah', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-lg-5 col-6">
                  <label for="tahunLahirAyah">Tanggal Lahir Ayah</label>
                  <input type="text" id="tahunLahirAyah" name="tahunLahirAyah" value="<?= set_value('tahunLahirAyah') ?>" required class="form-control">
                  <?= form_error('tahunLahirAyah', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-6 col-lg-5">
                  <label for="pendidikanAyah">pendidikan Ayah</label>
                  <select name="pendidikanAyah" id="pendidikanAyah" class="form-control" required>
                    <option value="">Pilih pendidikan Ayah---</option>
                    <option value="SD sederajat" <?php echo  set_select('pendidikanAyah', 'SD sederajat') ?>>SD sederajat</option>
                    <option value="SMP Sederajat" <?php echo  set_select('pendidikanAyah', 'SMP Sederajat') ?>>SMP Sederajat</option>
                    <option value="SMA Sederajat" <?php echo  set_select('pendidikanAyah', 'SMA Sederajat') ?>>SMA Sederajat</option>
                    <option value="D-I" <?php echo  set_select('pendidikanAyah', 'D-I') ?>>D-I</option>
                    <option value="D-II" <?php echo  set_select('pendidikanAyah', 'D-II') ?>>D-II</option>
                    <option value="D-III" <?php echo  set_select('pendidikanAyah', 'D-III') ?>>D-III</option>
                    <option value="Strata-1 / S1 / D-4" <?php echo  set_select('pendidikanAyah', 'Strata-1 / S1 / D-4') ?>>Strata-1 / S1 / D-4</option>
                    <option value="Strata-2 / S2" <?php echo  set_select('pendidikanAyah', 'Strata-2 / S2') ?>>Strata-2 / S2</option>
                    <option value="Strata-3 / S3" <?php echo  set_select('pendidikanAyah', 'Strata-3 / S3') ?>>Strata-3 / S3</option>
                    <option value="Tidak Tamat SD" <?php echo  set_select('pendidikanAyah', 'Tidak Tamat SD') ?>>Tidak Tamat SD</option>
                    <option value="Sudah Meninggal" <?php echo  set_select('pendidikanAyah', 'Sudah Meninggal') ?>>Sudah Meninggal</option>
                  </select>
                  <?= form_error('pendidikanAyah', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-6 col-lg-5">
                  <label for="pekerjaanAyah">Pekerjaan Ayah</label>
                  <select name="pekerjaanAyah" id="pekerjaanAyah" class="form-control" required>
                    <option value="">Pilih Pekerjaan Ayah---</option>
                    <option value="Wiraswasta" <?php echo  set_select('pekerjaanAyah', 'Wiraswasta') ?>>Wiraswasta / Wirausaha</option>
                    <option value="Pegawai Swasta" <?php echo  set_select('pekerjaanAyah', 'Pegawai Swasta') ?>>Pegawai Swasta</option>
                    <option value="TNI" <?php echo  set_select('pekerjaanAyah', 'TNI') ?>>TNI</option>
                    <option value="Polri" <?php echo  set_select('pekerjaanAyah', 'Polri') ?>>Polri</option>
                    <option value="PNS" <?php echo  set_select('pekerjaanAyah', 'PNS') ?>>PNS</option>
                    <option value="Petani" <?php echo  set_select('pekerjaanAyah', 'Petani') ?>>Petani</option>
                    <option value="Pedagang" <?php echo  set_select('pekerjaanAyah', 'Pedagang') ?>>Pedagang</option>
                    <option value="Buruh" <?php echo  set_select('pekerjaanAyah', 'Buruh') ?>>Buruh</option>
                    <option value="Tidak Bekerja" <?php echo  set_select('pekerjaanAyah', 'Tidak Bekerja') ?>>Tidak Bekerja</option>
                    <option value="Sudah Meninggal" <?php echo  set_select('pekerjaanAyah', 'Sudah Meninggal') ?>>Sudah Meninggal</option>
                  </select>
                  <?= form_error('pekerjaanAyah', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-6 col-lg-5">
                  <label for="penghasilanAyah">Penghasilan Ayah</label>
                  <select name="penghasilanAyah" id="penghasilanAyah" class="form-control" required>
                    <option value="">Pilih Penghasilan Ayah---</option>
                    <option value="Kuurang 1.000.000" <?php echo  set_select('penghasilanAyah', '2.000.000') ?>> Kurang dari 1.000.000</option>
                    <option value="2.000.000" <?php echo  set_select('penghasilanAyah', '2.000.000') ?>>1.000.000 s/d 2.000.000</option>
                    <option value="3.000.000" <?php echo  set_select('penghasilanAyah', '3.000.000') ?>>2.000.000 s/d 3.000.000</option>
                    <option value="4.000.000" <?php echo  set_select('penghasilanAyah', '4.000.000') ?>>3.000.000 s/d 4.000.000</option>
                    <option value="5.000.000" <?php echo  set_select('penghasilanAyah', '5.000.000') ?>>4.000.000 s/d 5.000.000</option>
                    <option value="6.000.000" <?php echo  set_select('penghasilanAyah', '6.000.000') ?>>5.000.000 s/d 6.000.000</option>
                    <option value="8.000.000" <?php echo  set_select('penghasilanAyah', '8.000.000') ?>> Lebih dari 7.000.000</option>
                    <option value="Tidak Berpenghasilan" <?php echo  set_select('penghasilanAyah', 'Tidak Berpenghasilan') ?>>Tidak Berpenghasilan</option>
                  </select>
                  <?= form_error('penghasilanAyah', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- batas Identitas orang tua calon peserta didik ayah -->
        <!-- identitas orang tua calon peserta didik ibu -->
        <div class="card mt-5">
          <div class="card-header d-flex justify-content-between">
            <h6 class="text-warning text-uppercase align-self-center">Identitas Orang tua Calon Peserta Didik (Ibu)</h6>
            <i class="fas fa-angle-double-left"></i>
          </div>
          <div class="card-body">
            <div class="container">
              <div class="form-row ">
                <div class="form-group col-lg-5 col-6">
                  <label for="namaibu">Nama ibu</label>
                  <input type="text" id="namaibu" name="namaibu" value="<?= set_value('namaibu') ?>" class="form-control" required>
                  <?= form_error('namaibu', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-lg-5 col-6">
                  <label for="nikIbu">NIK Ibu</label>
                  <input type="text" id="nikIbu" maxlength="16" name="nikIbu" value="<?= set_value('nikIbu') ?>" class="form-control" required>
                  <?= form_error('nikIbu', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-lg-5 col-6">
                  <label for="tahunLahirIbu">Tanggal Lahir Ibu</label>
                  <input type="text" id="tahunLahirIbu" name="tahunLahirIbu" value="<?= set_value('tahunLahirIbu') ?>" required class="form-control">
                  <?= form_error('tahunLahirIbu', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-6 col-lg-5">
                  <label for="pendidikanIbu">pendidikan Ibu</label>
                  <select name="pendidikanIbu" id="pendidikanIbu" class="form-control" required>
                    <option value="">Pilih pendidikan Ibu---</option>
                    <option value="SD sederajat" <?php echo  set_select('pendidikanIbu', 'SD sederajat') ?>>SD sederajat</option>
                    <option value="SMP Sederajat" <?php echo  set_select('pendidikanIbu', 'SMP Sederajat') ?>>SMP Sederajat</option>
                    <option value="SMA Sederajat" <?php echo  set_select('pendidikanIbu', 'SMA Sederajat') ?>>SMA Sederajat</option>
                    <option value="D-I" <?php echo  set_select('pendidikanIbu', 'D-I') ?>>D-I</option>
                    <option value="D-II" <?php echo  set_select('pendidikanIbu', 'D-II') ?>>D-II</option>
                    <option value="D-III" <?php echo  set_select('pendidikanIbu', 'D-III') ?>>D-III</option>
                    <option value="Strata-1 / S1 / D-4" <?php echo  set_select('pendidikanIbu', 'Strata-1 / S1 / D-4') ?>>Strata-1 / S1 / D-4</option>
                    <option value="Strata-2 / S2" <?php echo  set_select('pendidikanIbu', 'Strata-2 / S2') ?>>Strata-2 / S2</option>
                    <option value="Strata-3 / S3" <?php echo  set_select('pendidikanIbu', 'Strata-3 / S3') ?>>Strata-3 / S3</option>
                    <option value="Tidak Tamat SD" <?php echo  set_select('pendidikanIbu', 'Tidak Tamat SD') ?>>Tidak Tamat SD</option>
                    <option value="Sudah Meninggal" <?php echo  set_select('pendidikanIbu', 'Sudah Meninggal') ?>>Sudah Meninggal</option>
                  </select>
                  <?= form_error('pendidikanIbu', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-6 col-lg-5">
                  <label for="pekerjaanIbu">Pekerjaan Ibu</label>
                  <select name="pekerjaanIbu" id="pekerjaanIbu" class="form-control" required>
                    <option value="">Pilih Pekerjaan Ibu---</option>
                    <option value="Wiraswasta" <?php echo  set_select('pekerjaanIbu', 'Wiraswasta') ?>>Wiraswasta / Wirausaha</option>
                    <option value="Pegawai Swasta" <?php echo  set_select('pekerjaanIbu', 'Pegawai Swasta') ?>>Pegawai Swasta</option>
                    <option value="TNI" <?php echo  set_select('pekerjaanIbu', 'TNI') ?>>TNI</option>
                    <option value="Polri" <?php echo  set_select('pekerjaanIbu', 'Polri') ?>>Polri</option>
                    <option value="PNS" <?php echo  set_select('pekerjaanIbu', 'PNS') ?>>PNS</option>
                    <option value="Petani" <?php echo  set_select('pekerjaanIbu', 'Petani') ?>>Petani</option>
                    <option value="Pedagang" <?php echo  set_select('pekerjaanIbu', 'Pedagang') ?>>Pedagang</option>
                    <option value="Buruh" <?php echo  set_select('pekerjaanIbu', 'Buruh') ?>>Buruh</option>
                    <option value="IRT" <?php echo  set_select('pekerjaanIbu', 'IRT') ?>>IRT</option>
                    <option value="Sudah Meninggal" <?php echo  set_select('pekerjaanIbu', 'Sudah Meninggal') ?>>Sudah Meninggal</option>
                  </select>
                  <?= form_error('pekerjaanIbu', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group col-6 col-lg-5">
                  <label for="penghasilanIbu">Penghasilan Ibu</label>
                  <select name="penghasilanIbu" id="penghasilanIbu" class="form-control" required>
                    <option value="">Pilih Penghasilan Ibu---</option>
                    <option value="Kurang 1000.000" <?php echo  set_select('penghasilanIbu', 'Kurang 1000.000') ?>>
                      Kurang dari 1.000.000</option>
                    <option value="1000.000" <?php echo  set_select('penghasilanIbu', '2.000.000') ?>>1.000.000 s/d 2.000.000
                    </option>
                    <option value="3.000.000" <?php echo  set_select('penghasilanIbu', '3.000.000') ?>>2.000.000 s/d 3.000.000</option>
                    <option value="4.000.000" <?php echo  set_select('penghasilanIbu', '4.000.000') ?>>3.000.000 s/d 4.000.000</option>
                    <option value="5.000.000" <?php echo  set_select('penghasilanIbu', '5.000.000') ?>>4.000.000 s/d 5.000.000</option>
                    <option value="6.000.000" <?php echo  set_select('penghasilanIbu', '6.000.000') ?>>5.000.000 s/d 6.000.000</option>
                    <option value="8.000.000" <?php echo  set_select('penghasilanIbu', '8.000.000') ?>> Lebih dari 7.000.000</option>
                    <option value="Tidak Berpenghasilan" <?php echo  set_select('penghasilanIbu', 'Tidak Berpenghasilan') ?>> Tidak Berpenghasilan</option>
                  </select>
                  <?= form_error('penghasilanIbu', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- batas Identitas orang tua calon peserta didik ibu -->
        <!-- Nilai Raport 6 Semester -->
        <div class="row mt-5">
          <div class="col-9 judul">
            <h3>Input Nilai</h3>
            <p class="text-danger">Inputkan nilai pada form dibawah ini dengan baik dan benar, Nilai yang dimasukan adalah nilai Pengetahuan (KI-3) Skala 0-100
            </p>
            <p>Nilai yang diinputkan akan di verifikasi kembali oleh panitia PPDB <?= $setting['nama_sekolah'] ?> pada saat verifikasi berkas asli
            </p>
          </div>
        </div>
        <div class="card mt-5">
          <div class="card-header d-flex justify-content-between">
            <h6 class="text-warning text-uppercase align-self-center">Nilai Raport 6 Semester</h6>
            <i class="fas fa-angle-double-left"></i>

          </div>
          <div class="card-body">
            <div class="container">
              <p class=" badge badge-primary text-center p-2">Nilai Raport</p>
              <p class="text-danger"> Nilai yang dimasukan adalah nilai Pengetahuan (KI-3) Skala 0-100</p>

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
                  <tr class="tr1">
                    <td>1</td>
                    <td>Pend. Agama</td>
                    <td><input type="text" name="paiK4S1" value="<?= set_value('paiK4S1') ?>" id="paiK4S1" maxLength="4" required></td>
                    <td><input type="text" name="paiK4S2" value="<?= set_value('paiK4S2') ?>" id="paiK4S2" maxLength="4" required></td>
                    <td><input type="text" name="paiK5S1" value="<?= set_value('paiK5S1') ?>" id="paiK5S1" maxLength="4" required></td>
                    <td><input type="text" name="paiK5S2" value="<?= set_value('paiK5S2') ?>" id="paiK5S2" maxLength="4" required></td>
                    <td><input type="text" name="paiK6S1" value="<?= set_value('paiK6S1') ?>" id="paiK6S1" maxLength="4" required></td>
                    <td><input type="text" name="paiK6S2" value="<?= set_value('paiK6S2') ?>" id="paiK6S2" maxLength="4" required></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>PPKN</td>
                    <td><input type="text" name="pknK4S1" value="<?= set_value('pknK4S1') ?>" id="pknK4S1" maxLength="4" required></td>
                    <td><input type="text" name="pknK4S2" value="<?= set_value('pknK4S2') ?>" id="pknK4S2" maxLength="4" required></td>
                    <td><input type="text" name="pknK5S1" value="<?= set_value('pknK5S1') ?>" id="pknK5S1" maxLength="4" required></td>
                    <td><input type="text" name="pknK5S2" value="<?= set_value('pknK5S2') ?>" id="pknK5S2" maxLength="4" required></td>
                    <td><input type="text" name="pknK6S1" value="<?= set_value('pknK6S1') ?>" id="pknK6S1" maxLength="4" required></td>
                    <td><input type="text" name="pknK6S2" value="<?= set_value('pknK6S2') ?>" id="pknK6S2" maxLength="4" required></td>
                  </tr>


                  <tr class="tr1">
                    <td>3</td>
                    <td>B.Indonesia</td>
                    <td><input type="text" name="indoK4S1" value="<?= set_value('indoK4S1') ?>" id="indoK4S1" maxLength="4" required></td>
                    <td><input type="text" name="indoK4S2" value="<?= set_value('indoK4S2') ?>" id="indoK4S2" maxLength="4" required></td>
                    <td><input type="text" name="indoK5S1" value="<?= set_value('indoK5S1') ?>" id="indoK5S1" maxLength="4" required></td>
                    <td><input type="text" name="indoK5S2" value="<?= set_value('indoK5S2') ?>" id="indoK5S2" maxLength="4" required></td>
                    <td><input type="text" name="indoK6S1" value="<?= set_value('indoK6S1') ?>" id="indoK6S1" maxLength="4" required></td>
                    <td><input type="text" name="indoK6S2" value="<?= set_value('indoK6S2') ?>" id="indoK6S2" maxLength="4" required></td>

                  </tr>

                  <tr>
                    <td>4</td>
                    <td>Matematika</td>
                    <td><input type="text" name="mtkK4S1" value="<?= set_value('mtkK4S1') ?>" maxLength="4" required></td>
                    <td><input type="text" name="mtkK4S2" value="<?= set_value('mtkK4S2') ?>" maxLength="4" required></td>
                    <td><input type="text" name="mtkK5S1" value="<?= set_value('mtkK5S1') ?>" maxLength="4" required></td>
                    <td><input type="text" name="mtkK5S2" value="<?= set_value('mtkK5S2') ?>" maxLength="4" required></td>
                    <td><input type="text" name="mtkK6S1" value="<?= set_value('mtkK6S1') ?>" maxLength="4" required></td>
                    <td><input type="text" name="mtkK6S2" value="<?= set_value('mtkK6S2') ?>" maxLength="4" required></td>


                  </tr>

                  <tr class="tr1">
                    <td>5</td>
                    <td>IPA</td>
                    <td><input type="text" name="ipaK4S1" value="<?= set_value('ipaK4S1') ?>" maxLength="4" required></td>
                    <td><input type="text" name="ipaK4S2" value="<?= set_value('ipaK4S2') ?>" maxLength="4" required></td>
                    <td><input type="text" name="ipaK5S1" value="<?= set_value('ipaK5S1') ?>" maxLength="4" required></td>
                    <td><input type="text" name="ipaK5S2" value="<?= set_value('ipaK5S2') ?>" maxLength="4" required></td>
                    <td><input type="text" name="ipaK6S1" value="<?= set_value('ipaK6S1') ?>" maxLength="4" required></td>
                    <td><input type="text" name="ipaK6S2" value="<?= set_value('ipaK6S2') ?>" maxLength="4" required></td>
                  </tr>

                  <tr>
                    <td>6</td>
                    <td>IPS</td>
                    <td><input type="text" name="ipsK4S1" value="<?= set_value('ipsK4S1') ?>" maxLength="4" required></td>
                    <td><input type="text" name="ipsK4S2" value="<?= set_value('ipsK4S2') ?>" maxLength="4" required></td>
                    <td><input type="text" name="ipsK5S1" value="<?= set_value('ipsK5S1') ?>" maxLength="4" required></td>
                    <td><input type="text" name="ipsK5S2" value="<?= set_value('ipsK5S2') ?>" maxLength="4" required></td>
                    <td><input type="text" name="ipsK6S1" value="<?= set_value('ipsK6S1') ?>" maxLength="4" required></td>
                    <td><input type="text" name="ipsK6S2" value="<?= set_value('ipsK6S2') ?>" maxLength="4" required></td>
                  </tr>

                  <tr class="tr1">
                    <td>7</td>
                    <td>SBDP</td>
                    <td><input type="text" name="sbdpK4S1" value="<?= set_value('sbdpK4S1') ?>" id="sbdpK4S1" maxLength="4" required></td>
                    <td><input type="text" name="sbdpK4S2" value="<?= set_value('sbdpK4S2') ?>" id="sbdpK4S2" maxLength="4" required></td>
                    <td><input type="text" name="sbdpK5S1" value="<?= set_value('sbdpK5S1') ?>" id="sbdpK5S1" maxLength="4" required></td>
                    <td><input type="text" name="sbdpK5S2" value="<?= set_value('sbdpK5S2') ?>" id="sbdpK5S2" maxLength="4" required></td>
                    <td><input type="text" name="sbdpK6S1" value="<?= set_value('sbdpK6S1') ?>" id="sbdpK6S1" maxLength="4" required></td>
                    <td><input type="text" name="sbdpK6S2" value="<?= set_value('sbdpK6S2') ?>" id="sbdpK6S2" maxLength="4" required></td>
                  </tr>

                  <tr>
                    <td>8</td>
                    <td>PJOK</td>
                    <td><input type="text" name="pjokK4S1" value="<?= set_value('pjokK4S1') ?>" id="pjokK4S1" maxLength="4" required></td>
                    <td><input type="text" name="pjokK4S2" value="<?= set_value('pjokK4S2') ?>" id="pjokK4S2" maxLength="4" required></td>
                    <td><input type="text" name="pjokK5S1" value="<?= set_value('pjokK5S1') ?>" id="pjokK5S1" maxLength="4" required></td>
                    <td><input type="text" name="pjokK5S2" value="<?= set_value('pjokK5S2') ?>" id="pjokK5S2" maxLength="4" required></td>
                    <td><input type="text" name="pjokK6S1" value="<?= set_value('pjokK6S1') ?>" id="pjokK6S1" maxLength="4" required></td>
                    <td><input type="text" name="pjokK6S2" value="<?= set_value('pjokK6S2') ?>" id="pjokK6S2" maxLength="4" required></td>
                  </tr>


                  <tr class="tr1">
                    <td>9</td>
                    <td>B.SUNDA</td>
                    <td><input type="text" name="sundaK4S1" value="<?= set_value('sundaK4S1') ?>" id="sundaK4S1" maxLength="4" required></td>
                    <td><input type="text" name="sundaK4S2" value="<?= set_value('sundaK4S2') ?>" id="sundaK4S2" maxLength="4" required></td>
                    <td><input type="text" name="sundaK5S1" value="<?= set_value('sundaK5S1') ?>" id="sundaK5S1" maxLength="4" required></td>
                    <td><input type="text" name="sundaK5S2" value="<?= set_value('sundaK5S2') ?>" id="sundaK5S2" maxLength="4" required></td>
                    <td><input type="text" name="sundaK6S1" value="<?= set_value('sundaK6S1') ?>" id="sundaK6S1" maxLength="4" required></td>
                    <td><input type="text" name="sundaK6S2" value="<?= set_value('sundaK6S2') ?>" id="sundaK6S2" maxLength="4" required></td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- batas Nilai Raport 6 Semester -->

        <p class="text-info mt-3">Pastikan data yg di inputkan adalah data yang benar-benar bisa di pertanggung jawabkan saat verifikasi berkas asli !!</p>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="setujuDaftar" value="1">
          <label class="form-check-label text-gray-200" for="setujuDaftar">Ya Saya Setuju</label>
        </div>
        <div class="form-row my-4  d-flex justify-content-end">
          <div class="form-group col-12 col-md-4">
            <button type="submit" id="daftarForm" class="btn btn-primary btn-block daftarForm"></i> Daftar</button>
          </div>
        </div>


      </form>
      <!-- batas akhir form -->
    </div>
  </section>
  <!-- batas Akhisr Formulir pendaftaran -->
<?php
} else {
?>

  <section class="formulir mb-5">
    <div class="container">
      <div class="jumbotron">
        <h1 class="display-4 text-success text-center">Mohon Maaf !!! <br>
          <img src="<?= base_url('assets/HomeAssets/img/logo/3.svg') ?>" style="width: 100px;" class="img-fluid my-2 text-center">
        </h1>
        <p class="lead">FORMULIR PPDB <?= $setting['nama_sekolah'] ?> TELAH DITUTUP</p>
        <hr class="my-4">
        <p>Mohon cek jadawal pendaftaran atau coba beberapa saat lagi</p>
        <a class="btn btn-primary btn-lg" href="<?= base_url('Home'); ?>" role="button">Kembali</a>
      </div>
    </div>
  </section>

<?php } ?>


























<!-- form Konfirmasi input nilai -->

<!-- modal konfirmasi pendaftaran -->

<!-- Modal -->
<div class="modal fade" id="konfirmasiInputNilai" tabindex="-1" role="dialog" aria-labelledby="konfirmasiInputNilaiTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-warning text-center" id="konfirmasiInputNilaiTitle"> Informasi !!!</h5>
      </div>
      <div class="modal-body">
        <h6 class="text-center text-muted">ANDA MEMILIH JALUR PPDB</h6>
        <h6 class="infoInputNilai text-center text-success"></h6>
        <p>jalur ppdb ini mewajibkan pendaftar untuk menginput nilai Prestasi Akademik dan Nonakademik</p>
        <p>Tingkatan Kejuaran yg dimiliki</p>
        <p><b>apakah anda sudah mempersiapkan persyaratan di atas ?</b></p>
      </div>
      <div class="modal-footer">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="baca" value="option1">
          <label class="form-check-label" for="baca">Ya saya siap</label>
        </div>
        <button type="button" class="btn btn-success lanjut" data-dismiss="modal">Lanjut</button>
      </div>
    </div>
  </div>
</div>