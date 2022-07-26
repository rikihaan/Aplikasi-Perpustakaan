<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }
  public function index()
  {
    $dataRules = array(
      array(
        'field' => 'login',
        'label' => 'login',
        'rules' => 'required|min_length[3]',
        'errors' => array(
          'required' => 'login tidak boleh kosong',
          'min_length' => 'login Minimal 3 Karakter'


        )
      )

    );

    $this->form_validation->set_rules($dataRules);
    if ($this->form_validation->run() == false) {
      $data['title'] = 'Halaman Login';
      $this->load->view('themplate/Auth_header', $data);
      $this->load->view('Auth/login');
      $this->load->view('themplate/Auth_footer');
    } else {
      $this->_login();
    }
  }


  private function _login()
  {
    $email = $this->input->post('login');
    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    // berarti ada data
    if ($user) {

      // jika user aktif
      if ($user['is_active'] == 1) {

        $data = [
          'email' => $user['email'],
          'role_id' => $user['role_id']
        ];

        $this->session->set_userdata($data);
        // if untuk role
        if ($user['role_id'] == 1) {

          redirect('Admin');
        } else {
          redirect('user');
        }

      } else {
        $this->session->set_flashdata('message', '
            <div class="alert alert-danger" role="alert">
              user tidak aktif !!! silahkan aktifasi 
            </div>');
        redirect('auth');
      }
      
    } else {
      // jika tidak

      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
     user tidak ditemukan !!! silahkan cek kembali
     </div>');
      redirect('auth');
    }
  }

  // public function registration()
  // {

  //   $rules = array(
  //     array(
  //       'field' => 'name',
  //       'label' => 'Name',
  //       'rules' => 'required|trim',
  //       'errors' => array(
  //         'required' => 'Nama Harus Di isi'
  //       )

  //     ),
  //     array(
  //       'field' => 'email',
  //       'label' => 'Email',
  //       'rules' => 'required|valid_email|trim|is_unique[user.email]',
  //       'errors' => array(
  //         'required' => 'email tidak boleh kosong',
  //         'valid_email' => 'email tidak valid',
  //         'is_unique' => 'Email Sudah Terdaftar'
  //       )
  //     ),

  //     array(
  //       'field' => 'password1',
  //       'label' => 'Password',
  //       'rules' => 'required|min_length[3]|matches[password2]',
  //       'errors' => array(
  //         'required' => 'Password tidak boleh kosong',
  //         'min_length' => 'Password Minimal 3 Karakter',
  //         'matches' => 'Password tidak sama'

  //       )
  //     ),

  //     array(
  //       'field' => 'password2',
  //       'label' => 'Password',
  //       'rules' => 'required|matches[password1]',
  //       'errors' => array(
  //         'required' => 'Password tidak boleh kosong',
  //         'matches' => 'Password tidak sama'

  //       )
  //     )



  //   );

  //   $this->form_validation->set_rules($rules);
  //   // $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
  //   if ($this->form_validation->run() == false) {

  //     $data['title'] = "User Registration";
  //     $this->load->view('themplate/auth_header', $data);
  //     $this->load->view('Auth/registration');
  //     $this->load->view('themplate/auth_footer');
  //   } else {
  //     $data = [
  //       'name' => htmlspecialchars($this->input->post('name', true)),
  //       'email' => htmlspecialchars($this->input->post('email', true)),
  //       'image' => 'default.jpg',
  //       'password' => password_hash(($this->input->post('password1', true)), PASSWORD_DEFAULT),
  //       'role_id' => 2,
  //       'is_active' => 1,
  //       'date_created' => time()

  //     ];

  //     $this->db->insert('user', $data);
  //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
  //    Selamat Registrasi anda berhasil !!! Silahkan Login
  //   </div>');
  //     redirect('auth');
  //   }
  // }


  // logout

  public function logout()
  {
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('role_id');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
   Anda berhasil logout
    </div>');
    redirect('auth');
  }


  // blocked

  public function blocked()
  {
    $this->load->view('Auth/blocked');
  }
}
