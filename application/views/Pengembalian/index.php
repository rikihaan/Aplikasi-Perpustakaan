     <input type="hidden" class="url" value="<?= base_url() ?>">
     <input type="hidden" class="uriSegmen" value="<?= $this->uri->segment(1) ?>">
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
                 <h4>Pengembalian Buku Harian</h4>
                 <input type="text" name="kodeAnggotaPengembalian" id="kodeAnggotaPengembalian" class="form-control kodeAnggotaPengembalian" autocomplete="off" placeholder="input ID Anggota/ Scan">
                 <input type="text" name="kedeBuku" id="inputKodeBukuPengembalian" class="form-control inputKodeBukuPengembalian" placeholder="input kode buku">
                 <div class="table-custum">
                     <!-- tabel pengembalian reguler -->
                     <table class="table table-sm" id="tabelPengembalian">
                         <thead>
                             <tr>
                                 <th>No</th>
                                 <th>Judul</th>
                                 <th>Tgl Pinjam</th>
                                 <th>Lama (Hari)</th>
                                 <th>Terlambat</th>
                                 <th>Denda (Rp.)</th>
                                 <th>Status</th>
                             </tr>
                         </thead>
                         <tbody>

                         </tbody>
                     </table>

                 </div>
                 <button class="button-reset-pengembalian mr-5">Reset Pengembalian</button>
                 <button class="button-proses btn-proses-kembali-Reg">Proses Pengembalian</button>
             </div>
             <!-- main right -->
             <div class="main-right">
                 <div class="titel-main-right1 d-flex">
                     <h4 class="align-items-center">Informasi User</h4>
                 </div>
                 <!-- box-user -->
                 <div class="box-user d-flex flex-row flex-wrap">
                     <div class="foto-user">
                         <img src="<?= base_url('assets/Backend/assets/img/user/noProfile.jpg') ?>" alt="">
                     </div>
                     <div class="name-user1 align-items-center">
                         <h6 class="user-nama1"></h6>
                         <h6 class="id-user1"></h6>
                         <h6 class="join-user1"></h6>
                     </div>
                     <div class="table-user">
                         <table class="table table-sm">
                             <thead>
                                 <tr class="user-kelas1">
                                     <th>Kelas</th>
                                     <td>:</td>
                                     <td></td>
                                 </tr>
                                 <tr class="user-nis1">
                                     <th>NIS/NISN</th>
                                     <td>:</td>
                                     <td></td>
                                 </tr>
                                 <tr class="user-kunjungan1">
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
                     <table class="table1 table-sm">
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