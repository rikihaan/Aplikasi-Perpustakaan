<?php
class Pengunjung extends CI_Controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('Anggota_model', 'anggota');
    }

    public function index(){
    $data['title'] = 'Pengunjung';
    $this->load->view('Pengunjung/index', $data);
    }

    public function cekLogin(){
        $data['pesan']='';
        $id=$_POST['id'];
        if($this->db->get_where('anggota',['id'=>$id])->num_rows()>0){
            $data=$this->db->get_where('anggota',['id'=>$id])->row_array();
            if($data['status']==0){
                $data['pesan']='belumAktif';
                echo json_encode($data);
            }else{
                $session = [
                    'pengunjung' =>$_POST['id']
                  ];
                  $this->session->set_userdata($session);
                  $data['pesan']='ok';
                echo json_encode($data);
            }
        }else{
            $data['pesan']='error';
            echo json_encode($data);

        }
    }

    public function simpanKunjungan(){
        $row[]=isset($_POST['baca']) ? $_POST['baca'] : false ;
        $row[]=isset($_POST['pinjam']) ? $_POST['pinjam'] : false ;
        $row[]=isset($_POST['kembali']) ? $_POST['kembali'] : false ;
        // echo json_encode($row);die;
            $hariIni= date('y-m-d');
            $data['pesan']='';
            $cek=$this->db->get_where('bukutamu',['idAnggota'=>$this->session->userdata('pengunjung'),'tglKunjungan'=>$hariIni])->num_rows();
            if($cek){
                $data['pesan']='error';
                echo json_encode($data);
            }else{
                $data['pesan']='sukses';
                $dataAnggota=$this->db->get_where('anggota',['id'=>$this->session->userdata('pengunjung')])->row_array();
                $insert=[
                    'idAnggota'=>$this->session->userdata('pengunjung'),
                    'baca'=>$row[0],
                    'pinjam'=>$row[1],
                    'kembali'=>$row[2],
                    'kelas'=> $dataAnggota['kelas'],
                    'tglKunjungan'=>date('y-m-d')
                ];
                $this->db->insert('bukutamu', $insert);
                echo json_encode($data);
               

            }
        


      
    }
}