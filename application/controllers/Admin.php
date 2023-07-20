<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->db->get_where('staff', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }


    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function users()
    {
        $data['title'] = 'Users';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('User_model', 'user');
        $data['users'] = $this->user->getRole();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer');
    }


    public function usersEdit($id)
    {
        $data['title'] = 'Users';
        $data['user'] = $this->db->get_where('user', ['id' => $id])->row_array();

        $this->load->model('User_model', 'user');
        $data['users'] = $this->user->getRole();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('npm', 'NPM', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('users/index', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $npm = $this->input->post('npm');
            $email = $this->input->post('email');
            $is_active = $this->input->post('is_active');

            $this->db->set('name', $name);
            $this->db->set('npm', $npm);
            $this->db->set('email', $email);
            $this->db->set('is_active', $is_active);
            $this->db->where('id', $id);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data users has been updated!</div>');
            redirect('admin/users');
        }
    }


    public function users_delete($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('id', $id);
        $this->db->delete('user');
        $old_image = $data['user']['image'];
        if ($old_image != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profile/' . $old_image);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your data users has been deleted!</div>');
        redirect('admin/users');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function staffs()
    {
        $data['title'] = 'Staff';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Staff_model', 'staff');
        $data['staffs'] = $this->staff->getRole();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('staff', 'Staff', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('role_id', 'role_id', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/staffs', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'staff' => htmlspecialchars($this->input->post('staff'), true),
                'kategori' => htmlspecialchars($this->input->post('kategori'), true),
                'email' => htmlspecialchars($this->input->post('email'), true),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'image' => 'default.jpg',
                'role_id' => $this->input->post('role_id'),
                'date_created' => time(),
            ];
            $this->db->insert('staff', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Staff added!</div>');
            redirect('admin/staffs');
        }
    }

    function staffEdit($id)
    {
        $data['title'] = 'Staff';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Staff_model', 'staff');
        $data['staffs'] = $this->staff->getRole();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('staff', 'Staff', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim');
        $this->form_validation->set_rules('role_id', 'role_id', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/staffs', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'staff' => $this->input->post('staff'),
                'kategori' => $this->input->post('kategori'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'image' => 'default.jpg',
                'role_id' => $this->input->post('role_id'),
                'date_created' => time(),
            ];
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('staff', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data staff updated!</div>');
            redirect('admin/staffs');
        }
    }

    public function pengaduan()
    {
        $data['title'] = 'Pengaduan Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'pengaduan');
        $data['pengaduan'] = $this->pengaduan->getPengaduanMasuk();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pengaduan', $data);
        $this->load->view('templates/footer');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('staff', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'pengaduan');
        $data['pengaduan'] = $this->pengaduan->laporan_pengaduan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function generate_laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('staff', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'pengaduan');
        $data['pengaduan'] = $this->pengaduan->laporan_pengaduan();
        
        $html = $this->load->view('admin/generate_laporan', $data, true);
        // $data['title'] = 'Laporan';
        // $data['user'] = $this->db->get_where('staff', ['email' => $this->session->userdata('email')])->row_array();

        // $this->load->model('Admin_model', 'pengaduan');
        // $data['pengaduan'] = $this->pengaduan->laporan_pengaduan();

        // $html = $this->load->view('admin/generate_laporan', $data, true);

        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'orientation' => 'landscape',
            'margin' => 0
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function pengaduan_detail()
    {
        $data['title'] = 'Pengaduan Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $this->input->post('id');

        $cek_data = $this->db->get_where('pengaduan', ['id' => $id])->row_array();
        $data['staffs'] = $this->db->get('staff')->result_array();

        if (!empty($cek_data)) {
            $data['title'] = 'Beri Tanggapan';
            $data['pengaduan'] = $this->db->get_where('pengaduan', ['id' => $id])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pengaduan-detail', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your data no empty</div>');
            redirect('admin/pengaduan');
        }
    }

    function tanggapan()
    {
        $id = htmlspecialchars($this->input->post('id', true));

        $data['title'] = 'Pengaduan Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pengaduan'] = $this->db->get_where('pengaduan', ['id' => $id])->row_array();

        $this->form_validation->set_rules('status', 'Status Pengaduan', 'trim|required');
        $this->form_validation->set_rules('staff', 'Kategori', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pengaduan-detail', $data);
            $this->load->view('templates/footer');
        } else {
            $params = [
                'pengaduan_id' => $id,
                'tanggal' => time(),
                'kategori_id' => htmlspecialchars($this->input->post('staff', true))
            ];

            $tanggapan = $this->db->insert('tanggapan', $params);
            $status = htmlspecialchars($this->input->post('status', true));
            $kategori_id = htmlspecialchars($this->input->post('staff', true));

            $data['staff'] = $this->db->get_where('staff', ['id' => $params['kategori_id']])->row_array();

            if ($tanggapan) {
                $params = [
                    'status' => $status,
                    'kategori_id' => $kategori_id
                ];

                $this->db->where('id', $id);
                $update_status_pengaduan = $this->db->update('pengaduan', $params);

                if ($update_status_pengaduan) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">Menanggapi berhasil</div>');
                    redirect('admin/pengaduan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Update Pengaduan</div>');
                    redirect('admin/pengaduan');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Menanggapi gagal!</div>');
                redirect('admin/pengaduan');
            }
        }
    }
}
