<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('string');
		$this->load->model(['M_Auth', 'M_Booking']);
		$this->load->helper('date');

		if (!$this->session->userdata('is_logged_in')) {

			$this->session->set_userdata('last_page', current_url());

			$this->session->set_flashdata('message_name', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			You have to login first.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');

			redirect('auth');
		}
	}

	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'segment' => 'dashboard',
			'pages' => 'pages/dashboard/v_dashboard',
			'booking' => $this->M_Booking->dashboard(),
		];
		$this->load->view('pages/index', $data);
	}

	public function reset($jenis)
	{
		$data = [
			"detail-awb" => ['search_resi', 'booking/list_detail'],
			"customer" => ['search_customer', 'customer'],
			"user" => ['search_user', 'setting/user'],
			"menu" => ['search_menu', 'setting/menu'],
		];

		if (isset($data[$jenis])) {
			$this->session->unset_userdata($data[$jenis][0]);
			redirect($data[$jenis][1]);
		}
	}
}
