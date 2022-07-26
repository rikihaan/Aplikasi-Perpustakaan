<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    h4 {
      font-style: unset;
      text-decoration: none;
    }

    h5 {
      text-align: center;
      line-height: 1px;
      font-size: 20px;
    }


    table {
      width: 100%;
    }

    table .td1,
    .td3 {
      height: 40px;
    }

    .td3 {
      width: 5%;
    }

    .td1 {
      width: 40%;
      text-align: left;
    }

    ul {
      margin: 10px 0;
      padding: 0 0 0 20px;

    }

    ul li {
      /* line-height: 40px; */
      list-style: none;
      margin-bottom: 2px;
    }

    p {
      line-height: 20px;
    }

    .namaKepsek {
      margin-top: 50px;
    }
  </style>
</head>

<body>
  <h4>SURAT PERNYATAAN</h4>
  <h5>TANGGUNG JAWAB MUTLAK ORANG TUA/WALI</h5>
  <br> <br><br> <br>
  <p class="yth">Yang bertandatangan di bawah ini : </p>
  <table>
    <tr>
      <td class="td3">a.</td>
      <td class="td1">Nama Lengkap</td>
      <td class="td3">:</td>
      <td>...........................</td>
    </tr>
    <tr>
      <td class="td3">b.</td>
      <td>Nama Calon Peserta Didik</td>
      <td class="td3">:</td>
      <td><?= $siswa['namaSiswa'] ?></td>
    </tr>
    <tr>
      <td class="td3">c.</td>
      <td>Alamat Rumah</td>
      <td class="td3">:</td>
      <td><?= $siswa['alamat'] . ' Rt ' . $siswa['rt'] . ' / ' . $siswa['rw'] . ' Desa ' . $siswa['desa'] .  ' Kec. ' . $siswa['kec'] . ' Kota/Kab ' . $siswa['kot'] . ' - ' . $siswa['prov'] ?></td>
    </tr>
    <tr>
      <td class="td3">d.</td>
      <td>Nomor Kartu Keluarga</td>
      <td class="td3">:</td>
      <td><?= $siswa['noKK'] ?></td>
    </tr>
    <tr>
      <td class="td3">e.</td>
      <td>Nomor Hp / Email</td>
      <td class="td3">:</td>
      <td><?= $siswa['noHp'] ?></td>
    </tr>

  </table>
  <br><br>
  <h5>MENYATAKAN</h5>

  <p style="text-align:justify; text-indent: -18px">1. Bahwa seluruh data/informasi yang diberikan dalam dokumen-dokumen pernyataan PPDB tahun pelajaran 2020/2021 ini adalah benar dan dapat dipertanggung jawabkan.</p>
  <p style="text-align:justify; text-indent: -18px">2. Bahwa saya melakukan pendaftaran PPDB ke <?= $sekolah['nama_sekolah'] ?>, serta tidak akan mendaftarkan putra/putri kami ke sekolah negeri yang lain secara bersamaan. </p>
  <p style="text-align:justify; text-indent: -18px">3. Bahwa saya tidak akan melakukan tindakan memaksakan kehendak , suap-menyuap dan/atau perbuatan yang melawan hukum dalam pelaksanaan PPDB tahun pelajaran 2020/2021 ini; </p>
  <p style="text-align:justify; text-indent: -18px">4. Apabila dikemudian hari ternyata apa yang saya nyatakan tersebut tidak benar, maka saya bersedia dikenakan sanksi/hukuman berupa pembatalan penerimaan peserta didik baru atau sanksi lain sesuai ketentuan peraturan perundang-undangan; </p>


  <p class=" demikian">Demikian surat pernyataan ini saya buat dalam keadaan sadar, tanpa paksaan, dan dibuat dengan sebenarnya.</p>

  <div class="ttd">
    <div class="ttd-kiri">
    </div>
    <div class="ttd-kanan">
      <p><?= $siswa['kec'] . ', ..........................' ?></p>
      <p>Yang membuat pernyataan,</p>
      <p class="namaKepsek">Meterai 6000</p>
      <p class="nip"></p>
      <p class="namaKepsek">.................................</p>
      <p class="nip">.................................</p>
    </div>
  </div>
</body>

</html>