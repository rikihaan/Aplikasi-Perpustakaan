<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bukti Verifikasi </title>
  <style>
    .ttd {
      display: table;
      /* display: flex; */
      margin-top: 20px;
      width: 100%;
      height: 30px;

      /* justify-content: space-around; */
    }

    .ttd-kiri {
      float: left;
      width: 40%;
      height: 100px;

    }

    .ttd-kanan {
      width: 40%;
      height: 100px;
      font-size: 10px;
      float: right;
    }

    .ttd-kanan p {
      line-height: 1px;
    }

    .namaKepsek {
      margin-top: 80px;
    }

    .logo-sekolah {
      position: absolute;
      width: 70px;
      left: 0;
      float: right;
      top: 0;
    }

    .logo-dinas {
      position: absolute;
      width: 70px;
      top: 0;
      left: 0;
    }



    h1,
    h2 {

      font-size: 16px;
      text-align: center;
      line-height: 1px;
    }

    h3 {
      font-size: 18px;
      font-weight: bold;
      line-height: 1.3px;
      text-align: center
    }

    p {
      font-size: 10px;
      /* line-height: 1.4px; */
      /* text-align: center */
    }


    .td1 {
      width: 30%;

    }

    .td {
      width: 40%;

    }

    /* .td2 {
      width: 30%;
      text-align: right;
    } */

    .td3 {
      width: 5%;
    }

    hr {
      margin-top: -6px;
      height: 1px;
      color: black;
    }

    .judul {
      line-height: 1px;
      text-transform: uppercase;
      margin-top: 1px;
      font-size: 12px;
      font-weight: bold;
      text-align: center;
    }

    table {
      font-size: 0.7em;
      line-height: 25px;
      width: 100%;
    }

    table td {
      height: 1px;

    }

    .yang {
      text-align: left;
      font-size: 12px;
      margin-top: 5px;
    }

    .alamat {
      text-align: center;
    }

    /* .container {
      width: 100%;

    } */

    .kiri {
      width: 46%;
      float: left;
      position: absolute;
    }

    .kanan {
      width: 48%;
      float: right;
      padding-left: 25px;
      border-left: 1px dotted black;
      margin-left: 30px;

    }

    .jalur {
      text-align: center;
      border: 1px solid lightseagreen;
      border-radius: 5px;
      background-color: #eaeaea;
    }
  </style>
</head>

