<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kategori extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Kategori_m', 'kategori');
  }

  public function index(){
    $data['title'] = 'Kategori';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('themplate/admin/header2', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('Kategori/index', $data);
    $this->load->view('themplate/admin/bottomBar', $data);
    $this->load->view('themplate/admin/footer2', $data);
    }

    // function reques data tables
    public function GetDataKategoriAll(){
        $list = $this->kategori->GetDataKategoriAll();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
          $no++;
          $row = array();
          $row[] = $no . ".";
          $row[] = $item->idKategori;
          $row[] = $item->kategori;
          $row[] = '<button data-id="' . $item->idKategori . '" class="badge badge-primary tombolEditKategori"><i class="fa fa-pen"></i> Edit</button>';
          $data[] = $row;
        }
        $output = array(
          "draw" => @$_POST['draw'],
          "recordsTotal" => $this->kategori->count_all(),
          "recordsFiltered" => $this->kategori->count_filtered(),
          "data" => $data,
        );
      echo json_encode($output);
      }
      // end function reques datatables

      // function simpan Kategori
        public function SimpanKategori(){
          if($this->kategori->ProsesSimpanKategori($_POST)>0){
            echo"Sukses";
          }
          else{
            echo"error";
          }
        }

        // Proses Edit kategori
      public function editDataKategori(){
        if($this->kategori->ProsesEditKategori($_POST)>0){
          echo"Sukses";
        }
        else{
          echo"error";
        }
      }

      // get data kategori by id
      public function getDataKategoriById(){
        echo json_encode($this->kategori->getDataKategoriById($_POST['id']));
  
      }

      public function CekKode(){
        if($this->db->get_where('kategoribuku',['idKategori'=>$_POST['kodeKategori']])->num_rows()>0){
          echo 'false';
        }
        else{
          echo 'true';
        }
      }
  

}