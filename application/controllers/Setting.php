<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Setting extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model', 'user');
    $this->load->model('Setting_m', 'setting_m');
    $this->load->library('form_validation');
  }
  public function index()
  {
    $data['title'] = 'SETTING APLIKASI';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['setting'] = $this->db->get_where('setting', ['id' => 1])->row_array();
    $this->form_validation->set_rules($this->setting());
    if ($this->form_validation->run() == false) {
      $this->load->view('themplate/admin/header2', $data);
      $this->load->view('themplate/admin/sidebar', $data);
      $this->load->view('Setting/index', $data);
      $this->load->view('themplate/admin/bottomBar', $data);
      $this->load->view('themplate/admin/footer2', $data);
    } else {


      $data = [
        'maxKeterlambatan' => $this->input->post('maxKeterlambatan'),
        'maxPinjamanReguler' => $this->input->post('maxPeminjamanHarian'),
        'maxPinjamanPaket' => $this->input->post('maxPeminjamanPaket'),
        'denda' => $this->input->post('denda')
      ];
      $this->db->set($data);
      $this->db->where('id', 1);
      $this->db->update('setting');
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert" style="position:absolute; top:100px; right:50px;">
      Perubahan Berhasil Di Simpan
      </div>');
      redirect('setting');
    }
  }

  public function aktifForm()
  {
    $data['setting'] = $this->db->get('kop_surat')->row_array();
    $form = '';
    if ($data['setting']['formulir'] == 1) {
      $form = 0;
    } else if ($data['setting']['formulir'] == 0) {
      $form = 1;
    }

    $edit = [
      'formulir' => $form
    ];

    $this->db->set($edit);
    $this->db->where('id', $_POST['id']);
    $this->db->update('kop_surat');
    echo "sukses";
  }

  public function updateKop()
  {

    $foto = $_FILES['logo'];

    $extend = explode('/', $foto['type']);
    $ext = end($extend);
    $newName = rand(10, 100000);
    $newjadi = $newName . '.' . $ext;

    if ($foto['error'] == 4) {
      $data = [
        'nama_sekolah' => $this->input->post('nama'),
        'alamat' => $this->input->post('alamat'),
        'kecamatan' => $this->input->post('kecamatan'),
        'desa' => $this->input->post('desa'),
        'npsn' => $this->input->post('npsn'),
      ];
      $this->db->set($data);
      $this->db->where('id', $this->input->post('id'));
      $this->db->update('kop_surat');
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data Seting berhasil Ubah!!
      </div>');
      redirect('setting');
    } else {
      $config['upload_path'] = 'assets/img/logo';
      $config['allowed_types'] = 'jpg|png|gif|jpeg';
      $config['file_name'] = $newjadi;
      $this->load->library('upload', $config);


      if (!$this->upload->do_upload('logo')) {
        $this->session->set_flashdata('message', '
      <div class="alert alert-danger" role="alert">
       logo sekolah gagal di upload
      </div>');
        redirect('setting');
      } else {
        $this->upload->data('file_name');
        $data = [
          'nama_sekolah' => $this->input->post('nama'),
          'alamat' => $this->input->post('alamat'),
          'kecamatan' => $this->input->post('kecamatan'),
          'desa' => $this->input->post('desa'),
          'npsn' => $this->input->post('npsn'),
          'logo'   => $newjadi
        ];
        $this->db->set($data);
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('kop_surat');
        $this->session->set_flashdata('message', '
        <div class="alert alert-success" role="alert">
       Data Seting berhasil Ubah!!
        </div>');
        redirect('setting');
      }
    }
  }

  // ubah kepala sekolah

  public function ubahKepsek()
  {
    $data = [
      'nama_kepala' => $this->input->post('namaKep'),
      'nip_kepsek' => $this->input->post('nip'),
      'no_surat' => $this->input->post('noSurat'),
      'longitude' => $this->input->post('long'),
      'tanggalKelulusan' => $this->input->post('tanggakKelulusan'),
      'jumlahRombel' => $this->input->post('JumlahRombel')
    ];

    $this->db->set($data);
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('kop_surat');
    $this->session->set_flashdata('message', '
    <div class="alert alert-success" role="alert">
   Data Seting berhasil Ubah!!
    </div>');
    redirect('setting');
  }


  // ajax data user

  public function getDataUser()
  {

    echo json_encode($this->db->get_where('user', ['id' => $_POST['id']])->row_array());
  }

  public  function editUser()
  {

    if ($this->user->editProsesUser($_POST) > 0) {
      $this->session->set_flashdata('message', '
    <div class="alert alert-success" role="alert">
   Data Seting berhasil Ubah!!
    </div>');
      redirect('setting');
    } else {
      $this->session->set_flashdata('message', '
    <div class="alert alert-danger" role="alert">
   Data Seting Gagal di Ubah!!
    </div>');
      redirect('setting');
    }
  }



  public function hapusUser($id)
  {
    if ($this->user->hapusUserProses($id) > 0) {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data User Berhasil di Hapus!!
      </div>');
      redirect('setting');
    } else {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data User Gagal di Hapus!!
      </div>');
      redirect('setting');
    }
  }

  public function setting()
  {
    $dataRules = array(
      array(
        'field' => 'maxKeterlambatan',
        'label' => 'Keterlambatan',
        'rules' => 'required|trim|numeric',
        'errors' => array(
          'required' => 'Email Harus Di isi',
          'numeric' => 'Hanya Boleh Angka'
        )
      ),
      array(
        'field' => 'maxPeminjamanHarian',
        'label' => 'Peminjaman Harian',
        'rules' => 'required|trim|numeric',
        'errors' => array(
          'required' => ' Harus Di isi',
          'numeric' => 'Hanya Boleh Angka'
        )
      ),
      array(
        'field' => 'maxPeminjamanPaket',
        'label' => 'Paket',
        'rules' => 'required|trim|numeric',
        'errors' => array(
          'required' => ' Harus Di isi',
          'numeric' => 'Hanya Boleh Angka'
        )
      ),
      array(
        'field' => 'denda',
        'label' => 'Denda',
        'rules' => 'required|trim|numeric',
        'errors' => array(
          'required' => 'Harus Di isi',
          'numeric' => 'Hanya Boleh Angka'
        )
      )

    );

    return  $dataRules;
  }
  public function uploadFIle()
  {
    $foto = $_FILES['pengumuman'];
    // var_dump($foto);
    // die;
    $pdfLama = $this->db->get_where('kop_surat', ['id' => $this->input->post('id')])->row_array();
    $extend = explode('/', $foto['type']);
    $ext = end($extend);
    $newName = rand(10, 100000);
    $newjadi = $newName . '.' . $ext;


    $config['upload_path'] = 'assets/HomeAssets/file/';
    $config['allowed_types'] = 'pdf';
    $config['file_name'] = $newjadi;
    $this->load->library('upload', $config);


    if (!$this->upload->do_upload('pengumuman')) {
      $this->session->set_flashdata('message', '
      <div class="alert alert-danger" role="alert">
       Upload pengumuman Gagal
      </div>');
      redirect('setting');
    } else {
      $file = ('assets/HomeAssets/file/' . $pdfLama);
      unlink($file);
      $this->upload->data('file_name');

      $data = [
        'filePengumuman'   => $newjadi
      ];


      $this->db->set($data);
      $this->db->where('id', htmlspecialchars($this->input->post('id')));
      $this->db->update('kop_surat');
      $this->session->set_flashdata('message', '
        <div class="alert alert-success" role="alert">
      Upload Pengumuman Berhasil
        </div>');
      redirect('setting');
    }
  }

  public function backup()
  {
    $this->load->dbutil();
    $prefs = array(
      'tables'     => array('pendaftar'),
      'format'     => 'sql',
      // gzip, zip, txt format filenya
      'filename'   => 'bacup_' . date('y-m-d-H-i-s') . '.sql',
    );
    // Backup database dan dijadikan variable
    $backup = $this->dbutil->backup($prefs);
    // // Load file helper dan menulis ke server untuk keperluan restore  
    $db_name = 'dataBacup_' . date('y-m-d-H:i:s') . '.sql';
    // $save = FCPATH . 'assets/db/' . $db_name;
    // $this->load->helper('file');
    // write_file($save, $backup);
    // // Load the download helper dan melalukan download ke komputer
    $this->load->helper('download');
    force_download($db_name, $backup);
  }

  public function kosongkan()
  {
    $query = "DELETE FROM pendaftar";
    $this->db->query($query);
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('message', '
        <div class="alert alert-success" role="alert">
      Database Berhasil dikosongkan
        </div>');
      redirect('setting');
    } else {
      $this->session->set_flashdata('message', '
      <div class="alert alert-danger" role="alert">
    Database Gagal dikosongkan
      </div>');
      redirect('setting');
    }
  }

  public function ttd()
  {
    $foto = $_FILES['ttd'];
    // var_dump($foto);
    // die;
    $pdfLama = $this->db->get_where('kop_surat', ['id' => $this->input->post('id')])->row_array();
    $extend = explode('/', $foto['type']);
    $ext = end($extend);
    $newName = rand(10, 100000);
    $newjadi = $newName . '.' . $ext;
    $config['upload_path'] = 'assets/HomeAssets/file/';
    $config['allowed_types'] = 'jpg|png|gif|jpeg';
    $config['file_name'] = $newjadi;
    $this->load->library('upload', $config);
    $this->upload->do_upload('ttd');
    $file = ('assets/HomeAssets/file/' . $pdfLama);
    unlink($file);
    $this->upload->data('file_name');

    $data = [
      'ttd_kepsek'   => $newjadi
    ];
    $this->db->set($data);
    $this->db->where('id', htmlspecialchars($this->input->post('id')));
    $this->db->update('kop_surat');
    $this->session->set_flashdata('message', '
        <div class="alert alert-success" role="alert">
      Upload Tanda Tangan Berhasil
        </div>');
    redirect('setting');
  }
  // ambil datadesa
  public function getDataDesa()
  {
    $list = $this->setting_m->get_desa();
    // var_dump($list);
    // die;
    $data = array();
    $no = @$_POST['start'];
    foreach ($list as $item) {
      $no++;
      $row = array();
      $row[] = $no . ".";
      $row[] = $item->propinsi;
      $row[] = $item->kota;
      $row[] = $item->kecamatan;
      $row[] = $item->desa;
      $row[] = '<a href="' . base_url('Admin/hapusPendaftar/') . $item->id . '" class="badge badge-danger tombolHapus"><i class="fa fa-print" aria-hidden="true"></i> Hapus</a>';
      $data[] = $row;
    }
    $output = array(
      "draw" => @$_POST['draw'],
      "recordsTotal" => $this->setting_m->count_all(),
      "recordsFiltered" => $this->setting_m->count_filtered(),
      "data" => $data,
    );
    // output to json format

    echo json_encode($output);
  }

  public function GetdataKotaByid()
  {
    echo json_encode($this->db->get_where('regencies', ['province_id' => $_POST['id']])->result_array());
  }

  public function GetdatakecamatanByidKota()
  {
    echo json_encode($this->db->get_where('districts', ['regency_id' => $_POST['id']])->result_array());
  }

  public function tambahDesa()
  {
    if ($this->user->prosesTambahDesa($_POST) > 0) {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data Desa Berhasil di Tambah!!
      </div>');
      redirect('setting');
    } else {
      $this->session->set_flashdata('message', '
      <div class="alert alert-warning" role="alert">
      Data Desa Gagal di Tambah!!
      </div>');
      redirect('setting');
    }
  }

  public function resetCabut()
  {
    if ($this->db->get_where('pendaftar', ['koreg' => $_POST['Koreg']])->num_rows() > 0) {
      $tujuan = "";
      if ($_POST['cabutKe'] == 1) {
        $tujuan = "Dashboard";
      } else {
        $tujuan = "Verifikasi";
      }
      if ($this->user->prosesResetCabut($_POST) > 0) {
        $this->session->set_flashdata('message', '
        <div class="alert alert-success" role="alert">
       Kode Registrasi ' . $_POST['Koreg'] . ' Berhasil Di Kembalikan ' . $tujuan . '
        </div>');
        redirect('Setting');
      }
    } else {
      $this->session->set_flashdata('message', '
      <div class="alert alert-danger" role="alert">
     Kode Registrasi ' . $_POST['Koreg'] . ' Tidak Ditemukan
      </div>');
      redirect('Setting');
    }
  }
}
