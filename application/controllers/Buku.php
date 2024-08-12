<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
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
      'title' => 'Buku',
      'buku' =>  $this->db->join('kategori', 'buku.id_kategori = kategori.id_kategori')->get('buku')->result_array(),
      'kategori' => $this->db->get('kategori')->result(),
    ];
    $this->template->load('template/layout', 'buku', $data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('judul', 'Judul', 'trim|required', ['required' => 'Judul Tidak Boleh Kosong']);
    $this->form_validation->set_rules('penulis', 'Penulis', 'trim|required', ['required' => 'Penulis Tidak Boleh Kosong']);
    $this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required', ['required' => 'Penerbit Tidak Boleh Kosong']);
    $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'trim|required', ['required' => 'Tahun Terbit Tidak Boleh Kosong']);

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('gagal', 'Yahh, Semua Field Harus DiIsi!!!');
      redirect('buku');
    } else {
      $data = [
        'judul' => $this->input->post('judul'),
        'penulis' => $this->input->post('penulis'),
        'penerbit' => $this->input->post('penerbit'),
        'id_kategori' => $this->input->post('id_kategori'),
        'tahun_terbit' => $this->input->post('tahun_terbit'),
        'stok' => $this->input->post('stok'),
      ];
      $this->db->insert('buku', $data);
      $this->session->set_flashdata('berhasil', 'Yeaaaaaaaaaay!!!');
      redirect('buku');
    }
  }

  public function  edit()
  {
    $this->form_validation->set_rules('judul', 'Judul', 'trim|required', ['required' => 'Judul Tidak Boleh Kosong']);
    $this->form_validation->set_rules('penulis', 'Penulis', 'trim|required', ['required' => 'Penulis Tidak Boleh Kosong']);
    $this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required', ['required' => 'Penerbit Tidak Boleh Kosong']);
    $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'trim|required', ['required' => 'Tahun Terbit Tidak Boleh Kosong']);

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('gagal', 'Yahh, Semua Field Harus DiIsi!!!');
      redirect('buku');
    } else {
      $data = [
        'judul' => $this->input->post('judul'),
        'penulis' => $this->input->post('penulis'),
        'penerbit' => $this->input->post('penerbit'),
        'id_kategori' => $this->input->post('id_kategori'),
        'tahun_terbit' => $this->input->post('tahun_terbit'),
        'stok' => $this->input->post('stok'),
      ];
      $where = ['id_buku' => $this->input->post('id_buku')];
      $this->db->update('buku', $data, $where);
      $this->session->set_flashdata('berhasil', 'Yeaaaaaaaaaay!!!');
      redirect('buku');
    }
  }

  // public function dele
}
