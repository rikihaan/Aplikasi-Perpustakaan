<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Grafik_m extends CI_Model
{
    public function getGrafik(){
      $query = "SELECT  MONTH(tglKunjungan) AS bulan, COUNT(*) AS jumlah_bulanan
      FROM bukutamu
      GROUP BY MONTH(tglKunjungan)";
      $bulan =$this->db->query($query)->result_array();

      $data = [];
      foreach ($bulan as $item) {
        $row['bulan'] = $this->_bulan($item['bulan']);
        $row['baca'] = $this->_baca($item['bulan']);
        $row['pinjam'] = $this->_pinjam($item['bulan']);
        $row['kembali'] = $this->_kembali($item['bulan']);
        $data[] = $row;
      }

      return $data;

    }

    public function getGrafikKelas(){
      $query = "SELECT  kelas AS kelas, COUNT(*) AS jumlah
      FROM bukutamu
      GROUP BY kelas";
      return $this->db->query($query)->result_array();
    }

    public function peminatanBaca(){
      $query = "SELECT `kodeBuku.peminjaman` AS `peminjaman`, `kodeBuku`.`buku`, `idKategori`.`buku`, COUNT(*) AS jumlah
      FROM peminjaman
      JOIN buku on `kodeBuku`.`buku`=`kodeBuku`.`peminjaman`
      GROUP BY `idKategori`.`buku`";
      return $this->db->query($query)->result_array();
    }

    // getit bulan
    private function _bulan($bulan){
      if($bulan==1){
        $name = "Januari";
      }
      elseif($bulan==2){
        $name = "Februari";
      }
      elseif($bulan==3){
        $name = "Maret";
      }
      elseif($bulan==3){
        $name = "Maret";
      }
      elseif($bulan==4){
        $name = "April";
      }
      elseif($bulan==5){
        $name = "Mei";
      }
      elseif($bulan==6){
        $name = "Juni";
      }
      elseif($bulan==7){
        $name = "Juli";
      }
      elseif($bulan==8){
        $name = "Agustus";
      }
      elseif($bulan==9){
        $name = "September";
      }
      elseif($bulan==10){
        $name = "Oktober";
      }
      elseif($bulan==11){
        $name = "November";
      }
      else{
        $name = "Desember";
      }
      return $name;
    }
    // hitung membaca
    private function _baca($bulan){
      $query = "SELECT *
      FROM bukutamu
       WHERE MONTH(tglKunjungan)=$bulan AND baca = 1";
      $baca =$this->db->query($query)->num_rows();
      return $baca;
    }
    // hitung peminjaman
    private function _pinjam($bulan){
      $query = "SELECT *
      FROM bukutamu
       WHERE MONTH(tglKunjungan)=$bulan AND pinjam = 1";
      $pinjam =$this->db->query($query)->num_rows();
      return $pinjam;
    }
    // hitung pengembalian
    private function _kembali($bulan){
      $query = "SELECT *
      FROM bukutamu
       WHERE MONTH(tglKunjungan)=$bulan AND kembali = 1";
      $kembali =$this->db->query($query)->num_rows();
      return $kembali;
    }
}