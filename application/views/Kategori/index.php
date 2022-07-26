<div class="content">
        <input type="hidden" name="url" class="url" value="<?=base_url();?>">
        <input type="hidden" class="uriSegmen" value="<?=$this->uri->segment(1)?>">
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
                <button class="btn btn-primary" id="tombolTambahDataKategori" data-toggle="modal" data-target="#modalTambahKategori"><i class="fas fa-plus"></i> Tambah Data</i></button>
                 <div class="table-custum">
                   <table class="table table-sm" id="kategoriTable">
                       <thead>
                           <tr>
                               <th>No</th>
                               <th>Kode</th>
                               <th>Nama Kategori</th>
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


    <!-- modal tambah Kategori -->
    <div class="modal fade " id="modalTambahKategori" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambahKategori" aria-hidden="true"> 
        <!-- modal dialog -->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- modal hedader -->
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <!-- end modal header -->
                <div class="modal-body">
                    <!-- form -->
                    <form class="formKategori">
                        <input type="hidden" name="id" class="id">
                        <div class="form-group">
                          <label for="kodeKategori">Kode Kategori</label>
                          <input type="text" class="form-control kodeKategori" name="kodeKategori" required aria-describedby="kodeKategori">
                        </div>
                        <div class="form-group">
                          <label for="kategori">Kategori Kategori</label>
                          <input type="text" class="form-control kategori" name="kategori" required aria-describedby="kategori">
                        </div>
                        <button type="submit" class="btn btn-primary tombolSimpanKategori">Simpan</button>
                      </form>
                    <!-- end form -->
                </div>
            </div>
            <!-- end modal  -->
        </div>
        <!-- end modal dialog -->
    </div>
    <!-- end Modal Tambah Kategori======================================================================== -->

    <!-- modal edit Kategori============================================================ -->
    <div class="modal fade " id="modalEditKategori" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambahKategori" aria-hidden="true"> 
        <!-- modal dialog -->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- modal hedader -->
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Kategori </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <!-- end modal header -->
                <div class="modal-body">
                    <!-- form -->
                    <form class="formEditKategori">
                        <input type="hidden" name="id" class="id">
                        <div class="form-group">
                          <label for="kodeKategori">Kode Kategori</label>
                          <input type="text" class="form-control kodeKategori" name="kodeKategori" disabled="disabled" required aria-describedby="kodeKategori">
                        </div>
                        <div class="form-group">
                          <label for="kategori">Kategori Kategori</label>
                          <input type="text" class="form-control kategori" name="kategori" required aria-describedby="kategori">
                        </div>
                        <button type="submit" class="btn btn-primary tombolEditKategori">Simpan</button>
                      </form>
                    <!-- end form -->
                </div>
            </div>
            <!-- end modal  -->
        </div>
        <!-- end modal dialog -->
    </div>
    <!-- end modal edit enggota -->
