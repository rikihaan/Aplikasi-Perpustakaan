<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;

class Buku extends CI_Controller
{
  public function __construct()
  {
   
      parent::__construct();
      $this->load->model('Ppdb_model', 'daftar');
      $this->load->model('Buku_model', 'buku');
      $this->load->model('Buku_Barcode_m','bukuBarcode');
      is_logged_in();
  }

  public function index(){
    $data['title'] = 'Buku';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('themplate/admin/header2', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('Buku/index', $data);
    $this->load->view('themplate/admin/bottomBar', $data);
    $this->load->view('themplate/admin/footer2', $data);
  }

  public function BukuBarcode(){
    $data['title'] = 'Buku';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('themplate/admin/header2', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('Buku/BukuBarcode', $data);
    $this->load->view('themplate/admin/bottomBar', $data);
    $this->load->view('themplate/admin/footer2', $data);
  }

  // ========================kumpulan data Get Secara Ajax

  // get all Data Buku
  public function GetDataBukuAll(){
    $list = $this->buku->getDataBukuAll();
    $data = array();
    $no = @$_POST['start'];
    // $checked="";
    foreach ($list as $item) {
      $no++;
      $row = array();
      $row[] = $no . ".";
      $row[] = $item->kodeBuku;
      $row[] = $item->judul;
      $row[] = $item->tahun;
      $row[] = $item->kategoriBuku;
      $row[] = $item->pengarang;
      $row[] = '
                <button  class="badge badge-lg badge-success tombolPrintBarcode" data-id="'.$item->kodeBuku.'"><i class="fa fa-barcode" aria-hidden="true"></i></button>
                <button  class="badge badge-lg badge-secondary tombolEditBuku" data-id="'.$item->kodeBuku.'"><i class="fa fa-pen" aria-hidden="true"></i> Edit</button>
                <button  class="badge badge-danger tombolHapusBuku" data-id="'.$item->id.'"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</button>
                <button  class="badge badge-warning tombolCopyBuku" data-id="'.$item->id.'"><i class="fa fa-copy" aria-hidden="true"></i> Copy</button>';
      $data[] = $row;
    }
    $output = array(
      "draw" => @$_POST['draw'],
      "recordsTotal" => $this->buku->count_all(),
      "recordsFiltered" => $this->buku->count_filtered(),
      "data" => $data,
    );
  

  echo json_encode($output);
  }

  // get data buku yang sudah di barkode
  public function getdataBukuAllBarcode(){
    $list = $this->bukuBarcode->getDataBukuAllBarcode();
    $data = array();
    $no = @$_POST['start'];
    // $checked="";
    foreach ($list as $item) {
      $no++;
      $row = array();
      $row[] = $no . ".";
      $row[] = $item->kodeBuku;
      $row[] = $item->judul;
      $row[] = $item->tahun;
      $row[] = $item->kategoriBuku;
      $row[] = $item->pengarang;
      $row[] = '
                <button  class="badge badge-lg badge-success tombolPrintBarcode" data-id="'.$item->kodeBuku.'"><i class="fa fa-barcode" aria-hidden="true"></i></button>
                <button  class="badge badge-lg badge-secondary tombolEditBuku" data-id="'.$item->kodeBuku.'"><i class="fa fa-pen" aria-hidden="true"></i> Edit</button>
                <button  class="badge badge-danger tombolHapusBuku" data-id="'.$item->id.'"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</button>
                ';
      $data[] = $row;
    }
    $output = array(
      "draw" => @$_POST['draw'],
      "recordsTotal" => $this->bukuBarcode->count_all(),
      "recordsFiltered" => $this->bukuBarcode->count_filtered(),
      "data" => $data,
    );
  

  echo json_encode($output);
  }
  // end data buku yang sudah di barcode
 

    // buat simapan data buku semetar sebelum di generete jadi barcode
    public function simpanUntukCetak()
    {
      if($this->buku->prosesSimpanCetak($_POST)>0){
        echo "ok";
      }
    }
    // buat simapan data buku semetar sebelum di generete jadi barcode
    
    // untuk cetak barcode
    public function CetakBarcode(){

      $mpdf = new \Mpdf\Mpdf([
        'format' => 'A4',
        'margin_left' => 10,
        'margin_right' => 20,
        'margin_top' => 20,
        'margin_bottom' => 0,
        'margin_header' => 0,
        'margin_footer' => 0,
      ]);
      $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
      $data['code'] = $this->db->get_where('cetakbarcode',['idUser'=>$data['user']['id']])->result_array();
      $html = $this->load->view('Buku/testPrint', $data, true);
      $mpdf->WriteHTML($html);
      $mpdf->Output();

      // $data['title'] = 'Buku';
      // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
      // $data['code'] = $this->db->get('cetakbarcode')->result_array();
      // $this->load->view('themplate/admin/header2', $data);
      // $this->load->view('themplate/admin/sidebar', $data);
      // $this->load->view('Buku/Barcode', $data);
      // $this->load->view('themplate/admin/bottomBar', $data);
      // $this->load->view('themplate/admin/footer2', $data);
    }
    // end buat barcode Buku reques Ajax

    // public function copyBuku
    public function copyBuku(){
      echo json_encode($this->buku->getDataBukuCopyById($_POST['id']));
    }

    public function copyDataBuku(){
      if($this->buku->ProsesSimpanCopyBuku($_POST)>0){ 
        echo"Sukses";
      }
      else{
        echo"error";
      }

    }


    public function jumlahCetak(){
      $kodeBuku=$_POST['code'];
      $user=$_POST['user'];
      $jumlah= $this->db->get_where('cetakbarcode',['Kodebuku'=>$kodeBuku,'idUser'=>$user])->num_rows();
      return $jumlah;
    }


    // untuk import file buku dengan ajax
    public function importFileBuku(){
      // $inputFileName = $_FILES["importDataBuku"]["tmp_name"];
      $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  
      if(isset($_FILES['importDataBuku']['name']) && in_array($_FILES['importDataBuku']['type'], $file_mimes)) {
 
          $arr_file = explode('.', $_FILES['importDataBuku']['name']);
          $extension = end($arr_file);
      
          if('csv' == $extension) {
              $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
          } else {
              $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
          }
      
          $spreadsheet = $reader->load($_FILES['importDataBuku']['tmp_name']);
          $sheetData = $spreadsheet->getActiveSheet()->toArray();
          $data['duplikast']=0;
          $data['masuk']=0;
          // tahuntereg-tahunbit-tglInput-klasifikasi-komputerisasi
          // 2+2+2+3+4
          $row=[];
          for($i = 1; $i < count($sheetData)-1;$i++)
          { 
                // taggal input
                $tglInput =date('y-m-d');
                $tglInput=explode("-", $tglInput);
                $bln=$tglInput[2];

                $kodeBuku=$sheetData[$i]['7'].$bln.$sheetData[$i]['10'];
                $KodeBukuNext=$this->buku->kodeBuku($kodeBuku);
                $newKodeBuku=$KodeBukuNext.mt_rand(1,9);
                $insert=[
                  'idKategori'=>$sheetData[$i]['10'],
                  'kodeSpesifikasi'=>$sheetData[$i]['3'],
                  'kodeBuku'=>$newKodeBuku,
                  'judul'=>$sheetData[$i]['4'],
                  'tahun'=>$sheetData[$i]['7'],
                  'pengarang'=> $sheetData[$i]['5'],
                  'jmlhHalaman'=> $sheetData[$i]['9'],
                  'qty'=>$sheetData[$i]['8'],
                  'tglRegister'=> time(),
                  'tglUpdate'=> time(),
                  'statusPeminjaman'=> 1,
                  'statusBuku'=> 5,
                  'barcodeStatus'=> 1,
                  'sampul'=>'defaul.jpg',
                ];

                if($this->db->get_where('buku',['kodeBuku'=>$newKodeBuku])->num_rows()>0){
                  $row['kodeBuku']= $newKodeBuku;
                  $row['judul']=$sheetData[$i]['4'];
                  $row['spek']=$sheetData[$i]['10'];
                  $data['duplikast']++;
                  $buku[]=$row;
                  $data['buku']=$buku;
                  continue;
                }
                
                $this->db->insert('buku', $insert);
                $data['masuk']++;

          }
            
              echo json_encode($data);
      }

    }
    // end untuk import file buku dengan ajax 


    // ambil data kategoribuku Ajax
    public function KetegoriAll(){
      echo json_encode($this->db->get('kategoribuku')->result_array());
    }
    // end ambil data kaegori ajax

    public function SimpanBuku(){
      if($this->buku->ProsesSimpanBuku($_POST)>0){
        echo"Sukses";
      }
      else{
        echo"error";
      }
    }

    // scrip edit data buku
    public function editDataBuku(){
      if($this->buku->ProsesEditBuku($_POST)>0){
        echo"Sukses";
      }
      else{
        echo"error";
      }
    }
    // end script edit data buku


    // get data buku by id dengan aja
    public function getDatabukuById(){
      echo json_encode($this->buku->getDataBukuById($_POST['id']));
    }
    // end get data buku by id dengan ajax

    // hapus data buku
    public function HapusBuku(){
      if($this->buku->prosesHapusBuku($_POST['id']) > 0){
        echo 'ok';
      }
      else{
        echo 'error';
      }
    }
    // end hapus data buku


    // print barcode buku satuan
    public function printBarcodeSatuan(){
      $user= $this->db->get_where('buku',['kodeBuku'=>$_POST['id']])->row_array();
      if($user){
        $insert=[
          'barcodeStatus'=>0,
        ];
        $this->db->set($insert);
        $this->db->where('kodeBuku', $_POST['id']);
        $this->db->update('buku');
        // return $this->db->affected_rows();
        
      }
      $kodebuku=$user['kodeBuku'];
      $connector = new WindowsPrintConnector("EPSON TM-T82 ReceiptSA4");
      // $profile = CapabilityProfile::load("SP2000");
      $printer = new Printer($connector);
      $printer->setBarcodeHeight(95);
      $printer->setBarcodeWidth(4);
      $printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      $printer->setTextSize(1,1);
      $printer->text($user['id']."\n");
      $printer->text($user['judul']."\n");
      $printer->barcode($kodebuku, Printer::BARCODE_ITF);
      $printer->feed(1);
      // $printer->cut(0);
      $printer->cut(Printer::CUT_FULL, 0);
      $printer->close();

    }

  // ==================== End Kumpulan Data Ajax

}