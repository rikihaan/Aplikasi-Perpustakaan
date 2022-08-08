<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Anggota_model extends CI_Model
{
  // =========================blok eksekusi ajax di model=======

  // =====kumpulan block function=======
  public function getDataAnggotaAll()
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
    $this->db->from('anggota');
    return $this->db->count_all_results();
  }
  // ===== akhir kumpulan block funtion


  // block dasar query ajax
  var $column_order = array(null, 'id', 'nama', 'kelas'); //set column field database for datatable orderable
  var $column_search = array('id', 'nama', 'kelas'); //set column field database for datatable searchable
  var $order = array('kelas' => 'asc'); // default order
  private function _get_datatables_query()
  {
    $this->db->select('*');
    $this->db->from('anggota');
    //   $this->db->join('kategoribuku', 'buku.idKategori = kategoribuku.idKategori');
    //   $this->db->where('statusPendaftaran', 1);

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
  // end bloc query dasar ajax

  // akhir block eksekusi data ajax data tables

  // function proses simpan data anggota
  public function ProsesSimpanAnggota($data)
  {
    $insert = [
      'id' => $this->kodeAnggota(),
      'nama' => $data['nama'],
      'kelas' => $data['kelas'],
      'nis' => $data['nis'],
      'nisn' => $data['nisn'],
      'alamat' => $data['alamat'],
      'tglRegister' => time(),
      'foto' => 'profil.jpg',
      'status' => 1,
    ];
    $this->db->insert('anggota', $insert);
    return $this->db->affected_rows();
  }

  // prosses edit data anggota
  public function ProsesEditAnggota($data)
  {
    $insert = [
      'nama' => $data['nama'],
      'kelas' => $data['kelas'],
      'nis' => $data['nis'],
      'nisn' => $data['nisn'],
      'alamat' => $data['alamat'],
      'tglRegister' => time(),
    ];
    $this->db->set($insert);
    $this->db->where('id', $data['id']);
    $this->db->update('anggota');
    return $this->db->affected_rows();
  }

  //  function hapus data anggota
  public function prosesHapusAnggota($id)
  {
    $this->db->delete('anggota', ['id' => $id]);
    return $this->db->affected_rows();
  }
  // end hapus data anggota

  public function getKode()
  {
    return $this->kodeAnggota();
  }



  // function kode anggota
  private function kodeAnggota()
  {
    $today = date("Y");
    $kodeMentah = $today . mt_rand(111, 333) . mt_rand(11, 99);
    $query = "SELECT max(id) AS last FROM anggota WHERE id LIKE '$kodeMentah%'";
    //  3+4+2
    $data = $this->db->query($query)->row_array();
    $lastKodeBuku = $data['last'];
    $lastNoUrut = substr($lastKodeBuku, 9, 2);
    $nexKodeBuku = $lastNoUrut + 1;
    $newKodeBuku = $kodeMentah . sprintf('%02s', $nexKodeBuku);
    return $newKodeBuku . mt_rand(1, 9);
  }
  // end kode buku

  // get data anggota by id
  public function getDataAnggotaById($id)
  {
    $this->db->select('anggota.*, kelas.kelas,kelas.kodeKelas');
    $this->db->from('anggota');
    $this->db->join('kelas', 'anggota.kelas = kelas.kodeKelas');
    $this->db->where('id', $id);
    return $this->db->get()->row_array();
  }

  public function akfinNonAktif($id)
  {
    $this->db->select('*');
    $this->db->from('anggota');
    $this->db->where('id', $id);
    $anggota = $this->db->get()->row_array();
    $statusAnggota = null;
    if ($anggota['status'] == 1) {
      $statusAnggota = 0;
    } else if ($anggota['status'] == 0) {
      $statusAnggota = 1;
    }

    // update
    $insert = [
      'status' => $statusAnggota,
    ];
    $this->db->set($insert);
    $this->db->where('id', $anggota['id']);
    $this->db->update('anggota');
    return $this->db->affected_rows();
  }

  public function prosesUpdateSiswa($nisn)
  {
    // var_dump($nisn);
    // die;
    $insert = [
      'nama' => $nisn['nama'],
      'nis' => $nisn['nis'],
      'kelas' => $nisn['kelas'],
    ];
    $this->db->set($insert);
    $this->db->where('nisn', $nisn['nisn']);
    $this->db->update('anggota');
  }

  // export data anggota berdasarkan kelas yang di pilih
  public function exportDataAnggota($kelas)
  {
    $this->db->select('anggota.*, kelas.kelas,kelas.kodeKelas');
    $this->db->from('anggota');
    $this->db->join('kelas', 'anggota.kelas = kelas.kodeKelas');
    $this->db->where('anggota.kelas', $kelas);
    return $this->db->get()->result_array();
  }
}
