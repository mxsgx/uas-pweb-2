<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property User_model $user_model
 */
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');
    }

    public function login()
    {
        if ($this->session->userdata('auth')) {
            redirect(base_url('/admin'));

            return;
        }

        if ($this->input->method() === 'post') {
            return $this->do_login();
        }

        $this->load->view('layouts/auth/header');
        $this->load->view(
            'auth/login',
            array(
                'system_notifications' => $this->session->flashdata('system_notifications'),
            )
        );
        $this->load->view('layouts/auth/footer');
    }

    private function do_login()
    {
        $email = $this->input->post('email');
        $user = $this->user_model->find_user(array('email' => $email));

        if (!$user) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Kesalahan',
                        'message' => 'User tidak ditemukan',
                    )
                ),
            );

            return redirect(base_url('/auth/login'));
        }

        if (!password_verify($this->input->post('password'), $user->password)) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Kesalahan',
                        'message' => 'Email atau password tidak cocok',
                    )
                ),
            );

            return redirect(base_url('/auth/login'));
        }

        $this->session->set_flashdata(
            'system_notifications',
            array(
                array(
                    'type' => 'success',
                    'title' => 'Halo',
                    'message' => "Selamat datang $user->nama!",
                ),
            ),
        );

        $this->session->set_userdata(
            'auth',
            array(
                'user' => $user->to_array(),
            ),
        );

        return redirect(base_url('/admin'));
    }

    public function logout()
    {
        $this->session->unset_userdata('auth');

        return redirect(base_url('/auth/login'));
    }
}
