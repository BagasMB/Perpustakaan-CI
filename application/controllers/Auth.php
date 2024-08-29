<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function index()
  {
    $this->form_validation->set_rules('username', 'Username', 'trim|required', [
      'required' => 'Username Tidak Boleh Kosong'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'trim|required', [
      'required' => 'Password Tidak Boleh Kosong'
    ]);

    if ($this->form_validation->run() == false) {
      $this->load->view('auth/login');
    } else {
      $this->_login();
    }
  }

  public function register()
  {
    $this->form_validation->set_rules('username', 'Username', 'trim|required', [
      'required' => 'Username Tidak Boleh Kosong'
    ]);
    $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
      'required' => 'Nama Tidak Boleh Kosong'
    ]);
    $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
      'required' => 'Alamat Tidak Boleh Kosong'
    ]);
    $this->form_validation->set_rules('email', 'Email', 'trim|required', [
      'required' => 'Email Tidak Boleh Kosong'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'trim|required', [
      'required' => 'Password Tidak Boleh Kosong'
    ]);
    $cek_username = $this->db->where('username', $this->input->post('username'))->count_all_results('user');
    if ($this->form_validation->run() == false) {
      $this->load->view('auth/register');
    } elseif ($cek_username <> null) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-icon fade show" role="alert"><i class="mdi mdi-alert-circle-outline"></i>Username telah digunakan! </div>');
      redirect('register');
    } else {
      $this->_simpanRegister();
    }
  }

  private function _simpanRegister()
  {
    $data = [
      'username'  => htmlspecialchars($this->input->post('username')),
      'password'  => md5(htmlspecialchars($this->input->post('password'))),
      'nama'      => htmlspecialchars($this->input->post('nama')),
      'email'     => htmlspecialchars($this->input->post('email')),
      'alamat'    => htmlspecialchars($this->input->post('alamat')),
      'role'      => 'Peminjam',
    ];
    $this->db->insert('user', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-icon fade show" role="alert"><i class="mdi mdi-alert-circle-outline"></i>Selamat Datang! </div>');
    redirect('auth');
  }

  private function _login()
  {
    $username = htmlspecialchars($this->input->post('username', true));
    $password = md5($this->input->post('password', true));

    $user = $this->db->get_where('user', ['username' => $username])->row_array();

    if ($user) {
      if ($password == $user['password']) {
        $data = [
          'id_user' => $user['id_user'],
          'username' => $user['username'],
          'nama' => $user['nama'],
          'email' => $user['email'],
          'alamat' => $user['alamat'],
          'role' => $user['role'],
        ];
        $this->session->set_userdata($data);
        redirect();
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-icon fade show" role="alert"><i class="mdi mdi-alert-circle-outline"></i>Password anda salah! </div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-icon fade show" role="alert"><i class="mdi mdi-alert-circle-outline"></i>Username tidak terdaftar! </div>');
      redirect('auth');
    }
  }


  public function logout()
  {
    $this->session->sess_destroy();
    redirect('auth');
  }

  public function block()
  {
    $this->load->view('errors/blok');
  }

  public function ubahPassword()
  {
    if ($this->session->userdata('username') == null) {
      redirect('auth');
    }
    $data = [
      'title' => 'Account | Password',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
    ];
    $this->form_validation->set_rules('password_lama', 'Password Lama', 'trim|required', [
      'required' => 'Password tidak boleh kosong'
    ]);
    $this->form_validation->set_rules('password_baru1', 'Password Baru', 'trim|required|matches[password_baru2]', [
      'required' => 'Password Baru tidak boleh kosong',
      'matches' => 'Password Baru tidak sama dengan konfirmasi password',
    ]);
    $this->form_validation->set_rules(
      'password_baru2',
      'Konfirmasi Password Baru',
      'trim|required|matches[password_baru1]',
      [
        'required' => 'Password Baru tidak boleh kosong',
        'matches' => 'Konfirmasi password Baru tidak sama dengan Password Baru',
      ]
    );
    if ($this->form_validation->run() == false) {
      $this->template->load('template/layout', 'auth/ubahPassword', $data);
    } else {
      $id_user = $this->input->post('id_user');
      $password_lama = $this->input->post('password_lama');
      $password_baru = $this->input->post('password_baru1');
      if (md5($password_lama) != $data['user']['password']) {
        $this->session->set_flashdata('gagal', 'Password Anda Salah !');
        redirect('password');
      } else if ($data['user']['password'] == md5($password_baru)) {
        $this->session->set_flashdata('gagal', 'Password Baru Sama Dengan Password Lama !');
        redirect('password');
      } else {
        $this->db->set('password', md5($password_baru));
        $this->db->where('id_user', $id_user);
        $this->db->update('user');

        $this->session->set_flashdata('berhasil', 'Password Berhasil DiUbah');
        redirect('password');
      }
    }
  }
}