<body>

  <div class="container">
    <!-- bagian kiri -->
    <div class="kiri">
      <div class="logo-sekolah">
        <img src="<?= base_url('assets/img/logo/') . $sekolah['logo'] ?>">
      </div>
      <div class="logo-dinas">
        <img src="<?= base_url('assets/img/logo/') ?>kabBogor.png">
      </div>
      <div style="text-align: center; position:absolute; width: 100%; margin-top:-80px; ">
        <h1>PEMERINTAH KABUPATEN BOGOR</h1>
        <h2>DINAS PENDIDIKAN</h2>
        <h3><?= $sekolah['nama_sekolah']; ?></h3>
        <p class="alamat" style="font-size:9px"><?= $sekolah['alamat']; ?></p>
      </div>
      <hr>
      <p class="judul"> Tanda bukti verifikasi berkas</p>
      <p class="judul"> Pendaftaran penerimaan peserta didik baru</p>
      <p class="judul"><?= $sekolah['nama_sekolah']; ?> TP.2020/2021</p>
      <p class="yang">Yang bertanda tangan di bawah ini panitia ppdb <?= $sekolah['nama_sekolah']; ?> menerangkan bahwa : </p>
      <table>
        <tr class="tr">
          <td class="td1">No Registrasi</td>
          <td class="td3">:</td>
          <td><?= $pendaftar['koreg'] ?></td>
          <td class="td2">NISN</td>
          <td>:</td>
          <td><?= $pendaftar['nisnSiswa'] ?></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td class="td3">:</td>
          <td style="text-transform: uppercase;"><?= $pendaftar['namaSiswa'] ?></td>

        </tr>
        <tr>
          <td>Tanggal Lahir</td>
          <td class="td3">:</td>
          <td><?= $pendaftar['tanggalLahirSiswa'] ?></td>
          <td class="td2">JK</td>
          <td>:</td>
          <td><?= $pendaftar['jk'] ?></td>
        </tr>
        <tr>
          <td>NIK</td>
          <td class="td3">:</td>
          <td><?= $pendaftar['nikSiswa'] ?></td>
        </tr>
        <tr>
          <td>Sekolah Asal</td>
          <td class="td3">:</td>
          <td><?= $pendaftar['asalSekolah'] ?></td>
        </tr>
        <tr>
          <td>NPSN Sekolah Asal</td>
          <td class="td3">:</td>
          <td><?= $pendaftar['npsnSekolah'] ?></td>
        </tr>
        <tr>
          <td>Tanggal Daftar</td>
          <td class="td3">:</td>
          <td><?= $tanggalDaftar ?></td>
        </tr>
        <tr>
          <td>Titik Kordinat</td>
          <td class="td3">:</td>
          <td><?= $pendaftar['longitude'] ?></td>
        </tr>
        <tr>
          <td>Jarak</td>
          <td class="td3">:</td>
          <td><?= $pendaftar['totalJarak'] . ' meter' ?></td>
        </tr><?php if ($pendaftar['id_jalur'] == 4) { ?>
          <tr>
            <td>Scr. N. Prestasi</td>
            <td class="td3">:</td>
            <td class="td"><?= $pendaftar['nilaiPrestasi'] ?></td>
          </tr>
        <?php } elseif ($pendaftar['id_jalur'] == 6) { ?>
          <tr>
            <td>Jml. N. Rata"</td>
            <td class="td3">:</td>
            <td class="td"><?= $pendaftar['jumlahRataRata'] ?></td>
          </tr>
        <?php } ?>
      </table>
      <div class="jalur">
        <p><?= $pendaftar['ppdb'] ?></p>
      </div>
      <p class="yang">Telah terverifikasi sebagai calon ppdb <?= $sekolah['nama_sekolah']; ?> TP.2020/2021.</p>
      <div class="ttd">
        <div class="ttd-kiri">
        </div>
        <div class="ttd-kanan">
          <p class="kecamatan"><?= $sekolah['kecamatan'] . ', ' . $tanggalVerifikasi; ?></p>
          <p class="kecamatan">Di verifikasi Oleh:</p>
          <p class="namaKepsek"><?= $pendaftar['prosesBy'] ?></p>
          <p class="nip"></p>
        </div>
      </div>
      <div style="clear: both;"></div>
    </div>
    <!-- akhir bagian kiri -->
    <div class="kanan">
      <div class="logo-sekolah">
        <img src="<?= base_url('assets/img/logo/') . $sekolah['logo'] ?>">
      </div>
      <div class="logo-dinas">
        <img src="<?= base_url('assets/img/logo/') ?>kabBogor.png">
      </div>
      <div style="text-align: center; position:absolute; width: 100%; margin-top:-80px;">
        <h1>PEMERINTAH KABUPATEN BOGOR</h1>
        <h2>DINAS PENDIDIKAN</h2>
        <h3><?= $sekolah['nama_sekolah']; ?></h3>
        <p class="alamat" style="font-size:9px"><?= $sekolah['alamat']; ?></p>
      </div>
      <hr>
      <p class="judul"> Tanda bukti verifikasi berkas</p>
      <p class="judul"> Pendaftaran penerimaan peserta didik baru</p>
      <p class="judul"><?= $sekolah['nama_sekolah']; ?> TP. 2020/2021</p>

      <p class="yang">Yang bertanda tangan di bawah ini panitia ppdb <?= $sekolah['nama_sekolah']; ?> menerangkan bahwa : </p>
      <table>
        <tr>
          <td class="td1">No Registrasi</td>
          <td class="td3">:</td>
          <td class="td"><?= $pendaftar['koreg'] ?></td>
          <td class="td2">NISN</td>
          <td>:</td>
          <td><?= $pendaftar['nisnSiswa'] ?></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td class="td3">:</td>
          <td class="td" style="text-transform: uppercase;"><?= $pendaftar['namaSiswa'] ?></td>
        </tr>
        <tr>
          <td>Tanggal Lahir</td>
          <td class="td3">:</td>
          <td class="td"><?= $pendaftar['tanggalLahirSiswa'] ?></td>
          <td class="td2">JK</td>
          <td>:</td>
          <td><?= $pendaftar['jk'] ?></td>
        </tr>
        <tr>
          <td>NIK</td>
          <td class="td3">:</td>
          <td class="td"><?= $pendaftar['nikSiswa'] ?></td>
        </tr>
        <tr>
          <td>Sekolah Asal</td>
          <td class="td3">:</td>
          <td class="td"><?= $pendaftar['asalSekolah'] ?></td>
        </tr>
        <tr>
          <td>NPSN Sekolah Asal</td>
          <td class="td3">:</td>
          <td class="td"><?= $pendaftar['npsnSekolah'] ?></td>
        </tr>
        <tr>
          <td>Tanggal Daftar</td>
          <td class="td3">:</td>
          <td class="td"><?= $tanggalDaftar ?></td>
        </tr>
        <tr>
          <td>Titik Kordinat</td>
          <td class="td3">:</td>
          <td class="td"><?= $pendaftar['longitude'] ?></td>
        </tr>
        <tr>
          <td>Jarak</td>
          <td class="td3">:</td>
          <td class="td"><?= $pendaftar['totalJarak'] . ' meter' ?></td>
        </tr>
        <?php if ($pendaftar['id_jalur'] == 4) { ?>
          <tr>
            <td>Scr. N. Prestasi</td>
            <td class="td3">:</td>
            <td class="td"><?= $pendaftar['nilaiPrestasi'] ?></td>
          </tr>
        <?php } elseif ($pendaftar['id_jalur'] == 6) { ?>
          <tr>
            <td>Jml. N. Rata"</td>
            <td class="td3">:</td>
            <td class="td"><?= $pendaftar['jumlahRataRata'] ?></td>
          </tr>
        <?php } ?>
      </table>
      <div class="jalur">
        <p><?= $pendaftar['ppdb'] ?></p>
      </div>
      <p class="yang">Telah terverifikasi sebagai calon ppdb <?= $sekolah['nama_sekolah']; ?> TP. 2020/2021.</p>
      <div class="ttd">
        <div class="ttd-kiri">
        </div>
        <div class="ttd-kanan">
          <p class="kecamatan"><?= $sekolah['kecamatan'] . ', ' .  $tanggalVerifikasi; ?></p>
          <p class="kecamatan">Di verifikasi Oleh:</p>
          <p class="namaKepsek"><?= $pendaftar['prosesBy'] ?></p>
          <p class="nip"></p>
        </div>
      </div>
      <div style="clear: both;"></div>
    </div>
    <div style="clear: both"></div>
  </div>


</body>

</html>