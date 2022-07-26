<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_model extends CI_Model
{


  function hitungJarak($lokasi1_lat, $lokasi1_long, $lokasi2_lat, $lokasi2_long, $unit = 'km', $desimal = 2)
  {
    // Menghitung jarak dalam derajat
    $derajat = rad2deg(acos((sin(deg2rad($lokasi1_lat)) * sin(deg2rad($lokasi2_lat))) + (cos(deg2rad($lokasi1_lat)) * cos(deg2rad($lokasi2_lat)) * cos(deg2rad($lokasi1_long - $lokasi2_long)))));

    // Mengkonversi derajat kedalam unit yang dipilih (kilometer, mil atau mil laut)
    switch ($unit) {
      case 'km':
        $jarak = $derajat * 111.13384; // 1 derajat = 111.13384 km, berdasarkan diameter rata-rata bumi (12,735 km)
        break;
      case 'mi':
        $jarak = $derajat * 69.05482; // 1 derajat = 69.05482 miles(mil), berdasarkan diameter rata-rata bumi (7,913.1 miles)
        break;
      case 'nmi':
        $jarak =  $derajat * 59.97662; // 1 derajat = 59.97662 nautic miles(mil laut), berdasarkan diameter rata-rata bumi (6,876.3 nautical miles)
    }
    return round($jarak, $desimal);
  }

  public function simpanDaftar($form)
  {

    $data['sekolah'] = $this->db->get('kop_surat')->row_array();
    $latlogSekolah = explode(',', $data['sekolah']['longitude']);
    $latlogDaftar = explode(',', $form['longitude']);

    if (empty($latlogDaftar[1])) {
      $longDaftar = $latlogDaftar[0];
    } else {
      $longDaftar = $latlogDaftar[1];
    }

    $latDaftar = $latlogDaftar[0];
    // $longDaftar = $latlogDaftar[1];
    $latSekolah = $latlogSekolah[0];
    $longSekolah = $latlogSekolah[1];
    $koreg = [
      'koreg' => $this->koreg()
    ];
    $jmlRataRatapai = round(($form['paiK4S1'] + $form['paiK4S2'] + $form['paiK5S1'] + $form['paiK5S2'] + $form['paiK6S1'] + $form['paiK6S2']) / 6, 2);
    $jmlRataRatapkn = round(($form['pknK4S1'] + $form['pknK4S2'] + $form['pknK5S1'] + $form['pknK5S2'] + $form['pknK6S1'] + $form['pknK6S2']) / 6, 2);
    $jmlRataRataIndo = round(($form['indoK4S1'] + $form['indoK4S2'] + $form['indoK5S1'] + $form['indoK5S2'] + $form['indoK6S1'] + $form['indoK6S2']) / 6, 2);
    $jmlRataRataMtk = round(($form['mtkK4S1'] + $form['mtkK4S2'] + $form['mtkK5S1'] + $form['mtkK5S2'] + $form['mtkK6S1'] + $form['mtkK6S2']) / 6, 2);
    $jmlRataRataIpa = round(($form['ipaK4S1'] + $form['ipaK4S2'] + $form['ipaK5S1'] + $form['ipaK5S2'] + $form['ipaK6S1'] + $form['ipaK6S2']) / 6, 2);
    $jmlRataRataips = round(($form['ipsK4S1'] + $form['ipsK4S2'] + $form['ipsK5S1'] + $form['ipsK5S2'] + $form['ipsK6S1'] + $form['ipsK6S2']) / 6, 2);
    $jmlRataRatasbdp = round(($form['sbdpK4S1'] + $form['sbdpK4S2'] + $form['sbdpK5S1'] + $form['sbdpK5S2'] + $form['sbdpK6S1'] + $form['sbdpK6S2']) / 6, 2);
    $jmlRataRatapjok = round(($form['pjokK4S1'] + $form['pjokK4S2'] + $form['pjokK5S1'] + $form['pjokK5S2'] + $form['pjokK6S1'] + $form['pjokK6S2']) / 6, 2);
    $jmlRataRatasunda = round(($form['sundaK4S1'] + $form['sundaK4S2'] + $form['sundaK5S1'] + $form['sundaK5S2'] + $form['sundaK6S1'] + $form['sundaK6S2']) / 6, 2);
    $totalRataRataNilai = $jmlRataRatapai + $jmlRataRatapkn + $jmlRataRataIndo + $jmlRataRataIpa + $jmlRataRataMtk + $jmlRataRataips + $jmlRataRatasbdp + $jmlRataRatapjok + $jmlRataRatasunda;
    $this->session->set_userdata($koreg);
    $data = [
      'koreg' => $koreg['koreg'],
      'id_jalur' => $form['jalurPpdb'],
      'asalSekolah' => $form['sekolahAsal'],
      'npsnSekolah' => $form['npsn'],
      'namaSiswa' => $form['namaSiswa'],
      'nikSiswa' => $form['nikSiswa'],
      'noHp' => $form['noHp'],
      'noKK' => $form['noKK'],
      'jk' => $form['jk'],
      'nisnSiswa' => $form['nisnSiswa'],
      'usiaSiswa' => $this->hitungUsia($form['tglLahirSiswa']),
      'tanggalLahirSiswa' => $form['tglLahirSiswa'],
      'tempatLahirSiswa' => $form['tempatLahir'],
      'tinggiBadan' => $form['tinggiBadan'],
      'beratBadan' => $form['beratBadan'],
      'agama' => $form['agama'],
      'alamat' => $form['alamat'],
      'rt' => $form['rt'],
      'rw' => $form['rw'],
      'desa' => $form['desa'],
      'kecamatan' => $form['kecamatan'],
      'kabKota' => $form['kabKota'],
      'kodePos' => $form['kodePos'],
      'longitude' => $form['longitude'],
      'namaAyah' => $form['namaAyah'],
      'nikAyah' => $form['nikAyah'],
      'tahunLahirAyah' => $form['tahunLahirAyah'],
      'pendidikanAyah' => $form['pendidikanAyah'],
      'pekerjaanAyah' => $form['pekerjaanAyah'],
      'penghasilanAyah' => $form['penghasilanAyah'],
      'namaIbu' => $form['namaibu'],
      'nikIbu' => $form['nikIbu'],
      'tahunLahirIbu' => $form['tahunLahirIbu'],
      'pendidikanIbu' => $form['pendidikanIbu'],
      'pekerjaanIbu' => $form['pekerjaanIbu'],
      'penghasilanIbu' => $form['penghasilanIbu'],
      'paiK4S1' => $form['paiK4S1'],
      'paiK4S2' => $form['paiK4S2'],
      'paiK5S1' => $form['paiK5S1'],
      'paiK5S2' => $form['paiK5S2'],
      'paiK6S1' => $form['paiK6S1'],
      'paiK6S2' => $form['paiK6S2'],
      'pknK4S1' => $form['pknK4S1'],
      'pknK4S2' => $form['pknK4S2'],
      'pknK5S1' => $form['pknK5S1'],
      'pknK5S2' => $form['pknK5S2'],
      'pknK6S1' => $form['pknK6S1'],
      'pknK6S2' => $form['pknK6S2'],
      'indoK4S1' => $form['indoK4S1'],
      'indoK4S2' => $form['indoK4S2'],
      'indoK5S1' => $form['indoK5S1'],
      'indoK5S2' => $form['indoK5S2'],
      'indoK6S1' => $form['indoK6S1'],
      'indoK6S2' => $form['indoK6S2'],
      'mtkK4S1' => $form['mtkK4S1'],
      'mtkK4S2' => $form['mtkK4S2'],
      'mtkK5S1' => $form['mtkK5S1'],
      'mtkK5S2' => $form['mtkK5S2'],
      'mtkK6S1' => $form['mtkK6S1'],
      'mtkK6S2' => $form['mtkK6S2'],
      'ipaK4S1' => $form['ipaK4S1'],
      'ipaK4S2' => $form['ipaK4S2'],
      'ipaK5S1' => $form['ipaK5S1'],
      'ipaK5S2' => $form['ipaK5S2'],
      'ipaK6S1' => $form['ipaK6S1'],
      'ipaK6S2' => $form['ipaK6S2'],
      'ipsK4S1' => $form['ipsK4S1'],
      'ipsK4S2' => $form['ipsK4S2'],
      'ipsK5S1' => $form['ipsK5S1'],
      'ipsK5S2' => $form['ipsK5S2'],
      'ipsK6S1' => $form['ipsK6S1'],
      'ipsK6S2' => $form['ipsK6S2'],
      'sbdpK4S1' => $form['sbdpK4S1'],
      'sbdpK4S2' => $form['sbdpK4S2'],
      'sbdpK5S1' => $form['sbdpK5S1'],
      'sbdpK5S2' => $form['sbdpK5S2'],
      'sbdpK6S1' => $form['sbdpK6S1'],
      'sbdpK6S2' => $form['sbdpK6S2'],
      'pjokK4S1' => $form['pjokK4S1'],
      'pjokK4S2' => $form['pjokK4S2'],
      'pjokK5S1' => $form['pjokK5S1'],
      'pjokK5S2' => $form['pjokK5S2'],
      'pjokK6S1' => $form['pjokK6S1'],
      'pjokK6S2' => $form['pjokK6S2'],
      'sundaK4S1' => $form['sundaK4S1'],
      'sundaK4S2' => $form['sundaK4S2'],
      'sundaK5S1' => $form['sundaK5S1'],
      'sundaK5S2' => $form['sundaK5S2'],
      'sundaK6S1' => $form['sundaK6S1'],
      'sundaK6S2' => $form['sundaK6S2'],
      'totalNilai' =>
      $form['paiK4S1'] + $form['paiK4S2'] + $form['paiK5S1'] + $form['paiK5S2'] + $form['paiK6S1'] + $form['paiK6S2'] +
        $form['pknK4S1'] + $form['pknK4S2'] + $form['pknK5S1'] + $form['pknK5S2'] + $form['pknK6S1'] + $form['pknK6S2'] +
        $form['indoK4S1'] + $form['indoK4S2'] + $form['indoK5S1'] + $form['indoK5S2'] + $form['indoK6S1'] + $form['indoK6S2'] +
        $form['mtkK4S1'] + $form['mtkK4S2'] + $form['mtkK5S1'] + $form['mtkK5S2'] + $form['mtkK6S1'] + $form['mtkK6S2'] +
        $form['ipaK4S1'] + $form['ipaK4S2'] + $form['ipaK5S1'] + $form['ipaK5S2'] + $form['ipaK6S1'] + $form['ipaK6S2'] +
        $form['ipsK4S1'] + $form['ipsK4S2'] + $form['ipsK5S1'] + $form['ipsK5S2'] + $form['ipsK6S1'] + $form['ipsK6S2'] +
        $form['sbdpK4S1'] + $form['sbdpK4S2'] + $form['sbdpK5S1'] + $form['sbdpK5S2'] + $form['sbdpK6S1'] + $form['sbdpK6S2'] +
        $form['pjokK4S1'] + $form['pjokK4S2'] + $form['pjokK5S1'] + $form['pjokK5S2'] + $form['pjokK6S1'] + $form['pjokK6S2'] +
        $form['sundaK4S1'] + $form['sundaK4S2'] + $form['sundaK5S1'] + $form['sundaK5S2'] + $form['sundaK6S1'] + $form['sundaK6S2'],

      'rataRataTotalNilai' => round(
        ($form['paiK4S1'] + $form['paiK4S2'] + $form['paiK5S1'] + $form['paiK5S2'] + $form['paiK6S1'] + $form['paiK6S2'] +
          $form['pknK4S1'] + $form['pknK4S2'] + $form['pknK5S1'] + $form['pknK5S2'] + $form['pknK6S1'] + $form['pknK6S2'] +
          $form['indoK4S1'] + $form['indoK4S2'] + $form['indoK5S1'] + $form['indoK5S2'] + $form['indoK6S1'] + $form['indoK6S2'] +
          $form['mtkK4S1'] + $form['mtkK4S2'] + $form['mtkK5S1'] + $form['mtkK5S2'] + $form['mtkK6S1'] + $form['mtkK6S2'] +
          $form['ipaK4S1'] + $form['ipaK4S2'] + $form['ipaK5S1'] + $form['ipaK5S2'] + $form['ipaK6S1'] + $form['ipaK6S2'] +
          $form['ipsK4S1'] + $form['ipsK4S2'] + $form['ipsK5S1'] + $form['ipsK5S2'] + $form['ipsK6S1'] + $form['ipsK6S2'] +
          $form['sbdpK4S1'] + $form['sbdpK4S2'] + $form['sbdpK5S1'] + $form['sbdpK5S2'] + $form['sbdpK6S1'] + $form['sbdpK6S2'] +
          $form['pjokK4S1'] + $form['pjokK4S2'] + $form['pjokK5S1'] + $form['pjokK5S2'] + $form['pjokK6S1'] + $form['pjokK6S2'] +
          $form['sundaK4S1'] + $form['sundaK4S2'] + $form['sundaK5S1'] + $form['sundaK5S2'] + $form['sundaK6S1'] + $form['sundaK6S2']) / 54,
        2
      ),
      'jumlahRataRata' => $totalRataRataNilai,
      'idPrestasi' => $form['idPrestasi'],
      'nilaiPrestasi' => $form['scorePrestasi'],
      'nilaiPraktekPrestasi' => 0,
      'cabangPrestasi' => $form['namaKejuaraan'],
      'totalJarak' => $this->hitungJarak($latSekolah, $longSekolah, $latDaftar, $longDaftar, $unit = 'km', $desimal = 2) * 1000,
      'statusPendaftaran' => 1,
      'tanggalRegister' => date('ymd'),
      'prosesBy' => 'none',
      'noUrut' => $this->urut(),
      'kelRombel' => '',
      'captha' => 'TetsCapcha',
      'lulus' => 0
    ];

    $this->db->insert('pendaftar', $data);
    return $this->db->affected_rows();
  }


  // kumpulan ffunction


  function hitungUsia($tanggalLahir)
  {

    $rubahTanggal = date('y-m-d', strtotime($tanggalLahir));
    // tanggal lahir
    $tanggal = new DateTime($rubahTanggal);

    // tanggal hari ini
    $today = new DateTime('today');

    // tahun
    $y = $today->diff($tanggal)->y;

    // bulan
    $m = $today->diff($tanggal)->m;

    // hari
    $d = $today->diff($tanggal)->d;

    if ($m < 10) {
      $m = '0' . $m;
    }
    return ($y . "." . $m);
  }

  private function koreg()
  {
    $today = date("Ymd");
    $query = "SELECT max(koreg) AS last FROM pendaftar WHERE koreg LIKE '$today%'";
    $data = $this->db->query($query)->row_array();
    $lasKoreg = $data['last'];
    $lastNoUrut = substr($lasKoreg, 8, 4);
    $nexKoreg = $lastNoUrut + 1;
    $nexNoKoreg = $today . sprintf('%04s', $nexKoreg);
    return $nexNoKoreg;
  }

  private function urut()
  {
    $query = "SELECT max(noUrut) AS last FROM pendaftar";
    $data = $this->db->query($query)->row_array();
    $lasKoreg = $data['last'];
    $nexKoreg = $lasKoreg + 1;
    return $nexKoreg;
  }
}
