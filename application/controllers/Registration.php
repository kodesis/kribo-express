<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['string', 'date']);
        $this->load->model(['M_Setting', 'M_Agent']);
    }

    public function index()
    {
        if ($this->session->userdata('is_logged_in')) {
            redirect('dashboard');
        }

        $data['title'] = 'Registration';

        $fields = [
            ['nama_agent', 'Nama'],
            ['no_telepon', 'No. Telepon'],
            ['email', 'Email', 'valid_email|is_unique[user.email]', 'The email has already registered'],
            ['provinsi', 'Provinsi'],
            ['kota', 'Kota'],
            ['kecamatan', 'Kecamatan'],
            ['kelurahan', 'Kelurahan'],
            ['rt', 'RT'],
            ['rw', 'RW'],
            ['alamat', 'Alamat'],
            ['google_maps', 'Google Maps URL']
        ];

        foreach ($fields as $field) {
            $this->form_validation->set_rules(
                $field[0],
                $field[1],
                isset($field[2]) ? "required|trim|$field[2]" : 'required|trim',
                isset($field[3]) ? ['is_unique' => $field[3]] : []
            );
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('pages/registration', $data);
        } else {
            $formData = [
                'nama_agent' => htmlspecialchars($this->input->post('nama_agent', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'no_telepon' => $this->input->post('no_telepon')
            ];

            echo '<pre>', print_r($this->input->post()), '</pre>';
            exit;
        }
    }

    public function getProvinsi()
    {
        $provinsi = $this->M_Setting->getProvinsi();

        $show = '<option value="">:: Pilih provinsi</option>';
        foreach ($provinsi as $p) :
            $selected = (set_value('provinsi') == $p->id) ? 'selected' : '';
            $show .= "<option $selected value='$p->id'>$p->nama_provinsi</option>";
        endforeach;

        echo $show;
    }

    public function getKota()
    {
        $id = $this->input->post('provinsi');
        $kota = $this->M_Setting->getKota($id);

        $show = '<option value="">:: Pilih kota/kabupaten</option>';
        foreach ($kota as $p) :
            $show .= "<option value='$p->id'>$p->nama_kota</option>";
        endforeach;

        echo $show;
    }

    public function getKecamatan()
    {
        $id = $this->input->post('kota');
        $kecamatan = $this->M_Setting->getKecamatan($id);

        $show = '<option value="">:: Pilih kecamatan</option>';
        $show .= $id;
        foreach ($kecamatan as $p) :
            $show .= "<option value='$p->id'>$p->nama_kecamatan</option>";
        endforeach;

        echo $show;
    }

    public function getKelurahan()
    {
        $id = $this->input->post('kecamatan');
        $kelurahan = $this->M_Setting->getKelurahan($id);
        echo $id;

        $show = '<option value="">:: Pilih kelurahan</option>';
        foreach ($kelurahan as $p) :
            $show .= "<option value='$p->id'>$p->nama_kelurahan</option>";
        endforeach;

        echo $show;
    }

    public function checkEmail()
    {
        $id = $this->input->post('email');

        $email = $this->db->where('email', $id)->get('user')->num_rows();

        echo $email;
    }

    public function submitRegistrasi()
    {
        echo '<pre>';
        print_r($_POST);
        print_r($_FILES);
        echo '</pre>';
        exit;

        $ktp = $_FILES['ktp']['name']; // Nama file 
        $ktp = $_FILES['ktp']['name']; // Nama file 
        $ktp = $_FILES['ktp']['name']; // Nama file 

        // Ambil extension
        $pathInfo = pathinfo($ktp);
        $extension = $pathInfo['extension']; // Extension file
        $newPhotoFileName = $ktp . '.' . $extension;

        $config = [
            'upload_path' => FCPATH . 'assets/photo-delivered/',
            'allowed_types' => 'JPG|jpg|JPEG|jpeg',
            'overwrite' => TRUE,
            'max_size' => '1200',
            'file_name' => $newPhotoFileName,
        ];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_upload')) {

            $this->session->set_flashdata('message_name', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal konfirmasi pickup. Silahkan coba lagi! ' . $this->upload->display_errors() . ' <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                        </div>');

            redirect('confirm/failed');
        } else {
            $data_resi = [
                'status_tracking' => '4',
                'confirm_arrival' => '1',
            ];

            $this->db->trans_begin();

            if ($this->M_Booking->updateResi($ktp, $data_resi)) {
                $this->db->trans_commit();

                // $pesan_pengirim = $this->messageToCustomer($detailResi);
                // $pesan_penerima = $this->messageToCustomer($detailResi);

                // $this->api_whatsapp->wa_notif($pesan_pengirim, $detailResi['telepon_pengirim']);
                // $this->api_whatsapp->wa_notif($pesan_penerima, $detailResi['telepon_penerima']);

                $this->session->set_flashdata('message_name', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Resi dengan nomor ' . $ktp . ' telah dikonfirmasi tiba di kota tujuan.
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                        </div>');

                redirect('confirm/success');
            } else {
                $this->db->trans_rollback();

                $this->session->set_flashdata('message_name', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal konfirmasi resi tiba di tujuan. Silahkan coba lagi!
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                        </div>');

                redirect('confirm/failed');
            }
        }
    }
}
