<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ppdb extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    is_logged_in();

    $this->load->model('ppdb_model', 'ppdb');
  }

  public function index()
  {
    $data['title'] = 'Persyaratan';
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['sarat'] = $this->ppdb->getDataSyarat();
    $data['jalur'] = $this->ppdb->getDataPpdb();
    $this->form_validation->set_rules('syarat', 'syarat', 'required', array('required' => 'Form Persyaratan tidak boleh Kosong'));
    $this->form_validation->set_rules('jalur', 'jalur', 'required', array('required' => 'Peruntukan Jalur Belum Di pilih'));

    if ($this->form_validation->run() == false) {
      // var_dump($data['sarat']);
      // die;
      $this->load->view('themplate/admin/header', $data);
      $this->load->view('themplate/admin/sidebar', $data);
      $this->load->view('themplate/admin/topbar', $data);
      $this->load->view('ppdb/index', $data);
      $this->load->view('themplate/admin/footer', $data);
    } else {
      if ($this->ppdb->simpanSyarat($_POST) > 0) {
        $this->session->set_flashdata('message', '
          <div class="alert alert-success" role="alert">
        Data Persyaratan berhasil ditambah!!
          </div>');
        redirect('ppdb');
      }
    }
  }

  public function nonAkademik()
  {
    $data['title'] = 'Nilai Nonakademik';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['tingkat'] = $this->ppdb->getDataKategoriNilaiAkademik();
    $data['penyelengara'] = $this->db->get('kategori_penyelengara')->result_array();
    $this->form_validation->set_rules('tingkat', 'tingkat', 'required', array('required' => 'Tingkat Prestasi Tidak  boleh Kosong'));
    $this->form_validation->set_rules('nilaiPrestasi', 'Prestasi', 'required', array('required' => 'Score Prestasi  tidak boleh Kosong'));
    $this->form_validation->set_rules('penyelengara', 'Penyelengara', 'required', array('required' => 'Penyelengara Belum Dipilih'));
    $this->form_validation->set_rules('kategori', 'Kategori', 'required', array('required' => 'Kategori Kejuaraan Belum Dipilih'));
    if ($this->form_validation->run() == false) {
      $this->load->view('themplate/admin/header', $data);
      $this->load->view('themplate/admin/sidebar', $data);
      $this->load->view('themplate/admin/topbar', $data);
      $this->load->view('ppdb/Nonakademik', $data);
      $this->load->view('themplate/admin/footer', $data);
    } else {
      if ($this->ppdb->prosesSimpanPrestasi($_POST) > 0) {
        $this->session->set_flashdata('message', '
          <div class="alert alert-success" role="alert">
        Data Prestasi berhasil ditambah!!
          </div>');
        redirect('ppdb/Nonakademik');
      } else {
        $this->session->set_flashdata('message', '
        <div class="alert alert-danger" role="alert">
      Data Prestasi Gagal ditambah!!
        </div>');
        redirect('ppdb/Nonakademik');
      }
    }
  }


  public function getDataKategoriByIdPeyelengara()
  {
    echo json_encode($this->db->get_where('kat_satuan', ['id_penyelengara' => $_POST['id']])->result_array());
  }


  public function getDataPrestasi()
  {
    echo json_encode($this->db->get_where('prestasi', ['id' => $_POST['id']])->row_array());
  }

  public function getDataKatSatuan()
  {
    echo json_encode($this->db->get_where('kat_satuan', ['id_satuan' => $_POST['id']])->row_array());
  }

  public function editNilaiPrestasi()
  {
    $data['title'] = 'Nilai Nonakademik';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['tingkat'] = $this->ppdb->getDataKategoriNilaiAkademik();
    $data['penyelengara'] = $this->db->get('kategori_penyelengara')->result_array();
    $this->form_validation->set_rules('tingkat', 'tingkat', 'required', array('required' => 'Tingkat Prestasi Tidak  boleh Kosong'));
    $this->form_validation->set_rules('nilaiPrestasi', 'Prestasi', 'required', array('required' => 'Score Prestasi  tidak boleh Kosong'));
    $this->form_validation->set_rules('penyelengara', 'Penyelengara', 'required', array('required' => 'Penyelengara Belum Dipilih'));
    $this->form_validation->set_rules('kategori', 'Kategori', 'required', array('required' => 'Kategori Kejuaraan Belum Dipilih'));
    if ($this->form_validation->run() == false) {
      $this->load->view('themplate/admin/header', $data);
      $this->load->view('themplate/admin/sidebar', $data);
      $this->load->view('themplate/admin/topbar', $data);
      $this->load->view('ppdb/Nonakademik', $data);
      $this->load->view('themplate/admin/footer', $data);
    } else {

      if ($this->ppdb->prosesEditNilaiPrestasi($_POST) > 0) {
        $this->session->set_flashdata('message', '
        <div class="alert alert-success" role="alert">
      Data Prestasi berhasil Diedit!!
        </div>');
        redirect('ppdb/Nonakademik');
      } else {
        $this->session->set_flashdata('message', '
        <div class="alert alert-success" role="alert">
      Data Tersimpan!
        </div>');
        redirect('ppdb/Nonakademik');
      }
    }
  }

  public function hapusPrestasi($id)
  {
    if ($this->ppdb->prosesHapusPrestasi($id) > 0) {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
    Data Prestasi berhasil Hapus!!
      </div>');
      redirect('ppdb/Nonakademik');
    } else {
      $this->session->set_flashdata('message', '
      <div class="alert alert-danger" role="alert">
    Data Prestasi Gagal Hapus!!
      </div>');
      redirect('ppdb/Nonakademik');
    }
  }
  // batas akhir data nili prestasi
  public function edit()
  {

    echo json_encode($this->ppdb->getDataSyaratById($_POST['id']));
  }

  public function editProses()
  {
    if ($this->ppdb->prosesEdit($_POST) > 0) {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data Persyaratan berhasil diedit!!
      </div>');
      redirect('ppdb');
    } else {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data Persyaratan Gagal  edit!!
      </div>');
      redirect('ppdb');
    }
  }

  public function hapusSyarat($id)
  {
    $this->db->delete('persyaratan', ['id' => $id]);
    $this->session->set_flashdata('message', '
    <div class="alert alert-success" role="alert">
   Data Persyaratan Berhasil dihapus!!
    </div>');
    redirect('ppdb');
  }


  // jalus ppdb

  public function jalurPpdb()
  {
    $data['title'] = 'Jalur PPDB';
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    // $data['sarat'] = $this->ppdb->getDataSyarat();
    $data['jalur'] = $this->ppdb->getDataPpdb();
    $this->form_validation->set_rules('jalur', 'Jalur', 'required', array('required' => 'Form Jalur PPDB tidak boleh Kosong'));
    $this->form_validation->set_rules('quota', 'Quota', 'required|numeric', array('required' => 'Form Jalur Quota tidak boleh Kosong', 'numeric' => 'Quota Hanya Angka!!'));
    if ($this->form_validation->run() == false) {
      // var_dump($data['sarat']);
      // die;
      $this->load->view('themplate/admin/header', $data);
      $this->load->view('themplate/admin/sidebar', $data);
      $this->load->view('themplate/admin/topbar', $data);
      $this->load->view('ppdb/jalurPPDB', $data);
      $this->load->view('themplate/admin/footer', $data);
    } else {
      if ($this->ppdb->simpanJalurPPDB($_POST) > 0) {
        $this->session->set_flashdata('message', '
        <div class="alert alert-success" role="alert">
       Data Jalur PPDB berhasil ditambah!!
        </div>');
        redirect('ppdb/jalurPPDB');
      } else {
        $this->session->set_flashdata('message', '
        <div class="alert alert-danger" role="alert">
        Jalur PPDB  Gagal ditambah!!
        </div>');
        redirect('ppdb/jalurPPDB');
      }
    }
  }

  public function getJalurByid()
  {
    echo json_encode($this->ppdb->getJalurId($_POST['id']));
  }

  public function editJalurPpdb()
  {

    if ($this->ppdb->prosesEditJalur($_POST) > 0) {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data Jalur PPDB berhasil diedit!!
      </div>');
      redirect('ppdb/jalurPpdb');
    } else {
      $this->session->set_flashdata('message', '
      <div class="alert alert-danger" role="alert">
     Data Jalur PPDB gagal diedit!!
      </div>');
      redirect('ppdb/jalurPpdb');
    }
  }

  public function hapusJalurPpdb($id)
  {
    if ($this->ppdb->prosesHapusJalur($id) > 0) {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data Jalur PPDB berhasil Hapus!!!
      </div>');
      redirect('ppdb/jalurPpdb');
    } else {
      $this->session->set_flashdata('message', '
      <div class="alert alert-danger" role="alert">
     Data Jalur PPDB gagal Hapus!!!
      </div>');
      redirect('ppdb/jalurPpdb');
    }
  }
  // informasi method
  public function informasi()
  {
    $data['title'] = 'Informasi';
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['informasi'] = $this->db->get('informasi')->result_array();
    // var_dump($data['informasi']);die;
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->form_validation->set_rules('titleInformasi', 'Informasi', 'required', array('required' => 'Form Informasi tidak boleh Kosong'));
    if ($this->form_validation->run() == false) {
      // var_dump($data['sarat']);
      // die;
      $this->load->view('themplate/admin/header', $data);
      $this->load->view('themplate/admin/sidebar', $data);
      $this->load->view('themplate/admin/topbar', $data);
      $this->load->view('ppdb/informasi', $data);
      $this->load->view('themplate/admin/footer', $data);
    } else {
      if ($this->ppdb->simpanInformasi($_POST) > 0) {
        $this->session->set_flashdata('message', '
        <div class="alert alert-success" role="alert">
       Data Informasi berhasil ditambah!!
        </div>');
        redirect('ppdb/informasi');
      } else {
        $this->session->set_flashdata('message', '
        <div class="alert alert-danger" role="alert">
       Informasi  Gagal ditambah!!
        </div>');
        redirect('ppdb/informasi');
      }
    }
  }

  public function getInformasiByid()
  {
    echo json_encode($this->ppdb->getDataInformasiByid($_POST['id']));
  }

  public function editInformasi()
  {
    if ($this->ppdb->prosesEditInformasi($_POST) > 0) {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data Informasi berhasil diedit!!
      </div>');
      redirect('ppdb/informasi');
    } else {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data Tersimpan !
      </div>');
      redirect('ppdb/informasi');
    }
  }

  public function hapusInformasi($id)
  {
    if ($this->ppdb->prosesHapusInformasi($id) > 0) {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data Informasi berhasil diedit!!
      </div>');
      redirect('ppdb/informasi');
    } else {
      $this->session->set_flashdata('message', '
      <div class="alert alert-danger" role="alert">
     Data Informasi gagal di edit!!
      </div>');
      redirect('ppdb/informasi');
    }
  }
}
