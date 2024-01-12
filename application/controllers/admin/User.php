<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Input $input
 * @property User_model $user_model
 */
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');
    }

    public function index()
    {
        $this->load->view(
            'layouts/admin/header',
            array(
                'page_title' => 'Kelola Pengguna',
                'auth' => $this->session->userdata('auth'),
            )
        );
        $this->load->view(
            'admin/user/index',
            array(
                'user' => $this->user_model->search_user(),
            )
        );
        $this->load->view('layouts/admin/footer');
    }

    public function create()
    {
        if ($this->input->method() == 'post') {
            return $this->store();
        }

        $this->load->view(
            'layouts/admin/header',
            array(
                'page_title' => 'Pengguna Baru',
                'auth' => $this->session->userdata('auth'),
                'system_notifications' => $this->session->flashdata('system_notifications'),
            )
        );
        $this->load->view('admin/user/create');
        $this->load->view('layouts/admin/footer');
    }

    public function edit($id)
    {
        $user = $this->user_model->find_user(array('id' => $id));

        if (!$user) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Kesalahan',
                        'message' => 'User tidak ditemukan',
                    )
                )
            );

            return redirect(base_url('/admin/user'));
        }

        if ($this->input->method() == 'post') {
            return $this->update($user);
        }

        $this->load->view(
            'layouts/admin/header',
            array(
                'page_title' => 'Ubah Pengguna',
                'auth' => $this->session->userdata('auth'),
                'system_notifications' => $this->session->flashdata('system_notifications'),
            )
        );
        $this->load->view('admin/user/edit', array('user' => $user));
        $this->load->view('layouts/admin/footer');
    }

    private function store()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'email' => strtolower($this->input->post('email')),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => $this->input->post('role'),
        );

        if ($this->user_model->find_user(array('email' => $data['email']))) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Gagal',
                        'message' => 'Alamat surel sudah dipakai',
                    )
                )
            );

            return redirect(base_url('/admin/user/create'));
        }

        try {
            $user = $this->user_model->create_user($data);

            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'success',
                        'title' => 'Berhasil',
                        'message' => 'Pengguna baru berhasil ditambahkan',
                    )
                )
            );

            return redirect(base_url("/admin/user/edit/{$user->id}"));
        } catch (Exception $e) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Kesalahan',
                        'message' => $e->getMessage(),
                    )
                )
            );

            return redirect(base_url('/admin/user/create'));
        }
    }

    private function update(User_model $user)
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'email' => strtolower($this->input->post('email')),
            'role' => $this->input->post('role'),
        );

        if ($data['email'] != $user->email && $this->user_model->find_user(array('email' => $data['email']))) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Gagal',
                        'message' => 'Alamat surel sudah dipakai',
                    )
                )
            );

            return redirect(base_url("/admin/user/edit/{$user->id}"));
        }

        try {
            if (!$user->update($data)) {
                $this->session->set_flashdata(
                    'system_notifications',
                    array(
                        array(
                            'type' => 'danger',
                            'title' => 'Gagal',
                            'message' => 'Tidak dapat mengubah data pengguna',
                        )
                    )
                );
            }

            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'success',
                        'title' => 'Berhasil',
                        'message' => 'Data pengguna berhasil diubah',
                    )
                )
            );

            return redirect(base_url("/admin/user/edit/{$user->id}"));
        } catch (Exception $e) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Kesalahan',
                        'message' => $e->getMessage(),
                    )
                )
            );

            return redirect(base_url("/admin/user/edit/{$user->id}"));
        }
    }

    public function delete($id)
    {
        $user = $this->user_model->find_user(array('id' => $id));

        if (!$user) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Kesalahan',
                        'message' => 'User tidak ditemukan',
                    )
                )
            );

            return redirect(base_url('/admin/user'));
        }

        try {
            if (!$user->delete()) {
                $this->session->set_flashdata(
                    'system_notifications',
                    array(
                        array(
                            'type' => 'danger',
                            'title' => 'Gagal',
                            'message' => 'Tidak dapat menghapus pengguna',
                        )
                    )
                );
            }

            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'success',
                        'title' => 'Berhasil',
                        'message' => 'Pengguna berhasil dihapus',
                    )
                )
            );
        } catch (Exception $e) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Kesalahan',
                        'message' => $e->getMessage(),
                    )
                )
            );
        }

        return redirect(base_url('/admin/user'));
    }
}
