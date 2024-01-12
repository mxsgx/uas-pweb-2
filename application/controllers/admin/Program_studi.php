<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property Program_studi_model $program_studi_model
 */
class Program_studi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('program_studi_model');
    }

    public function index()
    {
        $this->load->view(
            'layouts/admin/header',
            array(
                'page_title' => 'Kelola Program Studi',
                'auth' => $this->session->userdata('auth'),
                'system_notifications' => $this->session->flashdata('system_notifications'),
            )
        );
        $this->load->view(
            'admin/program_studi/index',
            array(
                'program_studi' => $this->program_studi_model->search_program_studi(),
            )
        );
        $this->load->view('layouts/admin/footer');
    }

    public function create()
    {
        if ($this->input->method() != 'post') {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Kesalahan',
                        'message' => 'Akses dilarang',
                    )
                )
            );

            return redirect(base_url('/admin/program_studi'));
        }

        $data = array(
            'nama' => $this->input->post('nama'),
        );

        try {
            $this->program_studi_model->create_program_studi($data);

            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'success',
                        'title' => 'Berhasil',
                        'message' => 'Program studi berhasil ditambahkan',
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

        return redirect(base_url("/admin/program_studi"));
    }

    public function edit($id)
    {
        $program_studi = $this->program_studi_model->find_program_studi(array('id' => $id));

        if (!$program_studi) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Kesalahan',
                        'message' => 'Program studi tidak ditemukan',
                    )
                )
            );

            return redirect(base_url('/admin/program_studi'));
        }

        if ($this->input->method() == 'post') {
            return $this->update($program_studi);
        }

        $this->load->view(
            'layouts/admin/header',
            array(
                'page_title' => 'Ubah Mata Kuliah',
                'auth' => $this->session->userdata('auth'),
                'system_notifications' => $this->session->flashdata('system_notifications'),
            )
        );
        $this->load->view('admin/program_studi/edit', array('program_studi' => $program_studi));
        $this->load->view('layouts/admin/footer');
    }

    public function update(program_studi_model $program_studi)
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );

        try {
            if (!$program_studi->update($data)) {
                $this->session->set_flashdata(
                    'system_notifications',
                    array(
                        array(
                            'type' => 'danger',
                            'title' => 'Gagal',
                            'message' => 'Tidak dapat mengubah data program studi',
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
                        'message' => 'Data program studi berhasil diubah',
                    )
                )
            );

            return redirect(base_url("/admin/program_studi/edit/{$program_studi->id}"));
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

            return redirect(base_url("/admin/program_studi/edit/{$program_studi->id}"));
        }
    }

    public function delete($id)
    {
        $program_studi = $this->program_studi_model->find_program_studi(array('id' => $id));

        if (!$program_studi) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Kesalahan',
                        'message' => 'Program studi tidak ditemukan',
                    )
                )
            );

            return redirect(base_url('/admin/program_studi'));
        }

        try {
            if (!$program_studi->delete()) {
                $this->session->set_flashdata(
                    'system_notifications',
                    array(
                        array(
                            'type' => 'danger',
                            'title' => 'Gagal',
                            'message' => 'Tidak dapat menghapus program studi',
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
                        'message' => 'Program studi berhasil dihapus',
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

        return redirect(base_url('/admin/program_studi'));
    }
}
