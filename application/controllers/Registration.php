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
        // Debugging input POST dan FILES
        // echo '<pre>';
        // print_r($_POST);
        // print_r($_FILES);
        // echo '</pre>';
        // exit;

        // Load library upload
        $this->load->library('upload');

        $config['upload_path'] = FCPATH . 'assets/photo-delivered/';
        $config['allowed_types'] = 'jpg|jpeg';
        $config['overwrite'] = TRUE;
        $config['max_size'] = '1200';

        // File yang di-upload
        $files = ['ktp', 'foto_depan', 'foto_dalam'];
        $gambar = [];

        foreach ($files as $file) {
            // Ambil extension file
            $pathInfo = pathinfo($_FILES[$file]['name']);
            $extension = $pathInfo['extension'];
            $newFileName = $file . '_' . time() . '.' . $extension;

            $config['file_name'] = $newFileName;
            $this->upload->initialize($config);

            if ($this->upload->do_upload($file)) {
                $gambar[$file] = $this->upload->data('file_name');
            } else {
                $error = $this->upload->display_errors();
                echo "Upload gagal untuk $file: $error";
                return;
            }
        }

        $data = [
            'jenis_pengajuan' => trim($this->input->post('jenis_pengajuan')),
            'nama_pendaftar' => trim($this->input->post('nama_pendaftar')),
            'no_handphone' => trim($this->input->post('no_handphone')),
            'no_handphone_alternatif' => trim($this->input->post('no_handphone_alternatif')),
            'alamat_email' => trim($this->input->post('alamat_email')),
            'sumber_info' => $this->input->post('sumber_info'),
            'lokasi' => $this->input->post('lokasi'),
            'jenis_bangunan' => $this->input->post('jenis_bangunan'),
            'status_bangunan' => $this->input->post('status_bangunan'),
            'usaha_lain' => $this->input->post('usaha_lain'),
            'provinsi' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'alamat_lengkap' => trim($this->input->post('alamat_lengkap')),
            'google_maps' => trim($this->input->post('google_maps')),
            'kode_referal' => trim($this->input->post('kode_referal')),
            'ktp' => $gambar['ktp'],
            'foto_depan' => $gambar['foto_depan'],
            'foto_dalam' => $gambar['foto_dalam'],
        ];

        $this->db->trans_begin();

        if ($this->M_Agent->insertMitra($data)) {
            $this->db->trans_commit();

            $this->session->set_flashdata('message_name', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Registrasi berhasil. Terima kasih atas ketertarikan Anda untuk bergabung dengan kami.
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('home/agent');
        } else {
            $this->db->trans_rollback();

            $this->session->set_flashdata('message_name', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Gagal input data registrasi. Silahkan coba lagi!
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('home/agent');
        }
    }
}
