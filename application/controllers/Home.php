<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Ppdb_model', 'ppdb');
  }

  public function index()
  {
    $data['title'] = "Home";
    $data['dataJalur'] = $this->db->get_where('jalur_ppdb', ['statusAktif' => 1])->result_array();
    $data['informasi'] = $this->db->get('informasi')->result_array();
    $data['ninMax1'] = $this->ppdb->getMinmax(1);
    $data['ninMax2'] = $this->ppdb->getMinmax(2);
    $data['ninMax3'] = $this->ppdb->getMinmax(3);
    $data['ninMax4'] = $this->ppdb->getMinmax(4);
    $data['ninMax5'] = $this->ppdb->getMinmax(5);
    $data['ninMax6'] = $this->ppdb->getMinmax(6);
    $data['jlmPendaftar'] = $this->db->get('pendaftar')->num_rows();
    $data['jlmPendaftarVerifikasi'] = $this->ppdb->getJumlahDaftar(2);
    $data['jlmPendaftarProses'] = $data['jlmPendaftar'] - $data['jlmPendaftarVerifikasi'];
    $data['jalurPpdb'] = $this->db->get_where('jalur_ppdb', ['statusAktif' => 1])->result_array();
    $data['setting'] = $this->db->get('kop_surat')->row_array();
    $this->load->view('themplate/Home/header', $data);
    $this->load->view('Home/index', $data);
    $this->load->view('themplate/Home/footer', $data);
  }

  public function getDataPendaftarByJalur()
  {
    echo json_encode($this->ppdb->ambilDataPendaftarByjalur($_POST['id']));
  }
  // baca info
  public function bacaInfo()
  {
    echo json_encode($this->db->get_where('informasi', ['id' => $_POST['id']])->row_array());
  }
  public function cekNISN()
  {
    $jml = $this->db->get_where('pendaftar', ['nisnSiswa' => $_POST['nisnSiswa']])->num_rows();
    if ($jml > 0) {
      echo 'false';
    } else {
      echo 'true';
    }
  }
  public function cekNIK()
  {
    $jml = $this->db->get_where('pendaftar', ['nikSiswa' => $_POST['nikSiswa']])->num_rows();
    if ($jml > 0) {
      echo 'false';
    } else {
      echo 'true';
    }
  }
  public function dataTabelInformasi()
  {
    $list = $this->ppdb->get_datatables();
    // var_dump($list);
    // die;
    $data = array();
    $no = @$_POST['start'];
    foreach ($list as $item) {
      $no++;
      $row = array();
      $row[] = $no . ".";
      $row[] = $item->koreg;
      $row[] = $item->namaSiswa;
      $row[] = $item->totalJarak;
      $row[] = $item->totalNilai;
      $row[] = $item->namaJalur;
      $row[] = '<img src="' . base_url('assets/HomeAssets/img/logo/') . $item->statusPendaftaran . '.svg" width="15">';
      $data[] = $row;
    }
    $output = array(
      "draw" => @$_POST['draw'],
      "recordsTotal" => $this->ppdb->count_all(),
      "recordsFiltered" => $this->ppdb->count_filtered(),
      "data" => $data,
    );
    // output to json format

    echo json_encode($output);
  }
  // dataTables Ke 1
  public function dataTabelInformasi1()
  {
    $list = $this->ppdb->get_datatables1();
    // var_dump($list);
    // die;
    $data = array();
    $no = @$_POST['start'];
    foreach ($list as $item) {
      $no++;
      $row = array();
      $row[] = $no . ".";
      $row[] = $item->koreg;
      $row[] = $item->namaSiswa;
      $row[] = $item->totalJarak;
      $row[] = $item->totalNilai;
      $row[] = $item->namaJalur;
      $row[] = '<img src="' . base_url('assets/HomeAssets/img/logo/') . $item->statusPendaftaran . '.svg" width="15">';
      $data[] = $row;
    }
    $output = array(
      "draw" => @$_POST['draw'],
      "recordsTotal" => $this->ppdb->count_all(),
      "recordsFiltered" => $this->ppdb->count_filtered(),
      "data" => $data,
    );
    // output to json format

    echo json_encode($output);
  }

  // batas Akhir Data Tables Ke 1

  // cek data informasi
  public function cekDataPendaftar()
  {
    echo json_encode($this->ppdb->getdataPendaftarByUser($_POST['key']));
  }

  public function getDataUrlByIdJalur()
  {
    echo json_encode($this->ppdb->getJumlahBydJalur($_POST['id']));
  }

  public function Sukses()
  {
    $data['setting'] = $this->db->get('kop_surat')->row_array();
    $data['title'] = "Home";
    $data['pendaftar'] = $this->db->get_where('pendaftar', ['koreg' => $this->session->userdata('koreg')])->row_array();
    $this->load->view('themplate/Home/header', $data);
    $this->load->view('Home/Sukses', $data);
    $this->load->view('themplate/Home/footer', $data);
  }


  public function Pendaftaran()
  {
    // var_dump($_POST);
    // die;
    $data['title'] = "Pendaftaran";
    $data['jalurPpdb'] = $this->db->get_where('jalur_ppdb', ['statusAktif' => 1])->result_array();
    $data['setting'] = $this->db->get('kop_surat')->row_array();
    $data['provinsi'] = $this->db->get('provinces')->result_array();
    $data['prestasi'] = $this->db->get('kategori_penyelengara')->result_array();

    $this->form_validation->set_rules($this->ruleValidation());
    if ($this->form_validation->run() == false) {
      $this->load->view('themplate/Home/header', $data);
      $this->load->view('Home/Pendaftaran', $data);
      $this->load->view('themplate/Home/footer');
    } else {
      $this->load->model('Daftar_model', 'daftar');
      if ($this->daftar->simpanDaftar($_POST) > 0) {
        $this->session->set_flashdata('message', 'Berhasil');
        redirect('Home/Sukses');
      }
    }
  }


  public function getDataNilaiPrestasiByIdTingkat()
  {
    $id = $_POST['id'];
    echo json_encode($this->db->get_where('prestasi', ['id' => $id])->row_array());
  }

  public function getDataKategoriByidPeyelengara()
  {
    $id = $_POST['id'];
    echo json_encode($this->db->get_where('kat_satuan', ['id_penyelengara' => $id])->result_array());
  }

  public function getDatatingkatByidKategori()
  {
    $id = $_POST['id'];
    echo json_encode($this->db->get_where('prestasi', ['id_satuan' => $id])->result_array());
  }

  public function getDataKotaByIdProv()
  {
    $id = $_POST['id'];
    echo json_encode($this->db->get_where('regencies', ['province_id' => $id])->result_array());
  }

  public function getDataKecamatanByIdKota()
  {
    $id = $_POST['id'];
    echo json_encode($this->db->get_where('districts', ['regency_id' => $id])->result_array());
  }

  public function getDataDesaByIdKecamatan()
  {
    $id = $_POST['id'];
    echo json_encode($this->db->get_where('villages', ['district_id' => $id])->result_array());
  }

  public function getDataJalurPpdb()
  {
    echo json_encode($this->db->get_where('jalur_ppdb', ['id' => $_POST['id']])->row_array());
  }
  public function cetak($reg)
  {
    // $this->load->library('dompdf_gen');
    $data['sekolah'] = $this->db->get('kop_surat')->row_array();
    $sekolah = $data['sekolah']['nama_sekolah'];
    $query = "SELECT `jalur_ppdb`.`ppdb`, `pendaftar`.*,`villages`.`name` as desa, `districts`.`name` as kec, `regencies`.`name` as kot,`provinces`.`name` as prov
    FROM `pendaftar` 
    JOIN `jalur_ppdb` ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    JOIN `villages` ON `pendaftar`.`desa`=`villages`.`id`
    JOIN `districts` ON `villages`.`district_id`=`districts`.`id`
    JOIN `regencies` ON `districts`.`regency_id`=`regencies`.`id`
    JOIN `provinces` ON `regencies`.`province_id`=`provinces`.`id`
    WHERE `pendaftar`.`koreg`=$reg
    ";
    $query2 = "SELECT `prestasi`.`kejuaraan`,`score`,`pendaftar`.*, `kat_satuan`.*,`kategori_penyelengara`.*
    FROM `pendaftar` 
    JOIN `prestasi` ON `pendaftar`.`idPrestasi`=`prestasi`.`id`
    JOIN `kat_satuan` ON `prestasi`.`id_satuan`=`kat_satuan`.`id_satuan`
    JOIN `kategori_penyelengara` ON `kat_satuan`.`id_penyelengara`=`kategori_penyelengara`.`id_penyelengara`
    WHERE `pendaftar`.`koreg`=$reg
    ";
    $data['siswa'] = $this->db->query($query)->row_array();
    $data['prestasi'] = $this->db->query($query2)->row_array();
    $data['sarat'] = $this->db->get_where('persyaratan', ['id_jalur' => $data['siswa']['id_jalur']])->result_array();
    $data['setting'] = $this->db->get('kop_surat')->row_array();
    $filename = $data['siswa']['namaSiswa'] . '-' . $data['siswa']['koreg'];
    // $this->load->view('Home/CetakRegistrasi', $data);
    $mpdf = new \Mpdf\Mpdf([
      'format' => 'Legal-P',
      'margin_left' => 22,
      'margin_right' => 20,
      'margin_top' => 20,
      'margin_bottom' => 0,
      'margin_header' => 0,
      'margin_footer' => 0,
    ]);
    $html = $this->load->view('Home/CetakRegistrasi', $data, true);
    $html2 = $this->load->view('Home/perjanjianMutlakOrangtua', $data, true);
    $mpdf->WriteHTML($html);
    $mpdf->AddPage();
    $mpdf->WriteHTML($html2);
    $mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%" style="font-size:8px;">{DATE j-m-Y}</td>
        <td width="33%" align="center" style="font-size:8px;">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right; font-size:8px;">' . $sekolah  . '</td>
    </tr>
</table>');
    $mpdf->Output($filename . '.pdf', 'I');
  }

  public function printPDF()
  {
    $mpdf = new \Mpdf\Mpdf();
    $data = $this->load->view('Home/PrintPDF', [], true);
    $mpdf->WriteHTML($data);
    $mpdf->Output();
  }

  private function ruleValidation()
  {
    $rule = array(
      array(
        'field' => 'namaSiswa',
        'label' => 'Nama',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => ' Nama harus di isi',

        )
      ),
      array(
        'field' => 'nikSiswa',
        'label' => 'NIK',
        'rules' => 'required|numeric|trim|is_unique[pendaftar.nikSiswa]',
        'errors' => array(
          'required' => ' Nama harus di isi',
          'numeric' => 'Nik Hanya boleh angka',
          'is_unique' => 'NIK sudah terdaftar'
        )
      ),
      array(
        'field' => 'jk',
        'label' => 'Jenis Kelamin',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => ' Jenis kelamin belum di pilih'
        )
      ),
      array(
        'field' => 'jalurPpdb',
        'label' => 'Jalur PPDB',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Jalur PPDB belum dipilih',
        )
      ),
      array(
        'field' => 'agama',
        'label' => 'Agama',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Agama belum dipilih',
        )
      ),
      array(
        'field' => 'sekolahAsal',
        'label' => 'Jalur PPDB',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Sekolah Asal Harus di isi'
        )
      ),
      array(
        'field' => 'nisnSiswa',
        'label' => 'NISN',
        'rules' => 'required|numeric|is_unique[pendaftar.nisnSiswa]|trim',
        'errors' => array(
          'required' => 'NISN Harus di isi',
          'numeric' => 'NISN hanya Angka',
          'is_unique' => 'MOHON MAAF NISN TERSEBUT SUDAH TERDAFTAR'
        )
      ),
      array(
        'field' => 'tempatLahir',
        'label' => 'Tempat Lahir',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Tempat lahir Harus di isi'

        )
      ),

      array(
        'field' => 'tglLahirSiswa',
        'label' => 'Tanggal Lahir',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Tanggal lahir Harus di isi'

        )
      ),

      array(
        'field' => 'tinggiBadan',
        'label' => 'Tinggi',
        'rules' => 'required|numeric|trim',
        'errors' => array(
          'required' => 'Tinggi Badan  Harus di isi',
          'numeric' => 'tinggi Badan hanya di isi angka'

        )
      ),

      array(
        'field' => 'beratBadan',
        'label' => 'Berat',
        'rules' => 'required|numeric|trim',
        'errors' => array(
          'required' => 'Berat Badan  Harus di isi',
          'numeric' => 'Berat Badan hanya di isi angka'

        )
      ),

      array(
        'field' => 'alamat',
        'label' => 'Alamat',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Alamat  Harus di isi'

        )
      ),
      array(
        'field' => 'rt',
        'label' => 'Rt',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Rt  Harus di isi'

        )
      ),
      array(
        'field' => 'rw',
        'label' => 'Rw',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Rw  Harus di isi'

        )
      ),
      array(
        'field' => 'desa',
        'label' => 'Desa',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Desa/kelurahan  Harus di isi'

        )
      ),
      array(
        'field' => 'kecamatan',
        'label' => 'Kecamatan',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Kecamatan  Harus di isi'

        )
      ),

      array(
        'field' => 'kabKota',
        'label' => 'kabupaten',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'kabupaten/Kota  Harus di isi'

        )
      ),


      array(
        'field' => 'longitude',
        'label' => 'longitude',
        'rules' => 'required|min_length[5]|trim',
        'errors' => array(
          'required' => 'longitude Wajib  di isi',
          'min_length' => 'longitude Minimal 5 digit'
        )
      ),

      array(
        'field' => 'namaAyah',
        'label' => 'Ayah',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Nama Ayah Wajib  di isi'

        )
      ),

      array(
        'field' => 'nikAyah',
        'label' => 'NIK Ayah',
        'rules' => 'required|trim|numeric',
        'errors' => array(
          'required' => 'NIK Ayah Wajib  di isi',
          'numeric' => 'Nik Ayah hanya di isi numeric'

        )
      ),

      array(
        'field' => 'pekerjaanAyah',
        'label' => 'Pekerjaan',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Pekerjaan Ayah Wajib  di isi'
        )
      ),
      array(
        'field' => 'penghasilanAyah',
        'label' => 'Penghasilan',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Penghasilan Ayah Wajib  di isi'
        )
      ),
      array(
        'field' => 'namaibu',
        'label' => 'Ibu',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Nama Ibu Wajib  di isi'
        )
      ),
      array(
        'field' => 'nikIbu',
        'label' => 'NIK Ibu',
        'rules' => 'required|trim|numeric',
        'errors' => array(
          'required' => 'NIK Ibu Wajib  di isi',
          'numeric' => 'Nik Ibu hanya di isi numeric'
        )
      ),
      array(
        'field' => 'pekerjaanIbu',
        'label' => 'Pekerjaan',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Pekerjaan Ibu Wajib  di isi'
        )
      ),
      array(
        'field' => 'penghasilanIbu',
        'label' => 'Penghasilan',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Penghasilan Ibu Wajib  di isi'
        )
      ),
      array(
        'field' => 'npsn',
        'label' => 'Npsn',
        'rules' => 'required|trim|numeric',
        'errors' => array(
          'required' => 'NPSN Wajib  di isi',
          'numeric' => 'npsn Hanya input numeric'
        )
      ),
      array(
        'field' => 'noKK',
        'label' => 'Kartu Keluarga',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Kartu Keluarga  Tidak boleh kosong'
        )
      )
    );
    return $rule;
  }
}
