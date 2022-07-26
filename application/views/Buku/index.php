<div class="content">
        <input type="hidden" name="url" class="url" value="<?=base_url();?>">
        <input type="hidden" class="uriSegmen" value="<?=$this->uri->segment(1)?>">
        <input type="hidden" name="user" class="user" value="<?=$user['id'];?>">
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
               <button class="btn btn-success" id="tombolIportDataBukuExcel" data-toggle="modal" data-target="#modalImportBuku"><i class="fa fas fa-file-excel"> Import Data Excel</i></button>
                <button class="btn btn-secondary" id="tombolTambahDataBuku" data-toggle="modal" data-target="#modalTambahBuku"><i class="fas fa-address-book"></i> Tambah Data</i></button>

               <div class="table-custum">
                   <table class="display table table-sm" id="tabelBuku">
                       <thead>
                           <tr>
                               <th>No</th>
                               <th>Kode Buku</th>
                               <th>Judul Buku</th>
                               <th>Tahun</th>
                               <th>Kategori</th>
                               <th>Pengarang</th>
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
    <div class="modal fade" id="modalImportBuku" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalImportBuku" aria-hidden="true"> 
        <!-- modal dialog -->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- modal hedader -->
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">IMPORT DATA BUKU</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- end modal header -->
                <div class="modal-body">
                    <!-- form -->
                    <form id="form-data" class="form-data" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="importDataBuk">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="importDataBuku" id="UploadDataBuku" aria-describedby="importDataBuku">
                                <label class="custom-file-label" for="UploadDataBuk">Choose file</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="uploade"  name="uploade" >Upload</button>
                    </form>
                    <!-- end form -->
                </div>
            </div>
            <!-- end modal  -->

        </div>
        <!-- end modal dialog -->
    </div>
    <!-- ================================================ -->
    <!-- modal tambah data buku -->
    <div class="modal fade " id="modalTambahBuku" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambahBuku" aria-hidden="true"> 
        <!-- modal dialog -->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- modal hedader -->
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <!-- end modal header -->
                <div class="modal-body">
                    <!-- form -->
                    <form class="form-buku" id="formBuku">
                        <input type="hidden" name="id" class="id">

                        <div class="form-group">
                            <label>Kategori Buku</label>
                            <select class="form-control kategoriBuku" name="kategoriBuku">
                              <option value="">Pilih Kategori Buku----</option>
                            </select>
                        </div>

                        <div class="form-group">
                          <label for="spesifiksi">Spesifikasi Khusus</label>
                          <input type="text" class="form-control" name="spesifiksi" required aria-describedby="spesifiksi">
                        </div>

                        <div class="form-group">
                          <label for="judul">Judul Buku</label>
                          <input type="text" class="form-control" name="judul" required aria-describedby="judul">
                        </div>
                        <div class="form-group">
                          <label for="tahun">Tahun Terbit</label>
                          <input type="text" class="form-control" name="tahun" required aria-describedby="tahun">
                        </div>
                        <div class="form-group">
                          <label for="pengarang">Pengarang</label>
                          <input type="text" class="form-control" name="pengarang" required aria-describedby="pengarang">
                        </div>
                        <div class="form-group">
                          <label for="jumlahHalaman">Jumlah Halaman</label>
                          <input type="text" class="form-control" name="jumlahHalaman" required aria-describedby="jumlahHalaman">
                        </div>
                        <button type="submit" class="btn btn-primary tombolSimpanBuku">Simpan</button>
                      </form>
                    <!-- end form -->
                </div>
            </div>
            <!-- end modal  -->

        </div>
        <!-- end modal dialog -->
    </div>



    <!-- modal edit data buku -->
    <div class="modal fade " id="modalEditBuku" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalEditBuku" aria-hidden="true"> 
        <!-- modal dialog -->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- modal hedader -->
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Data Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <!-- end modal header -->
                <div class="modal-body">
                      <div class="text-danger">
                        <p>Hati-hati !!! bila anda mengedit dan menekan tombol edit</p>
                        <p>Berati kode buku secara automatis akan berubah, Untuk sebab itu maka harus cetak barcode ulang</p>
                      </div>
                    <!-- form -->
                    <form class="formEditBuku">
                        <input type="hidden" name="id" class="id">
                        <div class="form-group">
                            <label>Kategori Buku</label>
                            <select class="form-control kategoriBuku" name="kategoriBuku">
                              <option value="">Pilih Kategori Buku----</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="spesifiksi">Spesifikasi Khusus</label>
                          <input type="text" class="form-control spesifiksi" name="spesifiksi" required aria-describedby="spesifiksi">
                        </div>

                        <div class="form-group">
                          <label for="judul">Judul Buku</label>
                          <input type="text" class="form-control judul" id="judul" name="judul" required aria-describedby="judul">
                        </div>
                        <div class="form-group">
                          <label for="Tahun">Tahun</label>
                          <input type="text" class="form-control tahun" id="tahun" name="tahun" required aria-describedby="tahun">
                        </div>
                        <div class="form-group">
                          <label for="pengarang">Pengarang</label>
                          <input type="text" class="form-control pengarang" name="pengarang" id="pengarang" required aria-describedby="pengarang">
                        </div>
                        <div class="form-group">
                          <label for="jumlahHalaman">Jumlah Halaman</label>
                          <input type="text" class="form-control jumlahHalaman " name="jumlahHalaman" required id="jumlahHalaman" aria-describedby="jumlahHalaman">
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                      </form>
                    <!-- end form -->
                </div>
            </div>
            <!-- end modal  -->

        </div>
        <!-- end modal dialog -->
    </div>


    <!-- modal berhasil upload buku -->
      <!-- modal edit data buku -->
      <div class="modal fade modalBerhasilUpload" id="modalBerhasilUpload" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalBerhasilUpload" aria-hidden="true"> 
        <!-- modal dialog -->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- modal hedader -->
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Imformasi Upload Buku

                    </h5>
                        <div class="info"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <!-- end modal header -->
                <div class="modal-body">
                  <div class="informasiUploadBuku table-responsive-sm" style="height: 400px; overflow:auto;">
                      <h6>Daftar Buku Yang Duplikat</h6>
                      <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Buku</th>
                                <th>Judul</th>
                                <th>Spek</th>
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

      <!-- modal Copy data buku -->
      <div class="modal fade modalCopyBuku" id="modalCopyBuku" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalCopyBuku" aria-hidden="true"> 
        <!-- modal dialog -->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- modal hedader -->
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Imformasi Buku</h5>
                    <div class="info"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <!-- end modal header -->
                <div class="modal-body">
                  <input type="hidden" class="id">
                  <input type="text" class="form-control jlm">
                </div>
            </div>
            <!-- end modal  -->

        </div>
        <!-- end modal dialog -->
      </div>