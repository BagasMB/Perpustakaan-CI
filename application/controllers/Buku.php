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
    $this->load->model('BukuModel');
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
      $namaFoto = date('YmdHis') . '.jpg';
      $config['allowed_types'] = '*';
      $config['upload_path']   = 'assets/img/buku/';
      $config['file_name']     = $namaFoto;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('foto')) {
        $error = array('error', $this->upload->display_errors());
        $this->BukuModel->simpanBuku($namaFoto);
      } else {
        $data = array('upload_data' => $this->upload->data());
        $this->BukuModel->simpanBuku($namaFoto);
        $this->session->set_flashdata('berhasil', 'Yeaaaaaaaaaay!!!');
      }
      redirect('buku');
    }
  }

  public function edit()
  {
    $this->form_validation->set_rules('judul', 'Judul', 'trim|required', ['required' => 'Judul Tidak Boleh Kosong']);
    $this->form_validation->set_rules('penulis', 'Penulis', 'trim|required', ['required' => 'Penulis Tidak Boleh Kosong']);
    $this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required', ['required' => 'Penerbit Tidak Boleh Kosong']);
    $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'trim|required', ['required' => 'Tahun Terbit Tidak Boleh Kosong']);

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('gagal', 'Yahh, Semua Field Harus DiIsi!!!');
      redirect('buku');
    } else {
      $namaFoto = $this->input->post('nama_foto');
      $config['allowed_types'] = '*';
      // $config['max_size']      = 2048 * 1024;
      $config['upload_path']   = 'assets/img/buku/';
      $config['file_name']     = $namaFoto;
      $config['overwrite']     = true;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('foto')) {
        $error = array('error', $this->upload->display_errors());
        $this->BukuModel->editBuku($namaFoto);
        $this->session->set_flashdata('berhasil', 'Gemgeekang Gacorr!!!');
      } else {
        $data = array('upload_data' => $this->upload->data());
        $this->BukuModel->editBuku($namaFoto);
        $this->session->set_flashdata('berhasil', 'Gemgeekang Gacorr!!!');
      }
      redirect('buku');
    }
  }

  // public function dele
}
