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
            <h4>Data Transakasi</h4>
            <div class="tombol-data">
                <h2>Download Data</h2>
                <button type="button" class="btn btn-primary">Peminjaman Paket </button>
                <button type="button" class="btn btn-secondary">Peminjaman Reguler</button>
                <button type="button" class="btn btn-success">Pengembalian Reguler</button>
                <button type="button" class="btn btn-success">Pengembalian Paket</button>
            </div>
            <div class="pencarian-data-transaksi">
                <h2>Pencarian Data Peminjaman</h2>
                <p>Scan kode anggota / kode buku disini !!!, untuk mengecek data buku atau data anggota, atau ketikan nama</p>
                <input type="text" name="kodeBukuAnggota" id="kodeBukuAnggota" class="kodeBukuAnggota">
            </div>
            <div class="container-data-peminjaman">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Peminjam</td>
                            <td>Judul</td>
                            <td>Kode Buku</td>
                            <td>TGL Pinjam</td>
                            <td>JNS Pinjaman</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>