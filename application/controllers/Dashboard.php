<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
		$this->load->model('BukuModel');
		$data = [
			'title' 			=> 'Dashboard',
			'buku' 				=> $this->BukuModel->getBukuDenganRating(),
			'data_buku'		=> $this->db->from('buku')->count_all_results(),
			'peminjaman'	=> $this->db->from('detail_peminjaman')->count_all_results(),
			'ulasan'			=> $this->db->from('ulasan')->count_all_results(),
		];
		$this->template->load('template/layout', 'dashboard', $data);
	}

	public function laporan()
	{
		$this->load->model('PeminjamanModel');
		$tanggal_awal 	= $this->input->post('tanggal_awal');
		$tanggal_akhir	= $this->input->post('tanggal_akhir');
		$id_user 				= $this->input->post('id_user');
		if (empty($tanggal_akhir)) {
			$tanggal_akhir = date('Y-m-d');
		}
		if ($tanggal_akhir >= $tanggal_awal) {
			$data = [
				'judul' => "Periode: $tanggal_awal Sampai $tanggal_akhir",
				// 'judul' => "Laporan Dari Tanggal $tanggal_awal Sampai $tanggal_akhir",
				'peminjaman' =>  $this->PeminjamanModel->dataPeminjamanWhereTanggal($tanggal_awal, $tanggal_akhir, $id_user),
			];
			$this->load->view('laporan', $data);
		} else {
			setlocale(LC_TIME, 'id_ID.utf8');
			$this->session->set_flashdata('gagal', 'Tanggal Awal harus lebih atau hari ini ' . strftime('%A, %d %B %Y', strtotime(date('Y-m-d'))));
			redirect($_SERVER['HTTP_REFERER']);
		}

		// $paper_size = 'A4';
		// $orientation = 'portrait';
		// $html = $this->output->get_output();

		// $this->load->library('pdf');

		// $this->pdf->generate(
		// 	$html,
		// 	"Laporan_transaksi",
		// 	$paper_size,
		// 	$orientation
		// );
	}
}
