<div class="content">
        <input type="hidden" name="url" class="url" value="<?=base_url();?>">
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
                <button class="btn btn-primary" id="tombolTambahDataUser" data-toggle="modal" data-target="#modalTambahUser"><i class="fas fa-plus"></i> Tambah Data</i></button>
                 <div class="table-custum">
                   <table class="table table-sm" id="userTable">
                       <thead>
                           <tr>
                               <th>No</th>
                               <th>ID</th>
                               <th>Nama</th>
                               <th>Role</th>
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


    <!-- modal tambah User -->
    <div class="modal fade " id="modalTambahUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambahUser" aria-hidden="true"> 
        <!-- modal dialog -->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- modal hedader -->
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah User / Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <!-- end modal header -->
                <div class="modal-body">
                    <!-- form -->
                    <form class="formUser">
                        <input type="hidden" name="id" class="id">
                        <div class="form-group">
                          <label for="nama">Nama</label>
                          <input type="text" class="form-control nama" name="nama" required aria-describedby="nama">
                        </div>
                        <div class="form-group">
                            <label>Roles</label>
                            <select class="form-control dataRoles" name="roles" required>
                              <option value="">Pilih Roles----</option>
                              <option value="1">Admin</option>
                              <option value="2">Pustakawan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary tombolSimpanUser">Simpan</button>
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
    <div class="modal fade " id="modalEditUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambahUser" aria-hidden="true"> 
        <!-- modal dialog -->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- modal hedader -->
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit User / Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <!-- end modal header -->
                <div class="modal-body">
                    <!-- form -->
                    <form class="formEditUser">
                        <input type="hidden" name="id" class="id">
                        <div class="form-group">
                          <label for="nama">Nama</label>
                          <input type="text" class="form-control nama" name="nama" required aria-describedby="nama">
                        </div>
                        <div class="form-group">
                            <label>Roles</label>
                            <select class="form-control dataRoles" name="roles" required>
                              <option value="">Pilih Roles----</option>
                              <option value="1">Admin</option>
                              <option value="2">Pustakawan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary tombolSimpanUser">Simpan</button>
                      </form>
                    <!-- end form -->
                </div>
            </div>
            <!-- end modal  -->
        </div>
        <!-- end modal dialog -->
    </div>
    <!-- end modal edit enggota -->
