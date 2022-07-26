<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Paket extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Paket_m', 'paket');
    is_logged_in();
  }
  public function index()
  {
    $data['title'] = 'Buku Paket';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('Paket/index', $data);
    $this->load->view('themplate/admin/bottomBar', $data);
    $this->load->view('themplate/admin/footer', $data);
  }

  // view pengembalian buku paket
  public function Pengembalian()
  {
    $data['title'] = 'Pengembalian Buku Paket';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('Paket/Pengembalian', $data);
    $this->load->view('themplate/admin/bottomBar', $data);
    $this->load->view('themplate/admin/footer', $data);
  }

  // ===========================untuk data tables=================== 
  // get all Data Buku
  public function GetDataKeranjangPaket()
  {
    $list = $this->paket->getDataKeranjangBuku();
    $data = array();
    $no = @$_POST['start'];
    foreach ($list as $item) {
      $no++;
      $row = array();
      $row[] = $no . ".";
      $row[] = $item->kodeBuku;
      $row[] = $item->judul;
      $row[] = $item->tahun;


      $row[] = '<button  class="badge badge-danger tombolHapusItemKeranjangBukuPaket" data-id="' . $item->id . '"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</button>';
      $data[] = $row;
    }
    $output = array(
      "draw" => @$_POST['draw'],
      "recordsTotal" => $this->paket->count_all(),
      "recordsFiltered" => $this->paket->count_filtered(),
      "data" => $data,
    );


    echo json_encode($output);
  }
  // =========================== end data tables=====================================

  // block transaksi pe minjaman buku==================================================
  // cari anggota yang mau pinjam buku paket
  public function cariAnggota()
  {
    echo json_encode($this->paket->cariAnggota($_POST['key']));
  }

  // input kode anggoa
  public function CekKodeAnggota()
  {
    $data['pesan'] = '';
    $data = $this->db->get_where('anggota', ['id' => $_POST['kodeAnggota']])->row_array();
    $cek = $this->db->get_where('anggota', ['id' => $_POST['kodeAnggota']])->num_rows();
    // $cekbukuTamu=$this->paket->cekBukuTamu($_POST['kodeAnggota']);
    if ($cek) {

      $data['pesan'] = 'ada';
      $session = [
        'idAnggota' => $_POST['kodeAnggota']
      ];
      $this->session->set_userdata($session);
      echo json_encode($data);
    } else {
      $data['pesan'] = 'kosong';
      echo json_encode($data);
    }
  }

  // input kode buku dan simpan keranjang buku
  public function cekKodeBuku()
  {
    $data['pesan'] = '';
    $kodeBuku = $_POST['kodeBuku'];
    $buku = $this->db->get_where('buku', ['kodeBuku' => $kodeBuku])->row_array();
    $cek = $this->db->get_where('buku', ['kodeBuku' => $kodeBuku])->num_rows();
    // cek keranjang
    $jmlKerajang = $this->db->get_where('k_peminjaman', ['idAnggota' => $this->session->userdata('idAnggota')])->num_rows();
    $setting = $this->db->get_where('setting', ['id' => 1])->row_array();
    $maxPeminjamanPaket = $setting['maxPinjamanPaket'];
    $jmlBelumKembali = $this->db->get_where('peminjaman', ['IdAnggota' => $this->session->userdata('idAnggota'), 'status' => 1, 'jenisPinjaman' => 'R'])->num_rows();
    $totalPinjaman = ($jmlBelumKembali + $jmlKerajang);
    if ($cek) {
      if ($this->db->get_where('k_peminjaman', ['kodeBuku' => $kodeBuku])->num_rows() > 0) {
        $data['pesan'] = 'sudahAda';
        echo json_encode($data);
      } elseif ($buku['statusPeminjaman'] == 2) {
        $data['pesan'] = 'dipinjam';
        $data['peminjaman'] = $this->paket->cekPeminjamanByBukuPaket($kodeBuku);
        echo json_encode($data);
      } elseif ($totalPinjaman >= $maxPeminjamanPaket) {
        $data['pesan'] = 'full';
        $data['jmlKeranjang'] = $jmlKerajang;
        $data['maxPeminjamanPaket'] = $maxPeminjamanPaket;
        $data['jmlBelumKembali'] = $jmlBelumKembali;
        $data['totalPinjaman'] = $totalPinjaman;
        echo json_encode($data);
      } else {

        if ($this->paket->simpanBukuKeranjang($kodeBuku) > 0) {
          $data['pesan'] = 'ada';
          echo json_encode($data);
        }
      }
    } else {
      $data['pesan'] = 'kosong';
      echo json_encode($data);
    }
  }

  // cek session Anggota
  public function CekSessionAnggota()
  {
    $data['pesan'] = '';
    if ($this->session->userdata('idAnggota')) {
      $data['pesan'] = 'ada';
      echo json_encode($data);
    } else {
      $this->db->delete('k_peminjaman', ['idUser' => $this->session->userdata('email')]);
      $data['pesan'] = 'Tidakada';
      echo json_encode($data);
    }
  }

  // load data anngota berdasarkan session
  public function loadDataAnggotaByIdSession()
  {
    $data['pesan'] = 'ada';
    $data = $this->db->get_where('anggota', ['id' => $this->session->userdata('idAnggota')])->row_array();
    $data['kunjungan'] = $this->db->get_where('bukutamu', ['idAnggota' => $this->session->userdata('idAnggota')])->num_rows();
    $data['tanggal'] = date('d F Y', $data['tglRegister']);
    $data['setting'] = $this->db->get_where('setting', ['id' => 1])->row_array();
    echo json_encode($data);
  }

  // cek data pinjaman by session anggota
  public function getDataPinjamanByAnggota()
  {
    echo json_encode($this->paket->getDataPinjamanByAnggota());
  }

  public function getDataPinjamanBelumKembali()
  {
    $idAnggota = $_POST['idAnggota'];
    if ($this->db->get_where('peminjaman', ['IdAnggota' => $idAnggota, 'status' => 1])->num_rows() > 0) {
      echo json_encode($this->paket->getDataPinjamanBelumKembali($_POST['idAnggota']));
    } else {
      return false;
    }
  }

  // ubah format tanggal
  function tgl_indo($tanggal)
  {
    $bulan = array(
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
  }


  // reset keranjang buku
  public function resetPeminjaman()
  {
    $data['pesan'] = 'sukses';
    if ($this->paket->resetKeranjangPeminjaman() > 0) {
      $this->session->unset_userdata('idAnggota');
      echo json_encode($data);
    }
  }

  // hapus item keranjang buku
  public function hapusItemKeranjangBuku()
  {
    if ($this->paket->hapusItemKeranjangBuku($_POST['id']) > 0) {
      $data['pesan'] = 'ok';
      echo json_encode($data);
    } else {
      $data['pesan'] = 'error';
      echo json_encode($data);
    }
  }

  // proses peminjaman buku leguler
  public function prosesPinjaman()
  {
    $data['pesan'] = '';
    if ($this->paket->prosesPinjaman() > 0) {
      $data['idAnggota'] = $this->session->userdata('idAnggota');
      $data['pesan'] = 'sukses';
      echo json_encode($data);
    } else {
      $data['pesan'] = 'gagal';
      echo json_encode($data);
    }
  }

  // end block transaksi pe minjaman buku==================================================

  //================================================ Blok Pengebalian Buku Paket=====================================
  public function cekKodeBukuPengembalian()
  {
    $data['pesan'] = '';
    $cek = $this->paket->cekDataBukuKembali($_POST['kodeBukuPengembalian']);
    if ($cek > 0) {
      // cek dulu apakah sudah masuk ke table pengembalian
      if ($this->paket->cekDataBukusudahKembali($_POST['kodeBukuPengembalian']) > 0) {
        $data['pesan'] = 'sudahAda';
        echo json_encode($data);
      } else {
        if ($this->paket->updateDataKembali($_POST['kodeBukuPengembalian']) > 0) {
          $data['pesan'] = 'ada';
          echo json_encode($data);
        }
      }
    } else {
      $data['pesan'] = 'kosong';
      echo json_encode($data);
    }
  }

  // cek berapa jumlah buku yang akan dikembalikan dan dendanya
  public function cekjumlahBukuDendaYangDikembalikan()
  {
    echo json_encode($this->paket->cekJumlahBukuDenda());
  }

  // resetPengembalianPaket buku reguler
  public function resetPengembalianPaket()
  {
    if ($this->paket->resetPengembalianPaket() > 0) {
      $this->session->unset_userdata('idAnggota');
      $this->session->unset_userdata('jenisPinjaman');
      $data['pesan'] = 'sukses';
      echo json_encode($data);
    }
  }

  // proses pengembalian buku paket
  public function simpanPengembalianPaket()
  {
    $data['pesan'] = '';
    if ($this->paket->ProsesSimpanPengembalianPaket() > 0) {
      $data['pesan'] = 'sukses';
    }

    echo json_encode($data);
  }
}
