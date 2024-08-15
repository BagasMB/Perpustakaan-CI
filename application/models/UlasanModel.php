<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UlasanModel extends CI_Model
{
  public function isAlreadyReviewed($id_buku, $id_user)
  {
    // Query untuk memeriksa apakah ada ulasan dari pengguna tertentu untuk buku tertentu
    $this->db->from('ulasan');
    $this->db->where('id_buku', $id_buku);
    $this->db->where('id_user', $id_user);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return true; // Sudah ada ulasan
    } else {
      return false; // Belum ada ulasan
    }
  }
}