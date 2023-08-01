<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('staff', ['email' => $email])->row_array();

        $this->load->model('Pengaduan_model', 'pengaduan');
        $data['aksesHariIni'] = $this->pengaduan->getDataHarian();
        $data['jumlahAkses'] = $this->pengaduan->getData();
        $data['terlayani'] = $this->pengaduan->getDataTerlayani();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('staff/index', $data);
        $this->load->view('templates/footer');
    }

    public function pengaduan()
    {
        $data['title'] = 'Pengaduan Masuk (Staff)';
        $data['user'] = $this->db->get_where('staff', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Staff_model', 'pengaduan');
        $data['pengaduan'] = $this->pengaduan->getPengaduanMasukStaff($data['user']['id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('staff/pengaduan', $data);
        $this->load->view('templates/footer');
    }

    public function pengaduan_detail()
    {
        $data['title'] = 'Pengaduan Masuk (Staff)';
        $data['user'] = $this->db->get_where('staff', ['email' => $this->session->userdata('email')])->row_array();
        $id = $this->input->post('id');

        $cek_data = $this->db->get_where('pengaduan', ['id' => $id])->row_array();

        if (!empty($cek_data)) {
            $data['title'] = 'Beri Tanggapan';
            $data['pengaduan'] = $this->db->get_where('pengaduan', ['id' => $id])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('staff/pengaduan_detail', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your data no empty</div>');
            redirect('staff/pengaduan');
        }
    }

    public function tanggapan()
    {
        $id = htmlspecialchars($this->input->post('id', true));

        $data['title'] = 'Pengaduan Masuk';
        $data['user'] = $this->db->get_where('staff', ['email' => $this->session->userdata('email')])->row_array();
        $data['pengaduan'] = $this->db->get_where('pengaduan', ['id' => $id])->row_array();

        $this->form_validation->set_rules('status', 'Status Pengaduan', 'trim|required');
        $this->form_validation->set_rules('tanggapan', 'Tanggapan', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('staff/pengaduan_detail', $data);
            $this->load->view('templates/footer');
        } else {
            $params = [
                'pengaduan_id' => $id,
                'tanggapan' => htmlspecialchars($this->input->post('tanggapan', true)),
                'tanggal' => time(),
            ];

            $this->db->where('id', $id);
            $tanggapan = $this->db->update('tanggapan', $params);
            $status = htmlspecialchars($this->input->post('status', true));

            // $data['staff'] = $this->db->get_where('staff', ['id' => $params['kategori_id']])->row_array();

            if ($tanggapan) {
                $params = [
                    'status' => $status,
                ];

                $this->db->where('id', $id);
                $update_status_pengaduan = $this->db->update('pengaduan', $params);

                if ($update_status_pengaduan) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Menanggapi berhasil</div>');
                    redirect('staff/pengaduan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Update Pengaduan</div>');
                    redirect('staff/pengaduan');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Menanggapi gagal!</div>');
                redirect('staff/pengaduan');
            }
        }
    }

    // public function pengaduanditolak()
    // {
    //     $data['title'] = 'Pengaduan Ditolak (Staff)';
    //     $data['user'] = $this->db->get_where('staff', ['email' => $this->session->userdata('email')])->row_array();

    //     $this->load->model('Staff_model', 'pengaduan');
    //     $data['pengaduan'] = $this->pengaduan->getPengaduanTolakStaff($data['user']['id']);

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('staff/pengaduan_ditolak', $data);
    //     $this->load->view('templates/footer');
    // }

    public function pengaduanselesai()
    {
        $data['title'] = 'Pengaduan Selesai (Staff)';
        $data['user'] = $this->db->get_where('staff', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Staff_model', 'pengaduan');
        $data['pengaduan'] = $this->pengaduan->getPengaduanSelesaiStaff($data['user']['id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('staff/pengaduan_selesai', $data);
        $this->load->view('templates/footer');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('staff', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Staff_model', 'pengaduan');
        $data['pengaduan'] = $this->pengaduan->laporan_pengaduan($data['user']['id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('staff/laporan', $data);
        $this->load->view('templates/footer');
    }

}
