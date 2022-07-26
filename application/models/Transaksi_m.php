<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Transaksi_m extends CI_Model
{
    // mengambil data peminjaman dari scan barcode
    public function DataPeminjaman($key = null)
    {
        if ($this->cekPeminjamanDenganKodeBuku($key) > 0) {
            $buku = $this->ambilDataPeminjamanByKodeBuku($key);
            return $this->ambilDataPeminjamanByIdAnggota($buku[0]['IdAnggota']);
        } else if ($this->cekPeminjamanDenganKodeAnggota($key) > 0) {
            return $this->ambilDataPeminjamanByIdAnggota($key);
        } else {

            $data = ['pesan' => "kosong"];
            return $data;
        }
    }


    // function cek data peminjaman berdasarkan buku
    public function cekPeminjamanDenganKodeBuku($key)
    {
        return $this->db->get_where('peminjaman', ['kodeBuku' => $key])->num_rows();
    }

    // cek data peminjaman berdasarkan kode anggota
    public function cekPeminjamanDenganKodeAnggota($key)
    {
        return $this->db->get_where('peminjaman', ['IdAnggota' => $key])->num_rows();
    }


    // ambil data peminjaman berdasarkan kode buku
    public function ambilDataPeminjamanByKodeBuku($kodeBuku)
    {
        $this->db->select('peminjaman.status AS statusPinjamBuku,buku.kodeBuku,buku.judul,anggota.id,anggota.nama');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'buku.kodeBuku = peminjaman.kodeBuku');
        $this->db->join('anggota', 'anggota.id = peminjaman.IdAnggota');
        $this->db->where(
            'peminjaman.kodeBuku',
            $kodeBuku,
        );
        return $this->db->get()->result_array();
    }

    // ambil data peminjaman berdasarkan kode Anggota
    public function ambilDataPeminjamanByIdAnggota($kodeAnggota)
    {
        $this->db->select('peminjaman.*,buku.*,anggota.*');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'buku.kodeBuku = peminjaman.kodeBuku');
        $this->db->join('anggota', 'anggota.id = peminjaman.IdAnggota');
        $this->db->where(
            'peminjaman.IdAnggota',
            $kodeAnggota,
        );
        return $this->db->get()->result_array();
    }
}
