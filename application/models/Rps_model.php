<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 */
class Rps_model extends CI_Model
{
    public int $id;

    public string $kode;

    public int $sks;

    public string $dokumen;

    public int $mata_kuliah_id;

    public int $program_studi_id;

    private string $table_name = 'rps';

    private $mata_kuliah_model;

    private $program_studi_model;

    public function to_array()
    {
        return array(
            'id' => $this->id,
            'kode' => $this->kode,
            'sks' => $this->sks,
            'dokumen' => $this->dokumen,
            'mata_kuliah_id' => $this->mata_kuliah_id,
            'program_studi_id' => $this->program_studi_id,
        );
    }

    public function update(array $data)
    {
        foreach ($data as $key => $value) {
            if ($key == 'id') {
                continue;
            }

            $this->{$key} = $value;
        }

        return $this->update_rps($this->id, $data);
    }

    public function delete()
    {
        return $this->delete_rps($this->id);
    }

    public function create_rps(array $data)
    {
        $model = new Rps_model;

        foreach ($data as $key => $value) {
            if ($key == 'id') {
                continue;
            }

            $model->{$key} = $value;
        }

        $this->db->insert($this->table_name, $data);

        $model->id = (int) $this->db->insert_id();

        return $model;
    }

    public function update_rps(int $id, array $data)
    {
        return $this->db->update($this->table_name, $data, array('id' => $id));
    }

    public function delete_rps(int $id)
    {
        return $this->db->delete($this->table_name, array('id' => $id));
    }

    public function find_rps(array $where)
    {
        $model = new Rps_model;
        $data = $this->db->where($where)->get($this->table_name, 1)->first_row('array');

        if (!$data) {
            return NULL;
        }

        foreach ($data as $key => $value) {
            $model->{$key} = $value;
        }

        return $model;
    }

    public function search_rps(array $where = NULL)
    {
        if (!is_null($where)) {
            $this->db->where($where);
        }

        $data = $this->db->get($this->table_name)->result_array();
        $rps = array_map(function ($item) {
            $model = new Rps_model;

            foreach ($item as $key => $value) {
                $model->{$key} = $value;
            }

            return $model;
        }, $data);

        return $rps;
    }

    public function mata_kuliah()
    {
        if (!$this->mata_kuliah_model) {
            $this->mata_kuliah_model = (new Mata_kuliah_model)->find_mata_kuliah(array('id' => $this->mata_kuliah_id));
        }

        return $this->mata_kuliah_model;
    }

    public function program_studi()
    {
        if (!$this->program_studi_model) {
            $this->program_studi_model = (new Program_studi_model)->find_program_studi(array('id' => $this->program_studi_id));
        }

        return $this->program_studi_model;
    }
}