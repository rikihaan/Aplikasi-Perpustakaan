<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_model extends CI_Model
{

//  gete data transakasi pemninjaman
  public function getDataTransakasiPeminjaman(){
    $this->_get_datatables_query_transaksi();
    if (@$_POST['length'] != -1)
    $this->db->limit(@$_POST['length'], @$_POST['start']); 
    $query = $this->db->get();
    return $query->result();
  }

  
  function count_filtered_transaksi()
  {
    $this->_get_datatables_query_transaksi();
    $query = $this->db->get();
    return $query->num_rows();
  }

  function count_all_transaksi()
  {
    $this->db->from('peminjaman');
    return $this->db->count_all_results();
  }

   var $column_order_transaksi = array(null, 'nama','kelas'); //set column field database for datatable orderable
   var $column_search_transaksi = array('nama','kelas'); //set column field database for datatable searchable
   var $order_transakasi = array('kelas' => 'asc'); // default order
   private function _get_datatables_query_transaksi()
   {
     $this->db->select('peminjaman.*,anggota.*');
     $this->db->from('peminjaman');
     $this->db->join('anggota','anggota.id = peminjaman.IdAnggota');
     $this->db->group_by("nama");
     $i = 0;
     foreach ($this->column_search_transaksi as $item) { // loop column
       if (@$_POST['search']['value']) { // if datatable send POST for search
         if ($i === 0) { 
           $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
           $this->db->like($item, $_POST['search']['value']);
         } else {
           $this->db->or_like($item, $_POST['search']['value']);
         }
         if (count($this->column_search_transaksi) - 1 == $i) //last loop
           $this->db->group_end(); //close bracket
       }
       $i++;
     }
 
     if (isset($_POST['order'])) { // here order processing
       $this->db->order_by($this->column_order_transaksi[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
     } else if (isset($this->order_transakasi)) {
       $order = $this->order_transakasi;
       $this->db->order_by(key($order), $order[key($order)]);
     }
   }

  //  ambil data transaksi peminjaman all 
   public function getDataPeminjamanALL($id){
    $data['reguler'] =$this->_peminjamanReguler($id);
    $data['paket']= $this->_peminjamanPaket($id);
    return $data;
   }
  //  end ambil data transakasi

  // functin pengambilan data berdasarkan 
    // ambil peminjaman harian
    private function _peminjamanReguler($id){
      $this->db->select('peminjaman.*,buku.*,anggota.nama');
      $this->db->from('peminjaman');
      $this->db->join('buku', 'peminjaman.kodeBuku = buku.kodeBuku');
      $this->db->join('anggota', 'peminjaman.IdAnggota = anggota.id');
      $this->db->where([
                        'peminjaman.IdAnggota'=>$id,
                        ]);
      $this->db->where(['peminjaman.jenisPinjaman'=>'R']);
      $hasil['pendaftar']= $this->db->get()->result_array();
      $data = [];
      $data['nama']= $this->db->get_where('anggota',['id'=>$id])->row_array();
      foreach ($hasil['pendaftar'] as $rank) {
        $row['lamaPinjam'] = $this->hitungHari($rank['tglPinjam']);
        $row['noBuku'] = $rank['id'];
        $row['judul'] = $rank['judul'];
        $row['tglPinjam'] = $rank['tglPinjam'];
        $data[] = $row;
      }
      return $data;             
    }

      // ambil peminjaman Paket
      private function _peminjamanPaket($id){
        $this->db->select('peminjaman.*,buku.*,anggota.nama');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'peminjaman.kodeBuku = buku.kodeBuku');
        $this->db->join('anggota', 'peminjaman.IdAnggota = anggota.id');
        $this->db->where([
                          'peminjaman.IdAnggota'=>$id,
                          ]);
        $this->db->where(['peminjaman.jenisPinjaman'=>'P']);
        $hasil['pendaftar']= $this->db->get()->result_array();
        $data = [];
        $data['nama']= $this->db->get_where('anggota',['id'=>$id])->row_array();
        foreach ($hasil['pendaftar'] as $rank) {
          $row['lamaPinjam'] = $this->hitungHari($rank['tglPinjam']);
          $row['noBuku'] = $rank['id'];
          $row['judul'] = $rank['judul'];
          $row['tglPinjam'] = $rank['tglPinjam'];
          $data[] = $row;
        }
        return $data;             
      }

// end data transakasi peminjaman===============================================================================================================================================

  // datatables keranjangbuku
  public function GetDataKeranjangBuku(){
    $this->_get_datatables_query();
    if (@$_POST['length'] != -1)
    $this->db->limit(@$_POST['length'], @$_POST['start']); 
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  function count_all()
  {
    $this->db->from('k_peminjaman');
    return $this->db->count_all_results();
  }


   // block dasar query ajax
   var $column_order = array(null, 'kodeBuku', 'judul','tahun','kategori'); //set column field database for datatable orderable
   var $column_search = array('kodeBuku', 'judul','tahun','kategori'); //set column field database for datatable searchable
   var $order = array('judul' => 'asc'); // default order
   private function _get_datatables_query()
   {
     $this->db->select('k_peminjaman.*, buku.kodeBuku, judul,tahun,pengarang');
     $this->db->from('k_peminjaman');
     $this->db->where('jenisPinjam','R');
     $this->db->join('buku','buku.kodeBuku = k_peminjaman.kodeBuku');
     $i = 0;
     foreach ($this->column_search as $item) { // loop column
       if (@$_POST['search']['value']) { // if datatable send POST for search
         if ($i === 0) { 
           $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
           $this->db->like($item, $_POST['search']['value']);
         } else {
           $this->db->or_like($item, $_POST['search']['value']);
         }
         if (count($this->column_search) - 1 == $i) //last loop
           $this->db->group_end(); //close bracket
       }
       $i++;
     }
 
     if (isset($_POST['order'])) { // here order processing
       $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
     } else if (isset($this->order)) {
       $order = $this->order;
       $this->db->order_by(key($order), $order[key($order)]);
     }
   }
  // end data tables keranjang buku

  // proses simpan buku ke keranjnag peminjaman
  public function simpanBukuKeranjang($data){
    $insert=[
      'idUser'=>$this->session->userdata('email'),
      'kodeBuku'=>$data,
      'IdAnggota'=>$this->session->userdata('idAnggota'),
      'jenisPinjam'=>'R',
    ];
    $this->db->insert('k_peminjaman', $insert);
    return $this->db->affected_rows();

  }

  // function reset keranjnag peminjaman reguler
  public function resetKeranjangPeminjaman(){
    $cek=$this->db->get_where('k_peminjaman',['idUser'=>$this->session->userdata('email')])->num_rows();
    if($cek){
      $this->db->delete('k_peminjaman',['idUser'=>$this->session->userdata('email'),'	jenisPinjam'=>'R']);
      return $this->db->affected_rows();
    }
    else{
      return 1;
    }

  }

  // cek bukutamamu angota
  public function cekBukuTamu($id){
      $today = date("Ymd");
      $query = "SELECT * FROM bukutamu WHERE   idAnggota= '$id' AND tglKunjungan LIKE '$today%'";
      $data  = $this->db->query($query)->num_rows();
      return $data;
  }

  // proses hapus item keranjang buku
  public function hapusItemKeranjangBuku($id){
    $this->db->delete('k_peminjaman', ['id' => $id]);
    return $this->db->affected_rows();

  }

  // proses simpan peminjaman buku reguler
  public function prosesPinjaman(){
    $dataKeranjang=$this->db->get_where('k_peminjaman',['idUser'=>$this->session->userdata('email')])->result_array();
    foreach ($dataKeranjang as $value) {

      $insert=[
          'kodeBuku'=>$value['kodeBuku'],
          'IdAnggota'=>$value['IdAnggota'],
          'tglPinjam'=>date('y-m-d'),
          'status'=>1,
          'jenisPinjaman'=>$value['jenisPinjam'],
          'idUser'=>$this->session->userdata('email'),
      ];

      $update=[
        'statusPeminjaman'=>2
      ];

      $this->db->insert('peminjaman', $insert);
      $this->db->set($update);
      $this->db->where('kodeBuku', $value['kodeBuku']);
      $this->db->update('buku');
    }
      return $this->db->affected_rows();

  }

  // cek peminjaman berdasarkan kode buku / buku ini di pinjam siapa?
  public function cekPeminjamanByBuku($kode){
    $this->db->select('peminjaman.*, anggota.nama,kelas,');
    $this->db->from('peminjaman');
    $this->db->join('anggota', 'peminjaman.IdAnggota = anggota.id');
    $this->db->where('peminjaman.kodeBuku', $kode);
    return $this->db->get()->row_array();
  }

  // getdatapeminjamanById anggota
  public function getDataPinjamanByAnggota(){
    $this->db->select('peminjaman.*,buku.judul');
    $this->db->from('peminjaman');
    $this->db->join('buku', 'peminjaman.kodeBuku = buku.kodeBuku');
    $this->db->where([
                      'peminjaman.IdAnggota'=>$this->session->userdata('idAnggota'),
                      'peminjaman.status'=>1,
                      'peminjaman.jenisPinjaman'=>'R'
                      ]);
    $hasil['pendaftar']= $this->db->get()->result_array();

    $data = [];
    foreach ($hasil['pendaftar'] as $rank) {
      $row['judul'] = $rank['judul'];
      $row['lamaPinjam'] = $this->hitungHari($rank['tglPinjam']);
      $data[] = $row;
    }

    return $data;

  }

  // funtion hitung hari
  function hitungHari($awal){
    $booking      =new DateTime($awal);
    $today        =new DateTime();
    $diff         =$today->diff($booking);
    return $diff->d;
  }

  
}
