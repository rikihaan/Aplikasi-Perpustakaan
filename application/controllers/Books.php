<?php
class Books extends CI_Controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('Books_m', 'books');
    }

    public function index(){
    $data['title'] = 'Books';
    $this->load->view('Books/index', $data);
    }

    // load data buku untuk informasi buku
    public function BooksAll(){
      $list = $this->books->getDataBukuAll();
      $data = array();
      $no = @$_POST['start'];
      // $checked="";
      $status="";
      foreach ($list as $item) {
        $no++;
        $row = array();
        $row[] = $no . ".";
        $row[] = $item->judul;
        $row[] = $item->kategoriBuku;
        $row[] = $item->idKategori;
        if($item->statusPeminjaman==1){
           $status='<span class="badge badge-pill badge-success">Tersedia</span>';
        }elseif($item->statusPeminjaman==2){
          $status='<span class="badge badge-pill badge-secondary">Dipinjam</span>';
        }
        $row[] = $status;
        $data[] = $row;
      }
      $output = array(
        "draw" => @$_POST['draw'],
        "recordsTotal" => $this->books->count_all(),
        "recordsFiltered" => $this->books->count_filtered(),
        "data" => $data,
      );
    

    echo json_encode($output);
    }

   
}