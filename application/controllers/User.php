<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('username') == null) {
      redirect('auth');
    } elseif ($this->session->userdata('role') != 'Admin') {
      redirect('auth/block');
    }
    $this->load->model('UserModel');
  }

  public function index()
  {
    $data = [
      'title' => 'User',
      'data_user' => $this->db->get('user')->result_array(),
    ];
    $this->template->load('template/layout', 'user', $data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('username', 'Username', 'trim|required', [
      'required' => 'Username Tidak Boleh Kosong'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'trim|required', [
      'required' => 'Password Tidak Boleh Kosong'
    ]);
    $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
      'required' => 'Nama Tidak Boleh Kosong'
    ]);
    $this->form_validation->set_rules('email', 'Email', 'trim|required', [
      'required' => 'Email Tidak Boleh Kosong'
    ]);
    $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
      'required' => 'Alamat Tidak Boleh Kosong'
    ]);

    $username = $this->input->post('username');
    $cek_username = $this->db->where('username', $username)->count_all_results('user');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('gagal', 'Yahh, Semua Filed Harus DiIsi!!!');
      redirect('user');
    } elseif ($cek_username <> null) {
      $this->session->set_flashdata('gagal', 'Yahh, Username sudah digunakan!!!');
      redirect('user');
    } else {
      $this->UserModel->tambahUser();
      $this->session->set_flashdata('berhasil', 'Yeaaaaaaaaaay!!!');
      redirect('user');
    }
  }

  public function edit()
  {
    $this->UserModel->editUser();
    $this->session->set_flashdata('berhasil', 'Gemgeekang Gacorr!!!');
    redirect('user');
  }

  public function reset($id_user)
  {
    $data = array('password' => md5(1234));
    $where = array('id_user' => $id_user);
    $this->db->update('user', $data, $where);
    $this->session->set_flashdata('berhasil', 'Password direset menjadi 1234!!!');
    redirect('user');
  }

  public function hapus($id)
  {
    $where = array('id_user' => $id);
    $this->db->delete('user', $where);
    $this->session->set_flashdata('berhasil', 'Berhasil DiHapus');
    redirect('user');
  }
}
