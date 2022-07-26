<div class="sidebar-left">
        <!-- profil -->
        <div class="profil">
            <div class="gambar-profil">
                <div class="online"></div>
                <img src="https://placeimg.com/90/90/animals" alt="">
            </div>
            <div class="title-profil">
                <h5><?=$user['name']?></h5>
                <h6><?=$user['jabatan']?></h6>
            </div>
        </div>
        <!-- sidebar -->
        <div class="judul-sidebar">
            <h6>Data Master</h6>
            <hr>
        </div>
        <div class="sidebar-content d-flex justify-content-between flex-wrap">
            <a class="btn-custum btn" href="<?=base_url('Buku')?>">Buku</a>
            <a class="btn-custum btn" href="<?=base_url('Anggota')?>">Anggota</a>
            <a class="btn-custum btn" href="<?=base_url('Kategori')?>">Kategori</a>
            <a class="btn-custum btn" href="<?=base_url('User')?>">Pengguna</a>
        </div>
        <div class="judul-sidebar">
            <h6>Peminjaman</h6>
            <hr>
        </div>
        <div class="sidebar-content d-flex justify-content-between flex-wrap">
            <a class="btn-custum bg-blue btn " href="<?=base_url('Admin')?>" >Harian</a>
            <a class="btn-custum bg-blue btn"  href="<?=base_url('Paket')?>">Buku Paket</a>
            <a class="btn-custum bg-blue btn">Paket Kelas</a>
        </div>
        <div class="judul-sidebar">
            <h6>Pengembalian</h6>
            <hr>
        </div>
        <div class="sidebar-content d-flex justify-content-between flex-wrap">
            <a class="btn-custum btn buttonKembaliHarian" data-js="R" href="<?=base_url('Pengembalian')?>">Harian</a>
            <a class="btn-custum btn"  data-js="P" href="<?=base_url('Paket/Pengembalian')?>">Buku Paket</a>
            <a class="btn-custum btn">Paket Kelas</a>
        </div>
        <div class="sidebar-content d-flex justify-content-center flex-wrap">
            <a href="<?=base_url('Buku/BukuBarcode');?>" class="btn-custum-2 bg-blue btn">Buku Barcode</a>
            <button class="btn-custum-2 bg-blue btn">Registrasi Kartu</button>
        </div>
    </div>