<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PeminjamanModel extends CI_Model
{

  public function dataPeminjamanWhereTanggal($tanggal_awal, $tanggal_akhir, $id_user = null)
  {
    // Join tabel 'peminjaman' terlebih dahulu agar bisa mengakses 'peminjaman.id_user'
    $this->db->join('peminjaman', 'peminjaman.kode_peminjaman = detail_peminjaman.kode_peminjaman');
    $this->db->join('user', 'user.id_user = peminjaman.id_user');
    $this->db->join('buku', 'buku.id_buku = detail_peminjaman.id_buku');

    // Filter berdasarkan tanggal pengembalian
    $this->db->where("tanggal_peminjaman BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");

    // Filter berdasarkan id_user jika disediakan
    if (!empty($id_user)) {
      $this->db->where('peminjaman.id_user', $id_user);
    }

    // Urutkan berdasarkan kode_peminjaman secara menurun
    $this->db->order_by('detail_peminjaman.kode_peminjaman', 'DESC');

    // Ambil data dari tabel 'detail_peminjaman'
    return $this->db->get('detail_peminjaman')->result_array();
  }



  public function kode_peminjaman()
  {
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date('Y-m');
    $this->db->where("DATE_FORMAT(tanggal_peminjaman,'%Y-%m')", $tanggal)->from('peminjaman');
    $jumlah = $this->db->count_all_results();
    $kode_peminjaman = date('ymd') . $jumlah + 1;

    return $kode_peminjaman;
  }

  public function tambahPeminjaman()
  {
    $data = [
      'id_user' => $this->input->post('id_user'),
      'id_buku' => $this->input->post('id_buku'),
    ];
    $this->db->insert('temp', $data);
  }

  public function cek_buku_tersedia($id_buku, $id_user)
  {
    $this->db->select('status');
    $this->db->from('detail_peminjaman');
    $this->db->where('id_buku', $id_buku);
    $this->db->where('id_user', $id_user);
    $this->db->where_in('status', ['Proses', 'Dipinjam']);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return false; // Buku tidak tersedia untuk dipinjam
    } else {
      return true; // Buku tersedia untuk dipinjam
    }
  }
}
