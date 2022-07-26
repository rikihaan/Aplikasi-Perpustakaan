<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Buku_model extends CI_Model
{
  
    // =========================blok eksekusi ajax di model=======
    
        // =====kumpulan block function=======
        public function getDataBukuAll(){
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
          $this->db->from('buku');
          return $this->db->count_all_results();
        }
        // ===== akhir kumpulan block funtion


        // block dasar query ajax
        var $column_order = array(null, 'kodeBuku', 'judul','tahun','kategori','pengarang'); //set column field database for datatable orderable
        var $column_search = array('kodeBuku', 'judul','tahun','kategori','pengarang'); //set column field database for datatable searchable
        var $order = array('judul' => 'asc'); // default order
        private function _get_datatables_query()
        {
          $this->db->select('buku.*, kategoribuku.kategori as kategoriBuku');
          $this->db->from('buku');
          $this->db->join('kategoribuku', 'buku.idKategori = kategoribuku.idKategori');
          $this->db->where('buku.barcodeStatus', 1);

          // $this->db->join('jalur_ppdb', 'pendaftar.id_jalur = jalur_ppdb.id');
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
        // end block query dasar ajax

    // akhir block eksekusi data ajax

    

    // =============================Proses  simpan cetak barcode====
       public function prosesSimpanCetak($data){
         $cek=$this->db->get_where('cetakbarcode',['idUser'=>$data['user'],'Kodebuku'=>$data['code']])->num_rows();
         if($cek){
          $this->db->delete('cetakbarcode', ['Kodebuku' => $data['code'],'idUser'=>$data['user']]);
          return $this->db->affected_rows();
         }
         else{
           $syarat = ['Kodebuku' => $data['code'], 'idUser' => $data['user']];
           $this->db->insert('cetakbarcode', $syarat);
           return $this->db->affected_rows();
         }
       }
    // end proses simpan cetak barcode========================================

    // proses import file buku dari excel
    public function insertimportDataBuku($data){
     
      $this->db->insert_batch('buku', $data);
    }
    // end proses import data buku dari excel

    public function cekKodeBuku($kode){
      return $this->db->get_where('buku',['kodeBuku'=>$kode])->row_array();
    }

    // proses simpan buku===============================================
    public function ProsesSimpanBuku($data){
      // memecah tahun terbit
      $tahunTerbit = str_split($data['tahun']);
      $tahunTerbit=$tahunTerbit[2].$tahunTerbit[3];

      // memecah tahun register
      $tahunReg = str_split($data['tahun']);
      $tahunReg=$tahunReg[0].$tahunReg[1];

      // taggal input
      $tglInput =date('y-m-d');
      $tglInput=explode("-", $tglInput);
      $tglInput=$tglInput[1];
      $bln=$tglInput[2];
      // kode clasifikasi
      $kodeKlasifikasi=$data['spesifiksi'];
      $kodeBuku= $tahunTerbit. $tahunReg.$tglInput.$kodeKlasifikasi.$bln;
      $KodeBukuNext=$this->buku->kodeBuku($kodeBuku);
      $newKodeBuku=$KodeBukuNext.mt_rand(1,9);
      $insert=[
        'idKategori'=>$data['kategoriBuku'],
        'kodeSpesifikasi'=>$data['spesifiksi'],
        'kodeBuku'=>  $newKodeBuku,
        'judul'=>$data['judul'],
        'tahun'=>$data['tahun'],
        'pengarang'=>$data['pengarang'],
        'jmlhHalaman'=>$data['jumlahHalaman'],
        'qty'=>1,
        'tglRegister'=>time(),
        'tglUpdate'=>time(),
        'statusPeminjaman'=>1,
        'statusBuku'=>1,
        'barcodeStatus'=>1,
        'sampul'=>1,
      ];
      $this->db->insert('buku', $insert);
      return $this->db->affected_rows();
    }
    // end proses simpan data buku=========================================

     // function kodebukuCopy
     public function kodebukuCopy($bahan)
     {
       $kodeMentah=$bahan.mt_rand(11,99);
       
       $query = "SELECT max(kodeBuku) AS last FROM buku WHERE kodeBuku LIKE '$kodeMentah%'";
      //  3+4+2
       $data = $this->db->query($query)->row_array();
       $lastKodeBuku = $data['last'];
       $lastNoUrut = substr($lastKodeBuku,9, 2);
       $nexKodeBuku = $lastNoUrut + 1;
       $newKodeBuku = $kodeMentah . sprintf('%02s', $nexKodeBuku);
       return $newKodeBuku;
     }

    // proses simpan copy buku===============================================
    public function ProsesSimpanCopyBuku($data){
      $id= isset($data['id'])? $data['id']:false;
      $jml= isset($data['jml'])? $data['jml']:false;
      $buku=$this->db->get_where('buku',['id'=>$id])->row_array();
      // memecah tahun terbit
      for ($i=1; $i <= $jml ; $i++) { 
      $kodeKlasifikasi=$buku['kodeSpesifikasi'];
      $tahunTerbit=$buku['tahun'];
      $KodeBukuNext=$this->kodebukuCopy($tahunTerbit.$kodeKlasifikasi);
      $newKodeBuku=$KodeBukuNext.mt_rand(1,9);
      $insert=[
        'idKategori'=>$buku['idKategori'],
        'kodeSpesifikasi'=>$buku['kodeSpesifikasi'],
        'kodeBuku'=>  $newKodeBuku,
        'judul'=>$buku['judul'],
        'tahun'=>$buku['tahun'],
        'pengarang'=>$buku['pengarang'],
        'jmlhHalaman'=>$buku['jmlhHalaman'],
        'qty'=>1,
        'tglRegister'=>time(),
        'tglUpdate'=>time(),
        'statusPeminjaman'=>1,
        'statusBuku'=>1,
        'barcodeStatus'=>1,
        'sampul'=>1,
      ];
      $this->db->insert('buku', $insert);
      }
      return $this->db->affected_rows();
    }
    // end proses simpan copy buku buku=========================================

    // peroses edit buku
     public function ProsesEditBuku($data){
         // memecah tahun terbit
      $tahunTerbit = str_split($data['tahun']);
      $tahunTerbit=$tahunTerbit[2].$tahunTerbit[3];

      // memecah tahun register
      $tahunReg = str_split($data['tahun']);
      $tahunReg=$tahunReg[0].$tahunReg[1];

      // taggal input
      $tglInput =date('y-m-d');
      $tglInput=explode("-", $tglInput);
      $tglInput=$tglInput[1];
      $bln=$tglInput[2];
      // kode clasifikasi
      $kodeKlasifikasi=$data['spesifiksi'];
      $kodeBuku= $tahunTerbit. $tahunReg.$tglInput.$kodeKlasifikasi.$bln;
      $KodeBukuNext=$this->kodeBuku($kodeBuku);
      $newKodeBuku=$KodeBukuNext.mt_rand(1,9);
      $insert=[
        'idKategori'=>$data['kategoriBuku'],
        'kodeSpesifikasi'=>$data['spesifiksi'],
        'kodeBuku'=>  $newKodeBuku,
        'judul'=>$data['judul'],
        'tahun'=>$data['tahun'],
        'pengarang'=>$data['pengarang'],
        'jmlhHalaman'=>$data['jumlahHalaman'],
        'statusBuku'=>1,
        'tglUpdate'=>time(),
      ];
      $this->db->set($insert);
      $this->db->where('id', $data['id']);
      $this->db->update('buku');
      return $this->db->affected_rows();
     }
    // end proses edit buku

    // hapus data buku
    public function prosesHapusBuku($id){
      $this->db->delete('buku', ['id' => $id]);
      return $this->db->affected_rows();

    }
    // end hapus data buku

    // ambil data buku dengan id by ajax=======================
    public function getDataBukuById($id){
        $this->db->select('buku.*, kategoribuku.kategori as kategoriBuku,kategoribuku.idKategori');
        $this->db->from('buku');
        $this->db->join('kategoribuku', 'buku.idKategori = kategoribuku.idKategori');
        $this->db->where('kodeBuku', $id);
        return $this->db->get()->row_array();

      // return $this->db->row();
    }
    // end ambil data buku by id by ajax

    // ambil buku untuk di copy
    public function getDataBukuCopyById($id){
      $this->db->select('buku.*, kategoribuku.kategori as kategoriBuku,kategoribuku.idKategori');
      $this->db->from('buku');
      $this->db->join('kategoribuku', 'buku.idKategori = kategoribuku.idKategori');
      $this->db->where('id', $id);
      return $this->db->get()->row_array();

    // return $this->db->row();
  }

 

    // function kodebuku
    public function kodeBuku($bahan)
    {
      
      $query = "SELECT max(kodeBuku) AS last FROM buku WHERE kodeBuku LIKE '$bahan%'";
      $data = $this->db->query($query)->row_array();
      $lastKodeBuku = $data['last'];
      $lastNoUrut = substr($lastKodeBuku,9, 2);
      $nexKodeBuku = $lastNoUrut + 1;
      $newKodeBuku = $bahan . sprintf('%02s', $nexKodeBuku);
      return $newKodeBuku;
    }
    // end kode buku
}