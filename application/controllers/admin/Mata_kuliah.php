<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property Mata_kuliah_model $mata_kuliah_model
 */
class Mata_kuliah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mata_kuliah_model');
    }

    public function index()
    {
        $this->load->view(
            'layouts/admin/header',
            array(
                'page_title' => 'Kelola Mata Kuliah',
                'auth' => $this->session->userdata('auth'),
                'system_notifications' => $this->session->flashdata('system_notifications'),
            )
        );
        $this->load->view(
            'admin/mata_kuliah/index',
            array(
                'mata_kuliah' => $this->mata_kuliah_model->search_mata_kuliah(),
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

            return redirect(base_url('/admin/mata_kuliah'));
        }

        $data = array(
            'nama' => $this->input->post('nama'),
        );

        try {
            $this->mata_kuliah_model->create_mata_kuliah($data);

            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'success',
                        'title' => 'Berhasil',
                        'message' => 'Mata kuliah berhasil ditambahkan',
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

        return redirect(base_url("/admin/mata_kuliah"));
    }

    public function edit($id)
    {
        $mata_kuliah = $this->mata_kuliah_model->find_mata_kuliah(array('id' => $id));

        if (!$mata_kuliah) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Kesalahan',
                        'message' => 'Mata kuliah tidak ditemukan',
                    )
                )
            );

            return redirect(base_url('/admin/mata_kuliah'));
        }

        if ($this->input->method() == 'post') {
            return $this->update($mata_kuliah);
        }

        $this->load->view(
            'layouts/admin/header',
            array(
                'page_title' => 'Ubah Mata Kuliah',
                'auth' => $this->session->userdata('auth'),
                'system_notifications' => $this->session->flashdata('system_notifications'),
            )
        );
        $this->load->view('admin/mata_kuliah/edit', array('mata_kuliah' => $mata_kuliah));
        $this->load->view('layouts/admin/footer');
    }

    public function update(Mata_kuliah_model $mata_kuliah)
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );

        try {
            if (!$mata_kuliah->update($data)) {
                $this->session->set_flashdata(
                    'system_notifications',
                    array(
                        array(
                            'type' => 'danger',
                            'title' => 'Gagal',
                            'message' => 'Tidak dapat mengubah data mata kuliah',
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
                        'message' => 'Data mata kuliah berhasil diubah',
                    )
                )
            );

            return redirect(base_url("/admin/mata_kuliah/edit/{$mata_kuliah->id}"));
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

            return redirect(base_url("/admin/mata_kuliah/edit/{$mata_kuliah->id}"));
        }
    }

    public function delete($id)
    {
        $mata_kuliah = $this->mata_kuliah_model->find_mata_kuliah(array('id' => $id));

        if (!$mata_kuliah) {
            $this->session->set_flashdata(
                'system_notifications',
                array(
                    array(
                        'type' => 'danger',
                        'title' => 'Kesalahan',
                        'message' => 'Mata kuliah tidak ditemukan',
                    )
                )
            );

            return redirect(base_url('/admin/mata_kuliah'));
        }

        try {
            if (!$mata_kuliah->delete()) {
                $this->session->set_flashdata(
                    'system_notifications',
                    array(
                        array(
                            'type' => 'danger',
                            'title' => 'Gagal',
                            'message' => 'Tidak dapat menghapus mata kuliah',
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
                        'message' => 'Mata kuliah berhasil dihapus',
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

        return redirect(base_url('/admin/mata_kuliah'));
    }
}
