<!DOCTYPE html>
<html lang="en">

<head>
  <title>Keterangan</title>

</head>

<body>
  <style>
    .jalur {
      background-color: #eaeaea;
      color: #21475d;
      font-size: 17pt;
      text-align: center;
      border-radius: 3px;
      padding: 5px;
      margin-top: -24px;
    }

    .sarat {
      margin: 2px 0px;
      color: red;
    }

    table {
      width: 100%;
      font-size: 1em;

    }


    h3 {
      font-size: 20pt;
      font-weight: bold;
      line-height: 1.6px;
      text-align: center
    }

    .alamat {
      font-size: 12px;
      line-height: 1.4px;
      text-align: center
    }



    h4 {
      text-align: center;
      text-transform: uppercase;
      font-size: 15pt;
      letter-spacing: 2px;
      line-height: 1px;
      text-decoration: underline;
      font-style: italic;

    }




    .ttd {

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
      font-size: 11pt;
      float: right;
    }

    .ttd-kanan p {
      line-height: 1px;
    }

    .namaKepsek {
      margin-top: 110px;
    }

    .td1 {
      width: 30%;
    }

    .td2 {
      width: 10%;
    }

    .td3 {
      width: 3%;
    }

    .lulus {
      width: 500px;
      height: 10px;
      border: 1.4px solid black;
      border-radius: 5px;
      margin: 30px auto;
    }

    .lulus p {
      text-align: center;
      font-weight: bold;
      font-size: 14pt;
      letter-spacing: 10px;
    }

    .logo-sekolah {
      position: absolute;
      width: 110px;
      left: 620px;
      top: 45px;
    }

    .logo-dinas {
      position: absolute;
      width: 110px;
      top: 50px;
      left: 60px;
    }

    hr {
      height: 2px;
      color: black;
      margin-top: -8px;
    }

    h1,
    h2 {

      font-size: 17pt;
      text-align: center;
      line-height: 1.5px;
    }

    .noSurat {
      font-size: 14px;
      font-weight: 200;
      font-style: normal;
      line-height: -3px;
      text-decoration: none;
    }
  </style>
  <h1>PEMERINTAH KABUPATEN BOGOR</h1>
  <h2>DINAS PENDIDIKAN</h2>
  <h3><?= $sekolah['nama_sekolah']; ?></h3>
  <p class="alamat"><?= $sekolah['alamat']; ?></p>
  <hr>
  <h4>SURAT KETERANGAN</h4>
  <h4 class="noSurat">Nomor : <?= $sekolah['no_surat']; ?></h4>
  <p>Setelah memperhatikan kriteria umum serta persyaratan Penerimaan Peserta Didik Baru berdasarkan Surat Keputusan Kepala Dinas Pendidikan Kabupaten Bogor Nomor : 421/2.616-Disdik, Kepala <?= $sekolah['nama_sekolah']; ?> menerangkan bahwa :</p>
  <table>
    <tr>
      <td class="td1">ID REGISTRASI</td>
      <td class="td3">:</td>
      <td><?= $daftar['koreg'] ?></td>
    </tr>
    <tr>
      <td class="td1">Nama</td>
      <td class="td3">:</td>
      <td><?= $daftar['namaSiswa'] ?></td>
    </tr>
    <tr>
      <td>Tempat, Tanggal Lahir</td>
      <td class="td3">:</td>
      <td><?= $daftar['tempatLahirSiswa'] . ', ' . date('d F Y', strtotime($daftar['tanggalLahirSiswa'])); ?></td>
    </tr>
    <tr>
      <td>NISN</td>
      <td class="td3">:</td>
      <td><?= $daftar['nisnSiswa'] ?></td>
    </tr>
    <tr>
      <td>Asal Sekolah</td>
      <td class="td3">:</td>
      <td><?= $daftar['asalSekolah'] ?></td>
    </tr>
    <tr>
      <td>Nama Orang Tua</td>
      <td class="td3">:</td>
      <td></td>
    </tr>
    <tr>
      <td>Ayah</td>
      <td class="td3">:</td>
      <td><?= $daftar['namaAyah'] ?></td>
    </tr>
    <tr>
      <td>Ibu</td>
      <td class="td3">:</td>
      <td><?= $daftar['namaIbu'] ?></td>
    </tr>
    <tr>
      <td class="td1">Nomor Daftar</td>
      <td class="td3">:</td>
      <td><?= $daftar['koreg'] ?></td>
    </tr>
    <tr>
      <td>Tanggal Daftar</td>
      <td class="td3">:</td>
      <td><?= date('d F Y', strtotime($daftar['tanggalRegister'])) ?></td>
    </tr>
    <tr>
      <td>Jalur PPDB</td>
      <td class="td3">:</td>
      <td><?= $daftar['ppdb'] ?></td>
    </tr>
  </table>
  <div class="lulus">
    <p>TIDAK DITERIMA</p>
  </div>

  <p>Sebagai siswa kelas VII Tahun Pelajaran 2020/2021 di <?= $sekolah['nama_sekolah']; ?>
    Demikian surat ini dibuat, dan dapat dipergunakan seperlunya.
  </p>
  <div style="width: 100px; position:absolute; left:460px; top:820px;">
    <img src="<?= base_url('assets/HomeAssets/file/') . $sekolah['ttd_kepsek']; ?>">
  </div>
  <div class="ttd">
    <div class="ttd-kiri">
    </div>
    <div class="ttd-kanan">
      <p><?= $sekolah['kecamatan'] . ', ' . $tanggalSurat; ?></p>
      <p>Kepala Sekolah</p>
      <p class="namaKepsek"><?= $sekolah['nama_kepala']; ?></p>
      <p class="nip">NIP <?= $sekolah['nip_kepsek']; ?></p>
    </div>
  </div>
  <div style="clear: both;"></div>
  <br><br><br><br><br><br>
  <br>
</body>

</html>