<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('username') == null) {
      redirect('auth');
    }
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('PeminjamanModel');
  }

  public function index()
  {
    $data = [
      'title' => 'Peminjaman',
      'peminjaman' =>  $this->db->where('user.id_user', $this->session->userdata('id_user'))->join('user', 'user.id_user = peminjaman.id_user')->order_by('kode_peminjaman', 'DESC')->get('peminjaman')->result_array(),
    ];
    $this->template->load('template/layout', 'peminjaman/peminjaman', $data);
  }

  public function user($id)
  {
    $data = [
      'title' => 'Peminjaman',
      'buku' => $this->db->get('buku')->result_array(),
      'userr' => $this->db->where('id_user', $id)->get('user')->row(),
      'temp' => $this->db->join('buku', 'temp.id_buku = buku.id_buku')->join('user', 'user.id_user = temp.id_user')->where('user.id_user', $id)->get('temp')->result(),
    ];
    $this->template->load('template/layout', 'peminjaman/tambahPeminjaman', $data);
  }

  public function tambahPeminjaman()
  {
    // jika buku yang ada di table temp dan detail_peminjaman sama dan status yang ada di detail_peminjaman masih diperoses atau dipinjam jadi tidak boleh untuk di pinjam  
    $buku_tersedia = $this->PeminjamanModel->cek_buku_tersedia($this->input->post('id_buku'), $this->input->post('id_user'));

    $cek = $this->db->where('id_buku', $this->input->post('id_buku'))->where('id_user', $this->input->post('id_user'))->get('temp')->result_array();
    $stokLama = $this->db->from('buku')->where('id_buku', $this->input->post('id_buku'))->get()->row()->stok;

    if ($cek != NULL) {
      $this->session->set_flashdata('gagal', 'Buku sudah di pilih');
    } else if ($stokLama < 1) {
      $this->session->set_flashdata('gagal', 'Buku yang dipilih tidak cukup');
    } else {
      if ($buku_tersedia) {
        $this->PeminjamanModel->tambahPeminjaman();
        $this->session->set_flashdata('berhasil', 'Barang ditambah ke keranjang');
      } else {
        $this->session->set_flashdata('gagal', 'Buku ini sedang dalam proses atau sudah dipinjam.');
      }
    }
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function hpstemp($id)
  {
    $temp = $this->db->where('id_temp', $id)->get('temp')->row();
    $cekBuku = $this->db->where('id_buku', $temp->id_buku)->get('buku')->row();
    $where = ['id_temp' => $id];
    $this->db->delete('temp', $where);
    $this->session->set_flashdata('berhasil', 'Buku ' . $cekBuku->judul . ' berhasil dihapus dari keranjang');
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function prosesPeminjaman()
  {
    $kode_peminjaman = $this->PeminjamanModel->kode_peminjaman();
    $temp = $this->db->join('buku', 'temp.id_buku = buku.id_buku')->where('id_user', $this->input->post('id_user'))->get('temp')->result_array();
    if ($this->input->post('tanggal_pengembalian') >= date('Y-m-d')) {
      foreach ($temp as $value) {
        // input Table detail
        $data = [
          'kode_peminjaman' => $kode_peminjaman,
          'id_buku'         => $value['id_buku'],
          'id_user'         => $value['id_user'],
          'status'          => 'Proses'
        ];
        $this->db->insert('detail_peminjaman', $data);

        // Update Stok Buku
        $data2  = ['stok' => $value['stok'] - 1];
        $where1 = ['id_buku' => $value['id_buku']];
        $this->db->update('buku', $data2, $where1);

        // hapus table temp
        $where2 = ['id_user' => $this->session->userdata('id_user')];
        $this->db->delete('temp', $where2);
      }
      // Tambah Ke Peminjaman
      $data3 = [
        'kode_peminjaman' => $kode_peminjaman,
        'tanggal_peminjaman' => date('Y-m-d'),
        'tanggal_pengembalian' => $this->input->post('tanggal_pengembalian'),
        'id_user' => $value['id_user'],
      ];
      $this->db->insert('peminjaman', $data3);
      $this->session->set_flashdata('berhasil', 'Pesanan buku anda sedang di peroses');
    } else {
      setlocale(LC_TIME, 'id_ID.utf8');
      $this->session->set_flashdata('gagal', 'Tanggal pengembalian harus lebih atau hari ini ' . strftime('%A, %d %B %Y', strtotime(date('Y-m-d'))));
      redirect($_SERVER['HTTP_REFERER']);
    }
    redirect('peminjaman');
  }

  public function cek()
  {
    if ($this->session->userdata('role') != 'Admin' && $this->session->userdata('role') != 'Petugas') {
      redirect('auth/block');
    }
    $data = [
      'title' => 'Peminjaman',
      'peminjaman' =>  $this->db->join('user', 'user.id_user = peminjaman.id_user')->order_by('kode_peminjaman', 'DESC')->get('peminjaman')->result_array(),
      'user' => $this->db->where('role', "Peminjam")->get('user')->result_array(),
    ];
    $this->template->load('template/layout', 'peminjaman/dataPeminjaman', $data);
  }

  public function detail($kode_peminjaman)
  {
    $data = [
      'title' => 'Peminjaman Detail',
      'detail' => $this->db->join('buku', 'buku.id_buku=detail_peminjaman.id_buku')->where('kode_peminjaman', $kode_peminjaman)->get('detail_peminjaman')->result_array(),
      'kode_peminjaman' => $kode_peminjaman,
    ];

    $this->template->load('template/layout', 'peminjaman/detailPeminjaman', $data);
  }

  public function persetujuan($id_detail_peminjaman, $kode_peminjaman)
  {
    // $id_peminjaman = (int) $this->db->where('kode_peminjaman', $kode_peminjaman)->get('peminjaman')->row()->id_peminjaman;

    // Status setuju
    $data = ['status' => 'Dipinjam'];
    $where = ['id_detail_peminjaman' => $id_detail_peminjaman];
    $this->db->update('detail_peminjaman', $data, $where);

    // Update Petugas
    $data1 = ['id_petugas' => $this->session->userdata('id_user')];
    $where1 = ['kode_peminjaman' => $kode_peminjaman];
    $this->db->update('peminjaman', $data1, $where1);

    $this->session->set_flashdata('berhasil', 'Buku sedang dipinjam');
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function penolakan($id_detail_peminjaman, $kode_peminjaman, $id_buku)
  {
    $data = ['status' => 'Ditolak'];
    $where = ['id_detail_peminjaman' => $id_detail_peminjaman];
    $this->db->update('detail_peminjaman', $data, $where);

    // Update Petugas
    $data1 = ['id_petugas' => $this->session->userdata('id_user')];
    $where1 = ['kode_peminjaman' => $kode_peminjaman];
    $this->db->update('peminjaman', $data1, $where1);

    $stokbuku = (int) $this->db->where('id_buku', $id_buku)->get('buku')->row()->stok;
    // Update Data Buku
    $data2 = ['stok' => $stokbuku + 1];
    $where2 = ['id_buku' => $id_buku];
    $this->db->update('buku', $data2, $where2);

    $this->session->set_flashdata('berhasil', 'Buku ditolak untuk dipinjam');
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function kembalikan($id_detail_peminjaman, $id_buku, $kode_peminjaman)
  {
    $tanggalbali = $this->db->where('kode_peminjaman', $kode_peminjaman)->get('peminjaman')->row()->tanggal_pengembalian;
    $selisih_hari = (strtotime(date('Y-m-d')) - strtotime($tanggalbali)) / (60 * 60 * 24);
    $total_denda = $selisih_hari * 5000;
    if ($tanggalbali < date('Y-m-d')) {
      $status = 'Terlambat';
      $denda = [
        'total_denda' => $total_denda,
        'status_denda' => 'Belum Lunas'
      ];
      $this->db->insert('denda', $denda);
      $id_denda_last = $this->db->insert_id();
    } else {
      $id_denda_last = 0;
      $status = 'Dikembalikan';
    }
    $stok = (int) $this->db->where('id_buku', $id_buku)->get('buku')->row()->stok;
    $data = ['status' => $status, 'id_denda' => $id_denda_last, 'tanggal_pengembalian_real' => date('Y-m-d')];
    $where = ['id_detail_peminjaman' => $id_detail_peminjaman];
    $this->db->update('detail_peminjaman', $data, $where);


    // Update stok buku
    $data1 = ['stok' => $stok + 1];
    $where1 = ['id_buku' => $id_buku];
    $this->db->update('buku', $data1, $where1);

    // Update Petugas
    $data1 = ['id_petugas' => $this->session->userdata('id_user')];
    $where1 = ['kode_peminjaman' => $kode_peminjaman];
    $this->db->update('peminjaman', $data1, $where1);

    $this->session->set_flashdata('berhasil', 'Buku dikembaikan untuk dipinjam');
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function denda($id)
  {
    $data = [
      'title' => 'Denda',
      'denda' => $this->db->join('denda', 'denda.id_denda=detail_peminjaman.id_denda')->join('buku', 'buku.id_buku=detail_peminjaman.id_buku')->where('detail_peminjaman.id_denda', $id)->get('detail_peminjaman')->row()
    ];

    $this->template->load('template/layout', 'peminjaman/denda', $data);
  }

  public function bayardenda()
  {
    $total_denda = $this->input->post('total_denda');
    $sudah_dibayar = $this->input->post('sudah_dibayar');
    $sisa_denda = $this->input->post('sisa_denda');
    $bayar_denda = $this->input->post('bayar_denda');

    // SetStatus
    $status = $total_denda == $sudah_dibayar + $bayar_denda ? 'Lunas' : 'Belum Lunas';
    if ($sisa_denda >= $bayar_denda) {
      $data = [
        'sudah_dibayar' => $sudah_dibayar + $bayar_denda,
        'status_denda' => $status,
      ];
      $where = ['id_denda' => $this->input->post('id_denda')];
      $this->db->update('denda', $data, $where);
    } else {
      $this->session->set_flashdata('gagal', 'Yang dibayar melebihi');
    }

    $this->session->set_flashdata('berhasil', 'Denda Sudah DiBayar');
    redirect($_SERVER['HTTP_REFERER']);
  }
}
