<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Booking extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'pagination']);
        $this->load->helper(['string', 'url', 'date']);
        $this->load->model(['M_Customer', 'M_Booking', 'M_Auth']);

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
            "title" => "Booking",
            "segment" => "booking",
            "pages" => "pages/booking/v_booking",
            "bookings" => $this->M_Booking->list_booking(),
        ];

        $this->load->view('pages/index', $data);
    }

    public function create_booking()
    {
        $data = [
            "title" => "Create Booking",
            "segment" => "booking",
            "pages" => "pages/booking/v_create_booking",
            "bookings" => $this->M_Booking->list_booking(),
            "customers" => $this->M_Customer->list_customer(),
        ];

        $this->load->view('pages/index', $data);
    }

    public function store_booking()
    {
        $awbs = $this->input->post('awb');
        $origins = $this->input->post('origin');
        $destinations = $this->input->post('destination');
        $commodities = $this->input->post('commodity');

        $data = [];

        $alert = [];

        if (is_array($awbs)) {
            for ($i = 0; $i < count($awbs); $i++) {
                $awb = trim($awbs[$i]);
                $origin = trim($origins[$i]);
                $destination = trim($destinations[$i]);
                $commodity = trim($commodities[$i]);

                $is_available = $this->M_Booking->is_available($awb);

                if (!$is_available) {
                    $data[] = [
                        'customer_id' => $this->input->post('customer_id'),
                        'alamat_pickup' => trim($this->input->post('alamat_pickup')),
                        'lokasi_gudang' => trim($this->input->post('lokasi_gudang')),
                        'awb' => $awb,
                        'origin' => $origin,
                        'destination' => $destination,
                        'commodity' => $commodity,
                        'created_by' => $this->session->userdata('user_id')
                    ];
                } else {
                    $alert[] = [
                        'message' => 'AWB ' . $awb . ' sudah ada sebelumnya.'
                    ];
                }
            }

            if (!empty($data)) {
                if ($this->M_Booking->insert_batch($data)) {
                    $this->session->set_flashdata('message_name', 'AWB berhasil ditambahkan. Silahkan lengkapi datanya!');
                } else {
                    $this->session->set_flashdata('message_error', 'Gagal input. Silahkan ulangi lagi!');
                }
                redirect('booking', $alert);
            }
        } else {
            $this->session->set_flashdata('message_error', 'Silahkan isi awb!');
            redirect('booking');
        }
    }

    public function detailBooking($id)
    {
        $awb = $this->M_Booking->detailAwb($id);
        $data = [
            "title" => $id,
            "segment" => "booking",
            "pages" => "pages/booking/v_detail_booking",
            "bookings" => $this->M_Booking->list_booking(),
            "customers" => $this->M_Customer->list_customer(),
            "awb" => $awb,
            "details" => $this->M_Booking->detailItemAwb($awb['Id']),
        ];

        $this->load->view('pages/index', $data);
    }

    public function simpanDetailAwb($id)
    {
        $nomor_uruts = $this->input->post('nomor_urut');
        $qtys = $this->input->post('qty');
        $chargeables = $this->input->post('chargeable');
        $nominals = $this->input->post('nominal');
        $cities = $this->input->post('city');

        $awb_num = $this->input->post('awb_num');
        $total_qty = $this->input->post('total_qty');
        $total_chargeable = $this->input->post('total_chargeable');
        $subtotal = $this->input->post('subtotal');

        $detail = [];

        $data_booking = [
            'total_qty' => $total_qty,
            'total_chargeable' => $total_chargeable,
            'subtotal' => $subtotal,
        ];

        if (is_array($nomor_uruts)) {

            $this->M_Booking->delete_detail_awb($id);

            for ($i = 0; $i < count($nomor_uruts); $i++) {
                $nomor_urut = trim($nomor_uruts[$i]);
                $qty = trim($this->convertToNumber($qtys[$i]));
                $chargeable = trim($this->convertToNumber($chargeables[$i]));
                $nominal = trim($this->convertToNumber($nominals[$i]));
                $city = trim($cities[$i]);

                $slug = $awb_num . '-' . $nomor_urut;

                if ($qty) {
                    $detail[] = [
                        'no_urut' => $nomor_urut,
                        'awb_id' => $id,
                        'slug' => $slug,
                        'qty' => $qty,
                        'chargeable' => $chargeable,
                        'nominal' => $nominal,
                        'kota_tujuan' => $city,
                        'created_by' => $this->session->userdata('user_id')
                    ];
                }
            }

            if (!empty($detail)) {
                if ($this->M_Booking->insert_batch_detail_awb($detail)) {

                    $this->M_Booking->updateBooking($id, $data_booking);

                    $this->session->set_flashdata('message_name', 'Detail AWB berhasil ditambahkan.');
                } else {
                    $this->session->set_flashdata('message_error', 'Gagal input. Silahkan ulangi lagi!');
                }
                redirect('booking');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Silahkan isi awb!');
            redirect('booking');
        }
    }

    function convertToNumber($formattedNumber)
    {
        // Mengganti titik sebagai pemisah ribuan dengan string kosong
        $numberWithoutThousandsSeparator = str_replace('.', '', $formattedNumber);

        // Mengganti koma sebagai pemisah desimal dengan titik
        $standardNumber = str_replace(',', '.', $numberWithoutThousandsSeparator);

        // Mengonversi string ke float
        return (float) $standardNumber;
    }

    public function list_detail()
    {
        $keyword = ($this->input->post('keyword')) ? trim($this->input->post('keyword')) : (($this->session->userdata('search_resi')) ? $this->session->userdata('search_resi') : '');
        if ($keyword === null) $keyword = $this->session->userdata('search_resi');
        else $this->session->set_userdata('search_resi', $keyword);

        $config = [
            'base_url' => site_url('booking/list_detail'),
            'total_rows' => $this->M_Booking->countItem($keyword),
            'per_page' => 10,
            'uri_segment' => 3,
            'num_links' => 1,
            'full_tag_open' => '<ul class="pagination">',
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
            "title" => "Booking",
            "page" => $page,
            "keyword" => $keyword,
            "segment" => "detail_awb",
            "pages" => "pages/booking/v_detail_awb",
            "awbs" => $this->M_Booking->listItemAwbPaginate($config["per_page"], $page, $keyword),
        ];

        $this->load->view('pages/index', $data);
    }

    public function formConfirmWarehouse()
    {
        $id = $this->input->post('id');
        $drivers = $this->M_Booking->list_driver();

        $data = $this->M_Booking->getItemAwb($id);

        $today = date('Y-m-d');

        $url_form = base_url('booking/arriveWarehouse/' . $id);

        $tanggal_berangkat = $data['tanggal_berangkat'];
        $min = (!$tanggal_berangkat) ? "min='$today'" : '';

        $output = "<form method='POST' action='$url_form'>";
        $output .= "
                <div class='row'>
                    <div class='col-md-6 col-12'>
                        <div class='mb-3'>
                            <label class='form-label'>Jenis moda pengiriman</label>
                            <select class='form-select' name='moda_pengiriman' required>
                                <option value=''>:: Pilih moda pengiriman</option>
                                <option value='kereta'>Kereta</option>
                                <option value='pesawat'>Pesawat</option>
                            </select>
                        </div>
                    </div> 
                    <div class='col-md-6 col-12'>
                        <div class='mb-3'>
                            <label class='form-label'>Tanggal keberangkatan</label>
                            <input type='date' class='form-control' name='tanggal_berangkat' $min value='$tanggal_berangkat'>
                        </div>
                    </div>
                </div>";
        $output .= "<div class='row mt-2'><div class='col-12 text-end'><button type='submit' class='btn btn-primary btn-submit'>Confirm</button></div></div>";
        $output .= "</form>";

        echo $output;
    }

    public function formPickup()
    {
        $id = $this->input->post('id');
        $drivers = $this->M_Booking->list_driver();

        $data = $this->M_Booking->getItemAwb($id);

        $today = date('Y-m-d');

        $url_form = base_url('booking/setPickup/' . $id);

        $output = "<form method='POST' action='$url_form'>";
        $output .= "<div class='row'>
                    <div class='col-md-6 col-12'>
                        <div class='mb-3'>
                            <label class='form-label'>Driver</label>
                            <select class='form-select' name='driver_id' required>
                                <option value=''>:: Pilih driver pickup</option>";

        foreach ($drivers as $d) {
            $driver_id = htmlspecialchars($d->Id, ENT_QUOTES, 'UTF-8');
            $driver_name = htmlspecialchars($d->name, ENT_QUOTES, 'UTF-8');
            $selected = ($driver_id == $data['driver_pickup_id']) ? 'selected' : '';
            $output .= "<option value='$driver_id' $selected>$driver_name</option>";
        }

        $tanggal_pickup = $data['tanggal_pickup'];
        $min = (!$tanggal_pickup) ? "min='$today'" : '';

        $output .= "</select>
                    </div>
                </div>
                <div class='col-md-6 col-12'>
                    <div class='mb-3'>
                        <label class='form-label'>Tanggal pickup</label>
                        <input type='date' class='form-control' name='tanggal_pickup' $min value='$tanggal_pickup'>
                    </div>
                </div>
            </div>";

        $output .= "<div class='row mt-2'><div class='col-12 text-end'><button type='submit' class='btn btn-primary btn-submit'>Set Pickup</button></div></div>";
        $output .= "</form>";

        echo $output;
    }

    public function updateTrackingStatus($id, $status, $successMessage, $errorMessage)
    {
        $data = ['status_tracking' => $status];

        if ($this->M_Booking->updateAwbDetail($id, $data)) {
            $this->session->set_flashdata('message_name', $successMessage);
        } else {
            $this->session->set_flashdata('message_error', $errorMessage);
        }

        redirect('booking/list_detail');
    }

    public function setPickup($id)
    {
        $data = [
            'driver_pickup_id' => $this->input->post('driver_id'),
            'jadwal_pickup' => $this->input->post('tanggal_pickup'),
            'status_tracking' => '1',
        ];

        if ($this->M_Booking->updateAwbDetail($id, $data)) {
            $this->session->set_flashdata('message_name', "Penjemputan barang $id sudah diatur.");
        } else {
            $this->session->set_flashdata('message_error', "Gagal atur penjemputan barang $id. Silahkan coba lagi!");
        }

        redirect('booking/list_detail');
    }

    public function confirmPickup($id)
    {
        $data = [
            'status_tracking' => '2',
        ];

        if ($this->M_Booking->updateAwbDetail($id, $data)) {
            $this->session->set_flashdata('message_name', "Konfirmasi barang $id sudah di-pickup berhasil. OTW warehouse");
        } else {
            $this->session->set_flashdata('message_error', "Gagal konfimasi pickup barang $id. Silahkan coba lagi!");
        }

        redirect('booking/list_detail');
    }

    public function arriveWarehouse($id)
    {
        $data = [
            'status_tracking' => '3',
            'tanggal_berangkat' => $this->input->post('tanggal_berangkat'),
            'moda_pengiriman' => $this->input->post('moda_pengiriman'),
        ];

        if ($this->M_Booking->updateAwbDetail($id, $data)) {
            $this->session->set_flashdata('message_name', "Konfirmasi barang $id sudah tiba di gudang berhasil. OTW tujuan pengiriman");
        } else {
            $this->session->set_flashdata('message_error', "Gagal konfimasi barang $id tiba di gudang. Silahkan coba lagi!");
        }

        redirect('booking/list_detail');
    }

    public function arriveDestination($id)
    {
        $data = [
            'status_tracking' => '4',
        ];

        if ($this->M_Booking->updateAwbDetail($id, $data)) {
            $this->session->set_flashdata('message_name', "Konfirmasi barang $id sudah tiba di tujuan berhasil.");
        } else {
            $this->session->set_flashdata('message_error', "Gagal konfimasi barang $id tiba di tujuan. Silahkan coba lagi!");
        }

        redirect('booking/list_detail');
    }
}
