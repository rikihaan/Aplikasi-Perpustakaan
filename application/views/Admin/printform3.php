<!DOCTYPE html>
<html lang="en">

<head>
  <title>FORM 3</title>
  <style>
    h6 {
      text-align: right;
      font-family: 'lora'
    }

    .table {
      border-collapse: collapse;
      table-layout: auto;
      width: 100%;
    }

    h2 {
      text-align: center;
      font-size: 20px;
      line-height: 1px;
    }

    h4 {
      text-align: center;
      line-height: 1px;

    }



    .table,
    .td {
      border: 1px solid black;
      padding: 12px;
      font-size: .8em;
    }

    .table,
    .th {
      border: 1px solid black;
      padding: 10px;
      font-size: .8em;
    }

    .table .th {
      text-align: center;
      background-color: #eaeaea;
    }

    .td1 {
      border: 1px solid black;
      width: 40%;
      padding: 12px;
      font-size: .9em;
    }

    .td2 {
      border: 1px solid black;
      width: 10%;
      padding: 12px;
      font-size: .9em;
    }

    .td3 {
      border: 1px solid black;
      width: 10%;
      padding: 12px;
      font-size: .9em;
    }

    .td {
      width: 30%;
    }

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

      float: right;
    }

    .ttd-kanan p {
      line-height: 1px;
    }

    .ttd-kiri p {
      line-height: 1px;
    }

    .namaKepsek {
      margin-top: 80px;
    }
  </style>
</head>

<body>

  <table class="table">
    <tr>
      <th class="th" colspan="2">NOMOR</th>
      <th class="th" rowspan="2">NAMA PENDAFTAR</th>
      <th class="th" rowspan="2">ASAL SEKOLAH</th>
      <th class="th" rowspan="2">JALUR PPDB</th>
    </tr>
    <tr>
      <th class="th">URUT</th>
      <th class="th">DAFTAR</th>
    </tr>
    <?php $no = 1;
    foreach ($pendaftar as $daftar) : ?>
      <tr>
        <td align="center" class="td2"><?= $no++ ?></td>
        <td align="center" class="td3"><?= $daftar['koreg'] ?></td>
        <td class="td1"><?= $daftar['namaSiswa'] ?></td>
        <td class="td"><?= $daftar['asalSekolah'] ?></td>
        <td class="td"><?= $daftar['ppdb'] ?></td>
      </tr>
    <?php endforeach ?>
  </table>
  <br>
  <br>
  <br>
  <br>
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
</body>

</html>