<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 */
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('auth')) {
            redirect(base_url('/auth/login'));
            return;
        }
    }

    public function index()
    {
        $this->load->view(
            'layouts/admin/header',
            array(
                'auth' => $this->session->userdata('auth'),
            )
        );
        $this->load->view('admin/index');
        $this->load->view('layouts/admin/footer');
    }
}
