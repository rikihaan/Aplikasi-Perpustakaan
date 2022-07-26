<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pengembalian extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Ppdb_model', 'daftar');
    $this->load->model('Kembali_m', 'kembali');
    is_logged_in();
  }
  public function index()
  {
    $data['title'] = 'Pengembalian';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('Pengembalian/index', $data);
    $this->load->view('themplate/admin/bottomBar', $data);
    $this->load->view('themplate/admin/footer', $data);
  }


  // load data pengembalian all
  public function GetDataPeminjaman()
  {
    $jenisPinjaman = $_POST['jenisPinjaman'];
    echo json_encode($this->kembali->GetDataPeminjaman($jenisPinjaman));
  }

  // cek data buku yang di kembalikan sesuai apa tiudak
  public function cekKodeBukuPengembalian()
  {
    $data['pesan'] = '';
    $cek = $this->kembali->cekDataBukuKembali($_POST['kodeBukuPengembalian']);
    if ($cek > 0) {
      // cek dulu apakah sudah masuk ke table pengembalian
      if ($this->kembali->cekDataBukusudahKembali($_POST['kodeBukuPengembalian']) > 0) {
        $data['pesan'] = 'sudahAda';
        echo json_encode($data);
      } else {
        if ($this->kembali->updateDataKembali($_POST['kodeBukuPengembalian']) > 0) {
          $data['pesan'] = 'ada';
          echo json_encode($data);
        }
      }
    } else {
      $data['pesan'] = 'kosong';
      echo json_encode($data);
    }
  }

  // buat session jensi pinjaman
  public function createSessionJenisPinjaman()
  {
    echo json_encode($this->kembali->createSessionJenisPinjaman($_POST['data']));
  }

  // cek session jenis pinjaman 
  public function cekSessionJenisPinjaman()
  {
    echo json_encode($this->kembali->cekSessionJenisPinjaman());
  }

  // resetPengembalian buku reguler
  public function resetPengembalian()
  {
    if ($this->kembali->resetPengembalian() > 0) {
      $this->session->unset_userdata('idAnggota');
      $this->session->unset_userdata('jenisPinjaman');
      $data['pesan'] = 'sukses';
      echo json_encode($data);
    }
  }

  public function simpanPengembalianReg()
  {
    $data['pesan'] = '';
    if ($this->kembali->ProsesSimpanPengembalianReguler() > 0) {
      $data['pesan'] = 'sukses';
    }

    echo json_encode($data);
  }

  // cek berapa jumlah buku yang akan dikembalikan dan dendanya
  public function cekjumlahBukuDendaYangDikembalikan()
  {
    echo json_encode($this->kembali->cekJumlahBukuDenda());
  }
}
