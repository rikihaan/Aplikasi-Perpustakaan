<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('User_model', 'user');
  }

  public function index()
  {
    $data['title'] = 'User';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('themplate/admin/header2', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('user/index', $data);
    $this->load->view('themplate/admin/bottomBar', $data);
    $this->load->view('themplate/admin/footer2', $data);
  }

  // ========================kumpulan data Get Secara Ajax

  // get all DataUser
  public function GetDataUserAll()
  {

    $list = $this->user->GetDataUserAll();
    $data = array();
    $no = @$_POST['start'];
    foreach ($list as $item) {
      $no++;
      $row = array();
      $row[] = $no . ".";
      $row[] = $item->id . ".";
      $row[] = $item->name;
      $row[] = $item->jabatan;
      $row[] = '<button data-id="' . $item->id . '" class="badge badge-primary tombolEditUser"><i class="fa fa-pen"></i> View</button> 
                    <button class="badge badge-danger tombolHapusUser"  data-id="' . $item->id . '"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</button>';
      $data[] = $row;
    }
    $output = array(
      "draw" => @$_POST['draw'],
      "recordsTotal" => $this->user->count_all(),
      "recordsFiltered" => $this->user->count_filtered(),
      "data" => $data,
    );


    echo json_encode($output);
  }

  // ==================== End Kumpulan Data Ajax DATA TABLES


  // get data kelas
  public function GetdataKelas()
  {
    echo json_encode($this->db->get('kelas')->result_array());
  }


  // function simpan anggota
  public function SimpanUser()
  {
    if ($this->user->ProsesSimpanUser($_POST) > 0) {
      echo "Sukses";
    } else {
      echo "error";
    }
  }

  // edit data User
  public function editDataUser()
  {
    if ($this->user->ProsesEditUser($_POST) > 0) {
      echo "Sukses";
    } else {
      echo "error";
    }
  }


  // proses hapus data anggota
  public function HapusAnggota()
  {
    if ($this->anggota->prosesHapusAnggota($_POST['id']) > 0) {
      echo 'ok';
    } else {
      echo 'error';
    }
  }



  public function getDataUserById()
  {
    echo json_encode($this->user->getDataUserById($_POST['id']));
  }



  public function HapusUser()
  {
    if ($this->user->prosesHapusUser($_POST['id']) > 0) {
      echo 'ok';
    } else {
      echo 'error';
    }
  }
}
