<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Paket_m extends CI_Model
{

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
   var $order = array('id' => 'asc'); // default order


   private function _get_datatables_query()
   {
     
     $this->db->select('k_peminjaman.*, buku.kodeBuku, judul,tahun,pengarang');
     $this->db->from('k_peminjaman');
     $this->db->where('idUser',$this->session->userdata('email'));
     $this->db->join('buku', 'buku.kodeBuku = k_peminjaman.kodeBuku');
     $i = 0;
     foreach ($this->column_search as $item) { // loop column
       if (@$_POST['search']['value']) { // if datatable send POST for search
         if ($i === 0) { // first loop
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

  // cari anggota berdasarkan nama
  
  public function cariAnggota($key){
    $this->db->select('id,nama,kelas,nisn');
    $this->db->from('anggota');
    $this->db->or_like('nama', $key, 'both'); 
    $this->db->or_like('kelas', $key, 'both'); 
    // $this->db->or_like('nisn', $key, 'both'); 
    return $this->db->get()->result_array();

  }

  // proses simpan buku ke keranjnag peminjaman
  public function simpanBukuKeranjang($data){
    $insert=[
      'idUser'=>$this->session->userdata('email'),
      'kodeBuku'=>$data,
      'IdAnggota'=>$this->session->userdata('idAnggota'),
      'jenisPinjam'=>'P',
    ];
    $this->db->insert('k_peminjaman', $insert);
    return $this->db->affected_rows();

  }

  // function reset keranjnag peminjaman paket
  public function resetKeranjangPeminjaman(){
    $cek=$this->db->get_where('k_peminjaman',['idUser'=>$this->session->userdata('email')])->num_rows();
    if($cek){
      $this->db->delete('k_peminjaman',['idUser'=>$this->session->userdata('email'),'jenisPinjam'=>'P']);
      return $this->db->affected_rows();
    }
    else{
      return 1;
    }

  }

  // cek sukse data peminjaman untuk di print
  public function getDataPinjamanBelumKembali($id){
    $this->db->select('peminjaman.*,anggota.nama,.anggota.kelas, anggota.id ,buku.judul,buku.kodeBuku,buku.id AS `idBuku`');
    $this->db->from('peminjaman');
    $this->db->join('anggota', 'peminjaman.IdAnggota = anggota.id');
    $this->db->join('buku', 'peminjaman.kodeBuku = buku.kodeBuku');
    $this->db->where('peminjaman.IdAnggota', $id);
    $this->db->where('peminjaman.status', 1);
    $this->db->where('peminjaman.jenisPinjaman', 'P');
    $data['dataPinjaman']= $this->db->get()->result_array();
    $data['dataAnggota']= $this->db->get_where('anggota',['id'=>$id])->row_array();
    return $data;
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
           'jenisPinjaman'=>'P',
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
    public function cekPeminjamanByBukuPaket($kode){
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

  // ======================================================= blok pengembalian buku paket==========================================================
  public function resetPengembalianPaket(){
    $buku=$this->db->get_where('peminjaman',[
      'IdAnggota'=>$this->session->userdata('idAnggota'),
      'status'=> 1,
      'jenisPinjaman'=>'P'
      
     ])->result_array();

     $no=1;
     foreach($buku as $books){
          $this->db->delete('pengembalian',['idPinjam'=>$books['id']]);
          $no++;
      }
     
     return $no;
    // return $data['idPinjam'];
  }

    //  cek data buku yang dikembalikan masiah ada atau tidak
    public function cekDataBukuKembali($kodeBuku){
      return $this->db->get_where('peminjaman',[
        'IdAnggota'=>$this->session->userdata('idAnggota'),
        'kodeBuku'=>$kodeBuku,
        'status'=> 1,
        'jenisPinjaman'=>'P'
       ])->num_rows();
  
    }

    // cek pengembalian sudah ada apa belum
  public function cekDataBukusudahKembali($kodeBuku){
    $buku=$this->db->get_where('peminjaman',[
      'IdAnggota'=>$this->session->userdata('idAnggota'),
      'kodeBuku'=>$kodeBuku,
      'status'=> 1,
      'jenisPinjaman'=>'P'
      
     ])->row_array();

    return $this->db->get_where('pengembalian',[
      'idPinjam'=>$buku['id'],
      'idAnggota'=>$buku['IdAnggota'],
      'kodeBuku'=>$buku['kodeBuku'],
      'status'=>1
     ])->num_rows();

  }

   // update data buku pengembalian jika cocok
   public function updateDataKembali($kodeBuku){
    $buku=$this->db->get_where('peminjaman',[
      'IdAnggota'=>$this->session->userdata('idAnggota'),
      'kodeBuku'=>$kodeBuku,
      'status'=> 1,
      'jenisPinjaman'=>'P'
      
     ])->row_array();
     $denda=$this->hitungDenda($this->hitungHari($buku['tglPinjam']));

     $simpan=[
      'idPinjam'=>$buku['id'],
      'idAnggota'=>$buku['IdAnggota'],
      'kodeBuku'=>$buku['kodeBuku'],
      'idUser'=>$buku['idUser'],
      'tglKembali'=>date('y-m-d'),
      'denda'=> $denda['denda'],
      'status'=>1
     ];

      $this->db->insert('pengembalian', $simpan);
      return $this->db->affected_rows();

  }
  // cek jumlah buku yang akan dikembalikan dan denda nya
  public function cekJumlahBukuDenda(){
    $peminjaman=$this->db->get_where('peminjaman',[
      'IdAnggota'=>$this->session->userdata('idAnggota'),
      'status'=> 1,
      'jenisPinjaman'=>'P'
     ])->num_rows();

     $this->db->select('pengembalian.*, buku.judul, buku.kodeBuku');
     $this->db->from('pengembalian');
     $this->db->join('buku', 'pengembalian.kodeBuku = buku.kodeBuku');
     $this->db->where([
                       'pengembalian.idAnggota'=>$this->session->userdata('idAnggota'),
                       'pengembalian.status'=>1,
                       
                      ]);
     $pengembalian['pinjam']= $this->db->get()->result_array();
      $jml=0;
     foreach ( $pengembalian['pinjam'] as  $value) {
      $row['kodeBuku'] = $value['kodeBuku'];
      $row['denda']=$value['denda']+$value['denda'];
      $data[] = $row;
      $jml++;
     }
     $data['jumlahKembali']=$jml;
     $data['jumlahTidakKemabali']=$peminjaman- $jml;
     $data['pesan']='sukses';

     return $data;


  }

  // proses simpan pengembalian peminjaman reguler
  public function ProsesSimpanPengembalianPaket(){
    $peminjaman=$this->db->get_where('peminjaman',[
    'IdAnggota'=>$this->session->userdata('idAnggota'),
    'status'=> 1,
    'jenisPinjaman'=>'P'
   ])->result_array();

  

   $no=1;
   foreach($peminjaman as $kembali){
      if($this->db->get_where('pengembalian',
      [
        'idPinjam'=>$kembali['id'],
        'idAnggota'=>$this->session->userdata('idAnggota'),
        'status'=>1,
      
      ])->num_rows()>0
      ){
          $this->updateStatusBuku($kembali['kodeBuku']);
          $this->updatePengembalianBuku($kembali['id']);
          $this->updatePeminjamanBuku($kembali['id']);
      }

      $no++;
    }

    return $no;

  
}

  // function updateStatusBuku
  public function updateStatusBuku($kodeBuku){
    $update=[
      'statusPeminjaman'=>'1',
    ];
    $this->db->set($update);
    $this->db->where('kodeBuku',$kodeBuku);
    $this->db->update('buku');
  }

     // update status pengembalian buku
     public function updatePengembalianBuku($idPinjam){
      $update=[
        'status'=>'2',
      ];
      $this->db->set($update);
      $this->db->where('idPinjam',$idPinjam);
      $this->db->update('pengembalian');
    }

    // update status peminjaman buku
    public function updatePeminjamanBuku($id){
      $update=[
        'status'=>'2',
      ];
      $this->db->set($update);
      $this->db->where('id',$id);
      $this->db->update('peminjaman');
    }

   //  hitung denda
   function hitungDenda($lama){
    $setting=$this->db->get_where('setting',['id'=>1])->row_array();
    $lamaPinjam=$lama ;
    $dendaPerbuku=$setting['denda'];
    $maxLamaPinjam=$setting['maxKeterlambatan'];
    $terlamabat=$lamaPinjam-$maxLamaPinjam;
    $data['status']='';


    if($lamaPinjam >  $maxLamaPinjam){
       $data['status']='Lewat '.$terlamabat.' H';
       $data['denda']=($lamaPinjam-$maxLamaPinjam) * $dendaPerbuku;
    }elseif($lamaPinjam ==  $maxLamaPinjam){
      $data['denda']=0;
       $data['status']='Tepat';

    }
    elseif($lamaPinjam < $maxLamaPinjam){
      $data['status']='Tepat';
      $data['denda']=0;


   }
    return $data;

   }



  
}
