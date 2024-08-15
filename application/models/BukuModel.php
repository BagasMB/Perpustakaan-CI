<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BukuModel extends CI_Model
{
  public function getBukuDenganRating()
  {
    // Menyusun query
    $this->db->select('buku.id_buku, buku.judul, buku.penulis, buku.tahun_terbit, buku.foto, AVG(ulasan.rating) AS rata_rata_rating');
    $this->db->from('buku');
    $this->db->join('ulasan', 'ulasan.id_buku = buku.id_buku', 'left');
    $this->db->group_by('buku.id_buku');
    $this->db->order_by('buku.tahun_terbit', 'DESC');

    // Menjalankan query dan mengembalikan hasil
    return $this->db->get()->result_array();
  }

  public function simpanBuku($namaFoto)
  {
    $data = [
      'judul' => $this->input->post('judul'),
      'penulis' => $this->input->post('penulis'),
      'penerbit' => $this->input->post('penerbit'),
      'id_kategori' => $this->input->post('id_kategori'),
      'tahun_terbit' => $this->input->post('tahun_terbit'),
      'stok' => $this->input->post('stok'),
      'foto' => $namaFoto,
    ];
    $this->db->insert('buku', $data);
  }

  public function editBuku($namaFoto)
  {
    $data = [
      'judul' => $this->input->post('judul'),
      'penulis' => $this->input->post('penulis'),
      'penerbit' => $this->input->post('penerbit'),
      'id_kategori' => $this->input->post('id_kategori'),
      'tahun_terbit' => $this->input->post('tahun_terbit'),
      'stok' => $this->input->post('stok'),
      'foto' => $namaFoto,
    ];
    $where = ['foto' => $this->input->post('nama_foto')];
    $this->db->update('buku', $data, $where);
  }
}
