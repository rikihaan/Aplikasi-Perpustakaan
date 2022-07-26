<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_m', 'transaksi');
        is_logged_in();
    }

    public function index()
    {
        echo json_encode($this->transaksi->DataPeminjaman($_POST['key']));
        // echo json_encode($_POST);
    }
}
