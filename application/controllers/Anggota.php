<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Anggota extends CI_Controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('Anggota_model', 'anggota');
      is_logged_in();
    }

    public function index(){
    $data['title'] = 'Anggota';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('themplate/admin/header2', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('Anggota/index', $data);
    $this->load->view('themplate/admin/bottomBar', $data);
    $this->load->view('themplate/admin/footer2', $data);
    }

    // ========================kumpulan data Get Secara Ajax

    // get all Data Anggota
    public function GetDataAnggotaAll(){

        $list = $this->anggota->getDataAnggotaAll();
        $data = array();
        $no = @$_POST['start'];
        $tombol='';
        $warna='';
        foreach ($list as $item) {
          $no++;
          $row = array();
          $row[] = $no . ".";
          $row[] = $item->id;
          $row[] = $item->nama;
          $row[] = $item->kelas;
          if($item->status==1){
          $tombol='Nonaktifkan';
          $warna='badge-success';

          }else if($item->status==0){
          $tombol='Aktifkan';
          $warna='badge-secondary';
          
          }
          $row[] = '<button data-id="' . $item->id . '" class="badge badge-primary tombolEditAnggota"><i class="fa fa-pen"></i> Edit</button> 
                    <button class="badge badge-danger tombolHapusAnggota"  data-id="' . $item->id . '"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</button>
                    <button class="badge '.$warna.' aktifNonaktif"  data-id="' . $item->id . '">'.$tombol.'</button>';
          $data[] = $row;
        }
        $output = array(
          "draw" => @$_POST['draw'],
          "recordsTotal" => $this->anggota->count_all(),
          "recordsFiltered" => $this->anggota->count_filtered(),
          "data" => $data,
        );
      
  
      echo json_encode($output);
      }
  
    // ==================== End Kumpulan Data Ajax DATA TABLES

    // get data kelas
    public function GetdataKelas(){
      echo json_encode($this->db->get('kelas')->result_array());
    }

    // function simpan anggota
    public function SimpanAnggota(){
      if($this->anggota->ProsesSimpanAnggota($_POST)>0){
        echo"Sukses";
      }
      else{
        echo"error";
      }
    }

    // edit data anggota
      public function editDataAnggota(){
        if($this->anggota->ProsesEditAnggota($_POST)>0){
          echo"Sukses";
        }
        else{
          echo"error";
        }
      }


      // proses hapus data anggota
      public function HapusAnggota(){
        if($this->anggota->prosesHapusAnggota($_POST['id']) > 0){
          echo 'ok';
        }
        else{
          echo 'error';
        }
      }
      

      // get data anggota by id
      public function getDataAnggotaById(){
        echo json_encode($this->anggota->getDataAnggotaById($_POST['id']));

      }

       // untuk import file Anggota dengan ajax
        public function importFileAnggota(){
          // $inputFileName = $_FILES["importDataAnggota"]["tmp_name"];
          $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      
          if(isset($_FILES['importDataAnggota']['name']) && in_array($_FILES['importDataAnggota']['type'], $file_mimes)) {
    
              $arr_file = explode('.', $_FILES['importDataAnggota']['name']);
              $extension = end($arr_file);
          
              if('csv' == $extension) {
                  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
              } else {
                  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
              }
          
              $spreadsheet = $reader->load($_FILES['importDataAnggota']['tmp_name']);
              $sheetData = $spreadsheet->getActiveSheet()->toArray();
              $data['duplikast']=0;
              $data['masuk']=0;
              $data['nisKosong']=0;
              $data['nisnKosong']=0;
              
              $row=[];
              for($i = 1; $i < count($sheetData);$i++)
              {
                    $insert=[
                      'id'=>$this->anggota->getKode(),
                      'nama'=>$sheetData[$i]['3'],
                      'kelas'=>$sheetData[$i]['5'],
                      'nis'=>$sheetData[$i]['1'],
                      'nisn'=>$sheetData[$i]['2'],
                      'alamat'=> 'None',
                      'tglRegister'=> time(),
                      'foto'=>'difault.jpg',
                      'status'=>0,
                    ];

                    // ambil kode Anggota
                    $nisn=$sheetData[$i]['2'];
                    if($this->db->get_where('anggota',['nisn'=>$nisn])->num_rows()>0){
                      $row['nama']=$sheetData[$i]['3'];
                      $row['kelas']=$sheetData[$i]['5'];
                      $row['nis']=$sheetData[$i]['1'];
                      $row['nisn']=$sheetData[$i]['2'];
                      $Anggota[]=$row;
                      $data['anggota']=$Anggota;
                      $data['duplikast']++;
                      $this->updateDataSiswa($Anggota);
                      continue;
                    }
                    elseif($sheetData[$i]['1']==''){
                      $data['nisKosong']++;
                      continue;
                    }
                    elseif($sheetData[$i]['5']==''){
                      
                      continue;
                    }
                    elseif($sheetData[$i]['2']==''){
                      $data['nisnKosong']++;
                      continue;
                    }
                    $this->db->insert('anggota', $insert);
                    $data['masuk']++;

              }
                
                  echo json_encode($data);
          }

        }
      // end untuk import file Anggota dengan ajax
      public function updateDataSiswa($nisn){
        $this->anggota->prosesUpdateSiswa($nisn);
      } 

      // proses aktif non aktifkan anggota
      public function aktifNonaktifAnggota(){
        $data['pesan']='';
        if($this->anggota->akfinNonAktif($_POST['id'])>0){
        $data['pesan']='success';
         echo json_encode($data);
        }else{
          $data['pesan']='error';
          echo json_encode($data);
        }
      }

    



}