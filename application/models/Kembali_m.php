<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kembali_m extends CI_Model
{

  // ajax untuk pengembalian reguler========================================================

  //get data peminjaman all 
  public function GetDataPeminjaman($jenisPinjaman)
  {
    $this->db->select('peminjaman.*, buku.judul, buku.kodeBuku,buku.id AS nomorBuku');
    $this->db->from('peminjaman');
    $this->db->join('buku', 'peminjaman.kodeBuku = buku.kodeBuku');
    $this->db->where([
      'peminjaman.IdAnggota' => $this->session->userdata('idAnggota'),
      'peminjaman.status' => 1,
      'peminjaman.jenisPinjaman' => $jenisPinjaman
    ]);
    $hasil['pinjam'] = $this->db->get()->result_array();

    $data = [];
    foreach ($hasil['pinjam'] as $pinjams) {
      $row['judul'] = $pinjams['judul'];
      $row['kodeBuku'] = $pinjams['kodeBuku'];
      $row['idBuku'] = $pinjams['nomorBuku'];
      $row['status'] = $this->cekDataPengembalian($pinjams['id'], $pinjams['IdAnggota']);
      $data[] = $row;
    }

    return $data;
  }

  // hitung lama pinjam // funtion hitung hari
  function hitungHari($awal)
  {
    // $booking      =new DateTime($awal);
    // $today        =new DateTime();
    // $diff         =$today->diff($booking);
    // return $diff->d;

    $begin = new DateTime($awal);
    $end = new DateTime();

    $daterange     = new DatePeriod($begin, new DateInterval('P1D'), $end);
    //mendapatkan range antara dua tanggal dan di looping
    $i = 0;
    $x     =    0;
    $end     =    1;

    foreach ($daterange as $date) {
      $daterange     = $date->format("y-m-d");
      $datetime     = DateTime::createFromFormat('y-m-d', $daterange);

      //Convert tanggal untuk mendapatkan nama hari
      $day         = $datetime->format('D');

      //Check untuk menghitung yang bukan hari sabtu dan minggu
      if ($day != "Sun" && $day != "Sat") {
        //echo $i;
        $x    +=    $end - $i;
      }
      $end++;
      $i++;
    }
    return $x;
  }

  //  hitung denda
  function hitungDenda($lama)
  {
    $setting = $this->db->get_where('setting', ['id' => 1])->row_array();
    $lamaPinjam = $lama;
    $dendaPerbuku = $setting['denda'];
    $maxLamaPinjam = $setting['maxKeterlambatan'];
    $terlamabat = $lamaPinjam - $maxLamaPinjam;
    $data['status'] = '';


    if ($lamaPinjam >  $maxLamaPinjam) {
      $data['status'] = 'Lewat ' . $terlamabat . ' H';
      $data['denda'] = ($lamaPinjam - $maxLamaPinjam) * $dendaPerbuku;
    } elseif ($lamaPinjam ==  $maxLamaPinjam) {
      $data['denda'] = 0;
      $data['status'] = 'Tepat';
    } elseif ($lamaPinjam < $maxLamaPinjam) {
      $data['status'] = 'Tepat';
      $data['denda'] = 0;
    }
    return $data;
  }

  private function cekDataPengembalian($id, $anggota)
  {
    $this->db->select('*');
    $this->db->from('pengembalian');
    $this->db->where([
      'idAnggota' => $anggota,
      'idPinjam' => $id,
    ]);
    return $this->db->get()->num_rows();
  }

  //  cek data buku yang dikembalikan masiah ada atau tidak
  public function cekDataBukuKembali($kodeBuku)
  {
    return $this->db->get_where('peminjaman', [
      'IdAnggota' => $this->session->userdata('idAnggota'),
      'kodeBuku' => $kodeBuku,
      'status' => 1,
      'jenisPinjaman' => $this->session->userdata('jenisPinjaman')
    ])->num_rows();
  }

  // cek pengembalian sudah ada apa belum
  public function cekDataBukusudahKembali($kodeBuku)
  {
    $buku = $this->db->get_where('peminjaman', [
      'IdAnggota' => $this->session->userdata('idAnggota'),
      'kodeBuku' => $kodeBuku,
      'status' => 1,
      'jenisPinjaman' => $this->session->userdata('jenisPinjaman')

    ])->row_array();

    return $this->db->get_where('pengembalian', [
      'idPinjam' => $buku['id'],
      'idAnggota' => $buku['IdAnggota'],
      'kodeBuku' => $buku['kodeBuku'],
      'status' => 1
    ])->num_rows();
  }


  // buat session jensi pinjaman
  public function createSessionJenisPinjaman($jenis)
  {
    $session = [
      'jenisPinjaman' => $jenis
    ];
    $this->session->set_userdata($session);
    $data['pesan'] = '';
    if (!$this->session->userdata('jenisPinjaman')) {

      $data['pesan'] = 'tidakAda';
      //  $data['session']=$this->session->userdata('jenisPinjaman');
    } else {
      $data['pesan'] = 'ada';
      $data['session'] = $this->session->userdata('jenisPinjaman');
    }
    return $data;
  }

  //cek session jenis pinjaman 

  public function cekSessionJenisPinjaman()
  {
    if (!$this->session->userdata('jenisPinjaman')) {
      $data['pesan'] = 'tidakAda';
    } else {
      $data['pesan'] = 'ada';
      $data['session'] = $this->session->userdata('jenisPinjaman');
    }
    return $data;
  }

  // update data buku pengembalian jika cocok
  public function updateDataKembali($kodeBuku)
  {
    $buku = $this->db->get_where('peminjaman', [
      'IdAnggota' => $this->session->userdata('idAnggota'),
      'kodeBuku' => $kodeBuku,
      'status' => 1,
      'jenisPinjaman' => $this->session->userdata('jenisPinjaman')

    ])->row_array();
    $denda = $this->hitungDenda($this->hitungHari($buku['tglPinjam']));

    $simpan = [
      'idPinjam' => $buku['id'],
      'idAnggota' => $buku['IdAnggota'],
      'kodeBuku' => $buku['kodeBuku'],
      'idUser' => $buku['idUser'],
      'tglKembali' => date('y-m-d'),
      'denda' => $denda['denda'],
      'status' => 1
    ];

    $this->db->insert('pengembalian', $simpan);
    return $this->db->affected_rows();
  }

  public function resetPengembalian()
  {
    $buku = $this->db->get_where('peminjaman', [
      'IdAnggota' => $this->session->userdata('idAnggota'),
      'status' => 1,
      'jenisPinjaman' => $this->session->userdata('jenisPinjaman')

    ])->result_array();

    $no = 1;
    foreach ($buku as $books) {
      $this->db->delete('pengembalian', ['idPinjam' => $books['id']]);
      $no++;
    }

    return $no;
    // return $data['idPinjam'];
  }

  // proses simpan pengembalian peminjaman reguler
  public function ProsesSimpanPengembalianReguler()
  {
    $peminjaman = $this->db->get_where('peminjaman', [
      'IdAnggota' => $this->session->userdata('idAnggota'),
      'status' => 1,
      'jenisPinjaman' => $this->session->userdata('jenisPinjaman')
    ])->result_array();



    $no = 1;
    foreach ($peminjaman as $kembali) {
      if (
        $this->db->get_where(
          'pengembalian',
          [
            'idPinjam' => $kembali['id'],
            'idAnggota' => $this->session->userdata('idAnggota'),
            'status' => 1,

          ]
        )->num_rows() > 0
      ) {
        $this->updateStatusBuku($kembali['kodeBuku']);
        $this->updatePengembalianBuku($kembali['id']);
        $this->updatePeminjamanBuku($kembali['id']);
      }

      $no++;
    }

    return $no;
  }

  // function updateStatusBuku
  public function updateStatusBuku($kodeBuku)
  {
    $update = [
      'statusPeminjaman' => '1',
    ];
    $this->db->set($update);
    $this->db->where('kodeBuku', $kodeBuku);
    $this->db->update('buku');
  }

  // update status pengembalian buku
  public function updatePengembalianBuku($idPinjam)
  {
    $update = [
      'status' => '2',
    ];
    $this->db->set($update);
    $this->db->where('idPinjam', $idPinjam);
    $this->db->update('pengembalian');
  }

  // update status peminjaman buku
  public function updatePeminjamanBuku($id)
  {
    $update = [
      'status' => '2',
    ];
    $this->db->set($update);
    $this->db->where('id', $id);
    $this->db->update('peminjaman');
  }

  // cek jumlah buku yang akan dikembalikan dan denda nya
  public function cekJumlahBukuDenda()
  {
    $peminjaman = $this->db->get_where('peminjaman', [
      'IdAnggota' => $this->session->userdata('idAnggota'),
      'status' => 1,
      'jenisPinjaman' => $this->session->userdata('jenisPinjaman')
    ])->num_rows();

    $this->db->select('pengembalian.*, buku.judul, buku.kodeBuku');
    $this->db->from('pengembalian');
    $this->db->join('buku', 'pengembalian.kodeBuku = buku.kodeBuku');
    $this->db->where([
      'pengembalian.idAnggota' => $this->session->userdata('idAnggota'),
      'pengembalian.status' => 1,

    ]);
    $pengembalian['pinjam'] = $this->db->get()->result_array();
    $jml = 0;
    foreach ($pengembalian['pinjam'] as  $value) {
      $row['kodeBuku'] = $value['kodeBuku'];
      $row['denda'] = $value['denda'] + $value['denda'];
      $data[] = $row;
      $jml++;
    }
    $data['jumlahKembali'] = $jml;
    $data['jumlahTidakKemabali'] = $peminjaman - $jml;
    $data['pesan'] = 'sukses';

    return $data;
  }




  // end ajax untuk pengembalian reguler====================================================


}
