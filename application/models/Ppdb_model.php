<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ppdb_model extends CI_Model
{
  public function getDataSyarat()
  {
    $query = "SELECT `persyaratan`.*,`jalur_ppdb`.`ppdb` 
            FROM `persyaratan` JOIN `jalur_ppdb`
            ON `persyaratan`.`id_jalur`=`jalur_ppdb`.`id`
            ORDER BY `persyaratan`.`id_jalur` ASC
    ";
    return $this->db->query($query)->result_array();
  }

  public function getDataPendaftar()
  {
    $query = "SELECT `pendaftar`.*,`jalur_ppdb`.`ppdb` 
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    ORDER BY `pendaftar`.`id_jalur` ASC
";
    return $this->db->query($query)->result_array();
  }

  public function rangkingPendaftar()
  {
    $query = "SELECT namaSiswa,totalNilai,
    ( SELECT find_in_set( totalNilai,
    ( SELECT group_concat(distinct totalNilai  order by totalNilai DESC )from pendaftar))) as rangking
    from pendaftar ";
    return $this->db->query($query)->result_array();
  }

  public function  getJumlahDataJalur()
  {
    $query = "SELECT  COUNT(`pendaftar`.`id_jalur`) AS jlmPendaftar ,`jalur_ppdb`.*,`pendaftar`.* 
    FROM `jalur_ppdb` JOIN `pendaftar`
    ON `jalur_ppdb`.`id`=`pendaftar`.`id_jalur`
   
    GROUP BY `pendaftar`.`id_jalur`
    ORDER BY `pendaftar`.`id_jalur` ASC";
    return $this->db->query($query)->result_array();
  }

  public function getDataPpdb()
  {
    return $this->db->get('jalur_ppdb')->result_array();
  }


  public function simpanSyarat($data)
  {
    $syarat = ['id_jalur' => $data['jalur'], 'persyaratan' => $data['syarat']];
    $this->db->insert('persyaratan', $syarat);
    return $this->db->affected_rows();
  }

  public function getDataSyaratById($id)
  {
    $query = "SELECT `persyaratan`.*,`jalur_ppdb`.`ppdb`
    FROM `persyaratan` JOIN `jalur_ppdb`
    ON `persyaratan`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `persyaratan`.`id`=$id
    ORDER BY `persyaratan`.`id_jalur` ASC
";
    return $this->db->query($query)->row_array();
  }

  public function prosesEdit($data)
  {

    $edit = [
      'id_jalur' => $data['jalur'],
      'persyaratan' => $data['syarat']
    ];
    $this->db->set($edit);
    $this->db->where('id', $data['idSyarat']);
    $this->db->update('persyaratan');
    return $this->db->affected_rows();
  }

  public function getJalurId($id)
  {
    return $this->db->get_where('jalur_ppdb', ['id' => $id])->row_array();
  }

  public function prosesEditJalur($form)
  {
    $edit = [
      'ppdb' => $form['jalur'],
      'quota' => $form['quota'],
      'input_nilai' => $form['input_nilai'],
      'inputPrestasi' => $form['inputPrestasi'],
      'statusAktif' => $form['statusAktif'],
    ];
    $this->db->set($edit);
    $this->db->where('id', $form['idJalur']);
    $this->db->update('jalur_ppdb');
    return $this->db->affected_rows();
  }

  public function prosesHapusJalur($id)
  {
    $this->db->delete('jalur_ppdb', ['id' => $id]);
    return $this->db->affected_rows();
  }

  public function simpanJalurPPDB($data)
  {

    $simpan = [
      'ppdb' => $data['jalur'],
      'quota' => $data['quota'],
      'input_nilai' => $data['input_nilai'],
      'inputPrestasi' => $data['inputPrestasi'],
    ];
    $this->db->insert('jalur_ppdb', $simpan);
    return $this->db->affected_rows();
  }


  // untuk nilai prestasi

  public function prosesSimpanPrestasi($form)
  {

    $data = [

      'kejuaraan' => $form['tingkat'],
      'id_satuan' => $form['kategori'],
      'score' => $form['nilaiPrestasi']
    ];

    $this->db->insert('prestasi', $data);
    return $this->db->affected_rows();
  }

  public function prosesEditNilaiPrestasi($form)
  {
    $data = [
      'kejuaraan' => $form['tingkat'],
      'id_satuan' => $form['kategori'],
      'score' => $form['nilaiPrestasi']
    ];

    $this->db->set($data);
    $this->db->where('id', $form['idPrestasi']);
    $this->db->update('prestasi');
    return $this->db->affected_rows();
  }

  public function prosesHapusPrestasi($id)
  {
    $this->db->delete('prestasi', ['id' => $id]);
    return $this->db->affected_rows();
  }

  // untuk informasi
  public function simpanInformasi($form)
  {
    $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data = [
      'title' => $form['titleInformasi'],
      'deskripsi' => $form['deskripsi'],
      'date_created' => time(),
      'by_created' => $user['user']['name'],
      'is_active' => '1',
      'is_headline' => '1'
    ];
    $this->db->insert('informasi', $data);
    return $this->db->affected_rows();
  }

  public function getDataInformasiByid($id)
  {
    return $this->db->get_where('informasi', ['id' => $id])->row_array();
  }

  public function prosesEditInformasi($form)
  {
    $data = [
      'title' => $form['titleInformasi'],
      'deskripsi' => $form['deskripsi'],
      'is_headline' => $form['jumboTron']
    ];
    $this->db->set($data);
    $this->db->where('id', $form['idInformasi']);
    $this->db->update('informasi');
    return $this->db->affected_rows();
  }

  public function prosesHapusInformasi($id)
  {
    $this->db->delete('informasi', ['id' => $id]);
    return $this->db->affected_rows();
  }

  public function getJumlahDaftar($jalur)
  {
    return $this->db->get_where('pendaftar', ['statusPendaftaran' => $jalur])->num_rows();
  }

  // batas informasi method

  // batas awal data tables
  // start datatables
  var $column_order = array(null, 'koreg', 'namaSiswa', 'totalNilai', 'totalJarak'); //set column field database for datatable orderable
  var $column_search = array('koreg', 'namaSiswa'); //set column field database for datatable searchable
  var $order = array('totalNilai' => 'desc'); // default orders

  private function _get_datatables_query()
  {
    $this->db->select('pendaftar.*, jalur_ppdb.ppdb as namaJalur');
    $this->db->from('pendaftar');
    $this->db->join('jalur_ppdb', 'pendaftar.id_jalur = jalur_ppdb.id');
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


  // get data tables all

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
  // end datatables all



  // data tables ke 1

  function get_datatables1()
  {
    $this->_get_datatables_query1();
    if (@$_POST['length'] != -1)
      $this->db->limit(@$_POST['length'], @$_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }


  private function _get_datatables_query1()
  {
    $this->db->select('pendaftar.*, jalur_ppdb.ppdb as namaJalur');
    $this->db->from('pendaftar');
    $this->db->where('id_jalur', 1);
    $this->db->join('jalur_ppdb', 'pendaftar.id_jalur = jalur_ppdb.id');
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

  // batas akhir data tables ke 1

  // get data yg Tidaklulus
  public function getDataTidakLulus()
  {
    $query = "SELECT `pendaftar`.*,`jalur_ppdb`.`ppdb` 
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
   WHERE `pendaftar`.`lulus` =5";
    return $this->db->query($query)->result_array();
  }

  // get data yg lulus
  public function getDataLulus()
  {
    $query = "SELECT `pendaftar`.*,`jalur_ppdb`.`ppdb` 
     FROM `pendaftar` JOIN `jalur_ppdb`
     ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`lulus` =4";
    return $this->db->query($query)->result_array();
  }


  public function ambilDataPendaftarByjalur($jalur)
  {

    $query = "SELECT `pendaftar`.`namaSiswa`,totalNilai,totalJarak,asalSekolah,koreg,statusPendaftaran,`pendaftar`.`id`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= $jalur
    ORDER BY `pendaftar`.`totalJarak` ASC ,`pendaftar`.`totalNilai` DESC ";
    return $this->db->query($query)->result_array();
  }


  public function getDataKategoriNilaiAkademik()
  {
    $query = "SELECT `kat_satuan`.*,`prestasi`.*,`kategori_penyelengara`.*
    FROM `kat_satuan`
   JOIN `prestasi`
    ON `prestasi`.`id_satuan`=`kat_satuan`.`id_satuan`

    JOIN `kategori_penyelengara`
    ON `kategori_penyelengara`.`id_penyelengara`=`kat_satuan`.`id_penyelengara`
    
    ";
    return $this->db->query($query)->result_array();
  }


  public function getdataPendaftarByUser($key)
  {
    if ($this->db->get_where('pendaftar', ['koreg' => $key])->num_rows() > 0) {
      $data = $this->db->get_where('pendaftar', ['koreg' => $key])->row_array();
      $jalur = $data['id_jalur'];
      // cek data jika sudah di verifikasi
      if ($data['statusPendaftaran'] == 2) {
        // jika jalur prestasi akademik dan non akademik
        if ($data['id_jalur'] == 4) {
          $query = "SELECT  `namaSiswa`,`jumlahRataRata`,`noUrut`,`nilaiPraktekPrestasi`,`lulus`,`id_jalur`,`idPrestasi`,`asalSekolah`,`totalNilai`,`totalJarak`,`statusPendaftaran`,`nilaiPrestasi`,`koreg`,`usiaSiswa`,`rataRataTotalNilai`,`jalur_ppdb`.*
        FROM `pendaftar`
       JOIN `jalur_ppdb`
        ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
        WHERE id_jalur = $jalur and statusPendaftaran=2
        ORDER BY nilaiPrestasi DESC, totalJarak ASC, usiaSiswa DESC, jumlahRataRata DESC";
          // jika jalur rerata raport
        } elseif ($data['id_jalur'] == 6) {
          $query = "SELECT  `namaSiswa`,`noUrut`,`nilaiPraktekPrestasi`,`lulus`,`jumlahRataRata`,id_jalur,`idPrestasi`,`asalSekolah`,`totalNilai`,`totalJarak`,`statusPendaftaran`,`nilaiPrestasi`,`usiaSiswa`,`koreg`,`rataRataTotalNilai`,`jalur_ppdb`.*
        FROM `pendaftar`
       JOIN `jalur_ppdb`
        ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
        WHERE id_jalur = $jalur and statusPendaftaran=2
        ORDER BY jumlahRataRata DESC, totalJarak ASC, usiaSiswa DESC";
        } else {
          // jika mengatur jarak
          $query = "SELECT  `namaSiswa`,`noUrut`,`nilaiPraktekPrestasi`,`lulus`,`jumlahRataRata`,id_jalur,`idPrestasi`,`asalSekolah`,`totalNilai`,`statusPendaftaran`,`totalJarak`,`nilaiPrestasi`,`rataRataTotalNilai`,`koreg`,`usiaSiswa`,`jalur_ppdb`.*
     FROM `pendaftar`
     JOIN `jalur_ppdb`
      ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
      WHERE id_jalur = $jalur and statusPendaftaran=2 
      ORDER BY totalJarak ASC, usiaSiswa DESC, jumlahRataRata DESC";
        }
      }
      // jika belum verifikasi tidak lulus  atau cabut berkas
      else {
        // jika jalur prestasi akademik dan non akademik
        if ($data['id_jalur'] == 4) {
          $query = "SELECT  `namaSiswa`,`jumlahRataRata`,`noUrut`,`nilaiPraktekPrestasi`,`lulus`,`id_jalur`,`idPrestasi`,`asalSekolah`,`totalNilai`,`totalJarak`,`statusPendaftaran`,`nilaiPrestasi`,`koreg`,`usiaSiswa`,`rataRataTotalNilai`,`jalur_ppdb`.*
        FROM `pendaftar`
       JOIN `jalur_ppdb`
        ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
        WHERE id_jalur = $jalur
        ORDER BY nilaiPrestasi DESC, totalJarak ASC, usiaSiswa DESC, jumlahRataRata DESC";
          // jika jalur rerata raport
        } elseif ($data['id_jalur'] == 6) {
          $query = "SELECT  `namaSiswa`,`noUrut`,`nilaiPraktekPrestasi`,`lulus`,`jumlahRataRata`,id_jalur,`idPrestasi`,`asalSekolah`,`totalNilai`,`totalJarak`,`statusPendaftaran`,`nilaiPrestasi`,`usiaSiswa`,`koreg`,`rataRataTotalNilai`,`jalur_ppdb`.*
        FROM `pendaftar`
       JOIN `jalur_ppdb`
        ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
        WHERE id_jalur = $jalur
        ORDER BY jumlahRataRata DESC, totalJarak ASC, usiaSiswa DESC";
        } else {
          // jika mengatur jarak
          $query = "SELECT  `namaSiswa`,`noUrut`,`nilaiPraktekPrestasi`,`lulus`,`jumlahRataRata`,id_jalur,`idPrestasi`,`asalSekolah`,`totalNilai`,`statusPendaftaran`,`totalJarak`,`nilaiPrestasi`,`rataRataTotalNilai`,`koreg`,`usiaSiswa`,`jalur_ppdb`.*
     FROM `pendaftar`
     JOIN `jalur_ppdb`
      ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
      WHERE id_jalur = $jalur 
      ORDER BY totalJarak ASC, usiaSiswa DESC, jumlahRataRata DESC";
        }
      }

      $hasil['pendaftar'] = $this->db->query($query)->result_array();
      $no = 1;
      $data = [];
      foreach ($hasil['pendaftar'] as $rank) {
        $row['rank'] = $no++;
        $row['koreg'] = $rank['koreg'];
        $row['nama'] = $rank['namaSiswa'];
        $row['lulus'] = $rank['lulus'];
        $row['nilai'] = $rank['totalNilai'];
        $row['jarak'] = $rank['totalJarak'];
        $row['id_jalur'] = $rank['id_jalur'];
        $row['idPrestasi'] = $rank['idPrestasi'];
        $row['ppdb'] = $rank['ppdb'];
        $row['usia'] = $rank['usiaSiswa'];
        $row['noUrut'] = $rank['noUrut'];
        $row['sekolah'] = $rank['asalSekolah'];
        $row['rataRata'] = $rank['rataRataTotalNilai'];
        $row['jumlahRataRata'] = $rank['jumlahRataRata'];
        $row['nilaiPrestasi'] = $rank['nilaiPrestasi'];
        $row['nilaiPraktekPrestasi'] = $rank['nilaiPraktekPrestasi'];
        $row['statusPendaftaran'] = $rank['statusPendaftaran'];
        // $row['totalDaftar'] = $rank['totalDaftar'];
        $row['quota'] = $rank['quota'];

        $data[$rank['koreg']] = $row;
      }
      return ($data[$key]);
    } else {
      return  2;
    }
  }

  public function getJumlahBydJalur($idjalur)
  {
    $data = [];
    $query = "SELECT `pendaftar`.`koreg`, `jalur_ppdb`.`ppdb`,
              COUNT(*) as jumlahDaftar,
              SUM(statusPendaftaran=1)as belumVErifikasi,
              SUM(statusPendaftaran=2) as terVerifikasi,
              SUM(statusPendaftaran=4) as lulus,
              SUM(statusPendaftaran=5) as Tidaklulus,
              SUM(statusPendaftaran=3) as pindah
              FROM pendaftar JOIN jalur_ppdb ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
              WHERE `pendaftar`.`id_jalur`=$idjalur
              ";
    $data = $this->db->query($query)->row_array();
    return $data;
  }


  function tanggal_indonesia($tanggal)
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

    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
  }

  public function getDataPendaftarDiterima()
  {
    $query = "SELECT `pendaftar`.*,`jalur_ppdb`.`ppdb` 
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`lulus`=4
    ORDER BY `pendaftar`.`id_jalur` ASC
";
    return $this->db->query($query)->result_array();
  }

  public function getDataLulusExcel()
  {
    $query = "SELECT `pendaftar`.*,`jalur_ppdb`.`ppdb` 
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`lulus`=4
    ORDER BY `pendaftar`.`id_jalur` ASC
";
    return $this->db->query($query)->result_object();
  }

  public function getDataForExcel()
  {
    $query = "SELECT `pendaftar`.*,`jalur_ppdb`.`ppdb`,`districts`.`name` as kecamatanNya,`villages`.`name`as desaNya,`regencies`.`name`as kotaNya,`province_id`,`provinces`.`name` as provinsiNya
    FROM `pendaftar` 
    JOIN `jalur_ppdb` ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    JOIN `districts` ON `pendaftar`.`kecamatan`=`districts`.`id`
    JOIN `villages` ON `pendaftar`.`desa`=`villages`.`id`
    JOIN `regencies` ON `pendaftar`.`kabKota`=`regencies`.`id`
    JOIN `provinces` ON `provinces`.`id`=`regencies`.`province_id`
    ORDER BY `pendaftar`.`id_jalur` ASC";
    return $this->db->query($query)->result_object();
  }

  public function getMinmax($jalur)
  {
    // jumlah pendaftar dan jalur
    $query = "SELECT `pendaftar`.`statusPendaftaran`,`jalur_ppdb`.`ppdb`, 
     COUNT(*) as jumlahPendaftar,
    SUM(statusPendaftaran = 2) as jumlahVerifiksi,
    SUM(statusPendaftaran = 1) as jumlahTidakVerifiksi,
    SUM(statusPendaftaran = 3) as jumlahPindah,
    SUM(statusPendaftaran = 4) as lulus,
    SUM(statusPendaftaran = 5) as tidakLulus
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
   WHERE `pendaftar`.`id_jalur`=$jalur 
  ";
    // nilai nya 
    $query2 = "SELECT `pendaftar`.`jumlahRataRata`,`totalJarak`,`nilaiPrestasi`,`statusPendaftaran`,
  MAX(jumlahRataRata) as maxrataRataNilai, 
  MIN(jumlahRataRata) as minrataRataNilai,
  MAX(totalJarak) as maxTotalJarak,
  MIN(totalJarak) as minTotalJarak,
  MAX(nilaiPrestasi) as maxNilaiPrestasi,
  MIN(nilaiPrestasi) as minNilaiPrestasi
  FROM `pendaftar` 
 WHERE `statusPendaftaran` = 2 and `id_jalur`=$jalur";

    $data['pdfr'] = $this->db->query($query)->row_array();
    $data['nilai'] = $this->db->query($query2)->row_array();
    return $data;
  }
  // public function getMinmax()
  // {
  //   $query = "SELECT `pendaftar`.*,`jalur_ppdb`.`ppdb`, 
  //   COUNT(*) as jumlahPendaftar,
  //   SUM(statusPendaftaran = 2) as jumlahVerifiksi,
  //   SUM(statusPendaftaran = 1) as jumlahTidakVerifiksi,
  //   SUM(statusPendaftaran = 3) as jumlahPindah,
  //   SUM(statusPendaftaran = 4) as lulus,
  //   SUM(statusPendaftaran = 5) as tidakLulus,
  //   MAX(jumlahRataRata) as maxrataRataNilai, 
  //   MIN(jumlahRataRata) as minrataRataNilai,
  //   MAX(totalJarak) as maxTotalJarak,
  //   MIN(totalJarak) as minTotalJarak,
  //   MAX(nilaiPrestasi) as maxNilaiPrestasi,
  //   MIN(nilaiPrestasi) as minNilaiPrestasi
  //   FROM `pendaftar` JOIN `jalur_ppdb`
  //   ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
  //   GROUP BY `id_jalur`
  //   ORDER BY `pendaftar`.`id_jalur` ASC 
  // ";
  //   return $this->db->query($query)->result_array();
  // }
}
