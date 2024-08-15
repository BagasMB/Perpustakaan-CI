<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ulasan extends CI_Controller
{
  public function index()
  {
    $data = [
      'title' => 'Ulasan',
      'ulasan' => $this->db->join('buku', 'ulasan.id_buku = buku.id_buku')->join('user', 'ulasan.id_user = user.id_user')->where('ulasan.id_user', $this->session->userdata('id_user'))->get('ulasan')->result_array()
    ];
    $this->template->load('template/layout', 'ulasan', $data);
  }

  public function simpan()
  {
    $this->load->model('UlasanModel');
    $ulas = $this->UlasanModel->isAlreadyReviewed($this->input->post('id_buku'), $this->input->post('id_user'));
    if (!$ulas) {
      $data = [
        'id_user' => $this->input->post('id_user'),
        'id_buku' => $this->input->post('id_buku'),
        'rating' => $this->input->post('rating'),
        'ulasan' => $this->input->post('ulasan'),
      ];
      $this->db->insert('ulasan', $data);
      $this->session->set_flashdata('berhasil', 'Buku sudah di ulas');
    } else {
      $this->session->set_flashdata('gagal', 'Buku sudah di ulas sebelumnya');
      redirect('ulasan');
    }
    redirect($_SERVER['HTTP_REFERER']);
  }
  
  public function edit()
  {
    $data = [
      'id_user' => $this->input->post('id_user'),
      'id_buku' => $this->input->post('id_buku'),
      'rating' => $this->input->post('rating'),
      'ulasan' => $this->input->post('ulasan'),
    ];
    $where = ['id_ulasan' => $this->input->post('id_ulasan')];
    $this->db->update('ulasan', $data, $where);
    $this->session->set_flashdata('berhasil', 'Ulasan berhasil di edit');
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function hapus($id)
  {
    $where = array('id_ulasan' => $id);
    $this->db->delete('ulasan', $where);
    $this->session->set_flashdata('berhasil', 'Berhasil DiHapus');
    redirect('ulasan');
  }
}
