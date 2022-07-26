<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_zonasi extends CI_Model
{
  public function getDataDaftarlimit($jalur)
  {
    $lim = $this->db->get_where('jalur_ppdb', ['id' => 2])->row_array();
    $limit = $lim['quota'];
    $query = "SELECT `pendaftar`.`namaSiswa`,totalNilai,totalJarak,asalSekolah,koreg,`pendaftar`.`id`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= $jalur AND `pendaftar`.`statusPendaftaran`=2
    ORDER BY `pendaftar`.`totalJarak` ASC ,`pendaftar`.`totalNilai`
     DESC LIMIT $limit ";
    return $this->db->query($query)->result_array();
  }

  public function getDataDaftar($jalur)
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,statusPendaftaran,jumlahRataRata,totalNilai,totalJarak,asalSekolah,koreg,`pendaftar`.`id`,`usiaSiswa`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= $jalur AND `pendaftar`.`statusPendaftaran`=2
    ORDER BY `pendaftar`.`totalJarak` ASC ,`pendaftar`.`usiaSiswa` DESC, `pendaftar`.`jumlahRataRata` DESC  ";
    return $this->db->query($query)->result_array();
  }

  public function getDataDaftarAfirmasi()
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,statusPendaftaran,jumlahRataRata,totalNilai,totalJarak,asalSekolah,koreg,`pendaftar`.`id`,`usiaSiswa`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= 2 AND `pendaftar`.`statusPendaftaran`=2
    ORDER BY `pendaftar`.`totalJarak` ASC ,`pendaftar`.`usiaSiswa` DESC,`pendaftar`.`jumlahRataRata` DESC ";
    return $this->db->query($query)->result_array();
  }

  public function getDataDaftarJalurOrangtua()
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,statusPendaftaran,jumlahRataRata,totalNilai,totalJarak,asalSekolah,koreg,`pendaftar`.`id`,`usiaSiswa`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= 3 AND `pendaftar`.`statusPendaftaran`=2
    ORDER BY `pendaftar`.`totalJarak` ASC ,`pendaftar`.`usiaSiswa` DESC, `pendaftar`.`jumlahRataRata` DESC";
    return $this->db->query($query)->result_array();
  }

  public function getDataDaftarJalurAkademik()
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,statusPendaftaran,jumlahRataRata,totalNilai,totalJarak,asalSekolah,koreg,nilaiPrestasi,`pendaftar`.`id`,`usiaSiswa`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= 4 AND `pendaftar`.`statusPendaftaran`=2
    ORDER BY `pendaftar`.`nilaiPrestasi` DESC ,`pendaftar`.`totalJarak` ASC,`pendaftar`.`usiaSiswa` DESC,`pendaftar`.`jumlahRataRata` DESC   ";
    return $this->db->query($query)->result_array();
  }

  public function getDataDaftarJalurPerbatasan()
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,statusPendaftaran,jumlahRataRata,totalNilai,totalJarak,asalSekolah,koreg,`pendaftar`.`id`,`usiaSiswa`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= 5 AND `pendaftar`.`statusPendaftaran`=2
    ORDER BY `pendaftar`.`totalJarak` ASC ,`pendaftar`.`usiaSiswa` DESC, `pendaftar`.`jumlahRataRata` DESC";
    return $this->db->query($query)->result_array();
  }

  public function getDataDaftarJalurRaport()
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,statusPendaftaran,jumlahRataRata,totalNilai,rataRataTotalNilai,totalJarak,asalSekolah,koreg,nilaiPrestasi,`pendaftar`.`id`,`usiaSiswa`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= 6 AND `pendaftar`.`statusPendaftaran`=2
    ORDER BY `pendaftar`.`jumlahRataRata` DESC,`pendaftar`.`totalJarak` ASC, `pendaftar`.`usiaSiswa` DESC";
    return $this->db->query($query)->result_array();
  }
  // area print data all per jalur
  public function getDataDaftarZonasi()
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,statusPendaftaran,lulus,jumlahRataRata,totalNilai,totalJarak,asalSekolah,koreg,`pendaftar`.`id`,`usiaSiswa`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= 1 AND `pendaftar`.`statusPendaftaran`=2
    ORDER BY `pendaftar`.`totalJarak` ASC ,`pendaftar`.`usiaSiswa` DESC , `pendaftar`.`jumlahRataRata` DESC";
    return $this->db->query($query)->result_array();
  }

  // jalur zonasi afirmasi
  public function getDataDaftarAllAfirmasi()
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,statusPendaftaran,lulus,jumlahRataRata,totalNilai,totalJarak,asalSekolah,koreg,`pendaftar`.`id`,`usiaSiswa`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= 2 AND `pendaftar`.`statusPendaftaran`=2
    ORDER BY `pendaftar`.`totalJarak` ASC, `pendaftar`.`usiaSiswa` DESC, `pendaftar`.`jumlahRataRata` DESC";
    return $this->db->query($query)->result_array();
  }

  // jalur orng tua
  public function getDataDaftarAllJalurOrangtua()
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,statusPendaftaran,lulus,jumlahRataRata,totalNilai,totalJarak,asalSekolah,koreg,`pendaftar`.`id`,`usiaSiswa`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= 3 AND `pendaftar`.`statusPendaftaran`=2
    ORDER BY `pendaftar`.`totalJarak` ASC ,`pendaftar`.`usiaSiswa` DESC, `pendaftar`.`jumlahRataRata` DESC";
    return $this->db->query($query)->result_array();
  }

  // jalur lomba akademik dan non akademik
  public function getDataDaftarAllJalurAkademik()
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,statusPendaftaran,lulus,jumlahRataRata,totalNilai,totalJarak,asalSekolah,koreg,nilaiPrestasi,`pendaftar`.`id`,`usiaSiswa`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= 4 AND `pendaftar`.`statusPendaftaran`=2
    ORDER BY `pendaftar`.`nilaiPrestasi` DESC, `pendaftar`.`totalJarak` ASC, `pendaftar`.`usiaSiswa` DESC, `pendaftar`.`jumlahRataRata` DESC";
    return $this->db->query($query)->result_array();
  }

  // jalur perbatasan
  public function getDataDaftarAllJalurPerbatasan()
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,statusPendaftaran,lulus,jumlahRataRata,totalNilai,totalJarak,asalSekolah,koreg,`pendaftar`.`id`,`usiaSiswa`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= 5 AND `pendaftar`.`statusPendaftaran`=2
    ORDER BY `pendaftar`.`totalJarak` ASC ,`pendaftar`.`usiaSiswa` DESC, `pendaftar`.`jumlahRataRata` DESC";
    return $this->db->query($query)->result_array();
  }

  public function getDataDaftarAllJalurRaport()
  {
    $query = "SELECT `pendaftar`.`namaSiswa`,statusPendaftaran,lulus,jumlahRataRata,totalNilai,rataRataTotalNilai,totalJarak,asalSekolah,koreg,nilaiPrestasi,`pendaftar`.`id`,`usiaSiswa`,`jalur_ppdb`.`ppdb`
    FROM `pendaftar` JOIN `jalur_ppdb`
    ON `pendaftar`.`id_jalur`=`jalur_ppdb`.`id`
    WHERE `pendaftar`.`id_jalur`= 6 AND `pendaftar`.`statusPendaftaran`=2
    ORDER BY `pendaftar`.`jumlahRataRata` DESC,`pendaftar`.`totalJarak` ASC, `pendaftar`.`usiaSiswa` DESC";
    return $this->db->query($query)->result_array();
  }
}
