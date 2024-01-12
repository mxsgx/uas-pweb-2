<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mata_kuliah_model extends CI_Model
{
    public int $id;

    public string $nama;

    private string $table_name = 'mata_kuliah';

    public function to_array()
    {
        return array(
            'id' => $this->id,
            'nama' => $this->nama,
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

        return $this->update_mata_kuliah($this->id, $data);
    }

    public function delete()
    {
        return $this->delete_mata_kuliah($this->id);
    }

    public function create_mata_kuliah(array $data)
    {
        $model = new Mata_kuliah_model;

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

    public function update_mata_kuliah(int $id, array $data)
    {
        return $this->db->update($this->table_name, $data, array('id' => $id));
    }

    public function delete_mata_kuliah(int $id)
    {
        return $this->db->delete($this->table_name, array('id' => $id));
    }

    public function find_mata_kuliah(array $where)
    {
        $model = new Mata_kuliah_model;
        $data = $this->db->where($where)->get($this->table_name, 1)->first_row('array');

        if (!$data) {
            return NULL;
        }

        foreach ($data as $key => $value) {
            $model->{$key} = $value;
        }

        return $model;
    }

    public function search_mata_kuliah(array $where = NULL)
    {
        if (!is_null($where)) {
            $this->db->where($where);
        }

        $data = $this->db->get($this->table_name)->result_array();
        $mata_kuliah = array_map(function ($item) {
            $model = new Mata_kuliah_model;

            foreach ($item as $key => $value) {
                $model->{$key} = $value;
            }

            return $model;
        }, $data);

        return $mata_kuliah;
    }
}