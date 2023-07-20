<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Dashboard User';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function pengaduan()
    {
        $data['title'] = 'Pengaduan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('User_model', 'pengaduan');
        $data['pengaduan'] = $this->pengaduan->getUser($data['user']['id']);

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/pengaduan', $data);
            $this->load->view('templates/footer');
        } else {
            $upload_image = $_FILES['bukti']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('bukti')) {
                    $new_image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = [
                'user_id' => $data['user']['id'],
                'title' => $this->input->post('title'),
                'body' => $this->input->post('body'),
                'created_at' => time(),
                'bukti' => $new_image,
                'status' => '0'
            ];
            // $user_id = $data['user']['id'];
            // $title = htmlspecialchars($this->input->post('title'), true);
            // $body = htmlspecialchars($this->input->post('body'), true);
            // $created_at = time();
            // $status = null;

            $this->db->insert('pengaduan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengaduan berhasil dikirim</div>');
            redirect('user/pengaduan');
        }
    }

    public function pengaduan_detail($id)
    {

        $cek_data = $this->db->get_where('pengaduan', ['id' => htmlspecialchars($id)])->row_array();

        if (!empty($cek_data)) :

            $data['title'] = 'Detail Pengaduan';

            $this->load->model('User_model', 'pengaduan');
            $data['pengaduan'] = $this->pengaduan->getDetail($id);

            if ($data['pengaduan']) :
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/pengaduan_detail', $data);
                $this->load->view('templates/footer');
            else :
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Pengaduan sedang di proses!
					</div>');

                redirect('user/pengaduan');
            endif;

        else :
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				data tidak ada
				</div>');

            redirect('user/pengaduan');
        endif;
    }
}
