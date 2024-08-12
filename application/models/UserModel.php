<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
  public function tambahUser()
  {
    $data = [
      'username'  => htmlspecialchars($this->input->post('username')),
      'password'  => md5(htmlspecialchars($this->input->post('password'))),
      'nama'      => htmlspecialchars($this->input->post('nama')),
      'email'     => htmlspecialchars($this->input->post('email')),
      'alamat'    => htmlspecialchars($this->input->post('alamat')),
      'role'      => $this->input->post('role'),
    ];
    $this->db->insert('user', $data);
  }

  public function editUser()
  {
    $data = array(
      'nama'      => htmlspecialchars($this->input->post('nama')),
      'email'     => htmlspecialchars($this->input->post('email')),
      'alamat'    => htmlspecialchars($this->input->post('alamat')),
      'role'      => $this->input->post('role'),
    );

    $where = array('id_user' => $this->input->post('id_user'));
    $this->db->update('user', $data, $where);
  }
}
