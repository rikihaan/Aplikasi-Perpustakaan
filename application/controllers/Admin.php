<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Ppdb_model', 'daftar');
    $this->load->model('Admin_model', 'admin');
    is_logged_in(); 
  }

  // Block View
  public function Peminjaman()
  {
    $data['title'] = 'Peminjaman';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('Transaksi/Peminjaman', $data);
    $this->load->view('themplate/admin/bottomBar', $data);
    $this->load->view('themplate/admin/footer', $data);
  }
  // End Block View

  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('Admin/index', $data);
    $this->load->view('themplate/admin/bottomBar', $data);
    $this->load->view('themplate/admin/footer', $data);
  }

  // ===========================untuk data tables===================
      // get all Data Buku
      public function GetDataPeminjamanRegAll(){
      $list = $this->admin->getDataKeranjangBuku();
      $data = array();
      $no = @$_POST['start'];
      foreach ($list as $item) {
        $no++;
        $row = array();
        $row[] = $no . ".";
        $row[] = $item->kodeBuku;
        $row[] = $item->judul;
        $row[] = $item->tahun;
      

        $row[] = '<button  class="badge badge-danger tombolHapusItemKeranjang" data-id="'.$item->id.'"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</button>';
        $data[] = $row;
      }
      $output = array(
        "draw" => @$_POST['draw'],
        "recordsTotal" => $this->admin->count_all(),
        "recordsFiltered" => $this->admin->count_filtered(),
        "data" => $data,
      );
    

    echo json_encode($output);
    }
  // =========================== end data tables=====================================


   // ===========================untuk data Transakasi Peminjaman===================
      // get all Data Buku
      public function GetdataTransaksi(){
        $list = $this->admin->getDataTransakasiPeminjaman();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
          $no++;
          $row = array();
          $row[] = $no . ".";
          $row[] = $item->IdAnggota;
          $row[] = $item->nama;
          $row[] = $item->kelas;
          $row[] = '<button  class="badge badge-success tombolLihatDataTransaksi" data-id="'.$item->IdAnggota.'"><i class="fa fa-trash" aria-hidden="true"></i> Lihat</button>';
          $data[] = $row;
        }
        $output = array(
          "draw" => @$_POST['draw'],
          "recordsTotal" => $this->admin->count_all_transaksi(),
          "recordsFiltered" => $this->admin->count_filtered_transaksi(),
          "data" => $data,
        );
      echo json_encode($output);
      }

   
    // =========================== end data Transakasi Peminjaman=====================================
  

  // block transaksi pe minjaman buku==================================================

  // input kode anggoa
  public function CekKodeAnggota(){
    $data['pesan']='';
    $data=$this->db->get_where('anggota',['id'=>$_POST['kodeAnggota']])->row_array();
    $cek=$this->db->get_where('anggota',['id'=>$_POST['kodeAnggota']])->num_rows();
    // $cekbukuTamu=$this->admin->cekBukuTamu($_POST['kodeAnggota']);
    if($cek){

      // cek sudah isi buku tamu
      // if($cekbukuTamu > 0 ){
        $data['pesan']='ada';
        $session = [
          'idAnggota' =>$_POST['kodeAnggota']
        ];
        $this->session->set_userdata($session);
        echo json_encode($data);
      // }
      // else{
      //   $data['pesan']='bukuTamu';
      //   echo json_encode($data);

      // }

      
    }else{
      $data['pesan']='kosong';
      echo json_encode($data);

    }
  }

  // input kode buku dan simpan keranjang buku
    public function cekKodeBuku(){
      $data['pesan']='';
      $kodeBuku=$_POST['kodeBuku'];
      $buku=$this->db->get_where('buku',['kodeBuku'=> $kodeBuku])->row_array();
      $cek=$this->db->get_where('buku',['kodeBuku'=> $kodeBuku])->num_rows();
      // cek keranjang
      $jmlKerajang=$this->db->get_where('k_peminjaman',['idAnggota'=>$this->session->userdata('idAnggota')])->num_rows();
      $setting=$this->db->get_where('setting',['id'=> 1 ])->row_array();
      $maxPeminjaman=$setting['maxPinjamanReguler'];
      $jmlBelumKembali=$this->db->get_where('peminjaman',['IdAnggota'=>$this->session->userdata('idAnggota'),'status'=>1,'jenisPinjaman'=>'R'])->num_rows();
      $totalPinjaman= ($jmlBelumKembali + $jmlKerajang);
      if($cek){
              if($this->db->get_where('k_peminjaman',['kodeBuku'=> $kodeBuku])->num_rows()>0){
                $data['pesan']='sudahAda';
                echo json_encode($data);
              }
              elseif($buku['statusPeminjaman']==2)
                {
                  $data['pesan']='dipinjam';
                  $data['peminjaman']=$this->admin->cekPeminjamanByBuku($kodeBuku);
                  echo json_encode($data);
                }
                elseif($totalPinjaman>=$maxPeminjaman){
                  $data['pesan']='full';
                  $data['jmlKeranjang']=$jmlKerajang;
                  $data['maxPeminjaman']=$maxPeminjaman;
                  $data['jmlBelumKembali']=$jmlBelumKembali;
                  $data['totalPinjaman']=$totalPinjaman;
                  echo json_encode($data);
                }
              else{

                  if($this->admin->simpanBukuKeranjang($kodeBuku)>0){
                    $data['pesan']='ada';
                    echo json_encode($data);
                  }
                }
      }
      else
      {
        $data['pesan']='kosong';
        echo json_encode($data);

      }
    }

  // cek session Anggota
    public function CekSessionAnggota(){
      $data['pesan']='';
      if($this->session->userdata('idAnggota')){
        $data['pesan']='ada';
        echo json_encode($data);
      }else{
        $this->db->delete('k_peminjaman',['idUser'=>$this->session->userdata('email')]);
        $data['pesan']='Tidakada';
        echo json_encode($data);
      }

    }

  // load data anngota berdasarkan session
    public function loadDataAnggotaByIdSession(){
      $data['pesan']='ada';
      $data=$this->db->get_where('anggota',['id'=>$this->session->userdata('idAnggota')])->row_array();
      $data['kunjungan']= $this->db->get_where('bukutamu',['idAnggota'=>$this->session->userdata('idAnggota')])->num_rows();
      $data['tanggal'] = date('d F Y', $data['tglRegister']);
      $data['setting']=$this->db->get_where('setting',['id'=>1])->row_array();
      echo json_encode($data);
    }

    // cek data pinjaman by session anggota
    public function getDataPinjamanByAnggota(){
      echo json_encode( $this->admin->getDataPinjamanByAnggota());
    }

    // ubah format tanggal
    function tgl_indo($tanggal){
      $bulan = array (
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
    
      return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
    

    


  // reset keranjang buku
    public function resetPeminjaman(){
      $data['pesan']='sukses';
      if($this->admin->resetKeranjangPeminjaman()>0){
        $this->session->unset_userdata('idAnggota');
        echo json_encode($data);
      }
      
    
    }

  // hapus item keranjang buku
    public function hapusItemKeranjangBuku(){
      if($this->admin->hapusItemKeranjangBuku($_POST['id']) > 0){
        echo 'ok';
      }
      else{
        echo 'error';
      }
    }

    // proses peminjaman buku leguler

      public function prosesPinjaman(){
        $data['pesan']='';
        if($this->admin->prosesPinjaman()>0){
        $data['pesan']='sukses';
        echo json_encode($data);
        }
        else{
        $data['pesan']='gagal';
        echo json_encode($data);

        }

        
      }
  
    // end block transaksi pe minjaman buku==================================================

    // block pengambilan data transakasi pemninjaman
    public function GetDataPeminjamanAll(){
     $data= $this->admin->getDataPeminjamanALL($_POST['id']);
     echo  json_encode($data);
    }
    // end block peminjama 
 
 
}
