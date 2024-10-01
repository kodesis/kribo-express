<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['session', 'form_validation']);
		$this->load->helper(['string', 'date']);
		$this->load->model(['M_Auth', 'M_Booking']);
	}
	public function index()
	{
		$data = [
			'title' => 'Home',
			'segment' => 'home',
			'pages' => 'pages/front/home/v_home'
		];

		$this->load->view('pages/front/index', $data);
	}

	public function about()
	{
		$data = [
			'title' => 'About',
			'segment' => 'about',
			'pages' => 'pages/front/home/v_about'
		];

		$this->load->view('pages/front/index', $data);
	}

	public function service()
	{
		$data = [
			'title' => 'Service',
			'segment' => 'service',
			'pages' => 'pages/front/home/v_service'
		];

		$this->load->view('pages/front/index', $data);
	}

	public function track()
	{
		$nomor_resi = $this->input->post('nomor_resi');


		$resi = $this->M_Booking->getItemAwb($nomor_resi);
		// // $booking = $this->M_Booking->getBookingById($resi['booking_id']);

		// echo '<pre>';
		// print_r($nomor_resi);
		// // print_r($booking);
		// echo '</pre>';
		// exit;
		$resi = null;
		if (!empty($nomor_resi)) {
			$this->form_validation->set_rules('g-recaptcha-response', 'reCAPTCHA', 'required');

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message', 'reCAPTCHA is required.');
				redirect('home/track');
			} else {
				$recaptchaResponse = $this->input->post('g-recaptcha-response');
				// $secretKey = '6Le8ZkcqAAAAACRQtxwa7SSZpcyETjp_gWkVmLBE'; // Local
				$secretKey = '6LcrQFQqAAAAAKO2oNf5Gx-8MOR1vExhoD0oiDVY'; // Hosting
				$userIP = $this->input->ip_address();

				$url = 'https://www.google.com/recaptcha/api/siteverify';

				$data = [
					'secret' => $secretKey,
					'response' => $recaptchaResponse,
					'remoteip' => $userIP
				];

				$options = [
					'http' => [
						'header' => 'Content-type: application/x-www-form-urlencoded',
						'method' => 'POST',
						'content' => http_build_query($data)
					]
				];

				$context = stream_context_create($options);
				$result = file_get_contents($url, false, $context);
				$resultData = json_decode($result);

				if ($resultData->success) {

					$nomor_resi = $this->input->post('nomor_resi');

					$cek_resi = $this->M_Booking->cekItemAwb($nomor_resi);

					if ($cek_resi) {
						$resi = $this->M_Booking->getItemAwb($nomor_resi);

						$this->session->set_flashdata('message', "Nomor resi  $nomor_resi ditemukan!");
					} else {
						$this->session->set_flashdata('message', "Nomor resi  $nomor_resi tidak ditemukan!");
					}
				} else {
					$this->session->set_flashdata('message', 'Unable to verify reCAPTCHA. Please try again later.');
				}
			}

			$nomor_resi = $this->input->post('nomor_resi');


			$resi = $this->M_Booking->getItemAwb($nomor_resi);
			$booking = $this->M_Booking->getBookingById($resi['booking_id']);
			$driver = $this->M_Auth->getUserById($booking['id_driver']);

			$cek_resi = $this->M_Booking->cekItemAwb($nomor_resi);

			if ($cek_resi) {

				$this->session->set_flashdata('message', "Nomor resi  $nomor_resi ditemukan!");
			} else {
				$this->session->set_flashdata('message', "Nomor resi  $nomor_resi tidak ditemukan!");
			}


			$data = [
				'title' => 'Track',
				'segment' => 'track',
				'pages' => 'pages/front/home/v_track',
				'resi' => ($resi) ? $resi : '',
				'booking' => ($booking) ? $booking : '',
				'driver' => ($driver) ? $driver : '',
			];
		} else {
			$data = [
				'title' => 'Track',
				'segment' => 'track',
				'pages' => 'pages/front/home/v_track',
				'resi' => '',
				'booking' => '',
				'driver' => '',
			];
		}

		$this->load->view('pages/front/index', $data);
	}

	public function track_resi()
	{
	}
}
