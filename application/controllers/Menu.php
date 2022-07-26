<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Menu extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function index()
  {

    $data['title'] = 'Manajemen';
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->form_validation->set_rules('menu', 'Menu', 'required', array('required' => 'Form menu tidak boleh Kosong'));
    if ($this->form_validation->run() == false) {
      $this->load->view('themplate/admin/header', $data);
      $this->load->view('themplate/admin/sidebar', $data);
      $this->load->view('themplate/admin/topbar', $data);
      $this->load->view('menu/index', $data);
      $this->load->view('themplate/admin/footer', $data);
    } else {
      $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data menu berhasil ditambah!!
      </div>');
      redirect('menu');
    }
  }

  public function subMenu()
  {
    $data['title'] = 'Submenu Manajemen';
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $this->load->model('menu_model', 'menu');
    $data['subMenu'] = $this->menu->getSubMenu();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->form_validation->set_rules($this->rolesSubmenu());
    // $this->form_validation->set_rules('title', 'title', 'required', array('required' => 'Form menu tidak boleh Kosong'));
    if ($this->form_validation->run() == false) {
      $this->load->view('themplate/admin/header', $data);
      $this->load->view('themplate/admin/sidebar', $data);
      $this->load->view('themplate/admin/topbar', $data);
      $this->load->view('menu/submenu', $data);
      $this->load->view('themplate/admin/footer', $data);
    } else {
      $data = [
        'menu_id' => $this->input->post('menu_id'),
        'title' => $this->input->post('title'),
        'url' => $this->input->post('url'),
        'icon' => $this->input->post('icon'),
        'is_active' => $this->input->post('status'),
      ];

      $this->db->insert('user_sub_menu', $data);
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data Submenu berhasil ditambah!!
      </div>');
      redirect('menu/subMenu');
    }
  }
  public function hapusMenu($id)
  {
    $this->db->delete('user_menu', ['id' => $id]);
    $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data menu berhasil dihapus!!
      </div>');
    redirect('menu');
  }

  public function hapusSubMenu($id)
  {
    $this->db->delete('user_sub_menu', ['id' => $id]);
    $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data Submenu berhasil dihapus!!
      </div>');
    redirect('menu/subMenu');
  }

  public function rolesSubmenu()
  {
    $role = array(

      array(
        'field' => 'title',
        'label' => 'Title',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'titel  Harus Di isi'
        )
      ),

      array(
        'field' => 'menu_id',
        'label' => 'Menu',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'menu id belum di pilih'
        )
      ),

      array(
        'field' => 'url',
        'label' => 'url',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'url  Harus Di isi'
        )
      ),

      array(
        'field' => 'icon',
        'label' => 'Icon',
        'rules' => 'required|trim',
        'errors' => array(
          'required' => 'Icon  Harus Di isi'
        )
      ),

    );

    return $role;
  }
}
