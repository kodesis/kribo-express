<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Pricelist extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'pagination']);
        $this->load->helper(['string', 'url', 'date']);
        $this->load->model('M_Pricelist');

        if (!$this->session->userdata('is_logged_in')) {

            $this->session->set_userdata('last_page', current_url());

            $this->session->set_flashdata('message_name', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			You have to login first.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');

            redirect('auth');
        } else {
            $url = "customer/index";
            $this->checkAccess($url);
        }
    }

    private function checkAccess($url)
    {
        $id_function = $this->db->where('url', $url)->get('menu')->row_array();
        $login_menu = $this->M_Setting->getUserMenu($this->session->userdata('username'));

        // Pastikan 'access_menu' terdekode dengan benar
        $access_menu = json_decode($login_menu['access_menu'], true);

        // Cek apakah hasil 'json_decode' adalah array
        if (is_array($access_menu)) {
            if (!in_array($id_function['Id'], $access_menu)) {
                redirect('auth/forbidden');
            }
        } else {
            redirect('auth/forbidden');
        }
    }

    public function index()
    {
        // $url = "customer/index";
        // $this->checkAccess($url);

        $keyword = ($this->input->post('keyword')) ? trim($this->input->post('keyword')) : (($this->session->userdata('search_pricelist')) ? $this->session->userdata('search_pricelist') : '');
        if ($keyword === null) $keyword = $this->session->userdata('search_pricelist');
        else $this->session->set_userdata('search_pricelist', $keyword);

        $config = [
            'base_url' => site_url('customer/index'),
            'total_rows' => $this->M_Pricelist->count($keyword),
            'per_page' => 10,
            'uri_segment' => 3,
            'num_links' => 1,
            'full_tag_open' => '<ul class="pagination m-0 ms-auto">',
            'full_tag_close' => '</ul>',

            'prev_link' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg> prev',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',
            'prev_tag_open_disabled' => '<li class="page-item disabled">',
            'prev_tag_close_disabled' => '</li>',

            'next_link' => 'next <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M9 6l6 6l-6 6" /></svg>',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',
            'next_tag_open_disabled' => '<li class="page-item disabled">',
            'next_tag_close_disabled' => '</li>',

            'first_link' => 'First',
            'first_tag_open' => '<li class="page-item">',
            'first_tag_close' => '</li>',

            'last_link' => 'Last',
            'last_tag_open' => '<li class="page-item">',
            'last_tag_close' => '</li>',

            'cur_tag_open' => '<li class="page-item active"><a class="page-link" href="#">',
            'cur_tag_close' => '</a></li>',

            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',

            'attributes' => array('class' => 'page-link'),

            'use_page_numbers' => TRUE,
        ];

        $this->pagination->initialize($config);

        $page = $this->uri->segment(3) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;

        $data = [
            "title" => "Pricelist",
            "page" => $page,
            "keyword" => $keyword,
            "segment" => "pricelist",
            "pages" => "pages/pricelist/v_pricelist",
            "pricelists" => $this->M_Pricelist->listPricelistPaginate($config["per_page"], $page, $keyword),
            "total_rows" => $config['total_rows'],
            "per_page" => $config['per_page'],
        ];

        $this->load->view('pages/index', $data);
    }

    public function getPrice()
    {
        // $origin = $this->input->post('origin');
        $origin = 'CGK';
        $destination = $this->input->post('destination');

        $slug = $origin . '-' . $destination;
        $price = $this->db->where('slug', $slug)->get('mt_pricelist')->row_array();

        if (isset($price['total'])) {
            echo ($price['total']);
        } else {
            echo '0';
        }
    }
}
