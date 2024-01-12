<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Upload $upload
 * @property Mata_kuliah_model $mata_kuliah_model
 * @property Program_studi_model $program_studi_model
 * @property Rps_model $rps_model
 */
class Rps extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('rps_model');
        $this->load->model('mata_kuliah_model');
        $this->load->model('program_studi_model');
    }

    public function index()
    {
        $this->load->view(
            'layouts/admin/header',
            array(
                'page_title' => 'Kelola RPS',
                'auth' => $this->session->userdata('auth'),
            )
        );
        $this->load->view(
            'admin/rps/index',
            array(
                'rps' => $this->rps_model->search_rps(),
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
                'page_title' => 'Buat RPS',
                'auth' => $this->session->userdata('auth'),
                'system_notifications' => $this->session->flashdata('system_notifications'),
            )
        );
        $this->load->view(
            'admin/rps/create',
            array(
                'mata_kuliah' => $this->mata_kuliah_model->search_mata_kuliah(),
                'program_studi' => $this->program_studi_model->search_program_studi(),
            )
        );
        $this->load->view('layouts/admin/footer');
    }

    private function store()
    {
        $this->upload->initialize(
            array(
                'upload_path' => APPPATH . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR,
                'allowed_types' => 'pdf',
                'file_name' => strtolower($this->input->post('kode')),
                'file_ext_lower' => TRUE,
                'overwrite' => TRUE,
            )
        );

        if (!$this->upload->do_upload('file')) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Gagal',
                        'message' => 'Gagal mengunggah dokumen (Pesan:' . $this->upload->display_errors(' ', '') . ')',
                    )
                )
            );

            return redirect(base_url('/admin/rps/create'));
        }

        $data = array(
            'kode' => $this->input->post('kode'),
            'sks' => $this->input->post('sks'),
            'dokumen' => $this->upload->data()['file_name'],
            'mata_kuliah_id' => $this->input->post('mata_kuliah_id'),
            'program_studi_id' => $this->input->post('program_studi_id'),
        );

        try {
            $rps = $this->rps_model->create_rps($data);

            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'success',
                        'title' => 'Berhasil',
                        'message' => 'RPS berhasil dibuat',
                    )
                )
            );

            return redirect(base_url("/admin/rps/edit/{$rps->id}"));
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

            return redirect(base_url('/admin/rps/create'));
        }
    }

    public function edit($id)
    {
        $rps = $this->rps_model->find_rps(array('id' => $id));

        if (!$rps) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Kesalahan',
                        'message' => 'RPS tidak ditemukan',
                    )
                )
            );

            return redirect(base_url('/admin/rps'));
        }

        if ($this->input->method() == 'post') {
            return $this->update($rps);
        }

        $this->load->view(
            'layouts/admin/header',
            array(
                'page_title' => 'Ubah RPS',
                'auth' => $this->session->userdata('auth'),
                'system_notifications' => $this->session->flashdata('system_notifications'),
            )
        );
        $this->load->view(
            'admin/rps/edit',
            array(
                'rps' => $rps,
                'mata_kuliah' => $this->mata_kuliah_model->search_mata_kuliah(),
                'program_studi' => $this->program_studi_model->search_program_studi(),
            )
        );
        $this->load->view('layouts/admin/footer');
    }

    public function update(Rps_model $rps)
    {
        //
    }
}
