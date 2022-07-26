<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pendaftar_m extends CI_Model
{

  var $column_order = array(null, 'koreg', 'namaSiswa'); //set column field database for datatable orderable
  var $column_search = array('koreg', 'namaSiswa'); //set column field database for datatable searchable
  var $order = array('koreg' => 'asc'); // default order

  private function _get_datatables_query()
  {

    $this->db->select('pendaftar.*, jalur_ppdb.ppdb as namaJalur');
    $this->db->from('pendaftar');
    $this->db->join('jalur_ppdb', 'pendaftar.id_jalur = jalur_ppdb.id');
    $this->db->where('statusPendaftaran', 2);
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

  function get_datatables()
  {
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
    $this->db->from('pendaftar');
    return $this->db->count_all_results();
  }
  // akhir data tables verifikasi
  // ==============================================================================data kelulusan======================
  public function prosesResetByid($id)
  {
    $data = ['statusPendaftaran' => 2];
    $this->db->set($data);
    $this->db->where('id', $id);
    $this->db->update('pendaftar');
    return $this->db->affected_rows();
  }

  // cetak data lulus berdasarkan jalur 
  public function getDataLulusById($jalur)
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,`koreg`,tempatLahirSiswa,tanggalLahirSiswa,nisnSiswa,asalSekolah,namaAyah,namaIbu,tanggalRegister,kelRombel,`jalur_ppdb`.`ppdb`
    FROM `pendaftar`
    JOIN `jalur_ppdb` ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`lulus`=4  AND `pendaftar`.`id_jalur`=$jalur
    ";
    return $this->db->query($query)->result_array();
  }
  // print lulus satuan
  public function printDataLulusSatuan($koreg)
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,`koreg`,tempatLahirSiswa,tanggalLahirSiswa,nisnSiswa,asalSekolah,namaAyah,namaIbu,tanggalRegister,kelRombel,`jalur_ppdb`.`ppdb`
    FROM `pendaftar`
    JOIN `jalur_ppdb` ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`lulus`=4  AND `pendaftar`.`koreg`=$koreg
    ";
    return $this->db->query($query)->row_array();
  }

  // print tidaklulus satuan
  public function printDataTidakLulusSatuan($koreg)
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,`koreg`,tempatLahirSiswa,tanggalLahirSiswa,nisnSiswa,asalSekolah,namaAyah,namaIbu,tanggalRegister,kelRombel,`jalur_ppdb`.`ppdb`
    FROM `pendaftar`
    JOIN `jalur_ppdb` ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`lulus`=5  AND `pendaftar`.`koreg`=$koreg
    ";
    return $this->db->query($query)->row_array();
  }

  public function getDataTidakLulusByjalur($jalur)
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,`koreg`,tempatLahirSiswa,tanggalLahirSiswa,nisnSiswa,asalSekolah,namaAyah,namaIbu,tanggalRegister,`jalur_ppdb`.`ppdb`
    FROM `pendaftar`
    JOIN `jalur_ppdb` ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`lulus`=5  AND `pendaftar`.`id_jalur`=$jalur
    ";
    return $this->db->query($query)->result_array();
  }

  public function getDataLulusAll()
  {
    $query = "SELECT `pendaftar`.`id`,`namaSiswa`,`koreg`,totalNilai,jumlahRataRata,totalJarak,asalSekolah,id_jalur,namaIbu,tanggalRegister,`jalur_ppdb`.`ppdb`
    FROM `pendaftar`
    JOIN `jalur_ppdb` ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`lulus`=4 
    ";
    return $this->db->query($query)->result_array();
  }

  public function getDataTidakLulusAll()
  {
    $query = "SELECT `pendaftar`.`id`,`namaSiswa`,`koreg`,totalNilai,jumlahRataRata,totalJarak,asalSekolah,id_jalur,namaIbu,tanggalRegister,`jalur_ppdb`.`ppdb`
    FROM `pendaftar`
    JOIN `jalur_ppdb` ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`lulus`=5 
    ";
    return $this->db->query($query)->result_array();
  }
}
