<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property Program_studi_model $program_studi_model
 * @property Rps_model $rps_model
 */
class Rps extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('rps_model');
        $this->load->model('program_studi_model');
        $this->load->model('mata_kuliah_model');
    }

    public function index()
    {
        $query = NULL;

        if ($program_studi_id = $this->input->get('program_studi')) {
            $query = array(
                'program_studi_id' => $program_studi_id,
            );
        }

        $this->load->view('layouts/header');
        $this->load->view(
            'index',
            array(
                'rps' => $this->rps_model->search_rps($query),
                'program_studi' => $this->program_studi_model->search_program_studi(),
            )
        );
        $this->load->view('layouts/footer');
    }
}