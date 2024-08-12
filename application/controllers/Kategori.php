<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('username') == null) {
      redirect('auth');
    }
  }
  public function index()
  {
    $data = [
      'title' => 'Kategori',
      'kategori' =>  $this->db->get('kategori')->result_array(),
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
    ];
    $this->template->load('template/layout', 'kategori', $data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('nama_kategori', 'Nama', 'trim|required', [
      'required' => 'Nama Tidak Boleh Kosong'
    ]);
    $kategori = $this->input->post('nama_kategori');
    $cek_kategori = $this->db->where('nama_kategori', $kategori)->count_all_results('kategori');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('gagal', 'Yahh, Semua Field Harus DiIsi!!!');
      redirect('kategori');
    } elseif ($cek_kategori <> null) {
      $this->session->set_flashdata('gagal', 'Yahh, Kategori Konten sudah digunakan!!!');
      redirect('kategori');
    } else {
      $data = array(
        'nama_kategori' => $this->input->post('nama_kategori'),
      );
      $this->db->insert('kategori', $data);
      $this->session->set_flashdata('berhasil', 'Yeaaaaaaaaaay!!!');
      redirect('kategori');
    }
  }

  public function edit()
  {
    $data = array(
      'nama_kategori'      => $this->input->post('nama_kategori'),
    );
    $where = array('id_kategori' => $this->input->post('id_kategori'));
    $this->db->update('kategori', $data, $where);
    $this->session->set_flashdata('berhasil', 'Gemgeekang Gacorr!!!');
    redirect('kategori');
  }

  public function hapus($id)
  {
    $where = array('id_kategori' => $id);
    $this->db->delete('kategori', $where);
    $this->session->set_flashdata('berhasil', 'Berhasil DiHapus!!!');
    redirect('kategori');
  }
}
