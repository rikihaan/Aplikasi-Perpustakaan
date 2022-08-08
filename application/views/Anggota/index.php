<div class="content">
  <input type="hidden" name="url" class="url" value="<?= base_url(); ?>">
  <input type="hidden" class="uriSegmen" value="<?= $this->uri->segment(1) ?>">
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
      <div class="row mt-4">
        <div class="col">
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-file-export"></i> Exsport Data Anggota
            </button>
            <div class="dropdown-menu">
              <?php foreach ($kelas as $key => $value) : ?>
                <a class="dropdown-item" href="<?= base_url('Anggota/ExportByKelas/') . $value['kelas'] ?>"><?= $value['kelas'] ?></a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <div class="col">
          <button class="btn btn-success" id="tombolIportDataAnggotaExcel" data-toggle="modal" data-target="#modalImportAnggota"><i class="fa fas fa-file-excel"> Import Data Excel</i></button>
        </div>

        <div class="col">
          <button class="btn btn-secondary" id="tombolTambahDataAnggota" data-toggle="modal" data-target="#modalTambahAnggota"><i class="fas fa-plus"></i> Tambah Data</i></button>
        </div>
        <div class="col">
          <a href="<?= base_url('assets/Backend/assets/file/FormatUploadanggota.xlsx') ?>" class="btn btn-warning"><i class="fas fa-download"></i> Download format</i></a>
        </div>
      </div>

      <div class="table-custum">
        <table class="display table table-sm" id="anggota">
          <thead>
            <tr>
              <th>No</th>
              <th>ID</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>

  </div>

</div>


<!-- modal import FIle excel -->
<div class="modal fade" id="modalImportAnggota" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalImportAnggota" aria-hidden="true">
  <!-- modal dialog -->
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <!-- modal hedader -->
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">IMPORT DATA Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- end modal header -->
      <div class="modal-body">
        <!-- form -->
        <form id="form-dataAnggota" class="form-dataAnggota" enctype="multipart/form-data">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="importDataBuk">Upload</span>
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="importDataAnggota" id="UploadDataAnggota" aria-describedby="importDataAnggota">
              <label class="custom-file-label" for="UploadDataAnggota">Choose file</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary" id="uploadeAnggota" name="uploade">Upload</button>
        </form>
        <!-- end form -->
      </div>
    </div>
    <!-- end modal  -->

  </div>
  <!-- end modal dialog -->
</div>


<!-- modal tambah Anggota -->
<div class="modal fade " id="modalTambahAnggota" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambahAnggota" aria-hidden="true">
  <!-- modal dialog -->
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <!-- modal hedader -->
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- end modal header -->
      <div class="modal-body">
        <!-- form -->
        <form class="formAnggota">
          <input type="hidden" name="id" class="id">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control nama" name="nama" required aria-describedby="nama">
          </div>
          <div class="form-group">
            <label>Kelas</label>
            <select class="form-control dataKelas" name="kelas" required>
              <option value="">Pilih Kelas----</option>
            </select>
          </div>
          <div class="form-group">
            <label for="nis">NIS</label>
            <input type="text" class="form-control nis" name="nis" required aria-describedby="nis">
          </div>
          <div class="form-group">
            <label for="nisn">nisn</label>
            <input type="text" class="form-control nisn" name="nisn" required aria-describedby="nisn">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control alamat" name="alamat" required aria-describedby="alamat" required>
                          </textarea>
          </div>
          <button type="submit" class="btn btn-primary tombolSimpanAnggota">Simpan</button>
        </form>
        <!-- end form -->
      </div>
    </div>
    <!-- end modal  -->

  </div>
  <!-- end modal dialog -->
</div>
<!-- end Modal Tambah Anggota======================================================================== -->

<!-- modal edit anggota============================================================ -->
<div class="modal fade " id="modalEditAnggota" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalEditAnggota" aria-hidden="true">
  <!-- modal dialog -->
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <!-- modal hedader -->
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Data Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- end modal header -->
      <div class="modal-body">
        <!-- form -->
        <form class="formEditAnggota">
          <input type="hidden" name="id" class="id">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control nama" name="nama" required aria-describedby="nama">
          </div>
          <div class="form-group">
            <label>Kelas</label>
            <select class="form-control dataKelas" name="kelas">
              <option value="">Pilih Kelas----</option>
            </select>
          </div>
          <div class="form-group">
            <label for="nis">NIS</label>
            <input type="text" class="form-control nis" name="nis" required aria-describedby="nis">
          </div>
          <div class="form-group">
            <label for="nisn">nisn</label>
            <input type="text" class="form-control nisn" name="nisn" required aria-describedby="nisn">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control alamat" name="alamat" required aria-describedby="alamat">
                          </textarea>
          </div>
          <button type="submit" class="btn btn-primary tombolEditAnggota">Edit Data Anggota</button>
        </form>
        <!-- end form -->
      </div>
    </div>
    <!-- end modal  -->

  </div>
  <!-- end modal dialog -->
</div>
<!-- end modal edit enggota -->


<!-- modal berhasil upload Anggota -->
<div class="modal fade modalBerhasilUpload" id="modalBerhasilUpload" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalBerhasilUpload" aria-hidden="true">
  <!-- modal dialog -->
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <!-- modal hedader -->
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Imformasi Upload Anggota

        </h5>
        <div class="info"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- end modal header -->
      <div class="modal-body">
        <div class="informasiUploadAnggota table-responsive-sm" style="height: 400px; overflow:auto;">
          <h6>Daftar Anggota Yang Duplikat</h6>
          <table class="table table-sm">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>NIS</th>
                <th>NISN</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end modal  -->

  </div>
  <!-- end modal dialog -->
</div>