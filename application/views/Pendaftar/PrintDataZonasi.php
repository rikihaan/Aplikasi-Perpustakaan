<!DOCTYPE html>
<html lang="en">

<head>
  <title>ZONASI</title>
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

    .td,
    .th {
      border: 1px solid black;
      padding: 12px;
      font-size: .8em;
    }

    .table .th {
      text-align: center;
      background-color: #eaeaea;
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

    .namaKepsek {
      margin-top: 80px;
    }
  </style>
</head>

<body>

  <table class="table">
    <tr>
      <th class="th">#</th>
      <th class="th">ID REG</th>
      <th class="th">NAMA</th>
      <th class="th">ASAL SEKOLAH</th>
      <th class="th">SCOR JARAK</th>
      <th class="th">USIA</th>
      <th class="th">JLH RATA RATA NILAI</th>
      <th class="th">KET</th>
    </tr>
    <?php $no = 1;
    foreach ($pendaftar as $daftar) : ?>
      <tr>
        <td align="center" class="td"><?= $no++ ?></td>
        <td align="center" class="td"><?= $daftar['koreg'] ?></td>
        <td class="td"><?= $daftar['namaSiswa'] ?></td>
        <td class="td"><?= $daftar['asalSekolah'] ?></td>
        <td class="td"><?= $daftar['totalJarak'] . ' meter' ?></td>
        <td class="td"><?= $daftar['usiaSiswa'] . ' tahun' ?></td>
        <td class="td"><?= $daftar['jumlahRataRata'] ?></td>
        <td class="td">
          <?php
          if ($daftar['statusPendaftaran'] == 1) {
            echo "Blm. Verifikasi";
          } elseif ($daftar['statusPendaftaran'] == 3) {
            echo "Pindah";
          } elseif ($daftar['lulus'] == 4) {
            echo "Diterima";
          } elseif ($daftar['lulus'] == 5) {
            echo "Tdk. Diterima";
          } else {
            echo "Terverifikasi";
          }
          ?>
        </td>
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
      <p><?= $sekolah['kecamatan'] . ', ' . date('d-F-Y') ?></p>
      <p>Kepala Sekolah</p>
      <p class="namaKepsek"><?= $sekolah['nama_kepala'] ?></p>
      <p class="nip">NIP <?= $sekolah['nip_kepsek'] ?></p>
    </div>
  </div>
  <div style="clear: both;"></div>
</body>

</html>