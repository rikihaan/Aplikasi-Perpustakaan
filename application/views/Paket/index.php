<input type="hidden" class="uriSegmen" value="<?=$this->uri->segment(1)?>">
     
   <input type="hidden" class="url">
     <div class="content">
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
                <h4>Peminjaman Buku Paket</h4>
               <input type="text" name="kodeAnggota" id="kodeAnggota" class="form-control inputKodeAnggotaPaket" autocomplete="off" placeholder="input ID Anggota/ Scan">
               <div class="content-cari">
                    <ul class="list-group">
                        
                    </ul>
                </div>
               <input type="text" name="kedeBuku" id="kodeBuku" class="form-control inputKodeBukuPaket" placeholder="input kode buku">
               <div class="table-custum">
                   <table class="table table-sm" id="tabelKeranjangPaket">
                       <thead>
                           <tr>
                               <th>No</th>
                               <th>Kode Buku</th>
                               <th>Judul Buku</th>
                               <th>Tahun</th>
                               <th>Aksi</th>
                           </tr>
                       </thead>
                       <tbody>
                           
                       </tbody>
                   </table>
               </div>
               <button class="button-reset-pinjaman-paket mr-5">Reset</button>
               <button class="button-proses btn-proses-Pinjaman-bukuPaket">Proses Pinjaman</button>
           </div>
           <!-- main right -->
           <div class="main-right">
                <div class="titel-main-right1 d-flex">
                        <h4 class="align-items-center">Informasi User</h4>
                </div>
                <!-- box-user -->
                <div class="box-user d-flex flex-row flex-wrap">
                    <div class="foto-user">
                        <img src="<?=base_url('assets/Backend/assets/img/user/noProfile.jpg')?>" alt="">
                    </div>
                    <div class="name-user align-items-center">
                        <h6 class="user-nama"></h6>
                        <h6 class="id-user"></h6>
                        <h6 class="join-user"></h6>
                    </div>
                    <div class="table-user">
                        <table class="table table-sm">
                            <thead>
                                <tr class="user-kelas">
                                    <th>Kelas</th>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr class="user-nis">
                                    <th>NIS/NISN</th>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr class="user-kunjungan">
                                    <th>Jml Kunjungan</th>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- end box user -->
                <div class="titel-main-right d-flex">
                    <h4 class="align-items-center">Informasi Lainya</h4>
                </div>
                <div class="box-informasi">
                    <h1>History Peminjaman</h1>
                   <table class="table table-sm">
                       <thead>
                           <tr>
                               <th>judul</th>
                               <th>lama pinjam</th>
                           </tr>
                       </thead>
                       <tbody>

                       </tbody>

                   </table>
                </div>
                <!-- end box informasi -->
                <div class="titel-main-right d-flex">
                    <h4 class="align-items-center">Tentang Aplikasi</h4>
                </div>
                <div class="box-tentang-aplikasi">
                    <h2>Aplikasi Perpustakaan</h2>
                    <p>V 0.0.1</p>
                </div>
           </div>
        </div>

    </div>


    <!-- modal konfirmasi jenis peminjaman -->
     <!-- modal edit data buku -->
     <div class="modal fade " id="suksesPinjamPaket" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="suksesPinjamPaket" aria-hidden="true"> 
        <!-- modal dialog -->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- modal hedader -->
                <div class="modal-header">
                    <h2 class="modal-title" id="staticBackdropLabel">Bukti Peminjaman Paket</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <!-- end modal header -->
                <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <table class="table table-sm tabelIdentitasAnggota" width="100%">
                                    <tr>
                                        <th>ID</th>
                                        <td>:</td>
                                        <td>PER0902191029</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>:</td>
                                        <td>Asep Riki</td>
                                    </tr>
                                    <tr>
                                        <th>Kelas</th>
                                        <td>:</td>
                                        <td>Vii-1</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pinjam</th>
                                        <td>:</td>
                                        <td>20-09-20</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-4">
                            <button class="btn btn-secondary print-sukses-paket">Print Bukti Peminjaman</button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-danger"  data-dismiss="modal" aria-label="Close">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal  -->

        </div>
        <!-- end modal dialog -->
    </div>