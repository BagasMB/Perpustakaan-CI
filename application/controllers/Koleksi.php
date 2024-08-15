<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Koleksi extends CI_Controller
{
  public function index()
  {
    $data = [
      'title' => 'Koleksi',
      'koleksi' => $this->db->join('user', 'user.id_user = koleksi.id_user')->join('buku', 'buku.id_buku = koleksi.id_buku')->where('user.id_user', $this->session->userdata('id_user'))->get('koleksi')->result_array()
    ];
    $this->template->load('template/layout', 'koleksi', $data);
  }

  public function simpan($id_buku)
  {
    $koleksi = $this->db->join('user', 'user.id_user = koleksi.id_user')->join('buku', 'buku.id_buku = koleksi.id_buku')->where('user.id_user', $this->session->userdata('id_user'))->where('buku.id_buku', $id_buku)->get('koleksi')->row();
    // var_dump($koleksi);
    // die;
    if ($koleksi == null) {
      $data = [
        'id_user' => $this->session->userdata('id_user'),
        'id_buku' => $id_buku,
      ];
      $this->db->insert('koleksi', $data);
      $this->session->set_flashdata('berhasil', 'Buku ditambahkan ke kolaksi');
    } else {
      $this->session->set_flashdata('gagal', 'Buku sudah ada di kolaksi');
    }
    redirect('dashboard');
  }

  public function hapus($id_koleksi)
  {
    $where = array('id_koleksi' => $id_koleksi);
    $this->db->delete('koleksi', $where);
    $this->session->set_flashdata('berhasil', 'Berhasil DiHapus');
    redirect('koleksi');
  }
}
