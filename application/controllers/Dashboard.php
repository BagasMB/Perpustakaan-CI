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
		$data = [
			'title' => 'Dashboard',
		];
		$this->template->load('template/layout', 'dashboard', $data);
	}
}
