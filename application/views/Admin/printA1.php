<!DOCTYPE html>
<html lang="en">

<head>
  <title>Laporan Form 1</title>

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
      width: 60%;

      font-size: 1em;

    }


    h3 {
      font-size: 15px;
      line-height: 1.6px;
      text-align: left;
    }

    .alamat {
      font-size: 12px;
      line-height: 1.4px;
      text-align: left
    }



    h4 {
      text-align: center;

      font-size: 15pt;
      letter-spacing: 2px;
      line-height: -1px;
      margin-bottom: 20px;



    }

    h2 {
      text-align: center;
    }

    h6 {
      text-align: right;
    }



    .ttd {

      margin-top: 40px;
      width: 100%;
      height: 30px;

      /* justify-content: space-around; */
    }

    .ttd-kiri {
      float: left;
      width: 50%;
      height: 100px;


    }

    .ttd-kanan {
      width: 30%;
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



    .lulus {
      width: 300px;
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
      margin-bottom: 3px;
    }



    .noSurat {
      font-size: 14px;
      font-weight: 200;
      font-style: normal;
      line-height: -3px;
      text-decoration: none;
    }

    .table {
      margin-top: 20px;
      width: 100%;
      border-collapse: collapse;


    }

    .table tr td {
      border: 1px solid black;
      padding: 1px;
    }

    table.table tr td {
      height: 35px;

    }

    .td1 {
      width: 2%;
      text-align: center;

    }

    .td2 {
      width: 250px;
      text-align: center;
      height: 20px;
      padding: 10px;
    }

    .td3 {
      width: 10px;
    }

    table.table tr td {
      padding: 10px;
    }
  </style>

  <body>

    <table class="table">
      <thead>
        <tr class="tr1">
          <td rowspan="2" class="td2">Jalur Pendaftaran</td>
          <td colspan="3" class="td2">Jumlah Pendaftar</td>
          <td colspan="3" class="td2">Jumlah Diterima</td>
          <td colspan="3" class="td2">Jumlah Tidak Diterima</td>
          <td colspan="3" class="td2">Jumlah Tidak Verifikasi</td>
          <td colspan="3" class="td2">Jumlah Dicabut/Pindah</td>
      </thead>
      </tr>
      <tr>
        <!-- no -->
        <!-- <td>Jalur Pendaftaran</td> -->

        <!-- jumlah pendaftar -->
        <td class="td1">L</td>
        <td class="td1">p</td>
        <td class="td1">jml</td>

        <!-- jumalah ditemima -->
        <td class="td1">L</td>
        <td class="td1">p</td>
        <td class="td1">jml</td>

        <!-- jumalah tidak ditemima -->
        <td class="td1">L</td>
        <td class="td1">p</td>
        <td class="td1">jml</td>

        <!-- jumalah tidak verifikasi -->
        <td class="td1">L</td>
        <td class="td1">p</td>
        <td class="td1">jml</td>

        <!-- jumalah di cabut/ Pindah -->
        <td class="td1">L</td>
        <td class="td1">p</td>
        <td class="td1">jml</td>
      </tr>

      <!-- baris zonasi -->
      <tr>
        <!-- no -->
        <td class="td4">JALUR ZONASI</td>
        <!-- jumlah pendaftar -->
        <td class="td1"><?= $jumlahPendaftarL ?></td>
        <td class="td1"><?= $jumlahPendaftarP ?></td>
        <td class="td1"><?= $jumlahPendaftarL + $jumlahPendaftarP ?></td>

        <!-- jumalah ditemima -->
        <td class="td1"><?= $jumlahPendaftarLDiterima ?></td>
        <td class="td1"><?= $jumlahPendaftarPDiterima ?></td>
        <td class="td1"><?= $jumlahPendaftarLDiterima + $jumlahPendaftarPDiterima ?></td>

        <!-- jumalah tidak ditemima -->
        <td class="td1"><?= $jumlahPendaftarLTidakDiterima ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakDiterima ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakDiterima + $jumlahPendaftarPTidakDiterima ?></td>

        <!-- jumalah tidak verifikasi -->
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasi ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakVerifikasi ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasi + $jumlahPendaftarPTidakVerifikasi ?></td>


        <!-- jumalah di cabut/ Pindah -->
        <td class="td1"><?= $jumlahPendaftarLPindah ?></td>
        <td class="td1"><?= $jumlahPendaftarPPindah ?></td>
        <td class="td1"><?= $jumlahPendaftarLPindah + $jumlahPendaftarPPindah ?></td>
      </tr>

      <!-- AFIRMASI -->
      <tr>
        <!-- no -->
        <td class="td4">JALUR AFIRMASI</td>
        <!-- jumlah pendaftar -->
        <td class="td1"><?= $jumlahPendaftarLAfirmasi ?></td>
        <td class="td1"><?= $jumlahPendaftarPAfirmasi ?></td>
        <td class="td1"><?= $jumlahPendaftarLAfirmasi + $jumlahPendaftarPAfirmasi ?></td>

        <!-- jumalah ditemima -->
        <td class="td1"><?= $jumlahPendaftarLDiterimaAfirmasi ?></td>
        <td class="td1"><?= $jumlahPendaftarPDiterimaAfirmasi ?></td>
        <td class="td1"><?= $jumlahPendaftarLDiterimaAfirmasi + $jumlahPendaftarPDiterimaAfirmasi ?></td>

        <!-- jumalah tidak ditemima -->
        <td class="td1"><?= $jumlahPendaftarLTidakDiterimaAfirmasi ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakDiterimaAfirmasi ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakDiterimaAfirmasi + $jumlahPendaftarPTidakDiterimaAfirmasi ?></td>

        <!-- jumalah tidak verifikasi -->
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasiAfirmasi ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakVerifikasiAfirmasi ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasiAfirmasi + $jumlahPendaftarPTidakVerifikasiAfirmasi ?></td>


        <!-- jumalah di cabut/ Pindah -->
        <td class="td1"><?= $jumlahPendaftarLPindahAfirmasi ?></td>
        <td class="td1"><?= $jumlahPendaftarPPindahAfirmasi ?></td>
        <td class="td1"><?= $jumlahPendaftarLPindahAfirmasi + $jumlahPendaftarPPindahAfirmasi ?></td>
      </tr>

      <!-- PERPINDAHAN TUGAS ORANG TUA / WALI -->
      <tr>
        <!-- no -->
        <td class="td4">JALUR PERPINDAHAN TUGAS ORANG TUA / WALI</td>
        <!-- jumlah pendaftar -->
        <td class="td1"><?= $jumlahPendaftarLOrangTua ?></td>
        <td class="td1"><?= $jumlahPendaftarPOrangTua ?></td>
        <td class="td1"><?= $jumlahPendaftarLOrangTua + $jumlahPendaftarPOrangTua ?></td>

        <!-- jumalah ditemima -->
        <td class="td1"><?= $jumlahPendaftarLDiterimaOrangTua ?></td>
        <td class="td1"><?= $jumlahPendaftarPDiterimaOrangTua ?></td>
        <td class="td1"><?= $jumlahPendaftarLDiterimaOrangTua + $jumlahPendaftarPDiterimaOrangTua ?></td>

        <!-- jumalah tidak ditemima -->
        <td class="td1"><?= $jumlahPendaftarLTidakDiterimaOrangTua ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakDiterimaOrangTua ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakDiterimaOrangTua + $jumlahPendaftarPTidakDiterimaOrangTua ?></td>

        <!-- jumalah tidak verifikasi -->
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasiOrangTua ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakVerifikasiOrangTua ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasiOrangTua + $jumlahPendaftarPTidakVerifikasiOrangTua ?></td>


        <!-- jumalah di cabut/ Pindah -->
        <td class="td1"><?= $jumlahPendaftarLPindahOrangTua ?></td>
        <td class="td1"><?= $jumlahPendaftarPPindahOrangTua ?></td>
        <td class="td1"><?= $jumlahPendaftarLPindahOrangTua + $jumlahPendaftarPPindahOrangTua ?></td>
      </tr>


      <!-- PRESTASI LOMBA AKADEMIK DAN NONAKADEMIK -->
      <tr>
        <!-- no -->
        <td class="td4">JALUR PRESTASI LOMBA AKADEMIK DAN NON AKADEMIK</td>
        <!-- jumlah pendaftar -->
        <td class="td1"><?= $jumlahPendaftarLLomba ?></td>
        <td class="td1"><?= $jumlahPendaftarPLomba ?></td>
        <td class="td1"><?= $jumlahPendaftarLLomba + $jumlahPendaftarPLomba ?></td>

        <!-- jumalah ditemima -->
        <td class="td1"><?= $jumlahPendaftarLDiterimaLomba ?></td>
        <td class="td1"><?= $jumlahPendaftarPDiterimaLomba ?></td>
        <td class="td1"><?= $jumlahPendaftarLDiterimaLomba + $jumlahPendaftarPDiterimaLomba ?></td>

        <!-- jumalah tidak ditemima -->
        <td class="td1"><?= $jumlahPendaftarLTidakDiterimaLomba ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakDiterimaLomba ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakDiterimaLomba + $jumlahPendaftarPTidakDiterimaLomba ?></td>

        <!-- jumalah tidak verifikasi -->
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasiLomba ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakVerifikasiLomba ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasiLomba + $jumlahPendaftarPTidakVerifikasiLomba ?></td>


        <!-- jumalah di cabut/ Pindah -->
        <td class="td1"><?= $jumlahPendaftarLPindahLomba ?></td>
        <td class="td1"><?= $jumlahPendaftarPPindahLomba ?></td>
        <td class="td1"><?= $jumlahPendaftarLPindahLomba + $jumlahPendaftarPPindahLomba ?></td>
      </tr>


      <!--JALUR PENDUDUK PERBATASAN KABUPATEN -->
      <tr>
        <!-- no -->
        <td class="td4">JALUR PENDUDUK PERBATASAN KABUPATEN</td>
        <!-- jumlah pendaftar -->
        <td class="td1"><?= $jumlahPendaftarLPerbatasan ?></td>
        <td class="td1"><?= $jumlahPendaftarPPerbatasan ?></td>
        <td class="td1"><?= $jumlahPendaftarLPerbatasan + $jumlahPendaftarPPerbatasan ?></td>

        <!-- jumalah ditemima -->
        <td class="td1"><?= $jumlahPendaftarLDiterimaPerbatasan ?></td>
        <td class="td1"><?= $jumlahPendaftarPDiterimaPerbatasan ?></td>
        <td class="td1"><?= $jumlahPendaftarLDiterimaPerbatasan + $jumlahPendaftarPDiterimaPerbatasan ?></td>

        <!-- jumalah tidak ditemima -->
        <td class="td1"><?= $jumlahPendaftarLTidakDiterimaPerbatasan ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakDiterimaPerbatasan ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakDiterimaPerbatasan + $jumlahPendaftarPTidakDiterimaPerbatasan ?></td>

        <!-- jumalah tidak verifikasi -->
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasiPerbatasan ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakVerifikasiPerbatasan ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasiPerbatasan + $jumlahPendaftarPTidakVerifikasiPerbatasan ?></td>


        <!-- jumalah di cabut/ Pindah -->
        <td class="td1"><?= $jumlahPendaftarLPindahPerbatasan ?></td>
        <td class="td1"><?= $jumlahPendaftarPPindahPerbatasan ?></td>
        <td class="td1"><?= $jumlahPendaftarLPindahPerbatasan + $jumlahPendaftarPPindahPerbatasan ?></td>
      </tr>


      <!--JALUR PRESTASI RERATA NILAI RAPORT-->
      <tr>
        <!-- no -->
        <td class="td4">JALUR PRESTASI RERATA NILAI RAPORT</td>
        <!-- jumlah pendaftar -->
        <td class="td1"><?= $jumlahPendaftarLRaport ?></td>
        <td class="td1"><?= $jumlahPendaftarPRaport ?></td>
        <td class="td1"><?= $jumlahPendaftarLRaport + $jumlahPendaftarPRaport ?></td>

        <!-- jumalah ditemima -->
        <td class="td1"><?= $jumlahPendaftarLDiterimaRaport ?></td>
        <td class="td1"><?= $jumlahPendaftarPDiterimaRaport ?></td>
        <td class="td1"><?= $jumlahPendaftarLDiterimaRaport + $jumlahPendaftarPDiterimaRaport ?></td>

        <!-- jumalah tidak ditemima -->
        <td class="td1"><?= $jumlahPendaftarLTidakDiterimaRaport ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakDiterimaRaport ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakDiterimaRaport + $jumlahPendaftarPTidakDiterimaRaport ?></td>

        <!-- jumalah tidak verifikasi -->
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasiRaport ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakVerifikasiRaport ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasiRaport + $jumlahPendaftarPTidakVerifikasiRaport ?></td>


        <!-- jumalah di cabut/ Pindah -->
        <td class="td1"><?= $jumlahPendaftarLPindahRaport ?></td>
        <td class="td1"><?= $jumlahPendaftarPPindahRaport ?></td>
        <td class="td1"><?= $jumlahPendaftarLPindahRaport + $jumlahPendaftarPPindahRaport ?></td>
      </tr>


      <!-- jumlah total -->
      <tr>
        <!-- no -->
        <td class="td4" align="center">Jumlah</td>
        <!-- jumlah pendaftar -->
        <td class="td1"><?= $jumlahPendaftarLTotal ?></td>
        <td class="td1"><?= $jumlahPendaftarPTotal ?></td>
        <td class="td1"><?= $jumlahPendaftarLTotal + $jumlahPendaftarPTotal ?></td>

        <!-- jumalah ditemima -->
        <td class="td1"><?= $jumlahPendaftarLDiterimaTotal ?></td>
        <td class="td1"><?= $jumlahPendaftarPDiterimaTotal ?></td>
        <td class="td1"><?= $jumlahPendaftarLDiterimaTotal + $jumlahPendaftarPDiterimaTotal ?></td>

        <!-- jumalah tidak ditemima -->
        <td class="td1"><?= $jumlahPendaftarLTidakDiterimaTotal ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakDiterimaTotal ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakDiterimaTotal + $jumlahPendaftarPTidakDiterimaTotal ?></td>

        <!-- jumalah tidak verifikasi -->
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasiTotal ?></td>
        <td class="td1"><?= $jumlahPendaftarPTidakVerifikasiTotal ?></td>
        <td class="td1"><?= $jumlahPendaftarLTidakVerifikasiTotal + $jumlahPendaftarPTidakVerifikasiTotal ?></td>


        <!-- jumalah di cabut/ Pindah -->
        <td class="td1"><?= $jumlahPendaftarLPindahTotal ?></td>
        <td class="td1"><?= $jumlahPendaftarPPindahTotal ?></td>
        <td class="td1"><?= $jumlahPendaftarLPindahTotal + $jumlahPendaftarPPindahTotal ?></td>
      </tr>
    </table>
    <div class="ttd">
      <div class="ttd-kiri">
      </div>
      <div class="ttd-kanan">
        <p><?= $sekolah['kecamatan'] . ', ' . $tanggal ?></p>
        <p>Kepala Sekolah</p>
        <p class="namaKepsek"><?= $sekolah['nama_kepala'] ?></p>
        <p class="nip">NIP <?= $sekolah['nip_kepsek'] ?></p>
      </div>
    </div>
    <div style="clear: both;"></div>

    <br>
    <br>
    <br>


  </body>

</html>