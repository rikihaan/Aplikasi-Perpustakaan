<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bukti Pendaftaran</title>

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
      margin-top: 1px;
    }

    .sarat {
      margin: 2px 0px;
      color: red;
    }

    table {
      width: 100%;
      font-size: 1em;

    }

    h1,
    h2 {

      font-size: 17pt;
      text-align: center;
      line-height: 1.5px;
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

    .logo-sekolah {
      position: absolute;
      width: 110px;
      left: 640px;
      top: 60px;
    }

    .logo-dinas {
      position: absolute;
      width: 110px;
      top: 60px;
      left: 66px;
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

    hr {
      height: 2px;
      color: black;
      margin-top: -8px;
    }

    p {
      line-height: 1px;
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
      margin-top: 80px;
    }

    .td1 {
      width: 30%;
      padding: 2px;
      text-align: center;
    }

    .td2 {
      width: 10%;
      text-align: center;
    }

    .td3 {
      width: 3%;
    }

    .nilaiRaport {
      border-collapse: collapse;
      width: 100%;
      font-size: 14px;
    }

    .nilaiRaport tr td {
      border: 1px solid black;
      padding: 2px;

    }

    .nilaiRaport2 {
      width: 50%;

    }

    .td4 {
      width: 10%;
    }

    .td5 {
      width: 50%;
    }

    .td6 {
      width: 4%;
    }

    .noUrut {
      width: 100px;
      height: 80px;
      border: 1px solid #eaeaea;
      position: absolute;
      left: 600px;
      top: 320px;
      font-size: 35px;
      font-weight: bold;
      text-align: center;
      line-height: 60px;
    }

    .noUrutJudul {
      height: 20px;
      border: black 1px solid;
      background-color: #eaeaea;
      color: #21475d;
      position: absolute;
      font-size: 10px;
      font-weight: bold;
      line-height: 20px;
      text-align: center;
    }
  </style>
  <h1>PEMERINTAH KABUPATEN BOGOR</h1>
  <h2>DINAS PENDIDIKAN</h2>
  <h3><?= $sekolah['nama_sekolah']; ?></h3>
  <p class="alamat"><?= $sekolah['alamat']; ?></p>

  <div class="logo-sekolah">
    <img src="<?= base_url('assets/img/logo/') . $sekolah['logo'] ?>">
  </div>
  <div class="logo-dinas">
    <img src="<?= base_url('assets/img/logo/') ?>kabBogor.png">
  </div>
  <hr>
  <h4>Bukti Registrasi PPDB</h4>
  <table>
    <tr>
      <td class="td">No Registrasi</td>
      <td class="td3">:</td>
      <td><?= $siswa['koreg'] ?></td>
      <td class="td2">NISN</td>
      <td>:</td>
      <td><?= $siswa['nisnSiswa'] ?></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td class="td3">:</td>
      <td><?= $siswa['namaSiswa'] ?></td>

    </tr>
    <tr>
      <td>Tanggal Lahir</td>
      <td class="td3">:</td>
      <td><?= $siswa['tanggalLahirSiswa'] ?></td>
      <td class="td2">JK</td>
      <td>:</td>
      <td><?= $siswa['jk'] ?></td>
    </tr>
    <tr>
      <td>NIK</td>
      <td class="td3">:</td>
      <td><?= $siswa['nikSiswa'] ?></td>
    </tr>
    <tr>
      <td>Sekolah Asal</td>
      <td class="td3">:</td>
      <td><?= $siswa['asalSekolah'] ?></td>
    </tr>
    <tr>
      <td>NPSN Sekolah Asal</td>
      <td class="td3">:</td>
      <td><?= $siswa['npsnSekolah'] ?></td>
    </tr>
    <tr>
      <td>Tanggal Daftar</td>
      <td class="td3">:</td>
      <td><?= date('d F Y', strtotime($siswa['tanggalRegister'])) ?></td>
    </tr>
    <tr>
      <td>No Telepon / WA</td>
      <td class="td3">:</td>
      <td><?= $siswa['noHp'] ?></td>
    </tr>
    <tr>
      <td>Jalur PPDB</td>
      <td class="td3">:</td>
      <td></td>
    </tr>
  </table>
  <div class="noUrut">
    <div class="noUrutJudul">NO URUT DAFTAR</div>
    <?= $siswa['noUrut'] ?>
  </div>
  <h6 class="jalur"><?= $siswa['ppdb'] ?></h6>
  <p>Nilai Raport</p>
  <table class="nilaiRaport">
    <tr>
      <td rowspan="2" class="td2">No</td>
      <td rowspan="2" class="td1">Mapel</td>
      <td colspan="2" align="center">Kelas 4</td>
      <td colspan="2" align="center">Kelas 5</td>
      <td colspan="2" align="center">Kelas 6</td>
      <td rowspan="2" align="center">Rata Rata</td>

    </tr>
    <tr>
      <td class="td2">Smtr. 1</td>
      <td class="td2">Smtr. 2</td>
      <td class="td2">Smtr. 1</td>
      <td class="td2">Smtr. 2</td>
      <td class="td2">Smtr. 1</td>
      <td class="td2">Smtr. 2</td>
    </tr>
    <!--isi -->
    <tr>
      <td class="td2">1</td>
      <td>Pend. Agama</td>
      <td class="td2"><?= $siswa['paiK4S1'] ?></td>
      <td class="td2"><?= $siswa['paiK4S2'] ?></td>
      <td class="td2"><?= $siswa['paiK5S1'] ?></td>
      <td class="td2"><?= $siswa['paiK5S2'] ?></td>
      <td class="td2"><?= $siswa['paiK6S1'] ?></td>
      <td class="td2"><?= $siswa['paiK6S2'] ?></td>
      <td class="td2"><?= round(($siswa['paiK4S1'] + $siswa['paiK4S2'] + $siswa['paiK5S1'] + $siswa['paiK5S2'] + $siswa['paiK6S1'] + $siswa['paiK6S2']) / 6, 2) ?></td>
    </tr>
    <tr>
      <td class="td2">2</td>
      <td>P P K N</td>
      <td class="td2"><?= $siswa['pknK4S1'] ?></td>
      <td class="td2"><?= $siswa['pknK4S2'] ?></td>
      <td class="td2"><?= $siswa['pknK5S1'] ?></td>
      <td class="td2"><?= $siswa['pknK5S2'] ?></td>
      <td class="td2"><?= $siswa['pknK6S1'] ?></td>
      <td class="td2"><?= $siswa['pknK6S2'] ?></td>
      <td class="td2"><?= round(($siswa['pknK4S1'] + $siswa['pknK4S2'] + $siswa['pknK5S1'] + $siswa['pknK5S2'] + $siswa['pknK6S1'] + $siswa['pknK6S2']) / 6, 2) ?></td>
    </tr>
    <tr>
      <td class="td2">3</td>
      <td>B. Indonesia</td>
      <td class="td2"><?= $siswa['indoK4S1'] ?></td>
      <td class="td2"><?= $siswa['indoK4S2'] ?></td>
      <td class="td2"><?= $siswa['indoK5S1'] ?></td>
      <td class="td2"><?= $siswa['indoK5S2'] ?></td>
      <td class="td2"><?= $siswa['indoK6S1'] ?></td>
      <td class="td2"><?= $siswa['indoK6S2'] ?></td>
      <td class="td2"><?= round(($siswa['indoK4S1'] + $siswa['indoK4S2'] + $siswa['indoK5S1'] + $siswa['indoK5S2'] + $siswa['indoK6S1'] + $siswa['indoK6S2']) / 6, 2) ?></td>
    </tr>
    <tr>
      <td class="td2">4</td>
      <td>Matematika</td>
      <td class="td2"><?= $siswa['mtkK4S1'] ?></td>
      <td class="td2"><?= $siswa['mtkK4S2'] ?></td>
      <td class="td2"><?= $siswa['mtkK5S1'] ?></td>
      <td class="td2"><?= $siswa['mtkK5S2'] ?></td>
      <td class="td2"><?= $siswa['mtkK6S1'] ?></td>
      <td class="td2"><?= $siswa['mtkK6S2'] ?></td>
      <td class="td2"><?= round(($siswa['mtkK4S1'] + $siswa['mtkK4S2'] + $siswa['mtkK5S1'] + $siswa['mtkK5S2'] + $siswa['mtkK6S1'] + $siswa['mtkK6S2']) / 6, 2) ?></td>
    </tr>
    <tr>
      <td class="td2">5</td>
      <td>I P A</td>
      <td class="td2"><?= $siswa['ipaK4S1'] ?></td>
      <td class="td2"><?= $siswa['ipaK4S2'] ?></td>
      <td class="td2"><?= $siswa['ipaK5S1'] ?></td>
      <td class="td2"><?= $siswa['ipaK5S2'] ?></td>
      <td class="td2"><?= $siswa['ipaK6S1'] ?></td>
      <td class="td2"><?= $siswa['ipaK6S2'] ?></td>
      <td class="td2"><?= round(($siswa['ipaK4S1'] + $siswa['ipaK4S2'] + $siswa['ipaK5S1'] + $siswa['ipaK5S2'] + $siswa['ipaK6S1'] + $siswa['ipaK6S2']) / 6, 2) ?></td>
    </tr>
    <tr>
      <td class="td2">6</td>
      <td>I P S</td>
      <td class="td2"><?= $siswa['ipsK4S1'] ?></td>
      <td class="td2"><?= $siswa['ipsK4S2'] ?></td>
      <td class="td2"><?= $siswa['ipsK5S1'] ?></td>
      <td class="td2"><?= $siswa['ipsK5S2'] ?></td>
      <td class="td2"><?= $siswa['ipsK6S1'] ?></td>
      <td class="td2"><?= $siswa['ipsK6S2'] ?></td>
      <td class="td2"><?= round(($siswa['ipsK4S1'] + $siswa['ipsK4S2'] + $siswa['ipsK5S1'] + $siswa['ipsK5S2'] + $siswa['ipsK6S1'] + $siswa['ipsK6S2']) / 6, 2) ?></td>
    </tr>
    <tr>
      <td class="td2">7</td>
      <td>SBDP</td>
      <td class="td2"><?= $siswa['sbdpK4S1'] ?></td>
      <td class="td2"><?= $siswa['sbdpK4S2'] ?></td>
      <td class="td2"><?= $siswa['sbdpK5S1'] ?></td>
      <td class="td2"><?= $siswa['sbdpK5S2'] ?></td>
      <td class="td2"><?= $siswa['sbdpK6S1'] ?></td>
      <td class="td2"><?= $siswa['sbdpK6S2'] ?></td>
      <td class="td2"><?= round(($siswa['sbdpK4S1'] + $siswa['sbdpK4S2'] + $siswa['sbdpK5S1'] + $siswa['sbdpK5S2'] + $siswa['sbdpK6S1'] + $siswa['sbdpK6S2']) / 6, 2) ?></td>
    </tr>
    <tr>
      <td class="td2">8</td>
      <td>PJOK</td>
      <td class="td2"><?= $siswa['pjokK4S1'] ?></td>
      <td class="td2"><?= $siswa['pjokK4S2'] ?></td>
      <td class="td2"><?= $siswa['pjokK5S1'] ?></td>
      <td class="td2"><?= $siswa['pjokK5S2'] ?></td>
      <td class="td2"><?= $siswa['pjokK6S1'] ?></td>
      <td class="td2"><?= $siswa['pjokK6S2'] ?></td>
      <td class="td2"><?= round(($siswa['pjokK4S1'] + $siswa['pjokK4S2'] + $siswa['pjokK5S1'] + $siswa['pjokK5S2'] + $siswa['pjokK6S1'] + $siswa['pjokK6S2']) / 6, 2) ?></td>
    </tr>
    <tr>
      <td class="td2">9</td>
      <td>B. Sunda</td>
      <td class="td2"><?= $siswa['sundaK4S1'] ?></td>
      <td class="td2"><?= $siswa['sundaK4S2'] ?></td>
      <td class="td2"><?= $siswa['sundaK5S1'] ?></td>
      <td class="td2"><?= $siswa['sundaK5S2'] ?></td>
      <td class="td2"><?= $siswa['sundaK6S1'] ?></td>
      <td class="td2"><?= $siswa['sundaK6S2'] ?></td>
      <td class="td2"><?= round(($siswa['sundaK4S1'] + $siswa['sundaK4S2'] + $siswa['sundaK5S1'] + $siswa['sundaK5S2'] + $siswa['sundaK6S1'] + $siswa['sundaK6S2']) / 6, 2) ?></td>
    </tr>
  </table>
  <table class="nilaiRaport2">
    <tr>
      <td class="td4">Titik Kordinat</td>
      <td class="td6">:</td>
      <td class="td5"><?= $siswa['longitude'] ?></td>
    </tr>
    <tr>
      <td class="td4">Skor Jarak</td>
      <td class="td6">:</td>
      <td class="td5"><?= $siswa['totalJarak'] . ' meter' ?></td>
    </tr>
    <tr>
      <td class="td4">Jumlah Nilai</td>
      <td class="td6">:</td>
      <td class="td5"><?= $siswa['totalNilai'] ?></td>
    </tr>
    <tr>
      <td class="td4">Rata Rata Nilai</td>
      <td class="td6">:</td>
      <td class="td5"><?= $siswa['rataRataTotalNilai'] ?></td>
    </tr>
    <tr>
      <td class="td">Jumlah Rata Rata</td>
      <td class="td6">:</td>
      <td class="td5"><?= round($siswa['jumlahRataRata'], 2) ?></td>
    </tr>
  </table>
  <?php if ($siswa['idPrestasi']) : ?>
    <p>Nilai Lomba Prestasi Akademik / Nonakademik</p>
    <p><?= $prestasi['peyelengara'] ?></p>
    <table class="nilaiRaport2">
      <tr>
        <td class="td">Kategori</td>
        <td class="td6">:</td>
        <td class="td5"><?= $prestasi['satuan'] ?></td>
      </tr>
      <tr>
        <td class="td">Prestasi</td>
        <td class="td6">:</td>
        <td class="td5"><?= $prestasi['kejuaraan'] ?></td>
      </tr>
      <tr>
        <td class="td">Score</td>
        <td class="td6">:</td>
        <td class="td5"><?= $prestasi['score'] ?></td>
      </tr>
      <tr>
        <td class="td">Kejuaraan</td>
        <td class="td6">:</td>
        <td class="td5"><?= $siswa['cabangPrestasi'] ?></td>
      </tr>
    </table>
    <br>
  <?php endif ?>
  <p style="color:red">Nilai diatas belum dinyatakan final selama belum melakukan verifikasi</p>
  <br>
  <p class="sarat">Persyaratan Khusus</p>
  <p class="namaSekolah">Akan di periksa panitia <?= $setting['nama_sekolah'] ?> </p>
  <table>
    <tr>
      <td>No</td>
      <td>Persyaratan</td>
      <td>Check</td>
    </tr>
    <?php $no = 1;
    foreach ($sarat as $s) : ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $s['persyaratan']; ?></td>
        <td>[ ]</td>
      </tr>
    <?php endforeach ?>
  </table>
  <div class="ttd">
    <div class="ttd-kiri">
    </div>
    <div class="ttd-kanan">
      <p><?= $sekolah['kecamatan'] . ', ' . date('d-F-Y') ?></p>
      <p>Panitia</p>
      <p class="namaKepsek">.....................</p>
      <p class="nip"></p>
    </div>
  </div>
  <div style="clear: both;"></div>
  <p>Simpan bukti pendaftaran ini akan di perlukan saat verifikasi berkas asli </p>
</body>

</html>