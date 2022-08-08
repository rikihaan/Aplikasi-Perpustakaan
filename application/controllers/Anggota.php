<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Anggota extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Anggota_model', 'anggota');
    is_logged_in();
  }

  public function index()
  {
    $data['title'] = 'Anggota';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['kelas'] = $this->db->get('kelas')->result_array();
    $this->load->view('themplate/admin/header2', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('Anggota/index', $data);
    $this->load->view('themplate/admin/bottomBar', $data);
    $this->load->view('themplate/admin/footer2', $data);
  }

  // ========================kumpulan data Get Secara Ajax

  // get all Data Anggota
  public function GetDataAnggotaAll()
  {

    $list = $this->anggota->getDataAnggotaAll();
    $data = array();
    $no = @$_POST['start'];
    $tombol = '';
    $warna = '';
    foreach ($list as $item) {
      $no++;
      $row = array();
      $row[] = $no . ".";
      $row[] = $item->id;
      $row[] = $item->nama;
      $row[] = $item->kelas;
      if ($item->status == 1) {
        $tombol = 'Nonaktifkan';
        $warna = 'badge-success';
      } else if ($item->status == 0) {
        $tombol = 'Aktifkan';
        $warna = 'badge-secondary';
      }
      $row[] = '<button data-id="' . $item->id . '" class="badge badge-primary tombolEditAnggota"><i class="fa fa-pen"></i> Edit</button> 
                    <button class="badge badge-danger tombolHapusAnggota"  data-id="' . $item->id . '"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</button>
                    <button class="badge ' . $warna . ' aktifNonaktif"  data-id="' . $item->id . '">' . $tombol . '</button>';
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
  public function GetdataKelas()
  {
    echo json_encode($this->db->get('kelas')->result_array());
  }

  // function simpan anggota
  public function SimpanAnggota()
  {
    if ($this->anggota->ProsesSimpanAnggota($_POST) > 0) {
      echo "Sukses";
    } else {
      echo "error";
    }
  }

  // edit data anggota
  public function editDataAnggota()
  {
    if ($this->anggota->ProsesEditAnggota($_POST) > 0) {
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


  // get data anggota by id
  public function getDataAnggotaById()
  {
    echo json_encode($this->anggota->getDataAnggotaById($_POST['id']));
  }

  // untuk import file Anggota dengan ajax
  public function importFileAnggota()
  {
    // $inputFileName = $_FILES["importDataAnggota"]["tmp_name"];
    $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    if (isset($_FILES['importDataAnggota']['name']) && in_array($_FILES['importDataAnggota']['type'], $file_mimes)) {

      $arr_file = explode('.', $_FILES['importDataAnggota']['name']);
      $extension = end($arr_file);

      if ('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
      } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
      }

      $spreadsheet = $reader->load($_FILES['importDataAnggota']['tmp_name']);
      $sheetData = $spreadsheet->getActiveSheet()->toArray();
      $data['duplikast'] = 0;
      $data['masuk'] = 0;
      $data['nisKosong'] = 0;
      $data['nisnKosong'] = 0;

      $row = [];
      $update = [];
      for ($i = 1; $i < count($sheetData); $i++) {
        $insert = [
          'id' => $this->anggota->getKode(),
          'nama' => $sheetData[$i]['3'],
          'kelas' => $sheetData[$i]['4'],
          'nis' => $sheetData[$i]['1'],
          'nisn' => $sheetData[$i]['2'],
          'alamat' => 'None',
          'tglRegister' => time(),
          'foto' => 'difault.jpg',
          'status' => 0,
        ];

        // ambil kode Anggota
        $nisn = $sheetData[$i]['2'];
        if ($this->db->get_where('anggota', ['nisn' => $nisn])->num_rows() > 0) {
          $row['nama'] = $sheetData[$i]['3'];
          $row['kelas'] = $sheetData[$i]['4'];
          $row['nis'] = $sheetData[$i]['1'];
          $row['nisn'] = $sheetData[$i]['2'];
          $update[] = $row;
          $data['anggota'] = $row;
          $data['duplikast']++;
          $this->updateDataSiswa($data['anggota']);
          continue;
        } elseif ($sheetData[$i]['1'] == '') {
          $data['nisKosong']++;
          continue;
        } elseif ($sheetData[$i]['4'] == '') {
          continue;
        } elseif ($sheetData[$i]['2'] == '') {
          $data['nisnKosong']++;
          continue;
        }
        $this->db->insert('anggota', $insert);
        $data['masuk']++;
      }
      $data['update'] = $update;
      echo json_encode($data);
    }
  }
  // end untuk import file Anggota dengan ajax
  public function updateDataSiswa($nisn)
  {
    $this->anggota->prosesUpdateSiswa($nisn);
  }

  // proses aktif non aktifkan anggota
  public function aktifNonaktifAnggota()
  {
    $data['pesan'] = '';
    if ($this->anggota->akfinNonAktif($_POST['id']) > 0) {
      $data['pesan'] = 'success';
      echo json_encode($data);
    } else {
      $data['pesan'] = 'error';
      echo json_encode($data);
    }
  }
  // export data anggota berdasarkan kelas
  public function ExportByKelas(string $kelas)
  {
    $anggota = $this->anggota->exportDataAnggota($kelas);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = [
      'font' => ['bold' => true], // Set font nya jadi bold
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ],
      'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
      ]
    ];
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = [
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ],
      'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
      ]
    ];
    // $sheet->setCellValue('A1', "DATA ANGGOTA PERPUSTAKAAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
    // $sheet->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai F1
    // $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
    // $sheet->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    // Buat header tabel nya pada baris ke 3
    $sheet->setCellValue('A1', "NO"); // Set kolom A3 dengan tulisan "NO"
    $sheet->setCellValue('B1', "NIS"); // Set kolom B3 dengan tulisan "NIS"
    $sheet->setCellValue('C1', "NISN"); // Set kolom C3 dengan tulisan "NAMA"
    $sheet->setCellValue('D1', "NAMA"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
    $sheet->setCellValue('E1', "Kelas"); // Set kolom E3 dengan tulisan "TELEPON"
    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $sheet->getStyle('A1')->applyFromArray($style_col);
    $sheet->getStyle('B1')->applyFromArray($style_col);
    $sheet->getStyle('C1')->applyFromArray($style_col);
    $sheet->getStyle('D1')->applyFromArray($style_col);
    $sheet->getStyle('E1')->applyFromArray($style_col);
    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $row = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach ($anggota as $ang) {
      $sheet->setCellValue('A' . $row, $no);
      $sheet->setCellValue('B' . $row, $ang['nis']);
      $sheet->setCellValue('C' . $row, $ang['nisn']);
      $sheet->setCellValue('D' . $row, $ang['nama']);
      $sheet->setCellValue('E' . $row, $ang['kodeKelas']);
      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $sheet->getStyle('A' . $row)->applyFromArray($style_row);
      $sheet->getStyle('B' . $row)->applyFromArray($style_row);
      $sheet->getStyle('C' . $row)->applyFromArray($style_row);
      $sheet->getStyle('D' . $row)->applyFromArray($style_row);
      $sheet->getStyle('E' . $row)->applyFromArray($style_row);
      $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom No
      $sheet->getStyle('B' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Set text left untuk kolom NIS
      $sheet->getRowDimension($row)->setRowHeight(20); // Set height tiap row
      $no++; // Tambah 1 setiap kali looping
      $row++; // Tambah 1 setiap kali looping
    }
    // Set width kolom
    $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
    $sheet->getColumnDimension('B')->setWidth(10); // Set width kolom B
    $sheet->getColumnDimension('C')->setWidth(10); // Set width kolom C
    $sheet->getColumnDimension('D')->setWidth(35); // Set width kolom D
    $sheet->getColumnDimension('E')->setWidth(10); // Set width kolom E
    // Set judul file excel nya
    $sheet->setTitle("Data Anggota - " . $kelas);
    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Data Anggota-' . $kelas . '.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $writer = new Xlsx($spreadsheet);
    ob_end_clean();
    $writer->save('php://output');
  }
}
