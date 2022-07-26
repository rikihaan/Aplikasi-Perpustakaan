<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pendaftar extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // $this->load->model('pendaftar_model', 'daftar');
    $this->load->model('Pendaftar_m', 'item_m');
    $this->load->model('Ppdb_model', 'daftar');
    $this->load->model('Model_zonasi', 'zonasi');
    is_logged_in();
  }

  public function index()
  {
    $data['title'] = 'Verifikasi';
    $data['prestasi'] = $this->db->get('kategori_penyelengara')->result_array();
    // $data['prestasi'] = $this->db->get('prestasi')->result_array();
    $data['jalur'] = $this->db->get('jalur_ppdb')->result_array();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('themplate/admin/topbar', $data);
    $this->load->view('Pendaftar/index', $data);
    $this->load->view('themplate/admin/footer', $data);
  }

  // datapendaftar terverifikasi
  public function ambilPendaftar()
  {

    $list = $this->item_m->get_datatables();
    // var_dump($list);
    // die;
    $data = array();
    $no = @$_POST['start'];
    foreach ($list as $item) {
      $no++;
      $row = array();
      $row[] = $no . ".";
      $row[] = $item->koreg;
      $row[] = $item->namaSiswa;
      $row[] = $item->asalSekolah;
      $row[] = $item->namaJalur;
      $row[] = '
      <button data-koreg="' . $item->koreg . '" data-id="' . $item->id . '" data-target=".bd-example-modal-lg" class="badge badge-primary viewPendaftar"><i class="fa fa-pencil"></i> View</button>
      <a href="' . base_url('Pendaftar/PrintBuktiRegistrasi/') . $item->koreg . '" target="blank" class="badge badge-warning mr-1 text-white"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
      <a href="' . base_url('Pendaftar/hapusPendaftar/') . $item->id . '" class="badge badge-danger text-white tombolHapus"> <i class="fa fa-trash" aria-hidden="true"></i> Hapus<a/>';
      $data[] = $row;
    }
    $output = array(
      "draw" => @$_POST['draw'],
      "recordsTotal" => $this->item_m->count_all(),
      "recordsFiltered" => $this->item_m->count_filtered(),
      "data" => $data,
    );
    // output to json format

    echo json_encode($output);
  }
  // batas akhir vendaftar terverifikasi======================================================================================


  public function zonasi()
  {
    $data['title'] = 'Jalur Zonasi';
    $data['jalurId'] = $this->db->get_where('jalur_ppdb', ['id' => 1])->row_array();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['zonasi'] = $this->zonasi->getDataDaftar(1);
    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('themplate/admin/topbar', $data);
    $this->load->view('Pendaftar/Zonasi_v', $data);
    $this->load->view('themplate/admin/footer', $data);
  }
  //pendaftar zonasi
  public function Generate()
  {
    $no = 0;
    $list['zonasi'] = $this->zonasi->getDataDaftar(1);
    $jumlahRombel = $this->db->get_where('kop_surat', ['id' => 1])->row_array();
    $jml = $jumlahRombel['jumlahRombel'];
    if ($this->resetRombelByJalur(1) == 'ok') {
      for ($i = 0; $i <  count($list['zonasi']); $i++) {
        $data['jalur'] = $this->db->get_where('jalur_ppdb', ['id' => 1])->row_array();
        $quota = $data['jalur']['quota'];
        if ($no <=  $jml - 1) {
          $no = $no + 1;
        } elseif ($no  =  $jml) {
          $no = $no = 1;
        }
        $quota = $quota - 1;
        if ($i <= $quota) {
          $data = [
            'lulus' => 4,
            'kelRombel' => 'VII-' . $no,
          ];
        } else if ($i > $quota) {

          $data = [
            'lulus' => 5,

          ];
        }
        $this->db->set($data);
        $this->db->where('id', $list['zonasi'][$i]['id']);
        $this->db->update('pendaftar');
      }
    }
    $this->session->set_flashdata('message', '
  <div class="alert alert-success" role="alert">
 Data  berhasil di Generate!!
  </div>');
    redirect('Pendaftar/Zonasi');
  }
  // batas akhir pendaftar zonasi
  // zona Afirmasi
  public function Afirmasi()
  {
    $data['title'] = 'Zonasi Afirmasi';
    $data['prestasi'] = $this->db->get('prestasi')->result_array();
    $data['jalur'] = $this->db->get('jalur_ppdb')->result_array();
    $data['jalurId'] = $this->db->get_where('jalur_ppdb', ['id' => 2])->row_array();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['afirmasi'] = $this->zonasi->getDataDaftarAfirmasi();
    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('themplate/admin/topbar', $data);
    $this->load->view('Pendaftar/Afirmasi_v', $data);
    $this->load->view('themplate/admin/footer', $data);
  }

  public function GenerateAfirmasi()
  {
    $list['afirmasi'] = $this->zonasi->getDataDaftarAfirmasi();
    $no = 0;
    $jumlahRombel = $this->db->get_where('kop_surat', ['id' => 1])->row_array();
    $jml = $jumlahRombel['jumlahRombel'];
    if ($this->resetRombelByJalur(2) == 'ok') {
      for ($i = 0; $i <  count($list['afirmasi']); $i++) {
        $data['jalur'] = $this->db->get_where('jalur_ppdb', ['id' => 2])->row_array();
        $quota = $data['jalur']['quota'];
        if ($no <=  $jml - 1) {
          $no = $no + 1;
        } elseif ($no  =  $jml) {
          $no = $no = 1;
        }
        $quota = $quota - 1;
        if ($i <= $quota) {

          $data = [
            'lulus' => 4,
            'kelRombel' => 'VII-' . $no
          ];
        } else if ($i > $quota) {
          $data = [
            'lulus' => 5,
          ];
        }
        $this->db->set($data);
        $this->db->where('id', $list['afirmasi'][$i]['id']);
        $this->db->update('pendaftar');
      }
    }

    $this->session->set_flashdata('message', '
  <div class="alert alert-success" role="alert">
 Data Afirmasi  berhasil di Generate!!
  </div>');
    redirect('Pendaftar/Afirmasi');
  }

  // akhir batas zonasi Afirmasi


  // zona Perpindahan Orang tua
  public function Orangtua()
  {
    $data['title'] = 'Jalur Perpindahan Orang tua';
    $data['prestasi'] = $this->db->get('prestasi')->result_array();
    $data['jalur'] = $this->db->get('jalur_ppdb')->result_array();
    $data['jalurId'] = $this->db->get_where('jalur_ppdb', ['id' => 3])->row_array();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['orangtua'] = $this->zonasi->getDataDaftarJalurOrangtua();
    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('themplate/admin/topbar', $data);
    $this->load->view('Pendaftar/Orangtua_v', $data);
    $this->load->view('themplate/admin/footer', $data);
  }

  public function GenerateOrangTua()
  {
    $list['orangTua'] = $this->zonasi->getDataDaftarJalurOrangtua();
    $no = 0;
    $jumlahRombel = $this->db->get_where('kop_surat', ['id' => 1])->row_array();
    $jml = $jumlahRombel['jumlahRombel'];
    if ($this->resetRombelByJalur(3)  == 'ok') {
      for ($i = 0; $i <  count($list['orangTua']); $i++) {
        $data['jalur'] = $this->db->get_where('jalur_ppdb', ['id' => 3])->row_array();
        $quota = $data['jalur']['quota'];
        if ($no <=  $jml - 1) {
          $no = $no + 1;
        } elseif ($no  =  $jml) {
          $no = $no = 1;
        }
        $quota = $quota - 1;
        if ($i <= $quota) {

          $data = [
            'lulus' => 4,
            'kelRombel' => 'VII-' . $no
          ];
        } else if ($i > $quota) {

          $data = [
            'lulus' => 5,

          ];
        }

        $this->db->set($data);
        $this->db->where('id', $list['orangTua'][$i]['id']);
        $this->db->update('pendaftar');
      }
    }
    $this->session->set_flashdata('message', '
  <div class="alert alert-success" role="alert">
 Data Jalur Perpindahan Orang tua  berhasil di Generate!!
  </div>');
    redirect('Pendaftar/Orangtua');
  }


  // jalur lomba akademik dan non akademik

  public function Akademik()
  {
    $data['title'] = 'Jalur Lomba Akademik Nonakademik';
    $data['prestasi'] = $this->db->get('prestasi')->result_array();
    $data['jalur'] = $this->db->get('jalur_ppdb')->result_array();
    $data['jalurId'] = $this->db->get_where('jalur_ppdb', ['id' => 4])->row_array();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['akademik'] = $this->zonasi->getDataDaftarJalurAkademik();

    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('themplate/admin/topbar', $data);
    $this->load->view('Pendaftar/Akaddemik_v', $data);
    $this->load->view('themplate/admin/footer', $data);
  }

  public function GenerateAkademik()
  {
    $list['akademik'] = $this->zonasi->getDataDaftarJalurAkademik();
    $no = 0;
    $jumlahRombel = $this->db->get_where('kop_surat', ['id' => 1])->row_array();
    $jml = $jumlahRombel['jumlahRombel'];
    if ($this->resetRombelByJalur(4) == 'ok') {
      for ($i = 0; $i <  count($list['akademik']); $i++) {
        $data['jalur'] = $this->db->get_where('jalur_ppdb', ['id' => 4])->row_array();
        $quota = $data['jalur']['quota'];
        if ($no <=  $jml - 1) {
          $no = $no + 1;
        } elseif ($no  =  $jml) {
          $no = $no = 1;
        }
        $quota = $quota - 1;
        if ($i <= $quota) {

          $data = [
            'lulus' => 4,
            'kelRombel' => 'VII-' . $no
          ];
        } else if ($i > $quota) {

          $data = [
            'lulus' => 5,

          ];
        }
        $this->db->set($data);
        $this->db->where('id', $list['akademik'][$i]['id']);
        $this->db->update('pendaftar');
      }
    }

    $this->session->set_flashdata('message', '
  <div class="alert alert-success" role="alert">
 Data Jalur Lomba Akademik Nonakademik  berhasil di Generate!!
  </div>');
    redirect('Pendaftar/Akademik');
  }


  // jalur perbatasan
  public function Perbatasan()
  {
    $data['title'] = 'Jalur Luar Kabupaten Perbatasan';
    $data['prestasi'] = $this->db->get('prestasi')->result_array();
    $data['jalur'] = $this->db->get('jalur_ppdb')->result_array();
    $data['jalurId'] = $this->db->get_where('jalur_ppdb', ['id' => 5])->row_array();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['perbatasan'] = $this->zonasi->getDataDaftarJalurPerbatasan();

    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('themplate/admin/topbar', $data);
    $this->load->view('Pendaftar/Perbatasan_v', $data);
    $this->load->view('themplate/admin/footer', $data);
  }

  public function GeneratePerbatasan()
  {
    $list['perbatasan'] = $this->zonasi->getDataDaftarJalurPerbatasan();
    $no = 0;
    $jumlahRombel = $this->db->get_where('kop_surat', ['id' => 1])->row_array();
    $jml = $jumlahRombel['jumlahRombel'];
    if ($this->resetRombelByJalur(5)  == 'ok') {
      for ($i = 0; $i <  count($list['perbatasan']); $i++) {
        $data['jalur'] = $this->db->get_where('jalur_ppdb', ['id' => 5])->row_array();
        $quota = $data['jalur']['quota'];
        if ($no <=  $jml - 1) {
          $no = $no + 1;
        } elseif ($no  =  $jml) {
          $no = $no = 1;
        }
        $quota = $quota - 1;
        if ($i <= $quota) {

          $data = [
            'lulus' => 4,
            'kelRombel' => 'VII-' . $no
          ];
        } else if ($i > $quota) {

          $data = [
            'lulus' => 5,

          ];
        }
        $this->db->set($data);
        $this->db->where('id', $list['perbatasan'][$i]['id']);
        $this->db->update('pendaftar');
      }
    }

    $this->session->set_flashdata('message', '
  <div class="alert alert-success" role="alert">
 Data Jalur Pendafar Perbatasan berhasil di Generate!!
  </div>');
    redirect('Pendaftar/Perbatasan');
  }


  // jalur rerata raport
  public function Raport()
  {
    $data['title'] = 'Jalur Rerata Nilai Raport';
    $data['prestasi'] = $this->db->get('prestasi')->result_array();
    $data['jalur'] = $this->db->get('jalur_ppdb')->result_array();
    $data['jalurId'] = $this->db->get_where('jalur_ppdb', ['id' => 6])->row_array();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['raport'] = $this->zonasi->getDataDaftarJalurRaport();

    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('themplate/admin/topbar', $data);
    $this->load->view('Pendaftar/Raport_v', $data);
    $this->load->view('themplate/admin/footer', $data);
  }

  public function Generateraport()
  {
    $list['raport'] = $this->zonasi->getDataDaftarJalurRaport();
    $no = 0;
    $jumlahRombel = $this->db->get_where('kop_surat', ['id' => 1])->row_array();
    $jml = $jumlahRombel['jumlahRombel'];
    if ($this->resetRombelByJalur(6)  == 'ok') {
      for ($i = 0; $i <  count($list['raport']); $i++) {
        $data['jalur'] = $this->db->get_where('jalur_ppdb', ['id' => 6])->row_array();
        $quota = $data['jalur']['quota'];
        if ($no <=  $jml - 1) {
          $no = $no + 1;
        } elseif ($no  =  $jml) {
          $no = $no = 1;
        }
        $quota = $quota - 1;
        if ($i <= $quota) {

          $data = [
            'lulus' => 4,
            'kelRombel' => 'VII-' . $no
          ];
        } else if ($i > $quota) {

          $data = [
            'lulus' => 5,
          ];
        }
        $this->db->set($data);
        $this->db->where('id', $list['raport'][$i]['id']);
        $this->db->update('pendaftar');
      }
    }
    $this->session->set_flashdata('message', '
  <div class="alert alert-success" role="alert">
 Data Jalur Rerata Nilai Raport berhasil di Generate!!
  </div>');
    redirect('Pendaftar/Raport');
  }

  // print pendaftar berdasarkan jalur
  public function Pzonasi()
  {
    $data['sekolah'] = $this->db->get('kop_surat')->row_array();
    $sekolah = $data['sekolah']['nama_sekolah'];
    $data['pendaftar'] = $this->zonasi->getDataDaftarZonasi();
    $alamat = $data['sekolah']['alamat'];
    $mpdf = new \Mpdf\Mpdf([
      'format' => 'Legal-P',
      'margin_left' => 20,
      'margin_right' => 20,
      'margin_top' => 60,
      'margin_bottom' => 30,
      'margin_header' => 20,
      'margin_footer' => 10,
    ]);
    $html = $this->load->view('Pendaftar/PrintDataZonasi', $data, true);
    $html2 = $this->load->view('Pendaftar/headerZonasi', $data, true);
    $mpdf->SetHTMLHeader($html2);
    $mpdf->WriteHTML($html);
    $mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%" style="font-size:10px;">{DATE j-m-Y}</td>
        <td width="33%" align="center" style="font-size:10px;">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right; font-size:10px;">' . $sekolah  . '</td>
    </tr>
</table>');
    $mpdf->Output();
  }

  public function Pafirmasi()
  {
    $data['sekolah'] = $this->db->get('kop_surat')->row_array();
    $sekolah = $data['sekolah']['nama_sekolah'];
    $data['pendaftar'] = $this->zonasi->getDataDaftarAllAfirmasi();

    $alamat = $data['sekolah']['alamat'];
    $mpdf = new \Mpdf\Mpdf([
      'format' => 'Legal-P',
      'margin_left' => 20,
      'margin_right' => 20,
      'margin_top' => 60,
      'margin_bottom' => 30,
      'margin_header' => 15,
      'margin_footer' => 10,
    ]);
    $html = $this->load->view('Pendaftar/PrintDataAfirmasi', $data, true);
    $html2 = $this->load->view('Pendaftar/headerAfirmasi', $data, true);
    $mpdf->SetHTMLHeader($html2);
    $mpdf->WriteHTML($html);
    $mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%" style="font-size:10px;">{DATE j-m-Y}</td>
        <td width="33%" align="center" style="font-size:10px;">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right; font-size:10px;">' . $sekolah  . '</td>
    </tr>
</table>');
    $mpdf->Output();
  }


  public function Portu()
  {
    $data['sekolah'] = $this->db->get('kop_surat')->row_array();
    $sekolah = $data['sekolah']['nama_sekolah'];
    $data['pendaftar'] = $this->zonasi->getDataDaftarAllJalurOrangtua();

    $alamat = $data['sekolah']['alamat'];
    $mpdf = new \Mpdf\Mpdf([
      'format' => 'Legal-P',
      'margin_left' => 20,
      'margin_right' => 20,
      'margin_top' => 60,
      'margin_bottom' => 30,
      'margin_header' => 15,
      'margin_footer' => 10,
    ]);
    $html = $this->load->view('Pendaftar/PrintDataOrtu', $data, true);
    $html2 = $this->load->view('Pendaftar/headerOrtu', $data, true);
    $mpdf->SetHTMLHeader($html2);
    $mpdf->WriteHTML($html);
    $mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%" style="font-size:10px;">{DATE j-m-Y}</td>
        <td width="33%" align="center" style="font-size:10px;">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right; font-size:10px;">' . $sekolah  . '</td>
    </tr>
</table>');
    $mpdf->Output();
  }

  public function Paka()
  {
    $data['sekolah'] = $this->db->get('kop_surat')->row_array();
    $sekolah = $data['sekolah']['nama_sekolah'];
    $data['pendaftar'] = $this->zonasi->getDataDaftarAllJalurAkademik();

    $alamat = $data['sekolah']['alamat'];
    $mpdf = new \Mpdf\Mpdf([
      'format' => 'Legal-P',
      'margin_left' => 20,
      'margin_right' => 20,
      'margin_top' => 60,
      'margin_bottom' => 30,
      'margin_header' => 15,
      'margin_footer' => 10,
    ]);
    $html = $this->load->view('Pendaftar/PrintDataAka', $data, true);
    $html2 = $this->load->view('Pendaftar/headerAka', $data, true);
    $mpdf->SetHTMLHeader($html2);
    $mpdf->WriteHTML($html);
    $mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%" style="font-size:10px;">{DATE j-m-Y}</td>
        <td width="33%" align="center" style="font-size:10px;">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right; font-size:10px;">' . $sekolah  . '</td>
    </tr>
</table>');
    $mpdf->Output();
  }


  public function Pbatas()
  {
    $data['sekolah'] = $this->db->get('kop_surat')->row_array();
    $sekolah = $data['sekolah']['nama_sekolah'];
    $data['pendaftar'] = $this->zonasi->getDataDaftarAllJalurPerbatasan();

    $alamat = $data['sekolah']['alamat'];
    $mpdf = new \Mpdf\Mpdf([
      'format' => 'Legal-P',
      'margin_left' => 20,
      'margin_right' => 20,
      'margin_top' => 60,
      'margin_bottom' => 30,
      'margin_header' => 15,
      'margin_footer' => 15,
    ]);
    $html = $this->load->view('Pendaftar/PrintDataBatas', $data, true);
    $html2 = $this->load->view('Pendaftar/headerBatas', $data, true);
    $mpdf->SetHTMLHeader($html2);
    $mpdf->WriteHTML($html);
    $mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%" style="font-size:10px;">{DATE j-m-Y}</td>
        <td width="33%" align="center" style="font-size:10px;">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right; font-size:10px;">' . $sekolah  . '</td>
    </tr>
</table>');
    $mpdf->Output();
  }

  public function Praport()
  {
    $data['sekolah'] = $this->db->get('kop_surat')->row_array();
    $sekolah = $data['sekolah']['nama_sekolah'];
    $data['pendaftar'] = $this->zonasi->getDataDaftarAllJalurRaport();

    $alamat = $data['sekolah']['alamat'];
    $mpdf = new \Mpdf\Mpdf([
      'format' => 'Legal-P',
      'margin_left' => 20,
      'margin_right' => 20,
      'margin_top' => 60,
      'margin_bottom' => 30,
      'margin_header' => 15,
      'margin_footer' => 15,
    ]);
    $html = $this->load->view('Pendaftar/PrintDataRaport', $data, true);
    $html2 = $this->load->view('Pendaftar/headerRaport', $data, true);
    $mpdf->SetHTMLHeader($html2);
    $mpdf->WriteHTML($html);
    $mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%" style="font-size:10px;">{DATE j-m-Y}</td>
        <td width="33%" align="center" style="font-size:10px;">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right; font-size:10px;">' . $sekolah  . '</td>
    </tr>
</table>');
    $mpdf->Output();
  }

  public function PrintBuktiRegistrasi($koreg)
  {
    // $this->load->library('dompdf_gen');
    $data['sekolah'] = $this->db->get('kop_surat')->row_array();
    $sekolah = $data['sekolah']['nama_sekolah'];
    $query = "SELECT `jalur_ppdb`.`ppdb`, `pendaftar`.*,`villages`.`name` as desa, `districts`.`name` as kec, `regencies`.`name` as kot,`provinces`.`name` as prov
    FROM `pendaftar` 
    JOIN `jalur_ppdb` ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    JOIN `villages` ON `pendaftar`.`desa`=`villages`.`id`
    JOIN `districts` ON `villages`.`district_id`=`districts`.`id`
    JOIN `regencies` ON `districts`.`regency_id`=`regencies`.`id`
    JOIN `provinces` ON `regencies`.`province_id`=`provinces`.`id`
    WHERE `pendaftar`.`koreg`=$koreg
    ";
    $query2 = "SELECT `prestasi`.`kejuaraan`,`score`,`pendaftar`.*, `kat_satuan`.*,`kategori_penyelengara`.*
          FROM `pendaftar` 
          JOIN `prestasi` ON `pendaftar`.`idPrestasi`=`prestasi`.`id`
          JOIN `kat_satuan` ON `prestasi`.`id_satuan`=`kat_satuan`.`id_satuan`
          JOIN `kategori_penyelengara` ON `kat_satuan`.`id_penyelengara`=`kategori_penyelengara`.`id_penyelengara`
          WHERE `pendaftar`.`koreg`=$koreg
          ";
    $data['prestasi'] = $this->db->query($query2)->row_array();
    $data['siswa'] = $this->db->query($query)->row_array();
    $data['sarat'] = $this->db->get_where('persyaratan', ['id_jalur' => $data['siswa']['id_jalur']])->result_array();
    $data['setting'] = $this->db->get('kop_surat')->row_array();
    // $this->load->view('Home/CetakRegistrasi', $data);
    $mpdf = new \Mpdf\Mpdf([
      'format' => 'Legal-P',
      'margin_left' => 22,
      'margin_right' => 20,
      'margin_top' => 20,
      'margin_bottom' => 0,
      'margin_header' => 0,
      'margin_footer' => 0,
    ]);
    $html = $this->load->view('Home/CetakRegistrasi', $data, true);
    $html2 = $this->load->view('Home/perjanjianMutlakOrangtua', $data, true);
    $mpdf->WriteHTML($html);
    $mpdf->AddPage();
    $mpdf->WriteHTML($html2);
    $mpdf->SetHTMLFooter('
 <table width="100%">
     <tr>
         <td width="33%" style="font-size:8px;">{DATE j-m-Y}</td>
         <td width="33%" align="center" style="font-size:8px;">{PAGENO}/{nbpg}</td>
         <td width="33%" style="text-align: right; font-size:8px;">' . $sekolah  . '</td>
     </tr>
 </table>');
    $mpdf->Output();
  }

  public function hapusPendaftar($id)
  {
    $user = $this->db->get_where('pendaftar', ['id' => $id])->row_array();
    $this->db->delete('pendaftar', ['id' => $id]);
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
     Data Pendaftar ' . $user['namaSiswa'] . ' berhasil di Hapus!!
      </div>');
      redirect('Pendaftar');
    } else {
      $this->session->set_flashdata('message', '
      <div class="alert alert-danger" role="alert">
     Data Pendaftar ' . $user['namaSiswa'] . ' berhasil di Hapus!!
      </div>');
      redirect('Pendaftar');
    }
  }

  // get data yg lulus
  public function Lulus()
  {
    $data['title'] = 'Data Yang Lulus';
    $data['pendaftar'] = $this->item_m->getDataLulusAll();
    $data['jalur'] = $this->db->get_where('jalur_ppdb', ['statusAktif' => 1])->result_array();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('themplate/admin/topbar', $data);
    $this->load->view('Pendaftar/Lulus_v', $data);
    $this->load->view('themplate/admin/footer', $data);
  }

  public function tidakLulus()
  {
    $data['title'] = 'Data Tidak Lulus';
    $data['pendaftar'] = $this->item_m->getDataTidakLulusAll();
    $data['jalur'] = $this->db->get_where('jalur_ppdb', ['statusAktif' => 1])->result_array();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('themplate/admin/header', $data);
    $this->load->view('themplate/admin/sidebar', $data);
    $this->load->view('themplate/admin/topbar', $data);
    $this->load->view('Pendaftar/tidakLulus_v', $data);
    $this->load->view('themplate/admin/footer', $data);
  }

  public function resetById($id)
  {
    if ($this->item_m->prosesResetByid($id) > 0) {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
        Reset Data Berhasil !!
      </div>');
      redirect('Pendaftar/lulus');
    }
  }

  public function resetByIdTidakLulus($id)
  {
    if ($this->item_m->prosesResetByid($id) > 0) {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
        Reset Data Berhasil !!
      </div>');
      redirect('Pendaftar/tidakLulus');
    } else {
      $this->session->set_flashdata('message', '
      <div class="alert alert-danger" role="alert">
        Reset Data Gagal !!
      </div>');
      redirect('Pendaftar/tidakLulus');
    }
  }

  public function resetAllToVerifikasi()
  {
    $data = [
      'lulus' => 0,
      'kelRombel' => '',

    ];
    $where = "statusPendaftaran='2'";
    $this->db->set($data);
    $this->db->where($where);
    $this->db->update('pendaftar');
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
       Semua data berhasil di reset dan di pindah ke daftar yg sudah di verifikasi
      </div>');
      redirect('Pendaftar/lulus');
    } else {
      $this->session->set_flashdata('message', '
      <div class="alert alert-danger" role="alert">
       Semua data Gagal di reset dan di pindah ke daftar yg sudah di verifikasi
      </div>');
      redirect('Pendaftar/lulus');
    }
  }

  public function cetakLulusByjalur($jalur)
  {
    $data['sekolah'] = $this->db->get('kop_surat')->row_array();
    $data['tanggalSurat'] = $this->daftar->tanggal_indonesia(date('Y-m-d', strtotime($data['sekolah']['tanggalKelulusan'])));
    // var_dump($data['rangking']);
    // die;
    $sekolah = $data['sekolah']['nama_sekolah'];
    $logo = $data['sekolah']['logo'];
    $data['daftar'] = $this->item_m->getDataLulusById($jalur);
    $alamat = $data['sekolah']['alamat'];
    $mpdf = new \Mpdf\Mpdf([
      'format' => 'A4-P',
      'margin_left' => 20,
      'margin_right' => 20,
      'margin_top' => 16,
      'margin_bottom' => 0,
      'margin_header' => 0,
      'margin_footer' => 4,
    ]);
    ini_set('max_execution_time', '3000');
    ini_set("pcre.backtrack_limit", "5000000");
    $htmlheader = $this->load->view('Admin/footerPrint', $data, true);
    $html = $this->load->view('Admin/printLulus', $data, true);
    $mpdf->SetHTMLHeader($htmlheader);
    $mpdf->WriteHTML($html);
    $mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%" style="font-size:9px;">{DATE j-m-Y}</td>
        <td width="33%" align="center" style="font-size:8px;">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right; font-size:8px;">' . $sekolah  . '</td>
    </tr>
</table>');
    $mpdf->Output();
  }

  // print lulus satuan
  public function printDataLulus($koreg)
  {
    if ($this->db->get_where('pendaftar', ['koreg' => $koreg, 'lulus' => 4])->num_rows() > 0) {
      $data['sekolah'] = $this->db->get('kop_surat')->row_array();
      $data['tanggalSurat'] = $this->daftar->tanggal_indonesia(date('Y-m-d', strtotime($data['sekolah']['tanggalKelulusan'])));
      // var_dump($data['rangking']);
      // die;
      $sekolah = $data['sekolah']['nama_sekolah'];
      $logo = $data['sekolah']['logo'];
      $data['daftar'] = $this->item_m->printDataLulusSatuan($koreg);
      $alamat = $data['sekolah']['alamat'];
      $mpdf = new \Mpdf\Mpdf([
        'format' => 'A4-P',
        'margin_left' => 20,
        'margin_right' => 20,
        'margin_top' => 16,
        'margin_bottom' => 0,
        'margin_header' => 0,
        'margin_footer' => 4,
      ]);
      $htmlheader = $this->load->view('Pendaftar/footerPrintSatuan', $data, true);
      $html = $this->load->view('Pendaftar/printLulusSatuan', $data, true);
      $mpdf->SetHTMLHeader($htmlheader);
      $mpdf->WriteHTML($html);
      $mpdf->SetHTMLFooter('
  <table width="100%">
      <tr>
          <td width="33%" style="font-size:9px;">{DATE j-m-Y}</td>
          <td width="33%" align="center" style="font-size:8px;"></td>
          <td width="33%" style="text-align: right; font-size:8px;">' . $sekolah  . '</td>
      </tr>
  </table>');
      $mpdf->Output();
    } else {
      $mpdf = new \Mpdf\Mpdf([
        'format' => 'A4-P',
        'margin_left' => 20,
        'margin_right' => 20,
        'margin_top' => 16,
        'margin_bottom' => 0,
        'margin_header' => 0,
        'margin_footer' => 4,
      ]);
      $html = $this->load->view('Home/PrintPDF', [], true);
      $mpdf->WriteHTML($html);
      $mpdf->Output();
    }
  }

  // print tidak lulus satuan
  public function printDataTidakLulus($koreg)
  {
    if ($this->db->get_where('pendaftar', ['koreg' => $koreg, 'lulus' => 5])->num_rows() > 0) {
      $data['sekolah'] = $this->db->get('kop_surat')->row_array();
      $data['tanggalSurat'] = $this->daftar->tanggal_indonesia(date('Y-m-d', strtotime($data['sekolah']['tanggalKelulusan'])));
      // var_dump($data['rangking']);
      // die;
      $sekolah = $data['sekolah']['nama_sekolah'];
      $logo = $data['sekolah']['logo'];
      $data['daftar'] = $this->item_m->printDataTidakLulusSatuan($koreg);
      $alamat = $data['sekolah']['alamat'];
      $mpdf = new \Mpdf\Mpdf([
        'format' => 'A4-P',
        'margin_left' => 20,
        'margin_right' => 20,
        'margin_top' => 16,
        'margin_bottom' => 0,
        'margin_header' => 0,
        'margin_footer' => 4,
      ]);
      $htmlheader = $this->load->view('Pendaftar/footerPrintSatuan', $data, true);
      $html = $this->load->view('Pendaftar/printTidakLulusSatuan', $data, true);
      $mpdf->SetHTMLHeader($htmlheader);
      $mpdf->WriteHTML($html);
      $mpdf->SetHTMLFooter('
  <table width="100%">
      <tr>
          <td width="33%" style="font-size:9px;">{DATE j-m-Y}</td>
          <td width="33%" align="center" style="font-size:8px;"></td>
          <td width="33%" style="text-align: right; font-size:8px;">' . $sekolah  . '</td>
      </tr>
  </table>');
      $mpdf->Output();
    } else {
      $mpdf = new \Mpdf\Mpdf([
        'format' => 'A4-P',
        'margin_left' => 20,
        'margin_right' => 20,
        'margin_top' => 16,
        'margin_bottom' => 0,
        'margin_header' => 0,
        'margin_footer' => 4,
      ]);
      $html = $this->load->view('Home/PrintPDF', [], true);
      $mpdf->WriteHTML($html);
      $mpdf->Output();
    }
  }

  public function cetakTidakLulusByjalur($jalur)
  {
    $data['sekolah'] = $this->db->get('kop_surat')->row_array();
    $data['tanggalSurat'] = $this->daftar->tanggal_indonesia(date('Y-m-d', strtotime($data['sekolah']['tanggalKelulusan'])));
    // var_dump($data['rangking']);
    // die;
    $sekolah = $data['sekolah']['nama_sekolah'];
    $logo = $data['sekolah']['logo'];
    $data['daftar'] = $this->item_m->getDataTidakLulusByjalur($jalur);
    $alamat = $data['sekolah']['alamat'];
    $mpdf = new \Mpdf\Mpdf([
      'format' => 'A4-P',
      'margin_left' => 20,
      'margin_right' => 20,
      'margin_top' => 16,
      'margin_bottom' => 0,
      'margin_header' => 0,
      'margin_footer' => 4,
    ]);
    ini_set('max_execution_time', '3000');
    ini_set("pcre.backtrack_limit", "5000000");
    $htmlheader = $this->load->view('Admin/footerPrint', $data, true);
    $html = $this->load->view('Admin/printTidakLulus', $data, true);
    $mpdf->SetHTMLHeader($htmlheader);
    $mpdf->WriteHTML($html);
    $mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%" style="font-size:9px;">{DATE j-m-Y}</td>
        <td width="33%" align="center" style="font-size:8px;">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right; font-size:8px;">' . $sekolah  . '</td>
    </tr>
</table>');
    $mpdf->Output();
  }

  private function resetRombelByJalur($idjalur)
  {
    $data = [
      'kelRombel' => ''
    ];
    $this->db->set($data);
    $this->db->where('statusPendaftaran', 2);
    $this->db->where('id_jalur', $idjalur);
    $this->db->update('pendaftar');
    return "ok";
  }

  public function refreshDatabase()
  {
    $data = [
      'statusPendaftaran' => 1
    ];
    $this->db->set($data);
    $this->db->where('statusPendaftaran', 0);
    $this->db->update('pendaftar');
    $this->session->set_flashdata('message', '
      <div class="alert alert-success" role="alert">
      Database Berhasi Di refresh
      </div>');
    redirect('Setting');
  }
}
