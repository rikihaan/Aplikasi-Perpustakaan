<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Grafik extends CI_Controller
{

    public function __construct()
    {
      parent::__construct();
      $this->load->model('Grafik_m', 'grafik');
    }
    public function index(){
    $data['title'] = 'Grafix';
    $this->load->view('Grafik/index', $data);
    }

    public function kunjungan(){
      echo json_encode($this->grafik->getGrafik());
    }

    public function kunjunganPerkelas(){
      echo json_encode($this->grafik->getGrafikKelas());

    }

    public function PeminatanBuku(){
      echo json_encode($this->grafik->peminatanBaca());

    }
}
?>